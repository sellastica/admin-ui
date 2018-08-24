<?php
namespace Sellastica\AdminUI\User\Mapping;

/**
 * @see \Sellastica\AdminUI\User\Entity\IntegroidUser
 * @property IntegroidUserDibiMapper $mapper
 */
class IntegroidUserDao extends \Sellastica\Entity\Mapping\Dao
{
	use \Sellastica\DataGrid\Mapping\Dibi\TFilterRulesDao;

	/**
	 * @inheritDoc
	 */
	protected function getBuilder(
		$data,
		$first = null,
		$second = null
	): \Sellastica\Entity\IBuilder
	{
		$role = new \Sellastica\AdminUI\User\Model\AdminUserRole($data->role);
		$contact = new \Sellastica\Identity\Model\Contact($data->firstName, $data->lastName, new \Sellastica\Identity\Model\Email($data->email), $data->phone);
		$data->password = new \Sellastica\Identity\Model\Password($data->password);
		$invalidLogin = new \Sellastica\Identity\Model\InvalidLogin($data->lastInvalidLogin, $data->invalidLoginCount);
		$data->permissions = (array)json_decode($data->permissions);
		return \Sellastica\AdminUI\User\Entity\IntegroidUserBuilder::create($role, $contact)
			->invalidLogin($invalidLogin)
			->hydrate($data);
	}

	/**
	 * @return \Sellastica\AdminUI\User\Entity\IntegroidUserCollection
	 */
	public function getEmptyCollection(): \Sellastica\Entity\Entity\EntityCollection
	{
		return new \Sellastica\AdminUI\User\Entity\IntegroidUserCollection;
	}
}