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
     * @var string
     *
     * @ORM\Column(name="path", type="string", nullable=true)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="parametro", type="string", nullable=true)
     */
    private $parametro;

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
     * @ORM\ManyToMany(targetEntity="Role", inversedBy="menus")
     * @JoinTable(name="menus_roles",
     *      joinColumns={@JoinColumn(name="id_menu", referencedColumnName="id_menu")},
     *      inverseJoinColumns={@JoinColumn(name="id_role", referencedColumnName="id")}
     *      )
     */
    protected $roles;
    
    
    public function __construct() {
        $this->hijos = new ArrayCollection();
        $this->roles = new ArrayCollection();

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
    public function getPath() {
        return $this->path;
    }
    public function getParametro() {
        return $this->parametro;
    }
    public function getIdMenuPadre(){
        return $this->idMenuPadre;
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
    public function setPath($path) {
        $this->path = $path;
    }
    public function setParametro($parametro) {
        $this->parametro = $parametro;
    }
    public function setIdMenuPadre(\AppBundle\Entity\Menu $idMenuPadre) {
        $this->idMenuPadre = $idMenuPadre;
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