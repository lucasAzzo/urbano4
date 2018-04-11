<?php

namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\DependencyInjection\ContainerInterface;

class FileUploader
{
    private $targetDirectory;
    private $container;

    public function __construct($targetDirectory, ContainerInterface $service_container = null)
    {
        $this->targetDirectory = $targetDirectory;
        $this->container = $service_container;
    }

    public function upload(UploadedFile $file, $id_shipper)
    {
        $fileName =  $id_shipper.'-'.$file->getClientOriginalName();

        $file->move($this->getTargetDirectory(), $fileName);

        return $fileName;
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
    
    public function lecturaArchivo($file){
        
        $extension = explode(".", $file);
        $extension = $extension[count($extension) - 1];
        
        $data = array();
        switch ($extension){
            case 'xls':$data = $this->leerXLS($file);break;
            case 'csv':$data = $this->leerCSV($file);break;
            case 'txt':$data = $this->leerTXT($file);break;
        }
        
        return $data;
    }
    
    public function leerTXT($file){
        $data = array();
        $filas = file($this->getTargetDirectory() . '/'. $file);
        foreach ($filas as $fila) {
            $data[] = $fila;
        }
        return $data;
    }
    
    public function leerCSV($file){
        $data = array();
        $filas = file($this->getTargetDirectory() . '/'. $file);
        foreach ($filas as $fila) {
            $data[] = $fila;
        }
        return $data;
    }
    
    public function leerXLS($file){
        
    }
}