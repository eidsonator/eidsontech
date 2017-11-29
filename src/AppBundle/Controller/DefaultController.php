<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Route("/posts")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $posts = $this->getDoctrine()
            ->getRepository('AppBundle:Post')
            ->findBy([], ['published' => 'DESC']);

        return $this->render('default/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    /**
     * @Route("/post/{post}", name="post")
     *
     * @param $post
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postAction($post)
    {
        $post = $this->getDoctrine()
            ->getRepository('AppBundle:Post')
            ->findOneBy(['url' => $post]);

        return $this->render('default/post.html.twig', [
            'post' => $post,
        ]);
    }

    /**
     * @Route("/resume", name="resume")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function resumeAction()
    {
        return $this->render(':default:resume.html.twig');
    }
}
