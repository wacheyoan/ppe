<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Filters\MealUserFilter;
use App\Repository\MealRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=MealRepository::class)
 * @ORM\HasLifecycleCallbacks
 * @ApiResource(
 *     normalizationContext={"groups"={"meal:read"}},
 *     denormalizationContext={"groups"={"meal:write"}}
 * )
 * @ApiFilter(SearchFilter::class, properties={"userLike.id": "exact","userDislike.id": "exact"})
 * @ApiFilter(MealUserFilter::class)
 */
class Meal
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({
     *     "meal:read",
     *     "foodplan:read"
     * })
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({
     *     "meal:read", "meal:write",
     *     "foodplan:read"
     * })
     */
    private $wording;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Groups({
     *     "meal:read",
     *     "foodplan:read"
     * })
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     * @Groups({
     *     "meal:read",
     *     "foodplan:read"
     * })
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="meals")
     * @Groups({
     *     "meal:read",
     * })
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity=Food::class, inversedBy="meals",cascade={"persist"})
     * @Groups({
     *     "meal:read","meal:write",
     *     "foodplan:read"
     * })
     */
    private $foods;

    /**
     * @ORM\ManyToOne(targetEntity=Recipe::class)
     * @Groups({
     *     "meal:read","meal:write",
     *     "foodplan:read"
     * })
     */
    private $recipe;

    /**
     * @ORM\ManyToMany(targetEntity=FoodPlan::class, mappedBy="meals")
     */
    private $foodPlans;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="likedMeals")
     * @Groups({
     *     "meal:read","meal:write"
     * })
     */
    private $userLike;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="dislikedMeals")
     * @JoinTable(name="dislike_meal")
     *      joinColumns={@JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="meal_id", referencedColumnName="id")}
     * )
     * @Groups({
     *     "meal:read","meal:write"
     * })
     */
    private $userDislike;


    public function __construct()
    {
        $this->foods = new ArrayCollection();
        $this->foodPlans = new ArrayCollection();
        $this->userLike = new ArrayCollection();
        $this->userDislike = new ArrayCollection();
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
     * @return Collection<int, Food>
     */
    public function getFoods(): Collection
    {
        return $this->foods;
    }

    public function addFood(Food $food): self
    {
        if (!$this->foods->contains($food)) {
            $this->foods[] = $food;
        }

        return $this;
    }

    public function removeFood(Food $food): self
    {
        $this->foods->removeElement($food);

        return $this;
    }

    public function getRecipe(): ?Recipe
    {
        return $this->recipe;
    }

    public function setRecipe(?Recipe $recipe): self
    {
        $this->recipe = $recipe;

        return $this;
    }

    /**
     * @return Collection<int, FoodPlan>
     */
    public function getFoodPlans(): Collection
    {
        return $this->foodPlans;
    }

    public function addFoodPlan(FoodPlan $foodPlan): self
    {
        if (!$this->foodPlans->contains($foodPlan)) {
            $this->foodPlans[] = $foodPlan;
            $foodPlan->addMeal($this);
        }

        return $this;
    }

    public function removeFoodPlan(FoodPlan $foodPlan): self
    {
        if ($this->foodPlans->removeElement($foodPlan)) {
            $foodPlan->removeMeal($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUserLike(): Collection
    {
        return $this->userLike;
    }

    public function addUserLike(User $userLike): self
    {
        if (!$this->userLike->contains($userLike)) {
            $this->userLike[] = $userLike;
        }

        return $this;
    }

    public function removeUserLike(User $userLike): self
    {
        $this->userLike->removeElement($userLike);

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUserDislike(): Collection
    {
        return $this->userDislike;
    }

    public function addUserDislike(User $userDislike): self
    {
        if (!$this->userDislike->contains($userDislike)) {
            $this->userDislike[] = $userDislike;
        }

        return $this;
    }

    public function removeUserDislike(User $userDislike): self
    {
        $this->userDislike->removeElement($userDislike);

        return $this;
    }

    public function getCalories()
    {
        $calories = 0;
        foreach ($this->foods as $food) {
            $calories += $food->getCalories();
        }
        return $calories;
    }

    public function __toString()
    {
        return (string) $this->id;
    }


}
