<?php
/**
 * Template Name: Contributors Template
 *
 *  *
 * @package Drizy
 */
 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); 

?>

<div class="contributor-wrapper">
	<div class="contributor-featured-product">

		<div class="product-slide">
			<div class="contributor-product-slider">

				<?php 

				$meta_query  = WC()->query->get_meta_query();
			    $tax_query   = WC()->query->get_tax_query();

				// The tax query
				$tax_query[] = array(
				    'taxonomy' => 'product_visibility',
				    'field'    => 'name',
				    'terms'    => 'featured',
				    'operator' => 'IN', // or 'NOT IN' to exclude feature products
				);

				// The query
				$args = array(
				    'post_type'           => 'product',
				    'post_status'         => 'publish',
				    'ignore_sticky_posts' => 1,
				    'posts_per_page'      => -1,
				    'orderby'             => 'date',
			        'order'               => 'DESC',
				    'meta_query'          => $meta_query,
			        'tax_query'           => $tax_query,	
				);

				$query = new WP_Query( $args );
				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) : $query->the_post();

						$images = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "product-grid" ); ?>

						<div class="image-slide">
							<a href="<?php the_permalink(); ?>">
								<img src="<?php echo $images[0]; ?>" alt="<?php the_title(); ?>">
							</a>
						</div>

					<?php endwhile; 
				}

		    	wp_reset_postdata();

		    	?>

			</div>
			<div class="contributor-text"><?php _e( 'Fonts of the week by Contributors', 'drizy' ); ?></div>
			<div class="product-slider-control">
				<span class="prev"><?php echo drizy_svg('prev-arrow'); ?></span>
				<span class="dots"></span>
				<span class="next"><?php echo drizy_svg('next-arrow'); ?></span>
			</div>
		</div>

	</div>
	<div class="contributor-title">
		<div class="container">
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2">
					<h1><?php _e( 'Exclusive Contributors', 'drizy' ); ?></h1>
					<div class="icon"><?php echo drizy_svg('contributor-icon'); ?></div>
					<p><?php _e( 'At Drizy Font, we believe in embracing fellow typographers and their unique talents. We see them not as a challenge, but as a community that thrives on encouragement and collaboration. Explore and see us grow and innovate within the typography field.', 'drizy' ); ?></p>
				</div>
			</div>
		</div>
	</div>
	<div class="contributor-product">
		<div class="container">
			<div class="row">
				<?php 

					$url = get_author_posts_url(get_the_author_meta('ID'));
					$author = the_author();
					$meta_query  = WC()->query->get_meta_query();

					// The query
					$args = array(
					    'post_type'           => 'product',
					    'post_status'         => 'publish',
					    'ignore_sticky_posts' => 1,
					    'posts_per_page'      => 12,
					    'orderby'             => 'date',
				        'order'               => 'DESC',
					    'meta_query'          => $meta_query,
					);

					$query = new WP_Query( $args );
					if ( $query->have_posts() ) {
						while ( $query->have_posts() ) : $query->the_post(); 
							$images = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "product-grid" ); ?>

							<div class="col-sm-3">
								<div class="product-grid">
									<div class="product-title">
										<a href="<?php the_permalink(); ?>">
											<?php the_title(); ?>
										</a>
									</div>
									<div class="product-image">
										<a href="<?php the_permalink(); ?>">
											<img src="<?php echo $images[0]; ?>" alt="<?php the_title(); ?>">
										</a>
									</div>
									<div class="product-meta">
										<div class="product-author">
											<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author">
												<?php echo get_avatar( get_the_author_meta( 'ID' )); ?>
												<?php echo get_the_author() ?>
											</a>
										</div>
										<div class="product-price"></div>
									</div>
								</div>
							</div>

						<?php endwhile; 
					}

					wp_reset_postdata();
				?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>