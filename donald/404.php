<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package donald
 */

get_header(); ?>

  <section class="no-padding bg-img bg-error">
    <div class="container">
      <div class="warp-404">
        <div class="warp-404-inner">
          <strong><?php esc_html_e('404 ERROR','donald'); ?></strong>
          <p><?php esc_html_e('Oops. You have encountered an error.','donald'); ?></p>
          <p><?php esc_html_e('It appears the page your were looking for does not exist. Sorry about that.','donald'); ?></p>
        </div>
      </div>
    </div>
  </section>
	
<?php get_footer(); ?>
