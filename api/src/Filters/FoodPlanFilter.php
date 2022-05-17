<?php
/**
 * @file
 * @category
 * @author   Yoan Wache <y.wache@lemon-interactive.fr>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link
 */

namespace App\Filters;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\AbstractFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\PropertyInfo\Type;

class FoodPlanFilter extends AbstractFilter
{

    protected function filterProperty(string $property, $value, QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null)
    {
        if($property !== 'userId') {
            return;
        }

        $rootAlias = $queryBuilder->getRootAliases()[0];
        $queryBuilder->andWhere(sprintf('%s.user = :value', $rootAlias));
        $queryBuilder->setParameter('value', $value);

    }

    public function getDescription(string $resourceClass): array
    {
        return [
            'userId' => [
                'property' => null,
                'type' => Type::BUILTIN_TYPE_INT,
                'required' => false
            ]
        ];
    }
}
