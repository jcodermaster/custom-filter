<?php $url = plugins_url() . '/custom-filter/helper/'?>
<script type="text/javascript">
	//var $cf = jQuery.noConflict();
	jQuery(document).ready(function() {
		
		jQuery('#main_cat').change( function() {
			//alert('change');
			
			var mainCatId = jQuery('#main_cat').val();
			
			jQuery.ajax({
					'url': '<?php echo $url;?>category_helper.php',
					'type': 'POST',
					'dataType': 'JSON',
					'data': {'type':'mainCatID', 'value':mainCatId},
					'success':function(result){
						
						jQuery('#loader').empty();
						
					    jQuery('#loader').append('<img src="<?php echo IMG;?>/blank.png">');
						
					 	if (result!= ''){
							
							jQuery("select[name='model_cat'] option").remove();
							jQuery("select[name='model_cat']").append('<option value="-1" data-value="">Select Model</option>');
							jQuery.each(result, function(k,v){	
								  jQuery("select[name='model_cat']").append('<option value="'+v.catID+'" data-value="'+v.catID+'">'+v.catName+'</option>');	
							});
							
							
							
						} 
							
					  
					},
					'beforeSend':function(){
							
						  jQuery('#loader').append('<img src="<?php echo IMG;?>/ajax-loader.gif">');
						  
					 },
					 'error': function() {
						 alert('error');
					}
					
					});
			
			
		});
		
		jQuery('#model_cat').change( function() {
			//alert('change');
			
			var mainCatId = jQuery('#model_cat').val();
			
			jQuery.ajax({
					'url': '<?php echo $url;?>cutting_length_helper.php',
					'type': 'POST',
					'dataType': 'JSON',
					'data': {'type':'mainCatID', 'value':mainCatId},
					'success':function(result){
						
						jQuery('#loader').empty();
						
					    jQuery('#loader').append('<img src="<?php echo IMG;?>/blank.png">');
						
					 	if (result!= ''){
							
							jQuery("select[name='cutting_length'] option").remove();
							jQuery("select[name='cutting_length']").append('<option value="-1" data-value="">Select Cutting Length</option>');
							jQuery.each(result, function(k,v){	
								  jQuery("select[name='cutting_length']").append('<option value="'+v.cutting_length+'" data-value="'+v.cutting_length+'">'+v.cutting_length+'</option>');	
							});
							
							
							
						} 
							
					  
					},
					'beforeSend':function(){
							
						  jQuery('#loader').append('<img src="<?php echo IMG;?>/ajax-loader.gif">');
						  
					 },
					 'error': function() {
						 alert('error');
					}
					
					});
			
			
		});
		
		jQuery('#filter_submit').click( function(){
			
			var $mainCategory = jQuery('#main_cat').val();
			var $modelCat = jQuery('#model_cat').val();
			var $cuttingLength = jQuery('#cutting_length').val();
			
			window.location.href = "<?php echo get_bloginfo('url') ?>/filter-result/" + $mainCategory + '/' + $modelCat + '/' + $cuttingLength;
			
		});
		
		
	});
</script>