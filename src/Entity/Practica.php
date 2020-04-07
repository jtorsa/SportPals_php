<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PracticaRepository")
 */
class Practica
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuario", inversedBy="deportesPracticados")
     * @ORM\JoinColumn(nullable=false)
     */
    private $jugador;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Deporte")
     * @ORM\JoinColumn(nullable=false)
     */
    private $deporte;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Nivel")
     * @ORM\JoinColumn(nullable=false)
     */
    private $nivel;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Posicion")
     */
    private $posicion;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJugador(): ?Usuario
    {
        return $this->jugador;
    }

    public function setJugador(?Usuario $jugador): self
    {
        $this->jugador = $jugador;

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

    public function getNivel(): ?Nivel
    {
        return $this->nivel;
    }

    public function setNivel(?Nivel $nivel): self
    {
        $this->nivel = $nivel;

        return $this;
    }

    public function getPosicion(): ?Posicion
    {
        return $this->posicion;
    }

    public function setPosicion(?Posicion $posicion): self
    {
        $this->posicion = $posicion;

        return $this;
    }
}
