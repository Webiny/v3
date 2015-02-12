<?php
namespace WebinyPlatform\Tests\Entity\MyClasses;

use WebinyPlatform\Apps\Core\Components\DevTools\Lib\Entity\EntityAbstract;

class Settings extends EntityAbstract
{
	protected static $_entityCollection = "Settings";
	protected static $_entityMask = '{tag} ({id})';

	protected function _entityStructure() {
		// Char
		$this->attr('tag')->char()->setRequired();
		$this->attr('settings')->arr()->setDefaultValue([]);

	}
}