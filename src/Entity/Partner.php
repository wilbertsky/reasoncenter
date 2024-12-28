<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Repository\PartnerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ApiResource(
    operations: [
        new Get(uriTemplate: '/partners/{id}'),
        new GetCollection(uriTemplate: '/partners'),
        new Post(uriTemplate: '/partners')
    ],
)]
#[ORM\Entity(repositoryClass: PartnerRepository::class)]
class Partner
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[ApiProperty(identifier: true)]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['PartnerCommunicationForm:read'])]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['PartnerCommunicationForm:read'])]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['PartnerCommunicationForm:read'])]
    private ?string $websiteUrl = null;

    #[ORM\Column(length: 255)]
    #[Groups(['PartnerCommunicationForm:read'])]
    private ?string $primaryEmail = null;

    #[ORM\Column(length: 255)]
    #[Groups(['PartnerCommunicationForm:read'])]
    private ?string $phone = null;

    #[ORM\Column(length: 255)]
    #[Groups(['PartnerCommunicationForm:read'])]
    private ?string $contactName = null;

    /**
     * @var Collection<int, PartnerCommunicationForm>
     */
    #[ORM\OneToMany(targetEntity: PartnerCommunicationForm::class, mappedBy: 'partner')]
    private Collection $partnerCommunicationForms;

    public function __construct()
    {
        $this->partnerCommunicationForms = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getWebsiteUrl(): ?string
    {
        return $this->websiteUrl;
    }

    public function setWebsiteUrl(?string $websiteUrl): static
    {
        $this->websiteUrl = $websiteUrl;

        return $this;
    }

    public function getPrimaryEmail(): ?string
    {
        return $this->primaryEmail;
    }

    public function setPrimaryEmail(string $primaryEmail): static
    {
        $this->primaryEmail = $primaryEmail;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getContactName(): ?string
    {
        return $this->contactName;
    }

    public function setContactName(string $contactName): static
    {
        $this->contactName = $contactName;

        return $this;
    }

    /**
     * @return Collection<int, PartnerCommunicationForm>
     */
    public function getPartnerCommunicationForms(): Collection
    {
        return $this->partnerCommunicationForms;
    }

    public function addPartnerCommunicationForm(PartnerCommunicationForm $partnerCommunicationForm): static
    {
        if (!$this->partnerCommunicationForms->contains($partnerCommunicationForm)) {
            $this->partnerCommunicationForms->add($partnerCommunicationForm);
            $partnerCommunicationForm->setPartner($this);
        }

        return $this;
    }

    public function removePartnerCommunicationForm(PartnerCommunicationForm $partnerCommunicationForm): static
    {
        if ($this->partnerCommunicationForms->removeElement($partnerCommunicationForm)) {
            // set the owning side to null (unless already changed)
            if ($partnerCommunicationForm->getPartner() === $this) {
                $partnerCommunicationForm->setPartner(null);
            }
        }

        return $this;
    }
}
