<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsuarioRepository")
 */
class Usuario implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $apellidos;

    /**
     * @ORM\Column(type="integer")
     */
    private $edad;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $nick;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Evento", mappedBy="creador")
     */
    private $eventosCreados;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Participa", mappedBy="jugador")
     */
    private $eventosParticipados;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $avatar;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha_alta;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Practica", mappedBy="jugador", orphanRemoval=true)
     */
    private $deportesPracticados;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Localidad", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $localidad;

    public function __construct()
    {
        $this->eventosCreados = new ArrayCollection();
        $this->eventosParticipados = new ArrayCollection();
        $this->deportesPracticados = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): self
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    public function getEdad(): ?int
    {
        return $this->edad;
    }

    public function setEdad(int $edad): self
    {
        $this->edad = $edad;

        return $this;
    }

    public function getNick(): ?string
    {
        return $this->nick;
    }

    public function setNick(string $nick): self
    {
        $this->nombre = $nick;

        return $this;
    }

    /**
     * @return Collection|Evento[]
     */
    public function getEventosCreados(): Collection
    {
        return $this->eventosCreados;
    }

    public function addEventosCreado(Evento $eventosCreado): self
    {
        if (!$this->eventosCreados->contains($eventosCreado)) {
            $this->eventosCreados[] = $eventosCreado;
            $eventosCreado->setCreador($this);
        }

        return $this;
    }

    public function removeEventosCreado(Evento $eventosCreado): self
    {
        if ($this->eventosCreados->contains($eventosCreado)) {
            $this->eventosCreados->removeElement($eventosCreado);
            // set the owning side to null (unless already changed)
            if ($eventosCreado->getCreador() === $this) {
                $eventosCreado->setCreador(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Participa[]
     */
    public function getEventosParticipados(): Collection
    {
        return $this->eventosParticipados;
    }

    public function addEventosParticipado(Participa $eventosParticipado): self
    {
        if (!$this->eventosParticipados->contains($eventosParticipado)) {
            $this->eventosParticipados[] = $eventosParticipado;
            $eventosParticipado->setJugador($this);
        }

        return $this;
    }

    public function removeEventosParticipado(Participa $eventosParticipado): self
    {
        if ($this->eventosParticipados->contains($eventosParticipado)) {
            $this->eventosParticipados->removeElement($eventosParticipado);
            // set the owning side to null (unless already changed)
            if ($eventosParticipado->getJugador() === $this) {
                $eventosParticipado->setJugador(null);
            }
        }

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getFechaAlta(): ?\DateTimeInterface
    {
        return $this->fecha_alta;
    }

    public function setFechaAlta(\DateTimeInterface $fecha_alta): self
    {
        $this->fecha_alta = $fecha_alta;

        return $this;
    }

    /**
     * @return Collection|Practica[]
     */
    public function getDeportesPracticados(): Collection
    {
        return $this->deportesPracticados;
    }

    public function addDeportesPracticado(Practica $deportesPracticado): self
    {
        if (!$this->deportesPracticados->contains($deportesPracticado)) {
            $this->deportesPracticados[] = $deportesPracticado;
            $deportesPracticado->setJugador($this);
        }

        return $this;
    }

    public function removeDeportesPracticado(Practica $deportesPracticado): self
    {
        if ($this->deportesPracticados->contains($deportesPracticado)) {
            $this->deportesPracticados->removeElement($deportesPracticado);
            // set the owning side to null (unless already changed)
            if ($deportesPracticado->getJugador() === $this) {
                $deportesPracticado->setJugador(null);
            }
        }

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
    
    public function __toString()
    {
        return $this->nombre;
    }
}
