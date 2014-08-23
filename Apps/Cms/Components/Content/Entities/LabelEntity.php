<?php
namespace WebinyPlatform\Apps\Cms\Components\Content\Entities;

use WebinyPlatform\Apps\Core\Components\DevTools\Lib\Entity\EntityAbstract;

class LabelEntity extends EntityAbstract
{
	protected static $_entityCollection = "Label";
    protected static $_entityMask = "{label} ({id})";

	protected function _entityStructure() {

		// Char
		$this->attr('label')->char();

        // Many2Many
        $this->attr('pages')->many2many('Label2Page')->setEntity('Cms.Content.PageEntity');
	}
}