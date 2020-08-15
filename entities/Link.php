<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="links")
 */
class Link
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $destination;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $expiration;

    public function getId()
    {
        return $this->id;
    }

    public function getDestination()
    {
        return $this->destination;
    }

    public function setDestination($destination)
    {
        $this->destination = $destination;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate(\DateTime $date)
    {
        $this->date = $date;
    }

    public function getExpiration()
    {
        return $this->expiration;
    }

    public function setExpiration(datetime $expiration)
    {
        $this->expiration = $expiration;
    }
}
