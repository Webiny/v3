<?php
/**
 * Webiny Platform (http://www.webiny.com/)
 *
 * @copyright Copyright (c) 2009-2014 Webiny LTD. (http://www.webiny.com/)
 * @license   http://www.webiny.com/platform/license
 */

namespace Webiny\Apps\Core\Components\DevTools\Lib;

/**
 * Abstract class that should be extended by all uninstall script.
 */
abstract class UninstallAbstract
{
    /**
     * Callback that should do the uninstallation of the plugin.
     *
     * @throws \Exception
     * @return boolean Should return true if uninstall was successful. Otherwise throw an exception.
     */
    public abstract function uninstall();

    /**
     * Callback that is triggered when the component was uninstalled successfully.
     *
     * @return void
     */
    public abstract function uninstall_successful();

    /**
     * Callback that is triggered when the component uninstall failed.
     *
     * @return void
     */
    public abstract function uninstall_failed();
}