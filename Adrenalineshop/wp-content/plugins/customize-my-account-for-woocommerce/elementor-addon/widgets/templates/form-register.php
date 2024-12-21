<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' ); 

$plugin_options = (array) get_option( 'wcmamtx_plugin_options' );

$hide_linkto_password = 'yes';

if (isset($plugin_options['hide_linkto_password']) && ($plugin_options['hide_linkto_password'] == "yes")) { 

	$hide_linkto_password = 'no';

} else {
	$hide_linkto_password = 'yes';
} 

$hide_presonal_data_text = 'yes';

if (isset($plugin_options['hide_presonal_data_text']) && ($plugin_options['hide_presonal_data_text'] == "yes")) { 

	$hide_presonal_data_text = 'no';

} else {
	$hide_presonal_data_text = 'yes';
}

?>



		<h2><?php esc_html_e( 'Register', 'customize-my-account-for-woocommerce' ); ?></h2>

		<form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

			<?php do_action( 'woocommerce_register_form_start' ); ?>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="reg_username"><?php esc_html_e( 'Username', 'customize-my-account-for-woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
					<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
				</p>

			<?php endif; ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="reg_email"><?php esc_html_e( 'Email address', 'customize-my-account-for-woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
				<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
			</p>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="reg_password"><?php esc_html_e( 'Password', 'customize-my-account-for-woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
					<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
				</p>

			<?php else : ?>

				<?php if ($hide_linkto_password == "yes") { ?>

					<p><?php esc_html_e( 'A link to set a new password will be sent to your email address.', 'customize-my-account-for-woocommerce' ); ?></p>

				<?php } ?>

			<?php endif; ?>

			<?php

			if ($hide_presonal_data_text == "yes") {  

				do_action( 'woocommerce_register_form' ); 

			}

			?>

			<p class="woocommerce-form-row form-row">
				<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
				<button type="submit" class="woocommerce-Button woocommerce-button button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?> woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'Register', 'customize-my-account-for-woocommerce' ); ?>"><?php esc_html_e( 'Register', 'customize-my-account-for-woocommerce' ); ?></button>
			</p>

			<?php 
			
				do_action( 'woocommerce_register_form_end' ); 

			 

		?>

		</form>




<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
