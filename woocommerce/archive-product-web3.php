<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined( 'ABSPATH' ) || exit;

global $wp_query;

get_header( 'shop' ); ?>

<div class="web3-archive-header">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<?php echo do_shortcode('[rank_math_breadcrumb]'); ?>
			</div>
		</div>
	</div>
	<div class="web3-cover">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/img/web3-header.png">
	</div>
	<div class="container web3-content">
		<div class="row">
			<div class="col-sm-12">
				<div class="web3-description">
					<h1><?php _e( 'Drizy Web3 Font_', 'drizy' ); ?></h1>
					<h3><?php _e( 'Special typeface created for the ', 'drizy' ); ?><span><?php _e( 'WEB3 Community', 'drizy' ); ?></span></h3>
					<p><?php _e( 'Discover our exclusive font collection crafted specifically for the Web3 era. From blockchain to cryptocurrency, metaverse, AI, and NFTs, our fonts are designed to enhance your digital identity in cutting-edge technology. Perfect for DeFi, CeDeFi, DAOs, airdrops, and digital wallet platforms. Build a bold, futuristic, and captivating brand with styles inspired by cyberpunk, cyberspace, and electrifying aesthetics. Transform your Web3 vision into a striking visual reality with our fonts!', 'drizy' ); ?></p>
				</div>
				<div class="web3-subcategories">
					<span><?php _e( 'Category', 'drizy' ); ?></span>
					<?php

					// Only on product parent category pages
					//if( is_product_category() ) {
					    $parent = get_term_by('slug', 'web3-font', 'product_cat');

					    $categories = get_term_children( $parent->term_id, 'product_cat' ); 
					    if ( $categories && ! is_wp_error( $categories ) ) : 
					        foreach($categories as $category) :
			                    $term = get_term( $category, 'product_cat' );
			                    $class = ( is_tax($parent, $term->slug) ) ? ' current-cat' : '';
			                    echo '<a href="'.get_term_link($term).'" class="'.$term->slug.''.$class.'">';
			                    echo $term->name;
			                    echo '</a>';
					        endforeach;

					    endif;
					//}
					?>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="product-archive-header">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="product-category-lists">
						<?php

							$tax_name = "product_cat";
						    $terms = get_terms( array( 
						    	'taxonomy' => $tax_name, 
						    	'parent' => 0,
						    	'hide_empty' => false,
						    	//'exclude' => array('489', '588', '917'),
						    	'include' => array('15', '16', '17', '18', '20', '19')
						    ) );

						?>

						<ul class="grid columns-8">
							<?php foreach ( $terms as $term ) {
								$thumbnail_id = get_term_meta ($term->term_id, 'thumbnail_id', true);
								$image = wp_get_attachment_url ($thumbnail_id); 
							    $class = ( is_tax($tax_name, $term->slug) ) ? 'current-cat' : '';
							?>

								<li class="product-category category-<?php echo $term->slug; ?> <?php echo $class; ?>">
									<a href="<?php echo get_term_link($term->name, $tax_name); ?>" title="<?php echo $term->name; ?>" class="cat-title">
										<div class="cat-image"><?php echo file_get_contents($image);?></div>
										<span><?php echo $term->name; ?></span>
									</a>
									<div class="solutions__border"></div>
								</li>

							<?php } ?>

								<li class="product-category product-freebies">
									<a href="<?php echo get_permalink( get_page_by_path( 'font-sale' ) ) ?>" title="<?php _e( 'Font Sale', 'drizy' ); ?>" class="cat-title">
										<div class="cat-image"><?php echo drizy_svg('font_sale'); ?></div>
										<span><?php _e( 'Font Sale', 'drizy' ); ?></span>
									</a>
									<div class="solutions__border"></div>
								</li>

								<li class="product-category product-sale">
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
			<div class="col-sm-12">
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
								<span class="tag-cloud-label">
									<?php if( is_tax('product_tag') ) : ?>
									<?php printf(__( 'Tags: <strong>%s</strong>', 'drizy' ), single_term_title('', false) ); ?>
									<?php else : ?>
									<?php _e( '<strong>Tags</strong>', 'drizy' ); ?>
									<?php endif; ?>
				                </span>
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
								<span class="tag-cloud-label">
								<?php if( is_tax('purpose') ) : ?>
									<?php printf(__( 'Purpose: <strong>%s</strong>', 'drizy' ), single_term_title('', false) ); ?>
								<?php else : ?>
								<?php _e( '<strong>Purpose</strong>', 'drizy' ); ?>
								</span>
								<?php endif; ?>
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
					<div class="product-toogle-font-size">
						<div class="label"><?php _e( 'Font Size', 'drizy' ); ?></div>
						<input type="range"  min="10" max="180" value="55" class="slider custom_slider" id="cat-text-size" name="text-size" data-index="1"  data-id="" data-font=""  oninput="this.nextElementSibling.value = this.value">
						<output class="font-size-number">55</output>
					</div>
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
					<h3 class="archive-web3-filter-title default"><?php _e( 'Web3 Fonts', 'drizy' ); ?></h3>
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
		if ( woocommerce_product_loop() ) {

			//woocommerce_product_loop_start();

			if ( wc_get_loop_prop( 'total' ) ) {
				while ( have_posts() ) {
					the_post();

					/**
					 * Hook: woocommerce_shop_loop.
					 */
					do_action( 'woocommerce_shop_loop' );

					if ( has_term( 'membership', 'product_cat' ) ) {
						wc_get_template_part( 'content-product', 'membership' );
						} else {
						wc_get_template_part( 'content', 'product' );
					}
					
				}
			}

			//woocommerce_product_loop_end();

			/**
			 * Hook: woocommerce_after_shop_loop.
			 *
			 * @hooked woocommerce_pagination - 10
			 */
			//do_action( 'woocommerce_after_shop_loop' );

		} else {
			/**
			 * Hook: woocommerce_no_products_found.
			 *
			 * @hooked wc_no_products_found - 10
			 */
			do_action( 'woocommerce_no_products_found' );
		} ?>		
	</div>

	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="product-pagination">
					<div class="button-effect">
						<?php echo facetwp_display( 'facet', 'loadmore' ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

<?php get_footer( 'shop' );

?>
