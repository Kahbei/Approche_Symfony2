<?php
/**
 * Created by PhpStorm.
 * User: Gary
 * Date: 03/12/2014
 * Time: 16:53
 */

namespace OKLM\AppBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use OKLM\AppBundle\Entity\Article;

class ArticleListener
{
    /**
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if($entity instanceof Article) {
            $entity->setCreatedAt(new \DateTime());
            $entity->setUpdatedAt(new \DateTime());
        }
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if($entity instanceof Article) {
            $entity->setUpdatedAt(new \DateTime());
        }
    }
} 