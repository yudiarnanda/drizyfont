<?php

// Home Slider
function home_slider_image_shortcode() { 
    ob_start(); ?>

	<div class="home-slider">
		<div class="home-slider-image">
			<?php $images = get_field( 'slideshow_image', 'option' );
			if ( $images ) :  ?>
				<?php foreach ( $images as $image ): ?>
					<div class="image-slide">
						<div class="image-inner">
							<img src="<?php echo esc_url( $image ); ?>">
						</div>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
		<div class="home-slider-control">
			<span class="prev"><?php echo drizy_svg('prev-arrow'); ?></span>
			<span class="dots"></span>
			<span class="next"><?php echo drizy_svg('next-arrow'); ?></span>
		</div>
	</div>

	<?php $content = ob_get_clean();
	return $content;
}
add_shortcode( 'home_slider_image', 'home_slider_image_shortcode' );

// Product Search Form
function woo_product_search_form_shortcode() { 
    ob_start(); ?>

    <div class="drizy-product-search">
		<form role="search" method="get" class="woocommerce-product-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		   <input type="search" id="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" class="search-field" placeholder="<?php echo esc_attr__( 'Find fonts by name', 'drizy' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
		   <button type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'woocommerce' ); ?>" class="<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ); ?>">
		   		<span class="icon"><?php echo drizy_svg('search-icon'); ?></span>
		   		<span class="text"><?php echo esc_html_x( 'Search', 'submit button', 'woocommerce' ); ?></span>
		   	</button>
		   <input type="hidden" name="post_type" value="product" />
		</form>
	</div>

	<?php $content = ob_get_clean();
	return $content;
}
add_shortcode( 'woo_product_search_form', 'woo_product_search_form_shortcode' );


// Blog Search Form
function blog_search_form_shortcode() { 
    ob_start(); ?>

    <div class="drizy-product-search">
		<form role="search" method="get" class="woocommerce-product-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		   <input type="search" id="blog-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" class="search-field" placeholder="<?php echo esc_attr__( 'Search Blog', 'drizy' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
		   <button type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'drizy' ); ?>" class="<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ); ?>">
	   			<span class="icon"><?php echo drizy_svg('search-icon'); ?></span>
		   		<span class="text"><?php echo esc_html_x( 'Search', 'submit button', 'drizy' ); ?></span>
		   </button>
		   <input type="hidden" name="post_type" value="post" />
		</form>
	</div>

	<?php $content = ob_get_clean();
	return $content;
}
add_shortcode( 'blog_search_form', 'blog_search_form_shortcode' );


/**
 * Create Shortcode for WooCommerce Cart Menu Item
 */
add_shortcode ('woo_cart_button_icon', 'woo_cart_button_icon' );
function woo_cart_button_icon() {
    ob_start();
 
        $cart_count = WC()->cart->cart_contents_count; // Set variable for cart item count
        $cart_url = wc_get_cart_url();  // Set Cart URL
  
        ?>

         <div class="cart-user-menu">
         	<div class="cart-button">
		        <div class="button-effect">
		            <a class="cart-contents" href="<?php echo $cart_url; ?>" title="<?php _e( 'My Basket', 'drizy' ); ?>">
		                <span class="icon"><?php echo drizy_svg('cart'); ?></span>
						<div class="cart-contents-count-box">
		                <?php if ( $cart_count > 0 ) { ?>
		                    <span class="cart-contents-count"><?php echo $cart_count; ?></span>
		                <?php } ?>
						</div>
		            </a>
		         </div>
         	</div>
         	<div class="user-button">
         		<div class="button-effect">
         			<?php if ( is_user_logged_in() ) { ?>
         			<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>edit-account">
         				<span class="icon"><?php echo drizy_svg('personal'); ?></span>
         			</a>
         		<?php } else { ?>
         			<a href="#" id="sign-in">
         				<span><?php _e( 'Login', 'drizy' ); ?></span>
         			</a>
         			<script type="text/javascript">
         				// Off Canvas
			            document.getElementById("sign-in").onclick = function(){
			                elementorProFrontend.modules.popup.showPopup( { id: 2132 } );
			            }
         			</script>
         		<?php } ?>
         		</div>
         	</div>
         </div>

        <?php
            
    return ob_get_clean();
}


