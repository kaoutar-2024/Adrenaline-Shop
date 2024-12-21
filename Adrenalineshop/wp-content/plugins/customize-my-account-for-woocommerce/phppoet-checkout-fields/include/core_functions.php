<?php

if (! function_exists('syscmafwpl_get_datepicker_format_from_option')) {

	 /**
	 * Outputs a installed woocommerce version
	 *
	 * @access public
	 * @subpackage	Forms
	 */

	 function syscmafwpl_get_datepicker_format_from_option($date_format) {

	 	$date_format_e = 'd/m/Y';

         switch($date_format) {

			 	case 01:
			 	   $date_format_e = 'd/m/Y';
			 	break;

			 	case 02:
			 	   $date_format_e = 'd/m/Y';
			 	break;

			 	case 03:
			 	   $date_format_e = 'd/m/Y';
			 	break;

			 	case 04:
			 	   $date_format_e = 'd/m/Y';
			 	break;

			 	case 05:
			 	   $date_format_e = 'd/m/Y';
			 	break;

			 	case 06:
			 	   $date_format_e = 'd/m/Y';
			 	break;



                default:
                    $date_format_e = 'd/m/Y';
                break;

	    }

	    return $date_format_e;
	}

}





if (! function_exists('syscmafwpl_easy_checkout_get_fees_type')) {

	 /**
	 * Outputs a installed woocommerce version
	 *
	 * @access public
	 * @subpackage	Forms
	 */

	 function syscmafwpl_easy_checkout_get_fees_type() {
         
         $fees_types = array(
	 		"0"=>array(
	 		    'value'=>01,
	 		    'text'=> __('Add or Deduct Fixed Amount or Fixed Percentage','customize-my-account-for-woocommerce')
	 		   

	 	    ),
	 	    "1"=>array(
	 		    'value'=>02,
	 		    'text'=> __('Give Discount equal to price of product','customize-my-account-for-woocommerce')
	 		   

	 	    ),
	 	    "2"=>array(
	 		    'value'=>03,
	 		    'text'=> __('Add certain fee for each product','customize-my-account-for-woocommerce')
	 		   

	 	    )

	 	   
	 	);
	 	return apply_filters('syscmafwpl_override_fees_types',$fees_types);

	 }

}

if (! function_exists('syscmafwpl_display_each_dynamic_row2')) {

	 /**
	 * Outputs a installed woocommerce version
	 *
	 * @access public
	 * @subpackage	Forms
	 */

	 function syscmafwpl_display_each_dynamic_row2($dynamickey,$dynamicvalue,$key,$slug) {

	 	

	 	$selected = isset($dynamicvalue['rule_type']) ? $dynamicvalue['rule_type'] : "";

	 	$selected_compare = isset($dynamicvalue['rule_type_compare']) ? $dynamicvalue['rule_type_compare'] : "";

	 	$selected_contains = isset($dynamicvalue['rule_type_contains']) ? $dynamicvalue['rule_type_contains'] : "";
        
        $checked_text = isset($dynamicvalue['enabled']) && ($dynamicvalue['enabled'] == "yes") ? 'checked' : "";

        $rule_type_number =  isset($dynamicvalue['rule_type_number']) ? $dynamicvalue['rule_type_number'] : "";

        $rule_type_products = isset($dynamicvalue['rule_type_products']) ? $dynamicvalue['rule_type_products'] : array();
        
        $chosencategories   = isset($dynamicvalue['rule_type_categories']) ? $dynamicvalue['rule_type_categories'] : array();

        $chosenroles        = isset($dynamicvalue['rule_type_roles']) ? $dynamicvalue['rule_type_roles'] : array();

        $default_label      = isset($dynamicvalue['label']) ?  $dynamicvalue['label'] : '';

        global $wp_roles;

        if ( ! isset( $wp_roles ) ) { 
    	    $wp_roles = new WP_Roles();  
        }
	
	    $roles = $wp_roles->roles;
        






        $catargs = array(
	      'orderby'                  => 'name',
	      'taxonomy'                 => 'product_cat',
	      'hide_empty'               => 0
	    );
		 
	  
		$categories           = get_categories( $catargs );  

       

	 	?>
           
        <div class="conditional-row conditional_row_<?php echo $dynamickey; ?>_<?php echo $key; ?>">
        	<span class="syscmafwpl_sortable_tr_handle_dynamic dashicons dashicons-menu"></span>&nbsp;
        	<input type="hidden" class="rule_enabled_checkbox" name="syscmafwpl_forms_settings[<?php echo $key; ?>][dynamic_rules][<?php echo $dynamickey; ?>][label]" value="<?php echo $default_label; ?>">
            
            <span class="syscmafwpl_field_label_fields">
            	<?php echo esc_html($default_label); ?>
            </span>         

        	<span class="dashicons dashicons-remove syscmafwpl-remove-condition-dynamic"></span>
        </div>

        <?php

	 }

}


if (! function_exists('syscmafwpl_display_each_dynamic_row')) {

	 /**
	 * Outputs a installed woocommerce version
	 *
	 * @access public
	 * @subpackage	Forms
	 */

	 function syscmafwpl_display_each_dynamic_row($dynamickey,$dynamicvalue,$key,$slug) {

	 	$selected = isset($dynamicvalue['rule_type']) ? $dynamicvalue['rule_type'] : "";

	 	$selected_compare = isset($dynamicvalue['rule_type_compare']) ? $dynamicvalue['rule_type_compare'] : "";

	 	$selected_contains = isset($dynamicvalue['rule_type_contains']) ? $dynamicvalue['rule_type_contains'] : "";
        
        $checked_text = isset($dynamicvalue['enabled']) && ($dynamicvalue['enabled'] == "yes") ? 'checked' : "";

        $rule_type_number =  isset($dynamicvalue['rule_type_number']) ? $dynamicvalue['rule_type_number'] : "";

        $rule_type_products = isset($dynamicvalue['rule_type_products']) ? $dynamicvalue['rule_type_products'] : array();
        
        $chosencategories   = isset($dynamicvalue['rule_type_categories']) ? $dynamicvalue['rule_type_categories'] : array();

        $chosenroles        = isset($dynamicvalue['rule_type_roles']) ? $dynamicvalue['rule_type_roles'] : array();

        global $wp_roles;

        if ( ! isset( $wp_roles ) ) { 
    	    $wp_roles = new WP_Roles();  
        }
	
	    $roles = $wp_roles->roles;
        

        switch($selected) {
        	case "cart__quantity":
        	    $row_mode = 'quantity';
        	    $filter_mode = 'none';
        	break;

        	case "cart__count":
        	    $row_mode = 'quantity';
        	    $filter_mode = 'none';
        	break;

        	case "cart__weight":
        	    $row_mode = 'quantity';
        	    $filter_mode = 'none';
        	break;

        	case "cart_items__products":
        	    $row_mode = 'contains';
        	    $filter_mode  = 'products';
        	break;


        	case "cart_items__product_categories":
        	    $row_mode = 'contains';
        	    $filter_mode  = 'categories';
        	break;

        	case "user_role":
        	    $row_mode = 'contains';
        	    $filter_mode  = 'roles';
        	break;

        	case "customer_total_spent":
        	    $row_mode = 'quantity';
        	    $filter_mode  = 'none';
        	break;

        	case "customer_order_count":
        	    $row_mode = 'quantity';
        	    $filter_mode  = 'none';
        	break;

        	default:
        	    $row_mode = 'quantity';
        	    $filter_mode  = 'products';
        	break;
        }





        $catargs = array(
	      'orderby'                  => 'name',
	      'taxonomy'                 => 'product_cat',
	      'hide_empty'               => 0
	    );
		 
	  
		$categories           = get_categories( $catargs );  

       

	 	?>
           
        <div class="conditional-row conditional_row_<?php echo $dynamickey; ?>_<?php echo $key; ?>">
        	<span class="syscmafwpl_sortable_tr_handle_dynamic dashicons dashicons-menu"></span>&nbsp;
        	<input type="checkbox" class="rule_enabled_checkbox" name="<?php echo $slug; ?>[<?php echo $key; ?>][dynamic_rules][<?php echo $dynamickey; ?>][enabled]" value="yes" <?php echo $checked_text; ?>>
        	<select mtype="<?php echo $slug; ?>" mntext="<?php echo $dynamickey; ?>" mnkey="<?php echo $key; ?>" class="checkout_field_dynamic_rule_type checkout_field_dynamic_rule_type_<?php echo $dynamickey; ?>_<?php echo $key; ?>" name="<?php echo $slug; ?>[<?php echo $key; ?>][dynamic_rules][<?php echo $dynamickey; ?>][rule_type]">
        		

        		<?php echo syscmafwpl_get_dynamic_rule_types_select_optionhtml($selected); ?>
        	</select>

        	<select style="<?php if ($row_mode == "quantity") { echo 'display: inline-grid;'; } else { echo 'display:none;'; } ?>" mtype="<?php echo $slug; ?>" mntext="<?php echo $dynamickey; ?>" mnkey="<?php echo $key; ?>" class="show_if_quantity_rule checkout_field_dynamic_rule_type_compare checkout_field_dynamic_rule_type_compare_<?php echo $dynamickey; ?>_<?php echo $key; ?>" name="<?php echo $slug; ?>[<?php echo $key; ?>][dynamic_rules][<?php echo $dynamickey; ?>][rule_type_compare]">
        		

        		<?php echo syscmafwpl_get_dynamic_rule_types_compare_optionhtml($selected_compare); ?>
        	</select>
            
			

        	<select style="<?php if (isset($filter_mode) && ($filter_mode  == 'roles') ) { echo 'display:none !important;'; } if ($row_mode == "contains") { echo 'display: inline-grid;'; } else { echo 'display:none;'; } ?>" mtype="<?php echo $slug; ?>" mntext="<?php echo $dynamickey; ?>" mnkey="<?php echo $key; ?>" class="show_if_contains_rule checkout_field_dynamic_rule_type_contains checkout_field_dynamic_rule_type_contains_<?php echo $dynamickey; ?>_<?php echo $key; ?>" name="<?php echo $slug; ?>[<?php echo $key; ?>][dynamic_rules][<?php echo $dynamickey; ?>][rule_type_contains]">
        		

        		    <?php echo syscmafwpl_get_dynamic_rule_types_contains_optionhtml($selected_contains); ?>
        	</select>

			

        	&nbsp;

        	<span style="<?php if ($row_mode == "quantity") { echo 'display: inline-grid;'; } else { echo 'display:none;'; } ?>" class="show_if_quantity_rule">

        		 <input   mtype="<?php echo $slug; ?>" mntext="<?php echo $dynamickey; ?>" mnkey="<?php echo $key; ?>" type="number" class=" checkout_field_dynamic_rule_number checkout_field_dynamic_rule_number_<?php echo $dynamickey; ?>_<?php echo $key; ?>" name="<?php echo $slug; ?>[<?php echo $key; ?>][dynamic_rules][<?php echo $dynamickey; ?>][rule_type_number]" value="<?php echo $rule_type_number; ?>">

        	</span>


        	<span style="<?php if ($row_mode == "contains") { echo 'display:inline-grid;'; } else { echo 'display:none;'; } ?>" class="show_if_contains_rule">
                   

			    <span  class="checkout_field_products_span" style="<?php if ($filter_mode == "products") { echo 'display:inline-grid;'; } else { echo 'display:none;'; } ?>">
        		
			        <select  mtype="<?php echo $slug; ?>" mntext="<?php echo $dynamickey; ?>" mnkey="<?php echo $key; ?>" class="checkout_field_products" data-placeholder="<?php echo esc_html__('Choose Products','customize-my-account-for-woocommerce'); ?>" name="<?php echo $slug; ?>[<?php echo $key; ?>][dynamic_rules][<?php echo $dynamickey; ?>][rule_type_products][]" multiple>
			   		<?php if (isset($rule_type_products) && (!empty($rule_type_products))) { ?>
			   			<?php foreach ($rule_type_products as $uniquekey => $unique_id) { ?>
			   				<option value="<?php echo $unique_id; ?>" selected>#<?php echo $unique_id; ?>- <?php echo get_the_title($unique_id); ?></option>
			   			<?php } ?>
			   		<?php  } ?>
			   	    </select>

				</span>

				<span  class="checkout_field_category_span" style="<?php if ($filter_mode == "categories") { echo 'display:inline-grid;'; } else { echo 'display:none;'; } ?>">
        		

			   	    <select  mtype="<?php echo $slug; ?>" mntext="<?php echo $dynamickey; ?>" mnkey="<?php echo $key; ?>"  class="checkout_field_category" data-placeholder="<?php echo esc_html__('Choose Categories','customize-my-account-for-woocommerce'); ?>" name="<?php echo $slug; ?>[<?php echo $key; ?>][dynamic_rules][<?php echo $dynamickey; ?>][rule_type_categories][]"  multiple>
                            <?php foreach ($categories as $category) { ?>
				                <option value="<?php echo $category->term_id; ?>" <?php if (in_array($category->term_id, $chosencategories)) { echo "selected"; } ?>>#<?php echo $category->term_id; ?>- <?php echo $category->name; ?></option>
				            <?php } ?>
                    </select>

			    </span>


				<span  class="checkout_field_roles_span" style="<?php if ($filter_mode == "roles") { echo 'display:inline-grid;'; } else { echo 'display:none;'; } ?>">


			        <select mtype="<?php echo $slug; ?>" mntext="<?php echo $dynamickey; ?>" mnkey="<?php echo $key; ?>" class="checkout_field_role" data-placeholder="<?php echo esc_html__('Choose Roles','customize-my-account-for-woocommerce'); ?>" name="<?php echo $slug; ?>[<?php echo $key; ?>][dynamic_rules][<?php echo $dynamickey; ?>][rule_type_roles][]"  multiple>
                            <?php foreach ($roles as $rkey=>$rvalue) { ?>
				                 <option value="<?php echo $rkey; ?>" <?php if (in_array($rkey, $chosenroles)) { echo "selected"; } ?>><?php echo $rvalue['name']; ?></option>
				            <?php } ?>
                    </select>
                
				</span>


        	</span>
            
           

        	<span class="dashicons dashicons-remove syscmafwpl-remove-condition-dynamic"></span>
        </div>

        <?php

	 }

}


