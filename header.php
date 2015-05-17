<!DOCTYPE html>
<html lang="zh-cn">

<head>

<title><?php wp_title( '|', true, 'right' ); ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="author" content="CDog" />
<meta name="application-name" content="<?php bloginfo('name'); ?>"/>
<meta name="keywords" content="<?php echo get_option("SEO_keywords"); ?>"/>
<meta charset="<?php bloginfo('charset'); ?>" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url')?>" />
<link rel="alternate" type="application/rdf+xml" title="RSS 1.0" href="<?php bloginfo('rss_url')?>" />
<link rel="alternate" type="application/atom+xml" title="ATOM 1.0" href="<?php bloginfo('atom_url')?>" />

<!--[if lt IE 9]>
	<?php // IE HTML 兼容  ?>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php wp_head(); ?>
<script>inadmin=false;</script>

<?php if ( is_admin_bar_showing() ) {
	// 如果有 fiexd top 定位的元素，在这为 Admin Bar 增加 32px 顶边距
	echo '<style type="text/css" media="screen"> #float { top: 32px; } </style>' ;
	echo "<script>inadmin=true;</script>";
} ?>
<script type="text/javascript" src="http://api.hitokoto.us/rand?encode=js&charset=utf-8"></script>
</head>

<body>
<div id="page">
<header id="header" class="blog-meta" >
	<div id="main-banner" class="blog-meta" style="background-image:url(<?php bloginfo('template_url'); ?>/src/img/banner.jpg);" >
		<div id="blog-title" class="blog-meta"><h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1></div>
		<div id="blog-subtitle" class="blog-meta"><h2><?php bloginfo( 'description' ); ?></h2></div>
	</div>
	<div id="navpos"></div>
		<?php wp_nav_menu( array( 'theme_location' => 'main',
								'container' => 'nav',
								'container_class' => 'nav',
								'container_id' => 'navbar',
								'menu_class' => 'clearfix navmenu' ) ); ?>

</header>
<div id="content" class="clearfix">
