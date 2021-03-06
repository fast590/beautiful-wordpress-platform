<?php
/**
 * This file is a part of the analytica Framework core.
 * Please be cautious editing this file,
 *
 * @category Analytica
 * @package  Energia
 * @author   Franklin Gitonga
 * @link     https://qazana.net/
 */

add_filter( 'body_class', 'analytica_site_layout_body_class' );
/**
 * Add site layout classes to the body classes.
 *
 * @since 1.0.0
 *
 * @uses analytica_site_layout() Return the site layout for different contexts.
 *
 * @param array $classes Existing classes.
 *
 * @return array Amended classes.
 */
function analytica_site_layout_body_class( $classes ) {

    if ( analytica_get_option( 'site-detach-containers' ) && ! analytica_is_builder_page() ) {
        if ( analytica_get_option( 'site-dual-containers' ) ) {
            $classes[] = 'site-dual-containers';
        } else {
            $classes[] = 'site-container-detach';
        }
    } else {
        $classes[] = 'site-mono-container';
    }

    // Current Analytica verion.
    $classes[] = esc_attr( 'analytica-' . wp_get_theme()->version );

    $site_layout = analytica_site_layout();

    $classes[] = analytica_get_option( 'site-layout' );

    if ( $site_layout && ! is_404() ) {
        $classes[] = $site_layout;
    }

    return $classes;
}

/**
 * Retrieve the classes for the header element as an array.
 *
 * @since 1.0.0
 *
 * @param string|array $class One or more classes to add to the class list.
 * @return array Array of classes.
 */
function analytica_get_site_header_class() {

    $header_align_option = analytica_get_option( 'site-header-menu-layout' );
    $header_background_color_option = analytica_get_option( 'site-header-background-color' );
    $header_overlay_option = analytica_get_option( 'site-header-overlay' );
    $header_transparent_option = analytica_get_option( 'site-header-transparent' );

    $classes = array();

    // Add the general site header class
    $classes[] = 'site-header';

    // Primary header class
    $classes[] = 'site-header-primary';

    // Handle overlay / not overlay
    if ( $header_overlay_option ) {
        $classes[] = 'site-header-overlay';
        $classes[] = 'site-header-sticky';
    }

    // Handle overlay / not overlay
    if ( $header_transparent_option ) {
        $classes[] = 'site-header-transparent';
    }

    // Handle invert if background-color light / dark
    $light_or_dark = analytica_light_or_dark( $header_background_color_option, '#000000' /*dark*/, '#FFFFFF' /*light*/ );

    if ( '#FFFFFF' === $light_or_dark && ! empty( $header_background_color_option ) ) {
        $classes[] = 'site-header-invert';
    }

    // Add alignment classes
    if ( 'header-logo-left' == $header_align_option ) {
        $classes[] = 'site-header-left';
    } elseif ( 'header-logo-right' == $header_align_option ) {
        $classes[] = 'site-header-right';
    } elseif ( 'header-logo-top' == $header_align_option ) {
        $classes[] = 'nav-clear';
    } elseif ( 'header-logo-center-top' == $header_align_option ) {
        $classes[] = 'site-header-center';
    }

    // Add width class
    if ( ! analytica_get_option( 'site-header-width' ) ) {
        $classes[] = 'site-header-has-container';
    } else {
        $classes[] = 'site-header-fullwidth';
    }

    return apply_filters( 'analytica_header_class', $classes );
}