if (! function_exists('syscmafwpl_get_dynamic_rule_types_contains_optionhtml')) {

	 /**
	 * Outputs a installed woocommerce version
	 *
	 * @access public
	 * @subpackage	Forms
	 */

	 function syscmafwpl_get_dynamic_rule_types_contains_optionhtml($selected_compare = NULL) {

	 	 $equality_types = array(
	 		array(
	 		    'value'=>'contains_any',
	 		    'text'=> __('Contains Any','customize-my-account-for-woocommerce')
	 		   

	 	    ),

	 	    array(
	 		    'value'=>'contains_all',
	 		    'text'=> __('Contains All','customize-my-account-for-woocommerce')
	 		   

	 	    ),

	 	    array(
	 		    'value'=>'does_not_contain_any',
	 		    'text'=> __('Does not Contains Any','customize-my-account-for-woocommerce')
	 		   

	 	    ),

	 	    array(
	 		    'value'=>'does_not_contain_all',
	 		    'text'=> __('Does not contains all','customize-my-account-for-woocommerce')
	 		   

	 	    ),

	 	   

	 	   
	 	);

	 	$options_html ='';

	 	foreach ($equality_types as $okey=>$ovalue) {

	 		$selected_text = isset($selected_compare) && ($selected_compare == $ovalue['value']) ? "selected" : "";

	 		$options_html .='<option value="'.$ovalue['value'].'" '.$selected_text.'>'.$ovalue['text'].'</option>';

	 	}



	 	

	 	 return $options_html;

	 }

}

if (! function_exists('syscmafwpl_get_dynamic_rule_types_compare_optionhtml')) {

	 /**
	 * Outputs a installed woocommerce version
	 *
	 * @access public
	 * @subpackage	Forms
	 */

	 function syscmafwpl_get_dynamic_rule_types_compare_optionhtml($selected_compare = NULL) {

	 	 $equality_types = array(
	 		array(
	 		    'value'=>'less_than',
	 		    'text'=> __('Less than','customize-my-account-for-woocommerce')
	 		   

	 	    ),

	 	    array(
	 		    'value'=>'greater_than',
	 		    'text'=> __('Greater Than','customize-my-account-for-woocommerce')
	 		   

	 	    ),

	 	    array(
	 		    'value'=>'greater_than_equal_to',
	 		    'text'=> __('Greater than or equalto','customize-my-account-for-woocommerce')
	 		   

	 	    ),

	 	   
	 	);

	 	$options_html ='';

	 	foreach ($equality_types as $okey=>$ovalue) {

	 		$selected_text = isset($selected_compare) && ($selected_compare == $ovalue['value']) ? "selected" : "";

	 		$options_html .='<option value="'.$ovalue['value'].'" '.$selected_text.'>'.$ovalue['text'].'</option>';

	 	}



	 	

	 	 return $options_html;

	 }

}

if (! function_exists('syscmafwpl_get_dynamic_rule_types_select_optionhtml')) {

	 /**
	 * Outputs a installed woocommerce version
	 *
	 * @access public
	 * @subpackage	Forms
	 */

	 function syscmafwpl_get_dynamic_rule_types_select_optionhtml($selected = NULL) {

	 	 $cart_options = syscmafwpl_get_dynamic_rule_types_cart();
	 	 $cart_options_items = syscmafwpl_get_dynamic_rule_types_cart_items();
	 	 $cart_options_user = syscmafwpl_get_dynamic_rule_types_user();
	 	 $cart_options_customer = syscmafwpl_get_dynamic_rule_types_customer();

	 	 $options_html ='';

	 	 $options_html .='<optgroup label="'.__('Cart','customize-my-account-for-woocommerce').'">';

	 	 foreach ($cart_options as $cvalue) {

	 	 	$selected_text = isset($selected) && ($selected == $cvalue['value']) ? "selected" : "";

	 	 	$options_html .='<option value="'.$cvalue['value'].'" '.$selected_text.'>'.$cvalue['text'].'</option>';

	 	 }

	 	 $options_html .='</optgroup>';

	 	 $options_html .='<optgroup label="'.__('Cart Items','customize-my-account-for-woocommerce').'">';

	 	 foreach ($cart_options_items as $cvalue2) {

	 	 	$selected_text = isset($selected) && ($selected == $cvalue2['value']) ? "selected" : "";

	 	 	$options_html .='<option value="'.$cvalue2['value'].'" '.$selected_text.'>'.$cvalue2['text'].'</option>';
	 	 	
	 	 }

	 	 $options_html .='</optgroup>';

	 	 $options_html .='<optgroup label="'.__('User','customize-my-account-for-woocommerce').'">';

	 	 

	 	 foreach ($cart_options_user as $cvalue3) {

	 	 	$selected_text = isset($selected) && ($selected == $cvalue3['value']) ? "selected" : "";

	 	 	$options_html .='<option value="'.$cvalue3['value'].'" '.$selected_text.'>'.$cvalue3['text'].'</option>';
	 	 	
	 	 }

	 	 $options_html .='</optgroup>';


	 	 $options_html .='<optgroup label="'.__('Customer','customize-my-account-for-woocommerce').'">';

	 	 

	 	 foreach ($cart_options_customer as $cvalue4) {

	 	 	$selected_text = isset($selected) && ($selected == $cvalue4['value']) ? "selected" : "";

	 	 	$options_html .='<option value="'.$cvalue4['value'].'" '.$selected_text.'>'.$cvalue4['text'].'</option>';
	 	 	
	 	 }

	 	 $options_html .='</optgroup>';
	 	 

	 	 return $options_html;

	 }

}


if (! function_exists('syscmafwpl_get_dynamic_rule_types_cart')) {

	 /**
	 * Outputs a installed woocommerce version
	 *
	 * @access public
	 * @subpackage	Forms
	 */

	 function syscmafwpl_get_dynamic_rule_types_cart() {

	 	$visibility_types = array(
	 		array(
	 		    'value'=>'cart__quantity',
	 		    'text'=> __('Cart total quantity','customize-my-account-for-woocommerce')
	 		   

	 	    ),

	 	    array(
	 		    'value'=>'cart__count',
	 		    'text'=> __('Cart item count','customize-my-account-for-woocommerce')
	 		   

	 	    ),

	 	    array(
	 		    'value'=>'cart__weight',
	 		    'text'=> __('Cart total weight','customize-my-account-for-woocommerce')
	 		   

	 	    ),

	 	   
	 	);
	 	return apply_filters('syscmafwpl_override_rule_types_cart',$visibility_types);
	 }
}

if (! function_exists('syscmafwpl_get_dynamic_rule_types_cart_items')) {

	 /**
	 * Outputs a installed woocommerce version
	 *
	 * @access public
	 * @subpackage	Forms
	 */

	 function syscmafwpl_get_dynamic_rule_types_cart_items() {

	 	$visibility_types = array(
	 		array(
	 		    'value'=>'cart_items__products',
	 		    'text'=> __('Cart items - Products','customize-my-account-for-woocommerce')
	 		   

	 	    ),


	 	    array(
	 		    'value'=>'cart_items__product_categories',
	 		    'text'=> __('Cart items - Categories','customize-my-account-for-woocommerce')
	 		   

	 	    ),

	 	   
	 	);
	 	return apply_filters('syscmafwpl_override_rule_types_cart_items',$visibility_types);
	 }
}


if (! function_exists('syscmafwpl_get_dynamic_rule_types_user')) {

	 /**
	 * Outputs a installed woocommerce version
	 *
	 * @access public
	 * @subpackage	Forms
	 */

	 function syscmafwpl_get_dynamic_rule_types_user() {

	 	$visibility_types = array(
	 		array(
	 		    'value'=>'user_role',
	 		    'text'=> __('User Role','customize-my-account-for-woocommerce')
	 		   

	 	    )

	 	   
	 	);
	 	return apply_filters('syscmafwpl_override_rule_types_cart_items',$visibility_types);
	 }
}


if (! function_exists('syscmafwpl_get_dynamic_rule_types_customer')) {

	 /**
	 * Outputs a installed woocommerce version
	 *
	 * @access public
	 * @subpackage	Forms
	 */

	 function syscmafwpl_get_dynamic_rule_types_customer() {

	 	$visibility_types = array(
	 		array(
	 		    'value'=>'customer_total_spent',
	 		    'text'=> __('Total Spent','customize-my-account-for-woocommerce')
	 		   

	 	    ),

            array(
	 		    'value'=>'customer_order_count',
	 		    'text'=> __('Order Count','customize-my-account-for-woocommerce')
	 		   

	 	    )
	 	   
	 	);
	 	return apply_filters('syscmafwpl_override_rule_types_cart_items',$visibility_types);
	 }
}

