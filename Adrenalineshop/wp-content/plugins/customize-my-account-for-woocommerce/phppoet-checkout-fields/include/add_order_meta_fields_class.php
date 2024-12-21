<?php
class syscmafwpl_add_order_meta_class {
     
	 
	 private $billing_settings_key = 'syscmafwpl_billing_settings';
	 private $shipping_settings_key = 'syscmafwpl_shipping_settings';
	 private $additional_settings_key = 'syscmafwpl_additional_settings';
     
	 public function __construct() {
	      
	      
	      add_filter('woocommerce_checkout_update_order_meta', array( $this, 'update_order_meta' ) );
	      add_filter('woocommerce_admin_order_data_after_billing_address', array( $this, 'data_after_billing_address' ) );
	      add_filter('woocommerce_email_order_meta', array( $this, 'woocommerce_custom_new_order_templace' )  );
	      add_filter('wpo_wcpdf_after_order_data', array( $this, 'woocommerce_custom_new_pdfinvoice_template' )  ,10,2);
		  
          add_filter('woocommerce_view_order', array($this, 'data_after_order_details_page'), 195);


        $extra_settings            = get_option('syscmafwpl_extra_settings');

        $thankyou_fields_location  = isset($extra_settings['thankyou_fields_location']) ? $extra_settings['thankyou_fields_location'] : "after"; 

		
		switch($thankyou_fields_location) {
			
			case "after":
			  add_filter('woocommerce_thankyou', array($this, 'data_after_order_details_page'), 75);
			break;
			  
			case "before":
			  add_filter('woocommerce_before_thankyou', array($this, 'data_after_order_details_page'), 75);
			break;
			
			
			 
			default:
			  add_filter('woocommerce_thankyou', array($this, 'data_after_order_details_page'), 75);
			
		}
	      
	}
	
	
	public function get_core_address_labels($field,$key) {
		
		if (isset($field['label']) && ($field['label'] != '')) { 
			$label = $field['label']; 
	    }  else {
			switch ($key) {
                case "billing_address_1":
				case "shipping_address_1":
                    $label = esc_html__('Address','customize-my-account-for-woocommerce');
                break;
                
				case "billing_address_2":
				case "shipping_address_2":
                    $label = "";
                break;
                        
				case "billing_city":
				case "shipping_city":
                    $label = esc_html__('Town / City','customize-my-account-for-woocommerce');
                break;
						
				case "billing_state":
			    case "shipping_state":
                    $label = esc_html__('State / County','customize-my-account-for-woocommerce');
                break;
						
				case "billing_postcode":
				case "shipping_postcode":
                    $label = esc_html__('Postcode / Zip','customize-my-account-for-woocommerce');
                break;
						
						
						
                default:
                    $label = $key;
            }
	    }
		
		return ucfirst($label);
	
	}
	 
	 public function woocommerce_custom_new_pdfinvoice_template ($template,$order) {
           
		   
		    $billing_fields                = (array) get_option( $this->billing_settings_key );
		    $shipping_fields               = (array) get_option( $this->shipping_settings_key );
		    $additional_fields             = (array) get_option( $this->additional_settings_key );
		   
	
		   
		    foreach ($billing_fields as $billingkey=>$billing_field) {
			    
				if (isset($billing_field['pdfinvoice'])) {
					  
				    $order_id = $order->get_id();
				    $billingkeyvalue = get_post_meta( $order_id, $billingkey, true );
				    $billingkeyvalue = str_replace("_"," ",$billingkeyvalue);
					  
				    if ( ! empty( $billingkeyvalue ) && ($billingkeyvalue != 'empty') && ($billingkeyvalue != 845675668)) { ?>
				          
						<tr class="billing-nif">
                            <th><?php echo $this->get_core_address_labels($billing_field,$billingkey); ?></th>
                            <td><?php echo $billingkeyvalue; ?></td>
                        </tr>
					<?php	} else if (($billingkeyvalue == 'empty') || ($billingkeyvalue == 845675668)) {
                        delete_post_meta( $order_id, $billingkey);
					}	
			
			    }
			}
		   
		   
		   
		   
		     foreach ($shipping_fields as $shippingkey=>$shipping_field) {
			    
		     	if (isset($shipping_field['pdfinvoice'])) {

		     		$order_id = $order->get_id();   
		     		$shippingkeyvalue = get_post_meta( $order_id, $shippingkey, true );
		     		$shippingkeyvalue = str_replace("_"," ",$shippingkeyvalue);

		     		if ( ! empty( $shippingkeyvalue ) && ($shippingkeyvalue != 'empty') && ($shippingkeyvalue != 845675668)) { ?>

		     			<tr class="billing-nif">
		     				<th><?php echo $this->get_core_address_labels($shipping_field,$shippingkey); ?></th>
		     				<td><?php echo $shippingkeyvalue; ?></td>
		     			</tr>
		     			<?php
		     		} else if (($shippingkeyvalue == 'empty') || ($shippingkeyvalue == 845675668)) {
		     			delete_post_meta( $order_id, $shippingkey);
		     		}	
		     	}  					
				      
                    
				
			 }
		   

		   foreach ($additional_fields as $additionalkey=>$additional_field) {
                
		   	if (isset($additional_field['pdfinvoice'])) {

		   		$order_id = $order->get_id();
		   		$additionalkeyvalue = get_post_meta( $order_id, $additionalkey, true );
		   		$additionalkeyvalue = str_replace("_"," ",$additionalkeyvalue);

		   		if ( ! empty( $additionalkeyvalue ) && ($additionalkeyvalue != 'empty') && ($additionalkeyvalue != 845675668)) { ?>

		   			<tr class="billing-nif">
		   				<th><?php echo $additional_field['label']; ?></th>
		   				<td><?php echo $additionalkeyvalue; ?></td>
		   			</tr>
		   			<?php	
		   		} else if (($additionalkeyvalue == 'empty') || ($additionalkeyvalue == 845675668)) {
		   			delete_post_meta( $order_id, $additionalkey);
		   		}

		   	}

		   }
	    }
		
