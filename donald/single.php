<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package donald
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
<?php while (have_posts()): the_post(); ?>
<div class="meta-single-post boxed">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="author-post">
                    <?php echo get_avatar( get_the_author_meta( 'ID' ) ); ?>
                    <p><?php echo esc_html__('written by', 'donald'); ?></p>
                    <?php the_author_posts_link(); ?>
                </div>
            </div>
            <div class="col-md-2 col-sm-4">
                <p><?php echo esc_html__('Date', 'donald'); ?></p>
                <span><?php the_time( get_option( 'date_format' ) ); ?></span>
            </div>
            <?php if(has_category()) { ?>
            <div class="col-md-2 col-sm-4">
                <p><?php echo esc_html__('Category', 'donald'); ?></p>
                <?php the_category(', ', '') ?>
            </div>
            <?php } ?>
            <?php if(has_tag()) { ?>
            <div class="col-md-3 col-sm-4">
                <p><?php echo esc_html__('Tags', 'donald'); ?></p>
                <?php the_tags('', ', ') ?>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
    <!-- Main Content -->
    <section id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="single-blog" class="single-blog-warp">
                        <?php                                                     
                            $format = get_post_format();
                            $link_video = get_post_meta(get_the_ID(),'_cmb_link_video', true);
                            $link_audio = get_post_meta(get_the_ID(),'_cmb_link_audio', true);
                        ?>
                        <div class="item-blog">
                            <div class="blog-feature-warp <?php if($format == '') echo 'hide';?>">
                                <?php if($format == 'video') {  ?>
                                    <div class="embed-responsive embed-responsive-16by9">

                                        <iframe class="embed-responsive-item" src="<?php echo esc_url($link_video); ?>"></iframe>

                                    </div>
                                <?php }elseif($format == 'audio') { ?>
                                    <iframe style="width:100%" src="<?php echo esc_url($link_audio); ?>"></iframe>
                                <?php }elseif($format == 'gallery') { ?>
                                    <div class="gallery-blog-post-warp">
                                        <div id="owl-gallery-blog-post" class="owl-carousel owl-theme owl-gallery-blog-post ">
                                        <?php if( function_exists( 'rwmb_meta' ) ) { ?>
                                            <?php $images = rwmb_meta( '_cmb_images', "type=image" ); ?>
                                            <?php if($images){ ?>              
                                                <?php  foreach ( $images as $image ) {  ?>
                                                    <?php $img = $image['full_url']; ?>
                                                    <div class="item"><img src="<?php echo esc_url($img); ?>" alt=""></div>
                                                <?php } ?>                
                                            <?php } ?>
                                        <?php } ?>
                                        </div>
                                    </div>
                                <?php }elseif($format == 'image') { ?>
                                    <a href="<?php the_permalink(); ?>">
                                    <?php if( function_exists( 'rwmb_meta' ) ) { ?>
                                        <?php $images = rwmb_meta( '_cmb_image', "type=image" ); ?>
                                        <?php if($images){ ?>              
                                            <?php  foreach ( $images as $image ) {  ?>
                                                <?php $img = $image['full_url']; ?>
                                                <img src="<?php echo esc_url($img); ?>" class="img-responsive" alt="">
                                            <?php } ?>                
                                        <?php } ?>
                                    <?php } ?>
                                    </a>

                                <?php } ?>
                            </div>
                            <div class="blog-feature-content single-feature-blog">
                                <div class="blog-feature-content-inner">
                                    <div class="blog-text">
                                        <?php the_content(); ?>
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
                                    </div>
                                </div>                                
                            </div>
                            
                        </div>
                        
                    </div>

                    <?php 
                        the_post_navigation( array(
                          'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next Article <i class="fa fa-angle-right"></i>', 'donald' ) . '</span> ' .
                            '<span class="screen-reader-text">' . esc_html__( 'Next Article:', 'donald' ) . '</span> ',
                          'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( '<i class="fa fa-angle-left"></i> Previous Article', 'donald' ) . '</span> ' .
                            '<span class="screen-reader-text">' . esc_html__( 'Previous Article:', 'donald' ) . '</span> ',
                        ) ); 
                    ?>
                    <?php if(donald_get_option('single_related')) { ?>
                    <div class="relate-post">
                        <h3><?php echo esc_html__('RELATED POSTS', 'donald'); ?></h3>
                        <div class="row">
                            <?php $related = get_posts( array( 'category__in' => wp_get_post_categories($post->ID), 'numberposts' => 3, 'post__not_in' => array($post->ID) ) );
                            
                            if( $related ) foreach( $related as $post ) {
                            setup_postdata($post); ?>

                            <div class="col-sm-4">
                                <div class="item-latest-post">
                                    <?php if(has_post_thumbnail()) { ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" class="img-responsive" alt="">
                                    </a>
                                    <?php } ?>
                                    <div class="desc">
                                        <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                        <p class="date-post"><?php the_time( get_option( 'date_format' ) ); ?></p>
                                    </div>
                                </div>
                            </div>

                            <?php } wp_reset_postdata(); ?>
                        </div>
                    </div>
                    <?php } ?>

                    <div class="comment-area">
                    <?php
                       if ( comments_open() || get_comments_number() ) :
                        comments_template();
                       endif;
                    ?>
                    </div>

                </div>

            </div>
        </div>
    </section>

<?php endwhile; ?>
    
<?php get_footer(); ?>