<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.9.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>
	<div class="fonts-cart-container">
		<div class="fonts-cart-header">
			<div class="font-title"><?php esc_html_e( 'Font', 'woocommerce' ); ?></div>
			<div class="font-lisence"><?php esc_html_e( 'License', 'woocommerce' ); ?></div>
			<div class="font-price"><?php esc_html_e( 'Price', 'woocommerce' ); ?></div>
		</div>
		<?php do_action( 'woocommerce_before_cart_contents' ); ?>
		<?php		

			$cat_in_cart = false;

			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				/**
				 * Filter the product name.
				 *
				 * @since 2.1.0
				 * @param string $product_name Name of the product in the cart.
				 * @param array $cart_item The product in the cart.
				 * @param string $cart_item_key Key for the product in the cart.
				 */
				$product_name = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );

				// If Cart has category "membership", set $cat_in_cart to true
				if ( has_term( 'membership', 'product_cat', $cart_item['product_id'] ) ) {
			 		$cat_in_cart = true;
				 	//break;
				}

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );

					?>
					<div class="fonts-cart-content">

						<?php 
							///////////////////////////////////////////////////////////////////////////////
							/*$product_ = wc_get_product($product_id); 
							$available_variations = $product_->get_available_variations();
							$font_styles = [];
							if(!empty($available_variations)) {
								foreach($available_variations as $key=>$val) {
									$font_styles[] = isset($val['attributes']['attribute_pa_font-styles']) ? $val['attributes']['attribute_pa_font-styles'] : '';
								}		
							}*/

							if ( ! $cat_in_cart ) {
								$font_preview = get_field( 'field_66937a8963cd2', $product_id );
								$current_var = str_replace('-package', '', $cart_item['variation']['attribute_pa_font-styles']);
								if( $current_var == 'family' )
									$current_var = 'regular';
						
								$font_families = [];
								$font_faces_html = "<style type=\"text/css\">";
								foreach( $font_preview['font_preview'] as $item ) {
									if( $item['font_style']['value'] == $current_var ) {
										$font_families[$item['font_style']['value']] = $item['upload_font']['title'];
										$font_faces_html .= "@font-face { 
										      font-family: '{$item['upload_font']['title']}'; 
										      src: url('{$item['upload_font']['url']}');
										    } ";
									}
								}
								$font_faces_html .= "</style>";
								echo $font_faces_html;

								$font_family = isset( $font_families[$current_var] ) ?  "style=\"font-family: '{$font_families[$current_var]}'\"" : '';
							///////////////////////////////////////////////////////////////////////////////
							}

						?>

						<?php if ( ! $cat_in_cart ) { ?>
							<div class="font-title" <?php echo $font_family ?>>
								<?php
									if ( ! $product_permalink ) {
										echo wp_kses_post( $product_name . '&nbsp;' );
									} else {
										/**
										 * This filter is documented above.
										 *
										 * @since 2.1.0
										 */
										echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a %s href="%s">%s&nbsp;</a>', $font_family, esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
									}

									do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );
								?>
							</div>
						<?php } else { ?>
							<div class="font-title">
								<?php
									if ( ! $product_permalink ) {
										echo wp_kses_post( $product_name . '&nbsp;' );
									} else {
										/**
										 * This filter is documented above.
										 *
										 * @since 2.1.0
										 */
										echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
									}

									do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );
								?>
							</div>
						<?php } ?>
						<div class="font-lisence">
							<?php

							// Meta data.
							echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

							?>
						</div>
						<div class="font-price">
							<?php
								echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
							?>
							<div class="font-remove">
								<span class="font-remove-inner">
									<?php
										echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
											'woocommerce_cart_item_remove_link',
											sprintf(
												'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">'. drizy_svg('remove-icon') .'</a>',
												esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
												/* translators: %s is the product name */
												esc_attr( sprintf( __( 'Remove %s from cart', 'woocommerce' ), wp_strip_all_tags( $product_name ) ) ),
												esc_attr( $product_id ),
												esc_attr( $_product->get_sku() )
											),
											$cart_item_key
										);
									?>
								</span>
							</div>
						</div>
					</div>
					<?php
				}

			}

		?>



		<?php do_action( 'woocommerce_cart_contents' ); ?>
	</div>
	<?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>

<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

<div class="cart-collaterals drizy-cart-collaterals">
	<?php
		/**
		 * Cart collaterals hook.
		 *
		 * @hooked woocommerce_cross_sell_display
		 * @hooked woocommerce_cart_totals - 10
		 */
		do_action( 'woocommerce_cart_collaterals' );
	?>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>