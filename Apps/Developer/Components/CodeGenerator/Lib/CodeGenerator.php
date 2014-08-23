<?php
/**
 * Webiny Platform (http://www.webiny.com/)
 *
 * @copyright Copyright (c) 2009-2014 Webiny LTD. (http://www.webiny.com/)
 * @license   http://www.webiny.com/platform/license
 */

namespace WebinyPlatform\Apps\Developer\Components\CodeGenerator\Lib;

use Webiny\Component\StdLib\StdLibTrait;
use Webiny\Component\StdLib\StdObject\ArrayObject\ArrayObject;
use Webiny\Component\StdLib\StdObject\StdObjectWrapper;
use Webiny\Component\StdLib\StdObjectTrait;
use WebinyPlatform\Apps\Core\Components\DevTools\Lib\DevToolsTrait;
use Webiny\Component\StdLib\SingletonTrait;

/**
 * This class is included in the index.php and it responsible to bootstrap the application.
 */
class CodeGenerator
{
    use SingletonTrait, DevToolsTrait, StdLibTrait;

    /**
     * @var ArrayObject
     */
    private $_structure;
    private $_templatesFolder;
    private $_entitiesFolder;
    private $_generatedEntitiesFolder;
    private $_entityNamespace;
    private $_generatedEntityNamespace;
    private $_typeClass = [
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

    public function generateEntityClass($structure = []) {
        //die(print_r($this->_wConfig()->getConfig()->toArray()));
        $this->_structure = $this->arr($structure);
        $this->_validateStructure();
        $this->_preparePathsAndNamespaces();
        $this->_generateClasses();
    }

    private function _generateClasses() {
        $entityName = $this->_structure->key('entity');
        $entityMask = $this->_structure->key('mask', '', true);
        $entityCollection = $this->_structure->key('collection', '', true);
        $parentEntity = $this->_structure->key('parentEntity', false, true);
        $parentEntityClass = '';
        $parentEntityNamespace = '';

        if($parentEntity) {
            $parentEntityNamespace = $this->str($parentEntity)->trimLeft("\\")->explode('\\')
                                          ->removeLast($parentEntityClass)->implode('\\')->val();
        }

        /**
         * Determine attribute class
         */
        $attributes = $this->_structure->key('attributes', [], true);
        foreach ($attributes as $index => $attribute) {
            $attributes[$index]['typeClass'] = $this->_typeClass[$attribute['type']];
            if(isset($attribute['required'])) {
                $attributes[$index]['required'] = StdObjectWrapper::toBool($attribute['required']);
            }
        }
        $this->_structure->key('attributes', $attributes);


        $data = [
            'entityName'               => $entityName,
            'entityMask'               => $entityMask,
            'entityCollection'         => $entityCollection,
            'entityNamespace'          => $this->_entityNamespace,
            'parentEntity'             => $parentEntity,
            'parentEntityClass'        => $parentEntityClass,
            'parentEntityNamespace'    => $parentEntityNamespace,
            'generatedEntityNamespace' => $this->_generatedEntityNamespace,
            'attributes'               => $this->_structure->key('attributes')
        ];

        system("rm -rf /var/tmp/smarty/*");

        /**
         * Generate public class if it doesn't exist already
         */
        @mkdir($this->_generatedEntitiesFolder, 0755, true);
        $filePath = $this->_entitiesFolder . $entityName . 'Entity.php';
        if(!file_exists($filePath)) {
            $entityClass = $this->_wTemplateEngine()->fetch('AppEntity.tpl', $data);
            file_put_contents($filePath, $entityClass, LOCK_EX);
        }

        /**
         * Generate system class used as public class parent
         */
        $generatedFilePath = $this->_generatedEntitiesFolder . $entityName . 'Entity.php';
        $generatedEntityClass = $this->_wTemplateEngine()->fetch('GeneratedEntity.tpl', $data);
        @unlink($generatedFilePath);
        file_put_contents($generatedFilePath, $generatedEntityClass);
    }

    private function _validateStructure() {
        if($this->_structure->key('app', '', true) == '') {
            throw new CodeGeneratorException(CodeGeneratorException::APP_NAME_NOT_FOUND);
        }

        if($this->_structure->key('entity', '', true) == '') {
            throw new CodeGeneratorException(CodeGeneratorException::ENTITY_NAME_NOT_FOUND);
        }

        if($this->_structure->key('parentEntity', '', true) == '') {
            // Make sure we have collection set for new entity
            if($this->_structure->key('collection', '', true) == '') {
                throw new CodeGeneratorException(CodeGeneratorException::COLLECTION_NAME_NOT_FOUND);
            }
        }

        /**
         * Validate attributes and fix values if necessary (by reference).
         * After successful validation, assign $attributes back to entity structure.
         */
        $attributes = $this->_structure->key('attributes', [], true);
        AttributeValidator::getInstance()->validate($attributes);
        $this->_structure->key('attributes', $attributes);
    }

    private function _preparePathsAndNamespaces() {
        $appName = $this->_structure->key('app');

        /**
         * Locate absolute paths
         */
        $applicationPath = $this->_wConfig()->getConfig()->get('Application.AbsolutePath');
        $this->_templatesFolder = realpath(__DIR__ . '/../') . '/Templates/';
        $this->_entitiesFolder = $applicationPath . 'Public/Apps/' . $appName . '/Components/Entities/Lib/';
        $this->_generatedEntitiesFolder = $this->_entitiesFolder . 'Generated/';

        /**
         * Build entity namespaces
         */
        $this->_entityNamespace = 'WebinyPlatform\Apps\\' . $appName . '\Components\Entities';
        $this->_generatedEntityNamespace = 'WebinyPlatform\Apps\\' . $appName . '\Components\Entities\Generated';

        /**
         * Point to CodeGenerator templates folder
         */
        $this->_wTemplateEngine()->setTemplateDir($this->_templatesFolder);
    }
}