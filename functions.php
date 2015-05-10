<?php

// 定义语言

add_action('after_setup_theme', 'my_theme_setup');
function my_theme_setup() {
	load_theme_textdomain('cdt', get_template_directory() . '/lang');
	add_option("SEO_keywords","博客,blog");
}

// 定义导航

register_nav_menus(array(
	'main' => __( '首页导航条','cdt' ),
));

// 定义侧边栏

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => __( 'Sidebar', 'cdt' ),
		'id' => 'cdt',
		'description' => 'Sidebar',
		'class' => '',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	)
);

// 检查更新，需要一个·服务器存放 info.json 和主题安装包。请参见 func 目录

require_once(TEMPLATEPATH . '/func/theme-update-checker.php'); 
$wpdaxue_update_checker = new ThemeUpdateChecker(
	'StartPress',
	'http://work.dimpurr.com/theme/startpress/update/info.json'
);

// 主题使用统计，如果需要。

function cdt_count() {

// Ajax 统计函数

function cdt_tjaj() { ?>
	<script type="text/javascript">
	jQuery(document).ready(function() {
		// 修改地址为服务器的 theme_tj.php 页面。请参见 func 目录
		jQuery.get("http://work.dimpurr.com/theme/theme_tj.php?theme_name=StartPress&blog_url=<?=get_bloginfo('url')?>&t=" + Math.random());
	});
	</script>
<?php };

// 统计筛选条件

$cdt_fitj = get_option('cdt_fitj');
$cdt_dayv = get_option('cdt_dayv');
$cdt_date = date('d'); 

if ($cdt_fitj == true) { 
	if($cdt_date == '01') {
		if ($cdt_dayv != true) {
			cdt_tjaj();
			update_option( 'cdt_dayv', true );
		};
	} elseif ($cdt_date != '01') {
		update_option( 'cdt_dayv', false );
	};
} else {
	cdt_tjaj();
	update_option( 'cdt_fitj', true );
};

};

// 获取博客标题

function cdt_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	$title .= get_bloginfo( 'name' );

	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( '页面 %s', 'cdt' ), max( $paged, $page ) );

	return $title;
}

add_filter( 'wp_title', 'cdt_title', 10, 2 );

// 页面导航

function cdt_pagenavi () {
	global $wp_query, $wp_rewrite;
	$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

	$pagination = array(
		'base' => @add_query_arg('paged','%#%'),
		'format' => '',
		'total' => $wp_query->max_num_pages,
		'current' => $current,
		'show_all' => false,
		'type' => 'plain',
		'end_size'=>'0',
		'mid_size'=>'5',
		'prev_text' => __('上一页','cdt'),
		'next_text' => __('下一页','cdt')
	);

	if( $wp_rewrite->using_permalinks() )
		$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg('s',get_pagenum_link(1) ) ) . 'page/%#%/', 'paged');

	if( !empty($wp_query->query_vars['s']) )
		$pagination['add_args'] = array('s'=>get_query_var('s'));

	echo paginate_links($pagination);
}

// 加载评论

if ( ! function_exists( 'cdt_comment' ) ) :
function cdt_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php echo 'Pingback '; ?> <?php comment_author_link(); ?> <?php edit_comment_link( '编辑', '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 44 );
					printf( '<div class="cmt_meta_head"><cite class="fn">%1$s',
						get_comment_author_link() );
					printf( '%1$s </cite>',
						( $comment->user_id === $post->post_author ) ? '<span class="cmt_meta_auth"> ' . __('作者','cdt') . '</span>' : '' );
					printf( '</div><span class="cmt_meta_time"><a href="%1$s"><time datetime="%2$s">%3$s</time></a></span>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						sprintf( '%1$s %2$s' , get_comment_date(), get_comment_time() )
					);
				?>
			</header>

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e('审核中','cdt'); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __('編輯','cdt'), '<span class="edit-link">', '</span>' ); ?>
				<?php delete_comment_link(get_comment_ID()); ?>
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __('回复','cdt'), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</section>

		</article>
	<?php
		break;
	endswitch;
}
endif;

// 后台设置页面

function cdt_menu_func(){   
	add_theme_page(
		__('设置','cdt'),
		__('设置','cdt'),
		'administrator',
		'cdt_menu',
		'cdt_config');
}

add_action('admin_menu', 'cdt_menu_func');

function cdt_config(){ //cdt_thtj(); ?>

<form method="post" name="cdt_form" id="cdt_form">

<h1><?php _e('主题设置'); ?></h1>
<label for="SEO_keywords">搜索引擎关键词：</label>

<input type="text" size="80" name="SEO_keywords" id="SEO_keywords" placeholder="<?php _e('SEO关键词 请用英文逗号分隔','cdt'); ?>" value="<?php echo get_option('SEO_keywords'); ?>"/>
<br>

<input type="submit" name="option_save" value="<?php _e('保存设置','cdt'); ?>" />



<?php wp_nonce_field('update-options'); ?>
<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="cdt_copy_right" />

</form>

<?php }

// 提交设置

if(isset($_POST['option_save'])){

	$SEO_keywords = stripslashes($_POST['SEO_keywords']);
	update_option( 'SEO_keywords', $SEO_keywords );
}

function emtx_excerpt_length( $length ) {
	return 150; //把92改为你需要的字数，具体就看你的模板怎么显示了。
}
add_filter( 'excerpt_length', 'emtx_excerpt_length' );


?>