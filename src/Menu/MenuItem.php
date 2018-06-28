<?php
namespace Sellastica\AdminUI\Menu;

use Sellastica\AdminUI\Page\AdminPage;
use Sellastica\Http\Url;

class MenuItem
{
	/** @var string */
	private $title;
	/** @var string|null */
	private $description;
	/** @var Url */
	private $url;
	/** @var string|null */
	private $icon;
	/** @var string|null */
	private $scope;
	/** @var bool */
	private $active;
	/** @var array|MenuItem[] */
	private $subitems = [];
	/** @var \Sellastica\App\Entity\App|null */
	private $app;


	/**
	 * @param string $title
	 * @param Url $url
	 * @param string $icon
	 * @param string|null $scope
	 * @param bool $active
	 */
	public function __construct(
		string $title,
		Url $url,
		string $icon = null,
		string $scope = null,
		bool $active = false
	)
	{
		$this->title = $title;
		$this->url = $url;
		$this->icon = $icon;
		$this->scope = $scope;
		$this->active = $active;
	}

	/**
	 * @return string
	 */
	public function getTitle(): string
	{
		return $this->title;
	}

	/**
	 * @return Url
	 */
	public function getUrl(): Url
	{
		return $this->url;
	}

	/**
	 * @return bool
	 */
	public function isActive(): bool
	{
		return $this->active;
	}

	public function activate(): void
	{
		$this->active = true;
	}

	/**
	 * @return string|null
	 */
	public function getIcon(): ?string
	{
		return $this->icon;
	}

	/**
	 * @return string|null
	 */
	public function getScope(): ?string
	{
		return $this->scope;
	}

	/**
	 * @param MenuItem $item
	 */
	public function addSubitem(MenuItem $item)
	{
		$this->subitems[] = $item;
	}

	/**
	 * @return bool
	 */
	public function hasSubitems(): bool
	{
		return !empty($this->subitems);
	}

	/**
	 * @return MenuItem[]
	 */
	public function getSubitems(): array
	{
		return $this->subitems;
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
	 * @return null|\Sellastica\App\Entity\App
	 */
	public function getApp(): ?\Sellastica\App\Entity\App
	{
		return $this->app;
	}

	/**
	 * @param null|\Sellastica\App\Entity\App $app
	 */
	public function setApp(?\Sellastica\App\Entity\App $app): void
	{
		$this->app = $app;
	}

	/**
	 * @param AdminPage $page
	 * @return MenuItem
	 */
	public static function fromAdminPage(AdminPage $page)
	{
		$item = new self($page->getTitle(), $page->getUrl(), $page->getIcon(), $page->getScope());
		$item->setDescription($page->getDescription());

		return $item;
	}
}