// Product Cat Preview Image Slide
function product_cat_preview_shortcode() { 

	ob_start(); ?>

	<div class="product-cat-image">
		<?php $images = get_field( 'preview_images' ); ?>
		<?php if ( $images ) { 
			//$counter = 1;  ?>
			<?php foreach ( $images as $image ) { ?>
				<div>
					<img src="<?php echo esc_url( $image['sizes']['thumbnail'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
				</div>
			<?php 
	            // $counter++;
	            // if ($counter == 4) {
	            //   break;
	            // }
			} ?>
		<?php } ?>
	</div>

	<?php $content = ob_get_clean();
	return $content;
}
add_shortcode( 'product_cat_preview', 'product_cat_preview_shortcode' );

/**
 * Show product total downloads
 * Add the shortcode [product_cat_list] through a short-code widget
 */
function product_cat_list_shortcode() { 

	ob_start(); 

	$tax_name = "product_cat";
    $terms = get_terms( array( 
    	'taxonomy' => $tax_name, 
    	'parent' => 0,
    	'hide_empty' => false,
    	//'exclude' => array('489', '588', '917'),
    	'include' => array('15', '16', '17', '18', '20', '19')
    ) );

	?>

	<div class="product-category-lists">
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

				<li class="product-category">
					<a href="<?php echo get_permalink( get_page_by_path( 'font-sale' ) ) ?>" title="<?php _e( 'Font Sale', 'drizy' ); ?>" class="cat-title">
						<div class="cat-image"><?php echo drizy_svg('font_sale'); ?></div>
						<span><?php _e( 'Font Sale', 'drizy' ); ?></span>
					</a>
					<div class="solutions__border"></div>
				</li>

				<li class="product-category">
					<a href="<?php echo get_permalink( get_page_by_path( 'freebies' ) ) ?>" title="<?php _e( 'Freebies', 'drizy' ); ?>" class="cat-title">
						<div class="cat-image"><?php echo drizy_svg('freebies'); ?></div>
						<span><?php _e( 'Freebies', 'drizy' ); ?></span>
					</a>
					<div class="solutions__border"></div>
				</li>

		</ul>
	</div>

	<?php $content = ob_get_clean();
	return $content;
	
}
add_shortcode( 'product_cat_list', 'product_cat_list_shortcode' );


// Get Categories Name Blog Post
function tername_shortcode() { 
    $terms = get_the_terms( get_the_ID(), 'category' );

    foreach ( $terms as $term ){
        if ( $term->parent == 0 ) {
            echo '<a href="' . get_term_link( $term ) . '" class="cat-name" title="' . $term->name . '"> / ' . $term->name . '</a>';
        }
    } 

}
add_shortcode( 'ternamehortcode', 'tername_shortcode' );


// Show Flash Sale
function flash_sale_badge_shortcode() { 

	// global $post, $product;

	// if ( $product->is_on_sale() ) : ?>
		<div class="button-effect">
		    <?php //echo apply_filters( 'woocommerce_sale_flash', '<a class="product-onsale elementor-button"><span>' . __( 'Sale!', 'woocommerce' ) . '</span></a>', $post, $product ); ?>

		</div>
		<?php
	//endif;
					
}
add_shortcode( 'flash_sale_badge', 'flash_sale_badge_shortcode' );


/**
 * Show product tags on single product page made with Elementor
 * Add the shortcode [drizy_product_tag] through a short-code widget on single product page
 */