	 	public function update_order_meta($order_id) {
		   
		   $billing_fields      = (array) get_option( $this->billing_settings_key );
		   $shipping_fields     = (array) get_option( $this->shipping_settings_key );
		   $additional_fields   = (array) get_option( $this->additional_settings_key );
	       
		   
		   
		     foreach ($billing_fields as $billingkey=>$billing_field) {
			   
				   if ((isset($billing_field['orderedition'])) || (isset($billing_field['emailfields'])) || (isset($billing_field['pdfinvoice']))) {
				     if ( ! empty( $_POST[$billingkey] ) ) {
						 
						if (is_array($_POST[$billingkey]))  {
							$billingkeyvalue = implode(',', $_POST[$billingkey]);
						} else {
							$billingkeyvalue = $_POST[$billingkey];
							
						}
						 
                        update_post_meta( $order_id, $billingkey, sanitize_text_field( $billingkeyvalue ) );
                       } 
				   }
				
			 }
		   
		   
		   
		   
		     foreach ($shipping_fields as $shippingkey=>$shipping_field) {
			    
				   if ((isset($shipping_field['orderedition'])) || (isset($shipping_field['emailfields'])) || (isset($shipping_field['pdfinvoice']))) {
				     if ( ! empty( $_POST[$shippingkey] ) ) {
						 
						if (is_array($_POST[$shippingkey]))  {
							$shippingkeyvalue = implode(',', $_POST[$shippingkey]);
						} else {
							$shippingkeyvalue = $_POST[$shippingkey];
						}
						
                        update_post_meta( $order_id, $shippingkey, sanitize_text_field( $shippingkeyvalue ) );
                       } 
				   }
				
			 }
		   

		   foreach ($additional_fields as $additionalkey=>$additional_field) {
		   	    if ((isset($additional_field['orderedition'])) || (isset($additional_field['emailfields'])) || (isset($additional_field['pdfinvoice']))) {
				     if ( ! empty( $_POST[$additionalkey] ) ) {
						 
						if (is_array($_POST[$additionalkey]))  {
							$additionalkeyvalue = implode(',', $_POST[$additionalkey]);
						} else {
							$additionalkeyvalue = $_POST[$additionalkey];
						}
						
                        update_post_meta( $order_id, $additionalkey, sanitize_text_field( $additionalkeyvalue ) );
                       } 
				   }
		   }
		   
		   
	       
	 }   
	 
