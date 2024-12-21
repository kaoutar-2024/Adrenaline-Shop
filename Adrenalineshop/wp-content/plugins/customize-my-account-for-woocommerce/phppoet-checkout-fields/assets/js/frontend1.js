var $vaz = jQuery.noConflict();
(function( $vaz ) {
    'use strict';

	$vaz(function() {

        if ($vaz('.syscmafwpl-datepicker').length) {

		    $vaz('.syscmafwpl-datepicker').datepicker({
                dateFormat : 'dd-mm-yy'
            });
	    }
	              
	    var dateToday = new Date(); 
	             
		if ($vaz('.syscmafwpl-datepicker-disable-past').length) {
		    $vaz('.syscmafwpl-datepicker-disable-past').datepicker({
                dateFormat : 'dd-mm-yy',
		        minDate: dateToday
            });
	    }
	   
    });
   	
    $vaz(function() {
	 
	    if ($vaz('.syscmafwpl-multiselect').length) {
		    $vaz('.syscmafwpl-multiselect').select2();
	    }
	 
	    if ($vaz('.syscmafwpl-singleselect').length) {
		    $vaz('.syscmafwpl-singleselect').select2();
	    }
      
    });
	
	
	$vaz('.syscmafwpl-opener').change(function(e){ 
                    
        var this_obj=$vaz(this);
        var id= this_obj.attr('id');
        var name= this_obj.attr('name');
                      
        if (this_obj.attr('type')=='checkbox' ) { 
                          
            if (this_obj.is(':checked'))                
                $vaz('.open_by_'+id ).parentsUntil('tbody').hide();  
            else
                $vaz('.open_by_'+id ).parentsUntil('tbody').show();
   
        }else if ( this_obj.attr('type')=='radio'){
                         
            $vaz('.open_by_'+ $vaz('input[name="'+name+'"]:checked').attr('id') ).parentsUntil('tbody').hide();
                        //hide other   
            $vaz('.open_by_'+ $vaz('input[name="'+name+'"]:not(:checked)').attr('id') ) .parentsUntil('tbody').show();
        
        } else if (this_obj.hasClass('selectbox')){
                        
            $vaz('.open_by_'+ id+'_'+this_obj.val() ).parentsUntil('tbody').hide();
                        //hide other   
            $vaz("[class^='open_by_"+ id+"_'],[class*=' open_by_"+ id+"_']").not('.open_by_'+ id +'_'+this_obj.val()).parentsUntil('tbody').show();
                         
        }    
                            
    });
                
                 
                
    $vaz('.syscmafwpl-opener').trigger('change');
				
	$vaz('.syscmafwpl-hider').change(function(e){ 
                    
        var this_obj=$vaz(this);
        var id= this_obj.attr('id');
        var name= this_obj.attr('name');
                      
        if (this_obj.attr('type')=='checkbox' ) { 
                          
            if (this_obj.is(':checked'))                
                $vaz('.hide_by_'+id ).parentsUntil('tbody').show();  
            else
                $vaz('.hide_by_'+id ).parentsUntil('tbody').hide();
   
        } else if ( this_obj.attr('type')=='radio'){
                         
            $vaz('.hide_by_'+ $vaz('input[name="'+name+'"]:checked').attr('id') ).parentsUntil('tbody').show();
            //hide other   
            $vaz('.hide_by_'+ $vaz('input[name="'+name+'"]:not(:checked)').attr('id') ) .parentsUntil('tbody').hide();
        
        } else if (this_obj.hasClass('selectbox')){
                        
            $vaz('.hide_by_'+ id+'_'+this_obj.val() ).parentsUntil('tbody').show();
            //hide other   
            $vaz("[class^='hide_by_"+ id+"_'],[class*=' hide_by_"+ id+"_']").not('.hide_by_'+ id +'_'+this_obj.val()).parentsUntil('tbody').hide();
                         
        }    
                            
    });
                
                 
                
    $vaz('.syscmafwpl-hider').trigger('change');
})(jQuery);