<?php
function devart_press__blocks_load_assets(): void {

	// Register the block by passing the location of block.json to register_block_type.
	register_block_type( __DIR__ );

	$asset_file = include( plugin_dir_path( __FILE__ ) . 'assets/index.asset.php');

	wp_register_script(
		'devart_press-blocks',
		plugins_url( 'assets/index.js', __FILE__ ),
		$asset_file['dependencies'],
		$asset_file['version']
	);

	add_action('admin_enqueue_scripts', function () {
		wp_enqueue_script( 'devart_press-blocks' );
	});
}

add_action( 'init', 'devart_press__blocks_load_assets' );