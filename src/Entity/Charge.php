<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ChargeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Lcobucci\Clock\SystemClock;

#[ORM\Entity(repositoryClass: ChargeRepository::class)]
#[ORM\Table(name: 'charges')]
class Charge
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column]
    private float $amount;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $date;

    /**
     * @var Collection<int, ChargeLine>
     */
    #[ORM\OneToMany(mappedBy: 'charge', targetEntity: ChargeLine::class)]
    private Collection $chargeLines;

    public function __construct()
    {
        $this->chargeLines = new ArrayCollection();
        $clock = SystemClock::fromSystemTimezone();
        $this->date = $clock->now();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(\DateTimeImmutable $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection<int, ChargeLine>
     */
    public function getChargeLines(): Collection
    {
        return $this->chargeLines;
    }

    public function addChargeLine(ChargeLine $chargeLine): self
    {
        if (! $this->chargeLines->contains($chargeLine)) {
            $this->chargeLines->add($chargeLine);
            $chargeLine->setCharge($this);
        }

        return $this;
    }

    public function removeChargeLine(ChargeLine $chargeLine): self
    {
        if ($this->chargeLines->removeElement($chargeLine)) {
            // set the owning side to null (unless already changed)
            if ($chargeLine->getCharge() === $this) {
                $chargeLine->setCharge(null);
            }
        }

        return $this;
    }
}
