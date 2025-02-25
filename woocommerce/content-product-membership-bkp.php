<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $woocommerce, $product, $post;

?>

<div <?php wc_product_class( '', $product ); ?>>

	<div class="container">
		<div class="row d-flex align-items-end">
			<div class="col-sm-6">
				<div class="product-title">
					<a href="<?php echo get_permalink(); ?>">
						<h5><?php the_title(); ?></h5>
					</a>
				</div>
				<div class="category-meta-wrapper">
					<div class="category-font-style-count">
					</div>
					<div class="category-font-style-list">
						<div class="font-style-list">
						</div>
					</div>	
				</div>
			</div>
			<div class="col-sm-6">
				<div class="product-meta-price">
					<div class="product-link product-freebies">
						<a href="<?php echo get_permalink(); ?>" class="button elementor-button">
							<span class="button-text"><?php _e( 'Rent Now!', 'drizy' ); ?></span>
							<span class="button-icon"><?php echo drizy_svg('chevron-right'); ?></span>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="product-cat-font-preview" id="font-preview-<?php echo $post->ID; ?>">
					<div class="font-preview-list text-preview-1" contenteditable="true" spellcheck="false">The quick brown fox jumps over a lazy dog</div>
					<div class="font-preview-list text-preview-2 hide" contenteditable="true" spellcheck="false">Quizzical twins proved my hijack-bug fix</div>
					<div class="font-preview-list text-preview-3 hide" contenteditable="true" spellcheck="false">Cozy sphinx waves quart jug of bad milk</div>
					<div class="font-preview-list text-preview-4 hide" contenteditable="true" spellcheck="false">Fix problem quickly with galvanized jets</div>
					<div class="font-preview-list text-preview-5 hide" contenteditable="true" spellcheck="false">Aa Bb Cc Dd Ee Ff Gg Hh Ii Jj Kk Ll Mm Nn Oo Pp...</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="product-cat-image-slide">
				</div>
			</div>
		</div>
	</div>

</div>