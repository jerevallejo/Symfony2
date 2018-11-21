<?php

namespace ProductoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use ProductoBundle\Entity\Category;


class CategoryApiController extends Controller
{
    /**
     * @Route("categories/api/category/list", name="categories_api_category_list")
     */
    public function listAction()
    {
    	 $categories = $this->getDoctrine()
		    	 ->getRepository('ProductoBundle:Category')
		    	 ->findAll();

        $response= new Response();
        $response->headers->add([
                                    'Content-Type'=>'application/json'
                                ]);
        $response->setContent(json_encode($categories));
        return $response;
    }

    /**
     * Creates a new category entity.
     *
     * @Route("categories/api/category/new", name="categories_api_category_new")
     * @Method({"POST"})
     */
    public function addAction(Request $r){
        $category = new Category();
        $form = $this->createForm(
            'ProductBundle\Form\CategoryApiType',
            $category,
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
            $em->persist($category);
            $em->flush();
            $response->setContent(json_encode($category));
        }

        return $response;
    }

    public function getFormErrors($form){
        $errors = [];

        if (0 === $form->count()){
            return $errors;
        }

        foreach ($form->all() as $child) {
            if (!$child->isValid()) {
                $errors[$child->getName()] = (string) $form[$child->getName()]->getErrors();
            }
        }

        return $errors;
    }
}
