<?php
	$action = new Actions(); 
	$settings = $action->getSingleRow('wp_cf_settings',1,'cf_setting_id'); 
?>

<style type="text/css">
	
	.form-container select{
		width:100%;
		height: 30px;
		border:1px solid #<?php echo $settings[0]->cf_select_border; ?>;
	}
	.form-container input[type="submit"]{
		border:0px;
		padding:8px 20px;
		background:#<?php echo $settings[0]->cf_button_bg; ?> !important;
		color:#<?php echo $settings[0]->cf_button_color; ?>;
		cursor:pointer;
	}
	.result_title a{
		color:#<?php echo $settings[0]->cf_result_heading_color; ?>!important;
	}
	.result_container p{
		color:#<?php echo $settings[0]->cf_result_text_color; ?>!important;
	}
	
</style>