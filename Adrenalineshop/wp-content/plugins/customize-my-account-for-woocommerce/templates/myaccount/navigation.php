<?php


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_account_navigation' );



$wcmamtx_tabs   =  (array) get_option('wcmamtx_advanced_settings');

$items          =  wc_get_account_menu_items();

$core_fields    = 'dashboard,orders,downloads,edit-address,edit-account,customer-logout';

$core_fields_array =  array(
    'orders'          => get_option( 'woocommerce_myaccount_orders_endpoint', 'orders' ),
    'downloads'       => get_option( 'woocommerce_myaccount_downloads_endpoint', 'downloads' ),
    'edit-address'    => get_option( 'woocommerce_myaccount_edit_address_endpoint', 'edit-address' ),
    'payment-methods' => get_option( 'woocommerce_myaccount_payment_methods_endpoint', 'payment-methods' ),
    'edit-account'    => get_option( 'woocommerce_myaccount_edit_account_endpoint', 'edit-account' ),
    'customer-logout' => get_option( 'woocommerce_logout_endpoint', 'customer-logout' ),
  );


$frontend_menu_items = get_option('wcmamtx_frontend_items');

if (!isset($frontend_menu_items) || ($frontend_menu_items == "")) {
    update_option('wcmamtx_frontend_items',$items);
}

$date_today = date("Ymd");

$frontend_menu_items_updated_time = get_option('frontend_menu_items_updated_time');

if ($date_today > $frontend_menu_items_updated_time) {
    update_option('frontend_menu_items_updated',$items);
    update_option('frontend_menu_items_updated_time',$date_today);
}




foreach ($items as $ikey=>$ivalue) {

    if (!array_key_exists($ikey, $wcmamtx_tabs) && !array_key_exists($ikey, $core_fields_array) ) {
        
        $match_index = 0;

        foreach ($wcmamtx_tabs as $tkey=>$tvalue) {
            if (isset($tvalue['endpoint_key']) && ($tvalue['endpoint_key'] == $ikey)) {
                $match_index++;
            }
        }

        if ($match_index == 0) {
            $wcmamtx_tabs[$ikey] = array(
              'show' => 'yes',
              'third_party'  => 'yes',
              'endpoint_key' => $ikey,
              'wcmamtx_type' => 'endpoint',
              'parent'       => 'none',
              'endpoint_name'=> $ivalue,
          );   
        }           

    }
}

$plugin_options = get_option('wcmamtx_plugin_options');


$menu_shape = 'vertical';



if (isset($plugin_options['horizontal_menu']) && ($plugin_options['horizontal_menu'] == "yes")) {

    $menu_shape = 'horizontal';

} else {

    $menu_shape = 'vertical';
}

$icon_position  = 'right';
$icon_extra_class = '';

if (!is_array($wcmamtx_tabs)) { 
    $wcmamtx_tabs = $items;
    
}

if (!isset($wcmamtx_tabs) || (sizeof($wcmamtx_tabs) === 1) || isset($wcmamtx_tabs[0])) {
    $wcmamtx_tabs = $items;
    
}

if (isset($plugin_options['icon_position']) && ($plugin_options['icon_position'] != '')) {
    $icon_position = $plugin_options['icon_position'];
}

if (isset($plugin_options['menu_position']) && ($plugin_options['menu_position'] != '')) {
    $menu_position = $plugin_options['menu_position'];
}



switch($icon_position) {
	case "right":
	   $icon_extra_class = "wcmamtx_custom_right";
	break;

	case "left":
	   $icon_extra_class = "wcmamtx_custom_left";
	break;

	default:
	   $icon_extra_class = "wcmamtx_custom_right";
	break;
}

$menu_position_extra_class = "";

if (isset($menu_position) && ($menu_position != '')) {
    switch($menu_position) {
        case "left":
        $menu_position_extra_class = "wcmamtx_menu_left";
        break;

        case "right":
        $menu_position_extra_class = "wcmamtx_menu_right";
        break;

        default:
        $menu_position_extra_class = "";
        break;
    }
}






