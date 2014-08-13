<?php
/**
 * Webiny Platform (http://www.webiny.com/)
 *
 * @copyright Copyright (c) 2009-2014 Webiny LTD. (http://www.webiny.com/)
 * @license   http://www.webiny.com/platform/license
 */

namespace WebinyPlatform\Apps\Cms\Components\Entities\Generated;

use WebinyPlatform\Apps\Cms\Components\Entities\PageEntity;

class BlogPostEntity extends PageEntity
{

    protected static $_entityCollection = 'CodeGeneratorBlogPost';

    protected static $_entityMask = 'Blog - {title} ({id})';

    /**
     * @return \Webiny\Component\Entity\Attribute\CharAttribute
     */
    public function getSubTitle() {
        return $this->getAttribute('subTitle');
    }

    /**
     * @return \Webiny\Component\Entity\Attribute\CharAttribute
     */
    public function getAnotherCustomAttribute() {
        return $this->getAttribute('anotherCustomAttribute');
    }

    /**
     * @return \Webiny\Component\Entity\Attribute\TextAttribute
     */
    public function getTeaser() {
        return $this->getAttribute('teaser');
    }

	protected function _entityStructure() {
        parent::_entityStructure();
        $this->attr('subTitle')->char()->setDefaultValue('');
        $this->attr('anotherCustomAttribute')->char()->setDefaultValue('');
        $this->attr('teaser')->text()->setDefaultValue('');
    }
}