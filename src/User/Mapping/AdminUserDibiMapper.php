<?php
namespace Sellastica\AdminUI\User\Mapping;

use Sellastica\Api\Mapping\TApiDibiMapper;
use Sellastica\Entity\Mapping\DibiMapper;

class AdminUserDibiMapper extends DibiMapper
{
	use TApiDibiMapper;

	/**
	 * @param string $hashId
	 * @return int|false
	 */
	public function findOneByHashId($hashId)
	{
		return $this->getResourceWithIds()
			->where('SHA1(CONCAT(email, id)) = %s', $hashId)
			->fetchSingle();
	}

	/**
	 * Check if exists user with $email, but not with $adminUserId
	 * @param string $email
	 * @param int $adminUserId
	 * @return bool
	 */
	public function existsAnotherUser(string $email, int $adminUserId = null)
	{
		$resource = $this->getResource()
			->select(false)
			->select(1)
			->where('email = %s', $email);

		if (isset($adminUserId)) {
			$resource->where('id != %i', $adminUserId);
		}

		return (bool)$resource->fetchSingle();
	}
}