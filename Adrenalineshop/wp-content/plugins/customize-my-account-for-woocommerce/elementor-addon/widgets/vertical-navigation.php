<?php
class Elementor_vertical_navigation_widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'vertical_navigation_widget';
	}

	public function get_title() {
		return esc_html__( 'Vertical Navigation', 'customize-my-account-for-woocommerce' );
	}

	public function get_icon() {
		return 'eicon-menu-bar';
	}

	public function get_categories() {
		return [ 'customize-my-account' ];
	}



	protected function render() {
		include 'templates/vertical-navigation.php';
	}
}