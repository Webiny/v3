<?php
namespace WebinyPlatform\Apps\Cms\Components\Content\Entities;

use WebinyPlatform\Apps\Core\Components\DevTools\Lib\Entity\EntityAbstract;

class AuthorEntity extends EntityAbstract
{
	protected static $_entityCollection = "Author";
    protected static $_entityMask = "{name} ({id})";

	protected function _entityStructure() {

		$this->attr('name')->char();

        $this->attr('comments')->one2many('author')->setEntity('Cms.Content.CommentEntity');
	}
}