<?php
/**
 * Webiny Platform (http://www.webiny.com/)
 *
 * @copyright Copyright (c) 2009-2014 Webiny LTD. (http://www.webiny.com/)
 * @license   http://www.webiny.com/platform/license
 */

namespace WebinyPlatform\Apps\Core\Components\DevTools\Lib;

use Webiny\Component\StdLib\SingletonTrait;
use Webiny\Component\TemplateEngine\TemplateEngineTrait;

/**
 * Class that provides access to template engine
 */
class TemplateEngine
{
    use SingletonTrait, TemplateEngineTrait;

    /**
     * @var \Webiny\Component\TemplateEngine\Bridge\TemplateEngineInterface
     */
    static private $_templateEngine;

    protected function _init()
    {
        self::$_templateEngine = $this->templateEngine('Smarty');

        /**
         * @TODO: Add registration of template engine plugins from apps and plugins
         */
    }

    /**
     * @return \Webiny\Component\TemplateEngine\Bridge\TemplateEngineInterface
     */
    public function getTemplateEngine()
    {
        return self::$_templateEngine;
    }

}