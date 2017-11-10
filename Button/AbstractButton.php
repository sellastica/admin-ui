<?php
namespace Sellastica\AdminUI\Button;

use Nette\Utils\Html;

abstract class AbstractButton
{
	protected $id;
	/** @var string|Html */
	protected $title;
	/** @var string|Html */
	protected $icon;
	/** @var string|null */
	protected $class;
	/** @var array */
	protected $data = [];
	/** @var array */
	protected $attributes = [];


	/**
	 * @param string|Html $title
	 */
	public function __construct($title)
	{
		$this->title = $title;
	}

	/**
	 * @param mixed $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @return string|Html
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * @return string|Html|null
	 */
	public function getIcon()
	{
		return $this->icon;
	}

	/**
	 * @param string|Html|null $icon
	 * @return $this
	 */
	public function setIcon($icon)
	{
		$this->icon = $icon;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getClass(): ?string
	{
		return $this->class;
	}

	/**
	 * @param string|null $class
	 * @return $this
	 */
	public function setClass(?string $class)
	{
		$this->class = $class;
		return $this;
	}

	/**
	 * @param string $class
	 * @return $this
	 */
	public function addClass(string $class)
	{
		$this->class .= $this->class ? ' ' . $class : $class;
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
	 * @param string $key
	 * @param $value
	 * @return $this
	 */
	public function addAttribute(string $key, $value)
	{
		$this->attributes[$key] = $value;
		return $this;
	}

	/**
	 * @return Html
	 */
	abstract public function toHtml(): Html;

	/**
	 * @return string
	 */
	abstract public function render(): string;

	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return $this->render();
	}
}