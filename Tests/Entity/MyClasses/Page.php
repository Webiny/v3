<?php
namespace WebinyPlatform\Tests\Entity\MyClasses;

use WebinyPlatform\Apps\Core\Components\DevTools\Lib\Entity\EntityAbstract;

class Page extends EntityAbstract
{
	protected static $_entityCollection = "Page";
	protected static $_entityMask = '{title} ({id})';

    protected static function _entityIndexes(){
        return [

        ];
    }

	protected function _entityStructure() {
		// Char
		$this->attr('title')->char()->setRequired();

        // One2Many
		$this->attr('comments')->one2many('page')->setEntity('\WebinyPlatform\Tests\Entity\MyClasses\Comment');

        // Many2Many
        $this->attr('labels')->many2many('Label2Page')->setEntity('\WebinyPlatform\Tests\Entity\MyClasses\Label');
	}
}