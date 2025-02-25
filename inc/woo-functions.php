<?php 

/**
 * @snippet       Add First & Last Name to My Account Register Form - WooCommerce
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 8
 * @community     https://businessbloomer.com/club/
 */
  
///////////////////////////////
// 1. ADD FIELDS
  
add_action( 'woocommerce_register_form_start', 'drizy_add_name_woo_account_registration' );
function drizy_add_name_woo_account_registration() {
    ?>
  
    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
    <label for="reg_billing_first_name"><?php _e( 'First name', 'woocommerce' ); ?> <span class="required">*</span></label>
    <input type="text" class="input-text" name="billing_first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>" />
    </p>
  
    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
    <label for="reg_billing_last_name"><?php _e( 'Last name', 'woocommerce' ); ?> <span class="required">*</span></label>
    <input type="text" class="input-text" name="billing_last_name" id="reg_billing_last_name" value="<?php if ( ! empty( $_POST['billing_last_name'] ) ) esc_attr_e( $_POST['billing_last_name'] ); ?>" />
    </p>
    
    <?php
}
  
///////////////////////////////
// 2. VALIDATE FIELDS
  
add_filter( 'woocommerce_registration_errors', 'drizy_validate_name_fields', 10, 3 );
  
function drizy_validate_name_fields( $errors, $username, $email ) {
    if ( isset( $_POST['billing_first_name'] ) && empty( $_POST['billing_first_name'] ) ) {
        $errors->add( 'billing_first_name_error', __( '<strong>Error</strong>: First name is required!', 'woocommerce' ) );
    }
    if ( isset( $_POST['billing_last_name'] ) && empty( $_POST['billing_last_name'] ) ) {
        $errors->add( 'billing_last_name_error', __( '<strong>Error</strong>: Last name is required!.', 'woocommerce' ) );
    }
    return $errors;
}
  
///////////////////////////////
// 3. SAVE FIELDS
  
add_action( 'woocommerce_created_customer', 'drizy_save_name_fields' );
  
