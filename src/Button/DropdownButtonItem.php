<?php
namespace Sellastica\AdminUI\Button;

class DropdownButtonItem
{
	/** @var \Nette\Utils\Html|string */
	private $title;
	/** @var string */
	private $href;


	/**
	 * @param string|\Nette\Utils\Html $title
	 * @param string $href
	 */
	public function __construct(string $title, string $href)
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
	 * @return \Nette\Utils\Html
	 */
	public function toHtml(): \Nette\Utils\Html
	{
		return \Nette\Utils\Html::el('a')->href($this->href)
			->setText($this->title);
	}
}