<?php get_header(); //includes header.php ?>

<main class="content">

	<?php //The Loop Begins here
	if( have_posts() ):
		while( have_posts() ):
			the_post();
	?>
	<article class="post">
		<h2 class="entry-title"> 
			<a href="<?php the_permalink(); ?>"> 
				<?php the_title(); ?> 
			</a>
		</h2>
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
		
	</article>
	<!-- end .post -->

	<?php 
		endwhile;
	else:
		echo 'Timberrrrr! Nothin in the Woodworks right now';
	endif;
	// end of The Loop
	 ?>

</main>
<!-- end #content -->

<?php get_sidebar(); //includes sidebar.php ?>

<?php get_footer(); //includes footer.php ?>