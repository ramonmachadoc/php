<?php 
	get_header(); 
?>

<?php
    $bg = '';
    if ( ! function_exists('rwmb_meta') ) { 
        $bg = '';
    }else{
        $images = rwmb_meta('_cmb_bg_prjheader', "type=image" ); 
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

<?php while (have_posts()): the_post(); ?>
    <?php if($bg) { ?>
    <section class="boxed no-padding bg-img" style="background-image: url(<?php echo esc_url($bg); ?>);">
        <div class="sub-header  <?php if($bg) echo 'full'; ?>">
            <div class="meta-single-post meta-single-post-2 meta-project">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="project-info">
                                <h2><?php the_title(); ?></h2>
                                <?php if(donald_get_option('breadcrumb') && function_exists('bcn_display')) { ?>   
                                    <div class="breadcrumb">
                                        <?php bcn_display(); ?>
                                    </div>
                                <?php } ?>   
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4">
                            <p><?php echo esc_html__('Date', 'donald'); ?></p>
                            <span><?php the_time( get_option( 'date_format' ) ); ?></span>
                        </div>
                        <?php 
                            $cates = get_the_terms(get_the_ID(),'categories'); 
                            $cate_name ='';
                            $cate_slug = '';
                            foreach((array)$cates as $cate){
                                if(count($cates)>0){
                                    $cate_name .= $cate->name.'<span class="space">, </span>' ;
                                    $cate_slug .= $cate->slug .' ';     
                                } 
                            }
                            if($cates){
                        ?>
                        <div class="col-md-4 col-sm-4">
                            <p><?php echo esc_html__('Category', 'donald'); ?></p>
                            <span class="cate-project"><?php echo htmlspecialchars_decode($cate_name); ?></span>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>
    
    <?php the_content(); ?>
        
<?php endwhile; ?>

    <?php if(donald_get_option('single_related')) { ?>
    <?php 
        $custom_taxterms = wp_get_object_terms( $post->ID, 'categories', array('fields' => 'ids') );
        $args = array(   
            'post_type' => 'portfolio',
            'tax_query' => array(
                            array(
                                'taxonomy' => 'categories',
                                'field' => 'id',
                                'terms' => $custom_taxterms
                            )
                        ),
            'post__not_in' => array ($post->ID),   
            'posts_per_page' => 3     
        );  
        $wp_query = new WP_Query($args); 
        if($wp_query -> have_posts()){
    ?>
    <section class="related-project">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2><?php echo esc_html__('MORE PROJECTS', 'donald'); ?></h2>
                </div>
                <div class="more-project mgt-60">
                    <?php 
                        
                        while ($wp_query -> have_posts()) : $wp_query -> the_post(); 
                        $cates = get_the_terms(get_the_ID(),'categories');
                        $cate_name ='';
                        $cate_slug = '';
                        foreach((array)$cates as $cate){
                            if(count($cates)>0){
                                $cate_name .= $cate->name.'<span>, </span>' ;
                                $cate_slug .= $cate->slug .' ';     
                            } 
                        }

                        $popup_video = get_post_meta(get_the_ID(),'_cmb_popup_video', true);
                        $image = wp_get_attachment_url(get_post_thumbnail_id());
                    ?>
                    <div class="col-md-4 col-sm-4">
                        <div class="portfolio-home2-item">
                            <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" class="img-responsive" alt="">
                            <div class="overlay">
                                <a href="<?php the_permalink(); ?>" class="btn-detail-project"><span class="lnr lnr-cross lnr-plus"></span></a>
                                <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <span class="cate-project"><?php echo htmlspecialchars_decode($cate_name); ?></span>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; wp_reset_postdata(); ?>

                </div>
            </div>
        </div>
        <div class="line-top-right w-680"></div>
    </section>
    <?php } } ?>
            
    
<?php get_footer(); ?>