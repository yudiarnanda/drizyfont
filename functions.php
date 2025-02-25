<?php
/**
 * Theme functions and definitions.
 *
 * For additional information on potential customization options,
 * read the developers' documentation:
 *
 * https://developers.elementor.com/docs/hello-elementor-theme/
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'HELLO_ELEMENTOR_CHILD_VERSION', '2.0.0' );

/**
 * Load child theme scripts & styles.
 *
 * @return void
 */
function hello_elementor_child_scripts_styles() {

	// CSS

	wp_enqueue_style(
		'theme-style',
		get_stylesheet_directory_uri() . '/inc/css/theme-style.css',
		[
			'hello-elementor-theme-style',
		],
		HELLO_ELEMENTOR_CHILD_VERSION
	);

	wp_enqueue_style( 
		'nice-select', 
		get_stylesheet_directory_uri() . '/inc/css/nice-select.css', 
		[
			'hello-elementor-theme-style', 
		], 
		HELLO_ELEMENTOR_CHILD_VERSION
	);

	wp_enqueue_style(
		'hello-elementor-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[
			'hello-elementor-theme-style',
		],
		HELLO_ELEMENTOR_CHILD_VERSION
	);

	wp_enqueue_style( 
		'grid', 
		get_stylesheet_directory_uri() . '/inc/css/grid.css', 
		[
			'hello-elementor-theme-style', 
		], 
		HELLO_ELEMENTOR_CHILD_VERSION
	);

	wp_enqueue_style( 
		'slick', 
		get_stylesheet_directory_uri() . '/inc/css/slick.css', 
		[
			'hello-elementor-theme-style', 
		], 
		HELLO_ELEMENTOR_CHILD_VERSION
	);

	wp_enqueue_style( 
		'responsive', 
		get_stylesheet_directory_uri() . '/inc/css/responsive.css', 
		[
			'hello-elementor-theme-style', 
		], 
		HELLO_ELEMENTOR_CHILD_VERSION
	);

		wp_enqueue_style( 
		'aos', 
		get_stylesheet_directory_uri() . '/inc/css/aos.css', 
		[
			'hello-elementor-theme-style', 
		], 
		HELLO_ELEMENTOR_CHILD_VERSION
	);

	// JS
	wp_enqueue_script( 
		'functions', 
		get_stylesheet_directory_uri() . '/inc/js/theme-functions.js', 
		array('jquery'), '1.0.0', true 
	);

	wp_enqueue_script( 
		'slickjs', 
		get_stylesheet_directory_uri() . '/inc/js/slick.min.js', 
		array('jquery'), '1.0.0', true 
	);

	wp_enqueue_script( 
		'nice-select', 
		get_stylesheet_directory_uri() . '/inc/js/jquery.nice-select.js', 
		array('jquery'), '1.0.0', true 
	);

	wp_enqueue_script( 
		'aos', get_stylesheet_directory_uri() . '/inc/js/aos.js', 
		array('jquery'), '1.0.0', true 
	);

    if ( is_product() ) {
        wp_enqueue_script( 
        	'font-control.js', get_stylesheet_directory_uri() . '/inc/js/font-control.js', 
        	array(), rand(0,9), true );
        wp_localize_script( 
        	'font-control.js', 'ajax_object', 
        	array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) 
        );
    }

}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_scripts_styles', 20 );


// Add theme support
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'product-grid', 643, 428, true );
	add_image_size( 'home-blog-grid', 784, 420, true );
	add_image_size( 'archive-blog-grid', 486, 729, true );
}

add_action( 'after_setup_theme', function() {
  add_theme_support( 'woocommerce' );
} );


/**
 * Load Theme functions and definitions.
 *
 * @return void
 */

