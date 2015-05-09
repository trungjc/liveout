<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
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
<?php $the_query = new WP_Query( array( 'paged' => get_query_var( 'paged' ) ) );?>
 <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
    <div class="w-clearfix blog-div-block"><?php the_post_thumbnail( 'medium', array( 'class' => 'blog_image' ) ); ?><a class="blog-title" href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
      <div class="contributor-link">by <?php the_author(); ?></div>
      <div class="blog-short-description"><?php the_excerpt(__('(more…)')); ?></div>
    </div>

 <?php endwhile;?>
<?php wp_pagenavi(); ?>  

  </div>

<?php get_footer(); ?>

