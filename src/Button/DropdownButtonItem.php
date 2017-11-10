<?php
namespace Sellastica\AdminUI\Button;

use Nette\Utils\Html;

class DropdownButtonItem
{
	/** @var Html|string */
	private $title;
	/** @var string */
	private $href;

	/**
	 * @param string|Html $title
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
		return (string) Html::el('a')->href($this->href)
			->setText($this->title);
	}
}