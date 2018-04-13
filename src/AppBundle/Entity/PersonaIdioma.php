<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * PersonaIdioma
 *
 * @ORM\Table(name="persona_idioma", uniqueConstraints={@UniqueConstraint(name="persona_idioma_unique",columns={"id_persona","id_idioma"})},indexes={@ORM\Index(name="IX_Relationship11", columns={"id_idioma"}), @ORM\Index(name="IX_Relationship12", columns={"id_persona"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PersonaIdiomaRepository")
 * @UniqueEntity(
 *     fields="idPersona",
 *     errorPath = "idPersona", 
 *     message="mensaje",
 *       
 * )
 */
class PersonaIdioma
{
    /**
     * @var string
     *
     * @ORM\Column(name="nivel", type="string", length=255, nullable=false)
     */
    private $nivel;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_persona_idioma", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="persona_idioma_id_persona_idioma_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Persona
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Persona",inversedBy="idiomas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_persona", referencedColumnName="id_persona")
     * })
     */
    private $idPersona;

    /**
     * @var \AppBundle\Entity\Idioma
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Idioma")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_idioma", referencedColumnName="id_idioma")
     * })
     */
    private $idIdioma;
    
    public function getNivel() {
        return $this->nivel;
    }

    public function getIdPersonaIdioma() {
        return $this->id;
    }

    public function getIdPersona() {
        return $this->idPersona;
    }

    public function getIdIdioma() {
        return $this->idIdioma;
    }

    public function setNivel($nivel) {
        $this->nivel = $nivel;
    }

    public function setIdPersonaIdioma($idPersonaIdioma) {
        $this->id = $idPersonaIdioma;
    }

    public function setIdPersona(\AppBundle\Entity\Persona $idPersona=null) {
        $this->idPersona = $idPersona;
    }

    public function setIdIdioma(\AppBundle\Entity\Idioma $idIdioma) {
        $this->idIdioma = $idIdioma;
    }

    /**
     * @var \AppBundle\Entity\Idioma
     */
    private $idioma;


    /**
     * Set idioma
     *
     * @param \AppBundle\Entity\Idioma $idioma
     *
     * @return PersonaIdioma
     */
    public function setIdioma(\AppBundle\Entity\Idioma $idioma = null)
    {
        $this->idioma = $idioma;

        return $this;
    }

    /**
     * Get idioma
     *
     * @return \AppBundle\Entity\Idioma
     */
    public function getIdioma()
    {
        return $this->idioma;
    }
}
