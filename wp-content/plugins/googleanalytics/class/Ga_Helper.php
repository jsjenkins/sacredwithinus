<?php

class Ga_Helper {

	const ROLE_ID_PREFIX                = 'role-id-';
	const GA_DEFAULT_WEB_ID             = 'UA-0000000-0';
	const GA_STATISTICS_PAGE_URL        = 'admin.php?page=googleanalytics';
	const GA_SETTINGS_PAGE_URL          = 'admin.php?page=googleanalytics/settings';
	const DASHBOARD_PAGE_NAME           = 'dashboard';
	const PHP_VERSION_REQUIRED          = '5.2.17';
	const GA_WP_MODERN_VERSION          = '4.1';
	const GA_TOOLTIP_TERMS_NOT_ACCEPTED = 'Please accept the terms to use this feature.';
	const GA_TOOLTIP_FEATURES_DISABLED  = 'Click the Enable button at the top to start using this feature.';
	const GA_DEBUG_MODE                 = false;

	/**
	 * Init plugin actions.
	 *
	 */
	public static function init() {

		// Displays errors related to required PHP version
		if ( ! self::is_php_version_valid() ) {
			add_action( 'admin_notices', 'Ga_Admin::admin_notice_googleanalytics_php_version' );

			return false;
		}

		// Displays errors related to required WP version
		if ( ! self::is_wp_version_valid() ) {
			add_action( 'admin_notices', 'Ga_Admin::admin_notice_googleanalytics_wp_version' );

			return false;
		}

		if ( ! is_admin() ) {
			Ga_Frontend::add_actions();
		}

		if ( is_admin() ) {
			Ga_Admin::add_filters();
			Ga_Admin::add_actions();
			Ga_Admin::init_oauth();


			$admin_controller = new Ga_Admin_Controller();
			$admin_controller->handle_actions();
		}
	}

	/**
	 * Checks if current page is a WordPress dashboard.
	 * @return int
	 */
	public static function is_plugin_page() {
		$site = get_current_screen();

		return preg_match( '/' . GA_NAME . '/i', $site->base ) || preg_match( '/' . GA_NAME . '/i', $_SERVER['REQUEST_URI'] );
	}

	/**
	 * Checks if current page is a WordPress dashboard.
	 * @return number
	 */
	public static function is_dashboard_page() {
		$site = get_current_screen();

		return preg_match( '/' . self::DASHBOARD_PAGE_NAME . '/', $site->base );
	}

	/**
	 * Check whether the plugin is configured.
	 *
	 * @param String $web_id
	 *
	 * @return boolean
	 */
	public static function is_configured( $web_id ) {
		return ( self::GA_DEFAULT_WEB_ID !== $web_id ) && ! empty( $web_id );
	}

	/**
	 * Prepare an array of current site's user roles
	 *
	 * return array
	 */
	public static function get_user_roles() {
		global $wp_roles;
		if ( ! isset( $wp_roles ) ) {
			$wp_roles = new WP_Roles();
		}

		return $wp_roles->get_names();
	}

	/**
	 * Prepare a role ID.
	 *
	 * The role ID is derived from the role's name and will be used
	 * in its setting name in the additional settings.
	 *
	 * @param string $role_name Role name
	 *
	 * @return string
	 */
	public static function prepare_role_id( $role_name ) {
		return self::ROLE_ID_PREFIX . strtolower( preg_replace( '/[\W]/', '-', before_last_bar( $role_name ) ) );
	}

	/**
	 * Prepares role id.
	 *
	 * @param $v
	 * @param $k
	 */
	public static function prepare_role( &$v, $k ) {
		$v = self::prepare_role_id( $v );
	}

	/**
	 * Checks whether user role is excluded from adding UA code.
	 *
	 * @return boolean
	 */
	public static function can_add_ga_code() {
		$current_user	 = wp_get_current_user();
		$user_roles		 = !empty( $current_user->roles ) ? $current_user->roles : array();
		$exclude_roles	 = json_decode( get_option( Ga_Admin::GA_EXCLUDE_ROLES_OPTION_NAME ), true );

		array_walk( $user_roles, 'Ga_Helper::prepare_role' );

		$return = true;
		foreach ( $user_roles as $role ) {
			if ( !empty( $exclude_roles[ $role ] ) ) {
				$return = false;
				break;
			}
		}

		return $return;
	}

	/**
	 * Adds ga dashboard widget HTML code for a WordPress
	 * Dashboard widget hook.
	 */
	public static function add_ga_dashboard_widget() {
		echo self::get_ga_dashboard_widget( null, false, false, true );
	}