function drizy_product_tag_shortcode() {

	ob_start();

	$output = array();

	// get an array of the WP_Term objects for a defined product ID
	$terms = wp_get_post_terms( get_the_id(), 'product_tag' ); ?>

	<div class="drizy-product-tag">
		<div class="tag-lists">
			<?php if( count($terms) > 0 ){
			    foreach($terms as $term){
			        $term_id = $term->term_id; // Product tag Id
			        $term_name = $term->name; // Product tag Name
			        $term_slug = $term->slug; // Product tag slug
			        $term_link = get_term_link( $term, 'product_tag' ); // Product tag link

			        // Set the product tag names in an array
			        $output[] = '<div class="tag-list"><a href="'.$term_link.'">'.$term_name.'</a></div>';
			    }
			    // Set the array in a coma separated string of product tags for example
			    $output = implode( '', $output );

			    // Display the coma separated string of the product tags
			    echo $output;
			}
			?>
		</div>
	</div>

	<?php $content = ob_get_clean();
	return $content;

}
add_shortcode( 'drizy_product_tag', 'drizy_product_tag_shortcode' );


// Toogle Show and Hide Image Preview Product Cat
function show_hide_image_cat_shortcode() { ?>
	<div class="show-hide-image">
		<span class="show-hide-label"><?php _e( 'Image', 'drizy' ); ?></span>
		<input type="checkbox" id="switch" /><label for="switch">Toggle</label>
	</div>
<?php }
add_shortcode( 'show_hide_image_cat', 'show_hide_image_cat_shortcode' );


// Service Marquee Text
function service_marquee_text_shortcode() {

	ob_start();
	?>

	<div class="service-marquee">
		<div class="marquee">
			<div class="marquee__inner-wrap">
				<div class="marquee__inner">
					<span><?php _e( 'Define Your Brand with Personalized Font Solutions', 'drizy' ); ?></span>
					<div class="marquee__img"><?php echo drizy_svg('marquee-icon'); ?></div>
					<span class="uppercase"><?php _e( 'Drizy Font', 'drizy' ); ?></span>
					<div class="marquee__img"><?php echo drizy_svg('marquee-icon'); ?></div>
					<span><?php _e( 'Define Your Brand with Personalized Font Solutions', 'drizy' ); ?></span>
					<div class="marquee__img"><?php echo drizy_svg('marquee-icon'); ?></div>
					<span class="uppercase" aria-hidden="true"><?php _e( 'Drizy Font', 'drizy' ); ?></span>
					<div class="marquee__img"><?php echo drizy_svg('marquee-icon'); ?></div>
					<span><?php _e( 'Define Your Brand with Personalized Font Solutions', 'drizy' ); ?></span>
					<div aria-hidden="true" class="marquee__img"><?php echo drizy_svg('marquee-icon'); ?></div>
					<span class="uppercase"><?php _e( 'Drizy Font', 'drizy' ); ?></span>
					<div aria-hidden="true" class="marquee__img"><?php echo drizy_svg('marquee-icon'); ?></div>
					<span><?php _e( 'Define Your Brand with Personalized Font Solutions', 'drizy' ); ?></span>
					<div aria-hidden="true" class="marquee__img"><?php echo drizy_svg('marquee-icon'); ?></div>
					<span class="uppercase"><?php _e( 'Drizy Font', 'drizy' ); ?></span>
					<div aria-hidden="true" class="marquee__img"><?php echo drizy_svg('marquee-icon'); ?></div>
				</div>
			</div>
		</div>
    </div>

	<?php $content = ob_get_clean();
	return $content;

}
add_shortcode( 'service_marquee_text', 'service_marquee_text_shortcode' );

// Rent Option - Services Page
function rent_option_slide_shortcodes()  {

	ob_start();
	
	?>

 	<div class="hero-container">
		<div class="hero-cards">
			<div class="container-general">
				<div class="gallery-wrap">
					<div class="item active" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/inc/img/embed-license-rent-option-1.jpeg);"></div>
					<div class="item" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/inc/img/embed-license-rent-option-2.jpeg);"></div>
					<div class="item" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/inc/img/embed-license-rent-option-3.jpeg);"></div>
				</div>
			</div>
		</div>
    </div>
		
	<?php $content = ob_get_clean();
	return $content;

}
add_shortcode( 'rent_option_slide', 'rent_option_slide_shortcodes' );


