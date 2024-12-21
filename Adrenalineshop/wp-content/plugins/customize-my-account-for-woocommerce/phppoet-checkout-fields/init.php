<?php



 if( !defined( 'syscmafwpl_PLUGIN_URL' ) )
define( 'syscmafwpl_PLUGIN_URL', plugin_dir_url( __FILE__ ) );


include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if (is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
	
  include dirname( __FILE__ ) . '/include/core_functions.php';
  include dirname( __FILE__ ) . '/include/add_order_meta_fields_class.php';
  include dirname( __FILE__ ) . '/include/manage_extrafield_class.php';
  include dirname( __FILE__ ) . '/include/admin/admin_settings.php';
  //include dirname( __FILE__ ) . '/easy-checkout-file-upload/easy-checkout-file-upload.php';

}
?>