var $iaz = jQuery.noConflict();
(function( $iaz ) {
    'use strict';

    $iaz.datetimepicker.setLocale(syscmafwplfrontend.datetimepicker_lang);

    function syscmafwpl_convert_datesdisable_to_format($disable_days) {

    	

    	var str_array = $disable_days.split(',');

    	var new_string = '';

    	for(var i = 0; i < str_array.length; i++) {
  
        new_string += '"'+str_array[i]+'",';
        
    	}

    	console.log(new_string);

    	return new_string;
    }


	var datepicker_format = syscmafwplfrontend.datepicker_format;

    switch(datepicker_format) {
          case "01":
            var dtformat = 'd/m/Y';
          break;
          case "02":
            var dtformat = 'd-m-Y';
          break;
          case "03":
            var dtformat = 'd F Y';
          break;
          case "04":
            var dtformat = 'm/d/Y';
          break;
          case "05":
            var dtformat = 'm-d-Y';
          break;

          case "06":
            var dtformat = 'F d Y';
          break;


          default:
           var dtformat = 'd/m/Y';
    }

    var gdays ='';
    
    if ((syscmafwplfrontend.days_to_exclude) && (syscmafwplfrontend.days_to_exclude != '')) {

    	gdays = syscmafwplfrontend.days_to_exclude.split(',');
    	
    }

    gdays = '['+ gdays +']';
    

	$iaz(function() {


		if (jQuery('.syscmafwpl-datepicker').length) {

			jQuery('.syscmafwpl-datepicker').each(function(){

				var dates_to_disable = jQuery(this).attr("dates_to_disable");

				dates_to_disable = syscmafwpl_convert_datesdisable_to_format(dates_to_disable);

				jQuery(this).datetimepicker({
					format:dtformat,
					timepicker:false,
					disabledWeekDays: gdays,
					dayOfWeekStart: syscmafwplfrontend.dt_week_starts_on,
					disabledDates: dates_to_disable,
					formatDate:'d.m.Y'
				});

			});


			


		}

	    var dateToday = new Date(); 

	    if (jQuery('.syscmafwpl-datepicker-disable-past').length) {

	    	jQuery('.syscmafwpl-datepicker-disable-past').each(function(){

	    		var dates_to_disable = jQuery(this).attr("dates_to_disable");

	    		dates_to_disable = syscmafwpl_convert_datesdisable_to_format(dates_to_disable);


	    		jQuery(this).datetimepicker({
	    			format:dtformat,
	    			minDate: dateToday,
	    			timepicker:false,
	    			disabledWeekDays: gdays,
	    			dayOfWeekStart: syscmafwplfrontend.dt_week_starts_on,
	    			disabledDates: dates_to_disable,
					  formatDate:'d.m.Y'
	    		});
	    	});

	    }



	   if (jQuery('.syscmafwpl-daterangepicker').length) {
		  jQuery('.syscmafwpl-daterangepicker').dateRangePicker({
            format: 'DD/MM/YYYY',
            language: syscmafwplfrontend.datetimepicker_lang,
            startOfWeek:syscmafwplfrontend.week_starts_on,
            separator: ' '+syscmafwplfrontend.separater_text+' '
            
          });
	   }

	   var dateToday = new Date(); 
	   if (jQuery('.syscmafwpl-daterangepicker-disable-past').length) {
		  jQuery('.syscmafwpl-daterangepicker-disable-past').dateRangePicker({
            format: 'DD/MM/YYYY',
		    startDate: dateToday,
		    language: syscmafwplfrontend.datetimepicker_lang,
		    startOfWeek:syscmafwplfrontend.week_starts_on,
		    separator: ' '+syscmafwplfrontend.separater_text+' '
		    
          });
	   }



	    if (jQuery('.syscmafwpl-datetimerangepicker').length) {
		  jQuery('.syscmafwpl-datetimerangepicker').dateRangePicker({
                separator: ' '+syscmafwplfrontend.separater_text+' ',
                format: 'DD/MM/YYYY HH:mm',
                language: syscmafwplfrontend.datetimepicker_lang,
                startOfWeek:syscmafwplfrontend.week_starts_on,
                time: {
		          enabled: true
	            }
            
          });
	    }

	    var dateToday = new Date(); 
	    if (jQuery('.syscmafwpl-datetimerangepicker-disable-past').length) {

		    jQuery('.syscmafwpl-datetimerangepicker-disable-past').dateRangePicker({
            separator: ' '+syscmafwplfrontend.separater_text+' ',
            format: 'DD/MM/YYYY HH:mm',
		        startDate: dateToday,
		        language: syscmafwplfrontend.datetimepicker_lang,
		        startOfWeek:syscmafwplfrontend.week_starts_on,
		        time: {
		         enabled: true
	            }
		    
            });
	    }
              
	   
    });


	$iaz(function() {

		if (jQuery('.syscmafwpl-datetimepicker').length) {

			jQuery('.syscmafwpl-datetimepicker').each(function() {

				var dates_to_disable = jQuery(this).attr("dates_to_disable");

				dates_to_disable = syscmafwpl_convert_datesdisable_to_format(dates_to_disable);


				var allowed_times_global = syscmafwplfrontend.allowed_times;

				var allowed_times_field = jQuery(this).attr("t_allowed");


				if ((allowed_times_field) && (allowed_times_field != '')) {
					var allowed_times_final = allowed_times_field;
				} else {
					var allowed_times_final = allowed_times_global;
				}



				jQuery(this).datetimepicker({
					format:''+ dtformat + ' H:i',
					dayOfWeekStart: syscmafwplfrontend.dt_week_starts_on,
					disabledDates: dates_to_disable,
					formatDate:'d.m.Y',
					allowTimes: function getArr() {


						if ((allowed_times_final) && (allowed_times_final != '')) {

							  var gTimes = allowed_times_final.split(',');


							  return gTimes;

						}

					}()
				});

			});

			
		}

		var dateToday = new Date(); 

		if (jQuery('.syscmafwpl-datetimepicker-disable-past').length) {

			jQuery('.syscmafwpl-datetimepicker-disable-past').each(function() {

				var dates_to_disable = jQuery(this).attr("dates_to_disable");

				dates_to_disable = syscmafwpl_convert_datesdisable_to_format(dates_to_disable);


				var allowed_times_global = syscmafwplfrontend.allowed_times;

				var allowed_times_field = jQuery(this).attr("t_allowed");


				if ((allowed_times_field) && (allowed_times_field != '')) {
					var allowed_times_final = allowed_times_field;
				} else {
					var allowed_times_final = allowed_times_global;
				}


				jQuery(this).datetimepicker({
					minDate: dateToday,
					format:''+ dtformat + ' H:i',
					dayOfWeekStart: syscmafwplfrontend.dt_week_starts_on,
					disabledDates: dates_to_disable,
					formatDate:'d.m.Y',
					allowTimes: function getArr() {


						if ((allowed_times_final) && (allowed_times_final != '')) {

							  var gTimes = allowed_times_final.split(',');


							  return gTimes;

						}

					}()
				});

			});
			
		}

	});


	$iaz(function() {

		if (jQuery('.syscmafwpl-timepicker').length) {

			jQuery('.syscmafwpl-timepicker').each(function() {

				var allowed_times_global = syscmafwplfrontend.allowed_times;

				var allowed_times_field = jQuery(this).attr("t_allowed");


				if ((allowed_times_field) && (allowed_times_field != '')) {
					var allowed_times_final = allowed_times_field;
				} else {
					var allowed_times_final = allowed_times_global;
				}
        



				jQuery(this).datetimepicker({


					format:'H:i',
					datepicker:false,
					dayOfWeekStart: syscmafwplfrontend.dt_week_starts_on,
					step:syscmafwplfrontend.timepicker_interval,
					allowTimes: function getArr() {


						if ((allowed_times_final) && (allowed_times_final != '')) {

							  var gTimes = allowed_times_final.split(',');


							  return gTimes;

						}

					}()

				});

			});
		}

	});


	
   	
	$iaz(function() {

		if ($iaz('.syscmafwpl-multiselect').length) {
			$iaz('.syscmafwpl-multiselect').select2({});
		}



		if ($iaz('.parent_hidden').length) {
			$iaz('.parent_hidden').hide();
		}

    });
	
	
	$iaz(function() {

		$iaz('.syscmafwpl-opener').on('change',function(){
			var this_obj=$iaz(this);
			var id= this_obj.attr('id');
			var name= this_obj.attr('name');
			var uval = this_obj.val();




			if (this_obj.hasClass('syscmafwpl-singleselect')){


				$iaz('.open_by_'+ id +'_'+ uval).each(function() {

					var child_input = $iaz(this).find('input');
					var child_input_number = $iaz(this).find('input[type="number"]');
					var child_input_select = $iaz(this).find('.syscmafwpl-singleselect');

					var entered_value = child_input.val();
					var entered_value_number = child_input_number.val();
					var entered_value_select = child_input_select.val();

					$iaz(this).closest('.form-row').show();


					

					if ((entered_value != "") && (entered_value != "empty")) {
						child_input.val(entered_value);
					} else {
						child_input.val('');
					}


					if ((entered_value_number != "") && (entered_value_number != 845675668)) {
						child_input_number.val(entered_value_number);
					} else {
						child_input_number.val('');
					}
					

                    var previous_value = child_input.attr("pvalue");

					if ((previous_value != "") && (previous_value != "empty")) {
						child_input.val(previous_value);

						child_input.attr("pvalue","");
					}

					var previous_value_number = child_input_number.attr("pvalue");

					if ((previous_value_number != "") && (previous_value_number != 845675668)) {
						child_input_number.val(previous_value_number);

						child_input_number.attr("pvalue","");
					}



					var previous_value_select = child_input_select.attr("pvalue");



                    if ((previous_value_select != "") && (previous_value_select != "empty")) {
							child_input_select.val(previous_value_select).trigger("change");
						    
						  child_input_select.attr("pvalue",previous_value_select);
					} 

        

				});


        

				$iaz('.dpnd_on_'+ id +'').each(function() {

					var child_input = $iaz(this).find('input');
					var child_input_number = $iaz(this).find('input[type="number"]');
					var child_input_select = $iaz(this).find('.syscmafwpl-singleselect');


					var previous_value = child_input.val();
					var previous_value_number = child_input_number.val();
					var previous_value_select = child_input_select.val();



					if (!$iaz(this).hasClass('open_by_'+ id +'_'+uval)) {
						$iaz(this).closest('.form-row').hide();
						$iaz(this).closest('.form-row').find('input').val("empty");

						if ((previous_value != "") && (previous_value != "empty")) {
							child_input.val("empty");
							child_input.attr("pvalue",previous_value);
						}

						if ((previous_value_number != "") && (previous_value_number != 845675668)) {
							child_input_number.val(845675668);
							child_input_number.attr("pvalue",previous_value_number);
						}



						if ((previous_value_select != "") && (previous_value_select != "empty")) {
							child_input_select.prop('selectedIndex',0).trigger("change");

							child_input_select.attr("pvalue",previous_value_select);
						}


					};

					$iaz(this).find('.syscmafwpl-singleselect').val('selectedIndex',0).trigger("change");

				});


			

			} else if (this_obj.hasClass('syscmafwpl-multiselect')){


				$iaz('.open_by_'+ id +'_'+uval ).closest('.form-row').show();
				var child_input = $iaz('.open_by_'+ id +'_'+ uval +' input');
				var child_input_val = $iaz('.open_by_'+ id +'_'+ uval +' input');

				var child_input_number = $iaz('.open_by_'+ id +'_'+ uval +' input[type="number"]');
				child_input_number.val('');
				
				
			  child_input.val('');
                        //hide other   
				$iaz("[class^='open_by_"+ id +"_'],[class*=' open_by_"+ id +"_']").not('.open_by_'+ id +'_'+uval).closest('.form-row').hide();
				$iaz("[class^='open_by_"+ id +"_'],[class*=' open_by_"+ id +"_']").not('.open_by_'+ id +'_'+uval).closest('.form-row').find('input').val("empty");
				$iaz("[class^='open_by_"+ id +"_'],[class*=' open_by_"+ id +"_']").not('.open_by_'+ id +'_'+uval).closest('.form-row').find('input[type="number"]').val(845675668);


			} else if (this_obj.attr('type')=='checkbox') {

				

				if (this_obj.is(':checked')) {

					

					$iaz('.open_by_'+id).each(function(){

						$iaz(this).closest('.form-row').show();
						var child_input = $iaz(this).find('input');
						var child_input_number = $iaz(this).find('input[type="number"]');
						var child_input_select = $iaz(this).find('.syscmafwpl-singleselect');
            var child_input_hidden_file = $iaz(this).find('input.syscmafwpl_hidden_input_file');
            child_input_hidden_file.val("");

						child_input.val('');
						child_input_number.val('');
						


						var previous_value = child_input.attr("pvalue");

						if ((previous_value != "") && (previous_value != "empty")) {
							  child_input.val(previous_value);
						    
						    child_input.attr("pvalue","");
						}

						var previous_value_number = child_input_number.attr("pvalue");

						if ((previous_value_number != "") && (previous_value_number != 845675668)) {
							  child_input_number.val(previous_value_number);
						    
						    child_input_number.attr("pvalue","");
						}

						var previous_value_select = child_input_select.attr("pvalue");

						

						if ((previous_value_select != "") && (previous_value_select != "empty")) {
							  child_input_select.val(previous_value_select).trigger("change");
						    
						    child_input_select.attr("pvalue","");
						}

					});

					
				

				} else {

					

					$iaz('.open_by_'+id).each(function(){

						var child_input = $iaz(this).find('input');
            var child_input_number = $iaz(this).find('input[type="number"]');
            var child_input_select = $iaz(this).find('select');
            var child_input_hidden_file = $iaz(this).find('input.syscmafwpl_hidden_input_file');
            child_input_hidden_file.val("empty");
            
            

						var previous_value = child_input.val();
						var previous_value_number = child_input_number.val();
						var previous_value_select = child_input_select.val();

						
						

						$iaz(this).closest('.form-row').hide();

						
					
						child_input.val('empty').trigger("change");



						
						
						if ((previous_value != "") && (previous_value != "empty")) {
							child_input.val(previous_value).trigger("change");
							child_input.attr("pvalue",previous_value);
						}

						if ((previous_value_number != "") && (previous_value_number != 845675668)) {
							child_input_number.val(845675668).trigger("change");
							child_input_number.attr("pvalue",previous_value_number);
						}

						if ((previous_value_select != "") && (previous_value_select != "empty")) {
							

							child_input_select.prop('selectedIndex',0).trigger("change");
							child_input_select.attr("pvalue",previous_value_select);
						}

						
							
							
						
						
					});

				}

			
			} else if ( this_obj.attr('type')=='radio'){

				    $iaz('.open_by_'+ id +'_'+ uval).each(function() {

					var child_input = $iaz(this).find('input');
					var child_input_number = $iaz(this).find('input[type="number"]');
					var child_input_select = $iaz(this).find('.syscmafwpl-singleselect');

					var entered_value = child_input.val();
					var entered_value_number = child_input_number.val();
					var entered_value_select = child_input_select.val();

					$iaz(this).closest('.form-row').show();


					

					if ((entered_value != "") && (entered_value != "empty")) {
						child_input.val(entered_value);
					} else {
						child_input.val('');
					}


					if ((entered_value_number != "") && (entered_value_number != 845675668)) {
						child_input_number.val(entered_value_number);
					} else {
						child_input_number.val('');
					}
					

                    var previous_value = child_input.attr("pvalue");

					if ((previous_value != "") && (previous_value != "empty")) {
						child_input.val(previous_value);

						child_input.attr("pvalue","");
					}

					var previous_value_number = child_input_number.attr("pvalue");

					if ((previous_value_number != "") && (previous_value_number != 845675668)) {
						child_input_number.val(previous_value_number);

						child_input_number.attr("pvalue","");
					}



					var previous_value_select = child_input_select.attr("pvalue");



                    if ((previous_value_select != "") && (previous_value_select != "empty")) {
							child_input_select.val(previous_value_select).trigger("change");
						    
						  child_input_select.attr("pvalue",previous_value_select);
					} 

        

				});


        

				$iaz('.dpnd_on_'+ id +'').each(function() {

					var child_input = $iaz(this).find('input');
					var child_input_number = $iaz(this).find('input[type="number"]');
					var child_input_select = $iaz(this).find('.syscmafwpl-singleselect');


					var previous_value = child_input.val();
					var previous_value_number = child_input_number.val();
					var previous_value_select = child_input_select.val();



					if (!$iaz(this).hasClass('open_by_'+ id +'_'+uval)) {
						$iaz(this).closest('.form-row').hide();
						$iaz(this).closest('.form-row').find('input').val("empty");
						
						if ((previous_value != "") && (previous_value != "empty")) {
							child_input.val("empty");
							child_input.attr("pvalue",previous_value);
						}

						if ((previous_value_number != "") && (previous_value_number != 845675668)) {
							child_input_number.val(845675668);
							child_input_number.attr("pvalue",previous_value_number);
						}



						if ((previous_value_select != "") && (previous_value_select != "empty")) {
							child_input_select.prop('selectedIndex',0).trigger("change");
							
							child_input_select.attr("pvalue",previous_value_select);
						}
						
						
					};

					$iaz(this).find('.syscmafwpl-singleselect').val('selectedIndex',0).trigger("change");

				});



			} else if ( this_obj.attr('type')=='text'){
				$iaz('.open_by_'+ id +'_'+uval ).closest('.form-row').show();
				var child_input = $iaz('.open_by_'+ id +'_'+ uval +' input');
				var child_input_val = $iaz('.open_by_'+ id +'_'+ uval +' input').val();
					
					
				child_input.val('');
                        //hide other   
				$iaz("[class^='open_by_"+ id +"_'],[class*=' open_by_"+ id +"_']").not('.open_by_'+ id +'_'+uval).closest('.form-row').hide();
				$iaz("[class^='open_by_"+ id +"_'],[class*=' open_by_"+ id +"_']").not('.open_by_'+ id +'_'+uval).closest('.form-row').find('input').val("empty");	

			} else if ( this_obj.attr('type')=='tel'){

				$iaz('.open_by_'+ id +'_'+uval ).closest('.form-row').show();
				var child_input = $iaz('.open_by_'+ id +'_'+ uval +' input');
				var child_input_val = $iaz('.open_by_'+ id +'_'+ uval +' input').val();
					
					
				child_input.val('');
                        //hide other   
				$iaz("[class^='open_by_"+ id +"_'],[class*=' open_by_"+ id +"_']").not('.open_by_'+ id +'_'+uval).closest('.form-row').hide();
				$iaz("[class^='open_by_"+ id +"_'],[class*=' open_by_"+ id +"_']").not('.open_by_'+ id +'_'+uval).closest('.form-row').find('input').val("empty");	
			
			} else if ( this_obj.attr('type')=='number'){

     

				$iaz('.open_by_'+ id +'_'+uval ).closest('.form-row').show();
				var child_input = $iaz('.open_by_'+ id +'_'+ uval +' input');
				var child_input_val = $iaz('.open_by_'+ id +'_'+ uval +' input').val();
					
					
				child_input.val('');
                        //hide other   
				$iaz("[class^='open_by_"+ id +"_'],[class*=' open_by_"+ id +"_']").not('.open_by_'+ id +'_'+uval).closest('.form-row').hide();
				$iaz("[class^='open_by_"+ id +"_'],[class*=' open_by_"+ id +"_']").not('.open_by_'+ id +'_'+uval).closest('.form-row').find('input').val("empty");
			} else if ( this_obj.attr('type')=='password'){

				$iaz('.open_by_'+ id +'_'+uval ).closest('.form-row').show();
				var child_input = $iaz('.open_by_'+ id +'_'+ uval +' input');
				var child_input_val = $iaz('.open_by_'+ id +'_'+ uval +' input').val();
					
					
				child_input.val('');
                        //hide other   
				$iaz("[class^='open_by_"+ id +"_'],[class*=' open_by_"+ id +"_']").not('.open_by_'+ id +'_'+uval).closest('.form-row').hide();
				$iaz("[class^='open_by_"+ id +"_'],[class*=' open_by_"+ id +"_']").not('.open_by_'+ id +'_'+uval).closest('.form-row').find('input').val("empty");
			} else if (this_obj.is("textarea")){

				$iaz('.open_by_'+ id +'_'+uval ).closest('.form-row').show();
				var child_input = $iaz('.open_by_'+ id +'_'+ uval +' input');
				var child_input_val = $iaz('.open_by_'+ id +'_'+ uval +' input').val();
					
					
				child_input.val('');
                        //hide other   
				$iaz("[class^='open_by_"+ id +"_'],[class*=' open_by_"+ id +"_']").not('.open_by_'+ id +'_'+uval).closest('.form-row').hide();
				$iaz("[class^='open_by_"+ id +"_'],[class*=' open_by_"+ id +"_']").not('.open_by_'+ id +'_'+uval).closest('.form-row').find('input').val("empty");
			}


		});
	  
	  $iaz('.syscmafwpl-opener').trigger('change');

    $iaz('.syscmafwpl-price-changer').trigger('change');

    $iaz('.syscmafwpl-price-changer').on('change',function(){

            
      	jQuery('body').trigger('update_checkout');


    });



    $iaz('.hide_on_load').hide();

    $iaz('.show_on_load').show();  

    $iaz('.hide_on_load2').hide();

    $iaz('.show_on_load2').show();  
	  
	  
    $iaz('.syscmafwpl-hider').on('change',function(){


    	var this_obj=$iaz(this);
    	var id= this_obj.attr('id');
    	var name= this_obj.attr('name');
    	var hval = this_obj.val();

    	if (this_obj.hasClass('syscmafwpl-singleselect')){

    		$iaz('.hide_by_'+ id +'_'+hval ).closest('.form-row').hide();
    		var child_input = $iaz('.hide_by_'+ id +'_'+ hval +' input');
    		var child_input_number = $iaz('.hide_by_'+ id +'_'+ hval +' input[type="number"]');
    		child_input.val('empty');
    		child_input_number.val(845675668);
                        //hide other   
    		$iaz("[class^='hide_by_"+ id +"_'],[class*=' hide_by_"+ id+"_']").not('.hide_by_'+ id +'_'+hval).closest('.form-row').show();
    		$iaz("[class^='hide_by_"+ id +"_'],[class*=' hide_by_"+ id+"_']").not('.hide_by_'+ id +'_'+hval).closest('.form-row').find('input').val("");
        
        $iaz("[class^='hide_by_"+ id +"_'],[class*=' hide_by_"+ id+"_']").not('.hide_by_'+ id +'_'+hval).closest('.form-row').find('input[type="number"]').val("");
    	

    	} else if (this_obj.hasClass('syscmafwpl-multiselect')){

    		$iaz('.hide_by_'+ id +'_'+hval ).closest('.form-row').hide();
    		var child_input = $iaz('.hide_by_'+ id +'_'+ hval +' input');
    		child_input.val('empty');
                        //hide other   
    		$iaz("[class^='hide_by_"+ id +"_'],[class*=' hide_by_"+ id+"_']").not('.hide_by_'+ id +'_'+hval).closest('.form-row').show();
    		$iaz("[class^='hide_by_"+ id +"_'],[class*=' hide_by_"+ id+"_']").not('.hide_by_'+ id +'_'+hval).closest('.form-row').find('input').val("");

    	} else if (this_obj.attr('type')=='checkbox') {

        

				if (this_obj.is(':checked')) {




					

					$iaz('.hide_by_'+id).each(function() {

						var child_input = $iaz(this).find('input');
            var child_input_number = $iaz(this).find('input[type="number"]');
            var child_input_select = $iaz(this).find('select');
            var child_input_hidden_file = $iaz(this).find('input.syscmafwpl_hidden_input_file');
            child_input_hidden_file.val("empty");
            
            

						var previous_value = child_input.val();
						var previous_value_number = child_input_number.val();
						var previous_value_select = child_input_select.val();

						
						

						$iaz(this).closest('.form-row').hide();

						
					
						child_input.val('empty').trigger("change");



						
						
						if ((previous_value != "") && (previous_value != "empty")) {
							child_input.val(previous_value).trigger("change");
							child_input.attr("pvalue",previous_value);
						}

						if ((previous_value_number != "") && (previous_value_number != 845675668)) {
							child_input_number.val(845675668).trigger("change");
							child_input_number.attr("pvalue",previous_value_number);
						}

						if ((previous_value_select != "") && (previous_value_select != "empty")) {
							

							child_input_select.prop('selectedIndex',0).trigger("change");
							child_input_select.attr("pvalue",previous_value_select);
						}

						
							
							
						
						
					});

					
				

				} else {

					  

					$iaz('.hide_by_'+id).each(function(){

						$iaz(this).closest('.form-row').show();
						var child_input = $iaz(this).find('input');
						var child_input_number = $iaz(this).find('input[type="number"]');
						var child_input_select = $iaz(this).find('.syscmafwpl-singleselect');
						var child_input_hidden_file = $iaz(this).find('input.syscmafwpl_hidden_input_file');
						child_input_hidden_file.val("");

						child_input.val('');
						child_input_number.val('');
						


						var previous_value = child_input.attr("pvalue");

						if ((previous_value != "") && (previous_value != "empty")) {
							child_input.val(previous_value);

							child_input.attr("pvalue","");
						}

						var previous_value_number = child_input_number.attr("pvalue");

						if ((previous_value_number != "") && (previous_value_number != 845675668)) {
							child_input_number.val(previous_value_number);

							child_input_number.attr("pvalue","");
						}

						var previous_value_select = child_input_select.attr("pvalue");

						

						if ((previous_value_select != "") && (previous_value_select != "empty")) {
							child_input_select.val(previous_value_select).trigger("change");

							child_input_select.attr("pvalue","");
						}

					});

					

				}



    	} else if ( this_obj.attr('type')=='radio'){



    		$iaz('.hide_by_'+ id +'_'+hval ).closest('.form-row').hide();
    		var child_input = $iaz('.hide_by_'+ id +'_'+ hval +' input');
    		child_input.val('empty');
                        //hide other   
    		$iaz("[class^='hide_by_"+ id +"_'],[class*=' hide_by_"+ id+"_']").not('.hide_by_'+ id +'_'+hval).closest('.form-row').show();  
    		$iaz("[class^='hide_by_"+ id +"_'],[class*=' hide_by_"+ id+"_']").not('.hide_by_'+ id +'_'+hval).closest('.form-row').find('input').val("");    

    	} else if ( this_obj.attr('type')=='text'){

    		$iaz('.hide_by_'+ id +'_'+hval ).closest('.form-row').hide();
    		var child_input = $iaz('.hide_by_'+ id +'_'+ hval +' input');
    		child_input.val('empty');
                        //hide other   
    		$iaz("[class^='hide_by_"+ id +"_'],[class*=' hide_by_"+ id+"_']").not('.hide_by_'+ id +'_'+hval).closest('.form-row').show(); 
    		$iaz("[class^='hide_by_"+ id +"_'],[class*=' hide_by_"+ id+"_']").not('.hide_by_'+ id +'_'+hval).closest('.form-row').find('input').val("");

    	} else if ( this_obj.attr('type')=='tel'){

    		$iaz('.hide_by_'+ id +'_'+hval ).closest('.form-row').hide();
    		var child_input = $iaz('.hide_by_'+ id +'_'+ hval +' input');
    		child_input.val('empty');
                        //hide other   
    		$iaz("[class^='hide_by_"+ id +"_'],[class*=' hide_by_"+ id+"_']").not('.hide_by_'+ id +'_'+hval).closest('.form-row').show();
    		$iaz("[class^='hide_by_"+ id +"_'],[class*=' hide_by_"+ id+"_']").not('.hide_by_'+ id +'_'+hval).closest('.form-row').find('input').val("");       
    	}  else if ( this_obj.attr('type')=='number'){

    		

    		$iaz('.hide_by_'+ id +'_'+hval ).closest('.form-row').hide();
    		var child_input = $iaz('.hide_by_'+ id +'_'+ hval +' input');
    		child_input.val("empty");
                        //hide other   
    		$iaz("[class^='hide_by_"+ id +"_'],[class*=' hide_by_"+ id+"_']").not('.hide_by_'+ id +'_'+hval).closest('.form-row').show();
    		$iaz("[class^='hide_by_"+ id +"_'],[class*=' hide_by_"+ id+"_']").not('.hide_by_'+ id +'_'+hval).closest('.form-row').find('input').val("");        
    	}  else if ( this_obj.attr('type')=='password'){

    		$iaz('.hide_by_'+ id +'_'+hval ).closest('.form-row').hide();
    		var child_input = $iaz('.hide_by_'+ id +'_'+ hval +' input');
    		child_input.val('empty');
                        //hide other   
    		$iaz("[class^='hide_by_"+ id +"_'],[class*=' hide_by_"+ id+"_']").not('.hide_by_'+ id +'_'+hval).closest('.form-row').show();   
    		$iaz("[class^='hide_by_"+ id +"_'],[class*=' hide_by_"+ id+"_']").not('.hide_by_'+ id +'_'+hval).closest('.form-row').find('input').val("");     
    	}   else if (this_obj.is("textarea")) {

    		$iaz('.hide_by_'+ id +'_'+hval ).closest('.form-row').hide();
    		var child_input = $iaz('.hide_by_'+ id +'_'+ hval +' input');
    		child_input.val('empty');
                        //hide other   
    		$iaz("[class^='hide_by_"+ id +"_'],[class*=' hide_by_"+ id+"_']").not('.hide_by_'+ id +'_'+hval).closest('.form-row').show();   
    		$iaz("[class^='hide_by_"+ id +"_'],[class*=' hide_by_"+ id+"_']").not('.hide_by_'+ id +'_'+hval).closest('.form-row').find('input').val("");    
    	} 
    });
	  
	   $iaz('.syscmafwpl-hider').trigger('change');
	});
})(jQuery);