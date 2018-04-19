<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class PersonaRepository extends EntityRepository {

    public function findByCategoria($id_categoria) {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('persona');
        $qb->from('AppBundle:Persona', 'persona');
        $qb->join('AppBundle:PersonaCategoria', 'persona_categoria', 'WITH','persona.id = persona_categoria.idPersona');
        $qb->where($qb->expr()->eq('persona_categoria.idCategoria', $id_categoria));
        return $qb->getQuery()->getResult();
    }

}