	/**
	 * Generates dashboard widget HTML code.
	 *
	 * @param string $date_range Google Analytics specific date range string.
	 * @param boolean $text_mode
	 * @param boolean $ajax
	 *
	 * @return null | string HTML dashboard widget code.
	 */
	public static function get_ga_dashboard_widget( $date_range = null, $text_mode = false, $ajax = false, $trigger_request = false ) {
		if ( empty( $date_range ) ) {
			$date_range = '30daysAgo';
		}

		if ( !$trigger_request ) {
			// Get chart and boxes data
			$data = self::get_dashboard_widget_data( $date_range );

			if ( $text_mode ) {
				return self::get_chart_page( 'ga_dashboard_widget' . ( $ajax ? "_ajax" : "" ), array(
					'chart'	 => $data[ 'chart' ],
					'boxes'	 => $data[ 'boxes' ]
				) );
			} else {
				echo self::get_chart_page( 'ga_dashboard_widget' . ( $ajax ? "_ajax" : "" ), array(
					'chart'				 => $data[ 'chart' ],
					'boxes'				 => $data[ 'boxes' ],
					'more_details_url'	 => admin_url( self::GA_STATISTICS_PAGE_URL ),
					'ga_nonce'			 => wp_create_nonce( 'ga_ajax_data_change' ),
					'ga_nonce_name'		 => Ga_Admin_Controller::GA_NONCE_FIELD_NAME
				) );
			}
		} else {
			echo self::get_chart_page( 'ga_dashboard_widget' . ( $ajax ? "_ajax" : "" ), array(
				'chart'					 => array(),
				'boxes'					 => Ga_Stats::get_empty_boxes_structure(),
				'more_details_url'		 => admin_url( self::GA_STATISTICS_PAGE_URL ),
				'show_trigger_button'	 => true,
				'ga_nonce'				 => wp_create_nonce( 'ga_ajax_data_change' ),
				'ga_nonce_name'			 => Ga_Admin_Controller::GA_NONCE_FIELD_NAME
			) );
		}

		return null;
	}

	/**
	 * Generates JSON data string for AJAX calls.
	 *
	 * @param string $date_range
	 * @param string $metric
	 * @param boolean $text_mode
	 * @param boolean $ajax
	 *
	 * @return string|false Returns JSON data string
	 */
	public static function get_ga_dashboard_widget_data_json(
	$date_range = null, $metric = null, $text_mode = false, $ajax = false
	) {
		if ( empty( $date_range ) ) {
			$date_range = '30daysAgo';
		}

		if ( empty( $metric ) ) {
			$metric = 'pageviews';
		}

		$data = self::get_dashboard_widget_data( $date_range, $metric );

		return wp_json_encode( $data );
	}

	/**
	 * Gets dashboard widget data.
	 *
	 * @param date_range
	 * @param metric
	 *
	 * @return array Return chart and boxes data
	 */
	private static function get_dashboard_widget_data( $date_range, $metric = null ) {
		$selected = self::get_selected_account_data( true );
		if ( self::is_authorized() && self::is_account_selected() ) {
			$query_params	 = Ga_Stats::get_query( 'main_chart', $selected[ 'view_id' ], $date_range, $metric, true );
			$stats_data		 = Ga_Admin::api_client()->call( 'ga_api_data', array(
				$query_params
			) );

			$boxes_query = Ga_Stats::get_query( 'dashboard_boxes', $selected[ 'view_id' ], $date_range, null, true );
			$boxes_data	 = Ga_Admin::api_client()->call( 'ga_api_data', array(
				$boxes_query
			) );
		}
		$chart	 = !empty( $stats_data ) ? Ga_Stats::get_dashboard_chart( $stats_data->getData() ) : array();
		$boxes	 = !empty( $boxes_data ) ? Ga_Stats::get_dashboard_boxes_data( $boxes_data->getData() ) : array();

		return array(
			'chart'	 => $chart,
			'boxes'	 => $boxes
		);
	}

	public static function is_account_selected() {
		return self::get_selected_account_data();
	}

	/**
	 * Returns HTML code of the chart page or a notice.
	 *
	 * @param chart
	 *
	 * @return string Returns HTML code
	 */
	public static function get_chart_page( $view, $params ) {

		$message = sprintf( __( 'Statistics can only be seen after you authenticate with your Google account on the <a href="%s">Settings page</a>.' ), admin_url( self::GA_SETTINGS_PAGE_URL ) );

		if ( self::is_authorized() && !self::is_code_manually_enabled() && !self::is_all_feature_disabled() ) {
			if ( self::is_account_selected() ) {
				if ( $params ) {
					return Ga_View_Core::load( $view, $params, true );
				} else {
					return self::ga_oauth_notice( sprintf( 'Please configure your <a href="%s">Google Analytics settings</a>.', admin_url( self::GA_SETTINGS_PAGE_URL ) ) );
				}
			} else {
				return self::ga_oauth_notice( $message );
			}
		} else {
			return self::ga_oauth_notice( $message );
		}
	}

