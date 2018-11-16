<?php

namespace ProductoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\method;
use ProductoBundle\Entity\Producto;

class ProductApiController extends Controller
{
	/**
	* 
    * @Route("/product/api/product/list", name="product_api_product_list")
    */
	public function listAction()
    {
    	$product = $this->getDoctrine()->getRepository('ProductoBundle:Producto')->findAll();
    	  $response= new Response();
            $response->headers->add(['Content-Type'=>'application/json']);
            $response->setContent(json_encode($product));
            
        return $response;
    }



   /**
     * Creates a new producto en la api.
     *
     * @Route("/product/api/newAction", name="product_api_product_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $producto = new Producto();
        $form = $this->createForm('ProductoBundle\Form\ProductoApiType', $producto);
        $form->handleRequest($request);
        $response= new Response();
        $response->headers->add(['Content-Type'=>'application/json']);
        
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($producto);
            $em->flush();
        }
 
        $response->setContent(json_encode($producto));
     	return $response;
    }

}