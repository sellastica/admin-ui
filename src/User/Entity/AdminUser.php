<?php
namespace Sellastica\AdminUI\User\Entity;

use Sellastica\AdminUI\Presentation\AuthorProxy;
use Sellastica\AdminUI\User\Model\AdminUserRole;
use Sellastica\Api\Model\IPayloadable;
use Sellastica\Entity\Entity\TAbstractEntity;
use Sellastica\Identity\Model\Identity;
use Sellastica\Identity\Model\IIdentity;
use Sellastica\Identity\Model\InvalidLogin;
use Sellastica\Twig\Model\IProxable;
use Sellastica\Twig\Model\ProxyConverter;

/**
 * @generate-builder
 * @see AdminUserBuilder
 *
 * @property AdminUserRelations $relationService
 */
class AdminUser extends Identity implements IIdentity, IProxable, IPayloadable
{
	use TAbstractEntity;

	/** @var string|null @optional */
	protected $bio;
	/** @var string|null @optional */
	protected $homepage;
	/** @var AdminUserRole @required */
	protected $role;
	/** @var array @optional */
	protected $permissions = [];
	/** @var bool @optional */
	protected $visible = true;


	/**
	 * @param AdminUserBuilder $builder
	 */
	public function __construct(AdminUserBuilder $builder)
	{
		$this->hydrate($builder);
		$this->invalidLogin = $this->invalidLogin ?? new InvalidLogin();
	}

	/**
	 * @return string|null
	 */
	public function getBio(): ?string
	{
		return $this->bio;
	}

	/**
	 * @param null|string $bio
	 */
	protected function setBio(?string $bio)
	{
		$this->bio = $bio;
	}

	/**
	 * @return string|null
	 */
	public function getHomepage()
	{
		return $this->homepage;
	}

	/**
	 * @param null|string $homepage
	 */
	protected function setHomepage($homepage)
	{
		$this->homepage = $homepage;
	}

	/**
	 * @return bool
	 */
	public function isInvited(): bool
	{
		return $this->password === null;
	}

	/**
	 * @return AdminUserRole
	 */
	public function getRole(): AdminUserRole
	{
		return $this->role;
	}

	/**
	 * @param AdminUserRole $role
	 */
	public function setRole(AdminUserRole $role)
	{
		$this->role = $role;
	}

	/**
	 * @return bool
	 */
	public function isVisible(): bool
	{
		return $this->visible;
	}

	public function activate(): void
	{
		$this->visible = true;
	}

	public function deactivate(): void
	{
		$this->visible = false;
	}

	/**
	 * @param string $scope
	 * @return bool
	 */
	public function hasPermissionsTo(string $scope): bool
	{
		return $this->role->isSuperAdministrator()
			|| $this->role->isAdministrator()
			|| !empty($this->permissions[$scope]);
	}

	/**
	 * @return array
	 */
	public function getPermissions(): array
	{
		return $this->permissions;
	}

	/**
	 * @param array $permissions
	 */
	public function setPermissions(array $permissions)
	{
		$this->permissions = $permissions;
	}

	/**
	 * @param string $presenter
	 * @return bool
	 */
	public function hasPermissionsToPresenter(string $presenter): bool
	{
		return $this->user->isAllowed($presenter);
	}

	/**
	 * @return bool
	 */
	public function hasNoPermissions(): bool
	{
		return !$this->role->isSuperAdministrator()
			&& !$this->role->isAdministrator()
			&& !sizeof(array_filter($this->getPermissions()));
	}

	/**
	 * @return null|\Sellastica\Project\Entity\Project
	 */
	public function getProject(): ?\Sellastica\Project\Entity\Project
	{
		return $this->relationService->getProject();
	}

	/**
	 * @return array
	 */
	public function toArray(): array
	{
		return array_merge(
			$this->parentToArray(),
			[
				'bio' => $this->bio,
				'homepage' => $this->homepage,
				'role' => $this->role->getRole(),
				'visible' => $this->visible,
				'permissions' => json_encode($this->permissions),
			]
		);
	}

	/**
	 * @return \Sellastica\AdminUI\Presentation\AuthorProxy
	 */
	public function toProxy(): AuthorProxy
	{
		return ProxyConverter::convert($this, AuthorProxy::class);
	}

	/**
	 * @return \Api\Payload\Account
	 */
	public function toPayloadObject(): \Api\Payload\Account
	{
		return new \Api\Payload\Account($this);
	}
}