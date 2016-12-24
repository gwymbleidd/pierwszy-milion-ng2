<?php
// src/MyProject/MyBundle/CouchDocument/Group.php

namespace UserBundle\Entity;

use FOS\UserBundle\Model\Group as BaseGroup;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\JoinTable;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_group")
 */
class Group extends BaseGroup
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
     protected $id;

    /**
     * @ManyToMany(targetEntity="User", mappedBy="groups")
     **/
     protected $users = array();

      /**
     * Get id
     *
     * @return \Doctrine\Common\Collections\Collection
     *
     */
    public function getId()
    {
        return $this->id;
    }

     /**
     * Set id
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Add user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return Group
     */
    public function addUser(\UserBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \UserBundle\Entity\User $user
     */
    public function removeUser(\UserBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }
}
