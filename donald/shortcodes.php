<?php 

// Icon box
add_shortcode('servicesbox', 'servicesbox_func');
function servicesbox_func($atts, $content = null){
	extract(shortcode_atts(array(
		'icon'		=>	'',
		'image'		=>	'',
		'title'		=>	'',	
		'style'		=>	'',
	), $atts));
		$style1 = (!empty($style) ? $style : 'style1');
		$img = wp_get_attachment_image_src($image,'full');
		$img = $img[0];
	ob_start(); ?>

	<?php if($style1 == 'style1'){ ?>
		<div class="icon-box-block">
			<?php if($image) { ?>
				<img src="<?php echo esc_url($img); ?>" class="img-responsive" alt="">
			<?php } ?>
			<?php if($icon && !$image) { ?>
				<i class="<?php echo esc_attr($icon); ?> color-theme" aria-hidden="true"></i>
			<?php } ?>
			<h5><?php echo htmlspecialchars_decode($title); ?></h5>
			<?php if($content){ ?><p><?php echo htmlspecialchars_decode($content); ?></p><?php } ?>
		</div>
	<?php }elseif($style1=='style2'){ ?>
        <div class="icon-box-inline">
			<?php if($image) { ?>
				<img src="<?php echo esc_url($img); ?>" class="img-responsive" alt="">
			<?php } ?>
			<?php if($icon && !$image) { ?>
				<i class="<?php echo esc_attr($icon); ?> color-theme" aria-hidden="true"></i>
			<?php } ?>
			<h5><?php echo htmlspecialchars_decode($title); ?></h5>
			<?php if($content){ ?><p><?php echo htmlspecialchars_decode($content); ?></p><?php } ?>
		</div>
    <?php }?>
    	
<?php
    return ob_get_clean();
}

// Button
add_shortcode('otbutton','otbutton_func');
function otbutton_func($atts, $content = null){
	extract(shortcode_atts(array(
		'btn'		=>	'',
		'icon'		=>	'',
		'size'		=>	'',
		'style'		=>	'',
		'bg'		=>	'btn-main-color',
	), $atts));
		$url 	= vc_build_link( $btn );
		$icon1 = '';
		if($icon){
			$icon1 = ' <i class="'.$icon.'"></i>';
		}
	ob_start(); 
?>

    <?php if ( strlen( $btn ) > 0 && strlen( $url['url'] ) > 0 ) {
		echo '<a class="ot-btn'. esc_attr(' '.$size) . esc_attr(' '.$style). esc_attr(' '.$bg). '" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ). $icon1 .'</a>';
	} ?>
  	
<?php
    return ob_get_clean();
}

// Year Exp
add_shortcode('yearexp','yearexp_func');
function yearexp_func($atts, $content = null){
	extract(shortcode_atts(array(
		'btext'		=>	'',
		'title'		=>	'',
		'stitle'	=>	'',
	), $atts));

	ob_start(); 
?>

    <div class="experience-year ey1">
		<span><?php echo esc_html($btext); ?></span>
		<div class="des-text">
			<strong><?php echo htmlspecialchars_decode($title); ?></strong>
			<?php if($stitle) { ?><p><?php echo htmlspecialchars_decode($stitle); ?></p><?php } ?>
		</div>
	</div>
  	
<?php
    return ob_get_clean();
}


