<?php
/**
 * Plugin Name: Elementor Addon
 * Description: Simple hello world widgets for Elementor.
 * Version:     1.0.0
 * Author:      Elementor Developer
 * Author URI:  https://developers.elementor.com/
 * Text Domain: elementor-addon
 */

include 'helper.php';


if (!function_exists('register_customize_widgets_pro')) {

function register_customize_widgets_pro( $widgets_manager ) {

    $plugin_options = (array) get_option("wcmamtx_plugin_options");

    $el_widgets = array('vertical-navigation'=>esc_html__('Vertical Menu','customize-my-account-for-woocommerce'),
                        'horizontal-navigation'=>esc_html__('Horizontal Menu','customize-my-account-for-woocommerce'),
                        'my-orders'=>esc_html__('My Orders','customize-my-account-for-woocommerce'),
                        'dashboard'=>esc_html__('Dashboard','customize-my-account-for-woocommerce'),
                        'form-add-payment-method'=>esc_html__('Add Payment Method','customize-my-account-for-woocommerce'),
                        'form-edit-account'=>esc_html__('Edit Account Form','customize-my-account-for-woocommerce'),
                        'form-edit-address'=>esc_html__('Edit Address Form','customize-my-account-for-woocommerce'),
                        'form-login'=>esc_html__('Login Form','customize-my-account-for-woocommerce'),
                        'form-register'=>esc_html__('Registration Form','customize-my-account-for-woocommerce'),
                        'form-lost-password'=>esc_html__('Lost Password Form','customize-my-account-for-woocommerce'),
                        'my-address'=>esc_html__('My Address Form','customize-my-account-for-woocommerce'),
                        'orders'=>esc_html__('Orders Form','customize-my-account-for-woocommerce'),
                        'payment-methods'=>esc_html__('Payment Methods','customize-my-account-for-woocommerce')
    );



    $el_widgets = isset($plugin_options['el_widgets']) && !empty($plugin_options['el_widgets']) ? $plugin_options['el_widgets'] : $el_widgets;


    if (isset($el_widgets['vertical-navigation'])) {

        require_once( __DIR__ . '/widgets/vertical-navigation.php' );
        $widgets_manager->register( new \Elementor_vertical_navigation_widget() );

    }

    if (isset($el_widgets['horizontal-navigation'])) {

        require_once( __DIR__ . '/widgets/horizontal-navigation.php' );
        $widgets_manager->register( new \Elementor_horizontal_navigation_widget() );

    }

    if (isset($el_widgets['my-orders'])) {

        require_once( __DIR__ . '/widgets/my-orders.php' );
        $widgets_manager->register( new \Elementor_My_orders_widget() );

    }

    if (isset($el_widgets['my-orders'])) {


        require_once( __DIR__ . '/widgets/dashboard.php' );
        $widgets_manager->register( new \Elementor_dashboard_widget() );

    }

    if (isset($el_widgets['form-add-payment-method'])) {

        require_once( __DIR__ . '/widgets/form-add-payment-method.php' );
        $widgets_manager->register( new \Elementor_formaddpaymentmethod_widget() );

    }

    if (isset($el_widgets['form-edit-account'])) {


        require_once( __DIR__ . '/widgets/form-edit-account.php' );
        $widgets_manager->register( new \Elementor_formeditaccount_widget() );

    }

    if (isset($el_widgets['form-edit-address'])) {


        require_once( __DIR__ . '/widgets/form-edit-address.php' );
        $widgets_manager->register( new \Elementor_formeditaddress_widget() );

    }



    if (isset($el_widgets['form-login'])) {


        require_once( __DIR__ . '/widgets/form-login.php' );
        $widgets_manager->register( new \Elementor_formlogin_widget() );

    }

    if (isset($el_widgets['form-register'])) {


        require_once( __DIR__ . '/widgets/form-register.php' );
        $widgets_manager->register( new \Elementor_formregister_widget() );

    }


    if (isset($el_widgets['form-lost-password'])) {


        require_once( __DIR__ . '/widgets/form-lost-password.php' );
        $widgets_manager->register( new \Elementor_formlost_password_widget() );

    }



    if (isset($el_widgets['my-address'])) {


        require_once( __DIR__ . '/widgets/my-address.php' );
        $widgets_manager->register( new \Elementor_myaddress_widget() );

    }





    if (isset($el_widgets['orders'])) { 


        require_once( __DIR__ . '/widgets/orders.php' );
        $widgets_manager->register( new \Elementor_orders_widget() );

    }

    if (isset($el_widgets['payment-methods'])) { 


        require_once( __DIR__ . '/widgets/payment-methods.php' );
        $widgets_manager->register( new \Elementor_paymentmethods_widget() );

    }



}

}
add_action( 'elementor/widgets/register', 'register_customize_widgets_pro' );