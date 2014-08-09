<?php
/**
 * Webiny Platform (http://www.webiny.com/)
 *
 * @copyright Copyright (c) 2009-2014 Webiny LTD. (http://www.webiny.com/)
 * @license   http://www.webiny.com/platform/license
 */
use Webiny\Component\ClassLoader\ClassLoader;
use WebinyPlatform\Apps\Core\Components\Bootstrap\Lib\Bootstrap;
use WebinyPlatform\Apps\Developer\Components\CodeGenerator\Lib\CodeGenerator;

/**
 * Get absolute path to app root.
 */
$absPath = realpath(dirname(__FILE__) . '/../../../') . '/';

/**
 * Register default autoloader before we can do anything else.
 */
require $absPath . 'Vendors/Webiny/Component/ClassLoader/ClassLoader.php';
ClassLoader::getInstance()->registerMap([
                                            'WebinyPlatform' => $absPath . 'Public',
                                            'Webiny'         => $absPath . 'Vendors/Webiny'
                                        ]
);

/**
 * Initialize the bootstrap
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);
Bootstrap::getInstance();

$entityStructure = json_decode(file_get_contents('./Json/EntityStructure.json'), true);
CodeGenerator::getInstance()->generateEntityClass($entityStructure);
