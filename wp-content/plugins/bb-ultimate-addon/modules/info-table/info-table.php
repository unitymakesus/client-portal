<?php
/**
 *  UABB Info Table Module file
 *
 *  @package UABB Info Table Module
 */

/**
 * Function that initializes Info Table Module
 *
 * @class UABBInfoTableModule
 */
class UABBInfoTableModule extends FLBuilderModule {
	/**
	 * Constructor function that constructs default values for the Info Table Module
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Info Table', 'uabb' ),
				'description'     => __( 'A basic info table.', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$content_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/info-table/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/info-table/',
				'editor_export'   => true, // Defaults to true and can be omitted.
				'enabled'         => true, // Defaults to true and can be omitted.
				'partial_refresh' => true, // Defaults to false and can be omitted.
				'icon'            => 'editor-table.svg',
			)
		);
	}
	/**
	 * Ensure backwards compatibility with old settings.
	 *
	 * @since 1.14.0
	 * @param object $settings A module settings object.
	 * @param object $helper A settings compatibility helper.
	 * @return object
	 */
	public function filter_settings( $settings, $helper ) {
		$version_bb_check        = UABB_Compatibility::check_bb_version();
		$page_migrated           = UABB_Compatibility::check_old_page_migration();
		$stable_version_new_page = UABB_Compatibility::check_stable_version_new_page();
		if ( $version_bb_check && ( 'yes' == $page_migrated || 'yes' == $stable_version_new_page ) ) {

			if ( ! isset( $settings->heading_font_typo ) || ! is_array( $settings->heading_font_typo ) ) {

				$settings->heading_font_typo            = array();
				$settings->heading_font_typo_medium     = array();
				$settings->heading_font_typo_responsive = array();
			}
			if ( isset( $settings->heading_font_family ) ) {
				if ( isset( $settings->heading_font_family['family'] ) ) {
					$settings->heading_font_typo['font_family'] = $settings->heading_font_family['family'];

				}
				if ( isset( $settings->heading_font_family['weight'] ) ) {

					if ( 'regular' == $settings->heading_font_family['weight'] ) {
						$settings->heading_font_typo['font_weight'] = 'normal';
					} else {
						$settings->heading_font_typo['font_weight'] = $settings->heading_font_family['weight'];
					}
				}
			}
			if ( isset( $settings->heading_font_size_unit ) ) {

				$settings->heading_font_typo['font_size'] = array(
					'length' => $settings->heading_font_size_unit,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->heading_font_size_unit_medium ) ) {

				$settings->heading_font_typo_medium['font_size'] = array(
					'length' => $settings->heading_font_size_unit_medium,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->heading_font_size_unit_responsive ) ) {

				$settings->heading_font_typo_responsive['font_size'] = array(
					'length' => $settings->heading_font_size_unit_responsive,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->heading_line_height_unit ) ) {

				$settings->heading_font_typo['line_height'] = array(
					'length' => $settings->heading_line_height_unit,
					'unit'   => 'em',
				);
			}
			if ( isset( $settings->heading_line_height_unit_medium ) ) {
				$settings->heading_font_typo_medium['line_height'] = array(
					'length' => $settings->heading_line_height_unit_medium,
					'unit'   => 'em',
				);
			}
			if ( isset( $settings->heading_line_height_unit_responsive ) ) {
				$settings->heading_font_typo_responsive['line_height'] = array(
					'length' => $settings->heading_line_height_unit_responsive,
					'unit'   => 'em',
				);
			}
			if ( isset( $settings->heading_transform ) ) {

				$settings->heading_font_typo['text_transform'] = $settings->heading_transform;

			}
			if ( isset( $settings->heading_letter_spacing ) ) {

				$settings->heading_font_typo['letter_spacing'] = array(
					'length' => $settings->heading_letter_spacing,
					'unit'   => 'px',
				);
			}
			if ( ! isset( $settings->sub_heading_font_typo ) || ! is_array( $settings->sub_heading_font_typo ) ) {

				$settings->sub_heading_font_typo            = array();
				$settings->sub_heading_font_typo_medium     = array();
				$settings->sub_heading_font_typo_responsive = array();
			}
			if ( isset( $settings->sub_heading_font_family ) ) {
				if ( isset( $settings->sub_heading_font_family['family'] ) ) {
					$settings->sub_heading_font_typo['font_family'] = $settings->sub_heading_font_family['family'];

				}
				if ( isset( $settings->sub_heading_font_family['weight'] ) ) {
					if ( 'regular' == $settings->sub_heading_font_family['weight'] ) {
						$settings->sub_heading_font_typo['font_weight'] = 'normal';
					} else {
						$settings->sub_heading_font_typo['font_weight'] = $settings->sub_heading_font_family['weight'];
					}
				}
			}
			if ( isset( $settings->sub_heading_font_size_unit ) ) {

				$settings->sub_heading_font_typo['font_size'] = array(
					'length' => $settings->sub_heading_font_size_unit,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->sub_heading_font_size_unit_medium ) ) {

				$settings->sub_heading_font_typo_medium['font_size'] = array(
					'length' => $settings->sub_heading_font_size_unit_medium,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->sub_heading_font_size_unit_responsive ) ) {

				$settings->sub_heading_font_typo_responsive['font_size'] = array(
					'length' => $settings->sub_heading_font_size_unit_responsive,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->sub_heading_line_height_unit ) ) {

				$settings->sub_heading_font_typo['line_height'] = array(
					'length' => $settings->sub_heading_line_height_unit,
					'unit'   => 'em',
				);
			}
			if ( isset( $settings->sub_heading_line_height_unit_medium ) ) {

				$settings->sub_heading_font_typo_medium['line_height'] = array(
					'length' => $settings->sub_heading_line_height_unit_medium,
					'unit'   => 'em',
				);
			}
			if ( isset( $settings->sub_heading_line_height_unit_responsive ) ) {

				$settings->sub_heading_font_typo_responsive['line_height'] = array(
					'length' => $settings->sub_heading_line_height_unit_responsive,
					'unit'   => 'em',
				);
			}
			if ( isset( $settings->sub_transform ) ) {

				$settings->sub_heading_font_typo['text_transform'] = $settings->sub_transform;

			}
			if ( isset( $settings->sub_letter_spacing ) ) {

				$settings->sub_heading_font_typo['letter_spacing'] = array(
					'length' => $settings->sub_letter_spacing,
					'unit'   => 'px',
				);
			}
			if ( ! isset( $settings->description_font_typo ) || ! is_array( $settings->description_font_typo ) ) {

				$settings->description_font_typo            = array();
				$settings->description_font_typo_medium     = array();
				$settings->description_font_typo_responsive = array();
			}
			if ( isset( $settings->description_font_family ) ) {

				if ( isset( $settings->description_font_family['family'] ) ) {

					$settings->description_font_typo['font_family'] = $settings->description_font_family['family'];
				}
				if ( isset( $settings->description_font_family['weight'] ) ) {
					if ( 'regular' == $settings->description_font_family['weight'] ) {
						$settings->description_font_typo['font_weight'] = 'normal';
					} else {
						$settings->description_font_typo['font_weight'] = $settings->description_font_family['weight'];
					}
				}
			}
			if ( isset( $settings->description_font_size_unit ) ) {

				$settings->description_font_typo['font_size'] = array(
					'length' => $settings->description_font_size_unit,
					'unit'   => 'px',
				);

			}
			if ( isset( $settings->description_font_size_unit_medium ) ) {

				$settings->description_font_typo_medium['font_size'] = array(
					'length' => $settings->description_font_size_unit_medium,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->description_font_size_unit_responsive ) ) {

				$settings->description_font_typo_responsive['font_size'] = array(
					'length' => $settings->description_font_size_unit_responsive,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->description_line_height_unit ) ) {

				$settings->description_font_typo['line_height'] = array(
					'length' => $settings->description_line_height_unit,
					'unit'   => 'em',
				);
			}
			if ( isset( $settings->description_line_height_unit_medium ) ) {

				$settings->description_font_typo_medium['line_height'] = array(
					'length' => $settings->description_line_height_unit_medium,
					'unit'   => 'em',
				);
			}
			if ( isset( $settings->description_line_height_unit_responsive ) ) {

				$settings->description_font_typo_responsive['line_height'] = array(
					'length' => $settings->description_line_height_unit_responsive,
					'unit'   => 'em',
				);
			}
			if ( isset( $settings->description_transform ) ) {

				$settings->description_font_typo['text_transform'] = $settings->description_transform;

			}
			if ( isset( $settings->description_letter_spacing ) ) {

				$settings->description_font_typo['letter_spacing'] = array(
					'length' => $settings->description_letter_spacing,
					'unit'   => 'px',
				);
			}
			// compatibility for Description.
			if ( ! isset( $settings->btn_font_typo ) || ! is_array( $settings->btn_font_typo ) ) {

				$settings->btn_font_typo            = array();
				$settings->btn_font_typo_medium     = array();
				$settings->btn_font_typo_responsive = array();
			}
			if ( isset( $settings->btn_font_family ) ) {
				if ( isset( $settings->btn_font_family['family'] ) ) {
					$settings->btn_font_typo['font_family'] = $settings->btn_font_family['family'];
				}
				if ( isset( $settings->btn_font_family['weight'] ) ) {
					if ( 'regular' == $settings->btn_font_family['weight'] ) {
						$settings->btn_font_typo['font_weight'] = 'normal';
					} else {
						$settings->btn_font_typo['font_weight'] = $settings->btn_font_family['weight'];
					}
				}
			}
			if ( isset( $settings->btn_font_size_unit ) ) {

				$settings->btn_font_typo['font_size'] = array(
					'length' => $settings->btn_font_size_unit,
					'unit'   => 'px',
				);

			}
			if ( isset( $settings->btn_font_size_unit_medium ) ) {

				$settings->btn_font_typo_medium['font_size'] = array(
					'length' => $settings->btn_font_size_unit_medium,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->btn_font_size_unit_responsive ) ) {

				$settings->btn_font_typo_responsive['font_size'] = array(
					'length' => $settings->btn_font_size_unit_responsive,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->btn_line_height_unit ) ) {

				$settings->btn_font_typo['line_height'] = array(
					'length' => $settings->btn_line_height_unit,
					'unit'   => 'em',
				);
			}
			if ( isset( $settings->btn_line_height_unit_medium ) ) {

				$settings->btn_font_typo_medium['line_height'] = array(
					'length' => $settings->btn_line_height_unit_medium,
					'unit'   => 'em',
				);
			}
			if ( isset( $settings->btn_line_height_unit_responsive ) ) {

				$settings->btn_font_typo_responsive['line_height'] = array(
					'length' => $settings->btn_line_height_unit_responsive,
					'unit'   => 'em',
				);
			}
			if ( isset( $settings->btn_transform ) ) {

				$settings->btn_font_typo['text_transform'] = $settings->btn_transform;

			}
			if ( isset( $settings->btn_letter_spacing ) ) {

				$settings->btn_font_typo['letter_spacing'] = array(
					'length' => $settings->btn_letter_spacing,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->it_link ) ) {

				if ( isset( $settings->it_link_target ) ) {
					$settings->it_link_target = $settings->it_link_target;
				}
				if ( isset( $settings->it_link_nofollow ) ) {

					if ( '1' == $settings->it_link_nofollow ) {
						$settings->it_link_nofollow = 'yes';
					} elseif ( 'yes' == $settings->it_link_nofollow ) {
						$settings->it_link_nofollow = 'yes';
					}
				}
			}
			if ( isset( $settings->heading_font_family ) ) {
				unset( $settings->heading_font_family );
				unset( $settings->heading_font_size_unit );
				unset( $settings->heading_font_size_unit_medium );
				unset( $settings->heading_font_size_unit_responsive );
				unset( $settings->heading_line_height_unit );
				unset( $settings->heading_line_height_unit_medium );
				unset( $settings->heading_line_height_unit_responsive );
				unset( $settings->heading_transform );
				unset( $settings->heading_letter_spacing );
			}
			if ( isset( $settings->sub_heading_font_family ) ) {
				unset( $settings->sub_heading_font_family );
				unset( $settings->sub_heading_font_size_unit );
				unset( $settings->sub_heading_font_size_unit_medium );
				unset( $settings->sub_heading_font_size_unit_responsive );
				unset( $settings->sub_heading_line_height_unit );
				unset( $settings->sub_heading_line_height_unit_medium );
				unset( $settings->sub_heading_line_height_unit_responsive );
				unset( $settings->sub_transform );
				unset( $settings->sub_letter_spacing );
			}
			if ( isset( $settings->description_font_family ) ) {
				unset( $settings->description_font_family );
				unset( $settings->description_font_size_unit );
				unset( $settings->description_font_size_unit_medium );
				unset( $settings->description_font_size_unit_responsive );
				unset( $settings->description_line_height_unit );
				unset( $settings->description_line_height_unit_medium );
				unset( $settings->description_line_height_unit_responsive );
				unset( $settings->description_transform );
				unset( $settings->description_letter_spacing );
			}
			if ( isset( $settings->btn_font_family ) ) {
				unset( $settings->btn_font_family );
				unset( $settings->btn_font_size_unit );
				unset( $settings->btn_font_size_unit_medium );
				unset( $settings->btn_font_size_unit_responsive );
				unset( $settings->btn_line_height_unit );
				unset( $settings->btn_line_height_unit_medium );
				unset( $settings->btn_line_height_unit_responsive );
				unset( $settings->btn_transform );
				unset( $settings->btn_letter_spacing );
			}
		} elseif ( $version_bb_check && 'yes' != $page_migrated ) {
			if ( ! isset( $settings->heading_font_typo ) || ! is_array( $settings->heading_font_typo ) ) {

				$settings->heading_font_typo            = array();
				$settings->heading_font_typo_medium     = array();
				$settings->heading_font_typo_responsive = array();
			}
			if ( isset( $settings->heading_font_family ) ) {

				if ( isset( $settings->heading_font_family['family'] ) ) {
					$settings->heading_font_typo['font_family'] = $settings->heading_font_family['family'];

				}
				if ( isset( $settings->heading_font_family['weight'] ) ) {

					if ( 'regular' == $settings->heading_font_family['weight'] ) {
						$settings->heading_font_typo['font_weight'] = 'normal';
					} else {
						$settings->heading_font_typo['font_weight'] = $settings->heading_font_family['weight'];
					}
				}
			}
			if ( isset( $settings->heading_font_size['desktop'] ) ) {

				$settings->heading_font_typo['font_size'] = array(
					'length' => $settings->heading_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->heading_font_size['medium'] ) ) {
				$settings->heading_font_typo_medium['font_size'] = array(
					'length' => $settings->heading_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->heading_font_size['small'] ) ) {
				$settings->heading_font_typo_responsive['font_size'] = array(
					'length' => $settings->heading_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->heading_line_height['desktop'] ) && isset( $settings->heading_font_size['desktop'] ) && 0 != $settings->heading_font_size['desktop'] ) {
				if ( is_numeric( $settings->heading_line_height['desktop'] ) && is_numeric( $settings->heading_font_size['desktop'] ) ) {
					$settings->heading_font_typo['line_height'] = array(
						'length' => round( $settings->heading_line_height['desktop'] / $settings->heading_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->heading_line_height['medium'] ) && isset( $settings->heading_font_size['medium'] ) && 0 != $settings->heading_font_size['medium'] ) {
				if ( is_numeric( $settings->heading_line_height['medium'] ) && is_numeric( $settings->heading_font_size['medium'] ) ) {
					$settings->heading_font_typo_medium['line_height'] = array(
						'length' => round( $settings->heading_line_height['medium'] / $settings->heading_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->heading_line_height['small'] ) && isset( $settings->heading_font_size['small'] ) && 0 != $settings->heading_font_size['small'] ) {
				if ( is_numeric( $settings->heading_line_height['small'] ) && is_numeric( $settings->heading_font_size['small'] ) ) {
					$settings->heading_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->heading_line_height['small'] / $settings->heading_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( ! isset( $settings->description_font_typo ) || ! is_array( $settings->description_font_typo ) ) {

				$settings->description_font_typo            = array();
				$settings->description_font_typo_medium     = array();
				$settings->description_font_typo_responsive = array();
			}
			if ( isset( $settings->description_font_family ) ) {

				if ( isset( $settings->description_font_family['family'] ) ) {

					$settings->description_font_typo['font_family'] = $settings->description_font_family['family'];
				}
				if ( isset( $settings->description_font_family['weight'] ) ) {
					if ( 'regular' == $settings->description_font_family['weight'] ) {
						$settings->description_font_typo['font_weight'] = 'normal';
					} else {
						$settings->description_font_typo['font_weight'] = $settings->description_font_family['weight'];
					}
				}
			}
			if ( isset( $settings->description_font_size['desktop'] ) ) {
				$settings->description_font_typo['font_size'] = array(
					'length' => $settings->description_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->description_font_size['medium'] ) && ! isset( $settings->description_font_size_unit_medium ) ) {
				$settings->description_font_typo_medium['font_size'] = array(
					'length' => $settings->description_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->description_font_size['small'] ) ) {
				$settings->description_font_typo_responsive['font_size'] = array(
					'length' => $settings->description_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->description_line_height['desktop'] ) && isset( $settings->description_font_size['desktop'] ) && 0 != $settings->description_font_size['desktop'] ) {
				if ( is_numeric( $settings->description_line_height['desktop'] ) && is_numeric( $settings->description_font_size['desktop'] ) ) {
					$settings->description_font_typo['line_height'] = array(
						'length' => round( $settings->description_line_height['desktop'] / $settings->description_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->description_line_height['medium'] ) && isset( $settings->description_font_size['medium'] ) && 0 != $settings->description_font_size['medium'] ) {
				if ( is_numeric( $settings->description_line_height['medium'] ) && is_numeric( $settings->description_font_size['medium'] ) ) {
					$settings->description_font_typo_medium['line_height'] = array(
						'length' => round( $settings->description_line_height['medium'] / $settings->description_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->description_line_height['small'] ) && isset( $settings->description_font_size['small'] ) && 0 != $settings->description_font_size['small'] && ! isset( $settings->description_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->description_line_height['small'] ) && is_numeric( $settings->description_font_size['small'] ) ) {
					$settings->description_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->description_line_height['small'] / $settings->description_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( ! isset( $settings->sub_heading_font_typo ) || ! is_array( $settings->sub_heading_font_typo ) ) {

				$settings->sub_heading_font_typo            = array();
				$settings->sub_heading_font_typo_medium     = array();
				$settings->sub_heading_font_typo_responsive = array();
			}
			if ( isset( $settings->sub_heading_font_family ) ) {

				if ( isset( $settings->sub_heading_font_family['family'] ) ) {
					$settings->sub_heading_font_typo['font_family'] = $settings->sub_heading_font_family['family'];

				}
				if ( isset( $settings->sub_heading_font_family['weight'] ) ) {
					if ( 'regular' == $settings->sub_heading_font_family['weight'] ) {
						$settings->sub_heading_font_typo['font_weight'] = 'normal';
					} else {
						$settings->sub_heading_font_typo['font_weight'] = $settings->sub_heading_font_family['weight'];
					}
				}
			}
			if ( isset( $settings->sub_heading_font_size['desktop'] ) ) {
				$settings->sub_heading_font_typo['font_size'] = array(
					'length' => $settings->sub_heading_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->sub_heading_font_size['medium'] ) ) {
				$settings->sub_heading_font_typo_medium['font_size'] = array(
					'length' => $settings->sub_heading_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->sub_heading_font_size['small'] ) ) {
				$settings->sub_heading_font_typo_responsive['font_size'] = array(
					'length' => $settings->sub_heading_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->sub_heading_line_height['desktop'] ) && isset( $settings->sub_heading_font_size['desktop'] ) && 0 != $settings->sub_heading_font_size['desktop'] ) {
				if ( is_numeric( $settings->sub_heading_line_height['desktop'] ) && is_numeric( $settings->sub_heading_font_size['desktop'] ) ) {
					$settings->sub_heading_font_typo['line_height'] = array(
						'length' => round( $settings->sub_heading_line_height['desktop'] / $settings->sub_heading_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->sub_heading_line_height['medium'] ) && isset( $settings->sub_heading_font_size['medium'] ) && 0 != $settings->sub_heading_font_size['medium'] ) {
				if ( is_numeric( $settings->sub_heading_line_height['medium'] ) && is_numeric( $settings->sub_heading_font_size['medium'] ) ) {
					$settings->sub_heading_font_typo_medium['line_height'] = array(
						'length' => round( $settings->sub_heading_line_height['medium'] / $settings->sub_heading_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->sub_heading_line_height['small'] ) && isset( $settings->sub_heading_font_size['small'] ) && 0 != $settings->sub_heading_font_size['small'] ) {
				if ( is_numeric( $settings->sub_heading_line_height['small'] ) && is_numeric( $settings->sub_heading_font_size['small'] ) ) {
					$settings->sub_heading_font_typo_responsive['line_height'] = array(

						'length' => round( $settings->sub_heading_line_height['small'] / $settings->sub_heading_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( ! isset( $settings->btn_font_typo ) || ! is_array( $settings->btn_font_typo ) ) {

				$settings->btn_font_typo            = array();
				$settings->btn_font_typo_medium     = array();
				$settings->btn_font_typo_responsive = array();
			}
			if ( isset( $settings->btn_font_family ) ) {

				if ( isset( $settings->btn_font_family['family'] ) ) {
					$settings->btn_font_typo['font_family'] = $settings->btn_font_family['family'];
				}
				if ( isset( $settings->btn_font_family['weight'] ) ) {
					if ( 'regular' == $settings->btn_font_family['weight'] ) {
						$settings->btn_font_typo['font_weight'] = 'normal';
					} else {
						$settings->btn_font_typo['font_weight'] = $settings->btn_font_family['weight'];
					}
				}
			}
			if ( isset( $settings->btn_font_size['desktop'] ) ) {
				$settings->btn_font_typo['font_size'] = array(
					'length' => $settings->sub_heading_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->btn_font_size['medium'] ) ) {
				$settings->btn_font_typo_medium['font_size'] = array(
					'length' => $settings->btn_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->btn_font_size['small'] ) ) {
				$settings->btn_font_typo_responsive['font_size'] = array(
					'length' => $settings->btn_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->btn_line_height['desktop'] ) && isset( $settings->btn_font_size['desktop'] ) && 0 != $settings->btn_font_size['desktop'] ) {
				if ( is_numeric( $settings->btn_line_height['desktop'] ) && is_numeric( $settings->btn_font_size['desktop'] ) ) {
					$settings->btn_font_typo['line_height'] = array(
						'length' => round( $settings->btn_line_height['desktop'] / $settings->btn_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->btn_line_height['medium'] ) && isset( $settings->btn_font_size['medium'] ) && 0 != $settings->btn_font_size['medium'] && ! isset( $settings->btn_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->btn_line_height['medium'] ) && is_numeric( $settings->btn_font_size['medium'] ) ) {
					$settings->btn_font_typo_medium['line_height'] = array(
						'length' => round( $settings->btn_line_height['medium'] / $settings->btn_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->btn_line_height['small'] ) && isset( $settings->btn_font_size['small'] ) && 0 != $settings->btn_font_size['small'] ) {
				if ( is_numeric( $settings->btn_line_height['small'] ) && is_numeric( $settings->btn_font_size['small'] ) ) {
					$settings->btn_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->btn_line_height['small'] / $settings->btn_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->it_link ) ) {

				if ( isset( $settings->it_link_target ) ) {
					$settings->it_link_target = $settings->it_link_target;
				}
				if ( isset( $settings->it_link_nofollow ) ) {

					if ( '1' == $settings->it_link_nofollow ) {
						$settings->it_link_nofollow = 'yes';
					} elseif ( 'yes' == $settings->it_link_nofollow ) {
						$settings->it_link_nofollow = 'yes';
					}
				}
			}
			if ( isset( $settings->heading_font_family ) ) {
				unset( $settings->heading_font_family );
				unset( $settings->heading_font_size );
				unset( $settings->heading_line_height );
			}
			if ( isset( $settings->sub_heading_font_family ) ) {
				unset( $settings->sub_heading_font_family );
				unset( $settings->sub_heading_font_size );
				unset( $settings->sub_heading_line_height );
			}
			if ( isset( $settings->description_font_family ) ) {
				unset( $settings->description_font_family );
				unset( $settings->description_font_size );
				unset( $settings->description_line_height );
			}
			if ( isset( $settings->btn_font_family ) ) {
				unset( $settings->btn_font_family );
				unset( $settings->btn_font_size );
				unset( $settings->btn_line_height );
			}
		}
		return $settings;
	}
}

/**
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 */
if ( UABB_Compatibility::check_bb_version() ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/info-table/info-table-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/info-table/info-table-bb-less-than-2-2-compatibility.php';
}
