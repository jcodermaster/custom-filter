<?php 
	class Actions{
		public function __contruct(){
			
		}
		
		public function getAllData( $tbl ){
			global $wpdb;
			$result = $wpdb->get_results('SELECT * FROM ' . $tbl);
			return $result; 
		}
		
		public function getCategories( $parent ){
			
			global $post;
			
			$args = array('parent' => $parent,
						  'orderby' => 'name',
						  'order' => 'ASC',
						  'hide_empty' => 1,
						  'taxonomy' => 'product_cat');
					
			$result = get_categories( $args );
			
			return $result;
			
		}
		
		public function insertData( $table, $data){
		
			global $wpdb;
			
			$result = $wpdb->insert( $table, $data);
			
			$inserted_id = $wpdb->insert_id;
			
			return $inserted_id;
			
		}
		
		function updateData ( $table, $id, $dbField, $data ){
		
			global $wpdb;
			
			$result = $wpdb->update($table, $data, array( $dbField => $id ));
			
			return $result;
			
		}
		
		function checkSelect( $db_val, $value){
			if ( $db_val == $value) {
				$result = 'selected';
			}
			return $result; 
		}
		
		function checkCheckbox( $db_val, $value){
			if ( $db_val == $value) {
				$result = 'checked';
			}
			return $result; 
		}
		
		function checkTextBox( $value ){
			if ( isset($value) ) {
				return $value;
			}
		}
		
		public function deleteRec( $tbl, $dbField, $id ){
			
			global $wpdb;
			
			$deleteItem = $wpdb->delete($tbl, array($dbField => $id));
			
			return $deleteItem;
			
		}
		
		public function getSingleRow( $table, $id, $dbField ){
			
			global $wpdb;
			
			$result = $wpdb->get_results('SELECT * FROM '.$table.' WHERE '. $dbField .'=' . $id);
			
			return $result;
			
		}
		
	}
?>