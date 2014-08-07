<?php
/**
 * Webiny Platform (http://www.webiny.com/)
 *
 * @copyright Copyright (c) 2009-2014 Webiny LTD. (http://www.webiny.com/)
 * @license   http://www.webiny.com/platform/license
 */

namespace WebinyPlatform\Apps\EntityBuilder\Components\CodeGenerator\Lib;

use Webiny\Component\StdLib\StdLibTrait;
use Webiny\Component\StdLib\StdObjectTrait;
use WebinyPlatform\Apps\Core\Components\DevTools\Lib\DevToolsTrait;
use Webiny\Component\StdLib\SingletonTrait;

/**
 * This class is included in the index.php and it responsible to bootstrap the application.
 */
class CodeGenerator
{
    use SingletonTrait, DevToolsTrait, StdLibTrait;

    private $_structure;
    private $_templatesFolder;
    private $_entitiesFolder;
    private $_generatedEntitiesFolder;
    private $_entityNamespace;
    private $_generatedEntityNamespace;
    private $_typeClass = [
        'char' => 'Char',
        'text' => 'Text',
        'integer' => 'Integer',
        'decimal' => 'Decimal',
        'boolean' => 'Boolean',
        'select' => 'Select',
        'datetime' => 'DateTime',
        'many2one' => 'Many2One',
        'many2many' => 'Many2Many',
        'one2many' => 'One2Many',
    ];

    public function generateEntityClass($structure = []) {
        //die(print_r($this->_wConfig()->getConfig()->toArray()));
        $this->_structure = $this->arr($structure);
        $this->_validateStructure();
        $this->_preparePathsAndNamespaces();
        $this->_generateClasses();
    }

    private function _generateClasses(){
        $entityName = $this->_structure->key('entity');
        $entityCollection = $this->_structure->key('collection');

        /**
         * Determine attribute class
         */
        $attributes = $this->_structure->key('attributes');
        foreach($attributes as $index => $attribute){
            $attributes[$index]['typeClass'] = $this->_typeClass[$attribute['type']];
        }
        $this->_structure->key('attributes', $attributes);


        $data = [
            'entityName' => $entityName,
            'entityCollection' => $entityCollection,
            'entityNamespace' => $this->_entityNamespace,
            'generatedEntityNamespace' => $this->_generatedEntityNamespace,
            'attributes' => $this->_structure->key('attributes'),
            'attributesHtml' => $this->_generateAttributes()
        ];

        /**
         * Generate classes
         */
        $entityClass = $this->_wTemplateEngine()->fetch('AppEntity.tpl', $data);
        $generatedEntityClass = $this->_wTemplateEngine()->fetch('GeneratedEntity.tpl', $data);

        @mkdir($this->_generatedEntitiesFolder, 0755, true);
        file_put_contents($this->_entitiesFolder.$entityName.'Entity.php', $entityClass);
        file_put_contents($this->_generatedEntitiesFolder.$entityName.'Entity.php', $generatedEntityClass);
    }

    private function _generateAttributes(){
        $attributes = [];
        foreach($this->_structure->key('attributes') as $attribute){
            $attributes[] = $this->_wTemplateEngine()->fetch($this->_templatesFolder.'Attributes/'.$attribute['type'].'.tpl', $attribute);
        }
        return $attributes;
    }

    private function _validateStructure() {
        // @TODO: validate JSON structure and verify all required attributes are set
    }

    private function _preparePathsAndNamespaces() {
        $appName = $this->_structure->key('app');

        /**
         * Locate absolute paths
         */
        $applicationPath = $this->_wConfig()->getConfig()->get('Application.AbsolutePath');
        $this->_templatesFolder = realpath(__DIR__ . '/../') . '/Templates/';
        $this->_entitiesFolder = $applicationPath . 'Public/Apps/' . $appName . '/Component/Entities/';
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