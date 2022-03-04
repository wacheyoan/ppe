<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\FoodRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=FoodRepository::class)
 * @ORM\HasLifecycleCallbacks
 * @ApiResource(
 *     normalizationContext={"groups"={"food:read"}},
 *     denormalizationContext={"groups"={"food:write"}}
 * )
 */
class Food
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({
     *     "food:read",
     *     "meal:read",
     *     "foodplan:read"
     * })
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({
     *     "food:read","food:write",
     *     "meal:read","meal:write",
     *     "foodplan:read"
     * })
     */
    private $wording;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     * @Groups({
     *     "food:read","food:write",
     *     "meal:read","meal:write",
     *     "foodplan:read"
     * })
     */
    private $photo;

    /**
     * @ORM\Column(type="float")
     * @Groups({
     *     "food:read","food:write",
     *     "meal:read","meal:write",
     *     "foodplan:read"
     * })
     */
    private $carbohydrate;

    /**
     * @ORM\Column(type="float")
     * @Groups({
     *     "food:read","food:write",
     *     "meal:read","meal:write",
     *     "foodplan:read"
     * })
     */
    private $sugar;

    /**
     * @ORM\Column(type="float")
     * @Groups({
     *     "food:read","food:write",
     *     "meal:read","meal:write",
     *     "foodplan:read"
     * })
     */
    private $protein;

    /**
     * @ORM\Column(type="float")
     * @Groups({
     *     "food:read","food:write",
     *     "meal:read","meal:write",
     *     "foodplan:read"
     * })
     */
    private $fat;

    /**
     * @ORM\Column(type="float")
     * @Groups({
     *     "food:read","food:write",
     *     "meal:read","meal:write",
     *     "foodplan:read"
     * })
     */
    private $saturatedFat;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({
     *     "food:read","food:write",
     *     "meal:read","meal:write",
     *     "foodplan:read"
     * })
     */
    private $vegan;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Groups({
     *     "food:read",
     *     "meal:read",
     *     "foodplan:read"
     * })
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     * @Groups({
     *     "food:read",
     *     "meal:read",
     *     "foodplan:read"
     * })
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="food")
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity=FoodCategory::class, inversedBy="foods",cascade={"persist"})
     * @Groups({
     *     "food:read","food:write",
     *     "meal:read","meal:write",
     *     "foodplan:read"
     * })
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity=Meal::class, mappedBy="foods")
     */
    private $meals;

    public function __construct()
    {
        $this->category = new ArrayCollection();
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

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getCarbohydrate(): ?float
    {
        return $this->carbohydrate;
    }

    public function setCarbohydrate(float $carbohydrate): self
    {
        $this->carbohydrate = $carbohydrate;

        return $this;
    }

    public function getSugar(): ?float
    {
        return $this->sugar;
    }

    public function setSugar(float $sugar): self
    {
        $this->sugar = $sugar;

        return $this;
    }

    public function getProtein(): ?float
    {
        return $this->protein;
    }

    public function setProtein(float $protein): self
    {
        $this->protein = $protein;

        return $this;
    }

    public function getFat(): ?float
    {
        return $this->fat;
    }

    public function setFat(float $fat): self
    {
        $this->fat = $fat;

        return $this;
    }

    public function getSaturatedFat(): ?float
    {
        return $this->saturatedFat;
    }

    public function setSaturatedFat(float $saturatedFat): self
    {
        $this->saturatedFat = $saturatedFat;

        return $this;
    }

    public function getVegan(): ?bool
    {
        return $this->vegan;
    }

    public function setVegan(bool $vegan): self
    {
        $this->vegan = $vegan;

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
     * @return Collection<int, FoodCategory>
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(FoodCategory $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
        }

        return $this;
    }

    public function removeCategory(FoodCategory $category): self
    {
        $this->category->removeElement($category);

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
            $meal->addFood($this);
        }

        return $this;
    }

    public function removeMeal(Meal $meal): self
    {
        if ($this->meals->removeElement($meal)) {
            $meal->removeFood($this);
        }

        return $this;
    }
}
