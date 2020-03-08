<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DeporteRepository")
 */
class Deporte
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $Nombre;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $Descripcion;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Nivel", mappedBy="deporte")
     */
    private $niveles;

    public function __construct()
    {
        $this->niveles = new ArrayCollection();
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

    public function getDescripcion(): ?string
    {
        return $this->Descripcion;
    }

    public function setDescripcion(string $Descripcion): self
    {
        $this->Descripcion = $Descripcion;

        return $this;
    }

    /**
     * @return Collection|Nivel[]
     */
    public function getNiveles(): Collection
    {
        return $this->niveles;
    }

    public function addNivele(Nivel $nivele): self
    {
        if (!$this->niveles->contains($nivele)) {
            $this->niveles[] = $nivele;
            $nivele->setDeporte($this);
        }

        return $this;
    }

    public function removeNivele(Nivel $nivele): self
    {
        if ($this->niveles->contains($nivele)) {
            $this->niveles->removeElement($nivele);
            // set the owning side to null (unless already changed)
            if ($nivele->getDeporte() === $this) {
                $nivele->setDeporte(null);
            }
        }

        return $this;
    }
}
