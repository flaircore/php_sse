<?php

namespace Nick\PhpSse\Entity;

use Nick\PhpSse\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
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
     * @ORM\ManyToOne(targetEntity="User",inversedBy="messages")
     */
    private $from;

    /**
     * @ORM\ManyToMany(targetEntity="User", inversedBy="messages")
     * @ORM\JoinTable(name="messages_id_users_ids",
     *      joinColumns={@ORM\JoinColumn(name="message_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")}
     * )
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

    public function getFrom(): ?User
    {
        return $this->from;
    }

    public function setFrom(?User $from): void
    {
        $this->from = $from;
    }

    public function getTo($id)
    {
        if (!isset($this->to[$id])) {
            throw new \InvalidArgumentException("That user was never a recipient to this message.");
        }
        return $this->to[$id];
    }

    // recipients is $to[]
    public function getRecipients(): array
    {
        return $this->to->toArray();
    }

    // @todo param should be an ArrayCollection
    // where we loop through each item in the
    // array, but we keep it simple for now.
    public function setTo(User $to): void
    {
        $this->to[$to->getId()] = $to;
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
