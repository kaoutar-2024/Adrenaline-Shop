<?php
/**
 * Template admin/views/dashboard/new-feature-notice.php
 *
 * @package Forminator
 */

$user      = wp_get_current_user();
$banner_1x = forminator_plugin_url() . 'assets/images/Feature_highlight.png';
$banner_2x = forminator_plugin_url() . 'assets/images/Feature_highlight@2x.png';
?>

<div class="sui-modal sui-modal-md">

	<div
		role="dialog"
		id="forminator-new-feature"
		class="sui-modal-content"
		aria-live="polite"
		aria-modal="true"
		aria-labelledby="forminator-new-feature__title"
	>

		<div class="sui-box forminator-feature-modal" data-prop="forminator_dismiss_feature_1370" data-nonce="<?php echo esc_attr( wp_create_nonce( 'forminator_dismiss_notification' ) ); ?>">

			<div class="sui-box-header sui-flatten sui-content-center">

				<figure class="sui-box-banner" aria-hidden="true">
					<img
						src="<?php echo esc_url( $banner_1x ); ?>"
						srcset="<?php echo esc_url( $banner_1x ); ?> 1x, <?php echo esc_url( $banner_2x ); ?> 2x"
						alt=""
					/>
				</figure>

				<button class="sui-button-icon sui-button-white sui-button-float--right forminator-dismiss-new-feature" data-type="dismiss" data-modal-close>
					<span class="sui-icon-close sui-md" aria-hidden="true"></span>
					<span class="sui-screen-reader-text"><?php esc_html_e( 'Close this dialog.', 'forminator' ); ?></span>
				</button>

				<h3 class="sui-box-title sui-lg" style="overflow: initial; white-space: initial; text-overflow: initial;">
					<?php esc_html_e( 'New: Inherit Theme Styles', 'forminator' ); ?>
				</h3>

				<p class="sui-description">
					<?php
					printf(
						/* translators: 1. Admin name 2. Open b tag, 3. Close b tag */
						esc_html__( 'Hey, %s! we’re excited to introduce a new feature for styling your forms. Your forms can now automatically match your site’s theme, creating a unified appearance. This feature simplifies maintaining a consistent and professional brand image.', 'forminator' ),
						esc_html( ucfirst( $user->display_name ) ),
					);
					?>
				</p>

			</div>

			<div class="sui-box-footer sui-flatten sui-content-center">

				<button data-link="<?php echo esc_url( add_query_arg( array( 'page' => 'forminator-cform' ), admin_url( 'admin.php' ) ) ); ?>" class="sui-button sui-button-blue forminator-dismiss-new-feature" data-modal-close>
					<?php esc_html_e( 'Check it out', 'forminator' ); ?>
				</button>

			</div>

		</div>

	</div>

</div>

<script type="text/javascript">
	jQuery('#forminator-new-feature .forminator-dismiss-new-feature').on('click', function (e) {
	e.preventDefault()

	var $notice = jQuery(e.currentTarget).closest('.forminator-feature-modal'),
		ajaxUrl = '<?php echo esc_url( forminator_ajax_url() ); ?>',
		$self   = jQuery(this),
		dataType = jQuery(this).data('type'),
		ajaxData = {
		action: 'forminator_dismiss_notification',
		prop: $notice.data('prop'),
		_ajax_nonce: $notice.data('nonce')
		}

	if ( 'save' === dataType ) {
		ajaxData['usage_value'] = jQuery('#forminator-new-feature-toggle').is(':checked')
	}

	jQuery.post(ajaxUrl, ajaxData)
		.always(function () {
			$notice.hide();
			let link = $self.data('link');
			if ( link ) {
				location.href = link;
			}
		})
	})
</script>
