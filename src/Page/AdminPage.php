<?php
namespace Sellastica\AdminUI\Page;

use Nette\Utils\Html;
use Sellastica\AdminUI\User\Model\AdminUserRole;
use Sellastica\Http\Url;

class AdminPage
{
	/** @var string */
	private $title;
	/** @var string|null */
	private $subtitle;
	/** @var string|null */
	private $description;
	/** @var Html|null */
	private $html;
	/** @var Url */
	private $url;
	/** @var string|null */
	private $icon;
	/** @var AdminPage|null */
	private $parent;
	/** @var \Sellastica\AdminUI\User\Model\AdminUserRole */
	private $role;
	/** @var string|null */
	private $scope;
	/** @var string */
	private $presenter;
	/** @var string|null */
	private $module;
	/** @var bool */
	private $b2b;
	/** @var null|\Sellastica\App\Entity\App */
	private $app;
	/** @var bool */
	private $inBreadcrumb = true;


	/**
	 * @param string $presenter
	 * @param string $title
	 * @param \Sellastica\Http\Url $url
	 * @param string|null $scope
	 * @param AdminUserRole $role
	 * @param \Sellastica\App\Entity\App|null $app
	 */
	public function __construct(
		string $presenter,
		string $title,
		Url $url,
		string $scope = null,
		AdminUserRole $role = null,
		\Sellastica\App\Entity\App $app = null
	)
	{
		$this->presenter = $presenter;
		$this->title = $title;
		$this->url = $url;
		$this->scope = $scope;
		$this->role = $role;
		$this->app = $app;
	}

	/**
	 * @return string
	 */
	public function getPresenter(): string
	{
		return $this->presenter;
	}

	/**
	 * @return string
	 */
	public function getTitle(): string
	{
		return $this->title;
	}

	/**
	 * @param string $title
	 */
	public function setTitle(string $title)
	{
		$this->title = $title;
	}

	/**
	 * @return null|string
	 */
	public function getSubtitle(): ?string
	{
		return $this->subtitle;
	}

	/**
	 * @param null|string $subtitle
	 */
	public function setSubtitle(?string $subtitle)
	{
		$this->subtitle = $subtitle;
	}

	/**
	 * @return null|string
	 */
	public function getDescription(): ?string
	{
		return $this->description;
	}

	/**
	 * @param null|string $description
	 */
	public function setDescription(?string $description): void
	{
		$this->description = $description;
	}

	/**
	 * @return null|Html
	 */
	public function getHtml(): ?Html
	{
		return $this->html;
	}

	/**
	 * @param null|Html $html
	 */
	public function setHtml(?Html $html)
	{
		$this->html = $html;
	}

	/**
	 * @return Url
	 */
	public function getUrl(): Url
	{
		return $this->url;
	}

	/**
	 * @return string|null
	 */
	public function getIcon(): ?string
	{
		return $this->icon;
	}

	/**
	 * @param null|string $icon
	 */
	public function setIcon(?string $icon)
	{
		$this->icon = $icon;
	}

	/**
	 * @return string|null
	 */
	public function getScope(): ?string
	{
		return $this->scope;
	}

	/**
	 * @return \Sellastica\AdminUI\User\Model\AdminUserRole|null
	 */
	public function getRole(): ?AdminUserRole
	{
		return $this->role;
	}

	/**
	 * @return bool
	 */
	public function needsPermissions(): bool
	{
		return $this->role && ($this->role->isAdministrator() || $this->role->isStandardUser());
	}

	/**
	 * @return AdminPage|null
	 */
	public function getParent(): ?AdminPage
	{
		return $this->parent;
	}

	/**
	 * @param AdminPage|null $parent
	 */
	public function setParent(?AdminPage $parent)
	{
		$this->parent = $parent;
	}

	/**
	 * @return null|string
	 */
	public function getModule(): ?string
	{
		return $this->module;
	}

	/**
	 * @param null|string $module
	 */
	public function setModule(?string $module)
	{
		$this->module = $module;
	}

	/**
	 * @return bool
	 */
	public function isB2b(): bool
	{
		return $this->b2b;
	}

	/**
	 * @param bool $b2b
	 */
	public function setB2b(bool $b2b)
	{
		$this->b2b = $b2b;
	}

	/**
	 * @return null|\Sellastica\App\Entity\App
	 */
	public function getApp(): ?\Sellastica\App\Entity\App
	{
		return $this->app;
	}

	/**
	 * @return bool
	 */
	public function isInBreadcrumb(): bool
	{
		return $this->inBreadcrumb;
	}

	/**
	 * @param bool $inBreadcrumb
	 */
	public function setInBreadcrumb(bool $inBreadcrumb): void
	{
		$this->inBreadcrumb = $inBreadcrumb;
	}
}