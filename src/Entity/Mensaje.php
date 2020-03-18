<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MensajeRepository")
 */
class Mensaje
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuario")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Emisor;

    /**
     * @ORM\Column(type="text")
     */
    private $texto;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuario")
     * @ORM\JoinColumn(nullable=false)
     */
    private $receptor;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmisor(): ?Usuario
    {
        return $this->Emisor;
    }

    public function setEmisor(?Usuario $Emisor): self
    {
        $this->Emisor = $Emisor;

        return $this;
    }

    public function getTexto(): ?string
    {
        return $this->texto;
    }

    public function setTexto(string $texto): self
    {
        $this->texto = $texto;

        return $this;
    }

    public function getReceptor(): ?Usuario
    {
        return $this->receptor;
    }

    public function setReceptor(?Usuario $receptor): self
    {
        $this->receptor = $receptor;

        return $this;
    }
}
