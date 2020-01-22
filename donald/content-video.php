<?php $link_video = get_post_meta(get_the_ID(),'_cmb_link_video', true); ?>

<div <?php post_class(); ?>>
    <div class="item-post">
        <div class="embed-responsive embed-responsive-16by9">
            <iframe width="420" height="315" src="<?php echo esc_url( $link_video ); ?>"></iframe>
        </div>
        <div class="desc">
            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
            <div class="meta">
                <span class="meta-date"><?php the_time( get_option( 'date_format' ) ); ?></span><span class="meta-author"> - <?php echo esc_html__('by ', 'donald'); ?> <?php the_author_posts_link(); ?> </span><span class="meta-cate"><?php if(has_category()) { echo esc_html__(' - in ', 'donald'); the_category( ', ' ); } ?></span>
            </div>
            <p><?php echo donald_excerpt_length(); ?></p>
            <a href="<?php the_permalink(); ?>" class="ot-btn border-dark"><?php esc_html_e('Read More', 'donald'); ?></a>
        </div>
    </div>
</div>