if (! function_exists('syscmafwpl_get_dynamic_rule_types_cart_items_quantity')) {

	 /**
	 * Outputs a installed woocommerce version
	 *
	 * @access public
	 * @subpackage	Forms
	 */

	 function syscmafwpl_get_dynamic_rule_types_cart_items_quantity() {

	 	$visibility_types = array(
	 		array(
	 		    'value'=>'cart_items__products',
	 		    'text'=> __('Cart item quantity - Products','customize-my-account-for-woocommerce')
	 		   

	 	    ),

	 	    array(
	 		    'value'=>'cart_items__product_categories',
	 		    'text'=> __('Cart item quantity - Categories','customize-my-account-for-woocommerce')
	 		   

	 	    ),

	 	   
	 	);
	 	return apply_filters('syscmafwpl_override_rule_types_cart_items_quantity',$visibility_types);
	 }
}




if (! function_exists('syscmafwpl_easy_checkout_get_visibility_types')) {

	 /**
	 * Outputs a installed woocommerce version
	 *
	 * @access public
	 * @subpackage	Forms
	 */

	 function syscmafwpl_easy_checkout_get_visibility_types() {

	 	$visibility_types = array(
	 		array(
	 		    'value'=>'always-visible',
	 		    'text'=> __('Always Visibile','customize-my-account-for-woocommerce')
	 		   

	 	    ),
	 	    array(
	 		    'value'=>'dynamically-visible',
	 		    'text'=> __('Dynamically Visibile','customize-my-account-for-woocommerce')
	 		   

	 	    ),
	 	    

	 	   
	 	);
	 	return apply_filters('syscmafwpl_override_visibility_types',$visibility_types);
	 }
}

if (! function_exists('syscmafwpl_easy_checkout_get_field_types')) {

	 /**
	 * Outputs a installed woocommerce version
	 *
	 * @access public
	 * @subpackage	Forms
	 */

	 function syscmafwpl_easy_checkout_get_field_types() {

	 	$field_types = array(
	 		"0"=>array(
	 		    'type'=>'text',
	 		    'text'=> __('Text','customize-my-account-for-woocommerce'),
	 		    'icon'=> 'fa fa-user'

	 	    ),
	 	    "1"=>array(
	 		    'type'=>'syscmafwplselect',
	 		    'text'=> __('Select','customize-my-account-for-woocommerce'),
	 		    'icon'=> 'fa fa-list'

	 	    ),
	 	    "2"=>array(
	 		    'type'=>'checkbox',
	 		    'text'=> __('Checkbox','customize-my-account-for-woocommerce'),
	 		    'icon'=> 'fa fa-check'

	 	    ),
	 	    "3"=>array(
	 		    'type'=>'textarea',
	 		    'text'=> __('Textarea','customize-my-account-for-woocommerce'),
	 		    'icon'=> 'fa fa-file'

	 	    ),
	 	    "4"=>array(
	 		    'type'=>'radio',
	 		    'text'=> __('Radio','customize-my-account-for-woocommerce'),
	 		    'icon'=> 'fa fa-bomb'

	 	    ),
	 	     "5"=>array(
	 		    'type'=>'heading',
	 		    'text'=> __('Heading','customize-my-account-for-woocommerce'),
	 		    'icon'=> 'fa fa-minus'

	 	    ),
	 	     "6"=>array(
	 		    'type'=>'email',
	 		    'text'=> __('Email','customize-my-account-for-woocommerce'),
	 		    'icon'=> 'fa fa-envelope'

	 	    ),
	 	     "7"=>array(
	 		    'type'=>'number',
	 		    'text'=> __('Number','customize-my-account-for-woocommerce'),
	 		    'icon'=> 'fa fa-file'

	 	    ),
	 	     "8"=>array(
	 		    'type'=>'paragraph',
	 		    'text'=> __('Paragraph','customize-my-account-for-woocommerce'),
	 		    'icon'=> 'fa fa-file'

	 	    ),

	 	     "9"=>array(
	 		    'type'=>'password',
	 		    'text'=> __('Password','customize-my-account-for-woocommerce'),
	 		    'icon'=> 'fa fa-clipboard'

	 	    ),

	 	      "10"=>array(
	 		    'type'=>'datepicker',
	 		    'text'=> __('DatePicker','customize-my-account-for-woocommerce'),
	 		    'icon'=> 'fa fa-calendar'

	 	    ),

	 	      "11"=>array(
	 		    'type'=>'timepicker',
	 		    'text'=> __('TimePicker','customize-my-account-for-woocommerce'),
	 		    'icon'=> 'fa fa-list'

	 	    ),

	 	     "12"=>array(
	 		    'type'=>'datetimepicker',
	 		    'text'=> __('DateTime','customize-my-account-for-woocommerce'),
	 		    'icon'=> 'fa fa-calendar'

	 	    ),

	 	     "13"=>array(
	 		    'type'=>'daterangepicker',
	 		    'text'=> __('DateRange','customize-my-account-for-woocommerce'),
	 		    'icon'=> 'fa fa-calendar'

	 	    ),

	 	      "14"=>array(
	 		    'type'=>'datetimerangepicker',
	 		    'text'=> __('DateTimeRange','customize-my-account-for-woocommerce'),
	 		    'icon'=> 'fa fa-file'

	 	    ),

	 	      "15"=>array(
	 		    'type'=>'hidden_field',
	 		    'text'=> __('Hidden','customize-my-account-for-woocommerce'),
	 		    'icon'=> 'fa fa-file'

	 	    ),
	 	);
	 	return apply_filters('syscmafwpl_override_field_types',$field_types);
	 }
}

if (! function_exists('syscmafwpl_show_rule_type_01_td_values')) {

	 /**
	 * Outputs a installed woocommerce version
	 *
	 * @access public
	 * @subpackage	Forms
	 */

	 function syscmafwpl_show_rule_type_01_td_values($value,$mnindex) {

	 	?>

	 	<td>
	 		<?php if (isset($value['action_type']) ) {  ?>
	 			<select class="checkout_field_rule_type" name="syscmafwpl_additional_fees[<?php echo $mnindex; ?>][action_type]">
	 				<option value="show" <?php if (isset($value['action_type']) && ($value['action_type'] == "show")) { echo 'selected';} ?>>
	 					<?php echo esc_html__( 'Show' ,'customize-my-account-for-woocommerce'); ?>        
	 				</option>
	 				<option value="hide" <?php if (isset($value['action_type']) && ($value['action_type'] == "hide")) { echo 'selected';} ?>>
	 					<?php echo esc_html__( 'Hide' ,'customize-my-account-for-woocommerce'); ?>        
	 				</option>
	 			</select>
	 		<?php } else { ?>
	 			<strong><?php echo esc_html__( 'Add' ,'customize-my-account-for-woocommerce'); ?></strong>
	 		<?php  } ?>
	 	</td>
	 	<td><?php if (isset($value['action_type']) ) {  

	 		$shipping_methods = WC()->shipping->get_shipping_methods();


	 		$payment_gateways = WC()->payment_gateways->get_available_payment_gateways();

	 		?>
	 		<select class="checkout_field_rule_actionfield" name="syscmafwpl_additional_fees[<?php echo $mnindex; ?>][actionfield]">
	 			<optgroup label="<?php echo esc_html__( 'Payment Gateway' ,'customize-my-account-for-woocommerce'); ?>">
	 				<?php foreach ($payment_gateways as $pkey=>$pvalue) { ?>

	 					<option value="payment_method_<?php echo $pkey; ?>"  <?php if (isset($value['actionfield']) && ($value['actionfield'] == 'payment_method_'.$pkey.'')) { echo 'selected';} ?>><?php echo $pkey; ?></option>

	 				<?php } ?>

	 			</optgroup>

	 			<optgroup label="<?php echo esc_html__( 'Shipping Method' ,'customize-my-account-for-woocommerce'); ?>">
	 				<?php foreach ($shipping_methods as $skey=>$pvalue) { ?>

	 					<option value="shipping_method_<?php echo $skey; ?>"  <?php if (isset($value['actionfield']) && ($value['actionfield'] == 'shipping_method_'.$skey.'')) { echo 'selected';} ?>><?php echo $skey; ?></option>

	 				<?php } ?>

	 			</optgroup>

	 		</select>
	 	<?php } else { ?>

	 		<input type="number" step="0.01" name="syscmafwpl_additional_fees[<?php echo $mnindex; ?>][amount]" value="<?php if (isset($value['amount']) ) { echo $value['amount']; } ?>" placeholder="<?php echo esc_html__( 'Amount' ,'customize-my-account-for-woocommerce'); ?>">
	 	<?php  } ?>
	 </td>
	 <td>
	 	<?php if (!isset($value['action_type']) ) {  ?>
	 		<select class="checkout_field_rule_type" name="syscmafwpl_additional_fees[<?php echo $mnindex; ?>][type]">
	 			<option value="fixed" <?php if (isset($value['type']) && ($value['type'] != "percentage")) { echo 'selected';} ?>>
	 				<?php echo esc_html__( 'Fixed Amount' ,'customize-my-account-for-woocommerce'); ?>

	 			</option>
	 			<option value="percentage" <?php if (isset($value['type']) && ($value['type'] == "percentage")) { echo 'selected';} ?>>
	 				<?php echo esc_html__( 'Percentage' ,'customize-my-account-for-woocommerce'); ?>

	 			</option>
	 		</select>
	 	<?php  } ?>
	 </td>
	 <?php


	}

}


if (! function_exists('syscmafwpl_show_rule_type_02_td_values')) {

	 /**
	 * Outputs a installed woocommerce version
	 *
	 * @access public
	 * @subpackage	Forms
	 */

	function syscmafwpl_show_rule_type_02_td_values($value,$mnindex) {

		$action_type = isset($value['add_deduct_type']) ? $value['add_deduct_type'] : "add";


	 	?>

	 	<td>
	 		
	 		<select class="checkout_field_rule_type" name="syscmafwpl_additional_fees[<?php echo $mnindex; ?>][add_deduct_type]">
	 			<option value="add" <?php if (isset($value['add_deduct_type']) && ($value['add_deduct_type'] == "add")) { echo 'selected';} ?>>
	 				<?php echo esc_html__( 'Add' ,'customize-my-account-for-woocommerce'); ?>        
	 			</option>
	 			<option value="deduct" <?php if (isset($value['add_deduct_type']) && ($value['add_deduct_type'] == "deduct")) { echo 'selected';} ?>>
	 				<?php echo esc_html__( 'Deduct' ,'customize-my-account-for-woocommerce'); ?>        
	 			</option>
	 		</select>
	 		
	 	</td>
	 	<td>
	 		<?php echo esc_html__( 'Amount equal to price of ' ,'customize-my-account-for-woocommerce'); ?>
	 	</td>
	 	<td>
	 		<select class="checkout_field_quantity_specific_product_fees" data-placeholder="<?php echo esc_html__('Choose Product','customize-my-account-for-woocommerce'); ?>" name="syscmafwpl_additional_fees[<?php echo $mnindex; ?>][specific-product]" style="width:600px">
	 			<?php if (isset($value['specific-product'])) { ?>
	 				<option value="<?php echo $value['specific-product']; ?>" selected>#<?php echo $value['specific-product'] ?>-<?php echo get_the_title($value['specific-product']); ?></option>
	 			<?php } ?>
	 		</select>
	 	</td>
	 	<?php


	}

}


