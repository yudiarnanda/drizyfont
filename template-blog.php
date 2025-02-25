<?php
/**
 * Template Name: Blog Template
 *
 *  *
 * @package Drizy
 */
 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); 

?>

<div class="blog-header">
	<div class="row">
		<div class="col-sm-12">
			<?php echo do_shortcode('[rank_math_breadcrumb]'); ?>
		</div>
	</div>
</div>

<div class="blog-web-stories">
	<div class="row">
		<div class="col-sm-4">
			<h1><?php _e( 'Latest stories from us', 'drizy' ); ?></h1>
		</div>
		<div class="col-sm-8"></div>
	</div>
</div>

<?php get_footer(); ?>