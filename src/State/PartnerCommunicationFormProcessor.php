<?php

namespace App\State;

use ApiPlatform\Doctrine\Common\State\PersistProcessor;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Repository\PartnerRepository;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

readonly class PartnerCommunicationFormProcessor implements ProcessorInterface
{
    public function __construct(
        private PartnerRepository $partnerRepository,
        #[Autowire(service: PersistProcessor::class)]
        private ProcessorInterface $processor
    ) {
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): mixed
    {
        // Handle the state
        $partnerId = $data->getPartnerId();

        // Get the partner ID and add the partner group.
        $partner = $this->partnerRepository->find($partnerId);
        $data->setPartner($partner);

        return $this->processor->process($data, $operation, $uriVariables, $context);
    }
}