if (! function_exists('syscmafwpl_show_rule_type_03_td_values')) {

	 /**
	 * Outputs a installed woocommerce version
	 *
	 * @access public
	 * @subpackage	Forms
	 */

	 function syscmafwpl_show_rule_type_03_td_values($value,$mnindex) {

	 	?>

	 	<td>

	 		<strong><?php echo esc_html__( 'Add' ,'customize-my-account-for-woocommerce'); ?></strong>
	 		
	 	</td>
	 	<td>

	 		<input type="number" step="0.01" name="syscmafwpl_additional_fees[<?php echo $mnindex; ?>][amount]" value="<?php if (isset($value['amount']) ) { echo $value['amount']; } ?>" placeholder="<?php echo esc_html__( 'Amount' ,'customize-my-account-for-woocommerce'); ?>">

	 	</td>
	 	<td>
	 		<?php echo esc_html__( 'For each product in cart' ,'customize-my-account-for-woocommerce'); ?>
	 	</td>
	 	<?php


	 }

}



if (! function_exists('syscmafwpl_show_modal_popup')) {

	 /**
	 * Outputs a installed woocommerce version
	 *
	 * @access public
	 * @subpackage	Forms
	 */

	 function syscmafwpl_show_modal_popup($each_class) {

	 	$dashicons_array = syscmafwpl_easy_checkout_get_field_types();
	 	?>
	 	
	 	
	 	<div class="syscmafwpl-field-types-tab" data-category="popular">

	 		<?php foreach ($dashicons_array as $key=>$value) { 

                $type = isset($value['type']) ? $value['type'] : "text";
                $icon = isset($value['icon']) ? $value['icon'] : "fa fa-pen-field";
                $text = isset($value['text']) ? $value['text'] : "Field";

	 			?>
	 			<a href="#" class="<?php echo $each_class; ?> <?php echo $type; ?>" data-field-type="<?php echo $type; ?>">
                    <input type="radio" class="syscmafwpl_hidden_radio_input" value="<?php echo $type; ?>" name="syscmafwpl_type">
	 				<i class="syscmafwpl_fa_icon <?php echo $icon; ?>"></i>
	 				<span class="syscmafwpl_field_type_label"><?php echo $text; ?></span>
	 			</a>

	 		<?php } ?>
			
			
		</div>
	 	<?php
	 }
}

if ( ! function_exists( 'syscmafwpl_check_if_field_is_hidden2' ) ) {

    /**
	 * Outputs a installed woocommerce version
	 *
	 * @access public
	 * @subpackage	Forms
	 */


    function syscmafwpl_check_if_field_is_hidden2($hiddenvalue,$allowedproduts ,$allowedcats,$allowedroles,$total_quantity,$prd,$prd_qnty,$dynamic_rules,$dynamic_criteria ) {
    	global $woocommerce;
    	if( ! $woocommerce->cart ) { return; }
    	$cart_items = $woocommerce->cart->get_cart();
    	$extra_options = (array) get_option( 'syscmafwpl_extra_settings' );



    	switch($hiddenvalue) {
    		case "product-specific" :
    		$allowedproductindex =0;

    		if (( ! empty( $allowedproduts ) ) && (is_array($allowedproduts)))  {

    			foreach ($allowedproduts as $allowedproductkey=>$allowedproductid) {

    				foreach ($cart_items as $cartitem_key=>$cartitemvalue) {


    					if (isset($cartitemvalue['variation_id']) &&  ($cartitemvalue['variation_id'] != 0)) {
    						$product_id=$cartitemvalue['variation_id'];
    					} else {
    						$product_id=$cartitemvalue['product_id'];
    					}



    					if ($product_id == $allowedproductid) {
    						$allowedproductindex++;
    					}
    				}
    			}
    		}

    		if ($allowedproductindex == 0)  {

    			return 0;
    		} else {

    			return 1;
    		}

    		break;

    		case "category-specific" :
    		$categoryproductindex = 0;

    		if (( ! empty( $allowedcats ) ) && (is_array($allowedcats)))  {

    			foreach ($allowedcats as $allowedcatvalue) {

    				foreach ($cart_items as $cartitem_key=>$cartitemvalue) {

    					$product_id=$cartitemvalue['product_id'];

    					$catterms = get_the_terms( $product_id, 'product_cat' );

    					if (( ! empty( $catterms ) ) && (is_array($catterms)))  {

    						foreach ($catterms as $catterm) {
    							if ($catterm->term_id == $allowedcatvalue) {
    								$categoryproductindex++;
    							}
    						}
    					}


    				}
    			}
    		}

    		if ($categoryproductindex == 0)  {

    			return 0;

    		} else {

    			return 1;
    		}

    		break;

    		case "role-specific" :
    		$role_status       = 0;



    		if (isset($allowedroles) && is_array($allowedroles) && (!empty($allowedroles))) {
    			if ( ! is_user_logged_in() ) {
    				$role_status       = 0;
    				return $role_status; 
    			}

    			$allowedauthors = '';

    			foreach ($allowedroles as $role) {
    				$allowedauthors.=''.$role.',';
    			}

    			$allowedauthors=substr_replace($allowedauthors, "", -1);

    			global $current_user;
    			$user_roles = $current_user->roles;
    			$user_role = array_shift($user_roles);



    			if (preg_match('/\b'.$user_role.'\b/', $allowedauthors )) {
    				$role_status       = 1;
    				return $role_status;
    			}

    		}

    		if (empty($allowedroles) && ( ! is_user_logged_in() )) {
    			$role_status       = 1;
    			return $role_status;
    		}



    		return $role_status; 

    		break;

    		case "total-quantity" :
    		$quantity_index       = 0;

    		if (!isset($total_quantity) || ($total_quantity == 0)) {
    			return 0;
    		} 

    		$cart_count = $woocommerce->cart->cart_contents_count;

    		if ($cart_count == $total_quantity) {

    			return 1;

    		}

    		return $quantity_index;

    		break;



    		case "cart-quantity-specific" :

    		$product_quantity_index       = 0;

    		if (!isset($prd) || ($prd == 0)) {
    			return 0;
    		} 

    		if (!isset($prd_qnty) || ($prd_qnty == 0)) {
    			return 0;
    		} 


    		foreach ($cart_items as $cartitem_key=>$cartitemvalue) {


    			if (isset($cartitemvalue['variation_id']) &&  ($cartitemvalue['variation_id'] != 0)) {
    				$product_id=$cartitemvalue['variation_id'];
    			} else {
    				$product_id=$cartitemvalue['product_id'];
    			}





    			if (($product_id == $prd) && ($cartitemvalue['quantity'] == $prd_qnty)) {
    				$product_quantity_index++;

    			} 
    		}

    		if ($product_quantity_index > 1) {
    			return 1;
    		}

    		return $product_quantity_index;

    		break;

    		case "always-visible" :
    		return 1;
    		break;

    		case "hide-downloadable":

    		$downloadable_match_index       = 0;

            $cart_keys = count($cart_items);

    		foreach ($cart_items as $cartitem_key=>$cartitemvalue) {


    			if (isset($cartitemvalue['variation_id']) &&  ($cartitemvalue['variation_id'] != 0)) {
    				$dproduct_id=$cartitemvalue['variation_id'];
    			} else {
    				$dproduct_id=$cartitemvalue['product_id'];
    			}


                $_dproduct = wc_get_product($dproduct_id);


                if ($_dproduct->is_downloadable('yes')) {
                     $downloadable_match_index++;
                }


    		}

    		if ($downloadable_match_index == $cart_keys) {
    			return 0;
    		}

    		break;

    		case "hide-virtual":

    		$virtual_match_index       = 0;

            $cart_keys = count($cart_items);

    		foreach ($cart_items as $cartitem_key=>$cartitemvalue) {


    			if (isset($cartitemvalue['variation_id']) &&  ($cartitemvalue['variation_id'] != 0)) {
    				$dproduct_id=$cartitemvalue['variation_id'];
    			} else {
    				$dproduct_id=$cartitemvalue['product_id'];
    			}


                $_dproduct = wc_get_product($dproduct_id);


                if ($_dproduct->is_virtual('yes')) {
                     $virtual_match_index++;
                }


    		}

    		if ($virtual_match_index == $cart_keys) {
    			return 0;
    		}

    		break;

    		case "dynamically-visible":

    		    $dynamic_match_index = 0;



    		    $dynamic_match_index = syscmafwpl_loop_through_dynamic_rules($dynamic_rules,$dynamic_criteria);

    		    return $dynamic_match_index;

    		break;

    		default:
    		return 1;
    	}
    }
}

/**
 * License activation reminder.
 *
 * @since 1.0.0
 * @param string .
 * @return string
 */

if (!function_exists('syscmafwpl_count_item_in_cart')) {


	function syscmafwpl_count_item_in_cart() {
		$count = 0;
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$count++;
		}
		return $count;
	}

}


/**
 * License activation reminder.
 *
 * @since 1.0.0
 * @param string .
 * @return string
 */

