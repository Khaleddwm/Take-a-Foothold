<?php

namespace App\Entity;

use App\Repository\PerformanceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use \DateTime;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PerformanceRepository::class)
 */
class Performance
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank
     * @Assert\Range(
     *      min = 1850,
     *      max = 2021,
     *      notInRangeMessage = "You must be between {{ min }} and {{ max }} to enter",
     * )
     * @ORM\Column(type="integer")
     */
    private $saison;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="integer")
     */
    private $assist;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="integer")
     */
    private $goal;

    /**
     * @Assert\Range(
     *      min = null,
     *      max = 120,
     *      notInRangeMessage = "You must be between {{ min }} minutes and {{ max }} minutes time to enter",
     * )
     * @ORM\Column(type="integer")
     */
    private $timePlayed;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class, inversedBy="performance")
     */
    private $player;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creationDate;

    public function __construct()
    {
        $this->creationDate = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSaison(): ?int
    {
        return $this->saison;
    }

    public function setSaison(int $saison): self
    {
        $this->saison = $saison;

        return $this;
    }

    public function getAssist(): ?int
    {
        return $this->assist;
    }

    public function setAssist(int $assist): self
    {
        $this->assist = $assist;

        return $this;
    }

    public function getGoal(): ?int
    {
        return $this->goal;
    }

    public function setGoal(int $goal): self
    {
        $this->goal = $goal;

        return $this;
    }

    public function getTimePlayed(): ?int
    {
        return $this->timePlayed;
    }

    public function setTimePlayed(int $timePlayed): self
    {
        $this->timePlayed = $timePlayed;

        return $this;
    }

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(?Player $player): self
    {
        $this->player = $player;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }
}
