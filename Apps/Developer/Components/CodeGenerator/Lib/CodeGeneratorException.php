<?php
/**
 * Webiny Framework (http://www.webiny.com/framework)
 *
 * @link      http://www.webiny.com/wf-snv for the canonical source repository
 * @copyright Copyright (c) 2009-2013 Webiny LTD. (http://www.webiny.com)
 * @license   http://www.webiny.com/framework/license
 */
namespace WebinyPlatform\Apps\Developer\Components\CodeGenerator\Lib;

use Webiny\Component\StdLib\Exception\ExceptionAbstract;

/**
 * Exception class for CodeGenerator
 *
 */
class CodeGeneratorException extends ExceptionAbstract
{

	const APP_NAME_NOT_FOUND = 101;
	const ENTITY_NAME_NOT_FOUND = 102;
	const COLLECTION_NAME_NOT_FOUND = 103;
    const ATTRIBUTE_NAME_NOT_FOUND = 104;
    const ATTRIBUTE_TYPE_NOT_FOUND = 105;
    const DUPLICATE_ATTRIBUTE_NAME_FOUND = 106;
    const REQUIRED_PROPERTY_NOT_FOUND = 107;
    const INVALID_REQUIRED_PROPERTY_VALUE = 108;
    const OPTIONS_PROPERTY_NOT_FOUND = 109;
    const INVALID_OPTIONS_PROPERTY_VALUE = 110;
    const DATE_FORMAT_PROPERTY_NOT_FOUND = 111;
    const INVALID_DATE_FORMAT_PROPERTY_VALUE = 112;
    const ENTITY_PROPERTY_NOT_FOUND = 113;
    const ENTITY_CLASS_NOT_FOUND = 114;
    const RELATED_ATTRIBUTE_PROPERTY_NOT_FOUND = 115;
    const ONDELETE_PROPERTY_NOT_FOUND = 116;
    const INVALID_ONDELETE_PROPERTY_VALUE = 117;
    const COLLECTION_PROPERTY_NOT_FOUND = 118;

    static protected $_messages = [
		101 => "You must specify an app for your entity.",
		102 => "You must specify a name for your entity.",
		103 => "You must specify a collection for your entity.",
		104 => "Attribute name was not found in one of the attributes.",
        105 => "Attribute type was not found in attribute '%s'.",
        106 => "Duplicate attribute name '%s'.",
        107 => "Property 'required' was not found for attribute '%s'.",
        108 => "Invalid 'required' property value for attribute '%s'. Expecting '%s' got '%s'.",
        109 => "Property 'options' was not found for attribute '%s'.",
        110 => "Invalid 'options' property value for attribute '%s'. Expecting '%s' got '%s'.",
        111 => "DateTime 'format' property not found for attribute '%s'.",
        112 => "Invalid DateTime 'format' property value for attribute '%s'. Expecting '%s' got '%s'.",
        113 => "Property 'entity' was not found for attribute '%s'.",
        114 => "Entity class '%s' for attribute '%s' does not exist.",
        115 => "Property 'relatedAttribute' was not found for attribute '%s'.",
        116 => "Property 'onDelete' was not found for attribute '%s'.",
        117 => "Invalid 'onDelete' property value for attribute '%s'. Expecting '%s' got '%s'.",
        118 => "Property 'collection' was not found for attribute '%s'."
	];
}