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
     * @ORM\OneToMany(targetEntity="App\Entity\Nivel", mappedBy="deporte")
     */
    private $niveles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Evento", mappedBy="deporte")
     */
    private $eventos;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Participa", mappedBy="deporte")
     */
    private $eventoParticipados;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Posicion", mappedBy="deporte")
     */
    private $posiciones;

    public function __construct()
    {
        $this->niveles = new ArrayCollection();
        $this->eventos = new ArrayCollection();
        $this->eventoParticipados = new ArrayCollection();
        $this->posiciones = new ArrayCollection();
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
            $evento->setDeporte($this);
        }

        return $this;
    }

    public function removeEvento(Evento $evento): self
    {
        if ($this->eventos->contains($evento)) {
            $this->eventos->removeElement($evento);
            // set the owning side to null (unless already changed)
            if ($evento->getDeporte() === $this) {
                $evento->setDeporte(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getNombre();
    }

    /**
     * @return Collection|Participa[]
     */
    public function getEventoParticipados(): Collection
    {
        return $this->eventoParticipados;
    }

    public function addEventoParticipado(Participa $eventoParticipado): self
    {
        if (!$this->eventoParticipados->contains($eventoParticipado)) {
            $this->eventoParticipados[] = $eventoParticipado;
            $eventoParticipado->setDeporte($this);
        }

        return $this;
    }

    public function removeEventoParticipado(Participa $eventoParticipado): self
    {
        if ($this->eventoParticipados->contains($eventoParticipado)) {
            $this->eventoParticipados->removeElement($eventoParticipado);
            // set the owning side to null (unless already changed)
            if ($eventoParticipado->getDeporte() === $this) {
                $eventoParticipado->setDeporte(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Posicion[]
     */
    public function getPosiciones(): Collection
    {
        return $this->posiciones;
    }

    public function addPosicione(Posicion $posicione): self
    {
        if (!$this->posiciones->contains($posicione)) {
            $this->posiciones[] = $posicione;
            $posicione->setDeporte($this);
        }

        return $this;
    }

    public function removePosicione(Posicion $posicione): self
    {
        if ($this->posiciones->contains($posicione)) {
            $this->posiciones->removeElement($posicione);
            // set the owning side to null (unless already changed)
            if ($posicione->getDeporte() === $this) {
                $posicione->setDeporte(null);
            }
        }

        return $this;
    }
}
