<?php
namespace Sellastica\AdminUI\Button;

use Nette\Utils\Html;

class DropdownButton extends LinkButton
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
			->addData('toggle', $this->id);
	}

	/**
	 * @param null|string $dropdownClass
	 * @return $this
	 */
	public function setDropdownClass(?string $dropdownClass): DropdownButton
	{
		$this->dropdownClass = $dropdownClass;
		return $this;
	}

	/**
	 * @param string $title
	 * @param string $href
	 * @return self
	 */
	public function addItem(string $title, string $href): self
	{
		$this->items[] = new DropdownButtonItem($title, $href);
		return $this;
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
			'class' => 'menu dropdown-pane button-dropdown bottom no-padding ' . $this->dropdownClass,
			'id' => $this->id,
			'data-dropdown' => true,
			'data-close-on-click' => 'true',
			'data-v-offset' => 5,
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
		$el = Html::el('span');
		$el->addHtml(parent::toHtml());
		if ($this->items) {
			$el->addHtml($this->getItemsHtml());
		}

		return $el;
	}
}