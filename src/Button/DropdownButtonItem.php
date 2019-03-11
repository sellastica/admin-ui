<?php
namespace Sellastica\AdminUI\Button;

class DropdownButtonItem
{
	/** @var \Nette\Utils\Html|string */
	private $title;
	/** @var string|null */
	private $href;
	/** @var bool */
	private $ajax = false;
	/** @var bool */
	private $openInNewWindow = false;
	/** @var string|null */
	private $icon;
	/** @var array */
	protected $data = [];
	/** @var array */
	protected $class = [];


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
	 * @param bool $openInNewWindow
	 * @return DropdownButtonItem
	 */
	public function openInNewWindow(bool $openInNewWindow = true): DropdownButtonItem
	{
		$this->openInNewWindow = $openInNewWindow;
		return $this;
	}

	/**
	 * @param bool $ajax
	 * @return DropdownButtonItem
	 */
	public function setAjax(bool $ajax): DropdownButtonItem
	{
		$this->ajax = $ajax;
		return $this;
	}

	/**
	 * @param string $key
	 * @param string $value
	 * @return DropdownButtonItem
	 */
	public function addData(string $key, string $value): DropdownButtonItem
	{
		$this->data[$key] = $value;
		return $this;
	}

	/**
	 * @param string $class
	 * @return DropdownButtonItem
	 */
	public function addClass(string $class): DropdownButtonItem
	{
		$this->class[] = $class;
		return $this;
	}

	/**
	 * @param string|null $icon
	 * @return DropdownButtonItem
	 */
	public function setIcon(?string $icon): DropdownButtonItem
	{
		$this->icon = $icon;
		return $this;
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
		$el = \Nette\Utils\Html::el('a')->href($this->href);
		if ($this->openInNewWindow) {
			$el->setAttribute('target', '_blank');
		}

		$class = $this->class;
		if ($this->ajax) {
			$class[] = 'ajax';
		}

		if ($class = implode(' ', $class)) {
			$el->setAttribute('class', $class);
		}

		foreach ($this->data as $key => $value) {
			$el->data($key, $value);
		}

		if ($this->icon) {
			$el->addHtml(\Nette\Utils\Html::el('i')->setAttribute('class', $this->icon));
		}

		$el->addText($this->title);

		return $el;
	}
}