// Member Team
add_shortcode('member','member_func');
function member_func($atts, $content = null){
	extract(shortcode_atts(array(
		'photo'		=>	'',
		'name'		=>	'',
		'job'		=>	'',
		'social1'	=>	'',
		'social2'	=>	'',
		'social3'	=>	'',
		'social4'	=>	'',
	), $atts));
		$img = wp_get_attachment_image_src($photo,'full');
		$img = $img[0];
		$url 	= vc_build_link( $social1 );
		$url2 	= vc_build_link( $social2 );
		$url3 	= vc_build_link( $social3 );
		$url4 	= vc_build_link( $social4 );
	ob_start(); 
?>
	
	<div class="item-team text-center">
		<img src="<?php echo esc_url($img); ?>" class="img-responsive" alt="">
		<h5><?php echo htmlspecialchars_decode($name); ?></h5>
		<span><?php echo htmlspecialchars_decode($job); ?></span>
		<div class="team-social-warp">
    		<?php if ( strlen( $social1 ) > 0 && strlen( $url['url'] ) > 0 ) {
				echo '<a class="color-theme" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '"><i class="fa '. esc_attr( $url['title'] ).'" aria-hidden="true"></i></a>';
			} ?>
			<?php if ( strlen( $social2 ) > 0 && strlen( $url2['url'] ) > 0 ) {
				echo '<a class="color-theme" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url2['target'] ) > 0 ? esc_attr( $url2['target'] ) : '_self' ) . '"><i class="fa '. esc_attr( $url2['title'] ).'" aria-hidden="true"></i></a>';
			} ?>
			<?php if ( strlen( $social3 ) > 0 && strlen( $url3['url'] ) > 0 ) {
				echo '<a class="color-theme" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url3['target'] ) > 0 ? esc_attr( $url3['target'] ) : '_self' ) . '"><i class="fa '. esc_attr( $url3['title'] ).'" aria-hidden="true"></i></a>';
			} ?>
			<?php if ( strlen( $social4 ) > 0 && strlen( $url4['url'] ) > 0 ) {
				echo '<a class="color-theme" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url4['target'] ) > 0 ? esc_attr( $url4['target'] ) : '_self' ) . '"><i class="fa '. esc_attr( $url4['title'] ).'" aria-hidden="true"></i></a>';
			} ?>
    	</div>
	</div>

<?php
    return ob_get_clean();
}


// List Services
add_shortcode('listserv','listserv_func');
function listserv_func($atts, $content = null){
	extract(shortcode_atts(array(
		'num'		=>	'',
		'count'		=>	'',
		'btn'		=>	'Read More',
	), $atts));
	ob_start(); 
?>

	<?php			
		$args = array(
			'post_type' => 'service',
			'posts_per_page' => $num,
		);
		$serv = new WP_Query($args);
		$i = 1;
		if($serv->have_posts()) : while($serv->have_posts()) : $serv->the_post();
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
						<a href="<?php the_permalink(); ?>" class="ot-btn border-dark mgt-30"><?php echo esc_html($btn); ?></a>
					</div>
				</div>
			</div>
		</div>
	</article>

	<?php $i++; endwhile; endif ?>
  	
<?php
    return ob_get_clean();
}


// Testimonial Silder
add_shortcode('testslide','testslide_func');
function testslide_func($atts, $content = null){
	extract(shortcode_atts(array(
		'speed'		=>	'6000',
		'style'		=>	'style1',
	), $atts));

	ob_start(); 
?>

	<?php if($style == 'style1') { ?>
	<div class="customNavigation">
        <a class="btn-1 prev prev-testimonial-h1"><span class="lnr lnr-chevron-left-circle"></span></a>
        <a class="btn-1 next next-testimonial-h1"><span class="lnr lnr-chevron-right-circle"></span></a>
	</div><!-- End owl button -->
	<div id="testimonial-1" class="owl-testimonial-1">
		<?php			
			$args = array(
				'post_type' => 'testimonial',
				'posts_per_page' => -1,
			);
			$testimonial = new WP_Query($args);
			while($testimonial->have_posts()) : $testimonial->the_post();
			$image = wp_get_attachment_url(get_post_thumbnail_id());
			$job = get_post_meta(get_the_ID(),'_cmb_job_testi', true);
			$btext = get_post_meta(get_the_ID(),'_cmb_btext', true);
		?>
		<div class="item-testimonial-1 text-center">
			<h2><?php echo htmlspecialchars_decode($btext); ?></h2>
			<?php the_content(); ?>
			<div class="info">
				<strong><?php the_title(); ?></strong><span><?php if($job) echo esc_html($job); ?></span>
			</div>
			
		</div>
		<?php endwhile; wp_reset_postdata(); ?>
	</div>
	
	<script>
		(function($) { "use strict";
			var owltestimonial1 = $("#testimonial-1").owlCarousel({
                autoplay: true,
	            autoplayTimeout: <?php echo esc_js($speed); ?>,
                items : 1,
                loop:true,
                dots:false,
                nav:false,
                animateOut: 'fadeOut',
                animateIn: 'fadeIn',
               
            });
        
	        $("body").on("click",".next-testimonial-h1",function(event){
	          owltestimonial1.trigger("next.owl.carousel");
	        });
	        $("body").on("click",".prev-testimonial-h1",function(event){
	          owltestimonial1.trigger("prev.owl.carousel");
	        }); 

		})(jQuery); 
	</script>

	<?php }else{ ?>
		<div id="testimonial-2" class="owl-testimonial-2 owl-page-top-right">
			<?php			
				$args = array(
					'post_type' => 'testimonial',
					'posts_per_page' => -1,
				);
				$testimonial = new WP_Query($args);
				while($testimonial->have_posts()) : $testimonial->the_post();
				$image = wp_get_attachment_url(get_post_thumbnail_id());
				$job = get_post_meta(get_the_ID(),'_cmb_job_testi', true);
			?>
			<div class="item-testimonial-2 ">
				<img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" class="img-responsive" alt="">
				<div class="info">
					<?php the_content(); ?>
					<span><?php the_title(); ?></span>
				</div>
			</div>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>

		<script>
			(function($) { "use strict";
				$("#testimonial-2").owlCarousel({
		            autoplay: true, 
	            	autoplayTimeout: <?php echo esc_js($speed); ?>,
		            loop:true,
		            items : 1,
		            dots:true,
		            nav:false,
		            animateOut: 'fadeOut',
		            animateIn: 'fadeIn',
		        });
			})(jQuery); 
		</script>
	<?php } ?>

<?php
    return ob_get_clean();
}


