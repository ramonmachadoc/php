<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package donald
 */

get_header(); ?>
    
    <?php if(donald_get_option('page_header')) { ?>
    <!-- Subheader -->
    <section class="boxed no-padding bg-img " style="background-image: url(<?php echo get_template_directory_uri(); ?>/images/bg-subheader-blog.jpg);">
        <div class="sub-header depen-on-img">
            <img src="<?php echo get_template_directory_uri(); ?>/images/bg-subheader-blog.jpg" class="img-responsive" alt="Image">
            <div class="sub-header-inner center-center">
                <h2><?php the_archive_title(); ?></h2> 
                <?php if(donald_get_option('breadcrumb') && function_exists('bcn_display')) { ?>   
                    <div class="breadcrumb">
                        <?php bcn_display(); ?>
                    </div>
                <?php } ?>              
            </div>
        </div>
    </section>
    <!-- /Subheader -->
    <?php } ?>
    <!-- Main Content -->
    <section>
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <div class="blog-list">
                    <?php if( have_posts() ) : ?>
                        <?php 
                            while (have_posts()) : the_post();
                                get_template_part( 'content', get_post_format() ) ;
                            endwhile;
                        ?>
                        
                        <nav class="page-pagination style-1 text-center mgt-30">
                            <span class="current-page"></span>
                            <?php echo donald_pagination(); ?>    
                        </nav>
                    <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </section>
    

<?php get_footer(); ?>