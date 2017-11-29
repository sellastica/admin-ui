<?php
namespace Sellastica\AdminUI\Breadcrumb;

use Nette\Application\UI\ITemplate;
use Sellastica\AdminUI\Page\AdminPage;

/**
 * @property ITemplate $template
 */
trait TBreadcrumbNavigation
{
	/** @var \Sellastica\AdminUI\Breadcrumb\BreadcrumbNavigationFactory @inject */
	public $breadcrumbNavigationFactory;
	/** @var \Sellastica\AdminUI\Breadcrumb\BreadcrumbNavigation */
	protected $breadcrumbNavigation;


	/**
	 * @param \Sellastica\AdminUI\Page\AdminPage $adminPage
	 */
	private function createBreadcrumbNavigation(AdminPage $adminPage)
	{
		$this->breadcrumbNavigation = $this->template->breadcrumbNavigation
			= $this->breadcrumbNavigationFactory->fromAdminPage($adminPage);
	}
}
