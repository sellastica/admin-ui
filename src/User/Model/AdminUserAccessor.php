<?php
namespace Sellastica\AdminUI\User\Model;

use Nette;
use Sellastica\AdminUI\User\Entity\AdminUser;
use Sellastica\Core\Model\FactoryAccessor;
use Sellastica\Entity\EntityManager;

class AdminUserAccessor extends FactoryAccessor
{
	/** @var Nette\Security\User */
	private $user;
	/** @var Authorizator */
	private $authorizator;
	/** @var EntityManager */
	private $em;


	/**
	 * @param Nette\Security\User $user
	 * @param Authorizator $authorizator
	 * @param EntityManager $em
	 */
	public function __construct(
		Nette\Security\User $user,
		Authorizator $authorizator,
		EntityManager $em
	)
	{
		$this->user = $user;
		$this->authorizator = $authorizator;
		$this->em = $em;
	}

	/**
	 * @return AdminUser|null
	 */
	public function create()
	{
		if (!$this->user->getId() || $this->user->getStorage()->getNamespace() !== 'admin') {
			return null;
		}

		return $this->getAdminUser();
	}

	/**
	 * @return AdminUser|null
	 */
	public function createForFrontend(): ?AdminUser
	{
		$currentStorageNamespace = $this->user->getStorage()->getNamespace();
		$this->user->getStorage()->setNamespace('admin');
		$adminUser = $this->getAdminUser();
		$adminUser = (isset($adminUser) && $adminUser->isLoggedIn()) ? $adminUser : null;
		$this->user->getStorage()->setNamespace($currentStorageNamespace);
		return $adminUser;
	}

	/**
	 * @return AdminUser|null
	 */
	private function getAdminUser(): ?AdminUser
	{
		$adminUser = $this->em->getRepository(AdminUser::class)->find($this->user->getId());
		if (isset($adminUser)) {
			$this->authorizator->allowResources($adminUser);
			$this->user->setAuthorizator($this->authorizator);
			$adminUser->setUser($this->user);
		}

		return $adminUser;
	}
}