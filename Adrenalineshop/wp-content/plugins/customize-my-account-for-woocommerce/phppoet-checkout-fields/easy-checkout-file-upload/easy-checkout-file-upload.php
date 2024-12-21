<?php


if( !defined( 'syscmafwpl_PLUGIN_URL_file_upload' ) )

define( 'syscmafwpl_PLUGIN_URL_file_upload', plugin_dir_url( __FILE__ ) );


add_filter('syscmafwpl_override_field_types','syscmafwpl_add_file_type_function',10,1);

function syscmafwpl_add_file_type_function($field_types) {
	$field_types[] = array(
	 		    'type'=>'file_upload',
	 		    'text'=> __('File Upload','customize-my-account-for-woocommerce'),
	 		    'icon'=> 'fa fa-upload'

	 	    );
	return $field_types;
}

add_filter( 'woocommerce_form_field_file_upload', 'syscmafwplfile_upload_form_field', 10, 4 );

function syscmafwplfile_upload_form_field($field, $key, $args, $value) {
	$key = isset($args['field_key']) ? $args['field_key'] : $key;

         if ( ( ! empty( $args['clear'] ) ) ) $after = '<div class="clear"></div>'; else $after = '';
	  
	     if ( $args['required'] ) {
			  $args['class'][] = 'validate-required';
			  $required = ' <abbr class="required" title="' . esc_attr__( 'required', 'customize-my-account-for-woocommerce'  ) . '">*</abbr>';
		  } else {
			$required = '';
		  }
		     


		$fees_class       = '';

		$fees_class       = syscmafwpl_get_fees_class($key);

		
		if ($value == "empty") {
			$value = "";
		}
    $max_allowed = isset($args['max_file_size']) ? $args['max_file_size'] : 2;

    $allowed_file_types = isset($args['allowed_file_types']) ? $args['allowed_file_types'] : "png,jpeg,pdf";

	$input_html =  '<input nkey="'.$key.'" type="file" class="syscmafwpl_file" allowed_type="'.$allowed_file_types.'" max_allowed="'.$max_allowed.'" id="syscmafwpl_file_'.$key.'" name="syscmafwpl_file_'.$key.'" /><input class="syscmafwpl_hidden_input_file pcme_hidden_file_'.$key.'" type="hidden" name="' . $key . '" /><div class="syscmafwpl_filelist syscmafwpl_filelist_' . $key . '"></div>';
	

        $field = '<p class="form-row ' . implode( ' ', $args['class'] ) .' " id="' . $key . '_field">
            <label for="' . $key . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label']. $required . '</label>
            ' . $input_html . '
        </p>' . $after;
         

    return $field;
}

add_action( 'wp_ajax_syscmafwpl_checkout_file_upload', 'syscmafwpl_file_upload' );
add_action( 'wp_ajax_nopriv_syscmafwpl_checkout_file_upload', 'syscmafwpl_file_upload' );

function syscmafwpl_file_upload(){

	
	$image_url = '';

	require_once(ABSPATH.'wp-admin/includes/file.php');


	if ( isset( $_FILES[ 'syscmafwpl_file' ] ) ) {


		$upload_overrides = array( 'test_form' => false );

		

		$result = wp_handle_upload( $_FILES[ 'syscmafwpl_file' ], $upload_overrides );
	}

	wp_send_json( array( 'type' => 'success', 'image_url' => $result ) );
}

add_filter( 'wp_enqueue_scripts', 'syscmafwpl_add_checkout_frountend_scripts' );

function syscmafwpl_add_checkout_frountend_scripts() {
	if ( is_account_page() ) {
       wp_enqueue_script( 'syscmafwpl_file_upload', ''.syscmafwpl_PLUGIN_URL_file_upload.'assets/js/frontend.js',array('jquery') );
        wp_enqueue_style( 'syscmafwpl_file_upload', ''.syscmafwpl_PLUGIN_URL_file_upload.'assets/css/frontend.css' );

        $translation_array = array( 
		        'max_allowed_text'               => esc_html__( 'Maximum size allowed for this upload is ' ,'customize-my-account-for-woocommerce'),

		        'type_allowed_text'               => esc_html__( 'File type allowed' ,'customize-my-account-for-woocommerce'),
		        
		);
         
        wp_localize_script( 'syscmafwpl_file_upload', 'syscmafwpl_file_upload', $translation_array );
	}
}

add_action( 'woocommerce_checkout_update_order_meta', 'syscmafwpl_file_field_save_added' );
function syscmafwpl_file_field_save_added( $order_id ){

	if( ! empty( $_POST[ 'syscmafwpl_file_field' ] ) ) {
		update_post_meta( $order_id, 'syscmafwpl_file_field', sanitize_text_field( $_POST[ 'syscmafwpl_file_field' ] ) );
	}

}



add_action( 'woocommerce_admin_order_data_after_order_details', 'syscmafwpl_order_meta_general' );
function syscmafwpl_order_meta_general( $order ){

	$file = get_post_meta( $order->get_id(), 'syscmafwpl_file_field', true );
	if( $file ) {
		echo '<img class="cxc-order-img" style="max-width: 400px;width: 100%;height: auto; margin-top: 10px;" src="'. esc_url( $file ) .'" />';
	}

}

add_action('admin_enqueue_scripts','syscmafwpl_register_admin_scripts_file_upload');

/*
 * registers admin scripts via admin enqueue scripts
 */
function syscmafwpl_register_admin_scripts_file_upload($hook) {
	    global $billing_syscmafwplsettings_page;
			
		if ( $hook == $billing_syscmafwplsettings_page ) {
		     
 
		 
		 
		 
		    
		    wp_enqueue_script( 'syscmafwpladmin-file_upload', ''.syscmafwpl_PLUGIN_URL_file_upload.'assets/js/admin.js' , array('jquery'));
		 

     
        }
	

}

add_action('syscmafwpl_after_visibility_content_tr','syscmafwpl_after_visibility_content_tr_function',10,3);


function syscmafwpl_after_visibility_content_tr_function($slug,$key,$field) {
	?>

	<tr class="visible_only_if_field_type_file_upload" style="<?php if (isset($field['type']) && ($field['type'] == "file_upload")) { echo 'display:table-row;'; } else { echo 'display:none;'; } ?>">
		<td width="25%">
			<label for="<?php echo $key; ?>_charlimit"><?php echo esc_html__('Max file size allowed','customize-my-account-for-woocommerce'); ?></label>
		</td>
		<td width="75%">
			<?php $max_allowed = isset($field['max_file_size']) ? $field['max_file_size'] : 2; ?>
			<input type="number" name="<?php echo $slug; ?>[<?php echo $key; ?>][max_file_size]" value="<?php echo $max_allowed; ?>">
			<?php echo esc_html__('MB','customize-my-account-for-woocommerce'); ?>
		</td>
	</tr>

	<tr class="visible_only_if_field_type_file_upload" style="<?php if (isset($field['type']) && ($field['type'] == "file_upload")) { echo 'display:table-row;'; } else { echo 'display:none;'; } ?>">
		<td width="25%">
			<label for="<?php echo $key; ?>_charlimit"><?php echo esc_html__('Allowed file types','customize-my-account-for-woocommerce'); ?></label>
		</td>
		<td width="75%">
			<?php $allowed_file_types = isset($field['allowed_file_types']) ? $field['allowed_file_types'] : "png,jpeg,pdf"; ?>
			<input type="text" name="<?php echo $slug; ?>[<?php echo $key; ?>][allowed_file_types]" value="<?php echo $allowed_file_types; ?>">
		
		</td>
	</tr>

	<?php
}