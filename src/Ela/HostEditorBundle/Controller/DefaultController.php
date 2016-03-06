<?php

namespace Ela\HostEditorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function editHostAction($id)
    {
        $hosts = $this->getHosts();
        echo "<pre>";
        var_dump($id);
        exit;
        $serializer = $this->get('serializer');

        $hosts_json = $serializer->serialize($hosts, 'json');
    }
}
