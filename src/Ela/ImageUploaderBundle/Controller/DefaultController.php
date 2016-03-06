<?php

namespace Ela\ImageUploaderBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ElaImageUploaderBundle:Default:index.html.twig');
    }

    public function uploadAction()
    {
    	// dump('here');
    	// exit;
    	return $this->redirectToRoute('ela_image_uploader_homepage');;
    }
}