if (!function_exists('syscmafwpl_does_rule_match_found')) {

	function syscmafwpl_does_rule_match_found($rulevalue) { 

		$rule_matched = 'no';

        $rule_type = isset($rulevalue['rule_type']) ? $rulevalue['rule_type'] : "";

        switch($rule_type) {

        	case "cart__quantity":

        	    $compare = isset($rulevalue['rule_type_compare']) ? $rulevalue['rule_type_compare'] : "less_than";

        	    if (isset($rulevalue['rule_type_number'])) {

        	    	 $number = $rulevalue['rule_type_number'];

        	    }


        	    if (isset($compare) && isset($number)) {

        	    	$cart_total_quantity = WC()->cart->get_cart_contents_count();

        	    	switch($compare) {

        	    		case "less_than":

        	    		    if ($cart_total_quantity < $number) {
        	    		   	    $rule_matched = 'yes';

        	    		   	    return $rule_matched;
        	    		    }

        	    		break;

        	    		case "greater_than":

        	    		    if ($cart_total_quantity > $number) {
        	    		   	    $rule_matched = 'yes';

        	    		   	    return $rule_matched;
        	    		    }

        	    		break;

        	    		case "greater_than_equal_to":

        	    		   if ($cart_total_quantity >= $number) {
        	    		   	    $rule_matched = 'yes';

        	    		   	    return $rule_matched;
        	    		   }

        	    		break;

        	    	}
        	    }
                
    	   
        	    
        	break;

        	case "cart__count":

        	   $compare = isset($rulevalue['rule_type_compare']) ? $rulevalue['rule_type_compare'] : "less_than";

        	    if (isset($rulevalue['rule_type_number'])) {

        	    	 $number = $rulevalue['rule_type_number'];

        	    }


        	    if (isset($compare) && isset($number)) {

        	    	$cart_total_quantity = syscmafwpl_count_item_in_cart();



        	    	switch($compare) {

        	    		case "less_than":

        	    		    if ($cart_total_quantity < $number) {
        	    		   	    $rule_matched = 'yes';

        	    		   	    return $rule_matched;
        	    		    }

        	    		break;

        	    		case "greater_than":

        	    		    if ($cart_total_quantity > $number) {
        	    		   	    $rule_matched = 'yes';

        	    		   	    return $rule_matched;
        	    		    }

        	    		break;

        	    		case "greater_than_equal_to":

        	    		   if ($cart_total_quantity >= $number) {
        	    		   	    $rule_matched = 'yes';

        	    		   	    return $rule_matched;
        	    		   }

        	    		break;

        	    	}
        	    }
        	    
        	break;

        	case "cart__weight":


				$compare = isset($rulevalue['rule_type_compare']) ? $rulevalue['rule_type_compare'] : "less_than";

        	    if (isset($rulevalue['rule_type_number'])) {

        	    	 $number = $rulevalue['rule_type_number'];

        	    }


        	    if (isset($compare) && isset($number)) {

					global $woocommerce;

        	    	$cart_total_quantity = $woocommerce->cart->total;
                    



        	    	switch($compare) {

        	    		case "less_than":

        	    		    if ($cart_total_quantity < $number) {
        	    		   	    $rule_matched = 'yes';

        	    		   	    return $rule_matched;
        	    		    }

        	    		break;

        	    		case "greater_than":

        	    		    if ($cart_total_quantity > $number) {
        	    		   	    $rule_matched = 'yes';

        	    		   	    return $rule_matched;
        	    		    }

        	    		break;

        	    		case "greater_than_equal_to":

        	    		   if ($cart_total_quantity >= $number) {
        	    		   	    $rule_matched = 'yes';

        	    		   	    return $rule_matched;
        	    		   }

        	    		break;

        	    	}
        	    }

        	    
        	   
        	break;

        	case "cart_items__products":

        	$contains_rule = isset($rulevalue['rule_type_contains']) ? $rulevalue['rule_type_contains'] : "contains_any";

        	$rule_products =  isset($rulevalue['rule_type_products']) ? $rulevalue['rule_type_products'] : array();

        	global $woocommerce;
    	        
    	    if( ! $woocommerce->cart ) { return $rule_matched; }
    	        
    	    $cart_items = $woocommerce->cart->get_cart();

        	switch($contains_rule) {

        		case "contains_any":

        		

    	        $allowedproductindex =0;



    	        foreach ($cart_items as $cartitem_key=>$cartitemvalue) {


    	        	if (isset($cartitemvalue['variation_id']) &&  ($cartitemvalue['variation_id'] != 0)) {
    	        		$product_id=$cartitemvalue['variation_id'];
    	        	} else {
    	        		$product_id=$cartitemvalue['product_id'];
    	        	}


    	        	



    	        	if (in_array($product_id, $rule_products)) {
    	        		$allowedproductindex++;
    	        	}
    	        }

    	       


    	        if ($allowedproductindex > 0)  {

    	        	$rule_matched = 'yes';

    	        	return $rule_matched;
    	        } else {

    	        	$rule_matched = 'no';

    	        	return $rule_matched;
    	        }

                 break;

                 case "contains_all":

                 $allowedproductindex =0;

                 $allowed_match_found_index = 0;

                 

                foreach($rule_products as $product_key=>$product_value) {

                	foreach ($cart_items as $cartitem_key=>$cartitemvalue) {


                		if (isset($cartitemvalue['variation_id']) &&  ($cartitemvalue['variation_id'] != 0)) {
                			$product_id=$cartitemvalue['variation_id'];
                		} else {
                			$product_id=$cartitemvalue['product_id'];
                		}






                		if ($product_id  == $product_value) {
                			$allowed_match_found_index++;
                		}

                		
                	}

                	$allowedproductindex++;

                }

    	        

    	       


        		if ($allowedproductindex == $allowed_match_found_index)  {

        			$rule_matched = 'yes';

        	        return $rule_matched;
        		} else {

        			$rule_matched = 'no';

        	        return $rule_matched;
        		}

                 break;

                 case "does_not_contain_any":

                 $allowedproductindex =0;



    	        foreach ($cart_items as $cartitem_key=>$cartitemvalue) {


    	        	if (isset($cartitemvalue['variation_id']) &&  ($cartitemvalue['variation_id'] != 0)) {
    	        		$product_id=$cartitemvalue['variation_id'];
    	        	} else {
    	        		$product_id=$cartitemvalue['product_id'];
    	        	}


    	        	



    	        	if (in_array($product_id, $rule_products)) {
    	        		$allowedproductindex++;
    	        	}
    	        }

    	       


    	        if ($allowedproductindex > 0)  {

    	        	$rule_matched = 'no';

    	        	return $rule_matched;
    	        } else {

    	        	$rule_matched = 'yes';

    	        	return $rule_matched;
    	        }

                 break;

                 case "does_not_contain_all":

                 $allowedproductindex =0;

                 $allowed_match_found_index = 0;

                 

                foreach($rule_products as $product_key=>$product_value) {

                	foreach ($cart_items as $cartitem_key=>$cartitemvalue) {


                		if (isset($cartitemvalue['variation_id']) &&  ($cartitemvalue['variation_id'] != 0)) {
                			$product_id=$cartitemvalue['variation_id'];
                		} else {
                			$product_id=$cartitemvalue['product_id'];
                		}






                		if ($product_id  == $product_value) {
                			$allowed_match_found_index++;
                		}

                		
                	}

                	$allowedproductindex++;

                }

    	        

    	       


        		if ($allowedproductindex == $allowed_match_found_index)  {

        			$rule_matched = 'no';

        	        return $rule_matched;
        		} else {

        			$rule_matched = 'yes';

        	        return $rule_matched;
        		}

                 break;

        		
        	}
        	    
        	break;


        	case "cart_items__product_categories":


        	$contains_rule = isset($rulevalue['rule_type_contains']) ? $rulevalue['rule_type_contains'] : "contains_any";

        	$alowed_cats =  isset($rulevalue['rule_type_categories']) ? $rulevalue['rule_type_categories'] : array();

        	global $woocommerce;
    	        
    	    if( ! $woocommerce->cart ) { return $rule_matched; }
    	        
    	    $cart_items = $woocommerce->cart->get_cart();

			switch($contains_rule) {

        		case "contains_any":

        		

    	        $allowedproductindex =0;



    	        foreach ($cart_items as $cartitem_key=>$cartitemvalue) {


    	        	


    	        	$product_id=$cartitemvalue['product_id'];

    				$catterms = get_the_terms( $product_id, 'product_cat' );

					

    				if (( ! empty( $catterms ) ) && (is_array($catterms)))  {

    					foreach ($catterms as $catterm) {

							
    						if (in_array($catterm->term_id, $alowed_cats)) {
    							$allowedproductindex++;
    						}
    					}
    				}



    	        	
    	        }

    	       


    	        if ($allowedproductindex > 0)  {

    	        	$rule_matched = 'yes';

    	        	return $rule_matched;
    	        } else {

    	        	$rule_matched = 'no';

    	        	return $rule_matched;
    	        }

                 break;

                 case "contains_all":

                 $allowedproductindex =0;

                 $allowed_match_found_index = 0;

                 
				 foreach ($cart_items as $cartitem_key=>$cartitemvalue) {
                

                	foreach($alowed_cats as $product_key=>$product_value) {


                		$product_id=$cartitemvalue['product_id'];

    				    $catterms = get_the_terms( $product_id, 'product_cat' );

    				    if (( ! empty( $catterms ) ) && (is_array($catterms)))  {

    					    foreach ($catterms as $catterm) {
    						    if (in_array($catterm->term_id, $alowed_cats)) {
    							    $allowed_match_found_index++;
    						    }
    					    }
    				    }



                		
                	}

                	$allowedproductindex++;

                }

    	        
                $cart_total_quantity = syscmafwpl_count_item_in_cart();
    	       
                $allowedproductindex = $cart_total_quantity * $allowedproductindex;

        		if ($allowedproductindex == $allowed_match_found_index)  {

        			$rule_matched = 'yes';

        	        return $rule_matched;
        		} else {

        			$rule_matched = 'no';

        	        return $rule_matched;
        		}

                 break;

                 case "does_not_contain_any":

                 $allowedproductindex =0;



    	        foreach ($cart_items as $cartitem_key=>$cartitemvalue) {


    	        	$product_id=$cartitemvalue['product_id'];

    				$catterms = get_the_terms( $product_id, 'product_cat' );

    				if (( ! empty( $catterms ) ) && (is_array($catterms)))  {

    					foreach ($catterms as $catterm) {
    						if (in_array($catterm->term_id, $alowed_cats)) {
    							$allowedproductindex++;
    						}
    					}
    				}


    	        }

    	       


    	        if ($allowedproductindex > 0)  {

    	        	$rule_matched = 'no';

    	        	return $rule_matched;
    	        } else {

    	        	$rule_matched = 'yes';

    	        	return $rule_matched;
    	        }

                 break;

                case "does_not_contain_all":

                $allowedproductindex =0;

                $allowed_match_found_index = 0;

                 

                foreach ($cart_items as $cartitem_key=>$cartitemvalue) {
                

                	foreach($alowed_cats as $product_key=>$product_value) {


                		$product_id=$cartitemvalue['product_id'];

    				    $catterms = get_the_terms( $product_id, 'product_cat' );

    				    if (( ! empty( $catterms ) ) && (is_array($catterms)))  {

    					    foreach ($catterms as $catterm) {
    						    if (in_array($catterm->term_id, $alowed_cats)) {
    							    $allowed_match_found_index++;
    						    }
    					    }
    				    }

                		
                	}

                	$allowedproductindex++;

                }

    	        
                $cart_total_quantity = syscmafwpl_count_item_in_cart();
    	       
                $allowedproductindex = $cart_total_quantity * $allowedproductindex;
    	       


        		if ($allowedproductindex == $allowed_match_found_index)  {

        			$rule_matched = 'no';

        	        return $rule_matched;
        		} else {

        			$rule_matched = 'yes';

        	        return $rule_matched;
        		}

                 break;

			}
        	    
        	break;

        	case "user_role":

				$role_status       = 'no';
                
				$contains_rule = isset($rulevalue['rule_type_contains']) ? $rulevalue['rule_type_contains'] : "contains_any";

        	    $allowedroles =  isset($rulevalue['rule_type_roles']) ? $rulevalue['rule_type_roles'] : array();

				


    		    if (isset($allowedroles) && is_array($allowedroles) && (!empty($allowedroles))) {
    			if ( ! is_user_logged_in() ) {
    				$role_status       = 'no';
    				return $role_status; 
    			}

    			$allowedauthors = '';

    			foreach ($allowedroles as $role) {
    				$allowedauthors.=''.$role.',';
    			}

    			$allowedauthors=substr_replace($allowedauthors, "", -1);

    			global $current_user;
    			$user_roles = $current_user->roles;
    			$user_role = array_shift($user_roles);



    			if (preg_match('/\b'.$user_role.'\b/', $allowedauthors )) {
    				$role_status       = "yes";
    				return $role_status;
    			}

    		    }

    		    if (empty($allowedroles) && ( ! is_user_logged_in() )) {
    			    $role_status       = "yes";
    			    return $role_status;
    		    }



    		    return $role_status; 
        	    
        	break;


        	case "customer_total_spent":
        	    

        	    if ( ! is_user_logged_in() ) {
    				$rule_matched       = 'no';
    				return $rule_matched; 
    			}

				$compare = isset($rulevalue['rule_type_compare']) ? $rulevalue['rule_type_compare'] : "less_than";

        	    if (isset($rulevalue['rule_type_number'])) {

        	    	 $number = $rulevalue['rule_type_number'];

        	    }


        	    if (isset($compare) && isset($number)) {

					global $woocommerce;

					$current_user = wp_get_current_user();

        	    	$customer_total_spent = wc_get_customer_total_spent( $current_user->ID );
                    



        	    	switch($compare) {

        	    		case "less_than":

        	    		    if ($customer_total_spent < $number) {
        	    		   	    $rule_matched = 'yes';

        	    		   	    return $rule_matched;
        	    		    }

        	    		break;

        	    		case "greater_than":

        	    		    if ($customer_total_spent > $number) {
        	    		   	    $rule_matched = 'yes';

        	    		   	    return $rule_matched;
        	    		    }

        	    		break;

        	    		case "greater_than_equal_to":

        	    		   if ($customer_total_spent >= $number) {
        	    		   	    $rule_matched = 'yes';

        	    		   	    return $rule_matched;
        	    		   }

        	    		break;

        	    	}
        	    }

        	    
        	break;


        	case "customer_order_count":

        	    if ( ! is_user_logged_in() ) {
    				$rule_matched       = 'no';
    				return $rule_matched; 
    			}

				$compare = isset($rulevalue['rule_type_compare']) ? $rulevalue['rule_type_compare'] : "less_than";

        	    if (isset($rulevalue['rule_type_number'])) {

        	    	 $number = $rulevalue['rule_type_number'];

        	    }


        	    if (isset($compare) && isset($number)) {

					global $woocommerce;

					$current_user = wp_get_current_user();

        	    	$customer_order_count = wc_get_customer_order_count( $current_user->ID );
                    



        	    	switch($compare) {

        	    		case "less_than":

        	    		    if ($customer_order_count < $number) {
        	    		   	    $rule_matched = 'yes';

        	    		   	    return $rule_matched;
        	    		    }

        	    		break;

        	    		case "greater_than":

        	    		    if ($customer_order_count > $number) {
        	    		   	    $rule_matched = 'yes';

        	    		   	    return $rule_matched;
        	    		    }

        	    		break;

        	    		case "greater_than_equal_to":

        	    		   if ($customer_order_count >= $number) {
        	    		   	    $rule_matched = 'yes';

        	    		   	    return $rule_matched;
        	    		   }

        	    		break;

        	    	}
        	    }

        	    
        	break;

        	
        }

		return $rule_matched;

	}

}


