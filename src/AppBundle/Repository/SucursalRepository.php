<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Description of SucursalRepository
 *
 * @author Lucas
 */
class SucursalRepository extends EntityRepository {
    
    public function findByArrayResult() {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('sucursal.sucursal,sucursal.idSucursal as id,zona.zona');
        $qb->from('AppBundle:Sucursal', 'sucursal');
        $qb->join('AppBundle:Zona', 'zona', 'WITH','sucursal.idZona = zona.idZona');
        return $qb->getQuery()->getArrayResult();
    }
    
}
