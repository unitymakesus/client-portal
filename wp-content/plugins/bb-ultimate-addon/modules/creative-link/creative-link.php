<?php
/**
 *  UABB Creative Link Module file
 *
 *  @package UABB Creative Link Module
 */

/**
 * Function that initializes UABB Creative link Module
 *
 * @class CreativeLink
 */
class CreativeLink extends FLBuilderModule {

	/**
	 * Constructor function that constructs default values for the Creative Link module.
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Creative Link', 'uabb' ),
				'description'     => __( 'Creative Link', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$creative_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/creative-link/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/creative-link/',
				'editor_export'   => true, // Defaults to true and can be omitted.
				'enabled'         => true, // Defaults to true and can be omitted.
				'partial_refresh' => true,
				'icon'            => 'creative-link.svg',
			)
		);
	}

	/**
	 * Function that renders icons for the Creative Link
	 *
	 * @param object $icon get an object for the icon.
	 */
	public function get_icon( $icon = '' ) {

		// check if $icon is referencing an included icon.
		if ( '' != $icon && file_exists( BB_ULTIMATE_ADDON_DIR . 'modules/creative-link/icon/' . $icon ) ) {
			$path = BB_ULTIMATE_ADDON_DIR . 'modules/creative-link/icon/' . $icon;
		}

		if ( file_exists( $path ) ) {
			$remove_icon = apply_filters( 'uabb_remove_svg_icon', false, 10, 1 );
			if ( true === $remove_icon ) {
				return;
			} else {
				return file_get_contents( $path );
			}
		} else {
			return '';
		}
	}