function drizy_save_name_fields( $customer_id ) {
    if ( isset( $_POST['billing_first_name'] ) ) {
        update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
        update_user_meta( $customer_id, 'first_name', sanitize_text_field($_POST['billing_first_name']) );
    }
    if ( isset( $_POST['billing_last_name'] ) ) {
        update_user_meta( $customer_id, 'billing_last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
        update_user_meta( $customer_id, 'last_name', sanitize_text_field($_POST['billing_last_name']) );
    }
  
}

// Registration
function wc_registration_form_function() {
   if ( is_admin() ) return;
   if ( is_user_logged_in() ) return;
 
   ob_start();
   do_action( 'woocommerce_before_customer_login_form' );
?>

   <form method="post" class="woocommerce-form woocommerce-form-register register" autocomplete="off" <?php do_action( 'woocommerce_register_form_tag' ); ?> >
      <h3><?php esc_html_e( 'Create an Account', 'woocommerce' ); ?></h3>
      <?php do_action( 'woocommerce_register_form_start' ); ?>
      <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
         <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
         </p>
      <?php endif; ?>
      <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
         <label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
         <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
      </p>
      <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
         <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
            <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
         </p>
      <?php else : ?>
         <p><?php esc_html_e( 'A password will be sent to your email address.', 'woocommerce' ); ?></p>
      <?php endif; ?>
      <?php do_action( 'woocommerce_register_form' ); ?>
      <p class="woocommerce-form-row form-row">
         <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
         <button type="submit" class="woocommerce-button woocommerce-button button woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
      </p>
      <?php do_action( 'woocommerce_register_form_end' ); ?>
   </form>
   <?php
   return ob_get_clean();
}
add_shortcode( 'wc_registration_form', 'wc_registration_form_function' );


// Login Shortcode
function wc_login_form_function() {
   if ( is_admin() ) return;
   if ( is_user_logged_in() ) return; 
   ob_start();
?>
   <form class="woocommerce-form woocommerce-form-login login" method="post" autocomplete="off">
      <h3><?php esc_html_e( 'Log In to Your Account', 'woocommerce' ); ?></h3>
      <?php do_action( 'woocommerce_login_form_start' ); ?>
      <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
         <label for="username"><?php esc_html_e( 'E-mail address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
         <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
      </p>
      <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
         <label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
         <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />
      </p>
      <?php do_action( 'woocommerce_login_form' ); ?>
      <p class="form-row remember-me">
         <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
            <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
         </label>
         <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Forgot Password?', 'woocommerce' ); ?></a>
      </p>
      <p class="woocommerce-LostPassword lost_password">
         <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
         <button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Login', 'woocommerce' ); ?></button>
      </p>
      <?php do_action( 'woocommerce_login_form_end' ); ?>
   </form>
<?php
   return ob_get_clean();
}
add_shortcode( 'wc_login_form', 'wc_login_form_function' );


/**
 * @snippet       Remove Dashboard from My Account
 * @author        Misha Rudrastyh
 * @link          https://rudrastyh.com/woocommerce/remove-dashboard-from-my-account-menu.html
 */
// remove menu link
add_filter( 'woocommerce_account_menu_items', 'drizy_remove_my_account_dashboard' );
function drizy_remove_my_account_dashboard( $menu_links ){
   
   unset( $menu_links[ 'dashboard' ] );
   return $menu_links;
   
}


/**
 * @snippet       Reorder tabs @ My Account
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 6
 * @community     https://businessbloomer.com/club/
 */
 
add_filter( 'woocommerce_account_menu_items', 'drizy_add_link_my_account' );
 
function drizy_add_link_my_account( $items ) {
   $newitems = array(
      'edit-account'    => __( 'Account details', 'woocommerce' ),
      'edit-address'    => _n( 'Addresses', 'Address', (int) wc_shipping_enabled(), 'woocommerce' ),
      'payment-methods' => __( 'Payment', 'woocommerce' ),
      'orders'          => __( 'Orders', 'woocommerce' ),
      'downloads'       => __( 'Downloads', 'woocommerce' ),   
      'customer-logout' => __( 'Logout', 'woocommerce' ),
   ); 
   return $newitems;
}


/**
* WooCommerce My Account Page Login Redirect
*/
add_filter( 'woocommerce_login_redirect', 'drizy_customer_login_redirect', 9999 );
function drizy_customer_login_redirect( $redirect_url ) {
    $redirect_url = '/';
    return $redirect_url;
}


/**
* WooCommerce My Account Page Logout Redirect
*/
add_action( 'wp_logout', 'drizy_customer_logout_redirect' );
function drizy_customer_logout_redirect() {
   wp_redirect( home_url() );
   exit();
}


/**
 * Get user's first and last name, else just their first name, else their
 * display name. Defaults to the current user if $user_id is not provided.
 *
 * @param  mixed  $user_id The user ID or object. Default is current user.
 * @return string          The user's name.
 */
function drizy_get_users_name( $user_id = null ) {

   $user_info = $user_id ? new WP_User( $user_id ) : wp_get_current_user();

   if ( $user_info->first_name ) {
      if ( $user_info->last_name ) {
         return $user_info->first_name . ' ' . $user_info->last_name;
      }
      return $user_info->first_name;
   }
   return $user_info->display_name;
}
add_shortcode( 'drizy_fullname_shortcode', 'drizy_get_users_name' );


// Remove Download Remaining
add_action( 'woocommerce_account_downloads_columns', 'drizy_downloads_columns', 10, 1 );
add_action( 'woocommerce_email_downloads_columns', 'drizy_downloads_columns', 10, 1 );
function drizy_downloads_columns( $columns ){

    if(isset($columns['download-remaining']))
        unset($columns['download-remaining']);

    return $columns;
}


/**
 * Rename "home" in breadcrumb
 */
add_filter( 'woocommerce_breadcrumb_defaults', 'wcc_change_breadcrumb_home_text' );
function wcc_change_breadcrumb_home_text( $defaults ) {
    // Change the breadcrumb home text from 'Home' to 'Apartment'
   $defaults['home'] = 'Drizy Fonts';
   return $defaults;
}


/**
 * Change the breadcrumb separator
 */
add_filter( 'woocommerce_breadcrumb_defaults', 'wcc_change_breadcrumb_delimiter' );
function wcc_change_breadcrumb_delimiter( $defaults ) {
   // Change the breadcrumb delimeter from '/' to '>'
   $defaults['delimiter'] = drizy_svg('right_arrow');
   return $defaults;
}


/**
 * Remove the breadcrumbs 
 */
add_action( 'init', 'woo_remove_wc_breadcrumbs' );
function woo_remove_wc_breadcrumbs() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}


/*
* Change product name in cart Page
*/

// Item Row
function drizy_change_product_name($productname, $cartitem, $cartkey) {
   $variation_id = isset($cartitem['variation_id']) ? $cartitem['variation_id'] : 0;
   
   if($variation_id) {
      $variation = wc_get_product($variation_id);
      $attributes = $variation->get_variation_attributes();
      $font_styles = isset($attributes['attribute_pa_font-styles']) ? $attributes['attribute_pa_font-styles'] : 0;


      if($font_styles) {
         $term = get_term_by( 'slug', $font_styles, 'pa_font-styles');
      }

      $stylename =  !is_wp_error($term) ? $term->name : '';
      $productname .= '  - '.$stylename;

   }

   return $productname;
}
add_filter('woocommerce_cart_item_name','drizy_change_product_name', 10, 3);

// License Row
function drizy_republic_get_item_data( $item_data, $cartitem ) {
    $variation_id = isset($cartitem['variation_id']) ? $cartitem['variation_id'] : 0;
   
      if ($variation_id) {
      $variation = wc_get_product($variation_id);
      $attributes = $variation->get_variation_attributes();
      $font_licenses = isset($attributes['attribute_pa_font-licenses']) ? $attributes['attribute_pa_font-licenses'] : 0;

      if ($font_licenses) {
         $term = get_term_by( 'slug', $font_licenses, 'pa_font-licenses');
      };

      $stylename =  !is_wp_error($term) ? $term->name : '';
      $item_data[] = array(
         'key'=>'drizy-license;',
         'value'=>'' . $stylename . ' License'
      );

   }
    return $item_data;
}
add_filter( 'woocommerce_get_item_data', 'drizy_republic_get_item_data', 10, 2 );


// Move Payment Methods under Customer Info
function drizy_wc_setup() {
  remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
  add_action( 'woocommerce_after_order_notes', 'woocommerce_checkout_payment', 20 );

   remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
   add_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_coupon_form' );

}
add_action( 'after_setup_theme', 'drizy_wc_setup' );


// Unset Form Field in Checkot Page
add_filter( 'woocommerce_checkout_fields' , 'custom_remove_woo_checkout_fields' );
 
function custom_remove_woo_checkout_fields( $fields ) {

    // remove billing fields
    //unset($fields['billing']['billing_first_name']);
    //unset($fields['billing']['billing_last_name']);
    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_address_1']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_city']);
    unset($fields['billing']['billing_postcode']);
    unset($fields['billing']['billing_country']);
    unset($fields['billing']['billing_state']);
    //unset($fields['billing']['billing_phone']);
    //unset($fields['billing']['billing_email']);
   
    // remove shipping fields 
    unset($fields['shipping']['shipping_first_name']);    
    unset($fields['shipping']['shipping_last_name']);  
    unset($fields['shipping']['shipping_company']);
    unset($fields['shipping']['shipping_address_1']);
    unset($fields['shipping']['shipping_address_2']);
    unset($fields['shipping']['shipping_city']);
    unset($fields['shipping']['shipping_postcode']);
    unset($fields['shipping']['shipping_country']);
    unset($fields['shipping']['shipping_state']);
    
    // remove order comment fields
    //unset($fields['order']['order_comments']);
    
    return $fields;
}



