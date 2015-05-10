<?php // 获取头部
	get_header(); ?>
<div id="main-left" class="cols">
<?php if ( have_posts() ) : ?>

	<?php while ( have_posts() ) : the_post(); ?>
			<article>
				<div class="colourbar"></div>
				<div class="article-inner">
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<div><?php the_content(__('继续阅读','cdt')); ?></div>
				</div>
					<div class="article-meta">
						<?php the_category(' ') ?>
						<a href="<?php the_author_link(); ?>"><?php the_author(); ?></a>
						<?php the_tags('',',',''); ?>
						<a href="<?php comments_link(); ?>" ><?php comments_number( __('无回复','cdt') , __('落单的回复','cdt') , __('% 回复','cdt') ); ?></a>
						<?php echo edit_post_link( __('编辑','cdt') ); ?>
					</div>

			</article>
	<?php endwhile; ?>

	<?php // 输出页码
		cdt_pagenavi(); ?>

<?php else : ?>

	<h1>404</h1>
	
<?php endif; ?>
</div>
<?php
get_sidebar();
?>

<?php // 获取尾部
	get_footer(); ?>