	/**
	 * Function that renders text for the Creative Link
	 *
	 * @method render_text
	 * @param array $title gets the field value for the Creative Link.
	 */
	public function render_text( $title ) {
		switch ( $this->settings->link_style ) {
			case 'simple':
			case 'style1':
			case 'style3':
			case 'style4':
			case 'style6':
			case 'style7':
			case 'style8':
			case 'style10':
			case 'style12':
			case 'style13':
			case 'style14':
			case 'style15':
			case 'style16':
			case 'style20':
				echo trim( $title, '' );
				break;

			case 'style2':
			case 'style5':
			case 'style17':
			case 'style18':
			case 'style19':
				echo '<span data-hover="' . trim( $title, '' ) . '">' . trim( $title, '' ) . '</span>';
				break;

			case 'style9':
			case 'style11':
				echo '<span>' . trim( $title, '' ) . '</span>';
				break;
		}
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

			// For overall alignment and responsive alignment settings.
			if ( isset( $settings->alignment ) ) {
				$settings->alignment = $settings->alignment;
			}
			if ( ! isset( $settings->font_typo ) || ! is_array( $settings->font_typo ) ) {

				$settings->font_typo            = array();
				$settings->font_typo_medium     = array();
				$settings->font_typo_responsive = array();
			}
			if ( isset( $settings->link_typography_font_family ) ) {
				if ( 'regular' == $settings->link_typography_font_family['weight'] ) {
					$settings->font_typo['font_weight'] = 'normal';
				} else {
					$settings->font_typo['font_weight'] = $settings->link_typography_font_family['weight'];
				}
				$settings->font_typo['font_family'] = $settings->link_typography_font_family['family'];

			}
			if ( isset( $settings->link_typography_font_size_unit ) ) {
				$settings->font_typo['font_size'] = array(
					'length' => $settings->link_typography_font_size_unit,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->link_typography_font_size_unit_medium ) ) {
				$settings->font_typo_medium['font_size'] = array(
					'length' => $settings->link_typography_font_size_unit_medium,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->link_typography_font_size_unit_responsive ) ) {
				$settings->font_typo_responsive['font_size'] = array(
					'length' => $settings->link_typography_font_size_unit_responsive,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->link_typography_line_height_unit ) ) {

				$settings->font_typo['line_height'] = array(
					'length' => $settings->link_typography_line_height_unit,
					'unit'   => 'em',
				);
			}
			if ( isset( $settings->link_typography_line_height_unit_medium ) ) {
				$settings->font_typo_medium['line_height'] = array(
					'length' => $settings->link_typography_line_height_unit_medium,
					'unit'   => 'em',
				);
			}
			if ( isset( $settings->link_typography_line_height_unit_responsive ) ) {
				$settings->font_typo_responsive['line_height'] = array(
					'length' => $settings->link_typography_line_height_unit_responsive,
					'unit'   => 'em',
				);
			}
			if ( isset( $settings->link_typography_transform ) ) {
				$settings->font_typo['text_transform'] = $settings->link_typography_transform;
			}
			if ( isset( $settings->link_typography_letter_spacing ) ) {
				$settings->font_typo['letter_spacing'] = array(
					'length' => $settings->link_typography_letter_spacing,
					'unit'   => 'px',
				);
			}
			foreach ( $settings->screens as $screen ) {
				if ( isset( $screen->link ) ) {
					if ( isset( $screen->target ) ) {
						$screen->link_target = $screen->target;
					}
					if ( isset( $screen->nofollow ) ) {
						$screen->link_nofollow = ( '1' == $screen->nofollow ) ? 'yes' : '';
					}
				}
			}
			if ( isset( $settings->link_typography_font_family ) ) {
				unset( $settings->link_typography_font_family );
				unset( $settings->link_typography_font_size_unit );
				unset( $settings->link_typography_font_size_unit_medium );
				unset( $settings->link_typography_font_size_unit_responsive );
				unset( $settings->link_typography_line_height_unit );
				unset( $settings->link_typography_line_height_unit_medium );
				unset( $settings->link_typography_line_height_unit_responsive );
				unset( $settings->link_typography_transform );
				unset( $settings->link_typography_letter_spacing );
			}
		} elseif ( $version_bb_check && 'yes' != $page_migrated ) {

			// For overall alignment and responsive alignment settings.
			if ( isset( $settings->alignment ) ) {
				$settings->alignment = $settings->alignment;
			}
			if ( ! isset( $settings->font_typo ) || ! is_array( $settings->font_typo ) ) {

				$settings->font_typo            = array();
				$settings->font_typo_medium     = array();
				$settings->font_typo_responsive = array();
			}
			if ( isset( $settings->link_typography_font_family ) && '' !== $settings->link_typography_font_family ) {

				if ( 'regular' == $settings->link_typography_font_family['weight'] ) {
					$settings->font_typo['font_weight'] = 'normal';
				} else {
					$settings->font_typo['font_weight'] = $settings->link_typography_font_family['weight'];
				}
				$settings->font_typo['font_family'] = $settings->link_typography_font_family['family'];
			}
			if ( isset( $settings->link_typography_font_size['small'] ) && ! isset( $settings->font_typo_responsive['font_size'] ) ) {

				$settings->font_typo_responsive['font_size'] = array(
					'length' => $settings->link_typography_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->link_typography_font_size['medium'] ) && ! isset( $settings->font_typo_medium['font_size'] ) ) {

				$settings->font_typo_medium['font_size'] = array(
					'length' => $settings->link_typography_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->link_typography_font_size['desktop'] ) && ! isset( $settings->font_typo['font_size'] ) ) {

				$settings->font_typo['font_size'] = array(
					'length' => $settings->link_typography_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->link_typography_line_height['desktop'] ) && isset( $settings->link_typography_font_size['desktop'] ) && 0 != $settings->link_typography_font_size['desktop'] && ! isset( $settings->font_typo['line_height'] ) ) {
				if ( is_numeric( $settings->link_typography_line_height['desktop'] ) && is_numeric( $settings->link_typography_font_size['desktop'] ) ) {
					$settings->font_typo['line_height'] = array(
						'length' => round( $settings->link_typography_line_height['desktop'] / $settings->link_typography_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->link_typography_line_height['medium'] ) && isset( $settings->link_typography_font_size['medium'] ) && 0 != $settings->link_typography_font_size['medium'] && ! isset( $settings->font_typo_medium['line_height'] ) ) {
				if ( is_numeric( $settings->link_typography_line_height['medium'] ) && is_numeric( $settings->link_typography_font_size['medium'] ) ) {
					$settings->font_typo_medium['line_height'] = array(
						'length' => round( $settings->link_typography_line_height['medium'] / $settings->link_typography_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->link_typography_line_height['small'] ) && isset( $settings->link_typography_font_size['small'] ) && 0 != $settings->link_typography_font_size['small'] && ! isset( $settings->font_typo_responsive['line_height'] ) ) {
				if ( is_numeric( $settings->link_typography_line_height['small'] ) && is_numeric( $settings->link_typography_font_size['small'] ) ) {
					$settings->font_typo_responsive['line_height'] = array(
						'length' => round( $settings->link_typography_line_height['small'] / $settings->link_typography_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			foreach ( $settings->screens as $screen ) {

				if ( isset( $screen->link ) ) {
					if ( isset( $screen->target ) ) {
						$screen->link_target = $screen->target;
					}
					if ( isset( $screen->nofollow ) ) {
						$screen->link_nofollow = ( '1' == $screen->nofollow ) ? 'yes' : '';
					}
				}
			}

			if ( isset( $settings->link_typography_font_family ) ) {
				unset( $settings->link_typography_font_family );
				unset( $settings->link_typography_font_size );
				unset( $settings->link_typography_line_height );
			}
		}
		return $settings;
	}
}

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 *
 */

if ( UABB_Compatibility::check_bb_version() ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/creative-link/creative-link-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/creative-link/creative-link-bb-less-than-2-2-compatibility.php';
}
