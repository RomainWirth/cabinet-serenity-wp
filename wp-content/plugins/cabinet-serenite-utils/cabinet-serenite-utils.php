<?php
/**
 * Plugin Name: Cabinet Sérénité, Utilitaires
 * Description: Fonctionnalités utilitaires indépendantes du thème.
 * Version: 1.0
 * Author: Romain WIRTH
 * Text Domain: cabinet-serenite-utils
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_shortcode( 'nombre_prestations', function() {
    $count = wp_count_posts( 'prestation' );
    $total = $count->publish;

    return $total . ' prestations disponibles';
} );