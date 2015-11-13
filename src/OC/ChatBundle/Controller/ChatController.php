<?php

namespace OC\ChatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class ChatController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('OCChatBundle:Chat:index.html.twig', array('name' => $name));
    }
	public function ajaxAction( Request $request){
		
		if($request -> isXmlHttpRequest()){
			$text = $request -> get('text');
			return  new JsonResponse(array("text" => "OKOkOK => ".$text));
		}
		// return $this->render('OCChatBundle:Chat:index.html.twig', array('name' => $name));
	}
}