/**
 * License activation reminder.
 *
 * @since 1.0.0
 * @param string .
 * @return string
 */

if (!function_exists('syscmafwpl_match_all_found_condtion')) {

	function syscmafwpl_match_all_found_condtion($dynamic_rules) { 

		$match_all_found = 'no';

		$rule_match_all_index = 0;

		$match_found_index = 0;

        foreach ($dynamic_rules as $rule=>$rulevalue) {

        	if (isset($rulevalue['enabled']) && ($rulevalue['enabled'] == "yes")) {

        		$rule_matched = 'no';    		

        	    $rule_matched = syscmafwpl_does_rule_match_found($rulevalue);

        	    if ($rule_matched == 'yes') {
        	    	$match_found_index++;
        	    }

        	    $rule_match_all_index++;
        	}
        }


        if ($rule_match_all_index == $match_found_index) {
        	return 'yes';
        }

		return $match_all_found;

	}

}


/**
 * License activation reminder.
 *
 * @since 1.0.0
 * @param string .
 * @return string
 */

if (!function_exists('syscmafwpl_match_any_found_condtion')) {

	function syscmafwpl_match_any_found_condtion($dynamic_rules) { 

		$match_any_found = 'no';


		$match_all_found = 'no';

		

		$match_found_index = 0;

        foreach ($dynamic_rules as $rule=>$rulevalue) {

        	if (isset($rulevalue['enabled']) && ($rulevalue['enabled'] == "yes")) {

        		$rule_matched = 'no';    		

        	    $rule_matched = syscmafwpl_does_rule_match_found($rulevalue);

        	    if ($rule_matched == 'yes') {
        	    	$match_found_index++;
        	    }

        	   
        	}
        }


        if ($match_found_index > 0) {
        	return 'yes';
        }

		

		return $match_any_found;

	}

}


/**
 * License activation reminder.
 *
 * @since 1.0.0
 * @param string .
 * @return string
 */

if (!function_exists('syscmafwpl_loop_through_dynamic_rules')) {

	function syscmafwpl_loop_through_dynamic_rules($dynamic_rules,$dynamic_criteria) { 

		$dynamic_match_index = 0;

        switch($dynamic_criteria) {
        	case "match_all":
        	   $match_all_found = 'no';

        	   $match_all_found = syscmafwpl_match_all_found_condtion($dynamic_rules);

        	   if ($match_all_found == "yes") {
        	   	   $dynamic_match_index = 1;

        	   	   return $dynamic_match_index;
        	   }
        	break;

        	case "match_any":

        	    $match_any_found = 'no';

        	    $match_any_found = syscmafwpl_match_any_found_condtion($dynamic_rules);

        	    if ($match_any_found == "yes") {
        	   	   $dynamic_match_index = 1;

        	   	   return $dynamic_match_index;
        	    }
        	break;




        	case "disabled":
        	   $dynamic_match_index = 1;

        	   return $dynamic_match_index;
        	break;

        	default:

        	   $dynamic_match_index = 0;

        	   return $dynamic_match_index;
        	break;
        }

		return $dynamic_match_index;

          
	}

}


/**
 * License activation reminder.
 *
 * @since 1.0.0
 * @param string .
 * @return string
 */

if (!function_exists('syscmafwpl_load_license_reminder_div')) {

	function syscmafwpl_load_license_reminder_div() { 
		?>

		<div class="syscmafwpl_notice_div">

			<div class="syscmafwpl_notice_div_uppertext">
				<?php echo esc_html__( 'Its been more than a month since you activated plugin.Kindly activate your license to keep accessing this section.Your frontend functionality is unaffected.'); ?>

			</div>

			<div class="syscmafwpl_notice_div_lowerbutton">
				<a type="button" href="admin.php?page=syscmafwpl_plugin_options&tab=syscmafwpl_license_settings"  class="btn btn-primary " >
					<span class="dashicons dashicons-lock"></span>
					<?php echo esc_html__( 'Activate License' ,'customize-my-account-for-woocommerce'); ?>
				</a>

				
			</div>
		</div>

		<?php 
	}
}


if ( ! function_exists( 'syscmafwpl_get_checkout_field_varsion_number' ) ) {

    /**
	 * Outputs a installed woocommerce version
	 *
	 * @access public
	 * @subpackage	Forms
	 */



    function syscmafwpl_get_checkout_field_varsion_number() {
        // If get_plugins() isn't available, require it
	   
	   if ( ! function_exists( 'get_plugins' ) )
		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	
        // Create the plugins folder and file variables
	   $plugin_folder = get_plugins( '/' . 'phppoet-checkout-fields' );
	   $plugin_file = 'phppoet-checkout-fields.php';
	
	   // If the plugin version number is set, return it 
	   if ( isset( $plugin_folder[$plugin_file]['Version'] ) ) {
		 return $plugin_folder[$plugin_file]['Version'];

	   } else {
	// Otherwise return null
		return NULL;
	  }
   }
   
}



if ( ! function_exists( 'syscmafwpl_get_woo_version_number' ) ) {

    /**
	 * Outputs a installed woocommerce version
	 *
	 * @access public
	 * @subpackage	Forms
	 */



    function syscmafwpl_get_woo_version_number() {
        // If get_plugins() isn't available, require it
	   
	   if ( ! function_exists( 'get_plugins' ) )
		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	
        // Create the plugins folder and file variables
	   $plugin_folder = get_plugins( '/' . 'customize-my-account-for-woocommerce' );
	   $plugin_file = 'woocommerce.php';
	
	   // If the plugin version number is set, return it 
	   if ( isset( $plugin_folder[$plugin_file]['Version'] ) ) {
		 return $plugin_folder[$plugin_file]['Version'];

	   } else {
	// Otherwise return null
		return NULL;
	  }
   }
   
}


if ( ! function_exists( 'pfcme_parent_visibility_check' ) ) {

    /**
	 * returns conditional classes
	 *
	 * @access public
	 * @subpackage	Forms
	 */



    function pfcme_parent_visibility_check($parentfield) {

        $default = 'visible';

        if (strpos($parentfield, 'billing') !== false) {
            
            $field_type = 'billing';

        } elseif (strpos($parentfield, 'shipping') !== false) {
        	
        	$field_type = 'shipping';
        
        } elseif (strpos($parentfield, 'shipping') !== false) {
            
            $field_type = 'additional';

        }


        if (isset($field_type)) {

        	switch($field_type) {
        		case "billing":
        		    $fields_data = get_option('syscmafwpl_billing_settings');
        		break;

        		case "shipping":
        		    $fields_data = get_option('syscmafwpl_shipping_settings');
        		break;

        		case "additional":
        		    $fields_data = get_option('syscmafwpl_additional_settings');
        		break;

        	}
        }

        if (isset($fields_data) && isset($fields_data[$parentfield])) {
        	
        	$value = $fields_data[$parentfield];

        	if (isset($value['visibility'])) {
				
				$visibilityarray = $value['visibility'];
				 
				if (isset($value['products'])) { 
				    $allowedproducts = $value['products'];
				} else {
					$allowedproducts = array(); 
				}
				 
				if (isset($value['category'])) {
					$allowedcats = $value['category'];
				} else {
					$allowedcats = array();
				}

				if (isset($value['role'])) {
					$allowedroles = $value['role'];
				} else {
					$allowedroles = array();
				}

				if (isset($value['total-quantity'])) {
					$total_quantity = $value['total-quantity'];
				} else {
					$total_quantity = 0;
				}

				if (isset($value['specific-product'])) {
					$prd = $value['specific-product'];
				} else {
					$prd = 0;
				}

				if (isset($value['specific-quantity'])) {
					$prd_qnty = $value['specific-quantity'];
				} else {
					$prd_qnty = 0;
				}


				if (isset($value['dynamic_rules'])) { 
					$dynamic_rules = $value['dynamic_rules'];
				} else {
					$dynamic_rules = array(); 
				}


				if (isset($value['dynamic_visibility_criteria'])) { 
					$dynamic_criteria = $value['dynamic_visibility_criteria'];
				} else {
					$dynamic_criteria = 'match_all'; 
				}



				$is_field_hidden=syscmafwpl_check_if_field_is_hidden($visibilityarray,$allowedproducts,$allowedcats,$allowedroles,$total_quantity,$prd,$prd_qnty,$dynamic_rules,$dynamic_criteria);

				if ((isset($is_field_hidden)) && ($is_field_hidden == 0)) {

					return 'hidden';

				}
            }

        }

        return $default;

    }

}