require get_theme_file_path( '/inc/drizy-svg.php' );
require get_theme_file_path( '/inc/woo-functions.php' );
require get_theme_file_path( '/inc/theme-functions.php' );
require get_theme_file_path( '/inc/shortcodes/shortcodes.php' );
require get_theme_file_path( '/inc/shortcodes/buying-options.php' );
require get_theme_file_path( '/inc/shortcodes/social-media-share.php' );
require get_theme_file_path( '/inc/shortcodes/single-license-shortcode.php' );
//require get_theme_file_path( '/inc/shortcodes/font-preview-shortcodes.php' );


add_action('admin_head', 'hide_product_edito_widget');
function hide_product_edito_widget() {
	echo '<style>
	#product_catdiv, 
	#tagsdiv-product_tag, 
	#purposediv,
	#your-profile .user-profile-picture,
	#toplevel_page_yith_plugin_panel ul li:last-child {
		display: none;
	} 

	.acf-fields > .acf-field[data-name="font_weight_max"],
	.acf-fields > .acf-field[data-name="font_width_max"],
	.acf-fields > .acf-field[data-name="font_optical_size_max"],
	.acf-fields > .acf-field[data-name="font_italic_max"],
	.acf-fields > .acf-field[data-name="font_serif_max"],
	.acf-fields > .acf-field[data-name="font_slant_max"] {
		padding-top: 0;
		border-top: 0;
	}

	.acf-fields > .acf-field[data-name="font_weight_max"] .acf-label,
	.acf-fields > .acf-field[data-name="font_width_max"] .acf-label,
	.acf-fields > .acf-field[data-name="font_optical_size_max"] .acf-label,
	.acf-fields > .acf-field[data-name="font_italic_max"] .acf-label,
	.acf-fields > .acf-field[data-name="font_serif_max"] .acf-label,
	.acf-fields > .acf-field[data-name="font_slant_max"] .acf-label {
		display: none;
	}

	</style>';
}

add_filter( 'woocommerce_add_to_cart_fragments', 'fwzy_add_to_cart_fragment' );
function fwzy_add_to_cart_fragment( $fragments ) {
	$fragments[ '.cart-contents-count-box' ] = '<div class="cart-contents-count-box"><span class="cart-contents-count">' . absint( WC()->cart->get_cart_contents_count() ) . '</span></div>';
 	return $fragments;
}


add_action( 'facetwp_scripts', function() {
  ?>
  <script>
    (function($) {
      $(document).on('facetwp-loaded', function() {
		  if ( FWP.loaded ) {
			  $('.drizy-custom-select').niceSelect('destroy');
			  $('.drizy-custom-select').niceSelect();

			  $('.facetwp-facet-contributor_cat select').niceSelect('destroy');
			  $('.facetwp-facet-contributor_cat select').niceSelect();

			  $('.facetwp-facet-cat select').niceSelect('destroy');
			  $('.facetwp-facet-cat select').niceSelect();

		  }
		  
          var imageOn = $('#switch:checked').val();
          if( typeof imageOn == 'undefined' ) {
            $(".product-archive-container .product").removeClass("thumbs");
            $(".product-archive-container .product-cat-image-slide-inner").slideToggle(1);
          } else {
            $(".product-archive-container .product").addClass("thumbs");
            //$(".product-archive-container .product-cat-image-slide-inner").slideToggle();
          }
      });
    })(jQuery);
  </script>
  <?php
}, 100 );



add_action('parse_request', 'fwzy_modify_parse_request', 1);
function fwzy_modify_parse_request($wp) {
    if (!is_admin()) {
        $slug = '';
        if (isset($wp->query_vars['product'])) {
            $slug = $wp->query_vars['product'];
        } elseif (isset($wp->query_vars['product_cat'])) {
            $slug = $wp->query_vars['product_cat'];
        } elseif (isset($wp->query_vars['product_tag'])) {
            $slug = $wp->query_vars['product_tag'];
        }
        
        if (empty($slug))
            return;

        if (class_exists('WooCommerce')) {
            // For product categories
            if ($product_cat = get_term_by('slug', $slug, 'product_cat')) {
                fwzy_unset_vars($wp->query_vars);
                $wp->query_vars['product_cat'] = $product_cat->slug;
                return;
            }

            // For product tags
            if ($product_tag = get_term_by('slug', $slug, 'product_tag')) {
                fwzy_unset_vars($wp->query_vars);
                $wp->query_vars['product_tag'] = $product_tag->slug;
                return;
            }

            // For individual products
            if ($product = get_page_by_path($slug, OBJECT, 'product')) {
                fwzy_unset_vars($wp->query_vars);
                $wp->query_vars['p'] = $product->ID;
                $wp->query_vars['post_type'] = 'product';
                return;
            }
        }
        
        // For purpose taxonomy
        if ($purpose = get_term_by('slug', $slug, 'purpose')) {
            fwzy_unset_vars($wp->query_vars);
            $wp->query_vars['purpose'] = $purpose->slug;
            return;
        }
    }
}

