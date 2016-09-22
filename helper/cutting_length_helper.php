<?php 
error_reporting(E_ALL);
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );
global $wpdb, $post;

//if(isset($_POST['type']) && isset($_POST['value'])){
	
	$catID = $_POST['value'];
	
	$args = array(	'post_type'=>'product',
					'posts_per_page' => -1,
					'tax_query' => array(
							array(
								'taxonomy' => 'product_cat',
								'field'    => 'term_id',
								'terms'    => (int)$catID,
							),)
				);
					
	$result = new WP_Query( $args );
	$cutting_con = '';
	while ( $result->have_posts() ) : $result->the_post();
		
		$cutting_length = get_field('cutting_length',$result->post->ID, true);
		if ($cutting_length != $cutting_con){
			$cuttingLength[] = array('cutting_length'=>$cutting_length);
			$cutting_con = $cutting_length;
		}
	endwhile;
	
	//var_dump($catID);
	echo json_encode($cuttingLength);

//}
?>