	/**
	 * Checks whether users is authorized with Google.
	 *
	 * @return boolean
	 */
	public static function is_authorized() {
		return Ga_Admin::api_client()->get_instance()->is_authorized();
	}

	/**
	 * Wrapper for WordPress method get_option
	 *
	 * @param string $name Option name
	 *
	 * @return NULL|mixed|boolean
	 */
	public static function get_option( $name ) {
		$opt = get_option( $name );

		return !empty( $opt ) ? $opt : null;
	}

	/**
	 * Wrapper for WordPress method update_option
	 *
	 * @param string $name
	 * @param mixed $value
	 *
	 * @return NULL|boolean
	 */
	public static function update_option( $name, $value ) {
		$opt = update_option( $name, $value );

		return !empty( $opt ) ? $opt : null;
	}

	/**
	 * Loads ga notice HTML code with given message included.
	 *
	 * @param string $message
	 * $param bool $cannot_activate Whether the plugin cannot be activated
	 *
	 * @return string
	 */
	public static function ga_oauth_notice( $message ) {
		return Ga_View_Core::load( 'ga_oauth_notice', array(
			'msg' => $message
		), true );
	}

	/**
	 * Displays notice following the WP style.
	 *
	 * @param $message
	 * @param string $type
	 * @param $is_dismissable
	 * @param $action
	 *
	 * @return string
	 */
	public static function ga_wp_notice( $message, $type = '', $is_dismissable = false, $action = array() ) {
		return Ga_View_Core::load( 'ga_wp_notice', array(
			'type'			 => empty( $type ) ? Ga_Admin::NOTICE_WARNING : $type,
			'msg'			 => $message,
			'is_dismissable' => $is_dismissable,
			'action'		 => $action
		), true );
	}

	/**
	 * Gets data according to selected GA account.
	 *
	 * @param boolean $assoc
	 *
	 * @return mixed
	 */
	public static function get_selected_account_data( $assoc = false ) {
		$data	 = json_decode( self::get_option( Ga_Admin::GA_SELECTED_ACCOUNT ) );
		$data	 = (!empty( $data ) && count( $data ) == 3 ) ? $data : false;

		if ( $data ) {
			if ( $assoc ) {
				return array(
					'account_id'		 => $data[ 0 ],
					'web_property_id'	 => $data[ 1 ],
					'view_id'			 => $data[ 2 ]
				);
			} else {
				return $data;
			}
		}

		return false;
	}

	/**
	 * Chekcs whether option for manually UA-code
	 * @return NULL|mixed|boolean
	 */
	public static function is_code_manually_enabled() {
		return Ga_Helper::get_option( Ga_Admin::GA_WEB_PROPERTY_ID_MANUALLY_OPTION_NAME );
	}

	/**
	 * Adds percent sign to the given text.
	 *
	 * @param $text
	 *
	 * @return string
	 */
	public static function format_percent( $text ) {
		$text = self::add_plus( $text );

		return $text . '%';
	}

	/**
	 * Adds plus sign before number.
	 *
	 * @param $number
	 *
	 * @return string
	 */
	public static function add_plus( $number ) {
		if ( $number > 0 ) {
			return '+' . $number;
		}

		return $number;
	}

	/**
	 * Check whether current user has administrator privileges.
	 *
	 * @return bool
	 */
	public static function is_administrator() {
		if ( current_user_can( 'administrator' ) ) {
			return true;
		}

		return false;
	}

	public static function is_wp_version_valid() {
		$wp_version = get_bloginfo( 'version' );

		return version_compare( $wp_version, Ga_Admin::MIN_WP_VERSION, 'ge' );
	}

	/**
	 * Check if terms are accepted
	 *
	 * @return bool
	 */
	public static function are_terms_accepted() {
		return self::get_option( Ga_Admin::GA_SHARETHIS_TERMS_OPTION_NAME );
	}

	/**
	 * Check if sharethis scripts enabled
	 *
	 * @return bool
	 */
	public static function is_sharethis_included() {
		return GA_SHARETHIS_SCRIPTS_INCLUDED;
	}

