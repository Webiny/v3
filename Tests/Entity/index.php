<?php
/**
 * Webiny Platform (http://www.webiny.com/)
 *
 * @copyright Copyright (c) 2009-2014 Webiny LTD. (http://www.webiny.com/)
 * @license   http://www.webiny.com/platform/license
 */
use Webiny\Component\ClassLoader\ClassLoader;
use Webiny\Component\Mongo\Mongo;
use WebinyPlatform\Apps\Cms\Components\Content\Entities\CommentEntity;
use WebinyPlatform\Apps\Cms\Components\Content\Entities\LabelEntity;
use WebinyPlatform\Apps\Cms\Components\Content\Entities\PageEntity;
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
\WebinyPlatform\Apps\Core\Components\PackageManager\Lib\PackageScanner::getInstance();

Mongo::setConfig(realpath(__DIR__).'/MongoExampleConfig.yaml');
Entity::setConfig(realpath(__DIR__).'/EntityExampleConfig.yaml');



/**
 * ENTITY
 */
$page = new PageEntity();
/*
$page->title = 'New title';

$label = new LabelEntity();
$label->label = 'marketing';

$page->labels->add($label);

$comment = new CommentEntity();
$comment->text = 'First comment';
$page->comments->add($comment);

$page->save();*/


/**
 * ARCHIVER
 */
$archiver = new EntityDataArchiver();
/* $page = PageEntity::findById('53e197ce6803fa12208b4586');
$data = $archiver->archive($page);*/


$restoredEntity = $archiver->restore(get_class($page), '53e197ce6803fa12208b4586');

if($page == $restoredEntity){
    die("EQUAL");
} else {
    print_r($page->toArray());
    print_r($restoredEntity->toArray());
    die("NOT EQUAL");
}