// Call To Action
add_shortcode('call_to', 'call_to_func');
function call_to_func($atts, $content = null){
	extract(shortcode_atts(array(
		'title'		=>	'',
		'linkbox'	=>	'',
		'light'		=>	'',
	), $atts));
		$url 	= vc_build_link( $linkbox );
	ob_start(); ?>

	<div class="footer-portfolio <?php if($light) echo 'light';?>">
		<p><?php echo htmlspecialchars_decode($title); ?></p>
		<?php if ( strlen( $linkbox ) > 0 && strlen( $url['url'] ) > 0 ) {
			echo '<a class="ot-btn border-dark" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ).'</a>';
		} ?>
	</div>	

<?php
    return ob_get_clean();
}


// Lastest Blog
add_shortcode('lastest_blog','lastest_blog_func');
function lastest_blog_func($atts, $content = null){
	extract(shortcode_atts(array(
		'date'		=>	'',
		'exc'		=>	'',
		'number'	=>	'3',
	), $atts));

	$col = 'col-sm-4';
	if($number == 2 ){
		$col = 'col-sm-6';
	}elseif($number == 4){
		$col = 'col-md-3 col-sm-6';
	}

	ob_start(); 
?>

	<?php		
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => $number,
		);
		$blogpost = new WP_Query($args);
		if($blogpost->have_posts()) : while($blogpost->have_posts()) : $blogpost->the_post();
		$format = get_post_format();
	?>
	<div class="<?php echo esc_attr($col); ?>">
		<div class="item-latest-post">
			<?php if ( has_post_thumbnail() ) { ?>
		    	<?php 
	                $params = array( 'width' => 700, 'height' => 470, 'crop' => true );
	                $image = bfi_thumb( wp_get_attachment_url(get_post_thumbnail_id()), $params );  
	            ?>
		        <a href="<?php the_permalink(); ?>">
		            <img src="<?php echo esc_url($image); ?>" class="img-responsive" alt="">
		        </a>
		    <?php } ?>
			<div class="desc">
				<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
				<?php if(!$date) { ?><p class="date-post"><?php the_time( get_option( 'date_format' ) ); ?></p><?php } ?>
				<?php if(!$exc) { ?><p class="exc-post"><?php echo donald_excerpt(14); ?></p><?php } ?>
			</div>
		</div>
	</div>

	<?php endwhile; wp_reset_postdata(); endif; ?>

<?php
    return ob_get_clean();
}

