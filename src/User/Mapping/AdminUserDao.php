<?php
namespace Sellastica\AdminUI\User\Mapping;

use Sellastica\AdminUI\User\Entity\AdminUserBuilder;
use Sellastica\AdminUI\User\Entity\AdminUserCollection;
use Sellastica\AdminUI\User\Model\AdminUserRole;
use Sellastica\Api\Mapping\TApiDao;
use Sellastica\Entity\Entity\EntityCollection;
use Sellastica\Entity\IBuilder;
use Sellastica\Entity\Mapping\Dao;
use Sellastica\Identity\Model\Contact;
use Sellastica\Identity\Model\Email;
use Sellastica\Identity\Model\InvalidLogin;
use Sellastica\Identity\Model\Password;

/**
 * @property \Sellastica\AdminUI\User\Mapping\AdminUserDibiMapper $mapper
 */
class AdminUserDao extends Dao
{
	use TApiDao;

	/**
	 * @param string $hashId
	 * @return \Sellastica\AdminUI\User\Entity\AdminUser|\Sellastica\Entity\Entity\IEntity
	 */
	public function findOneByHashId($hashId)
	{
		$adminUserId = $this->mapper->findOneByHashId($hashId);
		return $this->find($adminUserId);
	}

	/**
	 * @param string $email
	 * @param int $adminUserId
	 * @return bool
	 */
	public function existsAnotherUser($email, $adminUserId = null)
	{
		return $this->mapper->existsAnotherUser($email, $adminUserId);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function getBuilder($data, $first = null, $second = null): IBuilder
	{
		$role = new AdminUserRole($data->role);
		$contact = new Contact($data->firstName, $data->lastName, new Email($data->email), $data->phone);
		$data->password = new Password($data->password);
		$invalidLogin = new InvalidLogin($data->lastInvalidLogin, $data->invalidLoginCount);
		$data->permissions = isset($data->permissions)
			? \Nette\Utils\Json::decode($data->permissions, \Nette\Utils\Json::FORCE_ARRAY)
			: [];
		$data->closedHelps = isset($data->closedHelps)
			? \Nette\Utils\Json::decode($data->closedHelps, \Nette\Utils\Json::FORCE_ARRAY)
			: [];

		return AdminUserBuilder::create($role, $contact)
			->invalidLogin($invalidLogin)
			->hydrate($data);
	}

	/**
	 * @return \Sellastica\Entity\Entity\EntityCollection|AdminUserCollection
	 */
	public function getEmptyCollection(): EntityCollection
	{
		return new AdminUserCollection();
	}
}