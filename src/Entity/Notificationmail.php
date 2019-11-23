<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NotificationmailRepository")
 */
class Notificationmail
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typemail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dateinsertion;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contenu;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTypemail(): ?string
    {
        return $this->typemail;
    }

    public function setTypemail(string $typemail): self
    {
        $this->typemail = $typemail;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }


    public function getDateinsertion(): ?string
    {
        return $this->dateinsertion;
    }

    public function setDateinsertion(string $dateinsertion): self
    {
        $this->dateinsertion = $dateinsertion;


        return $this;
    }

    public function __construct()
    {
        $this->dateinsertion = date("Y-m-d H:i:s");
    }

}