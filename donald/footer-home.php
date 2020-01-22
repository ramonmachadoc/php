<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package donald
 */
?>

    <footer class="footer-home-1">
        <div class="footer-inner">
            <div class="row">
                <div class="col-md-6">
                    <?php $logo2 = donald_get_option( 'logo_footer' ) ? donald_get_option( 'logo_footer' ) : get_template_directory_uri().'/images/logo.png'; ?>
                    <a href="<?php echo esc_url( home_url('/') ); ?>" class="logo-footer">
                        <img src="<?php echo esc_url($logo2); ?>" class="img-responsive" alt="">
                    </a>
                    <?php
                        $footermenu = array(
                        'theme_location'  => 'footer',
                        'menu'            => '',
                        'container'       => '',
                        'container_class' => '',
                        'container_id'    => '',
                        'menu_class'      => 'footer-link-2 on-light',
                        'menu_id'         => '',
                        'echo'            => true,
                        'fallback_cb'     => 'donald_bootstrap_navwalker::fallback',
                        'walker'          => new donald_bootstrap_navwalker(),
                        'before'          => '',
                        'after'           => '',
                        'link_before'     => '',
                        'link_after'      => '',
                        'items_wrap'      => '<ul data-breakpoint="800" id="%1$s" class="%2$s">%3$s</ul>',
                        'depth'           => 0,
                    );
                    if ( has_nav_menu( 'footer' ) ) {
                        wp_nav_menu( $footermenu );
                    }
                    ?>
                </div>

                <div class="col-md-3">
                    <?php $socials = donald_get_option( 'fsocials', array() ); ?>
                    <?php if($socials) { ?>
                    <ul class="widget-social-list">
                        <?php foreach ( $socials as $social ) { ?>
                        <li><a href="<?php echo esc_url($social['link']); ?>" target="_blank"><i class="fa <?php echo esc_attr($social['icon']); ?>" aria-hidden="true"></i></a></li>
                        <?php } ?>
                    </ul>
                    <?php } ?>
                </div>
                <div class="col-md-3">
                    <div class="copyright">
                        <?php echo wp_kses( donald_get_option('copy_right'), wp_kses_allowed_html('post') ); ?>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</div>
<a id="to-the-top" class="fixbtt"><i class="fa fa-chevron-up"></i></a>

<?php wp_footer(); ?>

</body>
</html>
