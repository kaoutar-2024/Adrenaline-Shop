<?php



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

update_option('frontend_menu_items_updated',$items);



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


$menu_shape = 'horizontal';



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

    $wcmamtx_locals = array();

    $wcmamtx_plugin_options = (array) get_option('wcmamtx_plugin_options');

    

    wp_enqueue_script( 'wcmamtxfrontend', ''.wcmamtx_PLUGIN_URL.'assets/js/frontend.js',array( 'jquery'), false, true);
    
    wp_enqueue_style( 'wcmamtx-frontend', ''.wcmamtx_PLUGIN_URL.'assets/css/frontend.css' );
    wp_enqueue_style( 'wcmamtx-font-awesome', ''.wcmamtx_PLUGIN_URL.'assets/css/all.min.css' );
    wp_localize_script( 'wcmamtxfrontend', 'wcmamtxfrontend', $wcmamtx_locals );


    




    wp_enqueue_style( 'wcmamtx-frontend-unique', ''.wcmamtx_PLUGIN_URL.'assets/css/frontend-unique.css' );
    wp_enqueue_script( 'wcmamtx-frontend-unique', ''.wcmamtx_PLUGIN_URL.'assets/js/frontend-unique.js',array('jquery') );

    ?>
<style>
    li.woocommerce-MyAccount-navigation-link.wcmamtx_no_icon a::before {
    display: none !important;
}
li.woocommerce-MyAccount-navigation-link.wcmamtx_custom_icon a::before {
    display: none !important;
}



li.wcmamtx_custom_right.is-active i, li.wcmamtx_custom_right.is-active i{
   opacity: 1.0;
}

ul.wcmamtx_sub_level li{
    margin-left: 25px;
}

nav.woocommerce-MyAccount-navigation.wcmamtx_menu_right {
    float: right;
    margin-left: 25px;
    width: 15%;
}

nav.woocommerce-MyAccount-navigation.wcmamtx_menu_horizontal {
    width: 100%;
}

.large-9.col .woocommerce-MyAccount-navigation {
    display:none;
}

i.wcmamtx_custom_right {
    float: right;
}

i.wcmamtx_custom_left {
    padding-right: 20px;
}
.wcmtx-my-account-links {
    --wcmtx-col-lg: 3;
    --wcmtx-col-md: 2;
    --wcmtx-col-sm: 1;
    --wcmtx-gap-lg: 20px;
    margin-top: 30px;
}
.wcmtx-grid {
        --wcmtx-col: var(--wcmtx-col-lg, 12);
    --wcmtx-gap: var(--wcmtx-gap-lg, 30px);
    display: grid;
    grid-template-columns: repeat(var(--wcmtx-col), 1fr);
    gap: var(--wcmtx-gap);
}

.wcmtx-my-account-links a:hover {
    color: var(--color-gray-700);
    background-color: rgba(var(--bgcolor-black-rgb), 0.03);
}

.wcmtx-my-account-links a {
    display: block;
    padding: 20px;
    font-weight: 600;
    text-align: center;
    color: var(--color-gray-700);
    border-radius: var(--wcmtx-brd-radius);
    box-shadow: 0 0 4px rgba(0,0,0,0.18);
}

p.wcmtx_icon_src {
    font-size: 30px;
    max-height: 30px;
}

span.wcmtx_action_name {
    width: 60%;
    float: left;
    font-size: 8px;
}
span.wcmtx_action_html {
    width: 30%;
    float: right;
}

i.fa.fa-chevron-up.wcmamtx_group_fa,i.fa.fa-chevron-down.wcmamtx_group_fa {
    float: right;
}

li.woocommerce-MyAccount-navigation-link {
    list-style: none;
}

.wcmtx_action_html i.fa {
    margin-left: 2px;
}

li.woocommerce-MyAccount-navigation-link .dashicons{
    float: right !important;
}




.theme-astra p.wcmtx_icon_src .dashicons {
    margin-right: 30px;
    font-size: 40px;
    max-height: 30px;
}


.theme-astra.woocommerce-account ul.wcmamtx_vertical li.woocommerce-MyAccount-navigation-link {
    margin-left: -40px;
    border: 0px !important;
    font-size: 16px;
    width: 100%;
    background-color: #f7f7f7;
}

.theme-astra.woocommerce-account .wcmamtx_sub_level  li.woocommerce-MyAccount-navigation-link{
    margin-left: 0px !important;
    
}

.theme-astra.woocommerce-account .wcmamtx_sub_level  li.woocommerce-MyAccount-navigation-link.is-active{
    background-color: #f3f0f0 !important;
    
}



body .theme-astra.woocommerce-account .woocommerce-MyAccount-navigation-link {
    border:0px !important;
}

.theme-astra.woocommerce-account li.woocommerce-MyAccount-navigation-link.is-active a {
    background-color: #f3f0f0 !important;
}





.theme-generatepress p.wcmtx_icon_src .dashicons {
    margin-right: 30px;
    font-size: 40px;
    max-height: 30px;
}


