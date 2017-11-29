<?php
/**
 * Created by PhpStorm.
 * User: todd
 * Date: 09/11/17
 * Time: 7:46 PM.
 */

namespace AppBundle\Util;

use League\CommonMark\CommonMarkConverter;

class Markdown
{
    public static function toHtml($md)
    {
        $converter = new CommonMarkConverter();

        return $converter->convertToHtml($md);
    }
}
