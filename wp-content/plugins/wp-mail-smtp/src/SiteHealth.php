<?php

namespace WPMailSMTP;

/**
 * Class SiteHealth adds the plugin status and information to the WP Site Health admin page.
 *
 * @since 1.9.0
 */
class SiteHealth {

	/**
	 * String of a badge color.
	 * Options: blue, green, red, orange, purple and gray.
	 *
	 * @see https://make.wordpress.org/core/2019/04/25/site-health-check-in-5-2/
	 *
	 * @since 1.9.0
	 */
	const BADGE_COLOR = 'blue';

	/**
	 * Debug info plugin slug.
	 * This should be a plugin unique string, which will be used in the WP Site Health page,
	 * for the "info" tab and will present the plugin info section.
	 *
	 * @since 1.9.0
	 */
	const DEBUG_INFO_SLUG = 'wp_mail_smtp';

	/**
	 * Translatable string for the plugin label.
	 *
	 * @since 1.9.0
	 *
	 * @return string
	 */
	public function get_label() {

		return esc_html__( 'WP Mail SMTP', 'wp-mail-smtp' );
	}

	/**
	 * Initialize the site heath functionality.
	 *
	 * @since 1.9.0
	 */
	public function init() {

		add_filter( 'site_status_tests', array( $this, 'register_site_status_tests' ) );
		add_filter( 'debug_information', array( $this, 'register_debug_information' ) );
	}

	/**
	 * Register plugin WP site health tests.
	 * This will be displayed in the "Status" tab of the WP Site Health page.
	 *
	 * @since 1.9.0
	 *
	 * @param array $tests The array with all WP site health tests.
	 *
	 * @return array
	 */
	public function register_site_status_tests( $tests ) {

		$tests['direct']['wp_mail_smtp_mailer_setup_complete'] = array(
			'label' => esc_html__( 'Is WP Mail SMTP mailer setup complete?', 'wp-mail-smtp' ),
			'test'  => array( $this, 'mailer_setup_complete_test' ),
		);

		$tests['direct']['wp_mail_smtp_db_tables_exist'] = array(
			'label' => esc_html__( 'Do WP Mail SMTP DB tables exist?', 'wp-mail-smtp' ),
			'test'  => [ $this, 'db_tables_test' ],
		);

		return $tests;
	}

	/**
	 * Register plugin WP Site Health debug information.
	 * This will be displayed in the "Info" tab of the WP Site Health page.
	 *
	 * @since 1.9.0
	 *
	 * @param array $debug_info Array of existing debug information.
	 *
	 * @return array
	 */
	public function register_debug_information( $debug_info ) {

		$debug_notices = Debug::get();
		$db_tables     = $this->get_db_tables( 'existing' );

		$debug_info[ self::DEBUG_INFO_SLUG ] = [
			'label'  => $this->get_label(),
			'fields' => [
				'version'          => [
					'label' => esc_html__( 'Version', 'wp-mail-smtp' ),
					'value' => WPMS_PLUGIN_VER,
				],
				'license_key_type' => [
					'label' => esc_html__( 'License key type', 'wp-mail-smtp' ),
					'value' => wp_mail_smtp()->get_license_type(),
				],
				'debug'            => [
					'label' => esc_html__( 'Debug', 'wp-mail-smtp' ),
					'value' => ! empty( $debug_notices ) ? implode( '. ', $debug_notices ) : esc_html__( 'No debug notices found.', 'wp-mail-smtp' ),
				],
				'db_tables'        => [
					'label' => esc_html__( 'DB tables', 'wp-mail-smtp' ),
					'value' => ! empty( $db_tables ) ?
						implode( ', ', $db_tables ) : esc_html__( 'No DB tables found.', 'wp-mail-smtp' ),
				],
			],
		];

		// Install date.
		$activated = get_option( 'wp_mail_smtp_activated', [] );
		if ( ! empty( $activated['lite'] ) ) {
			$date = $activated['lite'] + ( get_option( 'gmt_offset' ) * 3600 );

			$debug_info[ self::DEBUG_INFO_SLUG ]['fields']['lite_install_date'] = [
				'label' => esc_html__( 'Lite install date', 'wp-mail-smtp' ),
				'value' => date_i18n( esc_html__( 'M j, Y @ g:ia' ), $date ),
			];
		}

		return $debug_info;
	}

