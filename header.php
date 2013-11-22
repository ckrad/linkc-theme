<!DOCTYPE html>
<html <?php language_attributes(); ?> >
<head>
    <meta charset="utf-8">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <?php wp_head(); ?>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/flatui/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/flatui/bootstrap/css/bootstrap-responsive.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/flatui/bootstrap/css/prettify.css">

    <!-- flatui css -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/flatui/css/flat-ui.css">
    
    <!-- 自定义样式 -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.css">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="<?php echo get_template_directory_uri(); ?>/flatui/js/html5shiv.js"></script>
    <![endif]-->
    
</head>
<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="span6">
                    <a href="<?php echo esc_url(home_url( '/')); ?>
                        " title="返回首页" id="logo">
                        <h2>link-c</h2>    
                    </a>
                </div>
                <div class="span6">
                    <?php get_search_form(); ?>
                </div>
            </div>
        </div>
    </header>

    <!-- 导航 -->
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
            
            
            <div class="navbar navbar-default navbar-fixed-top">
                <div class="navbar-header">
                    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-collapse-01"></button>
                    <a href="#" class="navbar-brand fui-flat">item-1</a>
                </div>
                <?php wp_nav_menu(array(
                    'theme_location'  =>  'primary',
                    'menu_class'      =>  'nav',
                    'container'       =>  false,
                    'walker'          =>  new linkc_Nav_Walker
                ) ); ?>
            </div>
        </div>
    </nav>