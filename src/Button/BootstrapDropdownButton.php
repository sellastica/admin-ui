<?php
namespace Sellastica\AdminUI\Button;

use Nette\Utils\Html;

class BootstrapDropdownButton extends LinkButton
{
	/** @var DropdownButtonItem[] */
	private $items = [];
	/** @var string|null */
	private $dropdownClass;


	/**
	 * @param string|Html $title
	 * @param string $id
	 */
	public function __construct($title, string $id = null)
	{
		parent::__construct($title);

		$this->id = $id ?? uniqid();
		$this->addClass('dropdown')
			->addClass('hollow')
			->addData('toggle', 'dropdown');
	}

	/**
	 * @param null|string $dropdownClass
	 * @return BootstrapDropdownButton
	 */
	public function setDropdownClass(?string $dropdownClass): BootstrapDropdownButton
	{
		$this->dropdownClass = $dropdownClass;
		return $this;
	}

	/**
	 * @param string $title
	 * @param string|null $href
	 * @return DropdownButtonItem
	 */
	public function addItem(string $title, string $href = null): DropdownButtonItem
	{
		$this->items[] = $item = new DropdownButtonItem($title, $href);
		return $item;
	}

	/**
	 * @return bool
	 */
	public function hasItems(): bool
	{
		return !empty($this->items);
	}

	/**
	 * @return string
	 */
	public function render(): string
	{
		return (string)$this->toHtml();
	}

	/**
	 * @return Html
	 */
	private function getItemsHtml(): Html
	{
		$ul = Html::el('ul', [
			'class' => 'dropdown-menu ' . $this->dropdownClass,
			'id' => $this->id,
			'data-dropdown' => true,
			'data-close-on-click' => 'true',
			'data-v-offset' => 5,
			'role' => 'menu',
			'data-dropdown-in' => 'flipInX'
		]);
		foreach ($this->items as $item) {
			$li = $ul->create('li');
			$li->addHtml($item->toHtml());
		}

		return $ul;
	}

	/**
	 * @return Html
	 */
	public function toHtml(): Html
	{
		$el = Html::el('div')
			->setAttribute('class', 'dropdown');
		$el->addHtml(parent::toHtml());
		if ($this->items) {
			$el->addHtml($this->getItemsHtml());
		}

		return $el;
	}
}