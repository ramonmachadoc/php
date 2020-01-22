<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package donald
 */

get_header(); ?>
    
    <?php if(donald_get_option('page_header')) { ?>
    <?php $img = donald_get_option( 'page_header_bg' ) ? donald_get_option( 'page_header_bg' ) : get_template_directory_uri().'/images/bg-subheader-blog.jpg'; ?>
    <!-- Subheader -->
    <section class="boxed no-padding bg-img " style="background-image: url(<?php echo esc_url($img); ?>);">
        <div class="sub-header depen-on-img">
            <img src="<?php echo esc_url($img); ?>" class="img-responsive" alt="Image">
            <div class="sub-header-inner center-center">
                <h2><?php printf( esc_html__( 'Search Results for: %s', 'donald' ), '<span>' . get_search_query() . '</span>' ); ?></h2>               
            </div>
        </div>
    </section>
    <!-- /Subheader -->
    <?php } ?>
    <!-- Main Content -->
    <section class="search-page">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <div class="blog-list">

                        <?php if(have_posts()) :

                            while ( have_posts()): the_post();                        

                            get_template_part( 'content', get_post_format() ) ;

                            endwhile;?>

                            <nav class="page-pagination style-1 text-center mgt-30">
                                <span class="current-page"></span>
                                <?php echo donald_pagination(); ?>    
                            </nav>

                            <?php // If no content, include the "No posts found" template.
                            else : ?>
                                                           
                                <h2 class="page-title"><?php esc_html_e( 'Nothing Found', 'donald' ); ?></h2>
                                
                                <div class="page-content">
                                    <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'donald' ); ?></p>
                                    <div class="widget_search">
                                        <?php get_search_form(); ?>
                                    </div>
                                </div><!-- .page-content -->
                        <?php endif; ?>                    

                    </div>
                </div>

            </div>
        </div>
    </section>
    

<?php get_footer(); ?>