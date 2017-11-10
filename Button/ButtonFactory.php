<?php
namespace Sellastica\AdminUI\Button;

use Nette\Localization\ITranslator;
use Nette\Utils\Html;

class ButtonFactory
{
	/** @var ITranslator */
	private $translator;


	/**
	 * @param ITranslator $translator
	 */
	public function __construct(
		ITranslator $translator
	)
	{
		$this->translator = $translator;
	}

	/**
	 * @param string|Html $title
	 * @param string $url
	 * @param string $class
	 * @return LinkButton
	 */
	public function link($title, string $url = null, string $class = null): LinkButton
	{
		$button = new LinkButton($title, $url);
		if (isset($class)) {
			$button->setClass($class);
		}

		return $button;
	}

	/**
	 * @param string|Html $title
	 * @param string $toggleId
	 * @return LinkButton
	 */
	public function modal($title, string $toggleId): LinkButton
	{
		return $this->link($title)
			->addData('toggle', $toggleId);
	}

	/**
	 * @param string $url
	 * @return LinkButton
	 */
	public function display(string $url): LinkButton
	{
		return (new LinkButton(
			$this->translator->translate('admin.globals.buttons.display_in_store'),
			$url
		))->addClass('hollow button-icon')
			->setIcon('fa-external-link');
	}

	/**
	 * @param string $url
	 * @param string|null $class
	 * @return LinkButton
	 */
	public function trash(string $url, string $class = null)
	{
		$title = Html::el('i')->class('fa fa-trash-o');
		return $this->link($title, $url, $class ?? 'hollow');
	}

	/**
	 * @param string $title
	 * @param string $class
	 * @return Button
	 */
	public function submit(string $title, string $class = null): Button
	{
		//add spinner icon
		$icon = Html::el('i')->class('fa fa-spinner fa-spin');
		$label = Html::el('span')->class('button-label')->setText($title);
		$title = Html::el()
			->addHtml($icon)
			->addHtml($label);

		$button = (new Button($title, 'submit'))
			->addClass('button-submittable');
		if (isset($class)) {
			$button->addClass($class);
		}

		return $button;
	}

	/**
	 * @param string $formId
	 * @return Button
	 */
	public function submitPrimary(string $formId = 'frm-form')
	{
		return $this->submit($this->translator->translate('admin.globals.buttons.save'), 'button-wide')
			->setFormId($formId);
	}

	/**
	 * @param string $title
	 * @param string $class
	 * @return Button
	 */
	public function button(string $title, string $class = null): Button
	{
		$button = new Button($title, 'button');
		if (isset($class)) {
			$button->setClass($class);
		}

		return $button;
	}

	/**
	 * @param string|Html $title
	 * @param string|null $id
	 * @return DropdownButton
	 */
	public function dropdown($title, string $id = null): DropdownButton
	{
		return new DropdownButton($title, $id);
	}
}