if ( ! function_exists( 'syscmafwpl_get_fees_class' ) ) {

    /**
	 * returns conditional classes
	 *
	 * @access public
	 * @subpackage	Forms
	 */



    function syscmafwpl_get_fees_class($key) {

    	$class              = '';

        $additional_fees    = get_option('syscmafwpl_additional_fees');
        
        
        

        $matchindex         = 0;

        if (is_array($additional_fees)) {
        	$additional_fees    = array_filter($additional_fees);
        }


        if (isset($additional_fees) && is_array($additional_fees) && (sizeof($additional_fees) >= 1)) { 
        	$additional_fees = $additional_fees;
        } else {
        	$additional_fees = array();
        }


        foreach ($additional_fees as $fkey=>$fvalue) {
            //if (strstr($string, $url)) { // mine version
            if ((strpos($key, $fvalue['parentfield']) !== FALSE) && (isset($fvalue['amount'])) ) { // Yoshi version
    	        $matchindex++; 
    	        
            }
        }

        

        if ($matchindex > 0) {
        	
        	$class = 'syscmafwpl-price-changer';


        }
    

		return $class;
    }
   
}


if ( ! function_exists( 'syscmafwpl_get_action_class' ) ) {

    /**
	 * returns conditional classes
	 *
	 * @access public
	 * @subpackage	Forms
	 */



    function syscmafwpl_get_action_class($key) {

    	$class              = '';

        $additional_fees    = get_option('syscmafwpl_additional_fees');
        
        
        

        $matchindex         = 0;

        if (is_array($additional_fees)) {
        	$additional_fees    = array_filter($additional_fees);
        }


        if (isset($additional_fees) && is_array($additional_fees) && (sizeof($additional_fees) >= 1)) { 
        	$additional_fees = $additional_fees;
        } else {
        	$additional_fees = array();
        }


        foreach ($additional_fees as $fkey=>$fvalue) {
            //if (strstr($string, $url)) { // mine version
            if ((strpos($key, $fvalue['parentfield']) !== FALSE) && (isset($fvalue['actionfield'])) ) { // Yoshi version
    	        $matchindex++; 
    	        
            }
        }

        

        if ($matchindex > 0) {
        	
        	$class = 'syscmafwpl-action-changer';


        }
    

		return $class;
    }
   
}



if ( ! function_exists( 'syscmafwpl_get_field_data' ) ) {

    /**
	 * returns conditional classes
	 *
	 * @access public
	 * @subpackage	Forms
	 */



    function syscmafwpl_get_field_data($key) {

    	$field_data = array();

        $billing_fields    = (array) get_option('syscmafwpl_billing_settings');
        $shipping_fields   = (array) get_option('syscmafwpl_shipping_settings');
        $additional_fields = (array) get_option('syscmafwpl_additional_settings');

        

       

        foreach ($billing_fields as $bkey=>$bvalue) {
            //if (strstr($string, $url)) { // mine version
            if ($bkey == $key) { // Yoshi version
    	        $field_data['label'] = $bvalue['label']; 
    	        $field_data['type']  = $bvalue['type']; 
    	        
    	        return $field_data;
    	        
            }
        }

        foreach ($shipping_fields as $bkey=>$bvalue) {
            //if (strstr($string, $url)) { // mine version
            if ($bkey == $key) { // Yoshi version
    	        $field_data['label'] = $bvalue['label']; 
    	        $field_data['type']  = $bvalue['type']; 
    	        
    	        return $field_data;
    	        
            }
        }


        foreach ($additional_fields as $bkey=>$bvalue) {
            //if (strstr($string, $url)) { // mine version
            if ($bkey == $key) { // Yoshi version
    	        $field_data['label'] = $bvalue['label']; 
    	        $field_data['type']  = $bvalue['type']; 
    	        
    	        return $field_data;
    	        
            }
        }

        


        return $field_data;

        
    }
   
}

if ( ! function_exists( 'get_order_array' ) ) {

	function get_order_array($plugin_fields) {

		$order=array();

		foreach ($plugin_fields as $key=>$value) {
			array_push($order, $key);
		}


		return $order;
	}

}



if ( ! function_exists( 'syscmafwpl_update_fields_combined' ) ) {

    /**
	 * returns conditional classes
	 *
	 * @access public
	 * @subpackage	Forms
	 */



    function syscmafwpl_update_fields_combined($fields,$plugin_fields,$slug) {

    	if (isset($plugin_fields) && ($plugin_fields != '')) {

    		$keyorder = 1;


		    //loops through plugin generated array of billing fields  
    		foreach ($plugin_fields as $key2=>$value) {

    			if ((isset($value['new_options']) && ($value['new_options'] != '')) || (isset($value['options']) && ($value['options'] != '')))  {


    				$old_options = isset($value['options']) ? $value['options'] : '';

    				$old_options = explode(',', $old_options);

    				$old_options_array = array();



    				if (isset($old_options) && !empty($old_options) && (sizeof($old_options) > 0)) {
    					$old_options_array_index = 1;
    					foreach($old_options as $ovalue) {
    						$old_options_array[''.$old_options_array_index.''] = array('value'=>$ovalue,'text'=>$ovalue);
    						$old_options_array_index++;
    					}
    				}

    				$new_options_array = isset($value['new_options']) ? $value['new_options'] : $old_options_array;



    				$options = array();

    				foreach($new_options_array as $nkey=>$val){

    					$o_value = $val['value'];
    					$o_text = $val['text'];

    					$options[$o_value]  = $o_text;

    				}

    			}

                



    			if (isset($fields[$slug]) && (sizeof($fields[$slug]) >1)) {

		    	    //loops through default woocommerce fields array

    				foreach ($fields[$slug] as $key=>$billing)  {

		                //if key matches
    					if ($key == $key2) {


    						if (isset($value['type'])) { 

    							$fields[$slug][$key]['type'] = $value['type']; 

    						}





    						if (isset($value['label'])) { 

    							$fields[$slug][$key]['label'] = $value['label']; 
    						}


    						if (isset($value['width'])) { 

    							if (isset( $fields[$slug][$key]['class'])) {

    								foreach ($fields[$slug][$key]['class'] as $classkey=>$classvalue) {

    									if ($classvalue == 'form-row-wide' || $classvalue == "form-row-first"  || $classvalue == "form-row-last") {
    										unset($fields[$slug][$key]['class'][$classkey]);
    									}

    								}
    							}

    							$fields[$slug][$key]['class'][]=$value['width'];
    						}

    						if (isset($value['required']) && ($value['required'] == 1) && ($key != "billing_state")) { 

    							$fields[$slug][$key]['required'] = $value['required']; 

    						} else {

    							$fields[$slug][$key]['required'] = false;
    						} 


    						if (isset($value['clear']) && ($value['clear'] == 1)) { 

    							$fields[$slug][$key]['clear'] = $value['clear']; 

    						} else {

    							$fields[$slug][$key]['clear'] = false;

    						}	

    						if (isset($value['placeholder'])) { 

    							$fields[$slug][$key]['placeholder'] = $value['placeholder']; 

    						}

    						if (isset($keyorder)) { 


    							$fields[$slug][$key]['priority'] = $keyorder * 10; 

    						}


    						if (isset($value['new_options']) || isset($value['options'])) { 

    							if ((isset($value['new_options']) && ($value['new_options'] != '')) || (isset($value['options']) && ($value['options'] != ''))) {
    								$fields[$slug][$key]['options'] =$options;
    							}
    						}

                            $extraclass = array();
    						//builds extraclass array
		                    if (isset($value['extraclass']) && ($value['extraclass'] != '')) {
		      
		                        $tempclasses = explode(',',$value['extraclass']);
		      
		      
		                        
                      
                                foreach($tempclasses as $classval3){
    
                                    $extraclass[$classval3]  = $classval3;
      
                                }
			 
		                    }




    						$syscmafwpl_conditional_class = '';


    						
    						$syscmafwpl_conditional_class = syscmafwpl_get_visibility_class_combined($value);
    						


                            

    						if (isset($syscmafwpl_conditional_class) && ($syscmafwpl_conditional_class != '')) {
    							$extraclass[] = $syscmafwpl_conditional_class;
    						}


    						if (isset($extraclass) && ($extraclass != '')) {

    							foreach ($extraclass as $billingclassval) {
    								$fields[$slug][$key]['class'][] = $billingclassval;
    							}
    						}

    						


    						if (isset($value['validate'])) { 

    							$fields[$slug][$key]['validate'] =$value['validate'];

    						}

    						if (isset($value['disable_past'])) { 

    							$fields[$slug][$key]['disable_past'] =$value['disable_past'];

    						}
			            } //end of if key matches

			            //if key does not match

			            if (isset($plugin_fields[$key2]) && (!isset($fields[$slug][$key2]))) {



			        	    if (isset($plugin_fields[$key2])) {
			        		    $fields[$slug][$key2] = $value;
			        	    }

			        	    if (isset($value['width']) && ($value['width'] != '')) {
			        		    $fields[$slug][$key2]['class'][] =$value['width'];
			        	    }

                            $extraclass = array();
			        	    //builds extraclass array
		                    if (isset($value['extraclass']) && ($value['extraclass'] != '')) {
		      
		                        $tempclasses = explode(',',$value['extraclass']);
		      
		      
		                        
                      
                                foreach($tempclasses as $classval3){
    
                                    $extraclass[$classval3]  = $classval3;
      
                                }
			 
		                    }


			        	    $syscmafwpl_conditional_class = '';


			        	    if (isset($value['visibility'])) {
			        		    $syscmafwpl_conditional_class = syscmafwpl_get_visibility_class_combined($value);
			        	    }




			        	    if (isset($syscmafwpl_conditional_class) && ($syscmafwpl_conditional_class != '')) {
			        		    $extraclass[] = $syscmafwpl_conditional_class;
			        	    }


			        	    if (isset($extraclass) && ($extraclass != '')) {

			        		    foreach ($extraclass as $billingclassval2) {

			        			    $fields[$slug][$key2]['class'][] = $billingclassval2;

			        		    }

			        	    }

                            if ((isset($value['new_options']) && ($value['new_options'] != '')) || (isset($value['options']) && ($value['options'] != ''))) {

			        		    $fields[$slug][$key2]['options'] =$options;
			        	    }

			        	    if (isset($keyorder)) { 

			        	    	$new_keyorder = ($keyorder * 10) + 10;


			        		    $fields[$slug][$key2]['priority'] =  $new_keyorder;

			        	    }
			            }
			            //end of if key does not match
			        }
			    }



			$keyorder++;
		}
	}







	if (isset($plugin_fields) && ($plugin_fields != '')) {

		foreach ($plugin_fields as $hidekey=>$hidevalue) {

			if (isset($hidevalue['hide']) && ($hidevalue['hide'] == 1)) {
				unset($fields[$slug][$hidekey]);
			}


			$visibilityarray = isset($hidevalue['visibility']) ? $hidevalue['visibility'] : array();

            if (isset($hidevalue['products'])) { 
            	$allowedproducts = $hidevalue['products'];
            } else {
            	$allowedproducts = array(); 
            }

            if (isset($hidevalue['category'])) {
            	$allowedcats = $hidevalue['category'];
            } else {
            	$allowedcats = array();
            }

            if (isset($hidevalue['role'])) {
            	$allowedroles = $hidevalue['role'];
            } else {
            	$allowedroles = array();
            }

            if (isset($hidevalue['total-quantity'])) {
            	$total_quantity = $hidevalue['total-quantity'];
            } else {
            	$total_quantity = 0;
            }

            if (isset($hidevalue['specific-product'])) {
            	$prd = $hidevalue['specific-product'];
            } else {
            	$prd = 0;
            }

            if (isset($hidevalue['specific-quantity'])) {
            	$prd_qnty = $hidevalue['specific-quantity'];
            } else {
            	$prd_qnty = 0;
            }


            if (isset($hidevalue['dynamic_rules'])) { 
            	$dynamic_rules = $hidevalue['dynamic_rules'];
            } else {
            	$dynamic_rules = array(); 
            }

            if (isset($hidevalue['dynamic_visibility_criteria'])) { 
            	$dynamic_criteria = $hidevalue['dynamic_visibility_criteria'];
            } else {
            	$dynamic_criteria = 'match_all'; 
            }



            $is_field_hidden=syscmafwpl_check_if_field_is_hidden($visibilityarray,$allowedproducts,$allowedcats,$allowedroles,$total_quantity,$prd,$prd_qnty,$dynamic_rules,$dynamic_criteria);

            if ((isset($is_field_hidden)) && ($is_field_hidden == 0)) {

				unset($fields[$slug][$hidekey]);

			}

			if (isset($hidevalue['visibility'])) {

				$visibilityarray = $hidevalue['visibility'];

				if (isset($hidevalue['products'])) { 
					$allowedproducts = $hidevalue['products'];
				} else {
					$allowedproducts = array(); 
				}

				if (isset($hidevalue['category'])) {
					$allowedcats = $hidevalue['category'];
				} else {
					$allowedcats = array();
				}

				if (isset($value['role'])) {
					$allowedroles = $value['role'];
				} else {
					$allowedroles = array();
				}

				if (isset($value['total-quantity'])) {
					$total_quantity = $value['total-quantity'];
				} else {
					$total_quantity = 0;
				}


				if (isset($value['specific-product'])) {
					$prd = $value['specific-product'];
				} else {
					$prd = 0;
				}

				if (isset($value['specific-quantity'])) {
					$prd_qnty = $value['specific-quantity'];
				} else {
					$prd_qnty = 0;
				}

				if (isset($value['dynamic_rules'])) { 
					$dynamic_rules = $value['dynamic_rules'];
				} else {
					$dynamic_rules = array(); 
				}

				if (isset($value['dynamic_visibility_criteria'])) { 
					$dynamic_criteria = $value['dynamic_visibility_criteria'];
				} else {
					$dynamic_criteria = 'match_all'; 
				}


				$is_field_hidden = syscmafwpl_check_if_field_is_hidden($visibilityarray,$allowedproducts,$allowedcats,$allowedroles,$total_quantity,$prd,$prd_qnty,$dynamic_rules,$dynamic_criteria);



				if (isset($is_field_hidden) && ($is_field_hidden != 1)) {
					unset($fields[$slug][$hidekey]);
				}


				
			}
		}
	}



	return $fields;


}

}



