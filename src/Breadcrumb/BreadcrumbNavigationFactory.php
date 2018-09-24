<?php
namespace Sellastica\AdminUI\Breadcrumb;

use Nette\Localization\ITranslator;
use Sellastica\AdminUI\Page\AbstractAdminPageFactory;
use Sellastica\AdminUI\Page\AdminPage;
use Sellastica\LinkFactory\LinkFactory;

class BreadcrumbNavigationFactory
{
	/** @var ITranslator */
	private $translator;
	/** @var LinkFactory */
	private $linkFactory;
	/** @var AbstractAdminPageFactory */
	private $adminPageFactory;


	/**
	 * @param ITranslator $translator
	 * @param LinkFactory $linkFactory
	 * @param AbstractAdminPageFactory $adminPageFactory
	 */
	public function __construct(
		ITranslator $translator,
		LinkFactory $linkFactory,
		AbstractAdminPageFactory $adminPageFactory
	)
	{
		$this->translator = $translator;
		$this->linkFactory = $linkFactory;
		$this->adminPageFactory = $adminPageFactory;
	}

	/**
	 * @param bool $homepage
	 * @return BreadcrumbNavigation
	 */
	public function create($homepage = true)
	{
		$breadcrumbNavigation = new BreadcrumbNavigation();
		if (true === $homepage) {
			$page = $this->adminPageFactory->fromPresenter('Admin:Homepage');
			$breadcrumbNavigation->add($page->getTitle(), $page->getUrl());
		}

		return $breadcrumbNavigation;
	}

	/**
	 * @param AdminPage $adminPage
	 * @return BreadcrumbNavigation
	 */
	public function fromAdminPage(AdminPage $adminPage): BreadcrumbNavigation
	{
		$breadcrumbNavigation = $this->create(false);
		$self = $adminPage;

		$parents = [];
		while ($parent = $adminPage->getParent()) {
			if ($parent->isInBreadcrumb()) {
				$parents[] = $parent;
			}

			$adminPage = $parent;
		}

		foreach (array_reverse($parents) as $parent) {
			$breadcrumbNavigation->addPage($parent);
		}

		$breadcrumbNavigation->addPage($self);
		return $breadcrumbNavigation;
	}
}
