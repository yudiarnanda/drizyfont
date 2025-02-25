<?php 

// Category Font Tester Style List Shortcode
function category_font_meta_shortcode() { 

	ob_start(); 

	global $woocommerce, $product, $post;

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

	$font_preview = get_field( 'field_665464ee06ee5' );
	$font_styles = array_keys( $maindata );

	$font_families = [];
	$font_faces_html = "<style type=\"text/css\">";
	foreach( $font_preview as $item ) {
	  if( in_array( $item['font_style']['value'], $font_styles ) ) {
	    $font_families[$item['font_style']['value']] = $item['upload_font']['title'];
	    $font_faces_html .= "@font-face { 
	          font-family: '{$item['upload_font']['title']}'; 
	          src: url('{$item['upload_font']['url']}');
	        } ";
	  }
	}
	$font_faces_html .= "</style>";
	//echo $font_faces_html;

	?>

	<div class="category-meta-wrapper">
		<div class="category-font-style-count">
			<?php printf(__( '%s Font Styles', 'drizy' ), count($font_families)); ?>
		</div>
		<div class="category-font-variable">
			<?php _e( 'Variable Font', 'drizy' ); ?>
		</div>
		<div class="category-font-style-list">
			<div class="font-style-list">
				<select name="font-style" class="category-font-style drizy-custom-select">
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

					$font_name = $font_families[$stylslug];

					?>

						<option value="<?php echo $font_name; ?>"><?php echo $stylename; ?></option>

					<?php $no++; endforeach; endif; ?>
				</select>
			</div>
		</div>	
	</div>

	<?php $content = ob_get_clean();
	return $content;
}
add_shortcode( 'category_font_meta', 'category_font_meta_shortcode' );



// Select font preview text product cat
function font_tester_preview_shortcode() { 

	ob_start(); ?>

	<select class="cat-font-tester-preview drizy-custom-select wide" id="text-preview">>
		<option value="text-preview-1" selected><?php _e( 'The quick brown fox jumps over a lazy dog', 'drizy' ); ?></option>
		<option value="text-preview-2"><?php _e( 'Quizzical twins proved my hijack-bug fix', 'drizy' ); ?></option>
		<option value="text-preview-3"><?php _e( 'Cozy sphinx waves quart jug of bad milk', 'drizy' ); ?></option>
		<option value="text-preview-4"><?php _e( 'Fix problem quickly with galvanized jets', 'drizy' ); ?></option>
		<option value="text-preview-5"><?php _e( 'Aa Bb Cc Dd Ee Ff Gg Hh Ii Jj Kk Ll Mm Nn Oo Pp...', 'drizy' ); ?></option>
  	</select>

	<?php $content = ob_get_clean();
	return $content;
}
add_shortcode( 'font_tester_preview', 'font_tester_preview_shortcode' );


// Select font preview text product cat
function font_tester_preview_text_shortcode() { 

	ob_start(); 

	global $woocommerce, $product, $post;

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

		$font_preview = get_field( 'field_665464ee06ee5' );
		$font_styles = array_keys( $maindata );

		$font_families = [];
		$font_faces_html = "<style type=\"text/css\">";
		foreach( $font_preview as $item ) {
		  if( in_array( $item['font_style']['value'], $font_styles ) ) {
		    $font_families[$item['font_style']['value']] = $item['upload_font']['title'];
		    $font_faces_html .= "@font-face { 
		          font-family: '{$item['upload_font']['title']}'; 
		          src: url('{$item['upload_font']['url']}');
		        } ";
		  }
		}
		$font_faces_html .= "</style>";
		echo $font_faces_html;

	?>

	<div class="product-cat-font-preview">

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

	?>
	<?php $font_name = $font_families[$stylslug]; ?>

			<div class="font-preview-list text-preview-1" contenteditable="true" spellcheck="false" style="font-family: '<?php echo $font_name; ?>'">The quick brown fox jumps over a lazy dog</div>
			<div class="font-preview-list text-preview-2" contenteditable="true" spellcheck="false" style="font-family: '<?php echo $font_name; ?>'">Quizzical twins proved my hijack-bug fix</div>
			<div class="font-preview-list text-preview-3" contenteditable="true" spellcheck="false" style="font-family: '<?php echo $font_name; ?>'">Cozy sphinx waves quart jug of bad milk</div>
			<div class="font-preview-list text-preview-4" contenteditable="true" spellcheck="false" style="font-family: '<?php echo $font_name; ?>'">Fix problem quickly with galvanized jets</div>
			<div class="font-preview-list text-preview-5" contenteditable="true" spellcheck="false" style="font-family: '<?php echo $font_name; ?>'">Aa Bb Cc Dd Ee Ff Gg Hh Ii Jj Kk Ll Mm Nn Oo Pp...</div>

		<?php $no++; endforeach; endif; ?>

	</div>

	<?php $content = ob_get_clean();
	return $content;
}
add_shortcode( 'font_tester_preview_text', 'font_tester_preview_text_shortcode' );

?>