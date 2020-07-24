<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlayerRepository::class)
 */
class Player
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
     *      max = 100,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters",
     *      allowEmptyString = false
     * )
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Assert\NotBlank
     * @Assert\Range(
     *      min = null,
     *      max = "now"
     * )
     * @ORM\Column(type="date")
     */
    private $dateOfBirth;

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
    private $nationality;

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
    private $current_team;

    /**
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 30,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters",
     *      allowEmptyString = false
     * )
     * @ORM\Column(type="string", length=255)
     */
    private $bestFoot;

    /**
     * @Assert\NotBlank
     * @Assert\Range(
     *      min = 100,
     *      max = 250,
     *      notInRangeMessage = "You must be between {{ min }} cm and {{ max }} cm tall to enter",
     * )
     * @ORM\Column(type="integer")
     */
    private $size;

    /**
     * @Assert\NotBlank
     * @Assert\Range(
     *      min = 30,
     *      max = 150,
     *      notInRangeMessage = "You must be between {{ min }} kg and {{ max }} kg tall to enter",
     * )
     * @ORM\Column(type="integer")
     */
    private $weight;

    /**
     * @Assert\NotBlank
     * @Assert\Range(
     *      min = 1000000,
     *      max = 250000000,
     *      notInRangeMessage = "You must be between {{ min }} € and {{ max }} € tall to enter",
     * )
     * @ORM\Column(type="integer", nullable=true)
     */
    private $price;

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
    private $position;

    /**
     * @ORM\OneToMany(targetEntity=Performance::class, mappedBy="player")
     */
    private $performance;

    /**
     * @ORM\ManyToMany(targetEntity=Image::class, inversedBy="players")
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity=Video::class, inversedBy="players")
     */
    private $video;

    /**
     * @ORM\ManyToOne(targetEntity=Image::class, inversedBy="playerPosters")
     */
    private $poster;

    public function __construct()
    {
        $this->performance = new ArrayCollection();
        $this->image = new ArrayCollection();
        $this->video = new ArrayCollection();
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

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(\DateTimeInterface $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(string $nationality): self
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getCurrentTeam(): ?string
    {
        return $this->current_team;
    }

    public function setCurrentTeam(string $current_team): self
    {
        $this->current_team = $current_team;

        return $this;
    }

    public function getBestFoot(): ?string
    {
        return $this->bestFoot;
    }

    public function setBestFoot(string $bestFoot): self
    {
        $this->bestFoot = $bestFoot;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(int $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(string $position): self
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @return Collection|Performance[]
     */
    public function getPerformance(): Collection
    {
        return $this->performance;
    }

    public function addPerformance(Performance $performance): self
    {
        if (!$this->performance->contains($performance)) {
            $this->performance[] = $performance;
            $performance->setPlayer($this);
        }

        return $this;
    }

    public function removePerformance(Performance $performance): self
    {
        if ($this->performance->contains($performance)) {
            $this->performance->removeElement($performance);
            // set the owning side to null (unless already changed)
            if ($performance->getPlayer() === $this) {
                $performance->setPlayer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImage(): Collection
    {
        return $this->image;
    }

    public function addImage(Image $image): self
    {
        if (!$this->image->contains($image)) {
            $this->image[] = $image;
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->image->contains($image)) {
            $this->image->removeElement($image);
        }

        return $this;
    }

    /**
     * @return Collection|Video[]
     */
    public function getVideo(): Collection
    {
        return $this->video;
    }

    public function addVideo(Video $video): self
    {
        if (!$this->video->contains($video)) {
            $this->video[] = $video;
        }

        return $this;
    }

    public function removeVideo(Video $video): self
    {
        if ($this->video->contains($video)) {
            $this->video->removeElement($video);
        }

        return $this;
    }

    public function getPoster(): ?Image
    {
        return $this->poster;
    }

    public function setPoster(?Image $poster): self
    {
        $this->poster = $poster;

        return $this;
    }
}
