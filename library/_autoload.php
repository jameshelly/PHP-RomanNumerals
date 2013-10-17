<?php
// namespace openTag;
/**
 * openTag/RomanNumeral - rn.openTag.local
 *
 * @category   openTag, RomanNumeral
 * @package    RomanNumeral 
 * @copyright  Copyright (c) 2013 openTag
 * @license    ?
 */

$_map = array (
//    'openTag\\RomanNumeral\\FauxEmber' => __DIR__ . DIRECTORY_SEPARATOR . 'GucciMuseo' . DIRECTORY_SEPARATOR . 'FauxEmber.php',
    // 'openTag\\RomanNumeral\\NotFoundException' => __DIR__ . DIRECTORY_SEPARATOR . 'GucciMuseo' . DIRECTORY_SEPARATOR . 'Exception.php',
    // 'openTag\\RomanNumeral\\Application' => __DIR__ . DIRECTORY_SEPARATOR . 'GucciMuseo' . DIRECTORY_SEPARATOR . 'Application.php',
    // 'openTag\\RomanNumeral\\SiteContext' => __DIR__ . DIRECTORY_SEPARATOR . 'GucciMuseo' . DIRECTORY_SEPARATOR . 'SiteContext.php',
    // 'openTag\\RomanNumeral\\Router' => __DIR__ . DIRECTORY_SEPARATOR . 'GucciMuseo' . DIRECTORY_SEPARATOR . 'Router.php',
    // 'openTag\\RomanNumeral\\SiteData' => 'library' . DIRECTORY_SEPARATOR . 'RomanNumeral' . DIRECTORY_SEPARATOR . 'RomanNumeral.php',
    'RomanNumeral\\RomanNumeral' => __DIR__ . DIRECTORY_SEPARATOR . 'RomanNumeral' . DIRECTORY_SEPARATOR . 'RomanNumeral.php'
);
spl_autoload_register(function($class) use ($_map) {
    if (array_key_exists($class, $_map)) {
        require_once $_map[$class];
    }
});
