<?php 

// add_action('pre_get_posts', 'my_pre_get_posts');
// function my_pre_get_posts($query) {
//     if ($query->is_author() && $query->is_main_query() && !strstr($_SERVER["REQUEST_URI"], '/author/')) {
//         $query->set('post_type', 'product');
//     }
// }


add_action('init', 'wpse_74054_add_author_woocommerce', 999 );
function wpse_74054_add_author_woocommerce() {
    add_post_type_support( 'product', 'author' );
}


// Allow SVG
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {

    global $wp_version;
    if ( $wp_version !== '4.7.1' ) {
        return $data;
    }

    $filetype = wp_check_filetype( $filename, $mimes );

    return [
        'ext'             => $filetype['ext'],
        'type'            => $filetype['type'],
        'proper_filename' => $data['proper_filename']
    ];

}, 10, 4 );

function cc_mime_types( $mimes ){
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );

function fix_svg() {
    echo '<style type="text/css">
        .attachment-266x266, .thumbnail img {
             width: 100% !important;
             height: auto !important;
        }
        </style>';
}
add_action( 'admin_head', 'fix_svg' );


/**
 * Filter to change breadcrumb args.
 *
 * @param  array $args Breadcrumb args.
 * @return array $args.
 */
add_filter( 'rank_math/frontend/breadcrumb/args', function( $args ) {
    $args = array(
        'delimiter'   => '',
        'wrap_before' => '<nav class="rank-math-breadcrumb">',
        'wrap_after'  => '</nav>',
        'before'      => '',
        'after'       => '',
    );
    return $args;
});


/**
 * facetwp_is_main_query
 */

// add_filter( 'facetwp_is_main_query', function( $is_main_query, $query ) {
//   if ( $query->is_archive() && ! ( $query->is_main_query() || true === $query->get( 'facetwp', false ) ) ) {
//     $is_main_query = false;
//   }
//   return $is_main_query;
// }, 100, 2 );


add_filter( 'facetwp_is_main_query', function( $is_main_query, $query ) {
  if ( $query->is_author() && $query->is_main_query() ) {
    $is_main_query = false;
  }
  return $is_main_query;
}, 10, 2 );


add_filter( 'facetwp_is_main_query', function( $is_main_query, $query ) {
  if ( $query->is_home() && $query->is_main_query() ) {
    $is_main_query = false;
  }
  return $is_main_query;
}, 100, 2 );



// Add facet a spinning loading icon
add_action( 'facetwp_scripts', function() {
  ?>
  <script>
    (function($) {
 
      // On start of the facet refresh, but not on first page load
      $(document).on('facetwp-refresh', function() {
        if ( FWP.loaded ) {
          $('.facetwp-template').prepend('<div class="loading-overlay"><div class="loading-icon"></div></div>');
        }
      });
 
      // On finishing the facet refresh
      $(document).on('facetwp-loaded', function() {
        $('.facetwp-template .loading-icon').remove();
        $('.facetwp-template .loading-overlay').remove();
      });
 
    })(jQuery);
  </script>
 
  <style>
 
    .loading-icon {
        position: absolute;
        display: block;
        margin: 0 auto;
        top: 50%;
        left: 0;
        right: 0;
        width: 8px;
        height: 8px;
        animation: spinner-z355kx 1.2s infinite linear;
        border-radius: 8px;
        box-shadow: 20px 0px 0 0 #FFB900, 12.4px 15.6px 0 0 #FFB900, -4.4px 19.4px 0 0 #FFB900, -18px 8.6px 0 0 #FFB900, -18px -8.6px 0 0 #FFB900, -4.4px -19.4px 0 0 #FFB900, 12.4px -15.6px 0 0 #FFB900;
        z-index: 2000;
    }

    .loading-overlay {
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: #000000a9;
        z-index: 1000;
    }
 
    @keyframes spinner-z355kx {
       to {
          transform: rotate(360deg);
       }
    }
 
  </style>
  <?php
}, 100 );


/**
* @param $path
* @return string
* @author https://github.com/ozzpy
*/
function fontEncode($path) {
    $path  = __DIR__."/".$path;
    $font = file_get_contents($path);
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    //$type  = $finfo->buffer($font);
    return "data:application/font-woff;charset=utf-8;base64,".base64_encode($font);
}

/**
 * @param $path
 * @return string
 * @author https://github.com/ozzpy
 */
