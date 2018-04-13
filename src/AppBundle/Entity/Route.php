<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinColumns;
use AppBundle\Entity\Role;
use Doctrine\Common\Collections\ArrayCollection;

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
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

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
     * @var string
     *
     * @ORM\Column(name="parametro", type="array",nullable=true)
     */
    private $parametro;
    

    /**
     * @ORM\ManyToMany(targetEntity="Role", inversedBy="routes")
     * @JoinTable(name="routes_roles",
     *      joinColumns={@JoinColumn(name="id_route", referencedColumnName="id")},
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
    
     public function addRole(Role $role) {
        $this->roles[] = $role;
    }
    
    public function removeRole(Role $role) {
        $this->roles->removeElement($role);
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getIdRoute()
    {
        return $this->id;
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
    
    public function getParametro() {
        return $this->parametro;
    }

    public function setParametro($parametro) {
        $this->parametro = $parametro;
    }
    
    public function __toString() {
        return $this->path;
    }


    
    



}

