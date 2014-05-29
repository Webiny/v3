<?php
/**
 * Webiny Platform (http://www.webiny.com/)
 *
 * @copyright Copyright (c) 2009-2014 Webiny LTD. (http://www.webiny.com/)
 * @license   http://www.webiny.com/platform/license
 */
use Webiny\Component\ClassLoader\ClassLoader;
use Webiny\Component\Config\ConfigObject;
use Webiny\Component\ServiceManager\ServiceManager;
use WebinyPlatform\Apps\Core\Components\Bootstrap\Lib\Bootstrap;


/**
 * Get absolute path to app root.
 */
$absPath = realpath(dirname(__FILE__) . '/../') . '/';

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


/**
 * SERVICE MANAGER TEST
 */
$parameters = [
    'storage.class' => '\Webiny\Component\Storage\Storage',
    'storage.driver' => '\Webiny\Component\Storage\Driver\AmazonS3\AmazonS3',
    'driver.args' => [
        'AKIAIQ2AM5EWWMP32EZA',
        '/Osx2UOgAV4X+wCkT1UC9j9AexJWXjDxcDQcy3WB',
        'webiny',
        false
    ]
];

$config = [
    'WebinyBucket'  => [
        'Class'     => '%storage.class%',
        'Arguments' => [
            'driver' => [
                'Object'           => '%storage.driver%',
                'ObjectArguments' => '%driver.args%'
            ]
        ],
        'Tags'      => ['cloud'],
    ],
    'PrivateBucket' => [
        'Class'     => '%storage.class%',
        'Arguments' => [
            'driver' => [
                'Object'           => '%storage.driver%',
                'ObjectArguments' => [
                    'AKIAIQ2AM5EWWMP32EZA',
                    '/Osx2UOgAV4X+wCkT1UC9j9AexJWXjDxcDQcy3WB',
                    'private',
                    false
                ]
            ]
        ],
        'Tags'      => ['cloud'],
    ]
];

ServiceManager::getInstance()->registerParameters($parameters)->registerServices('Amazon', new ConfigObject($config));

$amazon = ServiceManager::getInstance()->getService('Amazon.WebinyBucket');

die(print_r($amazon));

