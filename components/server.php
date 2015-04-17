<?php

/*
 * This file is part of WordPlate.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Add Server Information view to WordPress admin.
 *
 * @return void
 */
add_action('admin_menu', function () {
    global $wpdb;

    $parent = 'options-general.php';
    $title = 'Server';
    $permission = 'update_core';
    $slug = 'server-settings';

    add_submenu_page($parent, $title, $title, $permission, $slug, function () use ($wpdb) {
        require __DIR__.'/../views/server.php';
    });
});
