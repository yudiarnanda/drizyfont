<?php
/**
 * Template Name: Freebie Template
 *
 *  *
 * @package Drizy
 */
 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); 

?>

<div class="product-archive-header">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<?php echo do_shortcode('[rank_math_breadcrumb]'); ?>
			</div>
			<div class="col-sm-12">
				<div class="product-category-lists">
						<?php

							$tax_name = "product_cat";
						    $terms = get_terms( array( 
						    	'taxonomy' => $tax_name, 
						    	'parent' => 0,
						    	'hide_empty' => false,
						    	'exclude' => array('489', '588'),
						    	'include' => array('15', '16', '17', '18', '20', '19')
						    ) );

						?>

						<ul class="grid columns-8">
							<?php foreach ( $terms as $term ) {
								$thumbnail_id = get_term_meta ($term->term_id, 'thumbnail_id', true);
								$image = wp_get_attachment_url ($thumbnail_id); 
							?>

								<li class="product-category category-<?php echo $term->slug; ?>">
									<a href="<?php echo get_term_link($term->name, $tax_name); ?>" title="<?php echo $term->name; ?>" class="cat-title">
										<div class="cat-image"><?php echo file_get_contents($image);?></div>
										<span><?php echo $term->name; ?></span>
									</a>
									<div class="solutions__border"></div>
								</li>

							<?php } ?>

								<li class="product-category product-sale">
									<a href="<?php echo get_permalink( get_page_by_path( 'font-sale' ) ) ?>" title="<?php _e( 'Font Sale', 'drizy' ); ?>" class="cat-title">
										<div class="cat-image"><?php echo drizy_svg('font_sale'); ?></div>
										<span><?php _e( 'Font Sale', 'drizy' ); ?></span>
									</a>
									<div class="solutions__border"></div>
								</li>

								<li class="product-category product-freebies current-cat">
									<a href="<?php echo get_permalink( get_page_by_path( 'freebies' ) ) ?>" title="<?php _e( 'Freebies', 'drizy' ); ?>" class="cat-title">
										<div class="cat-image"><?php echo drizy_svg('freebies'); ?></div>
										<span><?php _e( 'Freebies', 'drizy' ); ?></span>
									</a>
									<div class="solutions__border"></div>
								</li>
						</ul>		
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-9">
				<div class="product-filter">
					<div class="product-preview-dropdown">
						<select class="drizy-custom-select" id="text-preview">
							<option value="text-preview-1" selected><?php _e( 'The quick brown fox jumps over a lazy dog', 'drizy' ); ?></option>
							<option value="text-preview-2"><?php _e( 'Quizzical twins proved my hijack-bug fix', 'drizy' ); ?></option>
							<option value="text-preview-3"><?php _e( 'Cozy sphinx waves quart jug of bad milk', 'drizy' ); ?></option>
							<option value="text-preview-4"><?php _e( 'Fix problem quickly with galvanized jets', 'drizy' ); ?></option>
							<option value="text-preview-5"><?php _e( 'Aa Bb Cc Dd Ee Ff Gg Hh Ii Jj Kk Ll Mm Nn Oo Pp...', 'drizy' ); ?></option>
						</select>
					</div>
					<div class="tag-cloud product-tags">
						<div class="product-tag-cloud">
							<div class="tag-cloud-title">
								<span class="tag-cloud-label"><?php _e( 'Search by Tags', 'drizy' ); ?></span>
								<span class="tag-cloud-icon"><?php echo drizy_svg('caret-down'); ?></span>
							</div>
						</div>
						<?php 


						$terms = get_terms( array(
						  'taxonomy' => 'product_tag',
						  'hide_empty' => false
						) );

						if (!empty( $terms ) && ! is_wp_error($terms)){

						    echo '<ul class="tag-cloud-list">';

						    	echo '<li class="tag-item all-tag"><a href="'.get_permalink( get_page_by_path( 'fonts' ) ).'">All</a></li>';

						    foreach ( $terms as $term ) {

						        $class = ( is_tax('product_tag', $term->slug) ) ? 'tag-item current-tag' : 'tag-item';
						        echo '<li class="'.$class.'"><a href="'.get_term_link( $term ).'">'.$term->name.'</a></li>';
						    }

						    echo '</ul>';
						}

						?>
					</div>
					<div class="tag-cloud product-purpose">
						<div class="product-tag-cloud">
							<div class="tag-cloud-title">
								<span class="tag-cloud-label"><?php _e( 'Search by Purpose', 'drizy' ); ?></span>
								<span class="tag-cloud-icon"><?php echo drizy_svg('caret-down'); ?></span>
							</div>
						</div>
						<?php 

						$terms = get_terms( array(
						  'taxonomy' => 'purpose',
						  'hide_empty' => false
						) );

						if (!empty( $terms ) && ! is_wp_error($terms)){

						    echo '<ul class="tag-cloud-list">';

						    	echo '<li class="tag-item all-tag"><a href="'.get_permalink( get_page_by_path( 'fonts' ) ).'">All</a></li>';

						    foreach ( $terms as $term ) {

						        $class = ( is_tax('purpose', $term->slug) ) ? 'tag-item current-tag' : 'tag-item';

						        echo '<li class="'.$class.'"><a href="'.get_term_link( $term ).'">'.$term->name.'</a></li>';
						    }

						    echo '</ul>';
						}

						?>
					</div>
					<div class="product-toogle-image">
						<div class="show-hide-image">
							<span class="show-hide-label"><?php _e( 'Image', 'drizy' ); ?></span>
							<input type="checkbox" id="switch" / checked><label for="switch">Toggle</label>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="product-toogle-font-size">
					<div class="label"><?php _e( 'Font Size', 'drizy' ); ?></div>
					<input type="range" min="10" max="180" value="55" class="slider custom_slider" id="cat-text-size" name="text-size" data-index="1"  data-id="" data-font=""  oninput="this.nextElementSibling.value = this.value">
					<output class="font-size-number">55</output>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="product-archive-filter">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="archive-filter-header">
			          <?php 
			            $sort_by_title = 'New Releases';
			            if( isset( $_GET['_sort'] ) && $_GET['_sort'] == 'popular' ) {
			              $sort_by_title = 'Best Sellers';
			            }
			          ?>
					<h3 class="archive-filter-title default"><?php echo $sort_by_title; ?></h3>
					<div class="filter-type">
						<span class="sortby-text"><?php _e( 'Sort by: ', 'drizy' ); ?></span>
						<?php echo do_shortcode('[facetwp sort="true"]'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="product-archive-container">
	<div class="facetwp-template">

		<?php

		$paged = get_query_var('paged') ? get_query_var('paged') : 1;
		$args = array(
		    'post_type'           => 'product',
		    'post_status'         => 'publish',
		    'ignore_sticky_posts' => 1,
		    'posts_per_page'      => 12,
		    'paged' 			  => $paged,
		    'orderby'             => 'date',
		    'order'               => 'DESC',
		    'product_cat'         => 'freebies',
		    'facetwp' 			  => true,
		);

		$wp_query = new WP_Query($args)
		?>

			<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
				<?php get_template_part( 'woocommerce/content-product', 'freebies' ); ?>
			<?php endwhile; ?>

		<?php
			wp_reset_query(); 
		?>

	</div>

	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="product-pagination">
					<?php echo facetwp_display( 'facet', 'loadmore' ); ?>
				</div>
			</div>
		</div>
	</div>

</div>

<?php get_footer(); ?>