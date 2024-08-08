<?php
/**
 * UnderStrap functions and definitions
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// UnderStrap's includes directory.
$understrap_inc_dir = 'inc';

// Array of files to include.
$understrap_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker. Trying to get deeper navigation? Check out: https://github.com/understrap/understrap/issues/567.
	'/editor.php',                          // Load Editor functions.
	'/block-editor.php',                    // Load Block Editor functions.
	'/deprecated.php',                      // Load deprecated functions.
);

// Load WooCommerce functions if WooCommerce is activated.
if ( class_exists( 'WooCommerce' ) ) {
	$understrap_includes[] = '/woocommerce.php';
}

// Load Jetpack compatibility file if Jetpack is activiated.
if ( class_exists( 'Jetpack' ) ) {
	$understrap_includes[] = '/jetpack.php';
}

// Include files.
foreach ( $understrap_includes as $file ) {
	require_once get_theme_file_path( $understrap_inc_dir . $file );
}

function my_custom_shortcode() {
	ob_start();
    $args = array(
        'post_type' => 'portfolio',
        'posts_per_page' => 6,
    );
    $portfolio_query = new WP_Query( $args );

    if ( $portfolio_query->have_posts() ) : ?>
	<div class="section-portfolio">
	<div class="wp-block-columns is-layout-flex wp-container-core-columns-is-layout-2 wp-block-columns-is-layout-flex">
		<div class="wp-block-column is-layout-flow wp-block-column-is-layout-flow">
		<h2 class="wp-block-heading">USE CASES</h2>
		</div>



		<div class="wp-block-column is-layout-flow wp-block-column-is-layout-flow">
		<p class="has-text-align-right"><em><button class="btn-normal" >Book a call</button></em></p>
		</div>
		</div>
        <div class="portfolio-list">
            <?php while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post(); ?>
                <div class="portfolio-item row">
					<div class="col-3 col-md-1 company-logo">
						<?php $image_logo = get_field('company_logo');
						if ($image_logo) {
							$logo_url = wp_get_attachment_image($image_logo, 'large');
							echo $logo_url;
						}?>
					</div>
					<div class="col-9 col-md-10 company-bg">
						<?php
							$image_bg = get_field('company_background');
							if ($image_bg) {
								$bg_url = wp_get_attachment_image($image_bg, 'large');
								echo $bg_url;
							}
						?>
					<div class="row">
						<div class="col-md-3">
							<h3><?php the_title(); ?></h3>
						</div>
						<div class="col-md-6 content">
							<?php the_content(); ?>
						</div>
						<div class="col-md-3">
							<p style="text-align:right"><?php the_field('interesting_note'); ?></p>
						</div>
					</div>
                </div>
            <?php endwhile; ?>
        </div>
	<div>
    <?php wp_reset_postdata(); endif;
	return ob_get_clean();
}
add_shortcode( 'my_custom_shortcode', 'my_custom_shortcode' );

  ?>