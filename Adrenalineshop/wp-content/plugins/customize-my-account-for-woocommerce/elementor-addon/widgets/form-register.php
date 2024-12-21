<?php
class Elementor_formregister_widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'my_formregisterwidget';
	}

	public function get_title() {
		return esc_html__( 'register Form', 'customize-my-account-for-woocommerce' );
	}

	public function get_icon() {
		return 'eicon-person';
	}

	public function get_categories() {
		return [ 'customize-my-account' ];
	}



	protected function render() {
		include 'templates/form-register.php';
	}
}