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

$current_user_id = get_current_user_id();
$maindata = array();
$available_variations = $product->get_available_variations();

if(!empty($available_variations)) {
	$preMinValue = array();
	foreach($available_variations as $key=>$val) {

		// Style
		if(isset($val['attributes']['attribute_pa_font-styles'])){
			$styleName = isset($val['attributes']['attribute_pa_font-styles']) ? $val['attributes']['attribute_pa_font-styles'] : '';
		}

		// License
		if(isset($val['attributes']['attribute_pa_font-licenses'])){
			$licenseName = isset($val['attributes']['attribute_pa_font-licenses']) ? $val['attributes']['attribute_pa_font-licenses'] : '';
		}

		// Price
		$preMinValue[] = $val['display_regular_price'];										
		
		$maindata[$styleName][$licenseName] = array(
			'variation_id' => $val['variation_id'],
			'price_html' => $val['price_html'],
			'display_regular_price' => $val['display_price'],
		);
	}		
}

$priceArray = array();
foreach($maindata as $key=>$val) : 
	$minPrice = array();
	foreach($val as $k=>$v) :
		$minPrice[] = $v['display_regular_price'];
	endforeach; 
	
	$priceArray[$key] = min($minPrice);
endforeach;

// Font Tester
$font_preview = get_field( 'field_66937a8963cd2' ); //field_66937b2763cd4 
$font_styles = array_keys( $maindata );
$font_families = [];
$font_faces_html = "<style type=\"text/css\">";
foreach( $font_preview['font_preview'] as $item ) {
  if( in_array( $item['font_style']['value'], $font_styles ) ) {
    $font_families[$item['font_style']['value']] = $item['upload_font']['title'];
    $url = $item['upload_font']['url'];
    $encodeurl = fontEncodeURL($url);
    $font_faces_html .= "@font-face { 
          font-family: '{$item['upload_font']['title']}'; 
          src: url('$encodeurl') format('woff');
        } ";
  }
}
$font_faces_html .= "</style>";
echo $font_faces_html;

