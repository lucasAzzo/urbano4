<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Description of Shipper
 *
 * @author Lucas
 */
class ShipperRepository extends EntityRepository {
    
    public function findByArrayResult() {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('shipper.shiRepresentante,shipper.id as id');
        $qb->from('AppBundle:Shipper', 'shipper');
        return $qb->getQuery()->getArrayResult();
    }
    
}
