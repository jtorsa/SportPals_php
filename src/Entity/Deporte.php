<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass="App\Repository\DeporteRepository")
 * @UniqueEntity("nombre")
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
    private $nombre;

    /**
     * @ORM\Column(type="text")
     */
    private $descripcion;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Nivel", mappedBy="deporte")
     */
    private $niveles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Posicion", mappedBy="deporte")
     */
    private $posiciones;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $requeridos;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

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
        return $this->nombre;
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

    public function getRequeridos(): ?int
    {
        return $this->requeridos;
    }

    public function setRequeridos(?int $requeridos): self
    {
        $this->requeridos = $requeridos;

        return $this;
    }


}
