<?php
namespace Sellastica\AdminUI\Button;

use Nette\Utils\Html;

class DropdownButton extends LinkButton
{
	/** @var array */
	private $items = [];


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
		$button = parent::render();
		$ul = Html::el('ul', [
			'class' => 'menu dropdown-pane button-dropdown bottom no-padding',
			'id' => $this->id,
			'data-dropdown' => true,
			'data-close-on-click' => 'true',
			'data-v-offset' => 5,
		]);
		foreach ($this->items as $item) {
			$li = $ul->create('li');
			$li->addHtml((string)$item);
		}

		return $button . (string)$ul;
	}
}