<?php
namespace Sellastica\AdminUI\Breadcrumb;

use Sellastica\AdminUI\Page\AdminPage;
use Sellastica\Http\Url;

class BreadcrumbNavigationItem
{
	/** @var string */
	private $title;
	/** @var Url|null */
	private $url;
	/** @var AdminPage|null */
	private $adminPage;


	/**
	 * @param string $title
	 * @param Url $url
	 * @param AdminPage $adminPage
	 */
	public function __construct($title, Url $url = null, AdminPage $adminPage = null)
	{
		$this->title = $title;
		$this->url = $url;
		$this->adminPage = $adminPage;
	}

	/**
	 * @return string
	 */
	public function getTitle(): string
	{
		return $this->title;
	}

	/**
	 * @return Url|null
	 */
	public function getUrl(): ?Url
	{
		return $this->url;
	}

	/**
	 * @return AdminPage|null
	 */
	public function getAdminPage(): ?AdminPage
	{
		return $this->adminPage;
	}
}