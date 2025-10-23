<?php
/**
 * AMARGA Bone - Minimal functions
 * @package amarga-bone
 */

// タイトルタグ自動生成
add_action('after_setup_theme', function () {
    add_theme_support('title-tag');

    // ナビゲーションメニュー登録
    register_nav_menus([
        'primary' => __('Primary Menu', 'amarga-bone'),
    ]);
});

// CSS読み込み
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'amarga-bone-style',
        get_stylesheet_uri(),
        [],
        filemtime(get_stylesheet_directory() . '/style.css')
    );
});
