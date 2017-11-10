<?php
namespace Sellastica\AdminUI\Label;

use Nette\Utils\Html;

class LabelFactory
{
	/**
	 * @param string $title
	 * @return Html
	 */
	public function hidden(string $title): Html
	{
		return $this->create($title, 'hidden');
	}

	/**
	 * @param string $title
	 * @return Html
	 */
	public function secondary(string $title): Html
	{
		return $this->create($title, 'secondary');
	}

	/**
	 * @param string $title
	 * @param string|null $class
	 * @return Html
	 */
	protected function create(string $title, string $class = null): Html
	{
		return Html::el('span')
			->class("label $class")
			->setText($title);
	}
}