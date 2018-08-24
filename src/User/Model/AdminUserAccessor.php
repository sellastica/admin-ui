<?php
namespace Sellastica\AdminUI\User\Model;

/**
 * @method \Sellastica\AdminUI\User\Entity\AdminUser get
 */
class AdminUserAccessor extends \Sellastica\Core\Model\FactoryAccessor
{
	/** @var \Nette\Security\User */
	private $user;
	/** @var Authorizator */
	private $authorizator;
	/** @var \Sellastica\Entity\EntityManager */
	private $em;


	/**
	 * @param \Nette\Security\User $user
	 * @param Authorizator $authorizator
	 * @param \Sellastica\Entity\EntityManager $em
	 */
	public function __construct(
		\Nette\Security\User $user,
		Authorizator $authorizator,
		\Sellastica\Entity\EntityManager $em
	)
	{
		$this->user = $user;
		$this->authorizator = $authorizator;
		$this->em = $em;
	}

	/**
	 * @return \Sellastica\AdminUI\User\Entity\AdminUser|null
	 */
	public function create(): ?\Sellastica\AdminUI\User\Entity\AdminUser
	{
		if (!$this->user->getId() || $this->user->getStorage()->getNamespace() !== 'admin') {
			return null;
		}

		return $this->getAdminUser();
	}

	/**
	 * @return \Sellastica\AdminUI\User\Entity\AdminUser|null
	 */
	public function createForFrontend(): ?\Sellastica\AdminUI\User\Entity\AdminUser
	{
		$currentStorageNamespace = $this->user->getStorage()->getNamespace();
		$this->user->getStorage()->setNamespace('admin');
		$adminUser = $this->getAdminUser();
		$adminUser = (isset($adminUser) && $adminUser->isLoggedIn()) ? $adminUser : null;
		$this->user->getStorage()->setNamespace($currentStorageNamespace);
		return $adminUser;
	}

	/**
	 * @return \Sellastica\AdminUI\User\Entity\AdminUser|null
	 */
	private function getAdminUser(): ?\Sellastica\AdminUI\User\Entity\AdminUser
	{
		$adminUser = $this->em->getRepository(\Sellastica\AdminUI\User\Entity\AdminUser::class)->find($this->user->getId());
		if (isset($adminUser)) {
			$this->authorizator->allowResources($adminUser);
			$this->user->setAuthorizator($this->authorizator);
			$adminUser->setUser($this->user);
		}

		return $adminUser;
	}
}