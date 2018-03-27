<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CategoriaRepository extends EntityRepository {

    public function findByNombreCategoria($categoria) {
        $em = $this->getEntityManager();
        $categoria = $em->getRepository('AppBundle:Categoria')->findOneBy(['categoria' => strtoupper($categoria)]);
       
        return $categoria;
    }

}
