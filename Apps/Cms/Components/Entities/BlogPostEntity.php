<?php
/**
 * Webiny Platform (http://www.webiny.com/)
 *
 * @copyright Copyright (c) 2009-2014 Webiny LTD. (http://www.webiny.com/)
 * @license   http://www.webiny.com/platform/license
 */

namespace WebinyPlatform\Apps\Cms\Components\Entities;

use WebinyPlatform\Apps\Cms\Components\Entities\Generated\BlogPostEntity as GeneratedBlogPostEntity;

class BlogPostEntity extends GeneratedBlogPostEntity {

    /**
    * This is the class you can change as you see fit.
    * Add new methods, override existing ones, add new attributes, whatever you need.
    *
    * If you need to use EntityBuilder at some point, feel free to do so, as we will only overwrite the parent class
    * created by code generator and leave all your code in this class intact.
    *
    * Happy coding! :)
    */

    public function mySuperFunction(){
        return "Applause please, to me ;) :P";
    }

}