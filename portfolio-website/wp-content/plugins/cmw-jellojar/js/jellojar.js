//use a noconflict wrapper to redefine $

jQuery( document ).ready( function( $ ){
//code in here can use $

	$('#jello-jar-bar .dismiss').click( function(){
		$('#jello-jar-bar').fadeOut();
	} );

} );