<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>

    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.21.6/dist/css/uikit.min.css" />

    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.21.6/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.21.6/dist/js/uikit-icons.min.js"></script>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header>
    <nav class="uk-navbar-container" uk-navbar>
        <div class="uk-navbar-left">
            <a class="uk-navbar-item uk-logo" href="<?php echo esc_url(home_url('/')); ?>">
                <?php bloginfo('name'); ?>
            </a>
        </div>

        <div class="uk-navbar-right">
            <ul class="uk-navbar-nav">
                <?php
                // メインメニューアイテム
                $menu_items = wp_get_nav_menu_items('primary');
                if ($menu_items) {
                    $parent_items = array();
                    $child_items = array();

                    // 親と子のメニューアイテムを分類
                    foreach ($menu_items as $item) {
                        if ($item->menu_item_parent == 0) {
                            $parent_items[$item->ID] = $item;
                        } else {
                            $child_items[$item->menu_item_parent][] = $item;
                        }
                    }

                    // メニューを出力
                    foreach ($parent_items as $parent) {
                        $has_children = isset($child_items[$parent->ID]);

                        if ($has_children) {
                            // ドロップダウンありのメニューアイテム
                            ?>
                            <li>
                                <a href="<?php echo esc_url($parent->url); ?>"><?php echo esc_html($parent->title); ?></a>
                                <div class="uk-navbar-dropdown" uk-drop="boundary: !nav; boundary-align: true; pos: bottom-justify;">
                                    <ul class="uk-nav uk-navbar-dropdown-nav">
                                        <?php foreach ($child_items[$parent->ID] as $child) : ?>
                                            <li><a href="<?php echo esc_url($child->url); ?>"><?php echo esc_html($child->title); ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </li>
                            <?php
                        } else {
                            // 通常のメニューアイテム
                            ?>
                            <li><a href="<?php echo esc_url($parent->url); ?>"><?php echo esc_html($parent->title); ?></a></li>
                            <?php
                        }
                    }
                } else {
                    // デフォルトメニュー（メニューが設定されていない場合）
                    ?>
                    <li><a href="<?php echo esc_url(home_url('/')); ?>">ホーム</a></li>
                    <li>
                        <a href="#">サンプル</a>
                        <div class="uk-navbar-dropdown" uk-drop="boundary: !nav; boundary-align: true; pos: bottom-justify;">
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li><a href="#">サブメニュー 1</a></li>
                                <li><a href="#">サブメニュー 2</a></li>
                                <li><a href="#">サブメニュー 3</a></li>
                            </ul>
                        </div>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </nav>
</header>

<div id="content" class="site-content">
