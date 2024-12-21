<?php
class Elementor_formlost_password_widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'my_formlost_passwordwidget';
	}

	public function get_title() {
		return esc_html__( 'lost_password Form', 'customize-my-account-for-woocommerce' );
	}

	public function get_icon() {
		return 'eicon-person';
	}

	public function get_categories() {
		return [ 'customize-my-account' ];
	}



	protected function render() {
		include 'templates/form-lost_password.php';
	}
}