function fontEncodePath($path) {
    $font = file_get_contents($path);
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    //$type  = $finfo->buffer($font);
    return "data:application/font-woff;charset=utf-8;base64,".base64_encode($font);
}


/**
 * @param $path
 * @return string
 * @author https://github.com/ozzpy
 */
function fontEncodeURL($path) {
    $font = file_get_contents($path);
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    //$type  = $finfo->buffer($font);
    return "data:application/font-woff;charset=utf-8;base64,".base64_encode($font);
}


// ACF upload prefilter
function gist_acf_upload_dir_prefilter($errors, $file, $field) {
    
    // Only allow editors and admins, change capability as you see fit
    if( !current_user_can('edit_pages') ) {
        $errors[] = 'Only Editors and Administrators may upload attachments';
    }
    
    // This filter changes directory just for item being uploaded
    add_filter('upload_dir', 'gist_acf_upload_dir');
    
}

// ACF hook, set to field key of your file upload field
add_filter('acf/upload_prefilter/key=field_66937b6563cd6', 'gist_acf_upload_dir_prefilter', 10, 3 );

// Custom upload directory
function gist_acf_upload_dir($param) {
    
    // Set to whatever directory you want the ACF file field to upload to
    $custom_dir = '/uploads/drizy-fonts-preview';
    $param['path'] = WP_CONTENT_DIR . $custom_dir;
    $param['url'] = WP_CONTENT_URL . $custom_dir;

    return $param;
    
}


// ACF upload prefilter
function gist_acf_upload_dir_prefilter_2($errors, $file, $field) {
    
    // Only allow editors and admins, change capability as you see fit
    if( !current_user_can('edit_pages') ) {
        $errors[] = 'Only Editors and Administrators may upload attachments';
    }
    
    // This filter changes directory just for item being uploaded
    add_filter('upload_dir', 'gist_acf_upload_dir_2');
    
}

// ACF hook, set to field key of your file upload field
add_filter('acf/upload_prefilter/key=field_66922e22c9f3d', 'gist_acf_upload_dir_prefilter_2', 10, 3 );

// Custom upload directory
function gist_acf_upload_dir_2($param) {
    
    // Set to whatever directory you want the ACF file field to upload to
    $custom_dir = '/uploads/drizy-fonts-preview';
    $param['path'] = WP_CONTENT_DIR . $custom_dir;
    $param['url'] = WP_CONTENT_URL . $custom_dir;

    return $param;
    
}


// Render fields at the bottom of variations - does not account for field group order or placement.
add_action( 'woocommerce_product_after_variable_attributes', function ( $loop, $variation_data, $variation ) {
    global $acf_variation; // Custom global variable to monitor index

    $acf_variation = $loop;
    // Add filter to update field name
    add_filter( 'acf/prepare_field', 'acf_prepare_field_update_field_name' );

    // Loop through all field groups
    $acf_field_groups = acf_get_field_groups();
    foreach ( $acf_field_groups as $acf_field_group ) {
        foreach ( $acf_field_group[ 'location' ] as $group_locations ) {
            foreach ( $group_locations as $rule ) {
                // See if field Group has at least one post_type = Variations rule - does not validate other rules
                if ( $rule[ 'param' ] == 'post_type' && $rule[ 'operator' ] == '==' && $rule[ 'value' ] == 'product_variation' ) {
                    // Render field Group
                    acf_render_fields( $variation->ID, acf_get_fields( $acf_field_group ) );

                    break 2;
                }
            }
        }
    }

    // Remove filter
    remove_filter( 'acf/prepare_field', 'acf_prepare_field_update_field_name' );
}, 10, 3 );

// Filter function to update field names
function acf_prepare_field_update_field_name( $field ) {
    global $acf_variation;

    $field[ 'name' ] = preg_replace( '/^acf\[/', "acf[$acf_variation][", $field[ 'name' ] );

    return $field;
}

