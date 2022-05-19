<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 * @ORM\HasLifecycleCallbacks
 * @ApiResource(
 *     normalizationContext={"groups"={"user:read"}},
 *     denormalizationContext={"groups"={"user:write"}}
 * )
 * @ApiFilter(SearchFilter::class,  properties={"email": "exact"})
 * 
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({
     *     "user:read",
     *     "meal:read",
     *     "foodplan:read"
     * })
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({
     *     "user:read", "user:write",
     *     "meal:read",
     *     "foodplan:read"
     * })
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     * @Groups({
     *     "user:read",
     *     "meal:read",
     *     "foodplan:read"
     * })
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({
     *     "user:read", "user:write",
     *     "meal:read",
     *     "foodplan:read"
     * })
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({
     *     "user:read", "user:write",
     *     "meal:read",
     *     "foodplan:read"
     * })
     */
    private $lastName;
    

    /**
     * @Groups("user:write")
     * @SerializedName("password")
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     * @Groups({
     *     "user:read", "user:write",
     *     "meal:read",
     *     "foodplan:read"
     * })
     */
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({
     *     "user:read", "user:write",
     *     "meal:read",
     *     "foodplan:read"
     * })
     */
    private $phone;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({
     *     "user:read", "user:write",
     *     "meal:read",
     *     "foodplan:read"
     * })
     */
    private $weight;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({
     *     "user:read", "user:write",
     *     "meal:read",
     *     "foodplan:read"
     * })
     */
    private $height;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Groups({
     *     "user:read",
     *     "meal:read",
     *     "foodplan:read"
     * })
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     * @Groups({
     *     "user:read",
     *     "meal:read",
     *     "foodplan:read"
     * })
     * 
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=Activity::class)
     * @Groups({
     *     "user:read","user:write"
     * })
     */
    private $activity;

    /**
     * @ORM\OneToMany(targetEntity=Progression::class, mappedBy="user", orphanRemoval=true)
     */
    private $progressions;

    /**
     * @ORM\ManyToOne(targetEntity=Objective::class)
     * @Groups({
     *     "user:read","user:write"
     * })
     */
    private $objective;

    /**
     * @ORM\OneToMany(targetEntity=FoodPlan::class, mappedBy="user", orphanRemoval=true)
     */
    private $foodPlan;

    /**
     * @ORM\OneToMany(targetEntity=Meal::class, mappedBy="user")
     */
    private $meals;

    /**
     * @ORM\OneToMany(targetEntity=Food::class, mappedBy="user")
     */
    private $food;

    /**
     * @ORM\ManyToMany(targetEntity=Meal::class, mappedBy="userLike")
     */
    private $likedMeals;

    /**
     * @ORM\ManyToMany(targetEntity=Meal::class, mappedBy="userDislike")
     */
    private $dislikedMeals;

    /**
     * @ORM\Column(type="date")
     * @Groups({
     *     "user:read","user:write"
     * })
     *
     */
    private $birthDate;

    /**
     * @ORM\Column(type="string", length=1)
     * @Groups({
     *     "user:read","user:write"
     * })
     */
    private $gender;

    public function __construct()
    {
        $this->progressions = new ArrayCollection();
        $this->foodPlan = new ArrayCollection();
        $this->meals = new ArrayCollection();
        $this->food = new ArrayCollection();
        $this->likedMeals = new ArrayCollection();
        $this->dislikedMeals = new ArrayCollection();
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
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
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
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }

    public function getPlainPassword(){
        return $this->plainPassword;
    }

    public function setPlainPassword($password){
        $this->plainPassword = $password;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(?float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getHeight(): ?float
    {
        return $this->height;
    }

    public function setHeight(?float $height): self
    {
        $this->height = $height;

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

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
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

    public function getActivity(): ?Activity
    {
        return $this->activity;
    }

    public function setActivity(?Activity $activity): self
    {
        $this->activity = $activity;

        return $this;
    }

    /**
     * @return Collection<int, Progression>
     */
    public function getProgressions(): Collection
    {
        return $this->progressions;
    }

    public function addProgression(Progression $progression): self
    {
        if (!$this->progressions->contains($progression)) {
            $this->progressions[] = $progression;
            $progression->setUser($this);
        }

        return $this;
    }

    public function removeProgression(Progression $progression): self
    {
        if ($this->progressions->removeElement($progression)) {
            // set the owning side to null (unless already changed)
            if ($progression->getUser() === $this) {
                $progression->setUser(null);
            }
        }

        return $this;
    }

    public function getObjective(): ?Objective
    {
        return $this->objective;
    }

    public function setObjective(?Objective $objective): self
    {
        $this->objective = $objective;

        return $this;
    }

    /**
     * @return Collection<int, FoodPlan>
     */
    public function getFoodPlan(): Collection
    {
        return $this->foodPlan;
    }

    public function addFoodPlan(FoodPlan $foodPlan): self
    {
        if (!$this->foodPlan->contains($foodPlan)) {
            $this->foodPlan[] = $foodPlan;
            $foodPlan->setUser($this);
        }

        return $this;
    }

    public function removeFoodPlan(FoodPlan $foodPlan): self
    {
        if ($this->foodPlan->removeElement($foodPlan)) {
            // set the owning side to null (unless already changed)
            if ($foodPlan->getUser() === $this) {
                $foodPlan->setUser(null);
            }
        }

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
            $meal->setUser($this);
        }

        return $this;
    }

    public function removeMeal(Meal $meal): self
    {
        if ($this->meals->removeElement($meal)) {
            // set the owning side to null (unless already changed)
            if ($meal->getUser() === $this) {
                $meal->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Food>
     */
    public function getFood(): Collection
    {
        return $this->food;
    }

    public function addFood(Food $food): self
    {
        if (!$this->food->contains($food)) {
            $this->food[] = $food;
            $food->setUser($this);
        }

        return $this;
    }

    public function removeFood(Food $food): self
    {
        if ($this->food->removeElement($food)) {
            // set the owning side to null (unless already changed)
            if ($food->getUser() === $this) {
                $food->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Meal>
     */
    public function getLikedMeals(): Collection
    {
        return $this->likedMeals;
    }

    public function addLikedMeal(Meal $likedMeal): self
    {
        if (!$this->likedMeals->contains($likedMeal)) {
            $this->likedMeals[] = $likedMeal;
            $likedMeal->addUserLike($this);
        }

        return $this;
    }

    public function removeLikedMeal(Meal $likedMeal): self
    {
        if ($this->likedMeals->removeElement($likedMeal)) {
            $likedMeal->removeUserLike($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Meal>
     */
    public function getDislikedMeals(): Collection
    {
        return $this->dislikedMeals;
    }

    public function addDislikedMeal(Meal $dislikedMeal): self
    {
        if (!$this->dislikedMeals->contains($dislikedMeal)) {
            $this->dislikedMeals[] = $dislikedMeal;
            $dislikedMeal->addUserDislike($this);
        }

        return $this;
    }

    public function removeDislikedMeal(Meal $dislikedMeal): self
    {
        if ($this->dislikedMeals->removeElement($dislikedMeal)) {
            $dislikedMeal->removeUserDislike($this);
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }


    public function getAge()
    {
        $today = date("Y-m-d");
        $diff = date_diff(date_create($this->getBirthDate()->format('Y-m-d')), date_create($today));
        return $diff->format('%y');
    }


    public function getBMR()
    {
        $coeff = $this->getGender() === "M" ? 5 : -161;
        $total = 10 * $this->getWeight() + 6.25 * $this->getHeight() + 5 * $this->getAge();

        return $total + $coeff;
    }

    public function getEntretien()
    {
        return $this->getBMR() * $this->getActivity()->getCoefficient();
    }

    public function getCalories()
    {
        return $this->getEntretien() - 1000;
    }

}
