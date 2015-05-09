<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>


<div class="w-container main-container blog-container">
    <div class="page-title">Blog</div>
    <div class="custom-ad">
 <a class="w-clearfix w-inline-block custom-ad_link-block" target="_blank" href="<?php the_field('url'); ?>"><img class="adsense-ad" src="<?php the_field('image'); ?>"  alt="<?php the_field('title'); ?>">
      </a>
    </div>
 <div class="w-row article-related-articles-columns">
      <div class="w-col w-col-9 w-clearfix"><?php if (has_post_thumbnail( $post->ID ) ): ?>
<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' ); ?>

        <div class="w-clearfix blog-article"><img class="blog-article-image" src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>"><?php endif; ?>
      <div class="blog-article-title"><?php the_title(); ?></div>
      <div class="normal-text" style="text-align: justify;font-size:13px !important;">
 <?php 
          
$content_post = get_post($my_postid);
$content = $content_post->post_content;
$content = apply_filters('the_content', $content);
$content = str_replace(']]>', ']]&gt;', $content);
echo $content;
?>

   </div>
<br>
<?php echo do_shortcode('[fbcomments]'); ?>
</br></div>
 <div class="w-clearfix social-media-div-tablet-mobile">
            <div class="w-widget w-widget-gplus social-icons">
              <div class="g-plusone" data-href="http://webflow.com" data-size="tall" data-annotation="bubble" data-width="120" data-recommendations="false" id="___plusone_76" style="width: 50px; height: 60px; text-indent: 0px; margin: 0px; padding: 0px; border-style: none; float: none; line-height: normal; font-size: 1px; vertical-align: baseline; display: inline-block; background: transparent;"></div>
            </div>
            <div class="w-widget w-widget-twitter social-icons">
            <div class="socialicons"><?php
if(function_exists('display_social4i'))
echo display_social4i("large","align-left");
?>
    </div>
          </div>
          
        </div>
      </div>
      <div class="w-col w-col-3 w-clearfix related-articles-column">
        <div class="w-clearfix refer-a-friend-area" data-ix="refer-a-friend-box">
          <div class="logo-div"><img class="logo" src="<?php the_field('top_logo', 'option'); ?>" alt="">
          </div>
          <div class="referral-program"><?php the_field('title_(black)', 'option'); ?></div>
          <div class="bold"><?php the_field('title_(green)', 'option'); ?></div>
          <div class="refer-a-friend-program"><?php the_field('text_right', 'option'); ?></div><img class="rei" src="<?php the_field('image_right', 'option'); ?>" alt="">
          <div class="spread-the-word"><?php the_field('bottom_title', 'option'); ?></div>
          <div class="w-widget w-widget-facebook social_media_icons">
            <iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Ffacebook.com%2FLiveOutSocialNetwork&amp;layout=standard&amp;locale=en_US&amp;action=like&amp;show_faces=false&amp;share=false" scrolling="no" frameborder="0" allowtransparency="true" style="border: none; overflow: hidden; width: 225px; height: 35px;"></iframe>
          </div>
          <div class="w-widget w-widget-twitter social_media_icons">
            <iframe src="https://platform.twitter.com/widgets/tweet_button.html#url=http%3A%2F%2Fliveout.org&amp;counturl=liveout.org&amp;text=Check%20out%20this%20site&amp;count=horizontal&amp;size=m&amp;dnt=true" scrolling="no" frameborder="0" allowtransparency="true" style="border: none; overflow: hidden; width: 110px; height: 20px;"></iframe>
          </div>
          <div class="w-widget w-widget-gplus social_media_icons">
            <div class="g-plusone" data-href="http://webflow.com" data-size="standard" data-annotation="bubble" data-width="120" data-recommendations="false" id="___plusone_78" style="width: 106px; height: 24px; text-indent: 0px; margin: 0px; padding: 0px; border-style: none; float: none; line-height: normal; font-size: 1px; vertical-align: baseline; display: inline-block; background: transparent;"></div>
          </div>
        </div>
        <div class="w-clearfix related-articles-div">
          <div class="related-articles-header">Related articles</div><?php
//for use in the loop, list 5 post titles related to first tag on current post
$tags = wp_get_post_tags($post->ID);
if ($tags) {
$first_tag = $tags[0]->term_id;
$args=array(
'tag__in' => array($first_tag),
'post__not_in' => array($post->ID),
'posts_per_page'=>5,
'caller_get_posts'=>1
);
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
while ($my_query->have_posts()) : $my_query->the_post(); ?>
<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a><br><br>

<?php
endwhile;
}
wp_reset_query();
}
?>
        </div>
        <a class="w-inline-block ad-2" target="_blank" href="<?php the_field('right_ad_image_link'); ?>"><img src="<?php the_field('right_ad_image'); ?>" alt="">
        </a>
      </div>
    </div>
    <div class="w-clearfix adsense-tablet-mobile">
    <?php the_field('google-adsense', 'option'); ?>
      </a>
    </div>
  </div>


    <div class="w-widget w-widget-facebook social-icons">


<?php get_footer(); ?>


