<?php
/**
 * Created by PhpStorm.
 * User: todd
 * Date: 2/22/19
 * Time: 6:26 PM
 */

namespace AppBundle\Rss;

use AppBundle\Entity\Post;

class Xml
{
    public static function generate($data)
    {
        $xml = <<<xml
<?xml version='1.0' encoding='UTF-8'?>
<rss version='2.0'>
<channel>
<title>Todd Eidson's Programming Blog</title>
<link>https://eidson.info</link>
<description>Programming Blog</description>
<language>en-us</language>
xml;
        /** @var Post $datum */
        foreach ($data as $datum) {

            $title = self::xmlEscape($datum->getTitle());
            $url = self::xmlEscape($datum->getUrl());
            $slug = self::xmlEscape($datum->getHtml());
            $pubDate = $datum->getPublished()->format('D, d M Y H:i:s T');
            $xml .= <<<xml
<item>
<title>{$title}</title>
<link>https://eidson.info/post/{$url}</link>
<description>{$slug}</description>
<pubDate>$pubDate</pubDate>
</item>
xml;
        }
        $xml .= "</channel></rss>";

        return $xml;
    }

    private static function xmlEscape($string) {
        return str_replace(array('&', '<', '>', '\'', '"'), array('&amp;', '&lt;', '&gt;', '&apos;', '&quot;'), $string);
    }
}
