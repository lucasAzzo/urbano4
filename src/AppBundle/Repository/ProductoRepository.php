<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Description of ProductoRepository
 *
 * @author Lucas
 */
class ProductoRepository extends EntityRepository {
    
    public function findByArrayResult() {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('producto.producto,producto.idProducto as id');
        $qb->from('AppBundle:Producto', 'producto');
        return $qb->getQuery()->getArrayResult();
    }
    
}
