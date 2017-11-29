<?php
namespace Sellastica\AdminUI\User\Entity;

use Sellastica\Entity\Entity\EntityFactory;
use Sellastica\Entity\Entity\IEntity;
use Sellastica\Entity\IBuilder;

/**
 * @method AdminUser build(IBuilder $builder, bool $initialize = true, int $assignedId = null)
 */
class AdminUserFactory extends EntityFactory
{
	/**
	 * @param \Sellastica\Entity\Entity\IEntity $entity
	 */
	public function doInitialize(IEntity $entity)
	{
	}

	/**
	 * @return string
	 */
	public function getEntityClass(): string
	{
		return AdminUser::class;
	}
}