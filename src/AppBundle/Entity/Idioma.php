<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Idioma
 *
 * @ORM\Table(name="idioma")
 * @ORM\Entity
 */
class Idioma
{
    /**
     * @var string
     *
     * @ORM\Column(name="idioma", type="string", length=255, nullable=false)
     */
    private $idioma;

    /**
     * @var string
     *
     * @ORM\Column(name="abreviado", type="string", length=10, nullable=false)
     */
    private $abreviado;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_idioma", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="idioma_id_idioma_seq", allocationSize=1, initialValue=1)
     */
    private $idIdioma;
    
    public function __toString() {
        return $this->idioma;
    }
    
    public function getIdioma() {
        return $this->idioma;
    }

    public function getAbreviado() {
        return $this->abreviado;
    }

    public function getIdIdioma() {
        return $this->idIdioma;
    }

    public function setIdioma($idioma) {
        $this->idioma = $idioma;
    }

    public function setAbreviado($abreviado) {
        $this->abreviado = $abreviado;
    }

    public function setIdIdioma($idIdioma) {
        $this->idIdioma = $idIdioma;
    }




}
