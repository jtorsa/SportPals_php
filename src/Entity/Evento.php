<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventoRepository")
 */
class Evento
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $descripcion;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Deporte", inversedBy="eventos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $deporte;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Localidad", inversedBy="eventos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $localidad;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $direccion;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $start;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Nivel", inversedBy="eventos")
     */
    private $nivel;

    /**
     * @ORM\Column(type="integer")
     */
    private $requeridos;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getDeporte(): ?Deporte
    {
        return $this->deporte;
    }

    public function setDeporte(?Deporte $deporte): self
    {
        $this->deporte = $deporte;

        return $this;
    }

    public function getLocalidad(): ?Localidad
    {
        return $this->localidad;
    }

    public function setLocalidad(?Localidad $localidad): self
    {
        $this->localidad = $localidad;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(string $direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getStart(): ?string
    {
        return $this->start;
    }

    public function setStart(string $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getNivel(): ?Nivel
    {
        return $this->nivel;
    }

    public function setNivel(?Nivel $nivel): self
    {
        $this->nivel = $nivel;

        return $this;
    }

    public function getRequeridos(): ?int
    {
        return $this->requeridos;
    }

    public function setRequeridos(int $requeridos): self
    {
        $this->requeridos = $requeridos;

        return $this;
    }
}
