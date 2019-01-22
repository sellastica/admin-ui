<?php
namespace Sellastica\AdminUI\Component;

class FoundationModal extends BaseControl
{
	public static $footer = __DIR__ . '/FoundationModalFooter.latte';

	/** @var bool */
	private $bootstrap;


	/**
	 * @param bool $bootstrap
	 */
	public function __construct(bool $bootstrap = false)
	{
		parent::__construct();
		$this->bootstrap = $bootstrap;
	}

	/**
	 * @param array $params
	 */
	protected function beforeRender(array $params = [])
	{
		if ($this->bootstrap) {
			$this->setFile(__DIR__ . '/FoundationModalBootstrap.latte');
		}
	}
}
