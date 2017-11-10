<?php
namespace Sellastica\AdminUI\Button;

use Nette\Utils\Html;

class Button extends AbstractButton
{
	/** @var string */
	private $type;
	/** @var string|null */
	private $formId;


	/**
	 * @param string $type
	 * @param string|Html $title
	 */
	public function __construct($title, string $type = 'submit')
	{
		parent::__construct($title);
		$this->type = $type;
	}

	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}

	/**
	 * @return string|null
	 */
	public function getFormId(): string
	{
		return $this->formId;
	}

	/**
	 * @param string $formId
	 * @return $this
	 */
	public function setFormId(string $formId)
	{
		$this->formId = $formId;
		$this->id = $this->id ?? 'button-' . $formId;
		return $this;
	}

	/**
	 * @return Html
	 */
	public function toHtml(): Html
	{
		$el = Html::el('button', [
			'type' => $this->type,
			'class' => ['button'],
			'form' => $this->formId,
			'id' => $this->id,
		]);
		$el->class[] = $this->class ?: null;
		if ($this->icon) {
			$el->setHtml($this->icon);
		}

		if ($this->title instanceof Html) {
			$el->addHtml($this->title);
		} else {
			$el->addText($this->title);
		}

		foreach ($this->data as $key => $value) {
			$el->data($key, $value);
		}

		$el->addAttributes($this->attributes);

		return $el;
	}

	/**
	 * @return string
	 */
	public function render(): string
	{
		return (string)$this->toHtml();
	}
}