// Portfolio Filter
add_shortcode('portfoliof', 'portfoliof_func');
function portfoliof_func($atts, $content = null){
	extract(shortcode_atts(array(
		'all'		=> 	'ALL',
		'num'		=> 	'12',
		'col'   	=> 	'4',
		'popup'		=>	'',
		'gutter'	=>	'',
		'filter'	=>	'',
		'categ'		=>	'',		
	), $atts));

	ob_start(); ?>

	<div class="ot-projects">

		<?php if(!$filter) { ?>
		<div class="projectFilter text-center">
            <a href="#" data-filter="*" class="current "><?php echo esc_html($all); ?></a>
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

		<div class="list-portfolio-warp <?php if($gutter) echo 'no-guter'; ?>">
			<?php 
      			$args = array(   
        			'post_type' => 'portfolio',   
        			'posts_per_page' => $num,	            
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
			<div class="col-lg-<?php echo esc_attr($col); ?> col-md-4 col-sm-6 col-xs-12 element-item <?php echo esc_attr($cate_slug); ?>">
	            
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

<?php
    return ob_get_clean();
}


// Portfolio Slider
add_shortcode('portfolio_sli','portfolio_sli_func');
function portfolio_sli_func($atts, $content = null){
	extract(shortcode_atts(array(
		'number'	=>	'6',
		'btn'		=>	'View Project',
		'all'		=>	'View All',
		'link'		=>	'',
		'top'		=>	'',
		'speed'		=>	'6000',
	), $atts));
	ob_start(); 
?>
	<div class="relative">
		<div id="portfolio-h1" class="owl-portfolio-h1 owl-page-h">
			<?php 
	  			$args = array(   
	    			'post_type' => 'portfolio',
	    			'posts_per_page' => $number,	            
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

	  			$exc = get_post_meta(get_the_ID(),'_cmb_exc_slider', true);
			?>
			<div class="portfolio-h1-item row">
				<div class="col-md-6">
					<a href="<?php the_permalink(); ?>">
			        <?php if( function_exists( 'rwmb_meta' ) ) { ?>
			            <?php $images = rwmb_meta( '_cmb_image_slider', "type=image" ); ?>
			            <?php if($images){ ?>              
			                <?php  foreach ( $images as $image ) {  ?>
			                    <?php $img = $image['full_url']; ?>
			                    <img src="<?php echo esc_url($img); ?>" class="img-responsive" alt="">
			                <?php } ?>                
			            <?php } ?>
			        <?php } ?>
			        </a>
				</div>
				<div class="col-md-6">
					<div class="portfolio-des">
						<span class="color-theme"><?php echo htmlspecialchars_decode($cate_name); ?></span>
						<h3><?php the_title(); ?></h3>
						<p><?php  echo htmlspecialchars_decode($exc); ?></p>
						<a href="<?php the_permalink(); ?>" class="ot-btn btn-style-2"><?php echo esc_html($btn); ?></a>
					</div>
				</div>
			</div>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
		<?php if($link) { ?>
		<div class="outter-btn" style="top: <?php echo esc_attr($top); ?>">
			<a href="<?php echo esc_url($link); ?>" class="ot-btn border-dark"><?php echo esc_html($all); ?></a>
		</div>
		<?php } ?>
	</div>

  	<script>
		(function($) { "use strict";
			
			$("#portfolio-h1").owlCarousel({
	            autoplay: true,
	            autoplayTimeout: <?php echo esc_js($speed); ?>,
	            loop:true,
	            items : 1,
	            dots:true,
	            nav:false,
	            animateOut: 'fadeOut',
	            animateIn: 'fadeIn',
	        });

		})(jQuery); 
	</script>

<?php
    return ob_get_clean();
}


// Our Facts
add_shortcode('facts','facts_func');
function facts_func($atts, $content = null){
	extract(shortcode_atts(array(
		'num'		=>	'',
		'title'		=>	'',
	), $atts));
		
	ob_start(); 
?>

	<div class="counter-block">
		<span class="counter"><?php echo esc_html($num); ?></span>
		<p><?php echo htmlspecialchars_decode($title); ?></p>
	</div>
  	
<?php
    return ob_get_clean();
}



// Logo Clients
add_shortcode('clients','clients_func');
function clients_func($atts, $content = null){
	extract(shortcode_atts(array(
		'gallery'		=> 	'',
		'speed'		  	=>	'6000',	
		'num'		  	=>	'6',	
	), $atts));
		$img = wp_get_attachment_image_src($gallery,'full');
		$img = $img[0];
		$id = uniqid( 'partner-' );
	ob_start(); ?>

        <div id="<?php echo esc_attr($id); ?>" class="owl-partner">
        	<?php 
				$img_ids = explode(",",$gallery);
				foreach( $img_ids AS $img_id ){
				$meta = wp_prepare_attachment_for_js($img_id);
				$caption = $meta['caption'];
				$title = $meta['title'];	
				$description = $meta['description'];
				$image_src = wp_get_attachment_image_src($img_id,''); 
			?>
			<div class="partner-item">
				<?php if($caption){ ?><a href="<?php echo esc_url($caption); ?>" target="_blank" ><?php } ?>
            		<img src="<?php echo esc_url( $image_src[0] ); ?>" alt="">
            	<?php if($caption){ ?></a><?php } ?>
			</div>
			<?php } ?>
		</div>

		<script>
			(function($) { "use strict";	

				$( "#<?php echo esc_js($id); ?>" ).owlCarousel({

    				autoplay: true,
	            	autoplayTimeout: <?php echo esc_js($speed); ?>,
		            items : <?php echo esc_js($num); ?>,
		            responsiveClass:true,
		            responsive : {
		            // breakpoint from 0 up
		            0 : {
		               items:1,
		            },
		            // breakpoint from 480 up
		            480 : {
		               items:1,
		            },
		            // breakpoint from 768 up
		            768 : {
		                items:3,
		            },
		            992 : {
		                items:3,
		            },
		            1440 : {
		                items:<?php echo esc_js($num); ?> - 1,
		            },
		            1920 : {
		                items:<?php echo esc_js($num); ?>,
		            }
		        },
		            dots:false,
		            nav:false,
		            animateOut: 'fadeOut',
		            animateIn: 'fadeIn',
		        }); 

			})(jQuery); 
		</script>

<?php
    return ob_get_clean();	
}

// Contact Info
add_shortcode('ctinfo','ctinfo_func');
function ctinfo_func($atts, $content = null){
	extract(shortcode_atts(array(
		'icon'	=>	'',
		'image'	=>	'',
		'title'	=>	'',
	), $atts));
	$img = wp_get_attachment_image_src($image,'full');
	$img = $img[0];	
	ob_start(); 
?>
	<div class="icon-box-contact">
		<?php if($icon) { ?>
		<i class="<?php echo esc_attr($icon); ?>"></i>
		<?php }elseif($img){ ?>
		<img src="<?php echo esc_url($img); ?>" class="img-responsive" alt="">
		<?php } ?>
		<label><?php echo htmlspecialchars_decode($title); ?></label>
		<?php echo htmlspecialchars_decode($content); ?>
	</div>

<?php
    return ob_get_clean();
}


//Google Map

add_shortcode('maps','maps_func');
function maps_func($atts, $content = null){
	extract(shortcode_atts(array(
		'height'	 	 => '480px',
		'imgmap'	 	 => '',
		'tooltip'	 	 => '',
		'latitude'		 => '',
		'longitude'	 	 => '',
		'zoom'		 	 => '',
	), $atts));
	$id = 'map-canvas-'.(rand(10,10000));
	ob_start(); ?>
	<?php 
		$img = wp_get_attachment_image_src($imgmap,'full');
		$img = $img[0];
		if(!$zoom){
			$zoom = 10;
		}
	 ?>

	<div id="<?php echo esc_attr($id); ?>" class="map-warp" style="<?php if($height) echo 'height: '.esc_attr($height).';';?>"></div>

	<script>
	(function($) { "use strict";
    
	    //set your google maps parameters

	    $(document).ready(function(){
	        var latitude = <?php echo esc_js($latitude); ?>,
	            longitude = <?php echo esc_js($longitude); ?>,
	            map_zoom = <?php echo esc_js($zoom); ?>;

	        var locations = [
	            ['<div class="infobox"><?php echo esc_js($tooltip); ?></div>'

	            , latitude, longitude, 2]
	        ];
	    
	        var map = new google.maps.Map(document.getElementById('<?php echo esc_attr($id); ?>'), {
	            zoom: map_zoom,
	            scrollwheel: false,
	            navigationControl: true,
	            mapTypeControl: false,
	            scaleControl: false,
	            draggable: true,
	            styles: [
	            {
	                "featureType": "water",
	                "elementType": "geometry",
	                "stylers": [
	                    {
	                        "color": "#e9e9e9"
	                    },
	                    {
	                        "lightness": 17
	                    }
	                ]
	            },
	            {
	                "featureType": "landscape",
	                "elementType": "geometry",
	                "stylers": [
	                    {
	                        "color": "#f5f5f5"
	                    },
	                    {
	                        "lightness": 20
	                    }
	                ]
	            },
	            {
	                "featureType": "road.highway",
	                "elementType": "geometry.fill",
	                "stylers": [
	                    {
	                        "color": "#ffffff"
	                    },
	                    {
	                        "lightness": 17
	                    }
	                ]
	            },
	            {
	                "featureType": "road.highway",
	                "elementType": "geometry.stroke",
	                "stylers": [
	                    {
	                        "color": "#ffffff"
	                    },
	                    {
	                        "lightness": 29
	                    },
	                    {
	                        "weight": 0.2
	                    }
	                ]
	            },
	            {
	                "featureType": "road.arterial",
	                "elementType": "geometry",
	                "stylers": [
	                    {
	                        "color": "#ffffff"
	                    },
	                    {
	                        "lightness": 18
	                    }
	                ]
	            },
	            {
	                "featureType": "road.local",
	                "elementType": "geometry",
	                "stylers": [
	                    {
	                        "color": "#ffffff"
	                    },
	                    {
	                        "lightness": 16
	                    }
	                ]
	            },
	            {
	                "featureType": "poi",
	                "elementType": "geometry",
	                "stylers": [
	                    {
	                        "color": "#f5f5f5"
	                    },
	                    {
	                        "lightness": 21
	                    }
	                ]
	            },
	            {
	                "featureType": "poi.park",
	                "elementType": "geometry",
	                "stylers": [
	                    {
	                        "color": "#dedede"
	                    },
	                    {
	                        "lightness": 21
	                    }
	                ]
	            },
	            {
	                "elementType": "labels.text.stroke",
	                "stylers": [
	                    {
	                        "visibility": "on"
	                    },
	                    {
	                        "color": "#ffffff"
	                    },
	                    {
	                        "lightness": 16
	                    }
	                ]
	            },
	            {
	                "elementType": "labels.text.fill",
	                "stylers": [
	                    {
	                        "saturation": 36
	                    },
	                    {
	                        "color": "#333333"
	                    },
	                    {
	                        "lightness": 40
	                    }
	                ]
	            },
	            {
	                "elementType": "labels.icon",
	                "stylers": [
	                    {
	                        "visibility": "off"
	                    }
	                ]
	            },
	            {
	                "featureType": "transit",
	                "elementType": "geometry",
	                "stylers": [
	                    {
	                        "color": "#f2f2f2"
	                    },
	                    {
	                        "lightness": 19
	                    }
	                ]
	            },
	            {
	                "featureType": "administrative",
	                "elementType": "geometry.fill",
	                "stylers": [
	                    {
	                        "color": "#fefefe"
	                    },
	                    {
	                        "lightness": 20
	                    }
	                ]
	            },
	            {
	                "featureType": "administrative",
	                "elementType": "geometry.stroke",
	                "stylers": [
	                    {
	                        "color": "#fefefe"
	                    },
	                    {
	                        "lightness": 17
	                    },
	                    {
	                        "weight": 1.2
	                    }
	                ]
	            }
	        ],
	            center: new google.maps.LatLng(latitude, longitude),
	          mapTypeId: google.maps.MapTypeId.ROADMAP
	        });
	    
	        var infowindow = new google.maps.InfoWindow();
	    
	        var marker, i;
	    
	        for (i = 0; i < locations.length; i++) {  
	      
	            marker = new google.maps.Marker({ 
	                position: new google.maps.LatLng(locations[i][1], locations[i][2]), 
	                map: map,
	                icon: '<?php echo esc_js($img); ?>'
	            });
	        
	          google.maps.event.addListener(marker, 'click', (function(marker, i) {
	            return function() {
	              infowindow.setContent(locations[i][0]);
	              infowindow.open(map, marker);
	            }
	          })(marker, i));
	        }
	        
	    });

	})(jQuery); 

	</script>

	<?php

    return ob_get_clean();

}