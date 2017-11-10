<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use AppBundle\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PostFormController extends Controller
{
    /**
     * @Route("/form/post", name="")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        return $this->render(
            ':default:post.form.html.twig',
            ['form' => $form->createView()]
        );
    }
}