// Home Page Big Text
function home_big_text_shortcodes()  {

	ob_start();
	
	?>

	<div class="home-big-text-wrapper">
		<div class="big-text-top-right">
			<p><span>Create 100% original</span> handmade serif, sans serif, script and decorative fonts with various themes for display font needs, film intros, creative studio needs and other graphic design needs.</p>
		</div>
		<h1 class="home-big-text-left">
			<?php get_template_part( 'inc/home-big', 'text' ); ?>
		</h1>
		<div class="big-text-bottom-right">
			<a href="#" class="rolling-text">
				<?php
					$args = array( 'post_type' => 'product', 'post_status' => 'publish', 'posts_per_page' => -1 );
					$products = new WP_Query( $args );
				?>
				<?php echo $products->found_posts; ?> <?php _e( ' Fonts', 'drizy' ); ?>
			</a>
			<a href="#" class="rolling-text">
				<?php _e( 'Various typeface styles', 'drizy' ); ?>
			</a>
			<a href="#" class="rolling-text">
				<?php _e( 'Custom typefaces available now', 'drizy' ); ?>
			</a>
		</div>
	</div>

	<?php $content = ob_get_clean();
	return $content;
}
add_shortcode( 'home_big_text', 'home_big_text_shortcodes' );	


// COntributor Feature Product
function contributor_featured_product_shortcodes()  {

	ob_start();

	global $post, $product;
	
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
	</div>

	<?php $content = ob_get_clean();
	return $content;
}
add_shortcode( 'contributor_featured_product', 'contributor_featured_product_shortcodes' );		


// Get Author Number Posts
function author_product_count_shortcodes()  {

	ob_start();

	global $wp_query, $wpdb;
	$curauth = $wp_query->get_queried_object();
	$post_count = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_author = '" . $curauth->ID . "' AND post_type = 'product' AND post_status = 'publish'");
	
	?>

	<div class="contributor-product-count">
		<div class="product-count-ribbon">
			<div class="product-number"><?php echo $post_count; ?></div>
			<div class="product-label"><?php _e( 'Products', 'drizy' ); ?></div>
		</div>
	</div>

	<?php 
	$content = ob_get_clean();
	return $content;
}
add_shortcode( 'author_product_count', 'author_product_count_shortcodes' );		


// Get Author Number Posts
function author_social_profile_shortcodes()  {

	ob_start(); 

	$author_id = get_the_author_meta('ID');
	$pinterest = get_field('pinterest', 'user_'. $author_id );
	$instagram = get_field('instagram', 'user_'. $author_id );
	$facebook = get_field('facebook', 'user_'. $author_id );
	$behance = get_field('behance', 'user_'. $author_id );

	?>

	<div class="author-social-profile">
		<div class="social-btn">
			<?php if( $pinterest ): ?>
				<a href="<?php echo $pinterest; ?>" class="s-pinterest" target="blank"><?php echo drizy_svg('pinterest'); ?></a>
			<?php endif; ?>
			<?php if( $instagram ): ?>
				<a href="<?php echo $instagram; ?>" class="s-instagram" target="blank"><?php echo drizy_svg('instagram'); ?></a>
			<?php endif; ?>
			<?php if( $facebook ): ?>
				<a href="<?php echo $facebook; ?>" class="s-facebook" target="blank"><?php echo drizy_svg('facebook'); ?></a>
			<?php endif; ?>
			<?php if( $behance ): ?>
				<a href="<?php echo $behance; ?>" class="s-behance"  target="blank"><?php echo drizy_svg('behance'); ?></a>
			<?php endif; ?>
		</div>
	</div>

	<?php 
	$content = ob_get_clean();
	return $content;
}
add_shortcode( 'author_social_profile', 'author_social_profile_shortcodes' );		


