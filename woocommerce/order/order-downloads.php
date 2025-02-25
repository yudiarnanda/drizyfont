<?php
/**
 * Order Downloads.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-downloads.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="woocommerce-order-downloads">
	<?php if ( isset( $show_title ) ) : ?>
		<h2 class="woocommerce-order-downloads__title"><?php esc_html_e( 'Downloads', 'woocommerce' ); ?></h2>
	<?php endif; ?>

	<table class="woocommerce-table woocommerce-table--order-downloads shop_table shop_table_responsive order_details">
		<thead>
			<tr>
				<th class="download-product">
					<span class="nobr"><?php _e( 'Product', 'drizy' ); ?></span>
				</th>
				<th class="download-licensing">
					<span class="nobr"><?php _e( 'Licensing', 'drizy' ); ?></span>
				</th>
				<th class="download-expires">
					<span class="nobr"><?php _e( 'Expires', 'drizy' ); ?></span>
				</th>
				<th class="download-file">
					<span class="nobr"><?php _e( 'Download', 'drizy' ); ?></span>
				</th>
			</tr>
		</thead>

		<tbody>

			<?php foreach ( $downloads as $download ) : 

				$product_id = $download['product_id'];
				$product = wc_get_product($product_id);

				$font_styles = 'pa_font-styles';
				$font_licenses = 'pa_font-licenses';

				if ( $term_names = $product->get_attribute( $font_styles ) ) {
					$stylename =  '&nbsp;'.$term_names;
				}

				if ( $term_names = $product->get_attribute( $font_licenses ) ) {
					$licensename = $term_names;
				}

			?>

			<tr>
				<td class="download-product">
					<?php
						if ( $download['product_url'] ) {
							echo '' . esc_html( $download['product_name'] ).''.$stylename. '';
						} else {
							echo esc_html( $download['product_name'] );
						}
					?>
				</td>
				<td class="download-licensing"><?php echo $licensename; ?></td>
				<td class="download-expires">
					<?php 
						if ( ! empty( $download['access_expires'] ) ) {
							echo '<time datetime="' . esc_attr( date( 'Y-m-d', strtotime( $download['access_expires'] ) ) ) . '" title="' . esc_attr( strtotime( $download['access_expires'] ) ) . '">' . esc_html( date_i18n( get_option( 'date_format' ), strtotime( $download['access_expires'] ) ) ) . '</time>';
						} else {
							esc_html_e( 'Never', 'woocommerce' );
						}
					?>
				</td>
				<td class="download-file">
					<div class="button-effect"><a href="<?php echo esc_url( $download['download_url'] ); ?>" class="woocommerce-MyAccount-downloads-file button alt"><span><?php _e( 'Download', 'drizy' ); ?></span></a></div>
				</td>
			</tr>

			<?php endforeach; ?>

		</tbody>

	</table>
</section>
