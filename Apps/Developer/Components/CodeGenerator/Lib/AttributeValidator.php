<?php
/**
 * Webiny Platform (http://www.webiny.com/)
 *
 * @copyright Copyright (c) 2009-2014 Webiny LTD. (http://www.webiny.com/)
 * @license   http://www.webiny.com/platform/license
 */

namespace WebinyPlatform\Apps\Developer\Components\CodeGenerator\Lib;

use Webiny\Component\StdLib\StdLibTrait;
use Webiny\Component\StdLib\SingletonTrait;
use Webiny\Component\StdLib\StdObject\ArrayObject\ArrayObject;

/**
 * Class AttributeValidator validates CodeGenerator attributes, normalizes attribute names and removes unsupported attribute types
 *
 * @package WebinyPlatform\Apps\Developer\Components\CodeGenerator\Lib
 */
class AttributeValidator
{
    use SingletonTrait, StdLibTrait;

    private $_possibleAttributes = [
        'char'      => 'Char',
        'text'      => 'Text',
        'integer'   => 'Integer',
        'float'     => 'Float',
        'boolean'   => 'Boolean',
        'select'    => 'Select',
        'datetime'  => 'DateTime',
        'date'      => 'Date',
        'many2one'  => 'Many2One',
        'many2many' => 'Many2Many',
        'one2many'  => 'One2Many',
    ];

    /**
     * @var ArrayObject
     */
    private $_attributeNames;

    protected function init() {
        $this->_possibleAttributes = $this->arr($this->_possibleAttributes);
    }

    public function validate(&$attributes = []) {
        $this->_attributeNames = $this->arr();
        foreach ($attributes as $key => $attribute) {
            $attribute = $this->arr($attribute);

            /**
             * Make sure attribute name is set
             */
            if(!$attribute->keyExists('name')) {
                throw new CodeGeneratorException(CodeGeneratorException::ATTRIBUTE_NAME_NOT_FOUND);
            }

            /**
             * Normalize attribute name
             */
            $attribute->key('name', $this->_normalizeAttributeName($attribute->key('name')));

            if($this->_attributeNames->inArray($attribute->key('name'))) {
                throw new CodeGeneratorException(CodeGeneratorException::DUPLICATE_ATTRIBUTE_NAME_FOUND, [$attribute->key('name')]);
            }

            /**
             * Make sure attribute type is specified
             */
            if(!$attribute->keyExists('type')) {
                throw new CodeGeneratorException(CodeGeneratorException::ATTRIBUTE_TYPE_NOT_FOUND, [$attribute->key('name')]);
            }

            /**
             * Remove attribute if specified type doesn't exist in the system
             */
            if(!$this->_possibleAttributes->keyExists($attribute->key('type'))) {
                unset($attributes[$key]);
            }

            /**
             * Check required value
             */
            if(!$attribute->keyExists('required')) {
                throw new CodeGeneratorException(CodeGeneratorException::REQUIRED_PROPERTY_NOT_FOUND, [$attribute->key('name')]);
            }

            /**
             * Validate 'required' property value
             */
            if($attribute->key('required') != 'true' && $attribute->key('required') != 'false') {
                throw new CodeGeneratorException(CodeGeneratorException::INVALID_REQUIRED_PROPERTY_VALUE, [
                    $attribute->key('name'),
                    "true or false",
                    $attribute->key('required')
                ]);
            }

            $typeClass = $this->_possibleAttributes->key($attribute->key('type'));
            if(method_exists($this, '_validate' . $typeClass)) {
                $this->{'_validate' . $typeClass}($attribute);
            }

            $attributes[$key] = $attribute->val();
        }
    }

    protected function _validateSelect(ArrayObject $attribute) {
        /**
         * Check options
         */
        if(!$attribute->keyExists('options')) {
            throw new CodeGeneratorException(CodeGeneratorException::OPTIONS_PROPERTY_NOT_FOUND, [$attribute->key('name')]);
        }

        if(!$this->isArray($attribute->key('options')) && !$this->isArrayObject($attribute->key('options'))) {
            throw new CodeGeneratorException(CodeGeneratorException::INVALID_OPTIONS_PROPERTY_VALUE, [
                $attribute->key('name'),
                'array or ArrayObject',
                gettype($attribute->key('options'))
            ]);
        }
    }

