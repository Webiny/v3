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

Mongo::setConfig(realpath(__DIR__).'/MongoExampleConfig.yaml');
Entity::setConfig(realpath(__DIR__).'/EntityExampleConfig.yaml');

/**
 * ENTITY
 */
$page = new \WebinyPlatform\Tests\Entity\MyClasses\Page();
$page->title = 'New title';

$label = new \WebinyPlatform\Tests\Entity\MyClasses\Label();
$label->label = 'marketing';

$page->labels->add($label);

$comment = new \WebinyPlatform\Tests\Entity\MyClasses\Comment();
$comment->text = 'First comment';
$page->comments->add($comment);

$page->save();


foreach($page->labels[0]->pages as $page){
    echo $page;
}

