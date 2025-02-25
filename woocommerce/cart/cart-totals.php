<?php
/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.3.6
 */

defined( 'ABSPATH' ) || exit;

?>

<div class="cart_totals_left"></div>

<div class="cart_totals_middle"></div>

<div class="cart_totals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">

	<?php do_action( 'woocommerce_before_cart_totals' ); ?>

	<div class="cart_totals_inner">
		<div class="cart-subtotal">
			<div class="total-title"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></div>
			<div class="subtotal"><?php wc_cart_totals_subtotal_html(); ?></div>
		</div>

		<?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

		<div class="order-total">
			<div class="total-title"><?php esc_html_e( 'Total', 'woocommerce' ); ?></div>
			<div class="total">
				<?php wc_cart_totals_order_total_html(); ?>
				<div class="wc-proceed-to-checkout">
					<div class="button-effect">
						<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>
