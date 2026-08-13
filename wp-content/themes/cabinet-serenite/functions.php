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

add_action( 'init', function () {
    add_post_type_support( 'page', 'excerpt' );
} );
add_action( 'init', 'register_post_type_prestation' );
add_action('init', 'register_type_taxonomy_prestation');

add_action( 'wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'cabinet-serenite-style',
        get_stylesheet_uri(),
        [],
        wp_get_theme()->get( 'Version' )
    );
} );

function register_post_type_prestation() {
    $args = [
        'labels' => [
            'name' => __( 'Prestations', 'cabinet-serenite' ),
            'singular_name' => __( 'Prestation', 'cabinet-serenite' ),
        ],
        'public' => true,
        'has_archive' => "prestations",
        'rewrite' => [ 'slug' => 'prestations' ],
        'supports' => [ 'title', 'editor', 'thumbnail' ],
    ];
    register_post_type( 'prestation', $args );
}

function register_type_taxonomy_prestation() {
    $args = [
        'labels' => [
            'name' => __( 'Types de prestations', 'cabinet-serenite' ),
            'singular_name' => __( 'Type de prestation', 'cabinet-serenite' ),
        ],
        'public' => true,
        'hierarchical' => true,
        'rewrite' => [ 'slug' => 'type-prestations' ],
    ];
    register_taxonomy( 'type_prestation', [ 'prestation' ], $args );
}