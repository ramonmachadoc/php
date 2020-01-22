<header  id="<?php if(donald_get_option('header_trans')) echo 'header-home-2';else echo 'stick'; ?>" class="header-3 <?php if(donald_get_option('header_trans')) echo 'bg-transparent fixed'; ?>">
	<h1  class="logo">
		<?php $logo = donald_get_option( 'logo' ) ? donald_get_option( 'logo' ) : get_template_directory_uri().'/images/logo.png'; ?>
        <a href="<?php echo esc_url( home_url('/') ); ?>">
            <img src="<?php echo esc_url($logo); ?>" class="img-responsive" alt="">
        </a>
	</h1>
	<a href="#menu" class="btn-menu-mobile"><span class="lnr lnr-menu"></span></a>
	<?php $socials = donald_get_option( 'socials', array() ); ?>
    <?php if($socials) { ?>
    <ul class="widget-social-list">
        <?php foreach ( $socials as $social ) { ?>
        <li><a href="<?php echo esc_url($social['link']); ?>"><i class="fa <?php echo esc_attr($social['icon']); ?>" aria-hidden="true"></i></a></li>
        <?php } ?>
    </ul>
    <?php } ?>
</header>