<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParticipaRepository")
 */
class Participa
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
    private $jugador;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Evento")
     * @ORM\JoinColumn(nullable=false)
     */
    private $evento;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Posicion")
     * @ORM\JoinColumn(nullable=false)
     */
    private $posicion;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $equipo;


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

    public function getEvento(): ?Evento
    {
        return $this->evento;
    }

    public function setEvento(?Evento $evento): self
    {
        $this->evento = $evento;

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

    public function getEquipo(): ?int
    {
        return $this->equipo;
    }

    public function setEquipo(?int $equipo): self
    {
        $this->equipo = $equipo;

        return $this;
    }
}
