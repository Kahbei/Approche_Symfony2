<?php
/**
 * Created by PhpStorm.
 * User: Gary
 * Date: 04/12/2014
 * Time: 11:09
 */

namespace OKLM\CommonBundle\Manager;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityRepository;
use OKLM\AppBundle\Entity\Article;

abstract class BaseManager
{
    /**
     * @var ObjectManager
     */
    protected $om;

    /**
     * @var string
     */
    protected $class;

    /**
     * @var EntityRepository
     */
    protected $repo;

    /**
     * @param ObjectManager $om
     * @param string        $class
     */
    public function __construct(ObjectManager $om, $class)
    {
        $this->om    = $om;
        $this->class = $class;
        $this->repo  = $om->getRepository($class);
    }

    /**
     * @param $entity
     */
    public function refresh($entity)
    {
        $this->om->refresh($entity);
    }

    /**
     * @param      $entity
     * @param bool $flush
     */
    public function create($entity, $flush = true)
    {
        $this->om->persist($entity);

        if (true === $flush)
            $this->om->flush();
    }

    /**
     * @param $entity
     */
    public function update($entity)
    {
        $this->om->flush($entity);
    }

    /**
     * @param $entity
     */
    public function delete($entity, $flush = true)
    {
        $this->om->remove($entity);

        if(true === $flush)
            $this->om->flush();
    }

    public function flush()
    {
        $this->om->flush();
    }

    /**
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @return EntityRepository
     */
    public function getRepository()
    {
        return $this->repo;
    }
}