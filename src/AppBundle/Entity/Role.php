<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Route;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinColumns;


/**
 * Role
 *
 * @ORM\Table(name="roles")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RoleRepository")
 */
class Role
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
     * @ORM\Column(name="role", type="string", length=255, unique=true)
     */
    private $role;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;
    

    /**
     * Bidirectional - Many Roles are owned by many Routes (INVERSE SIDE)
     *
     * @ManyToMany(targetEntity="Route", inversedBy="roles")
     * @JoinTable(name="routes_roles",
     *      joinColumns={@JoinColumn(name="id_role", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="id_route", referencedColumnName="id_route")}
     *      )
     */
    private $routes;
    

    public function __construct()
    {
        $this->routes = new ArrayCollection();
    }
    
     public function getRoutes() {
        return $this->routes;
    }
    
    public function addRoute(Route $route) {
        $this->routes[] = $route;
    }
    
    public function removeRoute(Route $route) {
        $this->routes->removeElement($route);
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
     * Set role
     *
     * @param string $role
     *
     * @return Role
     */
    public function setRole($role)
    {
        $this->role = 'ROLE_'.strtoupper(str_replace('ROLE_', '', $role));

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Role
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}