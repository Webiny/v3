<?php
/**
 * Webiny Framework (http://www.webiny.com/framework)
 *
 * @link      http://www.webiny.com/wf-snv for the canonical source repository
 * @copyright Copyright (c) 2009-2013 Webiny LTD. (http://www.webiny.com)
 * @license   http://www.webiny.com/framework/license
 */

namespace WebinyPlatform\Tests\Entity;

use Webiny\Component\Entity\Attribute\AttributeType;
use Webiny\Component\Mongo\MongoTrait;
use Webiny\Component\StdLib\SingletonTrait;
use Webiny\Component\StdLib\StdLibTrait;
use WebinyPlatform\Apps\Core\Components\DevTools\Lib\Entity\EntityAbstract;


/**
 * EntityDataExtractor class converts EntityAbstract instance to an array representation.
 *
 * @package Webiny\Component\Entity
 */
class EntityDataArchiver
{
    use StdLibTrait, MongoTrait;

    /**
     * @var EntityAbstract
     */
    protected $_entity;

    public function archive(EntityAbstract $entity) {
        $this->_entity = $entity;

        $archive = [
            'entityId'    => $this->_entity->getId()->getValue(),
            'entityClass' => get_class($this->_entity),
            'data'        => $this->_extractData($this->_entity)
        ];

        $this->mongo()->insert('Archive', $archive);

        return $archive;
    }

    public function restore($class, $id) {
        $find = [
            'entityId'    => $id,
            'entityClass' => $class
        ];
        $archive = $this->mongo()->findOne('Archive', $find);

        $entity = new $class;
        $entity->populate($archive['data']);

        die(print_r($entity->toArray()));
    }

    /**
     * Extract EntityAbstract data to array
     *
     * @param $entity
     *
     * @return array
     */
    private function _extractData(EntityAbstract $entity) {
        foreach ($entity->getAttributes() as $attr => $attrInstance) {
            $entityAttribute = $entity->getAttribute($attr);
            $entityAttributeValue = $entityAttribute->getValue();
            $isOne2Many = $this->isInstanceOf($entityAttribute, AttributeType::ONE2MANY);
            $isMany2Many = $this->isInstanceOf($entityAttribute, AttributeType::MANY2MANY);
            $isMany2One = $this->isInstanceOf($entityAttribute, AttributeType::MANY2ONE);

            if($isOne2Many) {
                $data[$attr] = [];
                foreach ($entityAttributeValue as $item) {
                    $attrDataExtractor = new EntityDataArchiver();
                    $data[$attr][] = $attrDataExtractor->_extractData($item);
                }
            } elseif($isMany2Many) {
                $data[$attr] = [];
                foreach ($entityAttributeValue as $item) {
                    $data[$attr][] = $item->getId()->getValue();
                }
            } elseif($isMany2One) {
                $data[$attr] = $entityAttribute->getId()->getValue();
            } else {
                $data[$attr] = $entityAttribute->getValue();
            }
        }

        return $data;
    }

    /**
     * Extract short class name from class namespace
     *
     * @param $class
     *
     * @return string
     */
    private function _extractClassName($class) {
        if(!$this->isString($class)) {
            $class = get_class($class);
        }

        return $this->str($class)->explode('\\')->last()->val();
    }
}