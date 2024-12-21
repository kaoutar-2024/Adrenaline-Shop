<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.7.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_edit_account_form' ); 

$extra_settings    = (array) get_option('syscmafwpl_extra_settings');








?>

<form class="woocommerce-EditAccountForm edit-account" action="" method="post" <?php do_action( 'woocommerce_edit_account_form_tag' ); ?> >

	<?php do_action( 'woocommerce_edit_account_form_start' ); ?>

	<?php

	$allow_first_name = isset($extra_settings['disable_firstname']) && ($extra_settings['disable_firstname'] == 1) ? "no" : "yes";

	if ($allow_first_name == "yes") {  ?>

		<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
			<label for="account_first_name"><?php esc_html_e( 'First name', 'customize-my-account-for-woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
			<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_first_name" id="account_first_name" autocomplete="given-name" value="<?php echo esc_attr( $user->first_name ); ?>" />
		</p>

	<?php } ?>
    
	<?php
	$allow_last_name = isset($extra_settings['disable_lastname']) && ($extra_settings['disable_lastname'] == 1) ? "no" : "yes";

	if ($allow_last_name == "yes") {  ?>

		<p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
			<label for="account_last_name"><?php esc_html_e( 'Last name', 'customize-my-account-for-woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
			<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_last_name" id="account_last_name" autocomplete="family-name" value="<?php echo esc_attr( $user->last_name ); ?>" />
		</p>

	<?php } ?>
	<div class="clear"></div>

	<?php

		$allow_display_name = isset($extra_settings['display_name']) && ($extra_settings['display_name'] == 1) ? "no" : "yes";

		if ($allow_display_name == "yes") {  

		?>

		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			<label for="account_display_name"><?php esc_html_e( 'Display name', 'customize-my-account-for-woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
			<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_display_name" id="account_display_name" value="<?php echo esc_attr( $user->display_name ); ?>" /> <span><em><?php esc_html_e( 'This will be how your name will be displayed in the account section and in reviews', 'customize-my-account-for-woocommerce' ); ?></em></span>
		</p>
		<div class="clear"></div>

	<?php } ?>

	<?php

		$allow_email_field = isset($extra_settings['disable_email']) && ($extra_settings['disable_email'] == 1) ? "no" : "yes";

		if ($allow_email_field == "yes") {  

	?>

	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
		<label for="account_email"><?php esc_html_e( 'Email address', 'customize-my-account-for-woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
		<input type="email" class="woocommerce-Input woocommerce-Input--email input-text" name="account_email" id="account_email" autocomplete="email" value="<?php echo esc_attr( $user->user_email ); ?>" />
	</p>

	<?php } ?>

	<?php
		/**
		 * Hook where additional fields should be rendered.
		 *
		 * @since 8.7.0
		 */
		do_action( 'woocommerce_edit_account_form_fields' );
		

		$allow_pass_change = isset($extra_settings['hide_password_change']) && ($extra_settings['hide_password_change'] == 1) ? "no" : "yes";

	?>

	<?php if ($allow_pass_change == "yes") {  ?>

		<fieldset>
			<legend><?php esc_html_e( 'Password change', 'customize-my-account-for-woocommerce' ); ?></legend>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="password_current"><?php esc_html_e( 'Current password (leave blank to leave unchanged)', 'customize-my-account-for-woocommerce' ); ?></label>
				<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_current" id="password_current" autocomplete="off" />
			</p>
			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="password_1"><?php esc_html_e( 'New password (leave blank to leave unchanged)', 'customize-my-account-for-woocommerce' ); ?></label>
				<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_1" id="password_1" autocomplete="off" />
			</p>
			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="password_2"><?php esc_html_e( 'Confirm new password', 'customize-my-account-for-woocommerce' ); ?></label>
				<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_2" id="password_2" autocomplete="off" />
			</p>
		</fieldset>
	<?php } ?>

	<?php

	$all_fields    = (array) get_option('syscmafwpl_additional_settings');
    
    unset($all_fields[0]);

	if (isset($all_fields) && (sizeof($all_fields) >= 1)) { 


		foreach ( $all_fields as $key => $field ) {


			$field_key = isset($field['field_key']) ? $field['field_key'] : $key;

			$default_value = get_user_meta( get_current_user_id(), $field_key, true );

			
			$hide_account_edit = isset($field['hide_account_edit']) && ($field['hide_account_edit'] == 1) ? "no" : "yes";


			if ($hide_account_edit == "yes") {


				$visibilityarray = $field['visibility'];
				 
				if (isset($field['products'])) { 
				    $allowedproducts = $field['products'];
				} else {
					$allowedproducts = array(); 
				}
				 
				if (isset($field['category'])) {
					$allowedcats = $field['category'];
				} else {
					$allowedcats = array();
				}

				if (isset($field['role'])) {
					$allowedroles = $field['role'];
				} else {
					$allowedroles = array();
				}

				if (isset($field['total-quantity'])) {
					$total_quantity = $field['total-quantity'];
				} else {
					$total_quantity = 0;
				}

				if (isset($field['specific-product'])) {
					$prd = $field['specific-product'];
				} else {
					$prd = 0;
				}

				if (isset($field['specific-quantity'])) {
					$prd_qnty = $field['specific-quantity'];
				} else {
					$prd_qnty = 0;
				}


				if (isset($field['dynamic_rules'])) { 
					$dynamic_rules = $field['dynamic_rules'];
				} else {
					$dynamic_rules = array(); 
				}


				if (isset($field['dynamic_visibility_criteria'])) { 
					$dynamic_criteria = $field['dynamic_visibility_criteria'];
				} else {
					$dynamic_criteria = 'match_all'; 
				}


				 
				$is_field_hidden = syscmafwpl_check_if_field_is_hidden2($visibilityarray,$allowedproducts,$allowedcats,$allowedroles,$total_quantity,$prd,$prd_qnty,$dynamic_rules,$dynamic_criteria);

				if ((!isset($is_field_hidden)) || ($is_field_hidden != 0)) {

					if (isset($field['type']) &&  ($field['type'] == "pcsyscmafwplselect")) {

						$field_html = '';

						woocommerce_form_field( $field_html, $key, $field, $default_value );

					} else {



						woocommerce_form_field( $key, $field, $default_value );

					}
				}

			}

		}
	}
	?>
	<div class="clear"></div>

	<?php
		/**
		 * My Account edit account form.
		 *
		 * @since 2.6.0
		 */
		do_action( 'woocommerce_edit_account_form' );
	?>

	<p>
		<?php wp_nonce_field( 'save_account_details', 'save-account-details-nonce' ); ?>
		<button type="submit" class="woocommerce-Button button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'customize-my-account-for-woocommerce' ); ?>"><?php esc_html_e( 'Save changes', 'customize-my-account-for-woocommerce' ); ?></button>
		<input type="hidden" name="action" value="save_account_details" />
	</p>

	<?php do_action( 'woocommerce_edit_account_form_end' ); ?>
</form>

<?php do_action( 'woocommerce_after_edit_account_form' ); ?>
