<?php
namespace Sellastica\AdminUI\Button;

class DropdownButtonItem
{
	/** @var \Nette\Utils\Html|string */
	private $title;
	/** @var string|null */
	private $href;
	/** @var array */
	private $data = [];


	/**
	 * @param string|\Nette\Utils\Html $title
	 * @param string|null $href
	 */
	public function __construct(string $title, string $href = null)
	{
		$this->title = $title;
		$this->href = $href;
	}

	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return (string)$this->toHtml();
	}

	/**
	 * @param string $name
	 * @param string $value
	 */
	public function setData(string $name, string $value): void
	{
		$this->data[$name] = $value;
	}

	/**
	 * @return \Nette\Utils\Html
	 */
	public function toHtml(): \Nette\Utils\Html
	{
		$el = \Nette\Utils\Html::el('a')->href($this->href)
			->setText($this->title);
		foreach ($this->data as $name => $value) {
			$el->data($name, $value);
		}

		return $el;
	}
}