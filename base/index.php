<?php
get_header();
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<article>
		<header>
			<a href="<?php the_permalink(); ?>">
				<h2><?php the_title(); ?></h2>
			</a>
		</header>
		<?php the_content(); ?>
	</article>
<?php endwhile; endif; ?>

<?php
get_footer();
?>