	    public function data_after_order_details_page($orderid)  {
	       
	      
		   
		   
		   $billing_fields      = (array) get_option( $this->billing_settings_key );
		   $shipping_fields     = (array) get_option( $this->shipping_settings_key );
           $additional_fields   = (array) get_option( $this->additional_settings_key );
		   
		     ?>
		   <table class="shop_table additional_details">
		    <tbody>
		    <?php
		     foreach ($billing_fields as $billingkey=>$billing_field) {
			    
				    if (isset($billing_field['orderedition'])) {
					  
				  
				        $billingkeyvalue = get_post_meta( $orderid, $billingkey, true );

				        $billingkeyvalue = str_replace("_"," ",$billingkeyvalue);
					  
				        if ( ! empty( $billingkeyvalue ) && ($billingkeyvalue != 'empty') && ($billingkeyvalue != 845675668)) { ?>
				          
						   <tr>
                             <th><?php echo $this->get_core_address_labels($billing_field,$billingkey); ?>:</th>
                             <td><?php echo $billingkeyvalue; ?></td>
                           </tr>
					    <?php	} else if (($billingkeyvalue == 'empty') || ($billingkeyvalue == 845675668)) {
		   			             delete_post_meta( $orderid, $billingkey);
		   		        }	
			
			        }
			 }
		   
		   
		   
		   
		     foreach ($shipping_fields as $shippingkey=>$shipping_field) {
			    
		     	if (isset($shipping_field['orderedition'])) {


		     		$shippingkeyvalue = get_post_meta( $orderid, $shippingkey, true );
		     		$shippingkeyvalue = str_replace("_"," ",$shippingkeyvalue);

		     		if ( ! empty( $shippingkeyvalue )  && ($shippingkeyvalue != 'empty') && ($shippingkeyvalue != 845675668)) { ?>

		     			<tr>
		     				<th><?php echo $this->get_core_address_labels($shipping_field,$shippingkey); ?>:</th>
		     				<td><?php echo $shippingkeyvalue; ?></td>
		     			</tr>
		     			<?php 
		     		} else if (($shippingkeyvalue == 'empty') || ($shippingkeyvalue == 845675668)) {
		     			delete_post_meta( $orderid, $shippingkey);
		     		}		
		     	}  					
				      
                    
				
			 }
		   

		   foreach ($additional_fields as $additionalkey=>$additional_field) {
              if (isset($additional_field['orderedition'])) {
					  
			            $additionalkeyvalue = get_post_meta( $orderid, $additionalkey, true );
			            $additionalkeyvalue = str_replace("_"," ",$additionalkeyvalue);
					
				         if ( ! empty( $additionalkeyvalue ) && ($additionalkeyvalue != 'empty') && ($additionalkeyvalue != 845675668)) { ?>
				          
						   <tr>
                             <th><?php echo $additional_field['label']; ?>:</th>
                             <td><?php echo $additionalkeyvalue; ?></td>
                           </tr>
					   <?php 
					    } else if (($additionalkeyvalue == 'empty') || ($additionalkeyvalue == 845675668)) {
		     			    delete_post_meta( $orderid, $additionalkey);
		     		    }		
				      
                     }

		   }
		   ?>
		   </tbody>
		   </table>
	       <?php  
	    }
	 
	 	 public function data_after_billing_address($order)  {
	       
	      
		   
		   $order_id            = $order->get_id();
		   $billing_fields      = (array) get_option( $this->billing_settings_key );
		   $shipping_fields     = (array) get_option( $this->shipping_settings_key );
           $additional_fields   = (array) get_option( $this->additional_settings_key );
		   
		   
		  
		     foreach ($billing_fields as $billingkey=>$billing_field) {
			    
				  if (isset($billing_field['orderedition'])) {
					 
					 $billingkeyvalue = get_post_meta( $order_id, $billingkey, true );
					 $billingkeyvalue = str_replace("_"," ",$billingkeyvalue);

				     if ( ! empty( $billingkeyvalue ) && ($billingkeyvalue != 'empty') && ($billingkeyvalue != 845675668)) {
						 echo '<p><strong>'.__(''.$this->get_core_address_labels($billing_field,$billingkey).'').':</strong> ' . $billingkeyvalue . '</p>';
                     } else if (($billingkeyvalue == 'empty') || ($billingkeyvalue == 845675668) ) {
		     			    delete_post_meta( $order_id, $billingkey);
		     		  }							 
					 
				   }
				
			 }
		   
		   
		   
		    foreach ($shipping_fields as $shippingkey=>$shipping_field) {
				
				
			    
				   if (isset($shipping_field['orderedition'])) {
					  
					 $shippingkeyvalue = get_post_meta( $order_id, $shippingkey, true );
					 $shippingkeyvalue = str_replace("_"," ",$shippingkeyvalue);
					 
					  if ( ! empty( $shippingkeyvalue ) && ($shippingkeyvalue != 'empty') && ($shippingkeyvalue != 845675668)) {
						  echo '<p><strong>'.__(''.$this->get_core_address_labels($shipping_field,$shippingkey).'').':</strong> ' . $shippingkeyvalue . '</p>';
					  } else if (($shippingkeyvalue == 'empty') && ($shippingkeyvalue == 845675668)) {
		     			    delete_post_meta( $order_id, $shippingkey);
		     		  }		
				     
				   }
				
			}
		   
            
		    foreach ($additional_fields as $additionalkey=>$additional_field) {
		   	    if (isset($additional_field['orderedition'])) {
					
					$additionalkeyvalue = get_post_meta( $order_id, $additionalkey, true );
					$additionalkeyvalue = str_replace("_"," ",$additionalkeyvalue);
				    
					if ( ! empty( $additionalkeyvalue ) && ($additionalkeyvalue != 'empty') && ($additionalkeyvalue != 845675668) ) {
					   echo '<p><strong>'.__(''.$additional_field['label'].'').':</strong> ' . $additionalkeyvalue . '</p>';
					} else if (($additionalkeyvalue == 'empty') && ($additionalkeyvalue == 845675668)) {
		     			delete_post_meta( $order_id, $additionalkey);
		     		}		
					
					
                 }
		   }
	       
	 }
	 
