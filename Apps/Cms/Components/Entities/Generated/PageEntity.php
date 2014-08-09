<?php
/**
 * Webiny Platform (http://www.webiny.com/)
 *
 * @copyright Copyright (c) 2009-2014 Webiny LTD. (http://www.webiny.com/)
 * @license   http://www.webiny.com/platform/license
 */

namespace WebinyPlatform\Apps\Cms\Components\Entities\Generated;

use WebinyPlatform\Apps\Core\Components\DevTools\Lib\Entity\EntityAbstract;

class PageEntity extends EntityAbstract
{

    protected static $_entityCollection = 'CodeGeneratorPage';

    protected static $_entityMask = '{title} ({id})';

    /**
     * @return \Webiny\Component\Entity\Attribute\CharAttribute
     */
    public function getTitle() {
        return $this->getAttribute('title');
    }

    /**
     * @return \Webiny\Component\Entity\Attribute\TextAttribute
     */
    public function getContent() {
        return $this->getAttribute('content');
    }

    /**
     * @return \Webiny\Component\Entity\Attribute\IntegerAttribute
     */
    public function getTimesViewed() {
        return $this->getAttribute('timesViewed');
    }

    /**
     * @return \Webiny\Component\Entity\Attribute\FloatAttribute
     */
    public function getAbandonedRatio() {
        return $this->getAttribute('abandonedRatio');
    }

    /**
     * @return \Webiny\Component\Entity\Attribute\BooleanAttribute
     */
    public function getViewable() {
        return $this->getAttribute('viewable');
    }

    /**
     * @return \Webiny\Component\Entity\Attribute\SelectAttribute
     */
    public function getStatus() {
        return $this->getAttribute('status');
    }

    /**
     * @return \Webiny\Component\Entity\Attribute\DateTimeAttribute
     */
    public function getCreatedAt() {
        return $this->getAttribute('createdAt');
    }

    /**
     * @return \Webiny\Component\Entity\Attribute\Many2OneAttribute
     */
    public function getAuthor() {
        return $this->getAttribute('author');
    }

    /**
     * @return \Webiny\Component\Entity\Attribute\One2ManyAttribute
     */
    public function getComments() {
        return $this->getAttribute('comments');
    }

    /**
     * @return \Webiny\Component\Entity\Attribute\Many2ManyAttribute
     */
    public function getLabels() {
        return $this->getAttribute('labels');
    }

	protected function _entityStructure() {
        $this->attr('title')->char()->defaultValue('New blog post');
        $this->attr('content')->text()->defaultValue('');
        $this->attr('timesViewed')->integer()->defaultValue(0);
        $this->attr('abandonedRatio')->float()->defaultValue(0);
        $this->attr('viewable')->boolean()->defaultValue(false);
        
        /**
         * Options array for 'status' attribute
         */
        $statusOptions = [
            'draft' => 'Draft',
            'review' => 'Review',
            'published' => 'Published',
            'unpublished' => 'Unpublished'
        ];

        $this->attr('status')->select()->options($statusOptions)->defaultValue('');
        $this->attr('createdAt')->datetime()->format('unix')->defaultValue('now');
        $this->attr('author')->many2one()->entity('\Apps\Cms\Entities\Author')->required(true);
        $this->attr('comments')->one2many('blogPost')->entity('\Apps\Cms\Entities\Comment')->onDelete('restrict')->required(true);
        $this->attr('labels')->many2many('Post2Label')->entity('\Apps\Cms\Entities\Label');
    }
}