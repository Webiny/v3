{"\n"}${$attribute.name}Options = [
    {foreach from=$attribute.options item=option key=i name=loop}'{$i}' => '{$option}'{if not $smarty.foreach.loop.last},{/if}{"\n"}{/foreach}
];{"\n"}
$this->attr('{$attribute.name}')->select()->options(${$attribute.name}Options){if isset($attribute.defaultValue)}->defaultValue('{$attribute.defaultValue}'){/if}{if isset($attribute.required) && $attribute.required == true}->required(true){/if};