// Variable Font
if( have_rows('variabel_font_settings') ):
	while( have_rows('variabel_font_settings') ): the_row();
		$vr_sample_text = get_sub_field('vr_sample_text');
		if( have_rows('variable_font_preview') ): ?>
			<style type="text/css">
				<?php while( have_rows('variable_font_preview') ): the_row();
					$file_v = get_sub_field('upload_vr_font');
					$url_v = $file_v['url'];
					$title_v = $file_v['title'];
					$id_v = $file_v['id']; ?>
					@font-face { 
						font-family: 'font_<?php echo esc_attr($id_v); ?>'; 
						src: url('<?php echo fontEncodeURL($url_v); ?>') format('woff2-variations'); 
						font-stretch: 75% 100%;
						font-style: oblique 0deg 12deg;
						font-weight: 100 900;
					}

				<?php endwhile; ?>
			</style>
		<?php 
		endif;
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
								<?php if ( $product->is_on_sale() ) : ?>
									<div class="button-effect onsale">
									    <?php echo apply_filters( 'woocommerce_sale_flash', '<a class="product-onsale elementor-button"><span>' . __( 'Sale!', 'woocommerce' ) . '</span></a>', $post, $product ); ?>

									</div>
									<?php
								endif; ?>
								<div class="single-product-meta desktop">
									<?php if ( have_rows( 'font_preview_settings' ) ) : ?>
										<?php while ( have_rows( 'font_preview_settings' ) ) : the_row(); 
											$count = count(get_sub_field('font_preview')); ?>
											<?php if( have_rows('font_preview') ): ?>
												<div class="category-font-style-count">
													<?php echo $count; _e( ' Font Styles', 'drizy' ); ?>
												</div>
											<?php endif; ?>
										<?php endwhile; ?>
									<?php endif; ?>
									<?php if ( have_rows( 'variabel_font_settings' ) ) : ?>
										<?php while ( have_rows( 'variabel_font_settings' ) ) : the_row(); ?>
											<?php if ( get_sub_field( 'enable_variable_font' ) == 1 ) : ?>
												<div class="category-font-variable">
													<?php _e( 'Variable Font', 'drizy' ); ?>
												</div>
											<?php endif; ?>
										<?php endwhile; ?>
									<?php endif; ?>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="single-product-meta mobile">
									<?php if ( have_rows( 'font_preview_settings' ) ) : ?>
										<?php while ( have_rows( 'font_preview_settings' ) ) : the_row(); 
											$count = count(get_sub_field('font_preview')); ?>
											<?php if( have_rows('font_preview') ): ?>
												<div class="category-font-style-count">
													<?php echo $count; _e( ' Font Styles', 'drizy' ); ?>
												</div>
											<?php endif; ?>
										<?php endwhile; ?>
									<?php endif; ?>
									<?php if ( have_rows( 'variabel_font_settings' ) ) : ?>
										<?php while ( have_rows( 'variabel_font_settings' ) ) : the_row(); ?>
											<?php if ( get_sub_field( 'enable_variable_font' ) == 1 ) : ?>
												<div class="category-font-variable">
													<?php _e( 'Variable Font', 'drizy' ); ?>
												</div>
											<?php endif; ?>
										<?php endwhile; ?>
									<?php endif; ?>
								</div>
								<div class="buying-options-inner">
							    <div class="product-link">
								    <?php if (yith_wcmbs_user_has_membership($current_user_id)) :
								    	$hash_text = $current_user_id . $post->ID;
											$hash = substr( hash( 'sha256', $hash_text ), 0, 16 );
											$zipped_link = add_query_arg( array( 'file_zip' => $hash, 'id' => $post->ID ), home_url( '/' ) );
											?>
											<a href="<?php echo $zipped_link; ?>" class="member-download button elementor-button">
												<span class="button-text"><?php _e( 'Download', 'drizy' ); ?></span>
												<span class="button-icon"><?php echo drizy_svg('chevron-right'); ?></span>
											</a>
								    	<!-- Member -->
											<?php
											/*
												foreach ($available_variations as $variation) {
													if( $variation['attributes']['attribute_pa_font-styles'] == 'family-package' && $variation['attributes']['attribute_pa_font-licenses'] == 'personal' ) {
														$family_variation_id = $variation['variation_id'];
														$variation_product = wc_get_product($family_variation_id);
														if ($variation_product->is_downloadable()) {
															$download_files = $variation_product->get_downloads();
															foreach ($download_files as $file) {
																$file_id = $file['id'];
																$file_name = $file['name'];
														?>

											    	<a href="https://drizyfont.com/?protected_file=<?php echo $file_id; ?>&product_id=<?php echo $post->ID; ?>" class="member-download button elementor-button">
															<span class="button-text"><?php _e( 'Download', 'drizy' ); ?></span>
															<span class="button-icon"><?php echo drizy_svg('chevron-right'); ?></span>
														</a>

															<?php }
														}
														break;
													}
												}
												*/
											?>
											<!-- Member -->
											<?php else : ?>
								    	<!-- Not Member -->
											<a href="#buying-options" class="buying-options button elementor-button">
												<span class="button-text"><?php _e( 'Buy Font', 'drizy' ); ?></span>
												<span class="button-icon"><?php echo drizy_svg('chevron-right'); ?></span>
											</a>
											<!-- Not Member -->
											<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="product-slide">
						<div class="single-product-slider">
							<?php 
								$attachment_ids = $product->get_gallery_image_ids();
								$image = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id ), 'thumbnail' );
							?>

							<div class="image-slide">
								<img src="<?php echo $image[0]; ?>">
							</div>

					    	<?php foreach( $attachment_ids as $attachment_id ) { ?>
								<div class="image-slide">
									<?php
										$image_url = wp_get_attachment_image_src( $attachment_id, 'thumbnail', true );
										$image = $image_url[0];
									?>
									<img src="<?php echo $image;?>" alt="<?php the_title(); ?>">
								</div>
							<?php } ?>

						</div>
						<div class="product-slider-control">
							<span class="prev"><?php echo drizy_svg('prev-arrow'); ?></span>
							<span class="dots"></span>
							<span class="next"><?php echo drizy_svg('next-arrow'); ?></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Product Header -->

	<!-- Start Product Content -->
	<div class="single-product-content">
		<div class="single-product-tabs">

			<div class="container">
				<div class="row">
					<div class="col-sm-12">

						<div class="single-tabs-nav">
							<ul id="single-tabs-nav">
								<li><a href="#font-styles"><?php _e( 'Styles', 'drizy' ); ?></a></li>
								<li><a href="#font-glyphs"><?php _e( 'Glyphs', 'drizy' ); ?></a></li>
								<li><a href="#font-description"><?php _e( 'Description', 'drizy' ); ?></a></li>
								<li><a href="#font-licensing"><?php _e( 'Licensing', 'drizy' ); ?></a></li>
							</ul> <!-- END single-tabs-nav -->
						</div>

						<div id="single-tabs-content">
							<div id="font-styles" class="single-tab-content">
								<?php if ($product->is_type( 'variable' )) : ?>
									<div class="font-container">

										<?php if ( have_rows( 'variabel_font_settings' ) ) :
											while ( have_rows( 'variabel_font_settings' ) ) : the_row(); 
												if( have_rows('variable_font_preview') ): 
													while( have_rows('variable_font_preview') ): the_row();  
														$prepareID = rand(100,99999).date('s'); 
														$file_v = get_sub_field('upload_vr_font');
														$title_v = $file_v['title'];
														$id_v = $file_v['id'];

														?>

															<div class="font-row variable-font">
																<div class="font-wrapper">
																	<div class="font-preview-toolbar">
																		<div class="font-weight-name"><h6><?php _e( 'Variable Axes', 'drizy' ); ?></h6></div>
																		<div class="font-preview-control">

																			<!-- Font Size Control -->
																			<div class="font-size">
																				<div class="label"><?php _e( 'Font Size', 'drizy' ); ?></div>
																				<input type="range" data-id="<?php echo $prepareID; ?>" id="slider-<?php echo $prepareID; ?>-size" min="0" max="180" value="80" class="slider variable_slider" oninput="this.nextElementSibling.value = this.value">
																				<output class="font-size-number">80</output>
																			</div>

																			<!-- Letter Spacing Control -->
																			<div class="font-spacing">
																				<div class="label"><?php _e( 'Letter Spacing', 'drizy' ); ?></div>
																				<input type="range" data-id="<?php echo $prepareID; ?>" id="slider-<?php echo $prepareID; ?>-spacing" min="-2" max="8" value="0" step="0.1" class="slider variable_slider" oninput="this.nextElementSibling.value = this.value">
																				<output class="font-size-number">0</output>
																			</div>

																			<!-- Line Height Control -->
																			<div class="font-leading">
																				<div class="label"><?php _e( 'Line Height', 'drizy' ); ?></div>
																				<input type="range" data-id="<?php echo $prepareID; ?>" id="slider-<?php echo $prepareID; ?>-height" min="80" max="200" value="80" class="slider variable_slider" oninput="this.nextElementSibling.value = this.value">
																				<output class="font-size-number">80</output>
																			</div>

																			<?php $value = get_sub_field('properties_vr_font'); ?>

																			<?php if(in_array('italic', $value)) { 
																				$italic_min = get_sub_field('font_italic_min');
																	  			$italic_max = get_sub_field('font_italic_max');
																	  		?>
																			<!-- Italic Controls -->
																			<div class="font-italic">
																				<div class="label"><?php _e( 'Italic', 'drizy' ); ?></div>
																				<input type="range" data-id="<?php echo $prepareID; ?>" id="slider-<?php echo $prepareID; ?>-italic" min="<?php echo $italic_min; ?>" max="<?php echo $italic_max; ?>" value="0" class="slider variable_slider" id="text-italic" name="text-italic" data-index="1" oninput="this.nextElementSibling.value = this.value">
																				<output class="font-size-number">0</output>
																			</div>

																			<!-- Weight Controls -->
																			<?php } if ( in_array( 'weight', $value )) { 
																				$weight_min = get_sub_field('font_weight_min');
																				$weight_max = get_sub_field('font_weight_max');
																	  		?>
																			<div class="font-weight">
																				<div class="label"><?php _e( 'Weight', 'drizy' ); ?></div>
																				<input type="range" data-id="<?php echo $prepareID; ?>" id="slider-<?php echo $prepareID; ?>-weight" min="<?php echo $weight_min; ?>" max="<?php echo $weight_max; ?>" value="0" class="slider variable_slider" id="text-weight" name="text-weight" data-index="0" oninput="this.nextElementSibling.value = this.value">
																				<output class="font-size-number"><?php echo $weight_min; ?></output>
																			</div>

																			<?php } if (in_array('width', $value)) { 
																    		$width_min = get_sub_field('font_width_min');
																  			$width_max = get_sub_field('font_width_max');
																  		?>

																	    	<!-- Width Controls -->
																			<div class="font-width">
																				<div class="label"><?php _e( 'Width', 'drizy' ); ?></div>
																				<input type="range" data-id="<?php echo $prepareID; ?>" id="slider-<?php echo $prepareID; ?>-width" min="<?php echo $width_min; ?>" max="<?php echo $width_max; ?>" value="<?php echo $width_min; ?>" class="slider variable_slider" id="text-width" name="text-width" data-index="1" oninput="this.nextElementSibling.value = this.value">
																				<output class="font-size-number">0</output>
																			</div>

																			<?php } if(in_array('opt_size', $value)) { 
																				$opt_size_min = get_sub_field('font_optical_size_min');
																  			$opt_size_max = get_sub_field('font_optical_size_max');
																			?>

																			<!-- Optical Size Controls -->
																			<div class="font-optical-size">
																				<div class="label"><?php _e( 'Optical Size', 'drizy' ); ?></div>
																				<input type="range" data-id="<?php echo $prepareID; ?>" id="slider-<?php echo $prepareID; ?>-optsize" min="<?php echo $opt_size_min; ?>" max="<?php echo $opt_size_max; ?>" value="0" class="slider variable_slider" id="text-opt_size" name="text-opt_size" data-index="1" oninput="this.nextElementSibling.value = this.value">
																				<output class="font-size-number">0</output>
																			</div>

																			<?php } if(in_array('serif', $value)) { 
																				$serif_min = get_sub_field('font_serif_min');
																	  		$serif_max = get_sub_field('font_serif_max');
																			?>
																			<!-- Serif Controls -->
																			<div class="font-serif">
																				<div class="label"><?php _e( 'Serif', 'drizy' ); ?></div>
																				<input type="range" data-id="<?php echo $prepareID; ?>" id="slider-<?php echo $prepareID; ?>-serif" min="<?php echo $serif_min; ?>" max="<?php echo $serif_max; ?>" value="0" class="slider variable_slider" id="text-serif" name="text-serif" data-index="0" oninput="this.nextElementSibling.value = this.value">
																				<output class="font-size-number"><?php echo $serif_min; ?></output>
																			</div>

																			<?php } if(in_array('slant', $value)) { 
																				$slant_min = get_sub_field('font_slant_min');
																	  		$slant_max = get_sub_field('font_slant_max');
																			?>
																			<!-- Slant Controls -->
																			<div class="font-slant">
																				<div class="label"><?php _e( 'Slant', 'drizy' ); ?></div>
																				<input type="range" data-id="<?php echo $prepareID; ?>" id="slider-<?php echo $prepareID; ?>-slant" min="<?php echo $slant_min; ?>" max="<?php echo $slant_max; ?>" value="0" class="slider variable_slider" id="text-slant" name="text-slant" data-index="0" oninput="this.nextElementSibling.value = this.value">
																				<output class="font-size-number"><?php echo $slant_min; ?></output>
																			</div>

																			<?php } ?>

																			<!-- Align Ccontrol -->
																			<div class="font-align">
																				<span data-font="font_<?php echo esc_attr($id_v)?>" class="align-left align-left-<?php echo $prepareID; ?> current" onclick="set_aliment(<?php echo $prepareID; ?>,'left')">
																					<?php echo drizy_svg('align-left'); ?>
																				</span>
																				<span data-font="font_<?php echo esc_attr($id_v)?>" class="align-center align-center-<?php echo $prepareID; ?> " onclick="set_aliment(<?php echo $prepareID; ?>,'center')">
																					<?php echo drizy_svg('align-center'); ?>
																				</span>
																				<span data-font="font_<?php echo esc_attr($id_v)?>" class="align-right align-right-<?php echo $prepareID; ?> " onclick="set_aliment(<?php echo $prepareID; ?>,'right')">
																					<?php echo drizy_svg('align-right'); ?>
																				</span>
																			</div>

																		</div>
																	</div>
																	<div class="font-preview-name">
																		<div class="font-weight-name-field" id="content-<?php echo $prepareID; ?>" contenteditable="true" spellcheck="false" style="font-family: 'font_<?php echo esc_attr($id_v); ?>'; font-size: 80px; line-height: 80px; white-space: normal; text-align: left; letter-spacing: 0; font-variation-settings: 'wght' 100, 'wdth' 0, 'ital' 0, 'opsz' 0, 'SRIF' 0, 'slnt' 0;">
																		<div class="target">
																			<?php if ( $vr_sample_text) { ?>
																				<?php echo esc_attr($vr_sample_text); ?>
																			<?php } ?>
																		</div>
																		</div>
																	</div>
																</div>
															</div>

											<?php 
													endwhile; 
												endif;
											endwhile;
										endif; ?>

										<?php 

										if(!empty($maindata)) :
										$no = 1;
										foreach($maindata as $key=>$val) :
											if( $key == 'family-package' )
												continue;
											
											$font_styles = get_term_by( 'slug', $key, 'pa_font-styles');

											if ($font_styles) {
												$stylename = !is_wp_error($font_styles) ? $font_styles->name : $key;
												$stylslug = !is_wp_error($font_styles) ? $font_styles->slug : $key;
											}

											$font_name = $font_families[$stylslug]; ?>
											<div class="font-row <?php echo $stylslug ?>">
												<div class="font-wrapper">
													<div class="font-preview-toolbar">
														<div class="font-weight-name"><h6><?php echo $stylename; ?></h6></div>
														<div class="font-preview-control">
															<div class="font-size">
																<div class="label"><?php _e( 'Font Size', 'drizy' ); ?></div>
																<input type="range"  id="text-size-<?php echo $no; ?>" min="10" max="180" value="80" class="slider custom_slider" id="text-size" name="text-size" data-index="1"  data-id="<?php echo $no; ?>" data-font="<?php echo $font_name; ?>"  data-type-para="line-height" oninput="this.nextElementSibling.value = this.value">
																<output class="font-size-number">80</output>
															</div>
															<div class="font-spacing">
																<div class="label"><?php _e( 'Letter Spacing', 'drizy' ); ?></div>
																<input type="range" id="text-spacing-<?php echo $no; ?>" min="-2" max="8" value="0" step="0.1" class="slider custom_slider" id="text-spacing" name="text-spacing" data-index="0"  data-id="<?php echo $no; ?>" data-font="<?php echo $font_name; ?>" oninput="this.nextElementSibling.value = this.value">
																<output class="font-size-number">0</output>
															</div>
															<div class="font-leading">
																<div class="label"><?php _e( 'Line Height', 'drizy' ); ?></div>
																<input type="range" id="text-height-<?php echo $no; ?>" min="100" max="200" value="80" class="slider custom_slider" id="text-height" name="text-height" data-index="0"  data-id="<?php echo $no; ?>" data-font="<?php echo $font_name; ?>"  data-type-para="font-size" oninput="this.nextElementSibling.value = this.value">
																<output class="font-size-number">80</output>
															</div>
														</div>
													</div>
													<div class="font-preview-name">
														<div class="font-weight-name-field" id="text-output-<?php echo $no; ?>" contenteditable="true" spellcheck="false" style="font-family: '<?php echo $font_name; ?>'; line-height: 80px; font-size: 80px; letter-spacing: 0px;">
															<div class="target"><?php echo $stylename; ?></div>
														</div>
													</div>
												</div>
											</div>

										<?php $no++; endforeach; endif; ?>

									</div>

								<?php endif; ?>
							</div>
							<div id="font-glyphs" class="single-tab-content">

								<?php if ( have_rows( 'font_preview_settings' ) ) : ?>
									<?php while ( have_rows( 'font_preview_settings' ) ) : the_row(); ?>
										<div class="font-glyphs-head">
											<h6><?php _e( 'Standard Ligatures ', 'drizy' ); ?></h6>
											<?php if ( have_rows( 'font_preview' ) ) : ?>
												<select class="font-glyphs-style-list drizy-custom-select" id="glyph-font-style">
													<?php while ( have_rows( 'font_preview' ) ) : the_row(); 
														$glyph_font_style = get_sub_field( 'font_style' ); ?>
													<option value="<?php echo esc_html( $glyph_font_style['value'] ); ?>"><?php echo esc_html( $glyph_font_style['label'] ); ?></option>
													<?php endwhile; ?>
												</select>
											<?php endif; ?>
										</div>
										<?php if ( have_rows( 'font_preview' ) ) : ?>
											<div class="font-glyphs-text">
												<?php while ( have_rows( 'font_preview' ) ) : the_row(); 
													$glyph_font_style = get_sub_field( 'font_style' ); 
													$file_glyph = get_sub_field('upload_font');
		                                            $title_glyph = $file_glyph['title'];
		                                            $id_glyph = $file_glyph['id']; ?>
														<div class="font-glyphs-list <?php echo esc_html( $glyph_font_style['value'] ); ?>" style="font-family: 'font_<?php echo esc_attr($id_glyph); ?>';">
															<?php echo $glyph_sample_text; ?>
														</div>
												<?php endwhile; ?>
											</div>
											<div class="font-glyphs-content">
												<?php while ( have_rows( 'font_preview' ) ) : the_row(); 
													$glyph_font_style = get_sub_field( 'font_style' ); 
				                                    $upload_font = get_sub_field( 'upload_font' );
				                                    $title = $upload_font['filename'];
				                                    $url = $upload_font['url']; 
				                                    $upload_dir = wp_upload_dir(); ?>
													<div class="font-glyphs-list <?php echo esc_html( $glyph_font_style['value'] ); ?>">
														<?php echo do_shortcode('[glyphview font="' . $title . '" path="' . $upload_dir['baseurl'] . '/drizy-fonts-preview/"]'); ?>
													</div>
												<?php endwhile; ?>
											</div>
										<?php endif; ?>
									<?php endwhile; ?>
								<?php endif; ?>
							</div>
							<div id="font-description" class="single-tab-content">
								<div class="row">
									<div class="col-sm-8">
										<h3 class="description-title"><?php _e( 'About ', 'drizy' ); ?><?php the_title(); ?></h3>
										<div class="description-content">
											<?php the_content(); ?>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="description-meta">
											<div class="meta-title">
												<h1><?php _e( 'Get this font', 'drizy' ); ?></h1>
											</div>
											<div class="meta-include">
												<h4><?php _e( 'What\'s included', 'drizy' ); ?></h4>
												<div class="meta-include-wrap">
													<div class="meta-include-glyph">
														<div class="meta-number"><?php printf(__( '%s', 'drizy' ), count($font_families)); ?></div>
														<h6><?php _e( 'font Glyphs', 'drizy' ); ?></h6>
													</div>
													<div class="meta-include-font">
														<div class="meta-number"><?php printf(__( '%s', 'drizy' ), count($font_families)); ?></div>
														<h6><?php _e( 'font Styles', 'drizy' ); ?></h6>
													</div>
												</div>
											</div>
										</div>
										<div class="description-meta credits-details">
											<div class="meta-include">
												<h4><?php _e( 'Credits & Details', 'drizy' ); ?></h4>
												<div class="meta-include-wrap">
													<div class="meta-category">
														<h6><?php _e( 'Category:', 'drizy' ); ?>
															<?php
																$taxonomy = 'product_cat'; // change this to your taxonomy
																$terms = wp_get_post_terms( $post->ID, $taxonomy, array( "fields" => "ids" ) );
																if( $terms ) {

																$terms = trim( implode( ',', (array) $terms ), ' ,' );
																wp_list_categories( 'title_li=&style=none&separator=&taxonomy=' . $taxonomy . '&include=' . $terms );

																}
															?>
														</h6>
													</div>
													<div class="meta-date">
														<h6><?php _e( 'Release Date: ', 'drizy' ); ?><?php echo get_the_date( get_option('date_format') ); ?></h6>
													</div>
													<div class="meta-format">
														<h6><?php _e( 'Available Format(s): ', 'drizy' ); ?>
														<?php $format_labels = get_field( 'format' ); ?>
														<?php if ( $format_labels ) : ?>
															<?php foreach ( $format_labels as $format_label ) : ?>
															 	<?php echo esc_html( $format_label ); ?>
															<?php endforeach; ?>
														<?php endif; ?>
														</h6>
													</div>
												</div>
											</div>
										</div>
										<div class="product-author mgt-90">
											<div class="product-author-info">
												<span>
												<?php

													$user_id = get_the_author_meta('ID');
													$user_acf_prefix = 'user_';
													$user_id_prefixed = $user_acf_prefix . $user_id;
													$url = get_author_posts_url(get_the_author_meta('ID'));

													?>

													<?php if ( get_field( 'contributor_avatar', $user_id_prefixed ) ) : ?>
															<a href="<?php echo $url; ?>">
																<img src="<?php the_field( 'contributor_avatar', $user_id_prefixed ); ?>" />
															</a>
													<?php endif ?>
												</span>
												<h6>
													<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author">
														<?php _e( 'By ', 'drizy' ); ?><strong><?php echo get_the_author_meta('display_name', get_the_author_meta( 'ID' ) ); ?></strong>
													</a>
												</h6>
											</div>
										</div>
										<div class="product-share mgt-40">
											<span class="share-label"><?php _e( 'Share: ', 'drizy' ); ?></span>
											<?php echo do_shortcode('[social_share]'); ?>
										</div>
									</div>
								</div>
								<?php //echo do_shortcode('[elementor-template id="2043"]'); ?>
							</div>
							<div id="font-licensing" class="single-tab-content">
								<?php echo do_shortcode('[elementor-template id="2064"]'); ?>
							</div>
						</div> <!-- END single-tabs-content -->
					</div>
				</div>
			</div>

		</div> <!-- END tabs -->
	</div>
	<!-- End Product Content -->

	<?php // Check if the current user has an active subscription using YITH Subscription ?>
	<?php if (yith_wcmbs_user_has_membership($current_user_id)) : ?>
		<!-- Start Member Test -->
		<div class="member-test" style="padding:100px 40px; display: none;">

			<div class="pdf-download">
				<?php echo do_shortcode ('[membership_protected_links]'); ?>
			</div>
			
			<?php
				foreach ($available_variations as $variation) {
					if( $variation['attributes']['attribute_pa_font-styles'] == 'family-package' && $variation['attributes']['attribute_pa_font-licenses'] == 'personal' ) {
						$family_variation_id = $variation['variation_id'];
						$variation_product = wc_get_product($family_variation_id);
						if ($variation_product->is_downloadable()) {
							$download_files = $variation_product->get_downloads();
							foreach ($download_files as $file) {
								$file_id = $file['id'];
								$file_name = $file['name'];
								echo "<a href=\"https://drizyfont.com/?protected_file={$file_id}&product_id={$post->ID}\"  class=\"yith-wcmbs-download-button download unlocked\">
												<span class=\"yith-wcmbs-download-button__name\">{$file_name}</span>
											</a>";
							}
						}
						break;
					}
				}
			?>
		</div>
		<!-- End Member Test -->
	
	<?php else : ?>
		<!-- Start Buying Options -->
		<?php if ($product->is_type( 'variable' )) : ?>
		<div class="single-buying-options" id="buying-options">
			<div class="buying-options-title">
				<div class="container">
					<div class="row">
						<div class="col-sm-12">
							<h3><?php _e( 'Buying Options', 'drizy' ); ?></h3>		
						</div>
					</div>
				</div>
			</div>
			<div class="buying-options-content">
				<div class="container">
					<div class="row">
						<div class="col-sm-12">
							<div class="buying-options-wrap">
								<div class="buying-options-container">

									<?php foreach ($available_variations as $variation) { 
											if( $variation['attributes']['attribute_pa_font-styles'] == 'family-package' ) { ?>
													<div class="buying-option-head">
														<ul class="buying-options-tabs">
															<li><a href="#family"><?php _e( 'Family package', 'drizy' ); ?></a></li>
															<li><a href="#individual"><?php _e( 'Individual purchase', 'drizy' ); ?></a></li>
														</ul>
													</div>
											<?php	
											break;
											}
										}
									?>

									<div class="buying-options-tab-container">
										<?php foreach ($available_variations as $variation) { 
											if( $variation['attributes']['attribute_pa_font-styles'] == 'family-package' ) { ?>
												<!-- family -->
												<div id="family" class="buying-options-tab-content">
													<div class="row">
														<div class="col-sm-6">
															<div class="font-family-style-lists">
																<div class="font-family-head">
																	<div class="font-family-title">
																		<?php echo $family_pkg_title = sprintf(__( '%s - Family Package', 'drizy' ), get_the_title()); ?>
																	</div>
																	<div class="font-family-count">
																		<span><?php printf(__( '%s Fonts', 'drizy' ), count($font_families)); ?></span>
																	</div>
																	<div class="font-family-badge">
																		<?php echo drizy_svg('star'); ?>
																		<span><?php _e( 'Best Value', 'drizy' ); ?></span>
																	</div>
																</div>
																<div class="font-family-style-wrapper">

																	<?php 
																		if(!empty($maindata)) :
																		foreach($maindata as $key=>$val) :
																			if( $key == 'family-package' )
																				continue;

																			$font_styles = get_term_by( 'slug', $key, 'pa_font-styles');

																			if ($font_styles) {
																				$stylename = !is_wp_error($font_styles) ? $font_styles->name : $key;
																				$stylslug = !is_wp_error($font_styles) ? $font_styles->slug : $key;
																			}

																	?>

																	<?php $font_name = $font_families[$stylslug]; ?>
																	<div class="font-family-lists <?php echo $stylslug; ?>" style="font-family: '<?php echo $font_name; ?>';">
																		<div class="font-family-list-name">
																			<?php echo $font_name; ?>
																		</div>
																	</div>

																	<?php endforeach; endif; ?>

																</div>
															</div>
														</div>
														<div class="col-sm-6">
															<div class="font-list-license">
																<div class="tab-content-vertical-family">
																	<div class="license-wrapper">

																	<div class="lisence-list-wrapper">
																		<div class="lisence-list-contact">
																			<div class="contact-text">You can expect a <span>prompt response</span> from us, so there's no need to fear any delays.</div>
																			<a href="<?php echo get_permalink( get_page_by_path( 'contact-us' ) ) ?>" class="button elementor-button">
																				<span class="button-text"><?php _e( 'Contact Us', 'drizy' ); ?></span>
																				<span class="button-icon"><?php echo drizy_svg('contact-icon'); ?></span>
																			</a>
																		</div>
																	</div>

																		<?php if(!empty($maindata['family-package'])) :
																			foreach($maindata['family-package'] as $k=>$v) : 

																			$font_licenses = get_term_by( 'slug', $k, 'pa_font-licenses');

																			if ($font_licenses) {
																				$licensename = !is_wp_error($font_licenses) ? $font_licenses->name : $k;
																				$licencedetails = term_description( $font_licenses->term_id );
																			}

																		?>

																		<div class="lisence-list-wrapper">
																			<div class="lisence-list">
																				<div class="font-license-check">
																					<span class="icon-check"><span></span></span>
																				</div>
																				<div class="font-license-name-wrapper">
																					<div class="font-license-name">
																						<?php echo $licensename; ?>
																					</div>
																					<div class="font-license-name-small">
																						<?php echo $family_pkg_title; ?>
																					</div>
																				</div>
																				<div class="font-license-price">
																					<?php echo $v['price_html']; ?>
																				</div>
																			</div>
																			<div class="lisence-list-description">
																				<div class="font-license-desc-title"><?php _e( 'Font licenses', 'drizy' ); ?></div>
																				<div class="font-license-desc">

																					<?php echo $licencedetails; ?>

																					<div class="contact-us">
																						<span>For uses not written above, higher requirements, or need a different license:</span>
																						<span><a href="<?php echo get_permalink( get_page_by_path( 'contact-us' ) ) ?>">consult</a></span>
																					</div>
																					<div class="add-to-cart">
																						<button class="elementor-button button product_type_variation add_to_cart_button ajax_add_to_cart" data-quantity="1" data-product_id="<?php echo $v['variation_id']; ?>">
																							<div class="button-inner">
																								<span class="button-text"><?php _e( 'Add to Cart', 'drizy' ); ?></span>
																								<span class="button-icon"><?php echo drizy_svg('cart'); ?></span>
																							</div>
																						</button>
																					</div>
																				</div>
																			</div>
																		</div>
																		<?php endforeach; endif; ?>

																		<div class="lisence-list-wrapper">
																			<div class="lisence-list">
																				<div class="font-license-check">
																					<span class="icon-check"><span></span></span>
																				</div>
																				<div class="font-license-name-wrapper">
																					<div class="font-license-name">
																						<?php _e( 'Enterprise', 'drizy' ); ?>
																					</div>
																					<div class="font-license-name-small">
																						<?php echo $family_pkg_title; ?>
																					</div>
																				</div>
																				<div class="font-license-price request-quote">
																					<span class="request-quote"><?php _e( 'Request Quote', 'drizy' ); ?></span>
																				</div>
																			</div>
																			<div class="lisence-list-description request-quote-desc">
																				<div class="font-license-desc-title"><?php _e( 'Font licenses', 'drizy' ); ?></div>
																				<div class="font-license-desc">

																					<?php echo do_shortcode('[enterprise_license]'); ?>

																					<div class="contact-us">
																						<span>For uses not written above, higher requirements, or need a different license:</span>
																						<span><a href="<?php echo get_permalink( get_page_by_path( 'contact-us' ) ) ?>">consult</a></span>
																					</div>

																					<div class="add-to-cart">
																						<a href="<?php echo get_permalink( get_page_by_path( 'contact-us' ) ) ?>" class="elementor-button button" data-quantity="1" data-product_id="<?php //echo $v['variation_id']; ?>">
																							<div class="button-inner">
																								<span class="button-text"><?php _e( 'Request Quote', 'drizy' ); ?></span>
																							</div>
																						</a>
																					</div>
																				</div>
																			</div>
																		</div>

																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<!-- /family -->
											<?php	
												break;
												}
											}
										?>

										<!-- individual -->
										<div id="individual" class="buying-options-tab-content">
											<div class="row">
												<div class="col-sm-6">
													<div class="font-list-style">
														<ul class="buying-options-tabs-vertical">
															<?php 
																if(!empty($maindata)) :
																foreach($maindata as $key=>$val) :
																	if( $key == 'family-package' )
																		continue;

																	$font_styles = get_term_by( 'slug', $key, 'pa_font-styles');

																	if ($font_styles) {
																		$stylename = !is_wp_error($font_styles) ? $font_styles->name : $key;
																		$stylslug = !is_wp_error($font_styles) ? $font_styles->slug : $key;
																	}

															?>

															<li>
																<a href="#<?php echo $stylslug; ?>">
																	<?php $font_name = $font_families[$stylslug]; ?>
																	<div class="font-style">
																		<div class="font-style-name-small">
																			<?php echo $font_name; ?>
																		</div>
																		<div class="font-style-name" style="font-family: '<?php echo $font_name; ?>';">
																			<?php echo $font_name; ?>
																		</div>
																	</div>
																	<span class="icon-check"></span>
																</a>
															</li>

															<?php endforeach; endif; ?>

															<li>
																<div class="font-style-info">
																	<div class="font-perstyle">
																		<span class="font-style-info-label">
																			<?php _e( 'Per style:', 'drizy' ); ?>
																		</span>
																		<span class="font-style-info-price">
																			<?php _e( 'From', 'drizy' ); ?> 
																				<?php if(!empty($maindata)) :
																				foreach($maindata as $key=>$val) :
																					if( $key == 'family-package' )
																						continue; ?>
																						<?php foreach($val as $k=>$v) : ?>
																							<?php echo $v['price_html']; ?>
																						<?php break; endforeach; ?>
																				<?php break; endforeach; endif; ?>
																		</span>
																	</div>
																	<?php foreach ($available_variations as $variation) { 
																		if( $variation['attributes']['attribute_pa_font-styles'] == 'family-package' ) { ?>
																			<div class="font-family-style">
																				<span class="font-style-info-label">
																					<?php _e( 'Family style:', 'drizy' ); ?>
																				</span>
																				<span class="font-style-info-price">
																					<?php _e( 'From', 'drizy' ); ?> 
																						<?php if(!empty($maindata['family-package'])) :
																							foreach($maindata['family-package'] as $k=>$v) : ?>
																								<?php echo $v['price_html']; ?>
																							<?php break; endforeach; 
																						endif; ?>
																				</span>
																			</div>
																		<?php	
																			break;
																			}
																		}
																	?>
																</div>
															</li>

														</ul>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="font-list-license">
														<?php 
															if(!empty($maindata)) :
															foreach($maindata as $key=>$val) :
																if( $key == 'family-package' )
																	continue;

																$font_styles = get_term_by( 'slug', $key, 'pa_font-styles');

																if ($font_styles) {
																	$stylename = !is_wp_error($font_styles) ? $font_styles->name : $key;
																	$stylslug = !is_wp_error($font_styles) ? $font_styles->slug : $key;
																}

														?>
														<div id="<?php echo $stylslug; ?>" class="tab-content-vertical">
															<div class="license-wrapper">

																<div class="lisence-list-wrapper">
																	<div class="lisence-list-contact">
																		<div class="contact-text">You can expect a <span>prompt response</span> from us, so there's no need to fear any delays.</div>
																		<a href="<?php echo get_permalink( get_page_by_path( 'contact-us' ) ) ?>" class="button elementor-button">
																			<span class="button-text"><?php _e( 'Contact Us', 'drizy' ); ?></span>
																			<span class="button-icon"><?php echo drizy_svg('contact-icon'); ?></span>
																		</a>
																	</div>
																</div>
																
																<?php foreach($val as $k=>$v) : 

																	$font_licenses = get_term_by( 'slug', $k, 'pa_font-licenses');

																	if ($font_licenses) {
																		$licensename = !is_wp_error($font_licenses) ? $font_licenses->name : $k;
																		$licencedetails = term_description( $font_licenses->term_id );
																	}

																?>
																<div class="lisence-list-wrapper">
																	<div class="lisence-list">
																		<div class="font-license-check">
																			<span class="icon-check"><span></span></span>
																		</div>
																		<div class="font-license-name-wrapper">
																			<div class="font-license-name">
																				<?php echo $licensename; ?>
																			</div>
																			<div class="font-license-name-small">
																				<?php the_title(); ?> <?php echo $stylename; ?>
																			</div>
																		</div>
																		<div class="font-license-price">
																			<?php echo $v['price_html']; ?>
																		</div>
																	</div>
																	<div class="lisence-list-description">
																		<div class="font-license-desc-title"><?php _e( 'Font licenses', 'drizy' ); ?></div>
																		<div class="font-license-desc">

																			<?php echo $licencedetails; ?>
																			
																			<div class="contact-us">
																				<span>For uses not written above, higher requirements, or need a different license:</span>
																				<span><a href="<?php echo get_permalink( get_page_by_path( 'contact-us' ) ) ?>">consult</a></span>
																			</div>
																			<div class="add-to-cart">
																				<button class="elementor-button button product_type_variation add_to_cart_button ajax_add_to_cart" data-quantity="1" data-product_id="<?php echo $v['variation_id']; ?>">
																					<div class="button-inner">
																						<span class="button-text"><?php _e( 'Add to Cart', 'drizy' ); ?></span>
																						<span class="button-icon"><?php echo drizy_svg('cart'); ?></span>
																					</div>
																				</button>
																			</div>
																		</div>
																	</div>
																</div>
																<?php endforeach; ?>

																<div class="lisence-list-wrapper">
																	<div class="lisence-list">
																		<div class="font-license-check">
																			<span class="icon-check"><span></span></span>
																		</div>
																		<div class="font-license-name-wrapper">
																			<div class="font-license-name">
																				<?php _e( 'Enterprise', 'drizy' ); ?>
																			</div>
																			<div class="font-license-name-small">
																				<?php the_title(); ?> <?php echo $stylename; ?>
																			</div>
																		</div>
																		<div class="font-license-price request-quote">
																			<span class="request-quote"><?php _e( 'Request Quote', 'drizy' ); ?></span>
																		</div>
																	</div>
																	<div class="lisence-list-description request-quote-desc">
																		<div class="font-license-desc-title"><?php _e( 'Font licenses', 'drizy' ); ?></div>
																		<div class="font-license-desc">

																			<?php echo do_shortcode('[enterprise_license]'); ?>

																			<div class="contact-us">
																				<span>For uses not written above, higher requirements, or need a different license:</span>
																				<span><a href="<?php echo get_permalink( get_page_by_path( 'contact-us' ) ) ?>">consult</a></span>
																			</div>

																			<div class="add-to-cart">
																				<a href="<?php echo get_permalink( get_page_by_path( 'contact-us' ) ) ?>" class="elementor-button button" data-quantity="1" data-product_id="<?php //echo $v['variation_id']; ?>">
																					<div class="button-inner">
																						<span class="button-text"><?php _e( 'Request Quote', 'drizy' ); ?></span>
																					</div>
																				</a>
																			</div>
																		</div>
																	</div>
																</div>

															</div>
														</div>
														<?php endforeach; endif; ?>
													</div>
												</div>
											</div>
										</div>
										<!-- /individual -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<!-- End Buying Options -->
	<?php endif; ?>
	
	<!-- Start Product Tags -->
	<div class="single-product-tags">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">

				<h5><?php _e( 'Tags', 'drizy' ); ?></h5>
				
				<?php  // get an array of the WP_Term objects for a defined product ID
				$terms = wp_get_post_terms( get_the_id(), 'product_tag' ); ?>

				<div class="drizy-product-tag">
					<div class="tag-lists">
						<?php if( count($terms) > 0 ){
						    foreach($terms as $term){
						        $term_id = $term->term_id; // Product tag Id
						        $term_name = $term->name; // Product tag Name
						        $term_slug = $term->slug; // Product tag slug
						        $term_link = get_term_link( $term, 'product_tag' ); // Product tag link

						        // Set the product tag names in an array
						        $output[] = '<div class="tag-list"><a href="'.$term_link.'">'.$term_name.'</a></div>';
						    }
						    // Set the array in a coma separated string of product tags for example
						    $output = implode( '', $output );

						    // Display the coma separated string of the product tags
						    echo $output;
						}
						?>
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Product Tags -->

	<!-- Start Single Product Related -->
	<div class="single-product-related">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h5><?php _e( 'Similar Fonts', 'drizy' ); ?></h5>
					<?php echo do_shortcode('[elementor-template id="2804"]'); ?>
				</div>
			</div>
		</div>
	</div>
	<!-- End Single Product Related -->

</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>