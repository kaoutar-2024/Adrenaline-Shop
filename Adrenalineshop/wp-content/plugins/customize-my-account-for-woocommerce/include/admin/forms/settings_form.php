<?php 
$advancedsettings  = (array) get_option('wcmamtx_advanced_settings');  

$tabs              = wc_get_account_menu_items();

$core_fields       = 'dashboard,orders,downloads,edit-address,edit-account,customer-logout';



$core_fields_array =  array(
    'orders'          => get_option( 'woocommerce_myaccount_orders_endpoint', 'orders' ),
    'downloads'       => get_option( 'woocommerce_myaccount_downloads_endpoint', 'downloads' ),
    'edit-address'    => get_option( 'woocommerce_myaccount_edit_address_endpoint', 'edit-address' ),
    'payment-methods' => get_option( 'woocommerce_myaccount_payment_methods_endpoint', 'payment-methods' ),
    'edit-account'    => get_option( 'woocommerce_myaccount_edit_account_endpoint', 'edit-account' ),
    'customer-logout' => get_option( 'woocommerce_logout_endpoint', 'customer-logout' ),
  );

$tabs                = apply_filters( 'woocommerce_account_menu_items', $tabs, $core_fields_array );

$frontend_menu_items = get_option('wcmamtx_frontend_items');



if (isset($frontend_menu_items) && is_array($frontend_menu_items)) {
    $tabs = $frontend_menu_items;
}







if ((sizeof($advancedsettings) != 1)) {

  foreach ($tabs as $ikey=>$ivalue) {

    $match = wcmtxka_find_string_match_pro($ikey,$advancedsettings);

    if (!array_key_exists($ikey, $advancedsettings) && !array_key_exists($ikey, $core_fields_array) && ($match == "notfound")) {

      

      $advancedsettings[$ikey] = array(
        'show' => 'yes',
        'third_party' => 'yes',
        'endpoint_key' => $ikey,
        'wcmamtx_type' => 'endpoint',
        'parent'       => 'none',
        'endpoint_name'=> $ivalue,
      );           

    }
  }

  $frontend_menu_items_updated = get_option('frontend_menu_items_updated');



  foreach ($frontend_menu_items_updated as $zkey=>$zvalue) {

    $match = wcmtxka_find_string_match_pro($zkey,$advancedsettings);

    if (!array_key_exists($zkey, $advancedsettings) && !array_key_exists($zkey, $core_fields_array) && ($match == "notfound")) {

      

      $advancedsettings[$zkey] = array(
        'show' => 'yes',
        'third_party' => 'yes',
        'endpoint_key' => $zkey,
        'wcmamtx_type' => 'endpoint',
        'parent'       => 'none',
        'endpoint_name'=> $zvalue,
      );           

    }
  }

  


}
      


      

      if (!isset($advancedsettings) || (sizeof($advancedsettings) == 1)) {
        ?>
        <ol class="accordion wcmamtx-accordion" style="display:none;">
            <?php
                $rownum = 0;
                foreach ($tabs as $key=>$value) {

                    if (preg_match('/\b'.$key.'\b/', $core_fields )) { 

                        $third_party = null;

                    } else {

                        $third_party = 'yes';

                    }

                    
                    
                    $this->get_accordion_content($key,$value,$core_fields,$value,null,$third_party); 
                    $rownum++;

                }
        ?>
        </ol><?php
      
      } else {

        ?>
        <ol class="accordion wcmamtx-accordion" style="display:none;">
            <?php
                $rownum = 0;
                foreach ($advancedsettings as $key=>$value) {

                    

                    $name = isset($value['endpoint_name']) ? $value['endpoint_name'] : "";

                    $third_party = isset($value['third_party']) ? $value['third_party'] : null;



                    if (isset($value['parent']) && ($value['parent'] == "none")) {

                        $this->get_accordion_content($key,$name,$core_fields,$value,null,$third_party);
                    } 
                
                    $rownum++;

                }
        ?></ol><?php
      }
    ?>
        <script>
            var wmthash=<?php echo $rownum; ?>;
        </script>
        <div id="iconPicker" class="modal fade">
              <div class="modal-dialog">
                    <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  <h4 class="modal-title"><?php  echo esc_html__('Icon Picker','customize-my-account-for-woocommerce'); ?></h4>
                          </div>
                          <div class="modal-body">
                              <div>
                                  <ul class="icon-picker-list">
                                    <li>
                                      <a data-class="{{item}} {{activeState}}" data-index="{{index}}">
                                        <span class="{{item}}"></span>
                                         <span class="name-class">{{item}}</span>
                                      </a>
                                    </li>
                                  </ul>
                              </div>
                          </div>
                          <div class="modal-footer">
                                <button type="button" id="change-icon" class="btn btn-success">
                                  <span class="fa fa-check-circle-o"></span>
                                  <?php  echo esc_html__('Use Selected Icon','customize-my-account-for-woocommerce'); ?>
                                </button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                          </div>
                    </div>
              </div>
        </div>


