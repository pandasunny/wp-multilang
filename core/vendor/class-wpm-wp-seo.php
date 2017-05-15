<?php

namespace WPM\Core\Vendor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( defined( 'WPSEO_VERSION' ) ) {

	class WPM_Yoast_Seo {

		public function __construct() {
			add_filter( 'wpm_option_wpseo_titles_config', array( $this, 'set_posts_config' ) );
			add_filter( 'wpseo_title', array( $this, 'translate_title' ), 0 );
		}


		public function set_posts_config( $config ) {

			$post_types = get_post_types();

			foreach ( $post_types as $post_type ) {
				$post_config = array(
					"title-{$post_type}"              => array(),
					"metadesc-{$post_type}"           => array(),
					"title-ptarchive-{$post_type}"    => array(),
					"metadesc-ptarchive-{$post_type}" => array(),
				);

				$config = wpm_array_merge_recursive( $config, $post_config );
			}

			$taxonomies = get_taxonomies();

			foreach ( $taxonomies as $taxonomy ) {
				$tax_config = array(
					"title-tax-{$taxonomy}"    => array(),
					"metadesc-tax-{$taxonomy}" => array()
				);

				$config = wpm_array_merge_recursive( $config, $tax_config );
			}

			return $config;
		}


		public function translate_title( $title ) {
			$yseo_options      = get_option( 'wpseo_titles' );
			$separator_options = \WPSEO_Option_Titles::get_instance()->get_separator_options();
			$separator         = ' ' . $separator_options[ $yseo_options['separator'] ] . ' ';
			$titles_part       = explode( $separator, $title );
			$titles_part       = wpm_translate_value( $titles_part );
			$title             = implode( $separator, $titles_part );

			return $title;
		}
	}

	new WPM_Yoast_Seo();
}
