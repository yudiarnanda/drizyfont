<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="drizy-review-order-content woocommerce-checkout-review-order-table">
	<?php
		do_action( 'woocommerce_review_order_before_cart_contents' );

		$cat_in_cart = false;

		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			// If Cart has category "membership", set $cat_in_cart to true
			if ( has_term( 'membership', 'product_cat', $cart_item['product_id'] ) ) {
		 		$cat_in_cart = true;
			 	//break;
			}

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

		?>

				<div class="review-order-content">

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
						    $font_faces_html .= "@font-face { font-family: '{$item['upload_font']['title']}'; src: url('{$item['upload_font']['url']}'); } ";
						  }
						}
						$font_faces_html .= "</style>";
						echo $font_faces_html;

						$font_family = isset( $font_families[$current_var] ) ?  "style=\"font-family: '{$font_families[$current_var]}'\"" : '';
						///////////////////////////////////////////////////////////////////////////////
					}

					?>

					<div class="product-name">
						<?php if ( ! $cat_in_cart ) { ?>
							<span <?php echo $font_family; ?>>
						<?php } else { ?>
							<span>
						<?php } ?>
							<?php echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) ) . '&nbsp;'; ?>
						</span>
						<?php echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>

					<div class="product-price">
						<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>

				</div>

			<?php
			}
		}

		do_action( 'woocommerce_review_order_after_cart_contents' );
	?>

	<div class="review-order-content mgt-60">
		<div class="product-subtotal-label"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></div>
		<div class="product-subtotal"><?php wc_cart_totals_subtotal_html(); ?></div>
	</div>

	<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
	<div class="review-order-content">
		<div class="product-coupon-label"><?php wc_cart_totals_coupon_label( $coupon ); ?></div>
		<div class="product-coupon"><?php wc_cart_totals_coupon_html( $coupon ); ?></div>
	</div>
	<?php endforeach; ?>

	<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

	<div class="review-order-content">
		<div class="product-total-label"><?php esc_html_e( 'Total', 'woocommerce' ); ?></div>
		<div class="product-total"><?php wc_cart_totals_order_total_html(); ?></div>
	</div>

	<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

</div>
