<?php

namespace ProductoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ProductController extends Controller
{
	/**
     * @Route("/products/view/{id}", name="Product_view")
     */
    public function viewAction($id)
    {

    	$producto = $this->getDoctrine()-> getRepository('ProductoBundle:Producto')->find($id);
    	// echo json_encode($producto);
   		$this->get('app.cart');
        return $this->render('ProductoBundle:Default:view.html.twig',
        						['producto'=> $producto]);  
    }

    /**
     * @Route("/products/cart/add/{id}/quantity/{quantity}", name="Product_add_cart")
     */
    public function addToCartAction($id, $quantity)
    {
    	$producto = $this->getDoctrine()-> getRepository('ProductoBundle:Producto')->find($id);
    	if(null === $producto)
    	{
    		throw new \Exception("Producto not found");
    	}
    
        $cartService = $this->get('app.cart');

        $cartService->add($producto);

        die();
    }

   /**
     * @Route("/products/cart/view", name="Product_view_cart")
     */
    public function viewCartAction()
    {
        $cartService = $this->get('app.cart');
        $productos =  $cartService->getAll();
         return $this->render('ProductoBundle:Product:cart.html.twig',
                                ['productos'=> $productos]);  
    }
}

