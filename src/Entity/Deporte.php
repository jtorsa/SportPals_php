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
     * @ORM\Column(type="text")
     */
    private $Descripcion;

    /**
     * @ORM\Column(type="string", length=75, nullable=true)
     */
    private $campoJuego;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Nivel", mappedBy="deporte")
     */
    private $niveles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Posicion", mappedBy="deporte")
     */
    private $posiciones;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $imagen;

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

    public function getCampoJuego(): ?string
    {
        return $this->campoJuego;
    }

    public function setCampoJuego(?string $campoJuego): self
    {
        $this->campoJuego = $campoJuego;

        return $this;
    }

    /**
     * @return Collection|Nivel[]
     */
    public function getNiveles(): Collection
    {
        return $this->niveles;
    }

    /**
     * @return Collection|Posicion[]
     */
    public function getPosiciones(): Collection
    {
        return $this->posiciones;
    }

    public function __toString()
    {
        return $this->Nombre;
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(?string $imagen): self
    {
        $this->imagen = $imagen;

        return $this;
    }


}