	/**
	 * @return mixed
	 */
	public static function is_php_version_valid() {
		$p			 = '#(\.0+)+($|-)#';
		$ver1		 = preg_replace( $p, '', phpversion() );
		$ver2		 = preg_replace( $p, '', self::PHP_VERSION_REQUIRED );
		$operator	 = 'ge';
		$compare	 = isset( $operator ) ?
		version_compare( $ver1, $ver2, $operator ) :
		version_compare( $ver1, $ver2 );

		return $compare;
	}

	public static function get_current_url() {
		return $_SERVER[ 'REQUEST_URI' ];
	}

	public static function create_url( $url, $data = array() ) {
		return !empty( $data ) ? ( strstr( $url, '?' ) ? ( $url . '&' ) : ( $url . '?' ) ) . http_build_query( $data ) : $url;
	}

	public static function handle_url_message( $data ) {
		if ( !empty( $_GET[ 'ga_msg' ] ) ) {
			$invite_result = json_decode( base64_decode( $_GET[ 'ga_msg' ] ), true );
			if ( !empty( $invite_result[ 'status' ] ) && !empty( $invite_result[ 'message' ] ) ) {
				$data[ 'ga_msg' ] = Ga_Helper::ga_wp_notice( $invite_result[ 'message' ], $invite_result[ 'status' ], true );
			}
		}

		return $data;
	}

	public static function get_url_message_text() {
		$ga_msg			 = '';
		$invite_result	 = json_decode( base64_decode( $_GET[ 'ga_msg' ] ), true );
		if ( !empty( $invite_result[ 'status' ] ) && !empty( $invite_result[ 'message' ] ) ) {
			$ga_msg = $invite_result[ 'message' ];
		}

		return $ga_msg;
	}

	/**
	 * Create base64 url message
	 *
	 * @param $msg
	 * @param $status
	 *
	 * @return string
	 */
	public static function create_url_msg( $msg, $status ) {
		$msg = array( 'status' => $status, 'message' => $msg );

		return base64_encode( json_encode( $msg ) );
	}

	public static function is_all_feature_disabled() {
		return self::get_option( Ga_Admin::GA_DISABLE_ALL_FEATURES );
	}

	public static function are_features_enabled() {
		return self::are_terms_accepted() && !self::is_all_feature_disabled();
	}

	public static function are_sharethis_properties_verified() {
		return ( get_option( Ga_Admin::GA_SHARETHIS_VERIFICATION_RESULT ) && self::are_sharethis_properties_set() );
	}

	public static function are_sharethis_properties_ready_to_verify() {
		return ( self::are_sharethis_properties_set() && !get_option( Ga_Admin::GA_SHARETHIS_VERIFICATION_RESULT ) );
	}

	public static function are_sharethis_properties_set() {
		return ( get_option( Ga_Admin::GA_SHARETHIS_PROPERTY_ID ) && get_option( Ga_Admin::GA_SHARETHIS_PROPERTY_SECRET ) );
	}

	public static function should_create_sharethis_property() {
		return ( self::are_features_enabled() && !self::are_sharethis_properties_set() );
	}

	public static function should_verify_sharethis_installation() {
		return ( self::are_features_enabled() && self::are_sharethis_properties_ready_to_verify() );
	}

	public static function get_tooltip() {
		if ( !self::are_terms_accepted() ) {
			return self::GA_TOOLTIP_TERMS_NOT_ACCEPTED;
		} else if ( !self::are_features_enabled() ) {
			return self::GA_TOOLTIP_FEATURES_DISABLED;
		} else {
			return '';
		}
	}

	/**
	 * Is this version of WordPress considered old (< 4.1)?
	 *
	 * @return bool True if old, False if not.
	 */
	public static function is_wp_old() {
		return version_compare( get_bloginfo( 'version' ), self::GA_WP_MODERN_VERSION, 'lt' );
	}

	/**
	 * Should we load GA JavaScript on this property?
	 *
	 * @param string $web_property_id
	 *
	 * @return bool
	 */
	public static function should_load_ga_javascript( $web_property_id ) {
		return ( self::is_configured( $web_property_id ) && ( self::can_add_ga_code() || self::is_all_feature_disabled() ) );
	}

	/**
	 * Get account ID.
	 *
	 * @return string
	 */
	public static function get_account_id() {
		$account_id = json_decode( Ga_Helper::get_option( Ga_Admin::GA_SELECTED_ACCOUNT ) );

		return ! empty( $account_id[0] ) ? $account_id[0] : '';
	}

	/**
	 * Is curl disabled?
	 *
	 * @return bool True if disabled, false if enabled.
	 */
	public static function is_curl_disabled() {
		return ! function_exists( 'curl_version' );
	}

