<?php get_header(); ?>

	<div id="main">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="post" id="post-<?php the_ID(); ?>">
			<div class="post-entry">
				<h1 class="post-title page-header"><?php the_title(); ?></h1>
				<div class="entry">
				<?php the_content(); ?>
				</div>

			</div>

		<?php comments_template(); ?>

		</div>

		<?php endwhile; endif; ?>

		</div>

<?php get_sidebar(); ?>

<div class="clear"></div>

<?php get_footer(); ?>