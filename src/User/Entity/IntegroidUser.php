<?php
namespace Sellastica\AdminUI\User\Entity;

/**
 * @generate-builder
 * @see IntegroidUserBuilder
 */
class IntegroidUser extends \Sellastica\AdminUI\User\Entity\AdminUser
{
	use \Sellastica\Entity\Entity\TAbstractEntity;

	/**
	 * @param IntegroidUserBuilder $builder
	 */
	public function __construct(IntegroidUserBuilder $builder)
	{
		$this->hydrate($builder);
		$this->invalidLogin = $this->invalidLogin ?? new \Sellastica\Identity\Model\InvalidLogin();
	}
}