if ( ! function_exists( 'syscmafwpl_get_conditional_class' ) ) {

    /**
	 * returns conditional classes
	 *
	 * @access public
	 * @subpackage	Forms
	 */



    function syscmafwpl_get_conditional_class($conditional) {



    	$class = '';

    	$parent_visibility_class = '';

        

    	foreach ($conditional as $key=>$value) {

            if (isset($value['showhide'])) {
            	$showhide                 = $value['showhide'];
            }

            if (isset($value['parentfield'])) {
            	$parentfield               = $value['parentfield'];
            }

            

            if (isset($showhide) && ($showhide == "open") && isset($parentfield)) {

            	$parent_visibility   = pfcme_parent_visibility_check($parentfield);

            	if (isset($parent_visibility) && ($parent_visibility == 'hidden')) {
            	    $parent_visibility_class = 'parent_hidden';
                } 
            }



            if (isset($value['equalto'])) {
            	$equalto               = $value['equalto'];
            	$equalto = str_replace(' ', '_', $equalto);
            }
    		
	        
	        if ((isset($showhide)) && (isset($parentfield))) {

	        	if (isset($equalto) && ($equalto != '')) {
			        $class  .= 'dpnd_on_' . $parentfield . ' ' . $showhide . '_by_' . $parentfield . '_' . $equalto .' '.$parent_visibility_class.''; 
	            } else {
			        $class  .= '' . $showhide . '_by_' . $parentfield . ' '.$parent_visibility_class.''; 
		        }
	        }

	        

    	}
    

		return $class;
    }
   
}



if ( ! function_exists( 'syscmafwpl_get_conditional_shipping_class' ) ) {

    /**
	 * returns conditional classes
	 *
	 * @access public
	 * @subpackage	Forms
	 */



    function syscmafwpl_get_conditional_shipping_class($shipping) {

    	$shipping_method = $shipping['method'];
    	$showhide        = $shipping['showhide'];

    	switch ($showhide) {
    		case "show":
    		    $showhide_class2 ="hide_on_load";
    		break;

    		case "hide":
    		     $showhide_class2 ="show_on_load";
    		break;
    		
    	}


    	$class = ''.$showhide_class2.' '.$showhide.'_by_shipping_method_'. $shipping_method .'';


    	return $class;
    }

}



if ( ! function_exists( 'syscmafwpl_get_conditional_payment_class' ) ) {

    /**
	 * returns conditional classes
	 *
	 * @access public
	 * @subpackage	Forms
	 */



    function syscmafwpl_get_conditional_payment_class($payment) {

    	$payment_geteway = $payment['gateway'];
    	$showhide        = $payment['showhide'];

    	switch ($showhide) {
    		case "show":
    		    $showhide_class3 ="hide_on_load2";
    		break;

    		case "hide":
    		     $showhide_class3 ="show_on_load2";
    		break;
    		
    	}

    	$class = ''.$showhide_class3.' '.$showhide.'_by_payment_gateway_'.$payment_geteway.'';
    

		return $class;
    }
   
}


if ( ! function_exists( 'syscmafwpl_get_siteurl' ) ) {

    /**
	 * returns conditional classes
	 *
	 * @access public
	 * @subpackage	Forms
	 */



    function syscmafwpl_get_siteurl() {
    	$domain = get_option( 'siteurl' );
    	$domain = str_replace( 'http://', '', $domain );
    	$domain = str_replace( 'https://', '', $domain );
    	$domain = str_replace( 'www', '', $domain );
    	return urlencode( $domain );
    }

}



if ( ! function_exists( 'syscmafwpl_get_visibility_class_combined' ) ) {

    /**
	 * returns conditional classes
	 *
	 * @access public
	 * @subpackage	Forms
	 */



    function syscmafwpl_get_visibility_class_combined($value) {

    	$syscmafwpl_conditional_class = '';

    	if (isset($value['conditional'])) {
    		$syscmafwpl_conditional_class .= syscmafwpl_get_conditional_class($value['conditional']);
    	}

    	
    	if (isset($value['visibility'])) {

    		switch($value['visibility']) {

    			

    			case "shipping-specific":
    			$syscmafwpl_conditional_class = syscmafwpl_get_conditional_shipping_class($value['shipping']);
    			break;

    			case "payment-specific":
    			$syscmafwpl_conditional_class = syscmafwpl_get_conditional_payment_class($value['payment']);
    			break;

    		}

    	}



    	return $syscmafwpl_conditional_class;
    }

}







if ( ! function_exists( 'syscmafwplinput_conditional_class' ) ) {
	
	function syscmafwplinput_conditional_class($fieldkey) {

		$billing_settings_key      = 'syscmafwpl_billing_settings';
	    $shipping_settings_key     = 'syscmafwpl_shipping_settings';
	    $syscmafwpl_additional_settings = 'syscmafwpl_additional_settings';
		$syscmafwpl_class_text          = '';
		 
		 
		$billing_fields                = (array) get_option( $billing_settings_key );
		$shipping_fields               = (array) get_option( $shipping_settings_key );
		$additional_fields             = (array) get_option( $syscmafwpl_additional_settings );
		 
		$hiderlist  = array();
		$openerlist = array();
		 
		foreach ($billing_fields as $billingkey=>$billingvalue) {

			
			if (isset($billingvalue['conditional'])) {
				$conditional                = $billingvalue['conditional'];



				foreach ($conditional as $key1=>$value1) {

					if (isset($value1['parentfield'])) {
						$parentfield1               = $value1['parentfield'];
					}

					if (isset($value1['showhide'])) {
						$cxshowhide1               = $value1['showhide'];
					}




					if (isset($parentfield1) && ($parentfield1 != '')) {

						if (isset($cxshowhide1) && ($cxshowhide1 != '')) {
							switch ($cxshowhide1) {
								case "open":
								if (!in_array($parentfield1, $openerlist)) array_push($openerlist, $parentfield1);
								break;

								case "hide":
								if (!in_array($parentfield1, $hiderlist)) array_push($hiderlist, $parentfield1);
								break;
							}
						}
					}
				}

			}
               
		}
		 
		foreach ($shipping_fields as $shippingkey=>$shippingvalue) {

			    
			    if (isset($shippingvalue['conditional'])) {

			    				    $conditional2                = $shippingvalue['conditional'];

			    foreach ($conditional2 as $key2=>$value2) {

			 	    if (isset($value2['parentfield'])) {
                    	$parentfield2               = $value2['parentfield'];
                    }

                    if (isset($value2['showhide'])) {
                    	$cxshowhide2                = $value2['showhide'];
                    }

			        if (isset($parentfield2) && ($parentfield2 != '')) {
				
				        if (isset($cxshowhide2) && ($cxshowhide2 != '')) {
					        switch ($cxshowhide2) {
						        case "open":
						            if (!in_array($parentfield2, $openerlist)) array_push($openerlist, $parentfield2);
						        break;
						
						        case "hide":
						            if (!in_array($parentfield2, $hiderlist)) array_push($hiderlist, $parentfield2);
						        break;
						    }
				        }
			        }
			    }

			    }
			
			  
		}
		 
		 
        
        foreach ($additional_fields as $additionalkey=>$additionalvalue) {

	
			 
			    if (isset($additionalvalue['conditional'])) {
			    	$conditional3                = $additionalvalue['conditional'];
			    }
			    
                if (isset($conditional3)) {

			        foreach ($conditional3 as $key3=>$value3) {

			 	        if (isset($value3['parentfield'])) {
                    	    $parentfield3               = $value3['parentfield'];
                        }

                        if (isset($value3['showhide'])) {
                    	    $cxshowhide3                = $value3['showhide'];
                        }

			            if (isset($parentfield3) && ($parentfield3 != '')) {
				
				            if (isset($cxshowhide3) && ($cxshowhide3 != '')) {
					            switch ($cxshowhide3) {
						            case "open":
						                if (!in_array($parentfield3, $openerlist)) array_push($openerlist, $parentfield3);
						            break;
						
						            case "hide":
						                if (!in_array($parentfield3, $hiderlist)) array_push($hiderlist, $parentfield3);
						            break;
						        }
				            }
			            }
			        }
			    }
			  
		}
		 
		   
		if (in_array($fieldkey, $openerlist)) {

			$syscmafwplopernertext                = 'syscmafwpl-opener';

		} else {

			$syscmafwplopernertext                = '';
		}
		   
		if (in_array($fieldkey, $hiderlist)) {

			$syscmafwplhidertext                 = 'syscmafwpl-hider';

		} else {

			$syscmafwplhidertext                 = '';
		}
			
			
		$syscmafwpl_class_text  = ''.$syscmafwplopernertext.' '.$syscmafwplhidertext.'';
			
		    
			
	    return $syscmafwpl_class_text;
	}
	        
}
?>