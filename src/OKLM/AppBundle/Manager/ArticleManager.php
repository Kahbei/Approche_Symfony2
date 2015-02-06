<?php
/**
 * Created by PhpStorm.
 * User: Gary
 * Date: 04/12/2014
 * Time: 11:55
 */

namespace OKLM\AppBundle\Manager;

use OKLM\AppBundle\Entity\ArticleRepository;
use OKLM\CommonBundle\Manager\BaseManager;

class ArticleManager extends BaseManager
{
    /**
     * @return ArticleRepository
     */
    public function getRepository()
    {
        return parent::getRepository();
    }
} 