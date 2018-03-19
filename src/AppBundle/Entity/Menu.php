<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinColumns;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Description of Menu
 *
 * @author Lucas
 * @ORM\Table(name="menu")
 * @ORM\Entity
 */
class Menu {

    /**
     * @var integer
     *
     * @ORM\Column(name="id_menu", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     */
    private $idMenu;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="orden", type="integer", nullable=false)
     */
    private $orden;


    /**
     * @var \AppBundle\Entity\Menu
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Menu",inversedBy="hijos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_menu_padre", referencedColumnName="id_menu")
     * })
     */
    private $idMenuPadre;

    /**
     * @var string
     *
     * @ORM\Column(name="icono", type="string", length=255, nullable=true)
     */
    private $icono;


    /**
     * @ORM\OneToMany(targetEntity="Menu",mappedBy="idMenuPadre")
     * @ORM\OrderBy({"orden" = "ASC"})
     */
    protected $hijos;

    /**
     * @var \AppBundle\Entity\Route
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Route")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_route", referencedColumnName="id_route")
     * })
     */
    private $idRoute;

    
    public function __construct() {
        $this->hijos = new ArrayCollection();

    }


    public function getIdMenu() {
        return $this->idMenu;
    }
    public function getNombre() {
        return $this->nombre;
    }
    public function getOrden() {
        return $this->orden;
    }

    public function getIdMenuPadre(){
        return $this->idMenuPadre;
    }

    public function getIdRoute()
    {
        return $this->idRoute;
    }


    public function setIdMenu($idMenu) {
        $this->idMenu = $idMenu;
    }
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    public function setOrden($orden) {
        $this->orden = $orden;
    }

    public function setIdMenuPadre(\AppBundle\Entity\Menu $idMenuPadre) {
        $this->idMenuPadre = $idMenuPadre;
    }

    public function setIdRoute(\AppBundle\Entity\Route $idRoute=null) {
        $this->idRoute = $idRoute;
    }

    /**
     * @return ArrayCollection|Menu[]
     */
    public function getHijos() {
        return $this->hijos;
    }

    public function getIcono() {
        return $this->icono;
    }
    public function setIcono($icono) {
        $this->icono = $icono;
    }

}
