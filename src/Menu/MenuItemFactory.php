<?php
namespace Sellastica\AdminUI\Menu;

class MenuItemFactory
{
	/** @var \Admin\Model\AdminPageFactory */
	private $adminPageFactory;
	/** @var \Project\Service\ModuleService */
	private $moduleService;


	/**
	 * @param \Admin\Model\AdminPageFactory $adminPageFactory
	 * @param \Project\Service\ModuleService $moduleService
	 */
	public function __construct(
		\Admin\Model\AdminPageFactory $adminPageFactory,
		\Project\Service\ModuleService $moduleService
	)
	{
		$this->adminPageFactory = $adminPageFactory;
		$this->moduleService = $moduleService;
	}

	/**
	 * @param string $item
	 * @param \Sellastica\AdminUI\User\Entity\AdminUser $adminUser
	 * @param \Sellastica\Project\Entity\Project $project
	 * @return \Sellastica\AdminUI\Menu\MenuItem|null
	 * @throws \InvalidArgumentException
	 */
	public function create(
		string $item,
		\Sellastica\AdminUI\User\Entity\AdminUser $adminUser,
		\Sellastica\Project\Entity\Project $project
	)
	{
		$page = $this->adminPageFactory->fromPresenter($item);
		if (($page->isB2b() && !$project->isB2b())
			|| ($page->getModule() && !$this->moduleService->isInstalled($page->getModule()))) {
			return null;
		} elseif (!$page->getScope()
			|| $adminUser->hasPermissionsTo($page->getScope())) {
			return MenuItem::fromAdminPage($page);
		}

		return null;
	}
}