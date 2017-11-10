<?php
namespace Sellastica\AdminUI\Bridges;

use Nette\Application\UI\ITemplate;
use Sellastica\AdminUI\Button\AbstractButton;
use Sellastica\AdminUI\Button\ButtonFactory;

/**
 * @property ITemplate $template
 */
trait TButton
{
	/** @var AbstractButton[] */
	private $buttons = [];
	/** @var ButtonFactory @inject */
	public $buttonFactory;


	/**
	 * @param AbstractButton $button
	 */
	protected function addButton(AbstractButton $button)
	{
		$this->buttons[] = $button;
		$this->template->buttons = $this->buttons;
	}
}
