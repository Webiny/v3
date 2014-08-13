

        /**
         * Options array for '{$attribute.name}' attribute
         */
        ${$attribute.name}Options = [
{foreach from=$attribute.options item=option key=i name=loop}
            '{$i}' => '{$option}'{if not $smarty.foreach.loop.last},{/if}

{/foreach}
        ];

        $this->attr('{$attribute.name}')->select()->setOptions(${$attribute.name}Options){if isset($attribute.defaultValue)}->setDefaultValue('{$attribute.defaultValue}'){/if}{if isset($attribute.required) && $attribute.required == true}->setRequired(true){/if};