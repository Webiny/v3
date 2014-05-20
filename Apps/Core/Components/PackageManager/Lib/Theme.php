<?php
/**
 * Webiny Platform (http://www.webiny.com/)
 *
 * @copyright Copyright (c) 2009-2014 Webiny LTD. (http://www.webiny.com/)
 * @license   http://www.webiny.com/platform/license
 */

namespace WebinyPlatform\Apps\Core\Components\PackageManager\Lib;

use Webiny\Component\Config\ConfigObject;

/**
 * Description
 */
class Theme extends PackageAbstract
{
    /**
     * Base theme constructor.
     *
     * @param ConfigObject $info
     * @param string       $path
     */
    public function __construct(ConfigObject $info, $path)
    {
        parent::__construct($info, $path, "theme");
    }

}