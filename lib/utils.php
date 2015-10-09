<?php

namespace Roots\Fire\Utils;

/**
 * Custom search form
 */
function get_search_form() {
    $form = '';
    locate_template('/templates/searchform.php', true, false);
    return $form;
}

add_filter('get_search_form', __NAMESPACE__ . '\\get_search_form');