function wc_ninja_custom_variable_price( $price, $product ) {
    // Main Price
    $prices = array( $product->get_variation_price( 'min', true ), $product->get_variation_price( 'max', true ) );
    $price = $prices[0] !== $prices[1] ? sprintf( __( '%1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );

    // Sale Price
    $prices = array( $product->get_variation_regular_price( 'min', true ), $product->get_variation_regular_price( 'max', true ) );
    sort( $prices );
    $saleprice = $prices[0] !== $prices[1] ? sprintf( __( '', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );

    if ( $price !== $saleprice ) {
        $price = ' <ins class="highlight"> '. $price.' </ins> <del class="strike"> '.$saleprice .' </del> ';
    }

    return $price;
}
add_filter( 'woocommerce_variable_sale_price_html', 'wc_ninja_custom_variable_price', 10, 2 );
add_filter( 'woocommerce_variable_price_html', 'wc_ninja_custom_variable_price', 10, 2 );


/**
 * Exclude freebies from a particular category on the shop page and related
 */
// function custom_pre_get_posts_query( $q ) {
//     $tax_query = (array) $q->get( 'tax_query' );
//     $tax_query[] = array(
//            'taxonomy' => 'product_cat',
//            'field' => 'slug',
//            'terms' => array( 'freebies' ),
//            'operator' => 'NOT IN'
//     );
//     $q->set( 'tax_query', $tax_query );

// }
// add_action( 'woocommerce_product_query', 'custom_pre_get_posts_query' );


// add_filter( 'woocommerce_get_related_product_cat_terms', 'exclude_product_category_from_related_products' ); 
// function exclude_product_category_from_related_products( $cats_array ) {      
//     $term = get_term_by('slug', 'freebies', 'product_cat');      
//     if ( $term && ($key = array_search($term->term_id, $cats_array)) !== false) {         
//         unset($cats_array[$key]);     
//     }      
//     return $cats_array; 
// }


// Customize text strings
function my_gettext( $translation, $text, $domain ) {
    switch ( $translation ) {
        case 'Products tagged &ldquo;%s&rdquo;' :
            $translation = __( '%s', 'woocommerce' );
            break;
    }
    return $translation;
}
add_filter( 'gettext', 'my_gettext', 20, 3 );


/**
 * Exclude products from a particular category on the shop page
 */
function custom_pre_get_posts_query( $q ) {

    $tax_query = (array) $q->get( 'tax_query' );
    $tax_query[] = array(
           'taxonomy' => 'product_cat',
           'field' => 'slug',
           'terms' => array( 'membership' ), // Don't display products in the clothing category on the shop page.
           'operator' => 'NOT IN'
    );

    $q->set( 'tax_query', $tax_query );

}
add_action( 'woocommerce_product_query', 'custom_pre_get_posts_query' ); 


// If a WooCommerce price is a full dollar value, trim the
add_filter( 'woocommerce_price_trim_zeros', '__return_true' );


// Woocommerce Logout Redirect to Home
add_action('wp_logout','auto_redirect_after_logout');
function auto_redirect_after_logout(){
   wp_redirect( home_url() );
   exit();
}