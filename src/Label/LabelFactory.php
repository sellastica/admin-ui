<?php
namespace Sellastica\AdminUI\Label;

class LabelFactory
{
	/**
	 * @param string $title
	 * @param string|null $class
	 * @return \Nette\Utils\Html
	 */
	public function create(string $title, string $class = null): \Nette\Utils\Html
	{
		return \Nette\Utils\Html::el('span')
			->class("label $class")
			->setText($title);
	}

	/**
	 * @param string $title
	 * @return \Nette\Utils\Html
	 */
	public function success(string $title): \Nette\Utils\Html
	{
		return $this->create($title, 'success');
	}

	/**
	 * @param string $title
	 * @return \Nette\Utils\Html
	 */
	public function hidden(string $title): \Nette\Utils\Html
	{
		return $this->create($title, 'hidden');
	}

	/**
	 * @param string $title
	 * @return \Nette\Utils\Html
	 */
	public function secondary(string $title): \Nette\Utils\Html
	{
		return $this->create($title, 'secondary');
	}

	/**
	 * @param string $title
	 * @return \Nette\Utils\Html
	 */
	public function warning(string $title): \Nette\Utils\Html
	{
		return $this->create($title, 'warning');
	}

	/**
	 * @param string $title
	 * @return \Nette\Utils\Html
	 */
	public function alert(string $title): \Nette\Utils\Html
	{
		return $this->create($title, 'alert');
	}
}