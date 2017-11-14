<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $posts = $this->getDoctrine()
            ->getRepository('AppBundle:Post')
            ->findBy([], ['published' => 'DESC']);

        return $this->render('default/index.html.twig', [
            'posts' => $posts
        ]);
    }

    /**
     * @Route("/post/{post}", name="post")
     */
    public function postAction($post)
    {
        $post =  $this->getDoctrine()
            ->getRepository('AppBundle:Post')
            ->findOneBy(['url' => $post]);

        return $this->render('default/post.html.twig', [
            'post' => $post
        ]);
    }

    /**
     * @Route("/resume", name="resume")
     */
    public function resumeAction()
    {
        return $this->render(':default:resume.html.twig');
    }

    /**
     * @Route("/aboutMe", name="aboutMe")
     */
    public function aboutMeAction()
    {
        return $this->render(':default:aboutMe.html.twig');
    }
}
