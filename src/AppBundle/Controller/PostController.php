<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PostController extends Controller
{
    /**
     * @Route("/post", name="blog")
     */
    public function postsAction(Request $request)
    {
        $tag = $request->query->get('tag');
        if ($tag) {
            $posts = $this->getDoctrine()
                ->getRepository('AppBundle:Post')
                ->fetchByTag($tag);
        } else {
            $posts = $this->getDoctrine()
                ->getRepository('AppBundle:Post')
                ->fetch();
        }

        return $this->render('default/posts.html.twig', [
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
}
