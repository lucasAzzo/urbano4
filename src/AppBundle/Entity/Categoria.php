<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categoria
 *
 * @ORM\Table(name="categoria")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoriaRepository")
 */
class Categoria
{
    
    const CO = 1;
    const FL = 2;
    const EJ = 3;
    const CH = 4;

    /**
     * @var string
     *
     * @ORM\Column(name="categoria", type="string", length=255, nullable=false, unique=true)
     */
    private $categoria;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_categoria", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="categoria_id_categoria_seq", allocationSize=1, initialValue=1)
     */
    private $idCategoria;



    /**
     * Set categoria
     *
     * @param string $categoria
     *
     * @return Categoria
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return string
     */
    public function getCategoria()
    {
        return strtolower($this->categoria);
    }

    /**
     * Get idCategoria
     *
     * @return integer
     */
    public function getIdCategoria()
    {
        return $this->idCategoria;
    }
}