.theme-generatepress.woocommerce-account li.woocommerce-MyAccount-navigation-link {
    margin-left: -40px;
    border: 0px !important;
    font-size: 16px;
    width: 100%;
    background-color: #f7f7f7;
}

.theme-generatepress.woocommerce-account .wcmamtx_sub_level  li.woocommerce-MyAccount-navigation-link{
    margin-left: 0px !important;
    
}

.theme-generatepress.woocommerce-account .wcmamtx_sub_level  li.woocommerce-MyAccount-navigation-link.is-active{
    background-color: #f3f0f0 !important;
    
}



body .theme-generatepress.woocommerce-account .woocommerce-MyAccount-navigation-link {
    border:0px !important;
}

.theme-generatepress.woocommerce-account li.woocommerce-MyAccount-navigation-link.is-active a {
    background-color: #f3f0f0 !important;
}

.theme-generatepress li.woocommerce-MyAccount-navigation-link {
    padding: 10px;
}


.theme-hello-elementor p.wcmtx_icon_src .dashicons {
    margin-right: 30px;
    font-size: 40px;
    max-height: 30px;
}


.theme-hello-elementor.woocommerce-account li.woocommerce-MyAccount-navigation-link {
    margin-left: -40px;
    border: 0px !important;
    font-size: 16px;
    width: 100%;
    background-color: #f7f7f7;
}

.theme-hello-elementor.woocommerce-account .wcmamtx_sub_level  li.woocommerce-MyAccount-navigation-link{
    margin-left: 0px !important;
    
}

.theme-hello-elementor.woocommerce-account .wcmamtx_sub_level  li.woocommerce-MyAccount-navigation-link.is-active{
    background-color: #f3f0f0 !important;
    
}



body .theme-hello-elementor.woocommerce-account .woocommerce-MyAccount-navigation-link {
    border:0px !important;
}

.theme-hello-elementor.woocommerce-account li.woocommerce-MyAccount-navigation-link.is-active a {
    background-color: #f3f0f0 !important;
}

.theme-hello-elementor li.woocommerce-MyAccount-navigation-link {
    padding: 10px;
}


.theme-storefront a.woocommerce-MyAccount-navigation-link_a i.fa-file-alt:before {
    display: none !important;
}






li.wcmamtx_group2.woocommerce-MyAccount-navigation-link.open {
    border: 0px !important;
}
.theme-storefront li.wcmamtx_group2 a:before {
    display: none !important;
}

.theme-storefront li.woocommerce-MyAccount-navigation-link a:before {
    display:none;
}

.theme-flatsome ul.dashboard-links {
    display: none;
}

.theme-woodmart .wd-my-account-links.wd-grid {
    display: none;
}

.woocommerce-MyAccount-navigation-link i.fa.fa-file-alt {
    float: right;
}

.theme-Impreza nav.woocommerce-MyAccount-navigation.wsmt_extra_navclass.wcmamtx_menu_left {
    /* margin-top: 40px; */
    margin-left: 60px;
}

a.woocommerce-MyAccount-navigation-link_a i.fa {
    float: right;
}

.theme-blocksy a.woocommerce-MyAccount-navigation-link_a::before {
    display: none;
}

.theme-blocksy a.woocommerce-MyAccount-navigation-link_a i.fa {
    margin-right:5px;
}

.theme-spectra-one nav.woocommerce-MyAccount-navigation {
    padding-right: 10px;
    font-size: 14px;
}

.theme-spectra-one .wcmtx-my-account-links a {
    font-size: 12px;
}

.woocommerce-MyAccount-navigation img.wcmamtx_upload_image_icon {
    float: right;
    width: 20px;
    height: 20px;
}

.wcmtx-my-account-links img.wcmamtx_upload_image_icon {
    width: 50px;
    height: 50px;
    /* float: left; */
    /* margin-left: 50px; */
}

.theme-storefront img.wcmamtx_upload_image_icon {
    margin-left: 80px;
}

@media screen and (min-width: 800px) {
   .theme-flatsome nav.woocommerce-MyAccount-navigation {
    float: left;
    width: 25%;
    margin-right: 30px;
   }
}

.theme-flatsome div.woocommerce-MyAccount-content {
    width: 70%;
    float: left !important;
}

.woocommerce-account .woocommerce .woocommerce-MyAccount-content p {
    margin-bottom: 20px !important;
}

.theme-rehub-theme a.woocommerce-MyAccount-navigation-link_a::before {
    display: none !important;
}

.theme-oceanwp a.woocommerce-MyAccount-navigation-link_a::before {
    display: none !important;
}

.theme-neve i.fa {
    margin-top: 5px;
    margin-left: 5px;
}

.theme-woodmart .wcmtx-my-account-links.wcmtx-grid {
    display: none;
}

/* The wcmamtx_modal (background) */
.wcmamtx_modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* wcmamtx_modal Content/Box */
.wcmamtx_modal-content {
  background-color: #fefefe;
  margin: 15% auto; /* 15% from the top and centered */
  padding: 20px;
  border: 1px solid #888;
  width: 50%; /* Could be more or less, depending on screen size */
}

