<?php
include 'setup.php';

use Webiny\Component\Mongo\Index\CompoundIndex;
use Webiny\Component\Mongo\Index\SingleIndex;
use Webiny\Component\Mongo\Index\TextIndex;

class TestClass {
    use \Webiny\Component\Mongo\MongoTrait;

    public function createIndexes(){
        $this->mongo()->deleteAllIndexes('Page');

        $singleIndex = new SingleIndex('mySingleIndex', '-title');
        $compoundIndex = new CompoundIndex('myCompoundIndex', ['-title', 'name']);
        $textIndex = new TextIndex('myTextIndex', ['title', 'name']);

        $this->mongo()->createIndex('Page', $singleIndex);
        $this->mongo()->createIndex('Page', $compoundIndex);
        $this->mongo()->createIndex('Page', $textIndex);
    }
}

$testClass = new TestClass();
$testClass->createIndexes();



