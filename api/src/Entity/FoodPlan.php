<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\FoodPlanRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=FoodPlanRepository::class)
 * @ORM\HasLifecycleCallbacks
 * @ApiResource(
 *     normalizationContext={"groups"={"foodplan:read"}},
 *     denormalizationContext={"groups"={"foodplan:write"}}
 * )
 */
class FoodPlan
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({
     *     "foodplan:read",
     * })
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({
     *     "foodplan:read","foodplan:write"
     * })
     */
    private $wording;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Groups({
     *     "foodplan:read",
     * })
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     * @Groups({
     *     "foodplan:read",
     * })
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="foodPlan")
     * @ORM\JoinColumn(nullable=true)
     * @Groups({
     *     "foodplan:read",
     * })
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity=Meal::class, inversedBy="foodPlans")
     * @Groups({
     *     "foodplan:read",
     * })
     */
    private $meals;

    /**
     * @ORM\OneToOne(targetEntity=Period::class, cascade={"persist", "remove"})
     * @Groups({
     *     "foodplan:read",
     * })
     */
    private $period;

    public function __construct()
    {
        $this->meals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWording(): ?string
    {
        return $this->wording;
    }

    public function setWording(string $wording): self
    {
        $this->wording = $wording;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->createdAt = new \DateTimeImmutable("now");
    }

    /**
     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $this->updatedAt = new \DateTimeImmutable("now");
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Meal>
     */
    public function getMeals(): Collection
    {
        return $this->meals;
    }

    public function addMeal(Meal $meal): self
    {
        if (!$this->meals->contains($meal)) {
            $this->meals[] = $meal;
        }

        return $this;
    }

    public function removeMeal(Meal $meal): self
    {
        $this->meals->removeElement($meal);

        return $this;
    }

    public function getPeriod(): ?Period
    {
        return $this->period;
    }

    public function setPeriod(?Period $period): self
    {
        $this->period = $period;

        return $this;
    }
}
