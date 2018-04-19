<?php 
// variable example
$today = date( 'l' );
$favoriteFood = 'Waffles';
$secondFavorite = 'Blueberry Pancakes';
$noFavorites = 'Jelly of the Month!';

// function example
function spank_me(){
	echo '<h1 class="ouch" >';
	echo 'Whyyyyyyyy';
	echo '</h1>';
}
function favorite_food( $tag ){
	global $favoriteFood;
	echo "<$tag>";
	echo $favoriteFood;
	echo "</$tag>";
}

// array example
$pizza = array(
	'crust' 	=> 'Rosemary Garlic',
	'sauce' 	=> 'Alfredo',
	'cheese' 	=> 'Fresh Shredded Mozzerella',
	'toppings' 	=> array( 'shredded chicken', 'artichoke hearts', 'cauliflower rice', 'havarti', ),
	'deep_dish' => false,
	'slices' 	=> 10,
);

$pizza['size'] = 'Medium';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>My Very first PHP File</title>
	<style>
		.ouch {
			color: #D23428;
		}
	</style>
</head>
<body>
	<p>Hey Baby.</p>
	<?php spank_me(); ?>

	<?php include('super_menu.php'); ?>

	<?php favorite_food( 'h1' ); ?>

	<hr />
	<?php 
	$theYear = '<h2>' . date( 'Y' ) . '</h2>';

	echo $theYear; ?>

	<?php 
	// beginner logic practice
	if( $today == 'Monday' ){
		echo "<h3>$favoriteFood</h3>";
	}elseif( $today == 'Tuesday'){
		echo "<div>no <h3>$favoriteFood</h3> only <h3>$secondFavorite</h3><div>";
	}else {
		echo $noFavorites;
	}
	?>

	<?php //work with the array
	// shoiw the value of a key
	echo $pizza['cheese'];

	// print the entire array
	echo "<pre>";
	print_r( $pizza );
	echo "</pre>";

	// example foreach loop (for each thing in an array)
	$shopping = array('milk', 'eggs', 'coffee', 'donuts', 'baked beans', 'Carrot Cake', 'Pecan Pie');

	echo "<ol>";

	foreach( $shopping as $item ){
		echo "<li> $item </li>";
	}

	echo "</ol>";

	 ?>
</body>
</html>