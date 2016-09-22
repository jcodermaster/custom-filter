<?php 

	function dynamic_shortcode( $atts ){
		
		
		$var = shortcode_atts( array('cat' => $cat,'filter_name' => $filter_name), $atts );
		
		//var_dump((int)$var['cat']);
		
		$args = array(    'child_of' => (int)$var['cat'],
					      'parent' => (int)$var['cat'],
						  'orderby' => 'name',
						  'order' => 'ASC',
						  'hide_empty' => 0,
						  'taxonomy' => 'product_cat');
					
		$results = get_categories( $args );
		
		
		$output = NULL;
		
		$output .='<div class="form-container">';
			$output .='<h3>'.$var['filter_name'].'</h3>';
			$output .='<div class="et_pb_row" style="width:100%!important;">';
				$output .='<div class="et_pb_column et_pb_column_1_4">';
					$output .='<select name="child_cat'.$var['cat'].'" id="main_cat'.$var['cat'].'">';	
						$output .='<option value="">--Select Make--</option>';
						foreach ( $results as $result ){
							$output .='<option value="'.$result->term_id.'">';
								$output .= $result->name;
							$output .='</option>';
						}
					$output .='</select>';
				$output .='</div>';
				$output .='<div class="et_pb_column et_pb_column_1_4">';
					$output .='<select name="model_cat'.$var['cat'].'" id="model_cat'.$var['cat'].'">';	
						$output .='<option value="">--Select Model--</option>';
					$output .='</select>';
				$output .='</div>';
				$output .='<div class="et_pb_column et_pb_column_1_4">';
					$output .='<select name="cutting_length'.$var['cat'].'" id="cutting_length'.$var['cat'].'">';	
						$output .='<option value="">--Select Cutting Length --</option>';
					$output .='</select>';
				$output .='</div>';
				$output .='<div class="et_pb_column et_pb_column_1_4">';
					$output .='<input type="submit" value="Filter Now" class="filter_btn" id="filter_submit'.$var['cat'].'" />';	
				$output .='</div>';
			$output .='</div>';
		$output .='</div>';
		
		
		 $url = plugins_url() . '/custom-filter/helper/';
		 
$output .= "<script type=\"text/javascript\">
	//var $cf = jQuery.noConflict();
	jQuery(document).ready(function() {
		
		jQuery('#main_cat".$var['cat']."').change( function() {
			//alert('change');
			
			var mainCatId = jQuery('#main_cat".$var['cat']."').val();
			
			jQuery.ajax({
					'url': '" . $url . "category_helper.php',
					'type': 'POST',
					'dataType': 'JSON',
					'data': {'type':'mainCatID', 'value':mainCatId},
					'success':function(result){
						
						jQuery('#loader').empty();
			
						
					 	if (result!= ''){
							
							jQuery(\"select[name='model_cat".$var['cat']."'] option\").remove();
							jQuery(\"select[name='model_cat".$var['cat']."']\").append('<option value=\"\" data-value=\"\">Select Model</option>');
							jQuery.each(result, function(k,v){	
								  jQuery(\"select[name='model_cat".$var['cat']."']\").append('<option value=\"'+v.catID+'\" data-value=\"'+v.catID+'\">'+v.catName+'</option>');	
							});
							
							
							
						} 
							
					  
					},
					'beforeSend':function(){
							
						  
						  
					 },
					 'error': function() {
						 alert('error');
					}
					
					});
			
			
		});
		
		jQuery('#model_cat".$var['cat']."').change( function() {
			//alert('change');
			
			var mainCatId = jQuery('#model_cat".$var['cat']."').val();
			
			jQuery.ajax({
					'url': '" . $url . "cutting_length_helper.php',
					'type': 'POST',
					'dataType': 'JSON',
					'data': {'type':'mainCatID', 'value':mainCatId},
					'success':function(result){
						
						jQuery('#loader').empty();
						
					    
						
					 	if (result!= ''){
							
							jQuery(\"select[name='cutting_length".$var['cat']."'] option\").remove();
							jQuery(\"select[name='cutting_length".$var['cat']."']\").append('<option value=\"\" data-value=\"\">Select Cutting Length</option>');
							jQuery.each(result, function(k,v){	
								  jQuery(\"select[name='cutting_length".$var['cat']."']\").append('<option value=\"'+v.cutting_length+'\" data-value=\"'+v.cutting_length+'\">'+v.cutting_length+'</option>');	
							});
							
							
							
						} 
							
					  
					},
					'beforeSend':function(){
							
						 
						  
					 },
					 'error': function() {
						 alert('error');
					}
					
					});
			
			
		});
		
		jQuery('#filter_submit".$var['cat']."').click( function(){
			
			var mainCategory = jQuery('#main_cat".$var['cat']."').val();
			var modelCat = jQuery('#model_cat".$var['cat']."').val();
			var cuttingLength = jQuery('#cutting_length".$var['cat']."').val();
			
			window.location.href = '" . get_bloginfo('url') . "/filter-result/' + mainCategory + '/' + modelCat + '/' + cuttingLength;
			
		});
		
		
	});
</script>";
		
		return $output;
		
	}
	
	add_shortcode('custom-filter', 'dynamic_shortcode');
	
?>