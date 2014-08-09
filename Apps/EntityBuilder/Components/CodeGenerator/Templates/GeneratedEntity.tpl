<?php
/**
 * Webiny Platform (http://www.webiny.com/)
 *
 * @copyright Copyright (c) 2009-2014 Webiny LTD. (http://www.webiny.com/)
 * @license   http://www.webiny.com/platform/license
 */

namespace {$generatedEntityNamespace};

{if $parentEntity}
use {$parentEntityNamespace}\{$parentEntityClass};
{else}
use WebinyPlatform\Apps\Core\Components\DevTools\Lib\Entity\EntityAbstract;
{/if}

class {$entityName}Entity extends {if $parentEntity}{$parentEntityClass}{else}EntityAbstract{/if}{"\n"}{
{if $entityCollection != ''}

    protected static $_entityCollection = '{$entityCollection}';
{/if}
{if $entityMask != ''}

    protected static $_entityMask = '{$entityMask}';
{/if}

{foreach from=$attributes item=attribute}
    /**
     * @return \Webiny\Component\Entity\Attribute\{$attribute['typeClass']}Attribute
     */
    public function get{$attribute['name']|ucfirst}() {
        return $this->getAttribute('{$attribute['name']}');
    }

{/foreach}
{if count($attributes) > 0}
	protected function _entityStructure() {
{if $parentEntity && count($attributes) > 0}
        parent::_entityStructure();
{/if}
{foreach from=$attributes item=attribute}
        {include file="./Attributes/{$attribute.type}.tpl" attribute=$attribute}
{/foreach}
    }
{/if}
}