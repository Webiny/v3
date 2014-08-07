<?php
/**
 * Webiny Platform (http://www.webiny.com/)
 *
 * @copyright Copyright (c) 2009-2014 Webiny LTD. (http://www.webiny.com/)
 * @license   http://www.webiny.com/platform/license
 */

namespace WebinyPlatform\Apps\EntityBuilder\Components\CodeGenerator\Lib;

use Webiny\Component\StdLib\StdObjectTrait;
use WebinyPlatform\Apps\Core\Components\DevTools\Lib\DevToolsTrait;
use Webiny\Component\StdLib\SingletonTrait;

/**
 * This class is included in the index.php and it responsible to bootstrap the application.
 */
class CodeGenerator
{
    use SingletonTrait, DevToolsTrait;

    public function generateEntityCode($json = []){
        die(print_r($this->_wConfig()->getConfig()->toArray()));
    }

}