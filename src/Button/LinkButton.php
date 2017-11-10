<?php
namespace Sellastica\AdminUI\Button;

use Nette\Utils\Html;

class LinkButton extends AbstractButton
{
	/** @var string|null */
	private $url;
	/** @var bool */
	private $openInNewWindow = false;


	/**
	 * @param string|Html $title
	 * @param string $url
	 */
	public function __construct($title, string $url = null)
	{
		parent::__construct($title);
		$this->url = $url;
	}

	/**
	 * @return string|null
	 */
	public function getUrl(): ?string
	{
		return $this->url;
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
	 * @return Html
	 */
	public function toHtml(): Html
	{
		$el = Html::el('a', ['class' => ['button']]);
		$el->class[] = $this->class ?: null;
		$el->href($this->url);
		if ($this->icon) {
			$el->setHtml(Html::el('i')->class('fa ' . $this->icon));
		}

		if ($this->openInNewWindow) {
			$el->setAttribute('target', '_blank');
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