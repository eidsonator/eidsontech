<?php
/**
 * Created by PhpStorm.
 * User: todd
 * Date: 2/22/19
 * Time: 6:32 PM
 */

namespace AppBundle\Controller;

use AppBundle\Rss\Xml;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RssController extends Controller
{
    /**
     * @Route("/rss", name="rss-feed")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function rssAction()
    {
        $posts = $this->getDoctrine()
            ->getRepository('AppBundle:Post')
            ->fetch();

        $response = new Response();
        $response->headers->set("Content-type", "text/xml");
        $response->setContent(Xml::generate($posts));
        return $response;

    }
}
