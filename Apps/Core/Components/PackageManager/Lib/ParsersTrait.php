<?php
/**
 * Webiny Platform (http://www.webiny.com/)
 *
 * @copyright Copyright (c) 2009-2014 Webiny LTD. (http://www.webiny.com/)
 * @license   http://www.webiny.com/platform/license
 */

namespace WebinyPlatform\Apps\Core\Components\PackageManager\Lib;

use Webiny\Component\Config\ConfigObject;
use Webiny\Component\StdLib\StdObjectTrait;
use WebinyPlatform\Apps\Core\Components\DevTools\Lib\DevToolsTrait;

/**
 * Description
 */
trait ParsersTrait
{
    use StdObjectTrait, DevToolsTrait;

    private $_namespace;

    /**
     * Parsers the class namespace based on her path.
     *
     * @param string $path Path to the class.
     */
    protected function _parseNamespace($path) {
        $this->_namespace = $this->str($path)->replace([
                                                           'Public',
                                                           DIRECTORY_SEPARATOR
                                                       ], [
                                                           '\\WebinyPlatform',
                                                           '\\'
                                                       ]
        )->val();
    }

    /**
     * Parses and registers events attached to the component.
     *
     * @param ConfigObject $info Parsed Component.yaml ConfigObject.
     */
    private function _parseEvents(ConfigObject $info) {
        $eventConfig = $info->get('Events', [], true);
        if(count($eventConfig) > 0) {
            foreach ($eventConfig as $eventGroupName => $eventGroups) {
                $eventName = $eventGroupName;
                foreach ($eventGroups as $subGroupName => $subGroupEvents) {
                    $eventName .= '.' . $subGroupName;
                    foreach ($subGroupEvents as $eName => $callback) {
                        $sEventName = $eventName . '.' . $eName;

                        $callback = $this->str($callback)->replace('/', '\\');

                        if(!$callback->contains('::')) {
                            $callback->append('::handle');
                        }

                        if($callback->startsWith('\\')) {
                            $this->_wEvents()->listen($sEventName, $callback->val());
                        } else {
                            $this->_wEvents()->listen($sEventName, $this->_namespace . '\\' . $callback->val());
                        }
                    }
                }
            }
        }
    }

    /**
     * Parses and registers routes attached to the component.
     *
     * @param ConfigObject $info Parsed Component.yaml ConfigObject.
     */
    private function _parseRoutes(ConfigObject $info) {
        $routes = $info->get('Routes', false);
        if($routes) {
            $this->_wRouter()->registerRoutes($routes);
        }
    }
}
