<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 */
class Image
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters",
     *      allowEmptyString = false
     * )
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = null,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters",
     *      allowEmptyString = false
     * )
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $path;

    /**
     * @ORM\ManyToMany(targetEntity=Player::class, mappedBy="image")
     */
    private $players;

    /**
     * @ORM\OneToMany(targetEntity=Player::class, mappedBy="poster")
     */
    private $playerPosters;

    public function __construct()
    {
        $this->players = new ArrayCollection();
        $this->poster = new ArrayCollection();
        $this->playerPosters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @return Collection|Player[]
     */
    public function getPlayers(): Collection
    {
        return $this->players;
    }

    public function addPlayer(Player $player): self
    {
        if (!$this->players->contains($player)) {
            $this->players[] = $player;
            $player->addImage($this);
        }

        return $this;
    }

    public function removePlayer(Player $player): self
    {
        if ($this->players->contains($player)) {
            $this->players->removeElement($player);
            $player->removeImage($this);
        }

        return $this;
    }

    /**
     * @return Collection|Player[]
     */
    public function getPlayerPosters(): Collection
    {
        return $this->playerPosters;
    }

    public function addPlayerPoster(Player $playerPoster): self
    {
        if (!$this->playerPosters->contains($playerPoster)) {
            $this->playerPosters[] = $playerPoster;
            $playerPoster->setPoster($this);
        }

        return $this;
    }

    public function removePlayerPoster(Player $playerPoster): self
    {
        if ($this->playerPosters->contains($playerPoster)) {
            $this->playerPosters->removeElement($playerPoster);
            // set the owning side to null (unless already changed)
            if ($playerPoster->getPoster() === $this) {
                $playerPoster->setPoster(null);
            }
        }

        return $this;
    }
}
