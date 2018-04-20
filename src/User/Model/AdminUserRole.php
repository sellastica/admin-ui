<?php
namespace Sellastica\AdminUI\User\Model;

class AdminUserRole
{
	/** @var array */
	private static $roles = [
		self::SUPER_ADMINISTRATOR => 'admin.accounts.super_administrator',
		self::ADMINISTRATOR => 'admin.accounts.administrator',
		self::STANDARD_USER => 'admin.accounts.standard_user',
	];

	const SUPER_ADMINISTRATOR = 'super_administrator',
		ADMINISTRATOR = 'administrator',
		STANDARD_USER = 'standard_user',
		GUEST = 'guest';

	/** @var string */
	private $role;
	/** @var string */
	private $title;


	/**
	 * @param string $role
	 * @throws \InvalidArgumentException
	 */
	public function __construct(string $role)
	{
		if (!self::isRole($role)) {
			throw new \InvalidArgumentException(sprintf('Unknown role %s', $role));
		}

		$this->role = $role;
		$this->title = self::$roles[$role];
	}

	/**
	 * @return string
	 */
	public function getRole(): string
	{
		return $this->role;
	}

	/**
	 * @return string
	 */
	public function getTitle(): string
	{
		return $this->title;
	}

	/**
	 * @return bool
	 */
	public function isSuperAdministrator(): bool
	{
		return $this->role === self::SUPER_ADMINISTRATOR;
	}

	/**
	 * @return bool
	 */
	public function isAdministrator(): bool
	{
		return $this->role === self::ADMINISTRATOR;
	}

	/**
	 * @return bool
	 */
	public function isStandardUser(): bool
	{
		return $this->role === self::STANDARD_USER;
	}

	/**
	 * @param string $role
	 * @return bool
	 */
	public static function isRole(string $role): bool
	{
		return in_array($role, array_keys(self::$roles));
	}
}