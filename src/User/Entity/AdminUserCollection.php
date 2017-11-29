<?php
namespace Sellastica\AdminUI\User\Entity;

use Sellastica\Entity\Entity\EntityCollection;

/**
 * @property AdminUser[] $items
 * @method AdminUserCollection add($entity)
 * @method AdminUserCollection remove($key)
 * @method AdminUser|mixed getEntity(int $entityId, $default = null)
 * @method AdminUser|mixed getBy(string $property, $value, $default = null)
 */
class AdminUserCollection extends EntityCollection
{
}