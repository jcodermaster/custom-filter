<?php 
	$action = new Actions();
	
	if ( isset($_POST['submit']) ) {
		
		$resultPage = $_POST['result_page'];
		$resultOrder = $_POST['result_order'];
		$pagination = $_POST['pagination'];
		$resultPerPage = $_POST['result_per_page'];
		
		$select_box_border = $_POST['select_box_border'];
		$button_bg = $_POST['button_bg'];
		$button_color = $_POST['button_color'];
		$result_heading_color = $_POST['result_heading_color'];
		$result_text_color = $_POST['result_text_color'];

		$form_to_display = $_POST['form_to_display'];
		$sort_cutting_length = $_POST['sort_cutting_length'];

		$hide_cat = implode(",", $_POST['hide_cat']);
		
		
		
		$data = array('cf_result_page' => $resultPage,
					  'cf_result_order' => $resultOrder,
					  'cf_result_pagination' => $pagination,
					  'cf_result_per_page' => $resultPerPage,
					  'cf_select_border' => $select_box_border, 
					  'cf_button_bg' => $button_bg,
					  'cf_button_color' => $button_color,
					  'cf_result_heading_color' => $result_heading_color,
					  'cf_result_text_color' => $result_text_color,
					  'cf_form_display' => $form_to_display,
					  'cf_sort_cutting_length' => $sort_cutting_length,
					  'cf_hide_cats' => $hide_cat);
		
		$update = $action->updateData('wp_cf_settings', 1, 'cf_setting_id', $data);
		
			if ($update > 0) {
				echo '<div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible"> 
						<p><strong>Settings saved.</strong></p>
						<button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
					</div>';
			} else {
				echo '<div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible"> 
						<p><strong>Error in updating data.</strong></p>
						<button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
					</div>';
			}
		
		
	}
	$settings = $action->getSingleRow('wp_cf_settings',1,'cf_setting_id');
	$forms = $action->getAllData('wp_cf_shortcodes');
?>
<div class="wrap">
	<h2>Filter Settings</h2>
	
	<form method="post" action="<?php $PHP_SELF; ?>">
	
		<div id="tabs">
			  <ul>
				<li><a href="#general">General</a></li>
				<li><a href="#filter-result">Filter Result</a></li>
				<li><a href="#colors">BG & Colors</a></li>
				<li><a href="#prod_cat">Product Categories</a></li>
			  </ul>
			  <div id="general">
				<h2>Generals</h2>

				<table>
					<tbody>
						<tr>
							<th scope="row"><label for="sort_cutting_length">Sort Cutting Length</label></th>
							<td>
								<select name="sort_cutting_length" id="sort_cutting_length">
									<option value="">--Sort Item--</option>
									<option value="asc" <?php echo $action->checkSelect($settings[0]->cf_sort_cutting_length,'asc')?>>ASC</option>
									<option value="desc" <?php echo $action->checkSelect($settings[0]->cf_sort_cutting_length,'desc')?>>DESC</option>
								</select>
							</td>
						</tr>
					</tbody>
				</table>

			  </div>
			  <div id="filter-result">
				<h2>Filter Result</h2>
				
				<table class="form-table">
					<tbody>
						<tr>
							<th scope="row"><label for="result_page">Result Page</label></th>
							<td>
								<input type="text" name="result_page" id="result_page" value="<?php echo $settings[0]->cf_result_page; ?>"/>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="form_display">Display Filter Form</label></th>
							<td>
								<select name="form_to_display">
									<option value="">--Select The Form--</option>
									<?php foreach ( $forms as $form) { ?>
										<option value="<?php echo $form->cf_cat_id; ?>" <?php echo $action->checkSelect($settings[0]->cf_form_display,$form->cf_cat_id)?>> 
											<?php echo $form->cf_name; ?>
										 </option>
									<?php } ?>
								</select>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="result_order">Result Display Order</label></th>
							<td>
								<select name="result_order" id="result_order">
									<option value="asc" <?php echo $action->checkSelect($settings[0]->cf_result_order,'asc')?>>ASC</option>
									<option value="desc" <?php echo $action->checkSelect($settings[0]->cf_result_order,'desc')?>>DESC</option>
								</select>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="pagination">Result Pagination</label></th>
							<td>
								<input type="checkbox" name="pagination" value="true" id="pagination" <?php echo $action->checkCheckbox($settings[0]->cf_result_pagination,"true"); ?>/>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="result_order">Result Per Page</label></th>
							<td>
								<select name="result_per_page" id="result_per_page">
									<?php for($ctr=1; $ctr<=15; $ctr++) {?>
										<option value="<?php echo $ctr; ?>" <?php echo $action->checkSelect($settings[0]->cf_result_per_page,$ctr)?>><?php echo $ctr; ?></option>
									<?php } ?>
								</select>
							</td>
						</tr>
					</tbody>
				</table>
				
			  </div>
			  <div id="colors">
				<h2>Backgrounds and Colors</h2>
				
				
				
				<table class="form-table">
					<tbody>
						<tr>
							<th scope="row"><label for="select_box_border">Select Box Border</label></th>
							<td>
								<input type="text" name="select_box_border" id="colorpickerField1"  value="<?php echo $settings[0]->cf_select_border; ?>"/>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="button_bg">Button Background</label></th>
							<td>
								<input type="text" name="button_bg" id="colorpickerField2"  value="<?php echo $settings[0]->cf_button_bg; ?>" />
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="button_bg">Button Color</label></th>
							<td>
								<input type="text" name="button_color" id="colorpickerField2"  value="<?php echo $settings[0]->cf_button_color; ?>" />
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="button_bg">Result Heading Color</label></th>
							<td>
								<input type="text" name="result_heading_color" id="colorpickerField2"  value="<?php echo $settings[0]->cf_result_heading_color; ?>" />
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="button_bg">Result Text Color</label></th>
							<td>
								<input type="text" name="result_text_color" id="colorpickerField2"  value="<?php echo $settings[0]->cf_result_text_color; ?>" />
							</td>
						</tr>
					</tbody>
				</table>
				
			  </div>
			  <div id="prod_cat">
			  		<h2>Woocommerce Product and Caregories Options</h2>
			  		<?php 
			  			$args = array( 'parent' => 0,
							'orderby' => 'name',
							'order' => 'ASC',
							'hide_empty' => 0,
							'taxonomy' => 'product_cat');
					
						$prod_cats = get_categories( $args );

						$setting_hide_cat =  explode(",", $settings[0]->cf_hide_cats);
						
			  		?>
			  		<table>
			  			<tbody>
			  				<tr>
			  					<th valign="top">Hide category in shop page.</th>
			  					<td style="padding-left:10px;" valign="top">
			  					<?php foreach ( $prod_cats as $cat) { ?>
			  						<p style="margin:0px 0px 10px 0px;">
			  							<input value="<?php echo $cat->term_id; ?>" type="checkbox" name="hide_cat[]" 
			  								<?php if (in_array($cat->term_id, $setting_hide_cat)) echo 'checked'; ?> 
			  									/>
			  							<label><?php echo $cat->name;?></label>
			  						</p>
			  					<?php } ?>
			  					</td>
			  				</tr>
			  			</tbody>
			  		</table>

			  </div>


		 </div>
		<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>
	 </form>
	
	
</div>