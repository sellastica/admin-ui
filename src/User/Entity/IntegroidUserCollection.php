<?php
namespace Sellastica\AdminUI\User\Entity;

use Sellastica\Entity\Entity\EntityCollection;

/**
 * @property IntegroidUser[] $items
 * @method IntegroidUserCollection add($entity)
 * @method IntegroidUserCollection remove($key)
 * @method IntegroidUser|mixed getEntity(int $entityId, $default = null)
 * @method IntegroidUser|mixed getBy(string $property, $value, $default = null)
 */
class IntegroidUserCollection extends EntityCollection
{
}