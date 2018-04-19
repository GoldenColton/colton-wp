<aside class="sidebar" >
	<section class="widget" >
		<h3>Filter My Portfolio : </h3>
		<ul>
			<?php 
			//display all termss
			wp_list_categories( array(
				'taxonomy' => 'type_of_work',
				'title_li' => '',
			) ); ?>
		</ul>
	</section>
</aside>