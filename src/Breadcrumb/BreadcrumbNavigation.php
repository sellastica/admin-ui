<?php
namespace Sellastica\AdminUI\Breadcrumb;

use Sellastica\AdminUI\Page\AdminPage;
use Sellastica\Http\Url;

class BreadcrumbNavigation
{
	/** @var array */
	protected $items = [];


	/**
	 * @param string $title
	 * @param Url|string $url
	 * @param \Sellastica\AdminUI\Page\AdminPage $adminPage
	 */
	public function add($title, $url = null, AdminPage $adminPage = null)
	{
		if (isset($url) && (!$url instanceof Url)) {
			$url = new Url($url);
		}

		$this->items[] = new BreadcrumbNavigationItem($title, $url, $adminPage);
	}

	/**
	 * @param string $title
	 * @param \Sellastica\Http\Url|string $url
	 * @param AdminPage $adminPage
	 */
	public function prepend($title, $url = null, AdminPage $adminPage = null)
	{
		if (!$url instanceof Url) {
			$url = new Url($url);
		}

		array_unshift($this->items, new BreadcrumbNavigationItem($title, $url, $adminPage));
	}

	/**
	 * @param \Sellastica\AdminUI\Page\AdminPage $adminPage
	 */
	public function addPage(AdminPage $adminPage)
	{
		$this->add($adminPage->getTitle(), $adminPage->getUrl(), $adminPage);
	}

	/**
	 * @return BreadcrumbNavigationItem[]
	 */
	public function getItems(): array
	{
		return $this->items;
	}
}