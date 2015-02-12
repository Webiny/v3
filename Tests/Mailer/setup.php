<?php
/**
 * Webiny Platform (http://www.webiny.com/)
 *
 * @copyright Copyright (c) 2009-2014 Webiny LTD. (http://www.webiny.com/)
 * @license   http://www.webiny.com/platform/license
 */
use Webiny\Component\ClassLoader\ClassLoader;
use Webiny\Component\Mongo\Mongo;
use WebinyPlatform\Apps\Core\Components\Bootstrap\Lib\Bootstrap;
use WebinyPlatform\Apps\Core\Components\DevTools\Lib\Entity\Entity;
use WebinyPlatform\Tests\Entity\EntityDataArchiver;


/**
 * Get absolute path to app root.
 */
$absPath = realpath(dirname(__FILE__) . '/../../../') . '/';

/**
 * Register default autoloader before we can do anything else.
 */
require $absPath . 'Vendors/vendor/autoload.php';
ClassLoader::getInstance()->registerMap([
                                            'WebinyPlatform' => $absPath . 'Public'
                                        ]
);

/**
 * Initialize the bootstrap
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);