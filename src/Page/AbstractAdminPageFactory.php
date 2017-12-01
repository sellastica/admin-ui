<?php
namespace Sellastica\AdminUI\Page;

use Nette\Localization\ITranslator;
use Sellastica\AdminUI\User\Model\AdminUserRole;
use Sellastica\Http\Url;
use Sellastica\LinkFactory\LinkFactory;

abstract class AbstractAdminPageFactory
{
	/** @var LinkFactory */
	private $linkFactory;
	/** @var ITranslator */
	private $translator;


	/**
	 * @param LinkFactory $linkFactory
	 * @param ITranslator $translator
	 */
	public function __construct(
		LinkFactory $linkFactory,
		ITranslator $translator
	)
	{
		$this->linkFactory = $linkFactory;
		$this->translator = $translator;
	}

	/**
	 * @param string $presenter
	 * @return AdminPage
	 * @throws \InvalidArgumentException
	 */
	public function fromPresenter(string $presenter): AdminPage
	{
		$setting = $this->getPageSettings($presenter);
		if (isset($setting['parent'])) {
			$parent = $this->fromPresenter($setting['parent']);
		} else {
			$parent = null;
		}

		return $this->getAdminPage($setting, $presenter, $parent);
	}

	/**
	 * @param array $setting
	 * @param string $presenter
	 * @param AdminPage $parent
	 * @return AdminPage
	 */
	private function getAdminPage(array $setting, string $presenter, AdminPage $parent = null): AdminPage
	{
		$adminPage = new AdminPage(
			$presenter,
			$this->translator->translate($setting['title']),
			new Url($this->linkFactory->link($presenter . ':')),
			$setting['scope'] ?? null,
			$setting['role'] && AdminUserRole::isRole($setting['role']) ? new AdminUserRole($setting['role']) : null
		);
		$adminPage->setIcon($setting['icon']);
		$adminPage->setParent($parent);
		$adminPage->setModule($setting['module'] ?? null);
		$adminPage->setB2b($setting['b2b'] ?? false);

		return $adminPage;
	}

	/**
	 * @param string $presenter
	 * @return array
	 * @throws \InvalidArgumentException If page settings are not found
	 */
	private function getPageSettings(string $presenter)
	{
		//admin page is same for list and detail, although there are different presenters
		$key = preg_replace('~^(.*)List$~', '\\1', $presenter);
		if (!isset(static::getAllPageSettings()[$key])) {
			throw new \InvalidArgumentException(sprintf('Page by presenter "%s" not found', $presenter));
		}

		return static::getAllPageSettings()[$key];
	}

	/**
	 * @return array
	 */
	abstract public static function getAllPageSettings(): array;
}