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
        $alias = $queryBuilder->getRootAliases()[0];

        if ($property === 'disorliked') {
            $queryBuilder
                ->andWhere($alias.'.id NOT IN
                    ('.
                        $queryBuilder->getEntityManager()->createQueryBuilder()
                        ->select('m.id')
                        ->from('App\Entity\Meal', 'm')
                        ->leftJoin('m.userDislike', 'd')
                        ->andWhere('d.id = :user')
                        ->setParameter('user', $value)
                        ->getDQL()
                    .')')
                ->andWhere(
                    $alias.'.id NOT IN
                    ('.
                    $queryBuilder->getEntityManager()->createQueryBuilder()
                        ->select('m2.id')
                        ->from('App\Entity\Meal', 'm2')
                        ->leftJoin('m2.userLike', 'l')
                        ->andWhere('l.id = :user')
                        ->setParameter('user', $value)
                        ->getDQL()
                    .')'

                )
                ->setParameter('user', $value);
        }

        if($property === "id")
        {
            $queryBuilder
                ->andWhere($alias.'.id = :id')
                ->setParameter('id', $value);
        }


    }

    public function getDescription(string $resourceClass): array
    {
        return [
            'disorliked' => [
                'property' => null,
                'type' => Type::BUILTIN_TYPE_INT,
                'required' => false
            ],
            'id' => [
                'property' => null,
                'type' => Type::BUILTIN_TYPE_INT,
                'required' => false
            ]
        ];
    }
}
