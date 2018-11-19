<?php

namespace ProductoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\method;
use ProductoBundle\Entity\Category;

class CategoryApiControllerController extends Controller
{
		/**
	* 
    * @Route("/category/api/category/list", name="category_api_category_list")
    */
	public function listAction()
    {
    	$categoria = $this->getDoctrine()->getRepository('ProductoBundle:Category')->findAll();
    	  $response= new Response();
            $response->headers->add(['Content-Type'=>'application/json']);
            $response->setContent(json_encode($categoria));
            
        return $response;
    }



   /**
     * Creates a new categoria en la api.
     *
     * @Route("/category/api/newAction", name="category_api_category_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $errors=[];
        $categoria = new Category();
        $form = $this->createForm('ProductoBundle\Form\CategoryApiType', $categoria);
        $form->handleRequest($request);
        $response= new Response();
        $response->headers->add(['Content-Type'=>'application/json']);
        
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categoria);
            $em->flush();
        }
        else
        {
            foreach ($form->getErrors() as $error  ) 
            {
                $errors[]=$error->getManager
            }
                 
        }
        $response->setContent(json_encode($categoria));
     	return $response;
    }
}