// Save variation data
add_action( 'woocommerce_save_product_variation', function ( $variation_id, $i = -1 ) {
    // Update all fields for the current variation
    if ( !empty( $_POST[ 'acf' ] ) && is_array( $_POST[ 'acf' ] ) && array_key_exists( $i, $_POST[ 'acf' ] ) && is_array( ( $fields = $_POST[ 'acf' ][ $i ] ) ) ) {
        $unique_updates = array();
        foreach ( $fields as $key => $val ) {
            if ( strpos( $key, 'field_' ) === false ) {
                // repeater fields need to be parsed separately
                foreach ( $val as $repeater_key => $repeater_val ) {
                    if ( !array_key_exists( $repeater_key, $unique_updates ) || !empty( $repeater_val ) ) {
                        $unique_updates[ $repeater_key ] = $repeater_val;
                    }
                }
            } else {
                // non-repeater fields can be parsed normally
                // The repeater fields are repeated here, but empty. This causes the repeater that was updated above to be cleared
                if ( !array_key_exists( $key, $unique_updates ) || !empty( $val ) ) {
                    $unique_updates[ $key ] = $val;
                }
            }
        }
        // Only update each field once
        foreach ( $unique_updates as $key => $val ) {
            update_field( $key, $val, $variation_id );
        }
    }
}, 10, 2 );

// Add "Product Variation" location rule values
function my_acf_location_rule_values_post_type( $choices ) {
    $keys = array_keys( $choices );
    $index = array_search( 'product', $keys );

    $position = $index === false ? count( $choices ) : $index + 1;

    $choices = array_merge(
        array_slice( $choices, 0, $position ),
        array( 'product_variation' => __( 'Product Variation', 'auf' ) ),
        array_slice( $choices, $position )
    );

    return $choices;
}
add_filter( 'acf/location/rule_values/post_type', 'my_acf_location_rule_values_post_type' );

// Add "Product Variation" location rule match
function my_acf_location_rule_match_post_type( $match, $rule, $options, $field_group ) {
    if ( $rule[ 'value' ] == 'product_variation' && isset( $options[ 'post_type' ] ) ) {
        $post_type = $options[ 'post_type' ];

        if ( $rule[ 'operator' ] == "==" ) {
            $match = $post_type == $rule[ 'value' ];
        } elseif ( $rule[ 'operator' ] == "!=" ) {
            $match = $post_type != $rule[ 'value' ];
        }
    }

    return $match;
}
add_filter( 'acf/location/rule_match/post_type', 'my_acf_location_rule_match_post_type', 10, 4 );

//Campos imagen
function my_acf_input_admin_footer() {
?>
<script type="text/javascript">
  (function($) {
    $(document).on('woocommerce_variations_loaded', function () {
      acf.do_action('append', $('#post'));
    })
  })(jQuery);   
</script>
<?php
}
add_action( 'acf/input/admin_footer', 'my_acf_input_admin_footer' );


/**
 * Add FacetWP sort options
 */
add_filter( 'facetwp_sort_options', function( $options, $params ) {
    
    $options['default'] = array(
        'label' => 'New Releases',
        'query_args' => array(
            'post_type' => 'product',
            'orderby' => 'date',
            'order' => 'DESC',
        )
    );

    $options['popular'] = array(
        'label' => 'Best Sellers',
        'query_args' => array(
            'post_type' => 'product',
            'meta_key' => 'total_sales',
            'orderby' => 'meta_value_num',
            'order' => 'DESC',
        )
    );

    return $options;
}, 10, 2 );

add_filter( 'facetwp_sort_options', function( $options, $params ) {
    unset( $options['date_asc'] );
    unset( $options['date_desc'] );
    unset( $options['title_asc'] );
    unset( $options['title_desc'] );
    return $options;
}, 10, 2 );

add_filter( 'facetwp_sort_html', function( $html, $params ) {
    $html = '<select class="facetwp-sort-select drizy-custom-select" id="product-filter">';
    foreach ( $params['sort_options'] as $key => $atts ) {
        $html .= '<option value="' . $key . '">' . $atts['label'] . '</option>';
    }
    $html .= '</select>';
    return $html;
}, 10, 2 );


// Hide Count on Category Filter
add_filter( 'facetwp_facet_dropdown_show_counts', '__return_false' );


// Contributor Current Product
// add_action('elementor_pro/posts/query/current_product', function($query) {
//     // The author of the current post
//     $query->set( 'post_type', [ 'product'] );
//     $author_id = get_the_author_meta('ID');
//     $query->set( 'author', $author_id );
// });

add_action( 'elementor/query/authorproduct', function($query) {

    $author_id = get_the_author_meta('ID');
    $query->set( 'author', $author_id );
    $query->set( 'post_type', [ 'product'] );

} );