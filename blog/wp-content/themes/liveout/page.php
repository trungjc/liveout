<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>
<div class="w-container main-container">
    <div class="page-title">Blog</div>
 <div class="right-text"><strong>Want to guest post? <br xmlns="http://www.w3.org/1999/xhtml"></strong>Email: <span class="high_light">blog@liveout.org</span>
    </div>
<div class="w-clearfix main-ad-div-block">
<a class="w-clearfix w-inline-block main-blog-ad-link-block" target="_blank" href="<?php the_field('top_ad_-_link', 'option'); ?>"><img class="main-blog-ad-image" src="<?php the_field('top_ad_-_image', 'option'); ?>" alt="<?php the_field('top_ad_-_title', 'option'); ?>">
    </a></div><br>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
the_content();
endwhile; else: ?>
<p>Sorry, no posts matched your criteria.</p>
<?php endif; ?>

  </div>

<?php get_footer(); ?>

