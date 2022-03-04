<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\FoodCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=FoodCategoryRepository::class)
 * @ORM\HasLifecycleCallbacks
 * @ApiResource(
 *     normalizationContext={"groups"={"category:read"}},
 *     denormalizationContext={"groups"={"category:write"}}
 * )
 */
class FoodCategory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({
     *     "food:read",
     *     "category:read",
     *     "meal:read",
     *     "foodplan:read"
     * })
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({
     *     "food:read","food:write",
     *     "category:read","category:write",
     *     "meal:read","meal:write",
     *     "foodplan:read"
     * })
     */
    private $wording;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Groups({
     *     "food:read",
     *     "category:read",
     *     "meal:read",
     *     "foodplan:read"
     * })
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     * @Groups({
     *     "food:read",
     *     "category:read",
     *     "meal:read",
     *     "foodplan:read"
     * })
     */
    private $updatedAt;

    /**
     * @ORM\ManyToMany(targetEntity=Food::class, mappedBy="category")
     */
    private $foods;

    public function __construct()
    {
        $this->foods = new ArrayCollection();
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
            $food->addCategory($this);
        }

        return $this;
    }

    public function removeFood(Food $food): self
    {
        if ($this->foods->removeElement($food)) {
            $food->removeCategory($this);
        }

        return $this;
    }
}
