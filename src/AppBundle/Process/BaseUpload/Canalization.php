<?php

namespace AppBundle\Process\BaseUpload;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Entity\CodigoPostal;

class Canalization 
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function findSucursal($codPostal) : integer
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        
        $codigo = $em->getRepository(CodigoPostal::class)->findOneBy(['codPostal' => $codPostal]);
        
        return ($codigo) ? $codigo->getIdSucursal() : 0;
    }
}