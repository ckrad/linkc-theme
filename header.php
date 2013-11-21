<!DOCTYPE html>
<html <?php language_attributes(); ?>
    >
<head>
    <meta <?php bloginfo( 'charset' ) ?>
    >
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <?php wp_head(); ?>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>
    /bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>
    /style.css">
    <script src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.8.3.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/bootstrap/js/bootstrap.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/fenikso.js"></script>
</head>
<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="span6">
                    <a href="<?php echo esc_url(home_url( '/')); ?>
                        " title="返回首页" id="logo">
                        <img src="<?php echo get_template_directory_uri(); ?>    
                        /images/logo.png" alt="
                        <?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
                        <h2>link-c</h2>    
                    </a>

                </div>
                <div class="span6">
                    <?php get_search_form(); ?>
                </div>
        </div>
    </header>
    <nav id="navigation">
        <div class="container">
            <div class="navbar">
               <?php wp_nav_menu( array(
                  'theme_location'  =>  'primary',
                  'menu_class'      =>  'nav',
                  'container'       =>  false,
                  'walker'          =>  new fenikso_Nav_Walker,
                ) ); ?>   
            </div>
        </div>
    </nav>
    <!-- end #navigation --> </div>