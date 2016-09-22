<?php 
error_reporting(E_ALL);
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );

//if(isset($_POST['type']) && isset($_POST['value'])){
	
	$catID = $_POST['value'];
	
	$args = array(	'child_of' => (int)$catID,
					'parent' => (int)$catID,
						  'orderby' => 'name',
						  'order' => 'ASC',
						  'hide_empty' => 0,
						  'taxonomy' => 'product_cat');
					
	$results = get_categories( $args );
	
	foreach ( $results as $result ){
		$childCat[] = array('catID'=>$result->term_id,
							'catName'=>$result->name);
	}
	//var_dump($catID);
	echo json_encode($childCat);

//}
?>