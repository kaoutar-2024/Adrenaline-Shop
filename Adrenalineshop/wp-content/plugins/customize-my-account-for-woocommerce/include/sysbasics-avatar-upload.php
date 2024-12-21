<?php



function wcmamtx_upload_avatar_tab_uninstall() {
	$wcmamtx_upload_avatar_tab = new wcmamtx_upload_avatar_tab;
	$users = get_users();

	foreach ( $users as $user )
		$wcmamtx_upload_avatar_tab->avatar_delete( $user->user_id );

	delete_option( 'wcmamtx_upload_avatar_tab_caps' );
}
register_uninstall_hook( __FILE__, 'wcmamtx_upload_avatar_tab_uninstall' );



class wcmamtx_upload_avatar_tab {


	private $user_id_being_edited;


	public function __construct() {

		add_filter( 'get_avatar_data',			 array( $this, 'wcmamtx_get_avatar_data'               ), 10, 2 );
		add_filter( 'get_avatar',				 array( $this, 'get_avatar'               ), 10, 6 );
		add_filter( 'avatar_defaults',			 array( $this, 'avatar_defaults'          )        );
		add_action( 'personal_options_update',	 array( $this, 'edit_user_profile_update' )        );
		add_action( 'edit_user_profile_update',	 array( $this, 'edit_user_profile_update' )        );
		
		add_shortcode( 'sysBasics-user-avatar',	 array( $this, 'wcmamtx_shortcode'));

		
	}


	public function sanitize_options( $input ) {
		$new_input['wcmamtx_upload_avatar_tab_caps'] = empty( $input ) ? 0 : 1;
		return $new_input;
	}


	public function wcmamtx_get_avatar_data( $args, $id_or_email ) {
		if ( ! empty( $args['force_default'] ) ) {
			return $args;
		}

		global $wpdb;

		$return_args = $args;

		if ( is_numeric( $id_or_email ) && 0 < $id_or_email ) {
			$user_id = (int) $id_or_email;
		} elseif ( is_object( $id_or_email ) && isset( $id_or_email->user_id ) && 0 < $id_or_email->user_id ) {
			$user_id = $id_or_email->user_id;
		} elseif ( is_object( $id_or_email ) && isset( $id_or_email->ID ) && isset( $id_or_email->user_login ) && 0 < $id_or_email->ID ) {
			$user_id = $id_or_email->ID;
		} elseif ( is_string( $id_or_email ) && false !== strpos( $id_or_email, '@' ) ) {
			$_user = get_user_by( 'email', $id_or_email );

			if ( ! empty( $_user ) ) {
				$user_id = $_user->ID;
			}
		}

		if ( empty( $user_id ) ) {
			return $args;
		}

		$user_avatar_url = null;

		// Get the user's local avatar from usermeta.
		$local_avatars = get_user_meta( $user_id, 'sysbasics_user_avatar', true );

		if ( empty( $local_avatars ) || empty( $local_avatars['full'] ) ) {
			// Try to pull avatar from WP User Avatar.
			$wp_user_avatar_id = get_user_meta( $user_id, $wpdb->get_blog_prefix() . 'user_avatar', true );
			if ( ! empty( $wp_user_avatar_id ) ) {
				$wp_user_avatar_url = wp_get_attachment_url( intval( $wp_user_avatar_id ) );
				$local_avatars = array( 'full' => $wp_user_avatar_url );
				update_user_meta( $user_id, 'sysbasics_user_avatar', $local_avatars );
			} else {
				// We don't have a local avatar, just return.
				return $args;
			}	
		}


		$size = apply_filters( 'wcmamtx_upload_avatar_tab_default_size', (int) $args['size'], $args );

		// Generate a new size
		if ( empty( $local_avatars[$size] ) ) {

			$upload_path      = wp_upload_dir();
			$avatar_full_path = str_replace( $upload_path['baseurl'], $upload_path['basedir'], $local_avatars['full'] );
			$image            = wp_get_image_editor( $avatar_full_path );
			$image_sized      = null;

			if ( ! is_wp_error( $image ) ) {
				$image->resize( $size, $size, true );
				$image_sized = $image->save();
			}

			// Deal with original being >= to original image (or lack of sizing ability).
			if ( empty( $image_sized ) || is_wp_error( $image_sized ) ) {
				$local_avatars[ $size ] = $local_avatars['full'];
			} else {
				$local_avatars[ $size ] = str_replace( $upload_path['basedir'], $upload_path['baseurl'], $image_sized['path'] );
			}

			// Save updated avatar sizes
			update_user_meta( $user_id, 'sysbasics_user_avatar', $local_avatars );

		} elseif ( substr( $local_avatars[ $size ], 0, 4 ) != 'http' ) {
			$local_avatars[ $size ] = home_url( $local_avatars[ $size ] );
		}

		if ( is_ssl() ) {
			$local_avatars[ $size ] = str_replace( 'http:', 'https:', $local_avatars[ $size ] );
		}

		$user_avatar_url = $local_avatars[ $size ];

		if ( $user_avatar_url ) {
			$return_args['url'] = $user_avatar_url;
			$return_args['found_avatar'] = true;
		}


		return apply_filters( 'sysbasics_user_avatar_data', $return_args );
	}


