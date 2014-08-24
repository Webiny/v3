<?php
namespace WebinyPlatform\Apps\Cms\Components\Content\Entities;

use WebinyPlatform\Apps\Core\Components\DevTools\Lib\Entity\EntityAbstract;

class CommentEntity extends EntityAbstract
{
	protected static $_entityCollection = "Comment";
    protected static $_entityMask = 'Comment #{id}';

	protected function _entityStructure() {
		$this->attr('text')->char();
		$this->attr('page')->many2one()->setEntity('Cms.Content.PageEntity');
        $this->attr('author')->many2one()->setEntity('Cms.Content.AuthorEntity');

	}
}