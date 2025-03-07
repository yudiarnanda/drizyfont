<?php

function update_focus_keywords() {
    $posts = get_posts(array(
    'posts_per_page'    => -1,
    'post_type'     => 'product' // Replace post with the name of your post type
    ));
    foreach($posts as $p){
        // Checks if Rank Math keyword already exists and only updates if it doesn't have it
        $rank_math_keyword = get_post_meta( $p->ID, 'rank_math_focus_keyword', true );
    if ( ! $rank_math_keyword ){ 
            update_post_meta($p->ID,'rank_math_focus_keyword',strtolower(get_the_title($p->ID)));
        }
    }
}
add_action( 'init', 'update_focus_keywords' );