	/**
	 * Get URL with correct protocol.
	 *
	 * @return string URL with correct protocol.
	 */
	public static function get_plugin_url_with_correct_protocol() {
		$url = parse_url( GA_PLUGIN_URL );
		return ( ( is_ssl() ) ? 'https://' : 'http://' ) . $url['host'] . $url['path'];
	}

	/**
	 * Get code to manually label classes.
	 *
	 * @return string
	 */
	public static function get_code_manually_label_classes() {
		$classes = '';
		if ( ! self::are_features_enabled() ){
			$classes = 'label-grey ga-tooltip';
		}
		else if( self::is_account_selected() ) {
			$classes = 'label-grey';
		}
		return $classes;
	}

    /**
     * Get Previous Period for Dates (date start and date end).
     *
     * @param string $date_start Date string.
     * @param string $date_end   Date string.
     *
     * @return array Array of start and end dates in Y-m-d format.
     * @since 2.5.2
     */
    public static function getPreviousPeriodForDates($date_start = '', $date_end = '')
    {
        try {
            // Get distance between dates in days.
            $start = new DateTime($date_start);
            $end   = new DateTime($date_end);
        } catch (\Exception $e) {
            return [
                'start' => date('Y-m-d', strtotime('-1 week')),
                'end'   => date('Y-m-d'),
            ];
        }

        // Clone $start date into end_previous so we don't modify $start.
        $end_previous = clone $start;

        // Set the period to the difference between the start/end dates in days.
        $period = $end->diff($start)->days;

        // Subtract 1 day from $end_previous so it's one day before $start.
        $end_previous->modify('-1 day');

        // Clone $end_previous so we can subtract $period from it in days.
        $start_previous = clone $end_previous;
        $start_previous->modify(sprintf('-%d day', $period));

        return [
            'start' => $start_previous->format('Y-m-d'),
            'end'   => $end_previous->format('Y-m-d'),
        ];
    }

    /**
     * Get period between dates in days.
     *
     * @param string $date_start Start date string.
     * @param string $date_end   End date string.
     *
     * @return int
     * @since 2.5.2
     */
    public static function getPeriodInDays($date_start = '', $date_end = '')
    {
        $date_start = empty($date_start) ? date('Y-m-d', strtotime('-1 week')) : $date_start;
        $date_end   = empty($date_end) ? date('Y-m-d') : $date_end;

        try {
            // Get distance between dates in days.
            $start = new DateTime($date_start);
            $end   = new DateTime($date_end);
        } catch (\Exception $e) {
            return 0;
        }

        // Set the period to the difference between the start/end dates in days.
        return intval($start->diff($end)->format('%r%a'));
    }

    /**
     * Get period in Days as words.
     *
     * @param string $date_start Start date string.
     * @param string $date_end   End date string.
     *
     * @return string Words to indicate days.
     * @since 2.5.2
     */
    public static function getPeriodInDaysWords($date_start = '', $date_end = '')
    {
        $days = self::getPeriodInDays($date_start, $date_end);

        $date_end = empty($date_end) ? strtotime('now') : strtotime($date_end);

        // If today is the same as the end date.
        if (date('Y-m-d', $date_end) === date('Y-m-d')) {
            if (0 === $days) {
                return __('Today', 'googleanalytics');
            }

            if (7 === $days) {
                return __('This Week', 'googleanalytics');
            }

            return sprintf(_n('Last %d Day', 'Last %d Days', $days, 'googleanalytics'), $days);
        }

        return sprintf(_n('%d Day', '%d Days', $days, 'googleanalytics'), $days);
    }

    /**
     * Get date range from GET request.
     *
     * @return array
     * @since 2.5.2
     */
    public static function getDateRangeFromRequest()
    {
        $date_range = filter_input_array(INPUT_GET, [
            'date_from' => FILTER_SANITIZE_STRING,
            'date_to'   => FILTER_SANITIZE_STRING,
        ]);

        // If date_from is after date_to, let's reset 'from' to a week before 'to.'
        if (0 > Ga_Helper::getPeriodInDays($date_range['date_from'], $date_range['date_to'])) {
            try {
                $date = new DateTime($date_range['date_to']);
                $date->modify('-1 week');

                $date_from = $date->format('Y-m-d');
            } catch (\Exception $e) {
                $date_from = date('Y-m-d', strtotime('-1 week'));
            }

            $date_range['date_from'] = $date_from;
        }

        return [
            'from' => $date_range['date_from'],
            'to'   => $date_range['date_to'],
        ];
    }
}
