<?php

namespace App\Entity;

use App\Repository\VehicleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehicleRepository::class)]
class Vehicle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $Uuid = null;

    #[ORM\Column(length: 255)]
    private ?string $Brand = null;

    #[ORM\Column(length: 255)]
    private ?string $Model = null;

    #[ORM\Column(length: 255)]
    private ?string $Plate = null;

    #[ORM\Column(length: 1)]
    private ?string $LicenseRequired = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid(): ?string
    {
        return $this->Uuid;
    }

    public function setUuid(string $Uuid): static
    {
        $this->Uuid = $Uuid;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->Brand;
    }

    public function setBrand(string $Brand): static
    {
        $this->Brand = $Brand;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->Model;
    }

    public function setModel(string $Model): static
    {
        $this->Model = $Model;

        return $this;
    }

    public function getPlate(): ?string
    {
        return $this->Plate;
    }

    public function setPlate(string $Plate): static
    {
        $this->Plate = $Plate;

        return $this;
    }

    public function getLicenseRequired(): ?string
    {
        return $this->LicenseRequired;
    }

    public function setLicenseRequired(string $LicenseRequired): static
    {
        $this->LicenseRequired = $LicenseRequired;

        return $this;
    }
}