    protected function _validateDateTime(ArrayObject $attribute) {
        if(!$attribute->keyExists('autoUpdate')) {
            throw new CodeGeneratorException(CodeGeneratorException::DATE_ATTRIBUTE_AUTO_UPDATE_PROPERTY_NOT_FOUND, [$attribute->key('name')]);
        }

        $possibleValues = $this->arr([
                                         'true',
                                         'false',
                                     ]);
        if(!$possibleValues->inArray($attribute->key('autoUpdate'))) {
            throw new CodeGeneratorException(CodeGeneratorException::INVALID_DATE_AUTO_UPDATE_PROPERTY_VALUE, [
                $attribute->key('name'),
                'true or false',
                $attribute->key('autoUpdate')
            ]);
        }
    }

    protected function _validateDate(ArrayObject $attribute) {
        if(!$attribute->keyExists('autoUpdate')) {
            throw new CodeGeneratorException(CodeGeneratorException::DATE_ATTRIBUTE_AUTO_UPDATE_PROPERTY_NOT_FOUND, [$attribute->key('name')]);
        }

        $possibleValues = $this->arr([
                                         'true',
                                         'false',
                                     ]);
        if(!$possibleValues->inArray($attribute->key('autoUpdate'))) {
            throw new CodeGeneratorException(CodeGeneratorException::INVALID_DATE_AUTO_UPDATE_PROPERTY_VALUE, [
                $attribute->key('name'),
                'true or false',
                $attribute->key('autoUpdate')
            ]);
        }
    }

    protected function _validateMany2One(ArrayObject $attribute) {
        /**
         * Check entity
         */
        if(!$attribute->keyExists('entity')) {
            throw new CodeGeneratorException(CodeGeneratorException::ENTITY_PROPERTY_NOT_FOUND, [$attribute->key('name')]);
        }

        /*if(!class_exists($attribute->key('entity'))) {
            throw new CodeGeneratorException(CodeGeneratorException::ENTITY_CLASS_NOT_FOUND, [
                $attribute->key('entity'),
                $attribute->key('name')
            ]);
        }*/
    }

    protected function _validateOne2Many(ArrayObject $attribute) {
        /**
         * Check entity
         */
        if(!$attribute->keyExists('entity')) {
            throw new CodeGeneratorException(CodeGeneratorException::ENTITY_PROPERTY_NOT_FOUND, [$attribute->key('name')]);
        }

        /*if(!class_exists($attribute->key('entity'))) {
            throw new CodeGeneratorException(CodeGeneratorException::ENTITY_CLASS_NOT_FOUND, [
                $attribute->key('entity'),
                $attribute->key('name')
            ]);
        }*/

        /**
         * Check related attribute
         */
        if(!$attribute->keyExists('relatedAttribute')) {
            throw new CodeGeneratorException(CodeGeneratorException::RELATED_ATTRIBUTE_PROPERTY_NOT_FOUND, [$attribute->key('name')]);
        }

        /**
         * Check onDelete attribute
         */
        if(!$attribute->keyExists('onDelete')) {
            throw new CodeGeneratorException(CodeGeneratorException::ONDELETE_PROPERTY_NOT_FOUND, [$attribute->key('name')]);
        }

        if($attribute->key('onDelete') != 'restrict' && $attribute->key('onDelete') != 'cascade') {
            throw new CodeGeneratorException(CodeGeneratorException::INVALID_ONDELETE_PROPERTY_VALUE, [
                $attribute->key('name'),
                'restrict or cascade',
                $attribute->key('onDelete')
            ]);
        }
    }

    protected function _validateMany2Many(ArrayObject $attribute) {
        /**
         * Check entity
         */
        if(!$attribute->keyExists('entity')) {
            throw new CodeGeneratorException(CodeGeneratorException::ENTITY_PROPERTY_NOT_FOUND, [$attribute->key('name')]);
        }

        /*if(!class_exists($attribute->key('entity'))) {
            throw new CodeGeneratorException(CodeGeneratorException::ENTITY_CLASS_NOT_FOUND, [
                $attribute->key('entity'),
                $attribute->key('name')
            ]);
        }*/

        /**
         * Check collection attribute
         */
        if(!$attribute->keyExists('collection')) {
            throw new CodeGeneratorException(CodeGeneratorException::COLLECTION_PROPERTY_NOT_FOUND, [$attribute->key('name')]);
        }
    }

    /**
     * Try converting messy strings to camelCase strings
     *
     * @param $name
     *
     * @return string
     */
    private function _normalizeAttributeName($name) {
        if($this->str($name)->replace([
                                          '_',
                                          '-'
                                      ], ' ')->subStringCount(' ') > 0
        ) {
            $name = $this->str($name)->caseLower()->val();
            $name = preg_replace('/([a-z0-9])?([A-Z])/', '$1 $2', $name);

            return $this->str($name)->replace('_', ' ')->caseLower()->explode(' ')->map('ucfirst')->implode('')
                        ->caseFirstLower()->val();
        }

        return $name;
    }
}