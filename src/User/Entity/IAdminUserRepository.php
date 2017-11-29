<?php
namespace Sellastica\AdminUI\User\Entity;

use Sellastica\Entity\Configuration;
use Sellastica\Entity\Mapping\IRepository;

/**
 * @method AdminUser find(int $id)
 * @method AdminUser findOneBy(array $filterValues)
 * @method AdminUser[] findAll(Configuration $configuration = null)
 * @method AdminUser[] findBy(array $filterValues, Configuration $configuration = null)
 * @method AdminUser[] findByIds(array $idsArray, Configuration $configuration = null)
 * @method AdminUser findPublishable(int $id)
 * @method AdminUser findOnePublishableBy(array $filterValues, Configuration $configuration = null)
 * @method AdminUser[] findAllPublishable(Configuration $configuration = null)
 * @method AdminUser[] findPublishableBy(array $filterValues, Configuration $configuration = null)
 */
interface IAdminUserRepository extends IRepository
{
	/**
	 * @param string $email
	 * @param int $adminUserId
	 * @return bool
	 */
	function existsAnotherUser(string $email, int $adminUserId = null): bool;
}
