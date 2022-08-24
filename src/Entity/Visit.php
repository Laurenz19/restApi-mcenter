<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\VisitRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: VisitRepository::class)]
#[ApiResource(
    attributes: ["pagination_enabled" => false],
    normalizationContext: ['groups' => ['visit_info']]
)]
#[ApiFilter(DateFilter::class, properties: ['date'])]
class Visit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups("visit_info")]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'visits')]
    #[Groups("visit_info")]
    private ?Doctor $medecin = null;

    #[ORM\ManyToOne(inversedBy: 'visits')]
    #[Groups("visit_info")]
    private ?Patient $patient = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups("visit_info")]
    private ?\DateTimeInterface $date = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMedecin(): ?Doctor
    {
        return $this->medecin;
    }

    public function setMedecin(?Doctor $medecin): self
    {
        $this->medecin = $medecin;

        return $this;
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): self
    {
        $this->patient = $patient;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
