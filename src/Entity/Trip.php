<?php

namespace App\Entity;

use App\Repository\TripRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TripRepository::class)]
class Trip
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Vehicle::class)]
    private Collection $Vehicle;

    #[ORM\ManyToMany(targetEntity: Driver::class)]
    private Collection $Driver;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $Date = null;

    public function __construct()
    {
        $this->Vehicle = new ArrayCollection();
        $this->Driver = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Vehicle>
     */
    public function getVehicle(): Collection
    {
        return $this->Vehicle;
    }

    public function addVehicle(Vehicle $vehicle): static
    {
        if (!$this->Vehicle->contains($vehicle)) {
            $this->Vehicle->add($vehicle);
        }

        return $this;
    }

    public function removeVehicle(Vehicle $vehicle): static
    {
        $this->Vehicle->removeElement($vehicle);

        return $this;
    }

    /**
     * @return Collection<int, Driver>
     */
    public function getDriver(): Collection
    {
        return $this->Driver;
    }

    public function addDriver(Driver $driver): static
    {
        if (!$this->Driver->contains($driver)) {
            $this->Driver->add($driver);
        }

        return $this;
    }

    public function removeDriver(Driver $driver): static
    {
        $this->Driver->removeElement($driver);

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): static
    {
        $this->Date = $Date;

        return $this;
    }
}