if ($menu_shape == 'vertical') {

?>

<nav class="woocommerce-MyAccount-navigation wsmt_extra_navclass <?php echo $menu_position_extra_class; ?>">

    <?php

    $show_avatar = 'yes';

    $avatar_settings = (array) get_option( 'wcmamtx_avatar_settings' );

    if (isset($avatar_settings['disable_avatar']) && ($avatar_settings['disable_avatar'] == "yes")) {

        $show_avatar = 'no';
    } else {
        $show_avatar = 'yes';
    }


    if ($show_avatar == 'yes') {
        echo do_shortcode('[sysBasics-user-avatar]');
    }

    $intro_text_hello = "yes";

    

    if (isset($avatar_settings['intro_text_hello']) && ($avatar_settings['intro_text_hello'] == "yes")) {

        $intro_text_hello = 'no';
    } else {
        $intro_text_hello = 'yes';
    }
    

    if ($intro_text_hello == "yes") { 

        global $current_user;
        wp_get_current_user();

        $allowed_html = array(
            'a' => array(
                'href' => array(),
            ),
        );


        ?>

        <div class="wcmamtx_intro_text">
            <span class="wcmamtx_intro_text1"><?php echo ucfirst($current_user->display_name); ?></span>
            
            <span class="wcmamtx_intro_text2">
                <?php
                printf(
                    /* translators: 1: user display name 2: logout url */
                    wp_kses( __( '<a href="%1$s">Log out</a>', 'customize-my-account-for-woocommerce' ), $allowed_html ),
                    esc_url( wc_logout_url() ),

                );
                ?>
            </span>
        </div>

        <?php
    }

    ?>
   
	<ul class="wcmamtx_vertical">
		<?php foreach ( $wcmamtx_tabs as $key => $value ) { 

			if (isset($value['endpoint_name']) && ($value['endpoint_name'] != '')) {
                $name = $value['endpoint_name'];
            } else {
                $name = $value;
            }

            $should_show = 'yes';


            if (isset($value['visibleto']) && ($value['visibleto'] != "all")) {

                $allowedroles  = isset($value['roles']) ? $value['roles'] : "";

                $allowedusers  = isset($value['users']) ? $value['users'] : array();

                $is_visible    = wcmamtx_check_role_visibility($allowedroles,$value['visibleto'],$allowedusers);
                
            } else {

                $is_visible = 'yes';
            }



            if (isset($value['show']) && ($value['show'] == "no")) {
                
                 $should_show = 'no';
                
            }


            if (isset($value['class']) && ($value['class'] != '')) {
            	$extraclass = str_replace(',',' ', $value['class']);
            } else {
            	$extraclass = '';
            }

            if (isset($value['endpoint_key']) && ($value['endpoint_key'] != '')) {
            	$key = $value['endpoint_key'];
            }

            if (isset($value['parent']) && ($value['parent'] != '')) {
                $parent = $value['parent'];
            } else {
                $parent = 'none';
            }


            
            $icon_source       = isset($value['icon_source']) ? $value['icon_source'] : "default";

            $hide_in_navigation = isset($value['hide_in_navigation']) && ($value['hide_in_navigation'] == "01") ? "enabled" : "disabled";

            if (isset($hide_in_navigation) && ($hide_in_navigation == "enabled")) {
                
                 $should_show = 'no';
                
            }

            if (($should_show == "yes") && ($is_visible == "yes")) {
            
                if (isset($value['wcmamtx_type']) && ($value['wcmamtx_type'] == "group")) {

                    
                    wcmamtx_get_account_menu_group_html( $name,$key ,$value ,$icon_extra_class,$extraclass,$icon_source );
                    
                    

            
                } else {

                    if ($parent == "none") {
                        wcmamtx_get_account_menu_li_html( $name,$key ,$value ,$icon_extra_class,$extraclass,$icon_source );
                    }

                } ?>

            <?php } ?>
		
		<?php } ?>
	</ul>
    <?php do_action( 'wcmamtx_after_account_navigation' ); ?>
</nav>

<?php } else { ?>


    <ul class="wcmamtx_vertical_menu">
        <?php foreach ( $wcmamtx_tabs as $key => $value ) { 

            if (isset($value['endpoint_name']) && ($value['endpoint_name'] != '')) {
                $name = $value['endpoint_name'];
            } else {
                $name = $value;
            }

            $should_show = 'yes';


            if (isset($value['visibleto']) && ($value['visibleto'] != "all")) {

                $allowedroles  = isset($value['roles']) ? $value['roles'] : "";

                $allowedusers  = isset($value['users']) ? $value['users'] : array();

                $is_visible    = wcmamtx_check_role_visibility($allowedroles,$value['visibleto'],$allowedusers);
                
            } else {

                $is_visible = 'yes';
            }



            if (isset($value['show']) && ($value['show'] == "no")) {
                
                 $should_show = 'no';
                
            }


            if (isset($value['class']) && ($value['class'] != '')) {
                $extraclass = str_replace(',',' ', $value['class']);
            } else {
                $extraclass = '';
            }

            if (isset($value['endpoint_key']) && ($value['endpoint_key'] != '')) {
                $key = $value['endpoint_key'];
            }

            if (isset($value['parent']) && ($value['parent'] != '')) {
                $parent = $value['parent'];
            } else {
                $parent = 'none';
            }


            
            $icon_source       = isset($value['icon_source']) ? $value['icon_source'] : "default";

            $hide_in_navigation = isset($value['hide_in_navigation']) && ($value['hide_in_navigation'] == "01") ? "enabled" : "disabled";

            if (isset($hide_in_navigation) && ($hide_in_navigation == "enabled")) {
                
                 $should_show = 'no';
                
            }

            if (($should_show == "yes") && ($is_visible == "yes")) {
            
                if (isset($value['wcmamtx_type']) && ($value['wcmamtx_type'] == "group")) {

                    
                    wcmamtx_get_account_menu_group_html( $name,$key ,$value ,$icon_extra_class,$extraclass,$icon_source );
                    
                    

            
                } else {

                    if ($parent == "none") {
                        wcmamtx_get_account_menu_li_html( $name,$key ,$value ,$icon_extra_class,$extraclass,$icon_source );
                    }

                } ?>

            <?php } ?>
        
        <?php } ?>
    </ul>


<nav class="woocommerce-MyAccount-navigation wsmt_extra_navclass <?php echo $menu_position_extra_class; ?>">

    <?php

    $show_avatar = 'yes';

    $avatar_settings = (array) get_option( 'wcmamtx_avatar_settings' );

    if (isset($avatar_settings['disable_avatar']) && ($avatar_settings['disable_avatar'] == "yes")) {

        $show_avatar = 'no';
    } else {
        $show_avatar = 'yes';
    }


    if ($show_avatar == 'yes') {
        echo do_shortcode('[sysBasics-user-avatar]');
    }

    $intro_text_hello = "yes";

    

    if (isset($avatar_settings['intro_text_hello']) && ($avatar_settings['intro_text_hello'] == "yes")) {

        $intro_text_hello = 'no';
    } else {
        $intro_text_hello = 'yes';
    }
    

    if ($intro_text_hello == "yes") { 

        global $current_user;
        wp_get_current_user();

        $allowed_html = array(
            'a' => array(
                'href' => array(),
            ),
        );


        ?>

        <div class="wcmamtx_intro_text">
            <span class="wcmamtx_intro_text1"><?php echo ucfirst($current_user->user_login); ?></span>
            
            <span class="wcmamtx_intro_text2">
                <?php
                printf(
                    /* translators: 1: user display name 2: logout url */
                    wp_kses( __( '<a href="%1$s">Log out</a>', 'customize-my-account-for-woocommerce' ), $allowed_html ),
                    esc_url( wc_logout_url() ),

                );
                ?>
            </span>
        </div>

        <?php
    }

    ?>
   

    <?php do_action( 'wcmamtx_after_account_navigation' ); ?>
</nav>


<?php } ?>
<?php do_action( 'woocommerce_after_account_navigation' ); ?>