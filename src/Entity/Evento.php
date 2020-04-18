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
     * @ORM\ManyToOne(targetEntity="App\Entity\Deporte")
     * @ORM\JoinColumn(nullable=false)
     */
    private $deporte;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Localidad")
     * @ORM\JoinColumn(nullable=false)
     */
    private $localidad;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $direccion;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Nivel")
     */
    private $nivel;

    /**
     * @ORM\Column(type="integer")
     */
    private $requeridos;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuario", inversedBy="eventosCreados")
     * @ORM\JoinColumn(nullable=false)
     */
    private $creador;

    /**
     * @ORM\Column(type="date")
     */
    private $dia;

    /**
     * @ORM\Column(type="time")
     */
    private $inicio;

    /**
     * @ORM\Column(type="time")
     */
    private $final;

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

    public function getCreador(): ?Usuario
    {
        return $this->creador;
    }

    public function setCreador(?Usuario $creador): self
    {
        $this->creador = $creador;

        return $this;
    }

    public function getDia(): ?\DateTimeInterface
    {
        return $this->dia;
    }

    public function setDia(\DateTimeInterface $dia): self
    {
        $this->dia = $dia;

        return $this;
    }

    public function getInicio(): ?\DateTimeInterface
    {
        return $this->inicio;
    }

    public function setInicio(\DateTimeInterface $inicio): self
    {
        $this->inicio = $inicio;

        return $this;
    }

    public function getFinal(): ?\DateTimeInterface
    {
        return $this->final;
    }

    public function setFinal(\DateTimeInterface $final): self
    {
        $this->final = $final;

        return $this;
    }
}