// Author CTA
function author_cta_frame_shortcodes()  {

	ob_start();
	
	?>

	<div class="contributor-cta-container">
		<div class="cta-top">
			<h2><?php _e( 'Drizy Font EXCLUSIVE Contributors', 'drizy' ); ?></h2>
			<p><?php _e( 'Explore the creative works of our passionate contributors who share their time, skills, and unique talents, bringing diverse perspectives and expertise to the table.', 'drizy' ); ?></p>
		</div>
		<div class="cta-bottom">
			<div class="cta-bottom-left">
				<a class="cta-button" href="<?php echo get_permalink( get_page_by_path( 'exclusive-contributor' ) ) ?>">
					<span class="cta-btn-text"><?php _e( 'View All', 'drizy' ); ?></span>
					<span class="cta-btn-icon"></span>
					<span class="btn-icon">
						<?php echo drizy_svg('arrow-up'); ?>
					</span>
				</a>
			</div>
			<div class="cta-bottom-right">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/img/contributor-d-logo.png">
			</div>
		</div>
	</div>

	<?php 
	$content = ob_get_clean();
	return $content;
}
add_shortcode( 'author_cta_frame', 'author_cta_frame_shortcodes' );	

// Rent License Heading
function rent_license_heading_shortcodes()  {

	ob_start();
	
	?>

	<span class="bold"><?php _e( 'Flexible', 'drizy' ); ?></span>
	<span class="background bg-left">
		<span class="divider">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/img/rent-license-head-line.svg">
		</span>
		<?php _e( 'Font', 'drizy' ); ?>
	</span>
	<span class="background bg-right">
		<?php _e( 'Rental Options', 'drizy' ); ?>
		<span class="divider">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/img/rent-license-head-line.svg">
		</span>
	</span>

	<?php 
	$content = ob_get_clean();
	return $content;
}
add_shortcode( 'rent_license_heading', 'rent_license_heading_shortcodes' );


// Rent License Heading
function ap_subheading_shortcodes()  {

	ob_start();
	
	?>

	<div class="ap-subheading">
		<span class="bold"><?php _e( 'With Our', 'drizy' ); ?></span>
		<span class="background bg-left">
			<span class="divider">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/img/ap-subhead-line.svg">
			</span>
			<?php _e( 'Partnership', 'drizy' ); ?>
		</span>
		<span class="background bg-right">
			<?php _e( 'Program', 'drizy' ); ?>
			<span class="divider">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/img/ap-subhead-line.svg">
			</span>
		</span>
	</div>

	<?php 
	$content = ob_get_clean();
	return $content;
}
add_shortcode( 'ap_subheading', 'ap_subheading_shortcodes' );	


// Button more stories on blog page
function button_more_stories_shortcodes()  {

	ob_start();
	
	?>

	<div class="more-web-stories">
		<div class="cta-bottom-left">
			<a class="cta-button" href="<?php echo get_permalink( get_page_by_path( 'web-stories' ) ) ?>">
				<span class="cta-btn-text"><?php _e( 'View All', 'drizy' ); ?></span>
				<span class="cta-btn-icon"></span>
				<span class="btn-icon">
					<?php echo drizy_svg('arrow-up'); ?>		
				</span>
			</a>
		</div>
	</div>

	<?php 
	$content = ob_get_clean();
	return $content;
}
add_shortcode( 'button_more_stories', 'button_more_stories_shortcodes' );


// Button more stories on blog page
function ap_frame_shortcodes()  {

	ob_start();
	
	?>

	<div class="highlight-head absolute">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/img/ap-frame-dot.svg" class="tiny">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/img/ap-frame-dot.svg" class="tiny tiny-2">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/img/ap-frame-dot.svg" class="tiny tiny-3">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/img/ap-frame-dot.svg" class="tiny tiny-4">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/img/ap-frame-dot.svg" class="tiny tiny-5">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/img/ap-frame-dot.svg" class="tiny tiny-6">
	</div>


	<?php 
	$content = ob_get_clean();
	return $content;
}
add_shortcode( 'ap_frame', 'ap_frame_shortcodes' );


