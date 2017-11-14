<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use AppBundle\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class PostFormController extends Controller
{
    /**
     * @Route("/admin/form/post/{id}", name="admin-form-post")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request, $id = null)
    {
        if ($id) {
            $post = $this->getDoctrine()
                ->getRepository('AppBundle:Post')
                ->findOneBy(['id' => $id]);
        } else {
            $post = new Post();
        }

        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();
              $em = $this->getDoctrine()->getManager();
              $em->persist($post);
              $em->flush();
            return $this->redirectToRoute('homepage');
        }
        return $this->render(
            ':default:post.form.html.twig',
            ['form' => $form->createView()]
        );
    }
}
