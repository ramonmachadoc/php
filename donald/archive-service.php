<?php
/**
 * The template for displaying archive service.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package donald
 */

get_header(); ?>


<?php if(donald_get_option('page_header')) { ?>
<?php $img = donald_get_option( 'page_header_bg' ) ? donald_get_option( 'page_header_bg' ) : get_template_directory_uri().'/images/bg-subheader-blog.jpg'; ?>

<!-- Subheader -->
<section class="boxed no-padding bg-img " style="background-image: url(<?php echo esc_url($img); ?>);">
    <div class="sub-header depen-on-img">
        <img src="<?php echo esc_url($img); ?>" class="img-responsive" alt="">
        <div class="sub-header-inner center-center">
            <h2><?php esc_html_e('SERVICES', 'donald'); ?></h2>   
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

<section class="boxed">
    <div class="row">
    <?php 
        $i = 1;
        if(have_posts()) : while(have_posts()) : the_post();
        $image = wp_get_attachment_url(get_post_thumbnail_id());
        $sub = get_post_meta(get_the_ID(),'_cmb_sub_serv', true);
        if( $i < 10 ){
            $j = '0'.$i;
        }
    ?>

    <article class="services-post">
        <div class="<?php if( $i%2 == 0 ) echo 'col-md-5 col-md-push-7'; else echo 'col-md-5';?> bg-image bg-image-post" style="background-image: url(<?php echo esc_url($image); ?>);">
            <img src="<?php echo esc_url($image); ?>" class="img-responsive" alt="">
        </div>
        <div class="container">
            <div class="row">   
                <div class="<?php if( $i%2 == 0 ) echo 'col-md-7 fright'; else echo 'col-md-7 col-md-push-5';?>">
                    <div class="desc">
                        <div class="title-block-number">
                            <?php if(!$count) { ?><span class="big-number"><?php echo esc_html($j); ?></span><?php } ?>
                            <div class="title-service">
                                <h2 class="title-with-sub"><?php the_title(); ?></h2>
                                <?php if($sub) { ?><span class="sub-title"><?php echo htmlspecialchars_decode($sub); ?></span><?php } ?>
                            </div>
                        </div>
                        <div class="exc-serv"><?php the_excerpt(); ?></div>
                        <a href="<?php the_permalink(); ?>" class="ot-btn border-dark mgt-30"><?php esc_html_e('Read More', 'donald'); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </article>

    <?php $i++; endwhile; endif ?>
    </div>
</section>

<?php get_footer(); ?>