// Button more stories on blog page
function cs_customization_shortcodes()  {

	ob_start();
	
	?>

	<div class="cs-customization-inner">
		<div class="option-variant">
			<div class="option-label">
				<input type="checkbox" id="alternates">
				<label for="alternates">Toggle</label>
				<?php _e( 'Alternates', 'drizy' ); ?>
			</div>
			<div class="option-text alternates">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/img/custom-services/1.1.svg" class="on">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/img/custom-services/1.2.svg" class="of">
			</div>
		</div>
		<div class="option-variant">
			<div class="option-label">
				<input type="checkbox" id="custom-weight">
				<label for="custom-weight">Toggle</label>
				<?php _e( 'Custom weight', 'drizy' ); ?>
			</div>
			<div class="option-text custom-weight">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/img/custom-services/2.1.svg" class="on">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/img/custom-services/2.2.svg" class="of">
			</div>
		</div>
		<div class="option-variant">
			<div class="option-label">
				<input type="checkbox" id="condensed">
				<label for="condensed">Toggle</label>
				<?php _e( 'Condensed', 'drizy' ); ?>
			</div>
			<div class="option-text condensed">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/img/custom-services/3.2.svg" class="on">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/img/custom-services/3.1.svg" class="of">
			</div>
		</div>
		<div class="option-variant">
			<div class="option-label">
				<input type="checkbox" id="expanded">
				<label for="expanded">Toggle</label>
				<?php _e( 'Expanded', 'drizy' ); ?>
			</div>
			<div class="option-text expanded">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/img/custom-services/4.2.svg" class="on">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/img/custom-services/4.1.svg" class="of">
			</div>
		</div>
		<div class="option-variant">
			<div class="option-label">
				<input type="checkbox" id="custom-serif">
				<label for="custom-serif">Toggle</label>
				<?php _e( 'Custom serif', 'drizy' ); ?>
			</div>
			<div class="option-text custom-serif">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/img/custom-services/5.2.svg" class="on">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/img/custom-services/5.1.svg" class="of">
			</div>
		</div>
		<div class="option-variant">
			<div class="option-label">
				<input type="checkbox" id="custom-ligatures">
				<label for="custom-ligatures">Toggle</label>
				<?php _e( 'Custom ligatures', 'drizy' ); ?>
			</div>
			<div class="option-text custom-ligatures">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/img/custom-services/6.1.svg" class="on">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/img/custom-services/6.2.svg" class="of">
			</div>
		</div>
		<div class="option-variant">
			<div class="option-label">
				<input type="checkbox" id="custom-contrast">
				<label for="custom-contrast">Toggle</label>
				<?php _e( 'Custom contrast', 'drizy' ); ?>
			</div>
			<div class="option-text custom-contrast">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/img/custom-services/7.1.svg" class="on">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/img/custom-services/7.2.svg" class="of">
			</div>
		</div>
		<div class="option-variant">
			<div class="option-label">
				<input type="checkbox" id="custom-pua">
				<label for="custom-pua">Toggle</label>
				<?php _e( 'Custom PUA', 'drizy' ); ?>
			</div>
			<div class="option-text custom-pua">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/img/custom-services/8.1.svg" class="on">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/img/custom-services/8.2.svg" class="of">
			</div>
		</div>
		<div class="option-variant">
			<div class="option-label">
				<input type="checkbox" id="custom-height">
				<label for="custom-height">Toggle</label>
				<?php _e( 'Custom height', 'drizy' ); ?>
			</div>
			<div class="option-text custom-height">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/img/custom-services/9.1.svg" class="on">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/img/custom-services/9.2.svg" class="of">
			</div>
		</div>
		<div class="option-variant">
			<div class="option-label">
				<input type="checkbox" id="custom-punctuation">
				<label for="custom-punctuation">Toggle</label>
				<?php _e( 'Custom punctuation', 'drizy' ); ?>
			</div>
			<div class="option-text custom-punctuation">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/img/custom-services/10.1.svg" class="on">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/img/custom-services/10.2.svg" class="of">
			</div>
		</div>
		<div class="option-variant">
			<div class="option-label">
				<input type="checkbox" id="custom-tabular">
				<label for="custom-tabular">Toggle</label>
				<?php _e( 'Custom tabular', 'drizy' ); ?>
			</div>
			<div class="option-text custom-tabular">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/img/custom-services/11.1.svg" class="on">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/img/custom-services/11.2.svg" class="of">
			</div>
		</div>
		<div class="option-variant">
			<div class="option-label">
				<input type="checkbox" id="old-style">
				<label for="old-style">Toggle</label>
				<?php _e( 'Old-Style', 'drizy' ); ?>
			</div>
			<div class="option-text old-style">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/img/custom-services/12.1.svg" class="on">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/img/custom-services/12.2.svg" class="of">
			</div>
		</div>
	</div>


	<?php 
	$content = ob_get_clean();
	return $content;
}
add_shortcode( 'cs_customization', 'cs_customization_shortcodes' );