function fwzy_unset_vars( &$vars ) {
  foreach( $vars as $k => $val ) {
    if( $k != 'paged' )
      unset( $vars[$k] );
  }
}



function fwzy_download_zipped() {
  if( isset( $_REQUEST['file_zip'] ) && isset( $_REQUEST['id'] ) ) {
		$file_zip = $_REQUEST['file_zip'];
		$post_id  = $_REQUEST['id'];
		$user_id  = get_current_user_id();
		
		$hash_text = $user_id . $post_id;
		$hash = substr( hash( 'sha256', $hash_text ), 0, 16 );
		
		$has_access = yith_wcmbs_user_has_membership( $user_id );
		if( $has_access && $hash == $file_zip ) {
			$sbs = YITH_WC_Subscription()->get_user_subscriptions( $user_id, $status = 'active' );																								
			$_subscription = ywsbs_get_subscription( $sbs[0] );

			$file_to_zip = [];
			$protected_files = yith_wcmbs_get_protected_links( $_subscription->product_id );
			if( !empty( $protected_files ) ) {
				$pdf_file_path = str_replace( WP_CONTENT_URL, WP_CONTENT_DIR, $protected_files[0]['link'] );
				if( file_exists( $pdf_file_path ) )
					$file_to_zip[] = $pdf_file_path;
			}

			$_product = wc_get_product( $post_id );
			$_available_vars = $_product->get_available_variations();
			foreach ($_available_vars as $variation) {
				if( $variation['attributes']['attribute_pa_font-styles'] == 'family-package' && $variation['attributes']['attribute_pa_font-licenses'] == 'personal' ) {
					$family_variation_id = $variation['variation_id'];
					$variation_product = wc_get_product($family_variation_id);
					if ($variation_product->is_downloadable()) {
						$download_files = $variation_product->get_downloads();
						foreach ($download_files as $file) {
							$font_file_path = str_replace( WP_CONTENT_URL, WP_CONTENT_DIR, $file['file'] );
							if( file_exists( $font_file_path ) )
								$file_to_zip[] = $font_file_path;
						}
					}
					break;
				}
			}
			
			$filename_zip = $_product->get_slug() . "_drizyfont.com.zip";
			//$tmpfile = tempnam("tmp", "zip");
			$tmpfile = WP_CONTENT_DIR . '/uploads/' . $filename_zip;
			$zip = new ZipArchive();
			$zip->open($tmpfile, ZipArchive::CREATE | ZipArchive::OVERWRITE);

			foreach( $file_to_zip as $file ) {
				$filename  = basename( $file );
				$zip->addFile($file, $filename);
			}

			$zip->close();
			
			do_action( 'woocommerce_download_file_force', $tmpfile, $filename_zip );
			
			//~ header('Content-Type: application/zip');
			//~ header('Content-Length: ' . filesize($tmpfile));
			//~ header('Content-Disposition: attachment; filename="'. $filename_zip .'"');
			//~ readfile($tmpfile);
			//~ unlink($tmpfile);
			//~ die();

		} else {
			wp_die( __( 'You can\'t access to this content.', 'drizy' ), __( 'Restricted Access.', 'drizy' ) );
		}
	}
}
add_action( 'wp', 'fwzy_download_zipped', 999 );