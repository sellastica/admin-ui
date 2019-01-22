<?php
namespace Sellastica\AdminUI\Component;

use Nette\Utils\Paginator;

class Pagination extends BaseControl
{
	/** @var array */
	public $onSuccess = [];
	/** @var Paginator */
	private $paginator;
	/** @var \Nette\Localization\ITranslator */
	private $translator;


	/**
	 * @param Paginator $paginator
	 * @param \Nette\Localization\ITranslator $translator
	 */
	public function __construct(
		Paginator $paginator,
		\Nette\Localization\ITranslator $translator
	)
	{
		parent::__construct();
		$this->paginator = $paginator;
		$this->translator = $translator;
	}

	protected function createComponentJumpToPage(): \Sellastica\UI\Form\Form
	{
		$form = new \Sellastica\UI\Form\Form();
		$form->addText('page')
			->setAttribute('placeholder', $this->translator->translate('admin.data_grid.pagination.page'))
			->setAttribute('autocomplete', 'off');
		$form->addSubmit('submit', $this->translator->translate('admin.data_grid.pagination.go'));
		$form->onSuccess[] = [$this, 'jumpToPageSuccess'];

		return $form;
	}

	/**
	 * @param \Sellastica\UI\Form\Form $form
	 * @param $values
	 */
	public function jumpToPageSuccess(\Sellastica\UI\Form\Form $form, $values): void
	{
		$this->onSuccess(['page' => $values->page]);
	}

	/**
	 * @param array $params
	 */
	protected function beforeRender(array $params = [])
	{
		$this->template->pagination = $this->paginator;
	}
}