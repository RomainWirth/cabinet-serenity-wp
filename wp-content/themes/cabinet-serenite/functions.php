<?php
add_action( 'after_setup_theme', function () {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo', [
        'height'      => 128,
        'width'       => 128,
        'flex-height' => true,
        'flex-width'  => true,
    ] );
    register_nav_menus( [
        'primary' => __( 'Primary Menu', 'cabinet-serenite' ),
    ] );
} );

add_action( 'wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'cabinet-serenite-style',
        get_stylesheet_uri(),
        [],
        wp_get_theme()->get( 'Version' )
    );
} );