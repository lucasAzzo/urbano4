<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Param
 *
 * @ORM\Table(name="param")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ParamRepository")
 */
class Param
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_param", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idParam;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=255)
     */
    private $value;

      /**
     * @var \AppBundle\Entity\Route
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Route")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_route", referencedColumnName="id_route")
     * })
     */
    private $idRoute;
    
     /**
     * @var \AppBundle\Entity\Menu
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Menu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_menu", referencedColumnName="id_menu")
     * })
     */
    private $idMenu;


    /**
     * Get id
     *
     * @return int
     */
    public function getIdParam()
    {
        return $this->idParam;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Param
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

    public function getIdRoute()
    {
        return $this->idRoute;
    }
    
    /**
     * Set value
     *
     * @param string $value
     *
     * @return Param
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }



    public function setIdRoute(\AppBundle\Entity\Route $idRoute=null) {
        $this->idRoute = $idRoute;
    }
    
    public function getIdMenu(){
        return $this->idMenu;
    }

    public function setIdMenu(\AppBundle\Entity\Menu $idMenu) {
        $this->idMenu = $idMenu;
    }


}

