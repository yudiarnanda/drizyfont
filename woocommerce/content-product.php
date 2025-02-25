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
 * @version 9.4.0
 */

defined( 'ABSPATH' ) || exit;

global $woocommerce, $product, $post;


$current_user_id = get_current_user_id();

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

?>

<div <?php wc_product_class( 'thumbs', $product ); ?>>

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
						<?php if ( have_rows( 'font_preview_settings' ) ) : ?>
							<?php while ( have_rows( 'font_preview_settings' ) ) : the_row(); 
								$count = count(get_sub_field('font_preview')); ?>
								<?php if( have_rows('font_preview') ): ?>
									<span><?php echo $count; _e( ' Font Styles', 'drizy' ); ?></span>
									<span class="separator"></span>
								<?php endif; ?>
							<?php endwhile; ?>
						<?php endif; ?>
					</div>
					<?php if ( have_rows( 'variabel_font_settings' ) ) : ?>
						<?php while ( have_rows( 'variabel_font_settings' ) ) : the_row(); ?>
							<?php if ( get_sub_field( 'enable_variable_font' ) == 1 ) : ?>
								<div class="category-font-variable">
									<span><?php _e( 'Variable Font', 'drizy' ); ?></span>
									<span class="separator"></span>
								</div>
							<?php endif; ?>
						<?php endwhile; ?>
					<?php endif; ?>
					<div class="category-font-style-list">
						<div class="font-style-list">
							<?php $font_families = []; $font_faces_html = "<style type=\"text/css\">"; ?>
							<?php if ( have_rows( 'font_preview_settings' ) ) : ?>
								<?php while ( have_rows( 'font_preview_settings' ) ) : the_row(); ?>
									<?php if ( have_rows( 'font_preview' ) ) : ?>
									<select name="font-style" class="category-font-style drizy-custom-select" data-id="<?php echo $post->ID; ?>">
										<?php while ( have_rows( 'font_preview' ) ) : the_row(); 
											$font_style = get_sub_field( 'font_style' );
	                                        $upload_font = get_sub_field( 'upload_font' );
	                                        $url = $upload_font['url'];
	                                        $encodeurl = fontEncodeURL($url);
											$font_families[$font_style['value']] = $upload_font['title'];
											$font_faces_html .= "@font-face{
												font-family: '{$upload_font['title']}';
												src: url('$encodeurl') format('woff');
											} ";
										 ?>
											<option value="<?php echo esc_html( $upload_font['title'] ); ?>"><?php echo esc_html( $font_style['label'] ); ?></option>
										<?php endwhile; ?>
									</select>
									<?php endif; ?>
								<?php endwhile; ?>
							<?php endif; ?>
							<?php
								$first_family = array_shift( $font_families );
								$font_faces_html .= "#font-preview-{$post->ID} {font-family: '{$first_family}';</style>";
								echo $font_faces_html;
							?>
						</div>
					</div>	
				</div>
			</div>
			<div class="col-sm-6">
				<div class="product-meta-price">

					<?php if (yith_wcmbs_user_has_membership($current_user_id)) :
						$hash_text = $current_user_id . $post->ID;
						$hash = substr( hash( 'sha256', $hash_text ), 0, 16 );
						$zipped_link = add_query_arg( array( 'file_zip' => $hash, 'id' => $post->ID ), home_url( '/' ) );
					?>
						<div class="product-link product-freebies">
							<a href="<?php echo $zipped_link; ?>" class="button elementor-button">
								<span class="button-text"><?php _e( 'Download', 'drizy' ); ?></span>
								<span class="button-icon"><?php echo drizy_svg('chevron-right'); ?></span>
							</a>
						</div>					
					<?php else : ?>
						<?php if( ! has_term( 'freebies', 'product_cat' ) ) { ?>
							<?php if ( $product->is_on_sale() ) : ?>
								<div class="button-effect">
									<?php echo apply_filters( 'woocommerce_sale_flash', '<a class="product-onsale elementor-button"><span>' . esc_html__( 'Sale!', 'woocommerce' ) . '</span></a>', $post, $product ); ?>
								</div>
								<?php
							endif;
							?>
							<div class="product-price">
								<span class="price-label"><?php _e( 'Starting at ', 'drizy' ); ?></span>
								<span>
									<?php
										global $post;

										//Get the WC_Product_Variable instance Object
										$product = wc_get_product( $post->ID ); // Works for any product type

										//Displaying the formatted "Min" - "Max" price range
										echo $product->get_price_html();
									?>
								</span>
							</div>
							<div class="product-link">
								<a href="<?php echo get_permalink(); ?>" class="button elementor-button">
									<span class="button-text"><?php _e( 'Buy Font', 'drizy' ); ?></span>
									<span class="button-icon"><?php echo drizy_svg('chevron-right'); ?></span>
								</a>
							</div>
						<?php } else { ?>
							<div class="product-link product-freebies">
								<a href="<?php echo get_permalink(); ?>" class="button elementor-button">
									<span class="button-text"><?php _e( 'Download', 'drizy' ); ?></span>
									<span class="button-icon"><?php echo drizy_svg('chevron-right'); ?></span>
								</a>
							</div>
						<?php } ?>
					<?php endif; ?>
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
				<div class="product-cat-image-slide-container">
					<div class="product-cat-image-slide-inner">
						<div class="product-cat-image-slide">

							<?php 

								global $product;

								$attachment_ids = $product->get_gallery_image_ids();
								$image = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id ), 'thumbnail' );
							?>
							
							<div class="font-image-slide">
								<img src="<?php echo $image[0]; ?>">
							</div>

							<?php 
							$attachment_ids = $product->get_gallery_image_ids();
							$counter = 1;
					    	foreach( $attachment_ids as $attachment_id ) { ?>
								<div class="font-image-slide">
									<?php
										$image_url = wp_get_attachment_image_src( $attachment_id, 'thumbnail', true );
										$image = $image_url[0];
									?>
									<img src="<?php echo $image;?>" alt="<?php the_title(); ?>">
								</div>
								<?php 
									$counter++;
			            			if ($counter == 3 ) {
										break;
									}
							} ?>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>