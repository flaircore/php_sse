<?php

namespace Nick\PhpSse\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="messages")
 */
class Message
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $from;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="message")
     */
    private $to;

    /**
     * @ORM\Column(type="string")
     */
    private $message;

    public function __construct()
    {
        $this->to = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function setFrom($from): void
    {
        $this->from = $from;
    }

    public function getTo(): ArrayCollection
    {
        return $this->to;
    }

    public function setTo(ArrayCollection $to): void
    {
        $this->to = $to;
    }


    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message): void
    {
        $this->message = $message;
    }

}