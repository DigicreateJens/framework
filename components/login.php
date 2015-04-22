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
 * Custom login logo.
 *
 * @return void
 */
add_action('login_head', function () {
    $path = get_template_directory_uri().config('login.image.path');
    $width = sprintf('%spx', config('login.image.width'));

    echo "<style> h1 a { background-image:url($path) !important; background-size: 100% auto !important; width: $width !important; } </style>";
});

/**
 * Add custom login error message.
 */
add_filter('login_errors', function () {
    return config('login.error_message');
});

/**
 * Custom login logo url.
 *
 * @return string
 */
add_filter('login_headerurl', function () {
    return get_site_url();
});
