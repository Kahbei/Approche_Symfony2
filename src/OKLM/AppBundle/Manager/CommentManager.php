<?php
/**
 * Created by PhpStorm.
 * User: Gary
 * Date: 04/12/2014
 * Time: 11:55
 */

namespace OKLM\AppBundle\Manager;

use OKLM\AppBundle\Entity\CommentRepository;
use OKLM\CommonBundle\Manager\BaseManager;

class CommentManager extends BaseManager
{
    /**
     * @return CommentRepository
     */
    public function getRepository()
    {
        return parent::getRepository();
    }
} 