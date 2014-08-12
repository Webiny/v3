<?php
namespace WebinyPlatform\Tests\Entity\MyClasses;

use WebinyPlatform\Apps\Core\Components\DevTools\Lib\Entity\EntityAbstract;

class Label extends EntityAbstract
{
	protected static $_entityCollection = "Label";
    protected static $_entityMask = "{label} ({id})";

	protected function _entityStructure() {

		// Char
		$this->attr('label')->char();

        // Many2Many
        $this->attr('pages')->many2many('Label2Page')->entity('\Webiny\Component\Entity\Tests\Classes\Page');
	}
}