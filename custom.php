<?php
/* Add Your Custom PHP Below This Line
---------------------------------------------------------------- */

// Enqueue Fonts
//add_action( 'wp_enqueue_scripts', 'opensky_enqueue_scripts_fonts' );
function opensky_enqueue_scripts_fonts() {
	wp_enqueue_style( 'opensky-fonts', '//fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i', array(), CHILD_THEME_VERSION );
}
// Add a new GOOGLE font to GeneratePress 
// https://docs.generatepress.com/article/customizing-the-google-font-list/
//add_filter( 'generate_typography_customize_list', 'opensky_add_google_fonts' );
function opensky_add_google_fonts( $fonts ) {
	$fonts[ 'montserrat' ] = array( 
		'name' => 'Montserrat',
		'variants' => array( '400', '400i', '700', '700i' ),
		'category' => 'sans-serif'
	);
	return $fonts;
}
// Add a new LOCAL font to the GeneratePress
// https://docs.generatepress.com/article/adding-local-fonts/
//add_filter( 'generate_typography_default_fonts', 'opensky_add_local_fonts');
function opensky_add_local_fonts( $fonts ) {
	$fonts[] = 'Marydale';
	return $fonts;
}
