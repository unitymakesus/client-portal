<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://makewebbetter.com/
 * @since      1.0.0
 *
 * @package    hubwoo-integration
 * @subpackage hubwoo-integration/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    hubwoo-integration
 * @subpackage hubwoo-integration/admin
 * @author     MakeWebBetter <webmaster@makewebbetter.com>
 */
class Hubwoo_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		// let's modularize our codebase, all the admin actions in one function. 
		$this->admin_actions();
	}

	/**
	 * all admin actions.
	 * 
	 * @since 1.0.0
	 */
	public function admin_actions() {

		// add submenu hubspot in woocommerce top menu.
		add_action( 'admin_menu', array( &$this, 'add_hubwoo_submenu' ) );
	}

	/**
	 * add hubspot submenu in woocommerce menu..
	 *
	 * @since 1.0.0
	 */
	public function add_hubwoo_submenu() {

		add_submenu_page( 'woocommerce', __('HubSpot', 'hubwoo'), __('HubSpot', 'hubwoo'), 'manage_woocommerce', 'hubwoo', array(&$this, 'hubwoo_configurations') );
	}

	/**
	 * all the configuration related fields and settings.
	 * 
	 * @return html  all the settings and configuration options for hubspot.
	 * @since 1.0.0
	 */
	public function hubwoo_configurations() {

		include_once HUBWOO_ABSPATH . 'admin/templates/hubwoo-free-main-template.php';
	}

	/**
	 * General setting tab fields.
	 * 
	 * @return array  woocommerce_admin_fields acceptable fields in array.
	 * @since 1.0.0
	 */
	public static function hubwoo_general_settings(){

		$basic_settings = array();

		//title 
		$basic_settings[] = array(
			'title' => __('Connect With HubSpot', 'hubwoo'),  
			'id'	=> 'hubwoo_settings_title', 
			'type'	=> 'title'	
		);

		// Enable/Disable option
		$basic_settings[] = array(
			'title' => __('Enable/Disable', 'hubwoo'),
			'id'	=> 'hubwoo_settings_enable',
			'class' => 'hubwoo_common_checkbox', 
			'desc'	=> __('Turn on/off the integration', 'hubwoo'),
			'type'	=> 'checkbox'
		);

		// Enable/Disable Log
		$basic_settings[] = array(
			'title' 	=> __('Enable/Disable', 'hubwoo'),
			'id'		=> 'hubwoo_log_enable',
			'class' 	=> 'hubwoo_common_checkbox',  
			'desc'		=> sprintf( __('Enable logging of the requests. You can view hubspot log file from <a href="%s">Here</a>', 'hubwoo'), '?page=wc-status&tab=logs'),
			'type'		=> 'checkbox',
			'default'	=> 'yes',
		);

		$basic_settings[] = array(
			'type' 	=> 'sectionend',
	        'id' 	=> 'hubwoo_settings_end'
		);

		//return $basic_settings;
		return $basic_settings;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		
		$screen = get_current_screen();
		
        if( isset( $screen->id ) && $screen->id == 'woocommerce_page_hubwoo' ) {

        	wp_enqueue_style( $this->plugin_name."-bootstrap-style", plugin_dir_url( __FILE__ ) . 'css/bootstrap.css', array(), $this->version, 'all' );

			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/hubwoo-admin.css', array(), $this->version, 'all' );
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		$screen = get_current_screen();
		
        if( isset( $screen->id ) && $screen->id == 'woocommerce_page_hubwoo' ) {

			wp_register_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/hubwoo-admin.js', array( 'jquery' ), $this->version, false );

			wp_localize_script( $this->plugin_name, 
				'hubwooi18n', array(
					'ajaxUrl' 					=> admin_url( 'admin-ajax.php' ),
					'hubwooSecurity' 			=> wp_create_nonce( 'hubwoo_security' ), 
					'hubwooWentWrong' 			=> __( 'Something went wrong, please try again later!', 'hubwoo' ), 
					'hubwooSuccess' 			=> __( 'Setup is completed successfully!', 'hubwoo' ),
					'hubwooCreatingGroup' 		=> __( 'Created group', 'hubwoo' ),
					'hubwooCreatingProperty' 	=> __( 'Created property', 'hubwoo' ),
					'hubwooSetupCompleted' 		=> __('Setup completed!', 'hubwoo'),
					'hubwooMailFailure'			=> __('Mail not sent', 'hubwoo'),
					'hubwooConnectTab' 			=> admin_url() . 'admin.php?page=hubwoo&hubwoo_tab=hubwoo_connect',
					'hubwooUpdateFail' 			=> __('Error while updating properties. Check the logs and try again.','hubwoo'),
					'hubwooUpdateSuccess' 		=> __('All properties updated successfully.','hubwoo'),
				)
			);

			wp_enqueue_script( $this->plugin_name );

			wp_register_script( $this->plugin_name."-bootstap-script", plugin_dir_url( __FILE__ ) . 'js/bootstrap.js', array( 'jquery' ), $this->version, false );

			wp_enqueue_script( $this->plugin_name."-bootstap-script" );
		}
	}

	/**
	 * Update schedule data with custom time.
	 *
	 * @since    1.0.0
	 * @param      string    $schedules       Schedule data.
	 */
	public function hubwoo_set_cron_schedule_time( $schedules ) {

		if( !isset( $schedules[ "5min" ] ) ) {

	        $schedules["5min"] = array(
	            'interval' => 5*60,
	            'display' => __( 'Once every 5 minutes', 'hubwoo' )
	        );
	    }
	    
	    return $schedules;
	}
	/**
	 * Schedule Executes when user data is update.
	 *
	 * @since    1.0.0
	 * @param      string    $schedules       Schedule data.
	 */
	public function hubwoo_cron_schedule() {

		$plugin_enable = get_option( 'hubwoo_settings_enable', 'no' );
		
		if( $plugin_enable == 'yes' ) {

			$hubwoo_setup = get_option( 'hubwoo_setup_completed', false );

			if( $hubwoo_setup ) {

				$valid_token = false;
				
				if( Hubwoo::is_access_token_expired() ) {
			
					$hapikey = HUBWOO_CLIENT_ID;
					$hseckey = HUBWOO_SECRET_ID;
					$status =  HubWooConnectionMananager::get_instance()->hubwoo_refresh_token( $hapikey, $hseckey );

					if( $status ) {

						$valid_token = true;
					}
				}
				else {

					$valid_token = true;
				}
				
				if( $valid_token ) {

					$args['meta_query'] = array(

						array(
							'key'		=>	'hubwoo_user_data_change',
							'value'		=>	'yes',
							'compare'	=>	'=='
						)
					); 	

					$hubwoo_updated_user = get_users( $args );

					$hubwoo_users = array();

					$hubwoo_users = apply_filters( 'hubwoo_users', $hubwoo_updated_user );

					$hubwoo_unique_users = array();

					foreach ( $hubwoo_users as $key => $value ) {

						if( in_array( $value->ID, $hubwoo_unique_users ) ) {

							continue;
						}
						else {

							$hubwoo_unique_users[] = $value->ID;
						}
					} 

					if ( isset( $hubwoo_unique_users) && $hubwoo_unique_users != null  && count( $hubwoo_unique_users ) ) {

						foreach ( $hubwoo_unique_users as $key => $ID ) {

							if ( $key == 50 ) {
								
								break;
							}

							$hubwoo_customer = new HubWooCustomer( $ID );

							$properties = $hubwoo_customer->get_contact_properties();

							$properties = apply_filters( 'hubwoo_map_new_properties', $properties, $ID );
					
							$properties_data = array( 'email' => $hubwoo_customer->get_email(),'properties' => $properties );

							$contacts[] = $properties_data;

							update_user_meta( $ID, 'hubwoo_user_data_change', 'no' );
						}

						HubWooConnectionMananager::get_instance()->create_or_update_contacts( $contacts );			
					}

					$hubwoo_guest_cart = get_option( "mwb_hubwoo_guest_user_cart", array() );
					
					$guest_abandoned_carts = array();

					if ( !empty ( $hubwoo_guest_cart ) ) {

						foreach ( $hubwoo_guest_cart as $key => &$single_cart ) {

							if ( isset( $single_cart["email"] ) ) {

								$cart = false;

								$guest_user_properties = apply_filters( "hubwoo_pro_track_guest_cart", array(), $single_cart["email"] );

								if ( count( $guest_user_properties ) ) {

									foreach ( $guest_user_properties as $single_record ) {
										
										if( array_key_exists( "property", $single_record ) && $single_record["property"] == "current_abandoned_cart" ) {

											$cart = true;
											break;
										}
									}
								}

								if( $cart ) {
									
									$guest_abandoned_carts[] = array( 'email' => $single_cart["email"], 'properties' => $guest_user_properties );
								}
							}
						}
					}
					
					if ( count( $guest_abandoned_carts ) ) {

						$chunked_array = array_chunk( $guest_abandoned_carts, 50, false ); 

						if ( !empty( $chunked_array ) ) {

							foreach ( $chunked_array as $single_chunk ) {

								if( Hubwoo::is_valid_client_ids_stored() ) {

									$flag = true;

									if( Hubwoo::is_access_token_expired() ) {

										$hapikey = HUBWOO_CLIENT_ID;
										$hseckey = HUBWOO_SECRET_ID;
										$status =  HubWooConnectionMananager::get_instance()->hubwoo_refresh_token( $hapikey, $hseckey );

										if( !$status ) {

											$flag = false;
										}
									}

									if( $flag ) {

										HubWooConnectionMananager::get_instance()->create_or_update_contacts( $single_chunk );
									}
								}
							}
						}
					}
				}
			}
		}		
	}

	/**
	 * Generating access token
	 *
	 * @since    1.0.0
	 */
	public function hubwoo_redirect_from_hubspot() {

		if( isset( $_GET['code'] ) ) {

			$hapikey = HUBWOO_CLIENT_ID;
			$hseckey = HUBWOO_SECRET_ID;

			if( $hapikey && $hseckey ) {
				
				if( !Hubwoo::is_valid_client_ids_stored() ) {

					$response = HubWooConnectionMananager::get_instance()->hubwoo_fetch_access_token_from_code( $hapikey, $hseckey);
				}

				$oauth_message = get_option( 'hubwoo_oauth_success', false );

				if( !isset( $oauth_message ) || !$oauth_message ) {

					$response = HubWooConnectionMananager::get_instance()->hubwoo_fetch_access_token_from_code( $hapikey, $hseckey);
				}
				
				wp_redirect( admin_url() . 'admin.php?page=hubwoo&hubwoo_tab=hubwoo_connect' );
				exit();
			}
		}
	}
	/**
	 * Adding more groups and properties for add-ons
	 *
	 * @since    1.1.0
	 */
	public function hubwoo_update_new_addons_groups_properties() {

		if ( Hubwoo::is_setup_completed() ) {
			
			$new_grp = get_option( 'hubwoo_pro_newgroups_saved', false );
			$hubwoo_lock = get_option( 'hubwoo_lock', false );

			if( $new_grp && !$hubwoo_lock ) {

				if( Hubwoo::is_valid_client_ids_stored() ) {

					$flag = true;

					if ( Hubwoo::is_access_token_expired() ) {

						$hapikey = HUBWOO_CLIENT_ID;
						$hseckey = HUBWOO_SECRET_ID;
						$status  =  HubWooConnectionMananager::get_instance()->hubwoo_refresh_token( $hapikey, $hseckey);

						if( !$status ) {

							$flag = false;
						}
					}

					if( $flag ) {

						update_option( "hubwoo_lock", true );

						$groups = array();
						$properties = array();

						$groups = apply_filters( "hubwoo_new_contact_groups", $groups );

						foreach ( $groups as $key => $value ) {

							HubWooConnectionMananager::get_instance()->create_group( $value );

							$properties = apply_filters( "hubwoo_new_active_group_properties", $properties, $value['name'] ); 

							foreach ( $properties as $key1 => $value1 ) {

								$value1[ 'groupName' ] = $value['name'];
								HubWooConnectionMananager::get_instance()->create_property(  $value1 );
							}
						}
						
						update_option( 'hubwoo_pro_newgroups_saved', false );
						update_option( 'hubwoo_lock', false );
					}
				}
			}
		}
	}

	/**
	 * alert notice on hubspot 404/400 error
	 * 
	 * @since 1.0.0
	 */

	public function hubwoo_dashboard_alert_notice() {

		if( Hubwoo::is_valid_client_ids_stored() ) {

			$hubwoo_setup = get_option( 'hubwoo_setup_completed', false );
			$hubwoo_alert = get_option( 'hubwoo_alert_param_set', false );

			if( $hubwoo_alert && $hubwoo_setup ) {
				
				$message = __("Something went wrong with HubSpot WooComerce Integration. Please check the logs or contact us over support.","hubwoo");
			    Hubwoo::hubwoo_notice( $message, 'error' );
			}
		}
	}

	/**
	 * woocommerce privacy policy
	 * 
	 * @since 1.0.0
	 */

	public function hubwoo_add_privacy_message() {

		if ( function_exists( 'wp_add_privacy_policy_content' ) ) {

			$content = '<p>' . __( 'We use your email to send your Orders related data over HubSpot.','hubwoo' ) . '</p>';

			$content .='<p>' . __( 'HubSpot is an inbound marketing and sales platform that helps companies attract visitors, convert leads, and close customers.', 'hubwoo' ) . '</p>';

			$content .= '<p>' .  __( 'Please see the ', 'hubwoo' ) . '<a href="https://www.hubspot.com/data-privacy/gdpr" target="_blank" >' . __( 'HubSpot Data Privacy', 'hubwoo' ) . '</a>' .  __( ' for more details.', 'hubwoo' ) . '</p>';

			if ( $content ) {

				wp_add_privacy_policy_content( __( 'HubSpot WooCommerce Integration', 'hubwoo' ), $content );
			}
		}
	}

	/**
	 * redirection for reauth with hubspot app
	 * 
	 * @since 1.0.0
	 */

	public function hubwoo_reauth_with_new_app() {

		if( isset( $_GET["action"] ) && $_GET["action"] == "reauth" ) {

			delete_option( "hubwoo_oauth_success" );
			$url = 'https://app.hubspot.com/oauth/authorize';
			$hapikey = HUBWOO_CLIENT_ID;
			$hubspot_url = add_query_arg( 
				array(
				    'client_id'		=> $hapikey,
				    'scope' 		=> 'oauth%20contacts',
				    'redirect_uri' 	=> admin_url().'admin.php'
				), $url
			);
			wp_redirect( $hubspot_url );
			exit();
		}
	}

	/**
	 * notice for property update in order to maintain compatibility with new version
	 * 
	 * @since 1.0.0
	 */
	public function hubwoo_property_update() {

		if( Hubwoo::is_setup_completed() ) {

			$property_update = get_option( "hubwoo_free_property_update", false );

			if( !$property_update ) {

				$update_link = '<a href="'.admin_url("admin.php?page=hubwoo&hubwoo_tab=general-settings").'">'.__("Click Here", "hubwoo").'</a>';
				$message = sprintf( __("Please wait a second. We recommend you to update HubSpot properties to make it compatible with our latest version. %s ", "hubwoo"), $update_link );
				Hubwoo::hubwoo_notice( $message, 'error' );
			}
		}
	}
}