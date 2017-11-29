<?php
namespace Sellastica\AdminUI\Component;

class FoundationModal extends BaseControl
{
	public static $footer = __DIR__ . '/FoundationModalFooter.latte';


	/**
	 * @param array $params
	 */
	protected function beforeRender(array $params = [])
	{
	}

	public static function test()
	{
		return __DIR__ . '/FoundationModalFooter.latte';
	}
}
