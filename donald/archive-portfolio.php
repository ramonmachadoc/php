<?php
/**
 * The template for displaying archive portfolio.
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
            <h2><?php esc_html_e('PORTFOLIO', 'donald'); ?></h2>   
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
	<div class="ot-projects">

		<?php if(!$filter) { ?>
		<div class="projectFilter text-center">
	        <a href="#" data-filter="*" class="current "><?php esc_html_e('ALL', 'donald'); ?></a>
	            <?php 
	  			$categories = get_terms('categories');
	   			foreach( (array)$categories as $categorie){
	    			$cat_name = $categorie->name;
	    			$cat_slug = $categorie->slug;
			?>
	      	<a href="#" data-filter=".<?php echo htmlspecialchars_decode( $cat_slug ); ?>"><?php echo htmlspecialchars_decode( $cat_name ); ?></a>
	    	<?php } ?>
			</div>
		<?php } ?>

		<div class="list-portfolio-warp">
			<?php 
	  			$args = array(   
	    			'post_type' => 'portfolio',   
	    			'posts_per_page' => -1,	            
	  			);  
	  			$wp_query = new WP_Query($args);
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
			<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 element-item <?php echo esc_attr($cate_slug); ?> <?php if($gutter) echo 'no-guter'; ?>">
	            
				<div class="portfolio-home2-item">
					<img src="<?php echo esc_url($image); ?>" class="img-responsive" alt="">
					<div class="overlay">
						<?php if($popup_video && $popup) { ?>
	        			<a class="popup-youtube btn-detail-project" href="<?php echo esc_url($popup_video); ?>"><span class="lnr lnr-film-play"></span></a>
	        			<?php }else{ ?>
						<a href="<?php the_permalink(); ?>" class="btn-detail-project"><span class="lnr lnr-cross lnr-plus"></span></a>
						<?php } ?>
						<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
						<?php if(!$categ && $cates) { ?><span class="cate-project"><?php echo htmlspecialchars_decode($cate_name); ?></span><?php } ?>
					</div>
				</div>
	            
	      	</div>
	      	<?php endwhile; wp_reset_postdata(); ?>
	    </div>
	</div>
</section>

<?php get_footer(); ?>