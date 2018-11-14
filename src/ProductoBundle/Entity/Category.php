<?php

namespace ProductoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="ProductoBundle\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
  
    /**
     * Set name
     *
     * @param string $name
     *
     * @return Producto
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @ORM\ManyToMany(targetEntity="Producto", mappedBy="Categories")
     * @ORM\JoinTable(name="Product_Category")
     */

    private $Products = null;

    public function __construct()
    {
        $this->Products = new ArrayCollection();
    }

    public function getProducts()
    {
        return $this->Products;
    }

}

