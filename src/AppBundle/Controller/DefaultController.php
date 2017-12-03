<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $latest = $this->getDoctrine()
            ->getRepository('AppBundle:Post')
            ->findOneBy([], ['published' => 'DESC']);

        return $this->render(':default:index.html.twig', [
            'post' => $latest,
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
