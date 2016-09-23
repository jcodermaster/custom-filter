<?php
	
	/**
	* Custom widget for the product category to hide and show item in the sidebar
	*/

	class cfltr_widget extends WP_Widget
	{
		
		function __construct()
		{
			parent::__construct('cfltr_widget', 
								__('CFCategory Widget', 'cfltr_widget'), 
								array( 'description' => __( 'Custom widget to hide and show product category', 'cfltr_widget' ), ) 
						);
		}

		// Creating widget front-end
		// This is where the action happens
		public function widget( $args, $instance ) {
			$title = apply_filters( 'widget_title', $instance['title'] );
			$cf_prod_cat = $instance['term_taxonomy_id'];
			// before and after widget arguments are defined by themes
			echo $args['before_widget'];
			if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];

			$args = array( 'orderby' => 'name',
								  'order' => 'ASC',
								  'hide_empty' => 0,
								  'exclude' => $cf_prod_cat,
								  'taxonomy' => 'product_cat');
					
			$cf_cats = get_categories( $args );

			$siteUrl = get_bloginfo('url');

			echo '<ul class="product-categories">';
				foreach ($cf_cats as $cf_cat) {
					echo '<li><a href="'.$siteUrl.'/product-category/'.$cf_cat->slug.'">'.$cf_cat->name.'</a></li>';
				}
			echo '</ul>';

			echo $args['after_widget'];
		}
				
		// Widget Backend 
		public function form( $instance ) {
			if ( isset( $instance[ 'title' ] ) ) {
				$title = $instance[ 'title' ];
			}
			else {
				$title = __( 'Product Categories', 'wpb_widget_domain' );
			}

            $term_taxonomy_id = (isset($instance['term_taxonomy_id']) ? array_map('absint', $instance['term_taxonomy_id']) : array("0"));

			
		// Widget admin form
?>
			<p> <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>

			<?php 

				$cf_args = array( 'orderby' => 'name',
								  'order' => 'ASC',
								  'hide_empty' => 0,
								  'taxonomy' => 'product_cat');
					
				$cf_prod_cats = get_categories( $cf_args );

			?>
			<div class="cf_prodcat_cotnainer">
				<p><em>Check the categories to hide in the sidebar.</em></p>
				<?php foreach ( $cf_prod_cats as $id => $specificCat) { ?>
					<p>
						<input type="checkbox" 
							   name="<?php echo $this->get_field_name('term_taxonomy_id'); ?>[]" 
							   id="<?php echo $this->get_field_id('term_taxonomy_id') . $id; ?>" 
							   value="<?php echo $specificCat->term_taxonomy_id; ?>" 
							   <?php   if (isset($specificCat->term_taxonomy_id)) {
				                if (in_array($specificCat->term_taxonomy_id,$term_taxonomy_id)) 
				                    echo 'checked'; 
				                };      
				            ?>  
				        />
						<label for="<?php echo $this->get_field_id('term_taxonomy_id') . $id; ?>"><?php echo $specificCat->name; ?></label>
					</p>
				<?php } ?>
			</div>
<?php 
		}
			
		// Updating widget replacing old instances with new
		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ): '';
			$instance['term_taxonomy_id'] =  (isset($new_instance['term_taxonomy_id']) ? array_map( 'absint', $new_instance['term_taxonomy_id']) : array('0'));
			return $instance;

			var_dump($instance);
		}

	}

	// Register and load the widget
	function wpb_load_widget() {
		register_widget( 'cfltr_widget' );
	}

	add_action( 'widgets_init', 'wpb_load_widget' );

 ?>
