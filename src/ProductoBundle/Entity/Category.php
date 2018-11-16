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
class Category implements \JsonSerializable
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var ArrayColection
     * @ORM\ManyToMany(targetEntity="Producto" , mappedBy="categorias")
     * @ORM\JoinTable(name="product_categoy")
     */
    private $products=null;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }
    public function getProducts()
    {
        return $this->products;
    }
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
     * @return Categoria
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

    public function jsonSerialize()
    {
        return [
                'id' => $this->getId(),
                'name' => $this->getName()
                ];
    }
}

