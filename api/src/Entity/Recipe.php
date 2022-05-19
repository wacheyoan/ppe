<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Filters\RecipeFilter;
use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

    /**
 * @ORM\Entity(repositoryClass=RecipeRepository::class)
 * @ORM\HasLifecycleCallbacks
 * @ApiResource(
 *     normalizationContext={"groups"={"recipe:read"}},
 *     denormalizationContext={"groups"={"recipe:write"}}
 * )
 * @ApiFilter(RecipeFilter::class)
 */
class Recipe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({
     *     "recipe:read",
     *     "meal:read",
     *     "foodplan:read"
     * })
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({
     *     "recipe:read","recipe:write",
     *     "meal:read","meal:write",
     *     "foodplan:read"
     * })
     */
    private $wording;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Groups({
     *     "recipe:read",
     *     "meal:read",
     *     "foodplan:read"
     * })
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     * @Groups({
     *     "recipe:read",
     *     "meal:read",
     *     "foodplan:read"
     * })
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity=Step::class, mappedBy="recipe", orphanRemoval=true)
     * @Groups({
     *     "recipe:read",
     *     "meal:read",
     *     "foodplan:read"
     * })
     */
    private $steps;

    /**
     * @ORM\ManyToMany(targetEntity=Utensil::class)
     * @Groups({
     *     "recipe:read",
     *     "meal:read",
     *     "foodplan:read"
     * })
     */
    private $utensils;

    public function __construct()
    {
        $this->steps = new ArrayCollection();
        $this->utensils = new ArrayCollection();
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
     * @return Collection<int, Step>
     */
    public function getSteps(): Collection
    {
        return $this->steps;
    }

    public function addStep(Step $step): self
    {
        if (!$this->steps->contains($step)) {
            $this->steps[] = $step;
            $step->setRecipe($this);
        }

        return $this;
    }

    public function removeStep(Step $step): self
    {
        if ($this->steps->removeElement($step)) {
            // set the owning side to null (unless already changed)
            if ($step->getRecipe() === $this) {
                $step->setRecipe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Utensil>
     */
    public function getUtensils(): Collection
    {
        return $this->utensils;
    }

    public function addUtensil(Utensil $utensil): self
    {
        if (!$this->utensils->contains($utensil)) {
            $this->utensils[] = $utensil;
        }

        return $this;
    }

    public function removeUtensil(Utensil $utensil): self
    {
        $this->utensils->removeElement($utensil);

        return $this;
    }
}
