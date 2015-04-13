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
 * Remove unwanted dashboard widgets.
 *
 * @return void
 */
add_action('wp_dashboard_setup', function () {
    global $wp_meta_boxes;

    $positions = config('dashboard.remove_dashboard_widgets');

    foreach ($positions as $position => $boxes) {
        foreach ($boxes as $box) {
            unset($wp_meta_boxes['dashboard'][$position]['core'][$box]);
        }
    }
});
