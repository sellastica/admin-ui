<?php
namespace Sellastica\AdminUI\Menu;

use Sellastica\AdminUI\Page\AdminPage;
use Sellastica\Http\Url;

class MenuItem
{
	/** @var string */
	private $title;
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
	 * @param AdminPage $page
	 * @return MenuItem
	 */
	public static function fromAdminPage(AdminPage $page)
	{
		return new self(
			$page->getTitle(), $page->getUrl(), $page->getIcon(), $page->getScope()
		);
	}
}