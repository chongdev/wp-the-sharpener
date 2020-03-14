<?php
/**
 * Welcome Page Class
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Activation Hook
 */
function wonderwall_magazine_on_activation() {
	set_transient( '_wonderwall_magazine_activation_redirect_1', true, 60 );
} add_action( 'after_switch_theme', 'wonderwall_magazine_on_activation' );

/**
 * Vars
 */
function wonderwall_magazine_welcome_vars() {

	$vars = array(
		'changelog_url' => 'http://docs.meridianthemes.net/article/44-changelog',
		'support_url' => 'https://meridianthemes.net/themeforest',
		'docs_text' => 'The documentation can be found in the package you downloaded from Themeforest, in the directory called Documentation.',
	);

	if ( WONDERWALL_MAGAZINE_SOURCE !== 'themeforest' ) {
		$vars['support_url'] = 'https://meridianthemes.net/dashboard';
		$vars['docs_text'] = 'The usage documentation can be found at <a href="http://docs.meridianthemes.net/">docs.meridianthemes.net</a>';
	}

	return $vars;

}

/**
 * Process activation
 */
function wonderwall_magazine_process_activation( $data = array() ) {

	$username = $data['username'];
	$email = $data['email'];
	$theme = $data['theme'];
	$newsletter = $data['newsletter'];

	$message = "Username: $username\r\n
	Email: $email\r\n
	Theme: $theme\r\n
	Newsletter: $newsletter";

	wp_mail( 'meridianthemes@gmail.com', 'Activation for ' . $theme, $message );

}

/**
 * Wonderwall_Magazine_Welcome Class
 *
 * @since 1.0
 */
class Wonderwall_Magazine_Welcome {

	public $minimum_capability = 'manage_options';

	/**
	 * Get things started
	 *
	 * @since 1.0
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menus') );
		add_action( 'admin_head', array( $this, 'admin_head' ) );
		add_action( 'admin_init', array( $this, 'welcome'    ) );
	}

	/**
	 * Register dashboard pages
	 *
	 * @since 1.0
	 */
	public function admin_menus() {

		// Getting Started Page
		add_theme_page(
			esc_html__( 'Getting started with Wonderwall', 'wonderwall-magazine' ),
			esc_html__( 'Theme Welcome', 'wonderwall-magazine' ),
			$this->minimum_capability,
			'wonderwall-magazine-getting-started',
			array( $this, 'getting_started_screen' )
		);

	}

	/**
	 * Hide dashboard pages and add some CSS
	 *
	 * @since 1.0
	 */
	public function admin_head() {
		
		?>
		<style type="text/css" media="screen">
		/*<![CDATA[*/

		.mt-welcome .feature-section {
			margin-bottom: 0;
			padding-bottom: 0;
		}

		.about-wrap .feature-section p {
			margin-left: 0;
		}

		.mt-welcome * {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
		}

		.mt-welcome .changelog h3 {
			margin-bottom: 5px;
		}

		.mt-welcome-form,
		.mt-plugins {
			width: 100%;
			border: 1px solid #e5e5e5;
			border-left: 4px solid #46b450;
			-webkit-box-shadow: 0 1px 1px rgba(0,0,0,.04);
			box-shadow: 0 1px 1px rgba(0,0,0,.04);
			background: #fff;
			padding: 20px;
		}

			.mt-importer p,
			.mt-welcome-form p,
			.mt-plugins p {
				font-size: 13px;
				line-height: 1.5;
				margin: 0 !important;
				margin-bottom: 10px !important;
			}

			.mt-welcome .changelog {
				float: left;
				width: 50%;
				padding-right: 50px;
			}

			.mt-welcome .changelog.changelog-1-3 {
				float: left;
				width: 33.33%;
				padding-right: 50px;
			}

				.mt-welcome-form-errors {
					font-size: 12px;
					border: 1px dashed #d24d4d; 
					padding: 10px;
					margin-bottom: 15px;
				}

					.mt-welcome-form-errors ul {
						margin: 0;
					}

				.mt-welcome-form-success {
					font-size: 12px;
					border: 1px dashed #4dd282; 
					padding: 10px;
				}

				.mt-welcome-form-row {
					margin-bottom: 15px;
				}

					.mt-welcome-form-row input[type="text"],
					.mt-welcome-form-row input[type="email"] {
						width: 100%;
					}

		/*]]>*/
		</style>
		<?php
	}

	/**
	 * Navigation
	 *
	 * @since 1.0
	 */
	public function tabs() {

		$selected = isset( $_GET['page'] ) ? $_GET['page'] : 'wonderwall-magazine-about';
		?>
		<h2 class="nav-tab-wrapper">
			<a class="nav-tab <?php echo $selected == 'wonderwall-magazine-getting-started' ? 'nav-tab-active' : ''; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'wonderwall-magazine-getting-started' ), 'themes.php' ) ) ); ?>">
				<?php esc_html_e( 'Welcome', 'wonderwall-magazine' ); ?>
			</a>
		</h2>
		<?php

	}

