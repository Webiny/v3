<?php
use Webiny\Component\Storage\Storage;

require_once 'setup.php';

class StorageTest{
    use \Webiny\Component\Storage\StorageTrait;

    public function run(){
        Storage::setConfig(realpath(__DIR__ . '/Config.yaml'));

        $storage = $this->storage('CloudStorage');
        $cdnUrl = $storage->getURL('uploads/second.log');

        die($cdnUrl);
    }
}

$st = new StorageTest();
$st->run();