<?php
/**
 * WPM Widget Functions
 *
 * Widget related functions and widget registration.
 *
 * @author        VaLeXaR
 * @category      Core
 * @package       WPM/Functions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Widgets.
 */
function wpm_register_widgets() {
	register_widget( 'WPM\Core\Widgets\WPM_Widget_Language_Switcher' );
}

add_action( 'widgets_init', 'wpm_register_widgets' );
