<?php
/**
 * Webiny Platform (http://www.webiny.com/)
 *
 * @copyright Copyright (c) 2009-2014 Webiny LTD. (http://www.webiny.com/)
 * @license   http://www.webiny.com/platform/license
 */

namespace {$generatedEntityNamespace};

use WebinyPlatform\Apps\Core\Components\DevTools\Lib\Entity\EntityAbstract;

class {$entityName}Entity extends EntityAbstract {

    protected static $_entityCollection = '{$entityCollection}';

    {foreach from=$attributes item=attribute}
/**
    * @return \Webiny\Component\Entity\Attribute\{$attribute['typeClass']}Attribute
    */
    public function get{$attribute['name']|ucfirst}(){
        return $this->getAttribute('{$attribute['name']}');
    }

    {/foreach}

	protected function _entityStructure() {
    {foreach from=$attributes item=attribute}
    {include file="./Attributes/{$attribute['type']}.tpl" attribute=$attribute}
    {/foreach}
    }
}