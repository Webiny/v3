<?php
/**
 * Webiny Platform (http://www.webiny.com/)
 *
 * @copyright Copyright (c) 2009-2014 Webiny LTD. (http://www.webiny.com/)
 * @license   http://www.webiny.com/platform/license
 */

namespace Webiny\Apps\Core\Components\DevTools\Lib;

/**
 * Abstract class that should be extended by all install script.
 */
abstract class InstallAbstract
{
    /**
     * Callback that should do the installation of the plugin.
     *
     * @param boolean $update If we are doing an update, instead of a fresh install, this is set to TRUE.
     *
     * @throws \Exception
     * @return boolean Should return true if installation was successful. Otherwise throw an exception.
     */
    public abstract function install($update);

    /**
     * Callback that is triggered when the component was successfully installed.
     *
     * @return void
     */
    public abstract function install_successful();

    /**
     * Callback that is triggered when the component installation failed.
     *
     * @return void
     */
    public abstract function install_failed();
}