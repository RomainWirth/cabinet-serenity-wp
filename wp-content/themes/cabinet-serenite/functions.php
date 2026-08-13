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

add_action( 'admin_post_cabinet_contact_submit', 'handle_contact_form_submission' );
add_action( 'admin_post_nopriv_cabinet_contact_submit', 'handle_contact_form_submission' );

function handle_contact_form_submission() {
    $contact_page_url = get_permalink( get_page_by_path( 'contact' ) );
    if ( ! isset( $_POST['cabinet_contact_nonce'] ) || ! wp_verify_nonce( $_POST['cabinet_contact_nonce'], 'cabinet_contact_action' ) ) {
        wp_safe_redirect( add_query_arg( 'contact', 'error', $contact_page_url ) );
        exit;
    }

    $name = sanitize_text_field( $_POST['name'] );
    $email = sanitize_email( $_POST['email'] );
    if ( ! is_email( $email ) ) {
        wp_safe_redirect( add_query_arg( 'contact', 'error', $contact_page_url ) );
        exit;
    }
    $message = sanitize_textarea_field( $_POST['message'] );

    // Here you can handle the form submission, e.g., send an email or save to the database.
    // For example, sending an email:
    $to = get_option( 'admin_email' );
    $subject = 'New Contact Form Submission';
    $body = "Name: $name\nEmail: $email\nMessage:\n$message";
    $headers = [ 'Content-Type: text/plain; charset=UTF-8' ];

    wp_mail( $to, $subject, $body, $headers );

    // Redirect back to the contact page with a success message
    wp_safe_redirect( add_query_arg( 'contact', 'success', $contact_page_url ) );
    exit;
}