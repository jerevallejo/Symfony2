<?php

namespace ProductoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use ProductoBundle\Entity\Producto;

class ProductApiController extends Controller
{
    /**
     * @Route("products/api/product/list", name="product_api_product_list")
     */
    public function listAction()
    {
    	 $productos = $this->getDoctrine()
		    	 ->getRepository('ProductoBundle:Producto')
		    	 ->findAll();

        $response= new Response();
        $response->headers->add([
                                    'Content-Type'=>'application/json'
                                ]);
        $response->setContent(json_encode($productos));
        return $response;
    }


    /**
     *@Route("/product/api/add", name="product_api_add")
     *@Method("POST")
     */
    public function addAction(Request $r){
        $product = new Product();
        $form = $this->createForm(
            'ProductBundle\Form\ProductApiType',
            $product,
            [
                'csrf_protection' => false
            ]
        );

        $form->bind($r);

        $valid = $form->isValid();

        $response = new Response();

        if(false === $valid){
            $response->setStatusCode(400);
            $response->setContent(json_encode($this->getFormErrors($form)));

            return $response;
        }

        if (true === $valid) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
            $response->setContent(json_encode($product));
        }

        return $response;
    }




    public function getFormErrors($form)
    {
        $errors = [];

        if (0 === $form->count()){
            return $errors;
        }

        foreach ($form->all() as $child) 
        {
            if (!$child->isValid())
            {
                $errors[$child->getName()] = (string) $form[$child->getName()]->getErrors();
            }
        }

        return $errors;
    }

}
