<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CodigoPostal
 *
 * @ORM\Table(name="codigo_postal")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CodigoPostalRepository")
 */
class CodigoPostal
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
     * @var int
     *
     * @ORM\Column(name="codPostal", type="integer")
     */
    private $codPostal;

    /**
     * @var \AppBundle\Entity\Sucursal
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Sucursal")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_sucursal", referencedColumnName="id")
     * })
     */
    private $idSucursal;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="date")
     */
    private $created;

    /**
     * @var \AppBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     * })
     */
    private $idUser;

    /**
     * @var \AppBundle\Entity\Estado
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Estado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado", referencedColumnName="id")
     * })
     */
    private $idEstado;

    public function __construct()
    {
        $this->created = new \DateTime();
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
     * Set codPostal
     *
     * @param integer $codPostal
     *
     * @return CodigoPostal
     */
    public function setCodPostal($codPostal)
    {
        $this->codPostal = $codPostal;

        return $this;
    }

    /**
     * Get codPostal
     *
     * @return int
     */
    public function getCodPostal()
    {
        return $this->codPostal;
    }

    /**
     * Set idSucursal
     *
     * @param integer $idSucursal
     *
     * @return CodigoPostal
     */
    public function setIdSucursal(\AppBundle\Entity\Sucursal $idSucursal)
    {
        $this->idSucursal = $idSucursal;

        return $this;
    }

    /**
     * Get idSucursal
     *
     * @return int
     */
    public function getIdSucursal()
    {
        return $this->idSucursal;
    }
    

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return CodigoPostal
     */
    public function setIdUser(\AppBundle\Entity\User $idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return int
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set idEstado
     *
     * @param integer $idEstado
     *
     * @return CodigoPostal
     */
    public function setIdEstado(\AppBundle\Entity\Estado $idEstado)
    {
        $this->idEstado = $idEstado;

        return $this;
    }

    /**
     * Get idEstado
     *
     * @return int
     */
    public function getIdEstado()
    {
        return $this->idEstado;
    }
}

