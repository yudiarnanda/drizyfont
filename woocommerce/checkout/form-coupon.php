<?php
/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

if ( ! wc_coupons_enabled() ) { // @codingStandardsIgnoreLine.
	return;
}

?>

<div class="drizy-checkout-coupon">

	<form class="checkout_coupon woocommerce-form-coupon" method="post">

		<div class="checkout-coupon-inner">
			<span class="coupon-icon"><?php echo drizy_svg('coupon'); ?></span>
			<input type="text" name="coupon_code" class="input-text" placeholder="<?php esc_attr_e( 'Enter the Promo code', 'woocommerce' ); ?>" id="coupon_code" value="" />
			<button type="submit" class="button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="apply_coupon" value="<?php esc_attr_e( 'Apply', 'woocommerce' ); ?>"><?php esc_html_e( 'Apply', 'woocommerce' ); ?></button>
		</div>


	</form>

	<div class="drizy-edit-cart">
		<a href="<?php echo get_permalink( get_page_by_path( 'cart' ) ) ?>" class="button">
			<span class="edit-cart-coupon"><?php echo drizy_svg('edit_cart'); ?></span>
			<span><?php esc_html_e( 'Edit Cart', 'woocommerce' ); ?></span>
		</a>
	</div>

</div>
