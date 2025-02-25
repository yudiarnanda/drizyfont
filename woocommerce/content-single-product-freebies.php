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
								    <div class="product-link">
								    	<?php if ( is_user_logged_in() ) { 
								    		$downloads = $product->get_downloads(); 
								    		foreach( $downloads as $key => $each_download ) { ?>
										    	<a href="<?php echo $each_download["file"]; ?>" class="member-download button elementor-button">
													<span class="button-text"><?php _e( 'Download', 'drizy' ); ?></span>
													<span class="button-icon"><?php echo drizy_svg('chevron-right'); ?></span>
												</a>
											<?php } ?>
										<?php } else { ?>
										<a href="" class="member-download button elementor-button">
											<span class="button-text"><?php _e( 'Download', 'drizy' ); ?></span>
											<span class="button-icon"><?php echo drizy_svg('chevron-right'); ?></span>
										</a>
										<?php } ?>
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
								<li><a href="#font-styles">Styles</a></li>
								<li><a href="#font-glyphs">Glyphs</a></li>
								<li><a href="#font-description">Description</a></li>
								<li><a href="#font-licensing">Licensing</a></li>
							</ul> <!-- END single-tabs-nav -->
						</div>

						<div id="single-tabs-content">
							<div id="font-styles" class="single-tab-content">
									<div class="font-container">
										<?php if ( have_rows( 'font_preview_settings' ) ) : ?>
											<?php while ( have_rows( 'font_preview_settings' ) ) : the_row(); ?>
												<?php if( have_rows('font_preview') ):
													while( have_rows('font_preview') ): the_row();
														$font_style = get_sub_field( 'font_style' );
														$file = get_sub_field('upload_font');
														$url = $file['url'];
														$title = $file['title'];
														$id = $file['id'];
														$prepareID = rand(100,99999).date('s');
														$defaultTextSize = 50;
														$defaultlineheight = 100;
												?>

												<div class="font-row <?php echo esc_html( $font_style['value'] ); ?>">
													<div class="font-wrapper">
														<div class="font-preview-toolbar">
															<div class="font-weight-name"><h6><?php echo esc_html( $font_style['label'] ); ?></h6></div>
															<div class="font-preview-control">
																<div class="font-size">
																	<div class="label"><?php _e( 'Font Size', 'drizy' ); ?></div>
																	<input type="range"  id="text-size-<?php echo $prepareID; ?>" min="10" max="180" value="60" class="slider custom_slider" id="text-size" name="text-size" data-index="1"  data-id="<?php echo $prepareID; ?>" data-font=""  data-type-para="line-height" oninput="this.nextElementSibling.value = this.value">
																	<output class="font-size-number">60</output>
																</div>
																<div class="font-spacing">
																	<div class="label"><?php _e( 'Letter Spacing', 'drizy' ); ?></div>
																	<input type="range" id="text-spacing-<?php echo $prepareID; ?>" min="-2" max="8" value="0" step="0.1" class="slider custom_slider" id="text-spacing" name="text-spacing" data-index="0"  data-id="<?php echo $prepareID; ?>" data-font="" oninput="this.nextElementSibling.value = this.value">
																	<output class="font-size-number">0</output>
																</div>
																<div class="font-leading">
																	<div class="label"><?php _e( 'Line Height', 'drizy' ); ?></div>
																	<input type="range" id="text-height-<?php echo $prepareID; ?>" min="100" max="200" value="60" class="slider custom_slider" id="text-height" name="text-height" data-index="0"  data-id="<?php echo $prepareID; ?>" data-font=""  data-type-para="font-size" oninput="this.nextElementSibling.value = this.value">
																	<output class="font-size-number">60</output>
																</div>
															</div>
														</div>
														<div class="font-preview-name">
															<div class="font-weight-name-field" id="text-output-<?php echo $prepareID; ?>" contenteditable="true" spellcheck="false" style="font-family:font_<?php echo esc_attr($id); ?>; line-height: 60px; font-size: 60px; letter-spacing: 0px;">
																<div class="target"><?php echo esc_attr($title); ?></div>
															</div>
														</div>
													</div>
												</div>

												<?php
														endwhile;
													endif;
												endwhile;
											endif;
										?>

									</div>
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
														<div class="meta-number"></div>
														<h6><?php _e( 'font Glyphs', 'drizy' ); ?></h6>
													</div>
													<div class="meta-include-font">
														<div class="meta-number">
														<?php if ( have_rows( 'font_preview_settings' ) ) : ?>
															<?php while ( have_rows( 'font_preview_settings' ) ) : the_row(); 
																$count = count(get_sub_field('font_preview')); ?>
																<?php if( have_rows('font_preview') ): ?>
																	<?php echo $count; ?>
																<?php endif; ?>
															<?php endwhile; ?>
														<?php endif; ?>
														</div>
														<h6><?php _e( 'font Styles', 'drizy' ); ?></h6>
													</div>
												</div>
											</div>
										</div>
										<div class="description-meta credits-details mgt-40">
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
										<div class="product-author mgt-60">
											<div class="product-author-info">
												<span><?php echo get_avatar( get_the_author_meta( 'ID' )); ?></span>
												<h6>
													<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author">
														<?php _e( 'By ', 'drizy' ); ?><?php echo get_the_author_meta('display_name', get_the_author_meta( 'ID' ) ); ?>
													</a>
												</h6>
											</div>
										</div>
										<div class="product-share mgt-40">
											<?php echo do_shortcode('[elementor-template id="3757"]'); ?>
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