	 public function woocommerce_custom_new_order_templace ($order) {
          
		   $order_id            = $order->get_id();
		   $billing_fields      = (array) get_option( $this->billing_settings_key );
		   $shipping_fields     = (array) get_option( $this->shipping_settings_key );
           $additional_fields   = (array) get_option( $this->additional_settings_key );
		   
		     ?>
		     <div style="margin-bottom: 40px;">
		     	<table cellspacing="0" cellpadding="6" border="1" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;width:100%;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif" width="100%">


		     		<tfoot>
		     			
		     			<?php
		     			foreach ($billing_fields as $billingkey=>$billing_field) {
		     				
		     				if (isset($billing_field['emailfields'])) {
		     					
		     					
		     					$billingkeyvalue = get_post_meta( $order_id, $billingkey, true );
		     					$billingkeyvalue = str_replace("_"," ",$billingkeyvalue);
		     					
		     					if ( ! empty( $billingkeyvalue ) && ($billingkeyvalue != 'empty') && ($billingkeyvalue != 845675668)) { ?>
		     						
		     						<tr>
		     							<th scope="row" colspan="2" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left;border-top-width:4px" align="left">
		     								<?php echo $this->get_core_address_labels($billing_field,$billingkey); ?>
		     									
		     							</th>
		     							<td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left;border-top-width:4px" align="left"><?php echo $billingkeyvalue; ?>
		     								
		     							</td>
		     						</tr>
		     					<?php	} else if ($billingkeyvalue == 'empty') {
		     			              delete_post_meta( $order_id, $billingkey);
		     		                }		
		     					
		     				}
		     			}
		     			
		     			
		     			
		     			
		     			foreach ($shipping_fields as $shippingkey=>$shipping_field) {
		     				
		     				
		     				
		     				if (isset($shipping_field['emailfields'])) {
		     					
		     					
		     					$shippingkeyvalue = get_post_meta( $order_id, $shippingkey, true );
		     					$shippingkeyvalue = str_replace("_"," ",$shippingkeyvalue);
		     					
		     					if ( ! empty( $shippingkeyvalue ) && ($shippingkeyvalue != 'empty') && ($shippingkeyvalue != 845675668)) { ?>
		     						
		     						<tr>
		     							<th scope="row" colspan="2" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left;border-top-width:4px" align="left"><?php echo $this->get_core_address_labels($shipping_field,$shippingkey); ?></th>
		     							<td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left;border-top-width:4px" align="left"><?php echo $shippingkeyvalue; ?></td>
		     						</tr>
		     					<?php	} else if ($shippingkeyvalue == 'empty') {
		     			              delete_post_meta( $order_id, $shippingkey);
		     		                }		
		     				}  					
		     				
		     				
		     				
		     			}
		     			

		     			foreach ($additional_fields as $additionalkey=>$additional_field) {
		     				if (isset($additional_field['emailfields'])) {
		     					
		     					$additionalkeyvalue = get_post_meta( $order_id, $additionalkey, true );
		     					$additionalkeyvalue = str_replace("_"," ",$additionalkeyvalue);
		     					
		     					if ( ! empty( $additionalkeyvalue ) && ($additionalkeyvalue != 'empty') && ($shippingkeyvalue != 845675668)) { ?>
		     						
		     						<tr>
		     							<th scope="row" colspan="2" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left;border-top-width:4px" align="left"><?php echo ucfirst($additional_field['label']); ?></th>
		     							<td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left;border-top-width:4px" align="left"><?php echo $additionalkeyvalue; ?></td>
		     						</tr>
		     					<?php	}	else if ( ($additionalkeyvalue == 'empty') || ($additionalkeyvalue == 845675668) ) {
		     			              delete_post_meta( $order_id, $additionalkey);
		     		                }		
		     					
		     				}

		     			}
		     			?>
		     		</tfoot>
		     	</table>
		     </div>
	       <?php  
	 }
	 
}

new syscmafwpl_add_order_meta_class();
?>