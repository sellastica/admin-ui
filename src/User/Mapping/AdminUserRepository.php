<?php
namespace App\Model\Facades;

use Sellastica\Api\Mapping\TApiRepository;
use Sellastica\AdminUI\User\Entity\IAdminUserRepository;
use Sellastica\Entity\Mapping\Repository;

/**
 * @property \Sellastica\AdminUI\User\Mapping\AdminUserDao $dao
 */
class AdminUserRepository extends Repository implements IAdminUserRepository
{
	use TApiRepository;

	/**
	 * @param string $email
	 * @param int $adminUserId
	 * @return bool
	 */
	public function existsAnotherUser(string $email, int $adminUserId = null): bool
	{
		return $this->dao->existsAnotherUser($email, $adminUserId);
	}
}