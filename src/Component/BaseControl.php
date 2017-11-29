<?php
namespace Sellastica\AdminUI\Component;

use Nette;
use Nette\Application\UI;

/**
 * @property Nette\Bridges\ApplicationLatte\Template $template
 */
abstract class BaseControl extends Nette\Application\UI\Control
{
	/** @var string */
	protected $file;


	/**
	 * @param string $file
	 */
	public function setFile(string $file)
	{
		$this->file = $file;
	}

	/**
	 * @return UI\ITemplate
	 */
	public function createTemplate(): UI\ITemplate
	{
		$template = parent::createTemplate();
		$template->setFile(isset($this->file) ? $this->file : $this->getDefaultFile());
		return $template;
	}

	/**
	 * Derives template path from class name.
	 * @param string $view
	 * @return string
	 */
	protected function getDefaultFile(string $view = null): string
	{
		$reflection = (new Nette\Reflection\ClassType($this));
		$dir = dirname($reflection->getFileName());
		$filename = $reflection->getShortName() . ($view ? ".$view" : '') . '.latte';
		return $dir . \DIRECTORY_SEPARATOR . $filename;
	}

	/**
	 * @param array $params
	 */
	abstract protected function beforeRender(array $params = []);

	/**
	 * @param mixed $params
	 */
	final public function render($params = [])
	{
		if (method_exists($this, 'beforeRender')) {
			$this->beforeRender($params);
		}

		$this->template->render(null, $params);
	}
}