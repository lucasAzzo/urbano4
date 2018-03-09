<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Modulo
 *
 * @author Aledaas
 * @ORM\Table(name="upload")
 * @ORM\Entity
 */
class Upload {
    
     /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     */
    private $id;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="upload_timestamp", type="datetime", options={"default"="CURRENT_TIMESTAMP"})
     */
    private $upload_timestamp;
    
    /**
     * @var string
     *
     * @ORM\Column(name="upload_file", type="string", length=255, nullable=false)
     */
    private $upload_file;
    
    /**
     * @var string
     * @ORM\Column(name="upload_shippers", type="string", length=255, nullable=false)
     */
    private $upload_shippers;
    
    /**
     * @var string
     * @ORM\column(name="upload_registros", type="string", length=255, nullable=false)
     */
    private $upload_registros;

    /**
     * @var string
     * @ORM\column(name="upload_user", type="string", length=255, nullable=false)
     */
    private $upload_user;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return \DateTime
     */
    public function getUploadTimestamp()
    {
        return $this->upload_timestamp;
    }

    /**
     * @param \DateTime $upload_timestamp
     */
    public function setUploadTimestamp($upload_timestamp)
    {
        $this->upload_timestamp = $upload_timestamp;
    }

    /**
     * @return string
     */
    public function getUploadFile()
    {
        return $this->upload_file;
    }

    /**
     * @param string $upload_file
     */
    public function setUploadFile($upload_file)
    {
        $this->upload_file = $upload_file;
    }

    /**
     * @return string
     */
    public function getUploadShippers()
    {
        return $this->upload_shippers;
    }

    /**
     * @param string $upload_shippers
     */
    public function setUploadShippers($upload_shippers)
    {
        $this->upload_shippers = $upload_shippers;
    }

    /**
     * @return string
     */
    public function getUploadRegistros()
    {
        return $this->upload_registros;
    }

    /**
     * @param string $upload_registros
     */
    public function setUploadRegistros($upload_registros)
    {
        $this->upload_registros = $upload_registros;
    }

    /**
     * @return string
     */
    public function getUploadUser()
    {
        return $this->upload_user;
    }

    /**
     * @param string $upload_user
     */
    public function setUploadUser($upload_user)
    {
        $this->upload_user = $upload_user;
    }


}
