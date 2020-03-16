<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LocalidadRepository")
 */
class Localidad
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $Nombre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Provincia", inversedBy="Localidades")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Provincia;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Evento", mappedBy="localidad")
     */
    private $eventos;

    public function __construct()
    {
        $this->eventos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): self
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    public function getProvincia(): ?Provincia
    {
        return $this->Provincia;
    }

    public function setProvincia(?Provincia $Provincia): self
    {
        $this->Provincia = $Provincia;

        return $this;
    }

    /**
     * @return Collection|Evento[]
     */
    public function getEventos(): Collection
    {
        return $this->eventos;
    }

    public function addEvento(Evento $evento): self
    {
        if (!$this->eventos->contains($evento)) {
            $this->eventos[] = $evento;
            $evento->setLocalidad($this);
        }

        return $this;
    }

    public function removeEvento(Evento $evento): self
    {
        if ($this->eventos->contains($evento)) {
            $this->eventos->removeElement($evento);
            // set the owning side to null (unless already changed)
            if ($evento->getLocalidad() === $this) {
                $evento->setLocalidad(null);
            }
        }

        return $this;
    }
}
