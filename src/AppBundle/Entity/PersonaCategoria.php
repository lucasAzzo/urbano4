<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PersonaCategoria
 *
 * @ORM\Table(name="persona_categoria", indexes={@ORM\Index(name="IX_Relationship7", columns={"id_persona"}), @ORM\Index(name="IX_Relationship8", columns={"id_categoria"})})
 * @ORM\Entity
 */
class PersonaCategoria
{
    /**
     * @var string
     *
     * @ORM\Column(name="puesto", type="string", length=255, nullable=false)
     */
    private $puesto;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_puesto", type="text", nullable=true)
     */
    private $descripcionPuesto;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_persona_categoria", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="persona_categoria_id_persona_categoria_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Categoria
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Categoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_categoria", referencedColumnName="id_categoria")
     * })
     */
    private $idCategoria;

    /**
     * @var \AppBundle\Entity\Persona
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Persona",inversedBy="categorias")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_persona", referencedColumnName="id_persona")
     * })
     */
    private $idPersona;



    /**
     * Set puesto
     *
     * @param string $puesto
     *
     * @return PersonaCategoria
     */
    public function setPuesto($puesto)
    {
        $this->puesto = $puesto;

        return $this;
    }

    /**
     * Get puesto
     *
     * @return string
     */
    public function getPuesto()
    {
        return $this->puesto;
    }

    /**
     * Set descripcionPuesto
     *
     * @param string $descripcionPuesto
     *
     * @return PersonaCategoria
     */
    public function setDescripcionPuesto($descripcionPuesto)
    {
        $this->descripcionPuesto = $descripcionPuesto;

        return $this;
    }

    /**
     * Get descripcionPuesto
     *
     * @return string
     */
    public function getDescripcionPuesto()
    {
        return $this->descripcionPuesto;
    }

    /**
     * Get idPersonaCategoria
     *
     * @return integer
     */
    public function getIdPersonaCategoria()
    {
        return $this->id;
    }

    /**
     * Set idCategoria
     *
     * @param \AppBundle\Entity\Categoria $idCategoria
     *
     * @return PersonaCategoria
     */
    public function setIdCategoria($idCategoria)
    {
        $this->idCategoria = $idCategoria;

        return $this;
    }

    /**
     * Get idCategoria
     *
     * @return \AppBundle\Entity\Categoria
     */
    public function getIdCategoria()
    {
        return $this->idCategoria;
    }

    /**
     * Set idPersona
     *
     * @param \AppBundle\Entity\Persona $idPersona
     *
     * @return PersonaCategoria
     */
    public function setIdPersona(\AppBundle\Entity\Persona $idPersona = null)
    {
        $this->idPersona = $idPersona;

        return $this;
    }

    /**
     * Get idPersona
     *
     * @return \AppBundle\Entity\Persona
     */
    public function getIdPersona()
    {
        return $this->idPersona;
    }
}