	/**
	 * Getting started page
	 *
	 * @since 1.0
	 */
	public function getting_started_screen() {

		$vars = wonderwall_magazine_welcome_vars();

		$slug = basename( get_template_directory() );
		$purchase_code_key = esc_attr( strtolower( str_replace( array(' ', '.'), '_', $slug ) ) ) . '_wup_purchase_code';
		$errors = get_option( strtolower( $slug ) . '_wup_errors' );
		$purchase_code = sanitize_text_field( get_option( strtolower( $slug ) . '_wup_purchase_code', '' ) );

		?>
		<div class="wrap about-wrap mt-welcome">

			<h1><?php printf( esc_html__( 'Welcome to Wonderwall %s', 'wonderwall-magazine' ), WONDERWALL_MAGAZINE_THEME_VER ); ?></h1>

			<div class="about-text"><?php esc_html_e( 'Thank you for using Wonderwall! We hope you will enjoy it and build awesome stuff with it.', 'wonderwall-magazine' ); ?></div>

			<?php $this->tabs(); ?>

			<div class="changelog">

				<h3>Plugins</h3>

				<p>This theme requires some plugins for full functionality. The first step should be installing those plugins.</p>

				<div class="mt-plugins">
					<?php do_action( 'wonderwall_magazine_plugins' ); ?>
				</div><!-- .mt-plugins -->

			</div>

			<div class="changelog">

				<h3><?php esc_html_e( 'Demo Importer', 'wonderwall-magazine' );?></h3>

				<div class="feature-section">

					<p>The importer will import the content you've seen on the demo. It is <strong>not required</strong>, you can manually create the content if you want.</p>

					<?php wonderwall_magazine_importer_notification(); ?>

				</div><!-- .feature-section -->

			</div><!-- .changelog -->

			<div class="changelog clear">

				<h3><?php esc_html_e( 'Theme Updates', 'wonderwall-magazine' );?></h3>

				<div class="feature-section">

					<?php if ( WONDERWALL_MAGAZINE_SOURCE == 'themeforest' ) : ?>

						<p>To enable dashboard updates for the theme please fill in the form below. If you are not sure what your purchase code is please go to <a target="_blank" href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-">help.market.envato.com</a> for more information.</p>

						<div class="mt-welcome-form">
							<?php if ( $errors ) : ?>
								<div class="mt-welcome-form-errors">
									<ul>
										<?php foreach ( $errors as $error ) : ?>
											<li><?php echo wp_kses_post( $error ); ?></li>
										<?php endforeach; ?>
									</ul>
								</div><!-- .mt-welcome-form-errors -->
							<?php endif; ?>
							<?php if ( ! $errors && $purchase_code ) : ?>
								<div class="mt-welcome-form-success">
									You have succesfuly enabled dashboard updates.
								</div><!-- .mt-welcome-form-success -->
							<?php else : ?>
								<form method="post" action="">
									<input type="hidden" name="wupdates_pc_theme" value="<?php echo esc_attr( $slug ); ?>" />
									<div class="mt-welcome-form-row">
										<input type="text" name="wupdates_custom_username" placeholder="Envato Username" required />
									</div><!-- .mt-welcome-form-row -->
									<div class="mt-welcome-form-row">
										<input type="email" name="wupdates_custom_email" placeholder="Email Address" required />
									</div><!-- .mt-welcome-form-row -->
									<div class="mt-welcome-form-row">
										<input type="text" placeholder="Purchase Code" name="<?php echo esc_attr( $purchase_code_key ); ?>" required />
									</div><!-- .mt-welcome-form-row -->
									<div class="mt-welcome-form-row">
										<input type="checkbox" name="wupdates_custom_newsletter" checked /> <small>Subscribe to Newsletter</small>
									</div><!-- .mt-welcome-form-row -->
									<div class="mt-welcome-form-row">
										<input type="submit" value="Submit" class="button button-primary button-large" />
									</div><!-- .mt-welcome-form-row -->
								</form>
							<?php endif; ?>
						</div><!-- .mt-welcome-form -->

					<?php else : ?>

						<p>To enable dashboard updates for the theme please fill in the form below. You can find the license key in the email you received after purchase or by going to <a target="_blank" href="https://meridianthemes.net/dashboard/">meridianthemes.net/dashboard</a> ( view receipt ).</p>

						<div class="mt-welcome-form">
							<?php do_action( 'mt_updates_form' ); ?>
						</div><!-- .mt-welcome-form -->

					<?php endif; ?>

				</div><!-- .feature-section -->

			</div><!-- .changelog -->

			<div class="changelog">

				<h3><?php esc_html_e( 'Documentation', 'wonderwall-magazine' );?></h3>

				<div class="feature-section">

					<p><?php echo wp_kses_post( $vars['docs_text'] ); ?></p>					

				</div><!-- .feature-section -->

				<h3><?php esc_html_e( 'Support', 'wonderwall-magazine' );?></h3>

				<div class="feature-section">

					<p>If you have any questions about the theme or run into any issues using it, please submit a support request <a target="_blank" href="<?php echo esc_url( $vars['support_url'] ); ?>">here</a>.</p>

				</div><!-- .feature-section -->

				<h3><?php esc_html_e( 'Changelog', 'wonderwall-magazine' );?></h3>

				<div class="feature-section">

					<p>More information about the changes in the different versions of the theme can be found at <a target="_blank" href="<?php echo esc_url( $vars['changelog_url'] ); ?>">docs.meridianthemes.net</a></p>

				</div><!-- .feature-section -->

			</div><!-- .changelog -->

		</div>
		<?php
	}

	/**
	 * Redirect the user to the welcome screen
	 *
	 * @since 1.0
	 */
	public function welcome() {

		// Bail if no activation redirect
		if ( ! get_transient( '_wonderwall_magazine_activation_redirect_1' ) )
			return;

		// Delete the redirect transient
		delete_transient( '_wonderwall_magazine_activation_redirect_1' );

		// Bail if activating from network, or bulk
		if ( is_network_admin() || isset( $_GET['activate-multi'] ) )
			return;

		wp_safe_redirect( admin_url( 'themes.php?page=wonderwall-magazine-getting-started' ) ); exit;

	}

}

new Wonderwall_Magazine_Welcome();
