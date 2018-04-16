<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Description of ModeloMail
 *
 * @author Aledaas
 * @ORM\Table(name="ModeloMail")
 * @ORM\Entity
 */
class ModeloMail {
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="ModeloSms", type="string", length=255, nullable=false)
     */
    private $ModeloMail;

    /**
     * @return string
     */
    public function getModeloMail()
    {
        return $this->ModeloMail;
    }

    /**
     * @param string $ModeloMail
     */
    public function setModeloMail($ModeloMail)
    {
        $this->ModeloMail = $ModeloMail;
    }


}
