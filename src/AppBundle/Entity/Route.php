<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinColumns;


/**
 * Route
 *
 * @ORM\Table(name="route")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RouteRepository")
 */
class Route
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_route", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idRoute;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


    /**
     * @ORM\ManyToMany(targetEntity="Role", inversedBy="routes")
     * @JoinTable(name="routes_roles",
     *      joinColumns={@JoinColumn(name="id_route", referencedColumnName="id_route")},
     *      inverseJoinColumns={@JoinColumn(name="id_role", referencedColumnName="id")}
     *      )
     */
    protected $roles;

    public function __construct() {
        $this->roles = new ArrayCollection();
    }
    
    public function getRoles() {
        return $this->roles;
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getIdRoute()
    {
        return $this->idRoute;
    }

    /**
     * Set path
     *
     * @param string $path
     *
     * @return Route
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Route
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
}

