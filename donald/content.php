<div <?php post_class(); ?>>
    <div class="item-post">
        <?php if ( has_post_thumbnail() ) { ?>
            <a href="<?php the_permalink(); ?>">
                <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" class="img-responsive" alt="">
            </a>
        <?php } ?>
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