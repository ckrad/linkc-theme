<?php get_header(); ?>
<div id="main" class="container single">
	<div class="post">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<h3 class="post-title">
					<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
				</h3>
				<p class="post-excerpt"><?php the_content(); ?></p>
			<!-- <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="post-entry">
					<h1 class="post-title"><?php the_title(); ?></h1>
					<div class="post-meta">
						<a href="<?php the_permalink() ?>"><?php the_time(get_option('date_format')); ?></a> <?php _e( 'by', 'faber' ); ?> <?php the_author() ?> | <?php _e( 'Filed in', 'faber' ); ?> <?php the_category(', ') ?> | <?php comments_popup_link('No comments', '1 comment', '% comments'); ?>
					</div>
					<div class="entry">
						<?php if ( has_post_thumbnail()) : ?>
							<div class="single-thumb">
								<?php the_post_thumbnail('small-thumb', array('title' => '')); ?>
							</div>
						<?php endif; ?>
						<?php the_content(''); ?>
						<?php wp_link_pages(array('before' => '<p class="paged"><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
						<div class="post-tags"><?php the_tags(' ',' '); ?><div class="clear"></div></div>
					</div>
				</div>
			</div> -->
			<?php endwhile; ?>
			<?php endif; ?>
		</div>
	
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>

