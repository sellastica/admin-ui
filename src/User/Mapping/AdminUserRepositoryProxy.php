<?php
namespace Sellastica\AdminUI\User\Mapping;

use Sellastica\Api\Mapping\TApiRepositoryProxy;
use App\Model\Facades;
use Sellastica\AdminUI\User\Entity\IAdminUserRepository;
use Sellastica\Entity\Mapping\RepositoryProxy;

/**
 * @method Facades\AdminUserRepository getRepository()
 */
class AdminUserRepositoryProxy extends RepositoryProxy implements IAdminUserRepository
{
	use TApiRepositoryProxy;

	public function existsAnotherUser(string $email, int $adminUserId = null): bool
	{
		return $this->getRepository()->existsAnotherUser($email, $adminUserId);
	}
}
