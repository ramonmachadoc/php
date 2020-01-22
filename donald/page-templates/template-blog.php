<?php
/**
 * Template Name: Blog
 */

get_header(); ?>
    
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
<!-- Main Content -->
<section>
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="blog-list">

                    <?php 
                        $args = array(    
                            'paged' => $paged,
                            'post_type' => 'post',
                        );
                        $wp_query = new WP_Query($args);
                        if( have_posts() ) : 
                        while ($wp_query -> have_posts()): $wp_query -> the_post();                         
                        $format = get_post_format(); 
                    ?>
                    <?php 
                        
                        get_template_part( 'content', get_post_format() ) ;   // End the loop.
                        
                    ?>

                    <?php endwhile; ?>
                    
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
