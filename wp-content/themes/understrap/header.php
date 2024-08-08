<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$bootstrap_version = get_theme_mod( 'understrap_bootstrap_version', 'bootstrap4' );
$navbar_type       = get_theme_mod( 'understrap_navbar_type', 'collapse' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php understrap_body_attributes(); ?>>
<?php do_action( 'wp_body_open' ); ?>
<div class="site" id="page">

	<!-- ******************* The Navbar Area ******************* -->
	<header id="wrapper-navbar">
	<?php 
		$background_styles = '';
		$background_image_thumb = get_background_image();
		if ( $background_image_thumb ) {
			$background_image_thumb = esc_url( set_url_scheme( get_theme_mod( 'background_image_thumb', str_replace( '%', '%%', $background_image_thumb ) ) ) );
			$background_position_x  = get_theme_mod( 'background_position_x', get_theme_support( 'custom-background', 'default-position-x' ) );
			$background_position_y  = get_theme_mod( 'background_position_y', get_theme_support( 'custom-background', 'default-position-y' ) );
			$background_size        = get_theme_mod( 'background_size', get_theme_support( 'custom-background', 'default-size' ) );
			$background_repeat      = get_theme_mod( 'background_repeat', get_theme_support( 'custom-background', 'default-repeat' ) );
			$background_attachment  = get_theme_mod( 'background_attachment', get_theme_support( 'custom-background', 'default-attachment' ) );

			// Background-image URL must be single quote, see below.
			$background_styles .= " background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('$background_image_thumb');"
			. " background-size: $background_size;"
			. " background-position: $background_position_x $background_position_y;"
			. " background-repeat: $background_repeat;"
			. " background-attachment: $background_attachment;"
			. " height: 40vh;";
		}
		if (is_front_page()) {
			$background_styles .= "height: 100vh;";
		}
	?>
	<div class="entry-header custom-header" style="<?php echo $background_styles ?>">
		<a class="skip-link <?php echo understrap_get_screen_reader_class( true ); ?>" href="#content">
			<?php esc_html_e( 'Skip to content', 'understrap' ); ?>
		</a>

		<?php get_template_part( 'global-templates/navbar', $navbar_type . '-' . $bootstrap_version ); ?>
		
		<?php if (is_front_page()) {
		?>
			<div class="container">
				<div class="row banner-content">
					<div class="col-sm  d-flex align-items-end justify-content-start">
						<h1 class="large">
							<?php esc_html_e( 'Where Design Meets Strategy', 'understrap' ); ?>
							<small>an award winning creative agency</small>
						</h1>
					</div>
					<div class="col-sm d-flex align-items-center justify-content-end">
						<h3 class="small"><?php esc_html_e( 'Unlocking your true potential through graphic design for business', 'understrap' ); ?></h3>
					</div>
				</div>

			</div>
		<?php } else { ?>
			<div class="container">
				<div class="row banner-post">
					<div class="col-sm-8 d-flex align-items-end justify-content-start">
						<h1 class="large">
						<?php
							echo get_the_title();
							?>
						</h1>
					</div>
				</div>
			</div>
		<?php } ?>

	</div>
	</header><!-- #wrapper-navbar -->
