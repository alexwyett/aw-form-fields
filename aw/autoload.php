<?php

/**
 * AW Form Fields autoloader.
 *
 * PHP Version 5.3
 *
 * @category  FormFields
 * @package   AW
 * @author    Alex Wyett <alex@wyett.co.uk>
 * @copyright 2013 Alex Wyett
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link      http://www.github.com/alexwyett
 */

namespace aw;
define('DS', DIRECTORY_SEPARATOR);
spl_autoload_extensions(".class.php");
spl_autoload_register(
    function ($className) {
        $file = str_replace('\\', DS, $className) . '.class.php';
        $file = dirname(__FILE__) . DS . '..' . DS . $file;
        if (file_exists($file)) {
            include $file;
        }
    }
);