	public function get_avatar( $avatar, $id_or_email, $size = 96, $default = '', $alt = false, $args = array() ) {

		return apply_filters( 'sysbasics_user_avatar', $avatar, $id_or_email );
	}



	public function edit_user_profile_update( $user_id ) {

		// Check for nonce otherwise bail
		if ( ! isset( $_POST['_sysbasics_user_avatar_nonce'] ) || ! wp_verify_nonce( $_POST['_sysbasics_user_avatar_nonce'], 'sysbasics_user_avatar_nonce' ) )
			return;

		if ( ! empty( $_FILES['basic-user-avatar']['name'] ) ) {

			// Allowed file extensions/types
			$mimes = array(
				'jpg|jpeg|jpe' => 'image/jpeg',
				'gif'          => 'image/gif',
				'png'          => 'image/png',
			);

			// Front end support - shortcode, bbPress, etc
			if ( ! function_exists( 'wp_handle_upload' ) )
				require_once ABSPATH . 'wp-admin/includes/file.php';

			$this->avatar_delete( $this->user_id_being_edited );

			// Need to be more secure since low privelege users can upload
			if ( strstr( $_FILES['basic-user-avatar']['name'], '.php' ) )
				wp_die( 'For security reasons, the extension ".php" cannot be in your file name.' );

			// Make user_id known to unique_filename_callback function
			$this->user_id_being_edited = $user_id; 
			$avatar = wp_handle_upload( $_FILES['basic-user-avatar'], array( 'mimes' => $mimes, 'test_form' => false, 'unique_filename_callback' => array( $this, 'unique_filename_callback' ) ) );

			// Handle failures
			if ( empty( $avatar['file'] ) ) {  
				switch ( $avatar['error'] ) {
					case 'File type does not meet security guidelines. Try another.' :
					add_action( 'user_profile_update_errors', function( $error = 'avatar_error' ){
						
					} );
					break;
					default :
					add_action( 'user_profile_update_errors', function( $error = 'avatar_error' ){
						// No error let's bail.
						if ( empty( $avatar['error'] ) ) {
							return;
						}

						"<strong>".esc_html__("There was an error uploading the avatar:","customize-my-account-for-woocommerce")."</strong> ". esc_attr( $avatar['error'] );
					} );
				}
				return;
			}

			// Save user information (overwriting previous)
			update_user_meta( $user_id, 'sysbasics_user_avatar', array( 'full' => $avatar['url'] ) );

		} elseif ( ! empty( $_POST['basic-user-avatar-erase'] ) ) {
			// Nuke the current avatar
			$this->avatar_delete( $user_id );
		}
	}