/*
 * Output a simple unordered list of posts in a particular category id
 */
function posts_in_category_func() { 

	ob_start();

	?>

	<div class="blog-categories">
		<select name="event-dropdown" class="drizy-custom-select" onchange='document.location.href=this.options[this.selectedIndex].value;'> 

			<?php 
				$option = '<option value="' . get_option('home') . '/blog/">Categories</option>'; // change category to your custom page slug
				$categories = get_categories(); 
				foreach ($categories as $category) {
					$option .= '<option value="'.get_option('home').'/category/'.$category->slug.'">';
					$option .= $category->cat_name;
					$option .= '</option>';
				}
				echo $option;
			?>

		</select>
	</div>

	<?php 
	$content = ob_get_clean();
	return $content;
}
add_shortcode( 'posts_in_category', 'posts_in_category_func' );






/*
 * Output a simple unordered list of posts in a particular category id
 */
function button_cart_alt_func() { 

	ob_start();

	?>

	<div class="add-to-cart">
		<button class="elementor-button button product_type_variation add_to_cart_button ajax_add_to_cart" data-quantity="1" data-product_id="<?php echo $v['variation_id']; ?>">
			<div class="button-inner">
				<span class="button-text"><?php _e( 'Add to Cart', 'drizy' ); ?></span>
				<span class="button-icon"><?php echo drizy_svg('cart'); ?></span>
			</div>
		</button>
	</div>

	<?php 
	$content = ob_get_clean();
	return $content;
}
add_shortcode( 'button_cart_alt', 'button_cart_alt_func' );


/*
 * Output a simple unordered list of posts in a particular category id
 */
function button_cart_alt_2_func() { 

	ob_start();

	?>

	<div class="add-to-cart alt-2">
		<button class="elementor-button button product_type_variation add_to_cart_button ajax_add_to_cart" data-quantity="1" data-product_id="<?php echo $v['variation_id']; ?>">
			<div class="button-inner">
				<span class="button-text"><?php _e( 'Add to Cart', 'drizy' ); ?></span>
				<span class="button-icon"><?php echo drizy_svg('cart'); ?></span>
			</div>
		</button>
	</div>

	<?php 
	$content = ob_get_clean();
	return $content;
}
add_shortcode( 'button_cart_alt_2', 'button_cart_alt_2_func' );



/*
 * Output a simple unordered list of posts in a particular category id
 */
function contributor_avatar_func() { 

	ob_start();

	$user_id = get_the_author_meta('ID');
	$user_acf_prefix = 'user_';
	$user_id_prefixed = $user_acf_prefix . $user_id;
	$url = get_author_posts_url(get_the_author_meta('ID'));

	?>

	<?php if ( get_field( 'contributor_avatar', $user_id_prefixed ) ) : ?>
		<div class="contributor-avatar-image">
			<a href="<?php echo $url; ?>">
				<img src="<?php the_field( 'contributor_avatar', $user_id_prefixed ); ?>" />
			</a>
		</div>
	<?php endif ?>
		

	<?php 
	$content = ob_get_clean();
	return $content;

}
add_shortcode( 'contributor_avatar', 'contributor_avatar_func' );