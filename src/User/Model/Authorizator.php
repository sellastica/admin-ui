<?php
namespace Sellastica\AdminUI\User\Model;

use Admin\Model\AdminPageFactory;
use Nette;
use Nette\Security\Permission;
use Sellastica\AdminUI\User\Entity\AdminUser;

class Authorizator extends Permission implements Nette\Security\IAuthorizator
{
	const GUEST = 'guest';


	public function __construct()
	{
		//roles
		$this->addRole(self::GUEST);
		$this->addRole(AdminUserRole::STANDARD_USER);
		$this->addRole(AdminUserRole::ADMINISTRATOR);
		$this->addRole(AdminUserRole::SUPER_ADMINISTRATOR);
		//resources
		foreach (AdminPageFactory::getAllPageSettings() as $presenter => $pageSetting) {
			//detail page
			$this->addResource($presenter);
			if ($pageSetting['role'] === Permission::ALL) {
				$this->allow($pageSetting['role'], $presenter);
			}

			//list page
			$this->addResource($resource = $this->getListResource($presenter), $presenter);
			if ($pageSetting['role'] === Permission::ALL) {
				$this->allow($pageSetting['role'], $resource);
			}
		}

		//all permissions allowed to administrator
		$this->allow(AdminUserRole::ADMINISTRATOR);
		$this->allow(AdminUserRole::SUPER_ADMINISTRATOR);
	}

	/**
	 * @param string $presenter
	 * @return string
	 */
	private function getListResource(string $presenter): string
	{
		return $presenter . 'List';
	}

	/**
	 * @param AdminUser $adminUser
	 */
	public function allowResources(AdminUser $adminUser)
	{
		//administrator has all privilleges by default
		if ($adminUser->getRole()->isSuperAdministrator()
			|| $adminUser->getRole()->isAdministrator()) {
			return;
		}

		foreach (AdminPageFactory::getAllPageSettings() as $presenter => $pageSetting) {
			if (!isset($pageSetting['scope'])
				|| $adminUser->hasPermissionsTo($pageSetting['scope'])
			) {
				$this->allow($adminUser->getRole()->getRole(), $presenter);
			}
		}
	}
}
