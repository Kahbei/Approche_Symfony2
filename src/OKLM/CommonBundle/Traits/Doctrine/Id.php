<?php
/**
 * Created by PhpStorm.
 * User: Gary
 * Date: 03/12/2014
 * Time: 18:25
 */

namespace OKLM\CommonBundle\Traits\Doctrine;

trait Id
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
} 