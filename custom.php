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
//add_filter( 'generate_typography_customize_list', 'opensky_add_google_fonts_gp' );
function opensky_add_google_fonts_gp( $fonts ) {
	$fonts[ 'marydale' ] = array( 
		'name' => '',
		'variants' => array( '400', '700' ),
		'category' => 'serif'
	);
	return $fonts;
}
// Add a new LOCAL font to the GeneratePress
// https://docs.generatepress.com/article/adding-local-fonts/
//add_filter( 'generate_typography_default_fonts', 'opensky_add_local_fonts_gp');
function opensky_add_local_fonts_gp( $fonts ) {
	$fonts[] = 'Marydale';
	return $fonts;
}
// Add a new LOCAL font to Beaver Builder Page Builder modules
//add_filter( 'fl_builder_font_families_system', 'opensky_add_local_fonts_bb' );
function opensky_add_local_fonts_bb ( $system_fonts ) {
	$system_fonts[ 'Marydale' ] = array(
		'fallback' => 'Times, serif',
		'weights' => array(	'400' ),
	);
	return $system_fonts;
}
