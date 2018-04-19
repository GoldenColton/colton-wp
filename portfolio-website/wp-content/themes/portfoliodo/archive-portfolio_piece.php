<?php get_header(); //includes header.php ?>

<main class="content">

	<h1 class="page-title" >My Work : </h1>

	<?php //The Loop Begins here
	if( have_posts() ):
		while( have_posts() ):
			the_post();
	?>
	<article <?php post_class('clearfix'); ?> >

		<a href="<?php the_permalink(); ?>" >
			<?php the_post_thumbnail( 'medium' ); ?>
		</a>

		<h2 class="entry-title"> 
			<a href="<?php the_permalink(); ?>"> 
				<?php the_title(); ?> 
			</a>
		</h2>
		
	</article>
	<!-- end .post -->

	<?php 
		endwhile;
	else:
		echo 'Timberrrrr! Nothin in the Woodworks right now';
	endif;
	// end of The Loop
	 ?>

<div class="pagination" >
	<?php cmw_pagination(); ?>
</div>

</main>
<!-- end #content -->

<?php get_sidebar('portfolio'); //includes sidebar-portfolio.php ?>

<?php get_footer(); //includes footer.php ?>