<?php
/**
 * Tech Tecnic Child Theme — functions.php
 * Generado con WebGen · Fase 3
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// ─────────────────────────────────────────────────────────
// Enqueue: fuentes, CSS del theme, GSAP, Lenis, main.js
// ─────────────────────────────────────────────────────────
function webgen_techtecnic_enqueue_assets() {

    // Google Fonts: Syne + Inter + JetBrains Mono
    wp_enqueue_style(
        'webgen-fonts',
        'https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=Inter:ital,wght@0,400;0,500;0,600;1,400&family=JetBrains+Mono:wght@400;500&display=swap',
        [],
        null
    );

    // CSS del theme (tokens + globales)
    wp_enqueue_style(
        'webgen-theme',
        get_stylesheet_directory_uri() . '/style.css',
        [ 'webgen-fonts' ],
        '1.0.0'
    );

    // GSAP core
    wp_enqueue_script(
        'gsap',
        'https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/gsap.min.js',
        [],
        '3.12.7',
        true
    );

    // GSAP ScrollTrigger
    wp_enqueue_script(
        'gsap-scrolltrigger',
        'https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/ScrollTrigger.min.js',
        [ 'gsap' ],
        '3.12.7',
        true
    );

    // Lenis smooth scroll
    wp_enqueue_script(
        'lenis',
        'https://cdn.jsdelivr.net/npm/lenis@1.1.14/dist/lenis.min.js',
        [],
        '1.1.14',
        true
    );

    // main.js del theme
    wp_enqueue_script(
        'webgen-main',
        get_stylesheet_directory_uri() . '/js/main.js',
        [ 'gsap', 'gsap-scrolltrigger', 'lenis' ],
        '1.0.0',
        true
    );
}
add_action( 'wp_enqueue_scripts', 'webgen_techtecnic_enqueue_assets' );


// ─────────────────────────────────────────────────────────
// Theme support
// ─────────────────────────────────────────────────────────
function webgen_techtecnic_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ] );
}
add_action( 'after_setup_theme', 'webgen_techtecnic_setup' );


// ─────────────────────────────────────────────────────────
// Schema.org global (Organization + WebSite) via wp_head
// ─────────────────────────────────────────────────────────
function webgen_techtecnic_schema_org() {
    $schema = [
        '@context' => 'https://schema.org',
        '@graph'   => [
            [
                '@type'       => 'Organization',
                '@id'         => home_url( '/#organization' ),
                'name'        => 'Tech Tecnic',
                'url'         => home_url( '/' ),
                'description' => 'Infraestructura tecnológica crítica para empresas que no pueden permitirse fallar.',
                'contactPoint' => [
                    '@type'           => 'ContactPoint',
                    'contactType'     => 'customer support',
                    'availableLanguage' => [ 'Spanish', 'English' ],
                ],
            ],
            [
                '@type' => 'WebSite',
                '@id'   => home_url( '/#website' ),
                'name'  => 'Tech Tecnic',
                'url'   => home_url( '/' ),
            ],
        ],
    ];

    echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
}
add_action( 'wp_head', 'webgen_techtecnic_schema_org' );
