<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomepageController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepageAction(Request $request)
    {
        $hosts = $this->getHosts();
        // echo "<pre>";
        // var_dump($hosts);
        // exit;

        return $this->render('Homepage/homepage.html.twig', array(
            'hosts' => $hosts,
        ));
    }

    public function getHosts()
    {
        $hosts = array();

        foreach(file('/etc/hosts') as $ln => $line) {
            // $hosts['line_'.$ln] = $line;
            $hosts[$ln]['id'] = $ln+1;
            preg_match("@([^\s]+)@", $line, $match);
            $hosts[$ln]['ip'] = isset($match[0]) ? trim($match[0]) : '';
            $name = preg_replace("@".$hosts[$ln]['ip']."@", "", $line);
            $hosts[$ln]['name'] = trim($name);
        }

        return $hosts;
    }

    public function getHostsJson($hosts)
    {
        $serializer = $this->get('serializer');

        $hosts_json = $serializer->serialize($hosts, 'json');
        
        return $hosts_json;
    }
}
