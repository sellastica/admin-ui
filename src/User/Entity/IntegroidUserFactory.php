<?php
namespace Sellastica\AdminUI\User\Entity;

use Sellastica\Entity\IBuilder;
use Sellastica\Entity\Entity\IEntity;
use Sellastica\Entity\Entity\EntityFactory;

/**
 * @method IntegroidUser build(IBuilder $builder, bool $initialize = true, int $assignedId = null)
 * @see IntegroidUser
 */
class IntegroidUserFactory extends EntityFactory
{
	/**
	 * @param IEntity|IntegroidUser $entity
	 */
	public function doInitialize(IEntity $entity)
	{
		$entity->setRelationService(new \Sellastica\AdminUI\User\Entity\AdminUserRelations($entity, $this->em));
	}

	/**
	 * @return string
	 */
	public function getEntityClass(): string
	{
		return IntegroidUser::class;
	}
}