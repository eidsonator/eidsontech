<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use League\CommonMark\CommonMarkConverter;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $basedir = realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR;

        $posts = [];
        $files = array_reverse(scandir($basedir . 'src/AppBundle/Content'));
        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..') {
                $posts[] = [
                    'html' => $this->getSnippet($basedir . 'src/AppBundle/Content/' . $file),
                    'uri' => $this->generateUrl(
                        'post',
                        ['post' => str_replace('.md', '', $file)]
                    )
                ];
            }
        }

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


    /**
     * @param $text
     * @return string
     */
    public function mdToHtml($text)
    {
        $converter = new CommonMarkConverter();
        return $converter->convertToHtml($text);
    }

    public function getSnippet($file)
    {
        $fp = fopen($file, "r");
        $text = '';
        for ($i = 0; $i <= 10; $i++) {
            $text .= fgets($fp);
            if (feof($fp)) {
                break;
            }
        }
        fclose($fp);
        return $this->mdToHtml($text);
    }

}