/* The Close Button */
span.wcmamtx_modal_close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

span.wcmamtx_modal_close:hover,
span.wcmamtx_modal_close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

.wcmamtx_upload_div {
    /* padding-right: 20px; */
    width: 50%;
    padding: 10px;
}



.wcmamtx_modal-content img {
  
    float: left;
    width: 10%;
    margin-right: 20px;
}

.wcmamtx_upload_div img:after {
    content: "";
    display: block;
    position: absolute;
    right: -5px;
    bottom: -10px;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    background: url(../images/photo.svg) #29ac8f no-repeat;
    background-position: 8px 9px;
    background-size: 18px;
}

.wcmamtx_upload_div {
   
    width: 100%;
    font-size: 12px;
}



.wcmamtx_upload_div {
  position: relative;
  top: 0;
  left: 0;
}
.wcmamtx_upload_div .avatar {
      border-radius: 10%;
    border: 4px dotted #f3eded;
    outline: 2px solid #352e2e;
    position: relative;
    top: 0;
    left: 0;
  
}
.wcmamtx_upload_div .camera {
    position: absolute;
    bottom: 25px;
    left: 30px;
    background-color: white;
}

.wcmamtx_dashboard_link {
    background-color: #e9e9ef;
    border: 1px solid #ac9d9d;
    border-radius: 5%;
}

div.wcmtx-my-account-links a:hover {
    border: 1px solid #eadddd;
    background-color: white;
    border-radius: 5%;
}

span.wcmamtx_intro_text1 {
    height: 20%;
    max-height: 20%;
    width: 20%;
    margin-left: 35%;
    font-weight: bold;
    font-style: italic;
}

span.wcmamtx_intro_text2 {
    height: 20%;
    max-height: 20%;
    width: 20%;
    margin-left: 35%;
    font-weight: bold;
    font-style: italic;
    float: left;
}

.wcmamtx_intro_text {
    width: 100%;
    height: 60px;
    min-height: 60px;
}

span.wcmamtx_intro_text2 a {
    font-size: 12px;
    background-color: #d0c6c6;
    padding: 5px;
    border-radius: 5px;
    color: #ffffff;
}



ul.wcmamtx_vertical_menu img {
    height: 20px;
    width: 20px;
}

ul.wcmamtx_vertical_menu li.woocommerce-MyAccount-navigation-link {
    margin-left: 0px; 

}

ul.wcmamtx_vertical_menu img {
    float: right;
    width: 18px;
    height: 18px;
    margin-top: 5px;
    margin-left: 5px;
}

ul.wcmamtx_vertical_menu a.woocommerce-MyAccount-navigation-link_a i.fa {
    margin-top: 5px;
    margin-left: 5px;
}

ul.wcmamtx_vertical_menu li{
    margin-left: 10px;
    padding: 5px;
    background-color: #f1f0f0;
}

ul.wcmamtx_vertical_menu li.woocommerce-MyAccount-navigation-link {
    margin-left: 10px;
    padding: 10px;
    margin-bottom: 20px;
}

li.woocommerce-MyAccount-navigation-link.active {
    background-color: #d2d2d2;
}

ul.wcmamtx_vertical_menu li {
    list-style: none !important;
}

ul.wcmamtx_vertical_menu li {
    min-width: 140px;
}

ul.wcmamtx_vertical_menu li.wcmamtx_group2  {
    max-width: 160px;
}

span.wcmamtx_intro_text2 {
    min-width: 100px;
}

ul.wcmamtx_vertical_menu li.is-active {
    color: white;
    background-color: #d2d2ff;
}

.theme-the-fashion-woocommerce ul.wcmamtx_vertical_menu {
    margin-bottom: 20px;
}



li.wcmamtx_group2.open ul.sub-menu {
    display: block !important;
}

ul.wcmamtx_vertical_menu li {
    font-size: 14px;
}

ul.sub-menu.nav-dropdown.nav-dropdown-default {
    margin-top: 20px;
    margin-right: -10px;
}
ul.wcmamtx_vertical_menu {
    max-width: 100%;
}

ul.wcmamtx_vertical_menu li {
    font-size: 12px;
    display: inline-block;
}



.theme-astra ul.wcmamtx_vertical_menu li {
    font-size: 10px;
    display: inline-block;
}



ul.wcmamtx_vertical_menu ul.sub-menu.nav-dropdown.nav-dropdown-default {
    /* display: none; */
    position: absolute;

    /* background-color: red; */
    width: 100%;
    z-index: 1;
}

ul.wcmamtx_vertical_menu li.woocommerce-MyAccount-navigation-link {
    /* margin-left: 10px; */
    padding: 10px;
    margin-bottom: 5px;
    background-color: #eae7e7;
}

ul.wcmamtx_vertical_menu li.is-active {
    color: white;
    background-color: #d8d8ed;
}

.theme-neve .wcmamtx_intro_text {
    width: 30% !important;
}
</style>
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