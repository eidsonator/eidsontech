<?php
/**
 * Created by PhpStorm.
 * User: todd
 * Date: 2/24/19
 * Time: 6:11 PM
 */

namespace AppBundle\Service;


class SocialMediaLinks
{
    public static function get()
    {
        return [
            static::makeArray('https://dev.to/eidsonator', 'dev.to', 'fa-dev-to'),
            static::makeArray('https://eidson.info/rss', 'rss feed', 'fa-rss-square'),
            static::makeArray('https://github.com/eidsonator', 'GitHub', 'fa-github-square'),
            static::makeArray('https://lnkd.in/Q6ic46', 'LinkedIn', 'fa-linkedin-square'),
            static::makeArray('https://www.facebook.com/toddEidson', 'Facebook', 'fa-facebook-square'),
            static::makeArray('https://twitter.com/toddeidson', 'Twitter', 'fa-twitter-square'),
            static::makeArray('https://stackoverflow.com/users/2249502/eidsonator', 'Stack Overflow', 'fa-stack-overflow'),
            static::makeArray('https://www.instagram.com/eidsonator/', 'Instagram', 'fa-instagram'),

        ];

    }

    private static function makeArray(string $href, string $title,  string $icon)
    {
        return [
            'href' => $href,
            'title' => $title,
            'icon' => $icon
        ];
    }



}
