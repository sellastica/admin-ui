<?php
namespace Sellastica\AdminUI\User\Model;

use Nette;
use Sellastica\AdminUI\Page\AdminPage;
use Sellastica\AdminUI\User\Entity\AdminUser;

class AclManager
{
	/** @var AdminUser */
	private $adminUser;
	/** @var AdminPage */
	private $adminPage;
	/** @var Nette\Security\User */
	private $user;


	/**
	 * @param AdminPage $adminPage
	 * @param Nette\Security\User $user
	 * @param AdminUserAccessor $adminUserAccessor
	 */
	public function __construct(
		AdminPage $adminPage,
		Nette\Security\User $user,
		AdminUserAccessor $adminUserAccessor
	)
	{
		$this->adminPage = $adminPage;
		$this->user = $user;
		$this->adminUser = $adminUserAccessor->get();
		$this->logoutIfAdminUserDoesNotExist();
	}

	/**
	 * User is logged in, but account is deleted
	 */
	private function logoutIfAdminUserDoesNotExist()
	{
		if ($this->user->isLoggedIn() && !$this->adminUser) {
			$this->user->logout(true);
		}
	}

	/**
	 * @return bool
	 */
	public function needsAuthenticate(): bool
	{
		if ($this->adminPage->needsPermissions()) {
			return !$this->user->isLoggedIn();
		}

		return false;
	}

	/**
	 * @return bool
	 */
	public function arePermissions(): bool
	{
		if ($this->adminUser) {
			if (!$this->adminUser->isVisible()) {
				return false;
			} elseif (!$this->adminUser->hasPermissionsToPresenter($this->adminPage->getPresenter())) {
				return false;
			} elseif ($this->adminUser->isBanned()) {
				return false;
			}
		} else {
			if ($this->adminPage->getRole()) {
				return false;
			}
		}

		return true;
	}
}
