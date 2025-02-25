<?php

	function social_share_shortcode() { 

	ob_start(); 

		global $post;
		$id = $post->ID;

	    // Get current page URL 
	    $sb_url = urlencode(get_permalink());

	    // Get current page title
	    $sb_title = str_replace(' ', '%20', get_the_title());
	    
	    // Get Post Thumbnail for pinterest
	    //$sb_thumb = get_the_post_thumbnail_src(get_the_post_thumbnail());

	    // Construct sharing URL without using any script
	    $pinterestURL = 'https://pinterest.com/pin/create/button/?url='.$sb_url.'&description='.$sb_title;
	    $instgaramURL = '';
	    $whatsappURL = 'whatsapp://send?text='.$sb_title . ' ' . $sb_url;
	    $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$sb_url;
	    $twitterURL = 'https://twitter.com/intent/tweet?text='.$sb_title.'&url='.$sb_url.'';

   ?>

	    <div class="social-share-box">	  
	    	<div class="social-button">
	    		<?php echo drizy_svg('share-icon'); ?>
	    	</div>
	    	<div class="social-share-list">
		    	<div class="social-btn">
		    		<a class="col-2 sbtn s-pinterest" href="<?php echo $pinterestURL; ?>" data-pin-custom="true" target="_blank" rel="nofollow"><span><?php echo drizy_svg('pinterest_w'); ?></span></a>
		    		<a class="col-2 sbtn s-whatsapp" href="<?php echo $whatsappURL; ?>" target="_blank" rel="nofollow"><span><?php echo drizy_svg('whatsapp_w'); ?></span></a>
		    		<a class="col-1 sbtn s-facebook" href="<?php echo $facebookURL; ?>" target="_blank" rel="nofollow"><span><?php echo drizy_svg('facebook_w'); ?></span></a>
		    		<a class="col-1 sbtn s-twitter" href="<?php echo $twitterURL; ?>" target="_blank" rel="nofollow"><span><?php echo drizy_svg('twitter_w'); ?></span></a>
			    </div>
		    </div>
		</div>
	    
	<?php

	$content = ob_get_clean();
    return $content;
}
add_shortcode( 'social_share', 'social_share_shortcode' );