	/**
	 * Perform the WP site health test for checking, if the mailer setup is complete.
	 *
	 * @since 1.9.0
	 */
	public function mailer_setup_complete_test() {

		$mailer          = Options::init()->get( 'mail', 'mailer' );
		$mailer_complete = false;
		$mailer_title    = esc_html__( 'None selected', 'wp-mail-smtp' );

		if ( ! empty( $mailer ) ) {
			$mailer_object = wp_mail_smtp()
				->get_providers()
				->get_mailer(
					$mailer,
					wp_mail_smtp()->get_processor()->get_phpmailer()
				);

			$mailer_complete = ! empty( $mailer_object ) ? $mailer_object->is_mailer_complete() : false;

			$mailer_title = wp_mail_smtp()->get_providers()->get_options( $mailer )->get_title();
		}

		// The default mailer should be considered as a non-complete mailer.
		if ( $mailer === 'mail' ) {
			$mailer_complete = false;
		}

		$mailer_text = sprintf(
			'%s: <strong>%s</strong>',
			esc_html__( 'Current mailer', 'wp-mail-smtp' ),
			esc_html( $mailer_title )
		);

		$result = array(
			'label'       => esc_html__( 'WP Mail SMTP mailer setup is complete', 'wp-mail-smtp' ),
			'status'      => 'good',
			'badge'       => array(
				'label' => $this->get_label(),
				'color' => self::BADGE_COLOR,
			),
			'description' => sprintf(
				'<p>%s</p><p>%s</p>',
				$mailer_text,
				esc_html__( 'The WP Mail SMTP plugin mailer setup is complete. You can send a test email, to make sure it\'s working properly.', 'wp-mail-smtp' )
			),
			'actions'     => sprintf(
				'<p><a href="%s">%s</a></p>',
				esc_url( add_query_arg( 'tab', 'test', wp_mail_smtp()->get_admin()->get_admin_page_url() ) ),
				esc_html__( 'Test email sending', 'wp-mail-smtp' )
			),
			'test'        => 'wp_mail_smtp_mailer_setup_complete',
		);

		if ( $mailer === 'mail' ) {
			$mailer_text .= sprintf( /* translators: %s - explanation why default mailer is not a valid mailer option. */
				'<p>%s</p>',
				esc_html__( 'You currently have the default mailer selected, which means that you haven’t set up SMTP yet.', 'wp-mail-smtp' )
			);
		}

		if ( $mailer_complete === false ) {
			$result['label']          = esc_html__( 'WP Mail SMTP mailer setup is incomplete', 'wp-mail-smtp' );
			$result['status']         = 'recommended';
			$result['badge']['color'] = 'orange';
			$result['description']    = sprintf(
				'<p>%s</p><p>%s</p>',
				$mailer_text,
				esc_html__( 'The WP Mail SMTP plugin mailer setup is incomplete. Please click on the link below to access plugin settings and configure the mailer.', 'wp-mail-smtp' )
			);
			$result['actions']        = sprintf(
				'<p><a href="%s">%s</a></p>',
				esc_url( wp_mail_smtp()->get_admin()->get_admin_page_url() ),
				esc_html__( 'Configure mailer', 'wp-mail-smtp' )
			);
		}

		return $result;
	}

	/**
	 * Perform the test for checking if all custom plugin DB tables exist.
	 *
	 * @since 2.1.2
	 *
	 * @return array
	 */
	public function db_tables_test() {

		$result = array(
			'label'       => esc_html__( 'WP Mail SMTP DB tables are created', 'wp-mail-smtp' ),
			'status'      => 'good',
			'badge'       => array(
				'label' => $this->get_label(),
				'color' => self::BADGE_COLOR,
			),
			'description' => esc_html__( 'WP Mail SMTP is using custom database tables for some of its features. In order to work properly, the custom tables should be created, and it looks like they exist in your database.', 'wp-mail-smtp' ),
			'actions'     => '',
			'test'        => 'wp_mail_smtp_db_tables_exist',
		);

		$missing_tables = $this->get_db_tables( 'missing' );

		if ( ! empty( $missing_tables ) ) {
			$result['label']          = esc_html__( 'WP Mail SMTP DB tables check has failed', 'wp-mail-smtp' );
			$result['status']         = 'critical';
			$result['badge']['color'] = 'red';
			$result['description']    = sprintf(
				'<p>%s</p><p>%s</p>',
				sprintf( /* translators: %s - the list of missing tables separated by comma. */
					esc_html( _n( 'Missing table: %s', 'Missing tables: %s', count( $missing_tables ), 'wp-mail-smtp' ) ),
					esc_html( implode( ', ', $missing_tables ) )
				),
				esc_html__( 'WP Mail SMTP is using custom database tables for some of its features. In order to work properly, the custom tables should be created, and it seems they are missing. Please try to re-install the WP Mail SMTP plugin. If this issue persists, please contact our support.', 'wp-mail-smtp' )
			);
		}

		return $result;
	}

	/**
	 * Check DB:
	 * - if any required plugin DB table is missing,
	 * - which of the required plugin DB tables exist.
	 *
	 * @since 2.1.2
	 *
	 * @param string $check Which type of tables to return: 'missing' or 'existing'.
	 *
	 * @return array Missing or existing tables.
	 */
	private function get_db_tables( $check = 'missing' ) {

		global $wpdb;

		$tables = wp_mail_smtp()->get_custom_db_tables();

		$missing_tables  = [];
		$existing_tables = [];

		foreach ( $tables as $table ) {
			$db_result = $wpdb->get_var( $wpdb->prepare( 'SHOW TABLES LIKE %s', $table ) ); // phpcs:ignore

			if ( strtolower( $db_result ) !== strtolower( $table ) ) {
				$missing_tables[] = $table;
			} else {
				$existing_tables[] = $table;
			}
		}

		return ( $check === 'existing' ) ? $existing_tables : $missing_tables;
	}
}
