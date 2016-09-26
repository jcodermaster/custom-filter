<?php 
/*
	Plugin Name: Custom Filter
	Description: Custom filter for Woocommerce Product
	Author: Jerome Chan
	Version: 1.0
	Author URI: http://jeromechan.com
*/

require_once('libs/bootstrap.php');
require_once('libs/shortcodes.php');
require_once('libs/custom-filter-widget.php');

$cf_app = new Bootstrap();

require_once('libs/actions.php');
		
function cf_menu() {  
	add_menu_page("Custom Filter", "Custom Filter", 1, "custom_filter", "custom_filter",plugins_url() . "/custom-filter/images/search-icon-png.png"); 
	add_submenu_page( "custom_filter", "Dashboard", "Dashboard", 1, "custom_filter", "custom_filter" );
	add_submenu_page( "custom_filter", "Shortcodes", "Add Shortcodes", 1, "shortcode", "shortcode" );
	add_submenu_page( "custom_filter", "Settings", "Settings", 1, "settings", "settings" );
}  
		
add_action('admin_menu', 'cf_menu'); 
		
function custom_filter(){
	require_once('admin/dashboard.php');
}
		
function shortcode(){
	require_once('admin/shortcode.php');
}
		
function settings(){
	require_once('admin/settings.php');
}


		
		
		function load_admin_styles() {
			wp_enqueue_style( 'font_awesome', plugins_url() . '/custom-filter/css/font-awesome.min.css', false, '4.3.0' );
			wp_enqueue_style( 'custom-filter-style', plugins_url() . '/custom-filter/css/style.css', false, '' );
			wp_enqueue_style( 'jquery-ui', plugins_url() . '/custom-filter/css/jquery-ui.css', false, '' );
			wp_enqueue_style( 'colorpicker', plugins_url() . '/custom-filter/css/colorpicker.css', false, '' );
			//wp_enqueue_style( 'layout-colorpicker', plugins_url() . '/custom-filter/css/layout.css', false, '' );
		}
		function load_admin_script(){
			wp_enqueue_script( 'jquery-ui', plugins_url() . '/custom-filter/js/jquery-ui.js');
			wp_enqueue_script( 'custom-colorpicker', plugins_url() . '/custom-filter/js/colorpicker.js');
			wp_enqueue_script( 'eye-colorpicker', plugins_url() . '/custom-filter/js/eye.js');
			wp_enqueue_script( 'utils-colorpicker', plugins_url() . '/custom-filter/js/utils.js');
			//wp_enqueue_script( 'layout-colorpicker', plugins_url() . '/custom-filter/js/layout.js');
			wp_enqueue_script( 'custom-script', plugins_url() . '/custom-filter/js/custom_script_admin.js', array( 'jquery' ) );
			
		}
		
		function load_boat_style(){	
			 wp_enqueue_style( 'custom-filter-style', plugins_url() . '/custom-filter/css/style.css', false, '' );
			 wp_enqueue_style( 'bxslider', plugins_url() . '/custom-filter/css/jquery.bxslider.css', false, '' );
			 wp_enqueue_style( 'jquery-ui', plugins_url() . '/custom-filter/css/jquery-ui.css', false, '' );
			 require_once('admin/style.php');
		}
		
		add_action( 'wp_head', 'load_boat_style' );
		add_action( 'admin_enqueue_scripts', 'load_admin_styles' );
		add_action( 'admin_enqueue_scripts', 'load_admin_script' );
		
		function load_scripts_method() {
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'bxslider-script', plugins_url() . '/custom-filter/js/jquery.bxslider.js');
			wp_enqueue_script( 'jquery-ui', plugins_url() . '/custom-filter/js/jquery-ui.js');
			wp_enqueue_script( 'custom-script', plugins_url() . '/custom-filter/js/custom_script.js', array( 'jquery' ) );
		}
		
		add_action( 'wp_head', 'load_scripts_method' );
		
		/*function ajax_help(){
			require_once('libs/ajax_help.php');
		}
		add_action( 'wp_head', 'ajax_help' );*/
		
		
		function add_query_vars($var_one) {
		  $var_one[] = "var_make"; 
		  $var_one[] = "var_model"; 
		  $var_one[] = "var_cutting_length"; 
		  return $var_one;
		}
		
		// hook add_query_vars function into query_vars
		add_filter('query_vars', 'add_query_vars');
		
		function add_rewrite_rules($aRules) {
			$aNewRules = array('filter-result/([^/]+)/([^/]+)/([^/]+)/?$' => 'index.php?pagename=filter-result&var_make=$matches[1]&var_model=$matches[2]&var_cutting_length=$matches[3]', 'filter-result/([^/]+)/([^/]+)/([^/]+)/page/([0-9]+)?$' => 'index.php?pagename=filter-result&var_make=$matches[1]&var_model=$matches[2]&var_cutting_length=$matches[3]&paged=$matches[4]');			   
			$aRules = $aNewRules + $aRules;
			return $aRules;
		}
		 
		// hook add_rewrite_rules function into rewrite_rules_array
		add_filter('rewrite_rules_array', 'add_rewrite_rules');

?>