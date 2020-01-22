<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package donald
 */
get_header(); 

?>

<?php
    $bg = '';
    if ( ! function_exists('rwmb_meta') ) { 
        $bg = '';
    }else{
        $images = rwmb_meta('_cmb_bg_header', "type=image" ); 
        if(!$images){
             $bg = '';
        } else {
             foreach ( $images as $image ) { 
                $bg = $image['full_url']; 
                break;
            }
        }
    }
   
?>

<?php if(donald_get_option('page_header')) { ?>
<?php $img = donald_get_option( 'page_header_bg' ) ? donald_get_option( 'page_header_bg' ) : get_template_directory_uri().'/images/bg-subheader-blog.jpg'; ?>

<?php $img_src = $bg ? $bg : $img; ?>
<!-- Subheader -->
<section class="boxed no-padding bg-img " style="background-image: url(<?php echo esc_url($img_src); ?>);">
    <div class="sub-header depen-on-img">
        <img src="<?php echo esc_url($img_src); ?>" class="img-responsive" alt="">
        <div class="sub-header-inner center-center">
            <h2><?php the_title(); ?></h2>   
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
    
<section id="main-content">
    <div class="container">
        <div class="row">

            <div class="col-md-9">
                <?php while (have_posts()) : the_post(); ?>
                    <?php the_post_thumbnail() ?>
                    <article> 
                    <?php the_content(); ?>
                    </article>

                    <?php
                        wp_link_pages( array(
                            'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'donald' ) . '</span>',
                            'after'       => '</div>',
                            'link_before' => '<span>',
                            'link_after'  => '</span>',
                            'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'donald' ) . ' </span>%',
                            'separator'   => '<span class="screen-reader-text">, </span>',
                        ) );
                    ?>
                    
                    <?php
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;
                    ?>      
                <?php endwhile; ?>
                <!-- Pagination start -->
                <nav>
                    <?php echo donald_pagination(); ?>    
                </nav><!-- Pagination end -->
            </div>

            <div class="col-md-3">
                <div id="sidebar" class="main-sidebar">
                    <?php get_sidebar();?>
                </div>
            </div>

        </div>
    </div>
</section>

<?php get_footer(); ?>
