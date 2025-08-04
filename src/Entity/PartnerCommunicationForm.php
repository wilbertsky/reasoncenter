<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Repository\PartnerCommunicationFormRepository;
use App\State\PartnerCommunicationFormProcessor;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ApiResource(
    operations: [
        new Get(uriTemplate: '/events/{id}'),
        new GetCollection(uriTemplate: '/events'),
    ],
    normalizationContext: ['groups' => ['PartnerCommunicationForm:read']],
)]

#[Post(
    uriTemplate: '/events',
    denormalizationContext: ['PartnerCommunicationForm:write'],
    //deserialize: false,
    processor: PartnerCommunicationFormProcessor::class,

)]

#[ORM\Entity(repositoryClass: PartnerCommunicationFormRepository::class)]
class PartnerCommunicationForm
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[ApiProperty(identifier: true)]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['PartnerCommunicationForm:read', 'PartnerCommunicationForm:write'])]
    private ?bool $isEvent = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups(['PartnerCommunicationForm:read', 'PartnerCommunicationForm:write'])]
    private ?\DateTimeInterface $eventStartTime = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups(['PartnerCommunicationForm:read', 'PartnerCommunicationForm:write'])]
    private ?\DateTimeInterface $eventEndTime = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['PartnerCommunicationForm:read', 'PartnerCommunicationForm:write'])]
    private ?bool $isRecurring = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['PartnerCommunicationForm:read', 'PartnerCommunicationForm:write'])]
    private ?string $eventName = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['PartnerCommunicationForm:read', 'PartnerCommunicationForm:write'])]
    private ?string $eventDescription = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['PartnerCommunicationForm:read', 'PartnerCommunicationForm:write'])]
    private ?string $eventImage = null;

    #[ORM\Column(name: 'image_id', nullable: true)]
    #[ORM\ManyToOne(targetEntity: MediaObject::class, inversedBy: 'partnerCommunicationForms')]
    #[ORM\JoinColumn(nullable: true)]
    #[Groups(['PartnerCommunicationForm:read', 'PartnerCommunicationForm:write'])]
    private int $imageId;

    #[ORM\ManyToOne(inversedBy: 'partnerCommunicationForms')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['PartnerCommunicationForm:read'])]
    private Partner $partner;

    #[ORM\Column(name: 'partner_id', nullable: false)]
    #[Groups(['PartnerCommunicationForm:write'])]
    private int $partnerId;

    #[ORM\Column]
    #[Groups(['PartnerCommunicationForm:read', 'PartnerCommunicationForm:write'])]
    private ?bool $isPublished = null;

    #[ORM\ManyToOne(targetEntity: MediaObject::class)]
    #[ORM\JoinColumn(nullable: true)]
    #[ApiProperty(types: ['https://schema.org/image'])]
    #[Groups(['PartnerCommunicationForm:read', 'PartnerCommunicationForm:write'])]
    public ?MediaObject $image = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function isEvent(): ?bool
    {
        return $this->isEvent;
    }

    public function setEvent(?bool $isEvent): static
    {
        $this->isEvent = $isEvent;

        return $this;
    }

    public function getEventStartTime(): ?\DateTimeInterface
    {
        return $this->eventStartTime;
    }

    public function setEventStartTime(?\DateTimeInterface $eventStartTime): static
    {
        $this->eventStartTime = $eventStartTime;

        return $this;
    }

    public function getEventEndTime(): ?\DateTimeInterface
    {
        return $this->eventEndTime;
    }

    public function setEventEndTime(?\DateTimeInterface $eventEndTime): static
    {
        $this->eventEndTime = $eventEndTime;

        return $this;
    }

    public function isRecurring(): ?bool
    {
        return $this->isRecurring;
    }

    public function setRecurring(?bool $isRecurring): static
    {
        $this->isRecurring = $isRecurring;

        return $this;
    }

    public function getEventName(): ?string
    {
        return $this->eventName;
    }

    public function setEventName(?string $eventName): static
    {
        $this->eventName = $eventName;

        return $this;
    }

    public function getImageId(): int
    {
        return $this->imageId;
    }

    public function setImageId(int $imageId): static
    {
        $this->imageId = $imageId;

        return $this;
    }

    public function getEventDescription(): ?string
    {
        return $this->eventDescription;
    }

    public function setEventDescription(?string $eventDescription): static
    {
        $this->eventDescription = $eventDescription;

        return $this;
    }

    public function getEventImage(): ?string
    {
        return $this->eventImage;
    }

    public function setEventImage(?string $eventImage): static
    {
        $this->eventImage = $eventImage;

        return $this;
    }

    public function getPartner(): ?Partner
    {
        return $this->partner;
    }

    public function setPartner(?Partner $partner): static
    {
        $this->partner = $partner;

        return $this;
    }

    public function getPartnerId(): ?int
    {
        return $this->partnerId;
    }

    public function setPartnerId(?int $partnerId): static
    {
        $this->partnerId = $partnerId;

        return $this;
    }

    public function isPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setPublished(bool $isPublished): static
    {
        $this->isPublished = $isPublished;

        return $this;
    }


}