	function wcmamtx_shortcode() {


		if ( ! is_user_logged_in() ) {
			return;
		}

		$user_id     = get_current_user_id();
		$profileuser = get_userdata( $user_id );

		if ( isset( $_POST['manage_avatar_submit'] ) ){
			$this->edit_user_profile_update( $user_id );
		}

		?>

		<div class="wcmamtx_upload_div">
			<?php

			$avatar_settings = (array) get_option( 'wcmamtx_avatar_settings' );

			$avatar_size = isset($avatar_settings['avatar_size']) ? $avatar_settings['avatar_size'] : "250";


			echo get_avatar( $profileuser->ID ,$avatar_size);



			$allow_avatar_change = 'yes';

			$avatar_settings = (array) get_option( 'wcmamtx_avatar_settings' );

			if (isset($avatar_settings['allow_avatar_change']) && ($avatar_settings['allow_avatar_change'] == "yes")) {

				$allow_avatar_change = 'no';
			} else {
				$allow_avatar_change = 'yes';
			}
            
            if (isset($allow_avatar_change) && ($allow_avatar_change == 'yes')) { ?>
				<a href="#" class="wcmamtx_upload_avatar"><img class="camera" src="<?php echo wcmamtx_PLUGIN_URL; ?>assets/images/camera.svg" height="20" width="20"></a>
			<?php } ?>
		</div>	

		<?php

		ob_start();

		$this->upload_wcmamtx_modal_avatar($profileuser,$avatar_size);
		
		return ob_get_clean();
	}


	public function upload_wcmamtx_modal_avatar($profileuser,$avatar_size) {
		?>
		<!-- Trigger/Open The wcmamtx_modal -->

		<!-- The wcmamtx_modal -->
		<div id="mywcmamtx_modal" class="wcmamtx_modal">

			<!-- wcmamtx_modal content -->
			<div class="wcmamtx_modal-content">
				<span class="wcmamtx_modal_close">&times;</span>
				<form id="basic-user-avatar-form" method="post" enctype="multipart/form-data">
					<?php
					echo get_avatar( $profileuser->ID,$avatar_size);

					?>

					<?php

					$options = get_option( 'wcmamtx_upload_avatar_tab_caps' );
					if ( empty( $options['wcmamtx_upload_avatar_tab_caps'] ) || current_user_can( 'upload_files' ) ) {
				// Nonce security ftw
						wp_nonce_field( 'sysbasics_user_avatar_nonce', '_sysbasics_user_avatar_nonce', false );

				// File upload input
						echo '<p><input type="file" name="basic-user-avatar" id="basic-local-avatar" /></p>';

						if ( empty( $profileuser->sysbasics_user_avatar ) ) {

						} else {
							echo '<p><input type="checkbox" name="basic-user-avatar-erase" id="basic-user-avatar-erase" value="1" /> <label for="basic-user-avatar-erase">' . apply_filters( 'bu_avatars_delete_avatar_text', esc_html__( 'Restore Default', 'customize-my-account-for-woocommerce' ), $profileuser ) . '</label></p>';					

						}

						echo '<input type="submit" name="manage_avatar_submit" class="wcmamtx_update_avatar_btn" value="' . apply_filters( 'bu_avatars_update_button_text', esc_attr__( 'Update Avatar', 'customize-my-account-for-woocommerce' ) ) . '" />';

					} 
					?>



				</form>
			</div>

		</div>      
		<?php
	}





	public function avatar_defaults( $avatar_defaults ) {
		remove_action( 'get_avatar', array( $this, 'get_avatar' ) );
		return $avatar_defaults;
	}


	public function avatar_delete( $user_id ) {
		$old_avatars = get_user_meta( $user_id, 'sysbasics_user_avatar', true );
		$upload_path = wp_upload_dir();

		if ( is_array( $old_avatars ) ) {
			foreach ( $old_avatars as $old_avatar ) {
				$old_avatar_path = str_replace( $upload_path['baseurl'], $upload_path['basedir'], $old_avatar );
				@unlink( $old_avatar_path );
			}
		}

		delete_user_meta( $user_id, 'sysbasics_user_avatar' );
	}


	public function unique_filename_callback( $dir, $name, $ext ) {
		$user = get_user_by( 'id', (int) $this->user_id_being_edited );
		$name = $base_name = sanitize_file_name( strtolower( $user->display_name ) . '_avatar' );

		$number = 1;

		while ( file_exists( $dir . "/$name$ext" ) ) {
			$name = $base_name . '_' . $number;
			$number++;
		}

		return $name . $ext;
	}
}
$wcmamtx_upload_avatar_tab = new wcmamtx_upload_avatar_tab;