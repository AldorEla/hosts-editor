<?php

namespace Ela\ImageUploaderBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ela\ImageUploaderBundle\Controller\ImageManipulator;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ElaImageUploaderBundle:Default:index.html.twig');
    }

    public function uploadAction()
    {
        dump($_FILES['filesToUpload']);
        exit;
        foreach ($_FILES['filesToUpload'] as $file) {
        // array of valid extensions
        $validExtensions = array('.jpg', '.jpeg', '.gif', '.png');
        // get extension of the uploaded file
        $fileExtension = strrchr($file['name'], ".");
        // check if file Extension is on the list of allowed ones
        if (in_array($fileExtension, $validExtensions)) {
            $newNamePrefix = time() . '_';
            $manipulator = new ImageManipulator($file['tmp_name']);
            $width  = $manipulator->getWidth();
            $height = $manipulator->getHeight();
            $centreX = round($width / 2);
            $centreY = round($height / 2);
            // our dimensions will be 200x130
            $x1 = $centreX - 100; // 200 / 2
            $y1 = $centreY - 65; // 130 / 2
     
            $x2 = $centreX + 100; // 200 / 2
            $y2 = $centreY + 65; // 130 / 2
     
            // center cropping to 200x130
            $newImage = $manipulator->crop($x1, $y1, $x2, $y2);
            // saving file to uploads folder
            $manipulator->save('uploads/' . $newNamePrefix . $file['name']);
            echo 'Done ...';
        } else {
            echo 'You must upload an image...';
        }
    }
        return $this->redirectToRoute('ela_image_uploader_homepage');;
    }

    public function bak_uploadAction()
    {
        $error = false;
        $allow = false;
        $file = array();
        if(!empty($_FILES['filesToUpload'])) {
            $file = $_FILES['filesToUpload'];
        } else {
            return false;
        }
        // array of valid extensions
        $validExtensions = array('.jpg', '.jpeg', '.gif', '.png');
        if (!empty($file['error'])) {
            foreach($file['error'] as $error) {
                if($error > 0) {
                    $error = true;
                    echo "Error: " . $error . "<br />";
                }
            }
        }
        if($error) {
            echo 'Something went wrong. Please, try again.';
            exit;
        }

        if(!empty($file['name'])) {
            foreach($file['name'] as $name) {
                if($name) {
                    // get extension of the uploaded file
                    $fileExtension = strrchr($name, ".");
                    // check if file Extension is on the list of allowed ones
                    if (in_array($fileExtension, $validExtensions)) {
                        $allow = true;   
                    }
                }
            }
        }
        
        $files_count = count($file['name']);
        
        if($allow) {
            if($files_count == 1) {
                echo 'Uploaded file is allowed!';
            } else {
                echo 'Uploaded files are allowed!';
            }
        } else {
            echo 'You must upload an image...';
        }
        
        exit;
    	return $this->redirectToRoute('ela_image_uploader_homepage');;
    }

    public function fileApiAction()
    {
        return $this->render('ElaImageUploaderBundle:Default:fileapi.html.twig');
    }
}
