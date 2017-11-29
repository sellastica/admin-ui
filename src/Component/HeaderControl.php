<?php
namespace Core\UI\Admin\Components;

use Sellastica\AdminUI\Page\AdminPage;

class HeaderControl extends \Sellastica\AdminUI\Component\BaseControl
{
	/** @var \Sellastica\AdminUI\Page\AdminPage */
	private $adminPage;
	/** @var string */
	private $basePath;


	/**
	 * @param \Sellastica\AdminUI\Page\AdminPage $adminPage
	 * @param string $basePath
	 */
	public function __construct(AdminPage $adminPage, string $basePath)
	{
		parent::__construct();
		$this->adminPage = $adminPage;
		$this->basePath = $basePath;
	}

	/**
	 * @param array $params
	 */
	protected function beforeRender(array $params = [])
	{
		$this->template->adminPage = $this->adminPage;
		$this->template->basePath = $this->basePath;
	}
}
