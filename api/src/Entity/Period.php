<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PeriodRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PeriodRepository::class)
 * @ORM\HasLifecycleCallbacks
 * @ApiResource(
 *     normalizationContext={"groups"={"period:read"}},
 *     denormalizationContext={"groups"={"period:write"}}
 * )
 */
class Period
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({
     *     "period:read",
     *     "foodplan:read"
     * })
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({
     *     "period:read","period:write",
     *     "foodplan:read"
     * })
     */
    private $start;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({
     *     "period:read","period:write",
     *     "foodplan:read"
     * })
     */
    private $end;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Groups({
     *     "period:read"
     * })
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     * @Groups({
     *     "period:read",
     * })
     */
    private $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(\DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(\DateTimeInterface $end): self
    {
        $this->end = $end;

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
}
