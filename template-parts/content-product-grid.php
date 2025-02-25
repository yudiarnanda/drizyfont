<?php

defined( 'ABSPATH' ) || exit;

global $post, $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

?>

<div class="products">

	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<div class="product-title">
					<a href="<?php echo get_permalink(); ?>">
						<h5><?php the_title(); ?></h5>
					</a>
				</div>
				<div class="product-style">
					<select name="font-style-list" class="drizy-custom-select">
							<option value=""></option>
					</select>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="product-meta-price">
					<?php if ( $product->is_on_sale() ) : ?>
						<div class="button-effect">
							<?php echo apply_filters( 'woocommerce_sale_flash', '<a class="product-onsale elementor-button"><span>' . esc_html__( 'Sale!', 'woocommerce' ) . '</span></a>', $post, $product ); ?>
						</div>
						<?php
					endif;
					?>
					<div class="product-price">
					</div>
					<div class="product-link">
						<div class="button-effect no-effect">
							<a href="<?php echo get_permalink(); ?>" class="elementor-button">
								<span><?php _e( 'Download', 'drizy' ); ?></span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="product-cat-font-preview">
					<div class="font-preview-list text-preview-1" contenteditable="true" spellcheck="false">The quick brown fox jumps over a lazy dog</div>
					<div class="font-preview-list text-preview-2" contenteditable="true" spellcheck="false">Quizzical twins proved my hijack-bug fix</div>
					<div class="font-preview-list text-preview-3" contenteditable="true" spellcheck="false">Cozy sphinx waves quart jug of bad milk</div>
					<div class="font-preview-list text-preview-4" contenteditable="true" spellcheck="false">Fix problem quickly with galvanized jets</div>
					<div class="font-preview-list text-preview-5" contenteditable="true" spellcheck="false">Aa Bb Cc Dd Ee Ff Gg Hh Ii Jj Kk Ll Mm Nn Oo Pp...</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="product-cat-image-slide">
					<?php $images = get_field( 'preview_images' ); ?>
					<?php if ( $images ) { 
						$counter = 1; ?>
						<?php foreach ( $images as $image ) { ?>
							<div class="font-image-slide">
								<img src="<?php echo esc_url( $image['sizes']['thumbnail'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
							</div>
						<?php 
							$counter++;
	            			if ($counter == 4 ) {
								break;
							}
						}
					} ?>
				</div>
			</div>
		</div>
	</div>

</div>