<?php

namespace App\Doctrine\Filter;

use ApiPlatform\Doctrine\Orm\Filter\AbstractFilter;
use ApiPlatform\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use ApiPlatform\Metadata\Operation;
use Doctrine\ORM\QueryBuilder;

class DistinctFilter extends AbstractFilter
{
    protected function filterProperty(
        string $property,
        $value,
        QueryBuilder $queryBuilder,
        QueryNameGeneratorInterface $queryNameGenerator,
        string $resourceClass,
        ?Operation $operation = null,
        array $context = []
    ): void {
        if ($property !== 'distinct' || empty($value)) {
            return;
        }

        $queryBuilder->distinct(true);
        $queryBuilder->select("o.{$value}"); // Select the desired property
        $queryBuilder->where('o.' . $value . ' IS NOT null');
        $queryBuilder->orderBy("o.{$value}");
//        dd($queryBuilder->getQuery()->toIterable());
    }

    public function getDescription(string $resourceClass): array
    {
        return [
            'distinct' => [
                'property' => 'propertyName', // Define which property this filter applies to
                'type' => 'string',
                'required' => false,
                'swagger' => [
                    'description' => 'Get distinct values for the specified property',
                    'name' => 'Distinct Property Values',
                    'type' => 'string',
                ],
            ],
        ];
    }
}
