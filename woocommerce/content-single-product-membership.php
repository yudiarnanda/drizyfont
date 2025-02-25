<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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

global $post, $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}

if ( have_rows( 'font_preview_settings' ) ) : ?>
	<?php while ( have_rows( 'font_preview_settings' ) ) : the_row(); ?>		
		<?php if( have_rows('font_preview') ): ?>
			<style type="text/css">
			<?php while( have_rows('font_preview') ): the_row();
				$file = get_sub_field('upload_font');
				$url = $file['url'];
				$title = $file['title'];
				$id = $file['id'];
			?>

				@font-face { 
					font-family: 'font_<?php echo esc_attr($id); ?>'; 
					src: url('<?php echo $url; ?>') format('woff2');
					font-weight: 400; 
					font-style: normal;
				}

			<?php 
			endwhile; ?>
			</style>
		<?php  endif;
	endwhile;
endif;

// Glyph
if( have_rows('font_preview_settings') ):
	while( have_rows('font_preview_settings') ): the_row();
		$glyph_sample_text = get_sub_field('glyph_sampe_text');
		if( have_rows('font_preview') ): ?>
			<style type="text/css">
				<?php while( have_rows('font_preview') ): the_row();
					$file_glyph = get_sub_field('upload_font');
					$url_glyph = $file_glyph['url'];
					$title_glyph = $file_glyph['title'];
					$id_glyph = $file_glyph['id']; ?>
					@font-face { 
						font-family: 'font_<?php echo esc_attr($id_glyph); ?>'; 
						src: url('<?php echo fontEncodeURL($url_glyph); ?>') format('woff2-variations'); 
					}

				<?php endwhile; ?>
			</style>
		<?php 
		endif;
	endwhile; 
endif;
										
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

	<!-- Start Product Header -->
	<div class="single-product-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12">
					<div class="product-breadcrumb">
						<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
					</div>
					<div class="product-title">
						<div class="row">
							<div class="col-sm-10 title-inner">
								<h1><?php the_title(); ?></h1>
							</div>
							<div class="col-sm-2">
								<div class="buying-options-inner">
								    <div class="button-effect no-effect">
										<?php 

											if ( is_user_logged_in() ) {
												$downloads = $product->get_downloads();
												foreach( $downloads as $key => $each_download ) {
												  echo '<a href="'.$each_download["file"].'" class="buying-options elementor-button"><span>Download</span></a>';
												}
											} else {
												echo '<a href="#" class="free-download-btn elementor-button"><span>Download</span></a>';
											}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Product Header -->

</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>