<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\PersonaDocumento;
use AppBundle\Entity\PersonaIdioma;
use AppBundle\Entity\PersonaContacto;
use AppBundle\Entity\PersonaDomicilio;
use AppBundle\Entity\PersonaCategoria;

/**
 * Persona
 *
 * @ORM\Table(name="persona")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PersonaRepository")
 */
class Persona {

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
     * @Assert\Length(min=3,minMessage = "El nombre debe tener por lo menos 3 caracteres")
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=255, nullable=true)
     */
    private $apellido;
    
    /**
     * @var string
     *
     * @ORM\Column(name="razon_social", type="string", length=255, nullable=true)
     */
    private $razonSocial;

    /**
     * @var string
     *
     * @ORM\Column(name="apodo", type="string", length=255, nullable=true)
     */
    private $apodo;

    /**
     * @var integer
     *
     * @ORM\Column(name="edad", type="integer", nullable=true)
     */
    private $edad;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_nacimiento", type="date", nullable=true)
     */
    private $fechaNacimiento;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio_actividad", type="date", nullable=true)
     */
    private $fechaInicioActividad;

    /**
     * @var string
     *
     * @ORM\Column(name="fisica_juridica", type="string", length=1, nullable=false)
     */
    private $fisicaJuridica;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="persona_id_persona_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="PersonaDocumento",mappedBy="idPersona",cascade={"persist","remove"},orphanRemoval=true)
     * @Assert\Count(
     *      min = "1",
     *      minMessage = "Debe cargarse por lo menos un documento"
     * )
     */
    private $documentos;

    /**
     * @ORM\OneToMany(targetEntity="PersonaIdioma", mappedBy="idPersona",cascade={"persist","remove"},orphanRemoval=true)
     */
    private $idiomas;

    /**
     * @ORM\OneToMany(targetEntity="PersonaContacto", mappedBy="idPersona",cascade={"persist","remove"},orphanRemoval=true)
     */
    private $contactos;

    /**
     * @ORM\OneToMany(targetEntity="PersonaDomicilio",mappedBy="idPersona",cascade={"persist","remove"},orphanRemoval=true)
     */
    protected $domicilios;

    /**
     * @ORM\OneToMany(targetEntity="PersonaCategoria",mappedBy="idPersona",cascade={"persist","remove"},orphanRemoval=true)
     */
    protected $categorias;
    
    /**
     * @var \AppBundle\Entity\Estado
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Estado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado", referencedColumnName="id")
     * })
     */
    private $idEstado;
    

    public function __construct() {
        $this->documentos = new ArrayCollection();
        $this->idiomas = new ArrayCollection();
        $this->contactos = new ArrayCollection();
        $this->domicilios = new ArrayCollection();
        $this->categorias = new ArrayCollection();
    }

    /**
     * @return ArrayCollection|PersonaDomicilio[]
     */
    public function getDomicilios() {
        return $this->domicilios;
    }

    public function addDomicilio(PersonaDomicilio $persona_domicilio) {
        $persona_domicilio->setIdPersona($this);
        $this->domicilios[] = $persona_domicilio;
    }

    public function removeDomicilio(PersonaDomicilio $persona_domicilio) {
        $this->domicilios->removeElement($persona_domicilio);
    }

    public function getDocumentos() {
        return $this->documentos;
    }

    public function addDocumento(PersonaDocumento $persona_documento) {
        $persona_documento->setIdPersona($this);
        $this->documentos[] = $persona_documento;
    }

    public function removeDocumento(PersonaDocumento $persona_documento) {
        $this->documentos->removeElement($persona_documento);
    }

    public function getContactos() {
        return $this->contactos;
    }

    public function addContacto(PersonaContacto $persona_contacto) {
        $persona_contacto->setIdPersona($this);
        $this->contactos[] = $persona_contacto;
    }

    public function removeContacto(PersonaContacto $persona_contacto) {
        $this->contactos->removeElement($persona_contacto);
    }

    public function getIdiomas() {
        return $this->idiomas;
    }

    public function addIdioma(PersonaIdioma $persona_idioma) {
        $persona_idioma->setIdPersona($this);
        $this->idiomas[] = $persona_idioma;
    }

    public function removeIdioma(PersonaIdioma $persona_idioma) {
        $this->idiomas->removeElement($persona_idioma);
    }

    public function addCategoria(PersonaCategoria $persona_categoria) {
        $persona_categoria->setIdPersona($this);
        $this->categorias[] = $persona_categoria;
    }

    public function removeCategoria(PersonaCategoria $persona_categoria) {
        $this->categorias->removeElement($persona_categoria);
    }

    public function getCategorias() {
        return $this->categorias;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function getApodo() {
        return $this->apodo;
    }

    public function getEdad() {
        return $this->edad;
    }
    
    public function getIdEstado(){
        return $this->idEstado;
    }

    public function setIdEstado(\AppBundle\Entity\Estado $idEstado) {
        $this->idEstado = $idEstado;
    }

    
    public function getFechaNacimiento() {
        return $this->fechaNacimiento;
    }

    public function getFisicaJuridica() {
        return $this->fisicaJuridica;
    }

    public function getIdPersona() {
        return $this->id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
        return $this;
    }

    public function setApellido($apellido) {
        $this->apellido = $apellido;
        return $this;
    }

    public function setApodo($apodo) {
        $this->apodo = $apodo;
        return $this;
    }

    public function setEdad($edad) {
        $this->edad = $edad;
        return $this;
    }

    public function setFechaNacimiento(\DateTime $fechaNacimiento) {
        $this->fechaNacimiento = $fechaNacimiento;
        return $this;
    }

    public function setFisicaJuridica($fisicaJuridica) {
        $this->fisicaJuridica = $fisicaJuridica;
        return $this;
    }

    public function setIdPersona($idPersona) {
        $this->id = $idPersona;
        return $this;
    }

    public function __toString() {
        return $this->apellido . ', ' . $this->nombre;
    }
    
    
    public function getRazonSocial() {
        return $this->razonSocial;
    }

    public function setRazonSocial($razonSocial) {
        $this->razonSocial = $razonSocial;
    }
    
    public function getFechaInicioActividad(){
        return $this->fechaInicioActividad;
    }

    public function setFechaInicioActividad(\DateTime $fechaInicioActividad) {
        $this->fechaInicioActividad = $fechaInicioActividad;
    }

    /**
     * @Assert\IsTrue(message="Hay dos o más DOCUMENTOS del mismo tipo.")
     */
    public function isTipoDocumentoRepetido() {
        foreach ($this->documentos as $documentoC) {
            foreach ($this->documentos as $documentoE) {
                if ($documentoC->getIdDocumentoTipo()->getIdDocumentoTipo() == $documentoE->getIdDocumentoTipo()->getIdDocumentoTipo() && $documentoC != $documentoE) {
                    return false;
                }
            }
        }
        return true;
    }
    
    /**
     * @Assert\IsTrue(message="Hay dos o más DOMICILIOS del mismo tipo.")
     */
    public function isTipoDomicilioRepetido() {
        foreach ($this->domicilios as $domicilioC) {
            foreach ($this->domicilios as $domicilioE) {
                if ($domicilioC->getIdDomicilioTipo()->getIdDomicilioTipo() == $domicilioE->getIdDomicilioTipo()->getIdDomicilioTipo() && $domicilioC != $domicilioE) {
                    return false;
                }
            }
        }
        return true;
    }
    
    /**
     * @Assert\IsTrue(message="Hay dos o más IDIOMAS del mismo tipo.")
     */
    public function isIdiomaRepetido() {
        foreach ($this->idiomas as $idiomaC) {
            foreach ($this->idiomas as $idiomaE) {
                if ($idiomaC->getIdIdioma()->getIdIdioma() == $idiomaE->getIdIdioma()->getIdIdioma() && $idiomaC != $idiomaE) {
                    return false;
                }
            }
        }
        return true;
    }
    
    /**
     * @Assert\IsTrue(message="Hay dos o más CONTACTOS del mismo tipo.")
     */
    public function isContactoRepetido() {
        foreach ($this->contactos as $contactoC) {
            foreach ($this->contactos as $contactoE) {
                if ($contactoC->getIdContactoTipo()->getIdContactoTipo() == $contactoE->getIdContactoTipo()->getIdContactoTipo() && $contactoC != $contactoE) {
                    return false;
                }
            }
        }
        return true;
    }
    
    /**
     * @Assert\IsTrue(message="Hay dos o más CATEGORÍAS del mismo tipo.")
     */
    public function isCategoriaRepetida() {
        foreach ($this->categorias as $categoriaC) {
            foreach ($this->categorias as $categoriaE) {
                if ($categoriaC->getIdCategoria()->getIdCategoria() == $categoriaE->getIdCategoria()->getIdCategoria() && $categoriaC != $categoriaE) {
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * @Assert\IsTrue(message="La persona Jurídica debe tener un CUIT cargado.")
     */
    public function hasCuit() {
        if ($this->fisicaJuridica == 'J') {
            foreach ($this->documentos as $documento) {
                if ($documento->getIdDocumentoTipo()->getIdDocumentoTipo() == DocumentoTipo::DOCUMENTO_CUIT) {
                    return true;
                }
            }
            return false;
        }
        return true;
    }

    /**
     * @Assert\IsTrue(message="La persona Jurídica debe tener un DOMICILIO FISCAL cargado.")
     */
    public function hasDomicilioFiscal() {
        if ($this->fisicaJuridica == 'J') {
            foreach ($this->domicilios as $domicilio) {
                if ($domicilio->getIdDomicilioTipo()->getIdDomicilioTipo() == DomicilioTipo::DOMICILIO_FISCAL) {
                    return true;
                }
            }
            return false;
        }
        return true;
    }

}
