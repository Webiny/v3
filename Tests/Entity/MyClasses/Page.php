<?php
namespace WebinyPlatform\Tests\Entity\MyClasses;

use WebinyPlatform\Apps\Core\Components\DevTools\Lib\Entity\EntityAbstract;

class Page extends EntityAbstract
{
	protected static $_entityCollection = "Page";
	protected static $_entityMask = '{title} ({id})';

    protected static function _entityIndexes(){
        return [
            new EntityIndex('myFirstIndex', ['title' => 1]), // Single field index
            new EntityIndex('mySecondIndex', ['title' => 1, 'description' => -1]), // Compound index
            new EntityTextIndex('myTextIndex', ['title']) // Text index
        ];
    }

	protected function _entityStructure() {
		// Char
		$this->attr('title')->char();

        // One2Many
		$this->attr('comments')->one2many('page')->setEntity('\WebinyPlatform\Tests\Entity\MyClasses\Comment');

        // Many2Many
        $this->attr('labels')->many2many('Label2Page')->setEntity('\WebinyPlatform\Tests\Entity\MyClasses\Label');
	}
}