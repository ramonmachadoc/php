<?php 
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


<?php if (have_posts()){ ?>
    <?php while (have_posts()) : the_post() ?>
        <?php the_content(); ?>
    <?php endwhile; ?>
<?php }else {
    esc_html_e('Page Canvas For Page Builder', 'donald'); 
}?>


<?php get_footer(); ?>