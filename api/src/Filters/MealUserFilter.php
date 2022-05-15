<?php
/**
 * @file
 * @category
 * @author   Yoan Wache <y.wache@lemon-interactive.fr>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link
 */

namespace App\Filters;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\AbstractContextAwareFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\PropertyInfo\Type;

class MealUserFilter extends AbstractContextAwareFilter
{

    protected function filterProperty(string $property, $value, QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null)
    {
        if ($property === 'disorliked') {

            $alias = $queryBuilder->getRootAliases()[0];
            $queryBuilder->leftJoin($alias . '.userLike', 'ul')
                ->leftJoin($alias . '.userDislike', 'ud')
                ->andWhere('ul.id != :valueParameter')
                ->andWhere('ud.id != :valueParameter')
                ->orWhere($queryBuilder->expr()->andX(
                    $queryBuilder->expr()->isNull('ul.id'),
                    $queryBuilder->expr()->isNull('ud.id')
                ))
                ->setParameter("valueParameter", $value);

        }



    }

    public function getDescription(string $resourceClass): array
    {
        return [
            'disorliked' => [
                'property' => null,
                'type' => Type::BUILTIN_TYPE_INT,
                'required' => false
            ]
        ];
    }
}
