<?php
namespace Sellastica\AdminUI\Button;

class DropdownButtonItem
{
	/** @var \Nette\Utils\Html|string */
	private $title;
	/** @var string|null */
	private $href;
	/** @var bool */
	private $openInNewWindow = false;
	/** @var array */
	protected $data = [];


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
	 * @return $this
	 */
	public function openInNewWindow(bool $openInNewWindow = true)
	{
		$this->openInNewWindow = $openInNewWindow;
		return $this;
	}

	/**
	 * @param string $key
	 * @param string $value
	 * @return $this
	 */
	public function addData(string $key, string $value)
	{
		$this->data[$key] = $value;
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
		$el = \Nette\Utils\Html::el('a')->href($this->href)
			->setText($this->title);
		if ($this->openInNewWindow) {
			$el->setAttribute('target', '_blank');
		}

		foreach ($this->data as $key => $value) {
			$el->data($key, $value);
		}

		return $el;
	}
}