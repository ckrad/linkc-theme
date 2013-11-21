<?php get_header(); ?>
<div id="main-content">
	<div class="container">
		<?php if(have_posts()) : ?>
			<div class="posts">
				<?php  while(have_posts()) : the_post(); ?>
					<div class="post">
						<h3 class="post-title">
							<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
						</h3>
						<p class="post-excerpt"><?php the_excerpt(); ?></p>
					</div>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>
	</div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>