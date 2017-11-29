<?php
namespace Sellastica\AdminUI\Component;

use Nette\Utils\Paginator;

class Pagination extends BaseControl
{
	/** @var Paginator */
	private $paginator;


	/**
	 * @param Paginator $paginator
	 */
	public function __construct(Paginator $paginator)
	{
		parent::__construct();
		$this->paginator = $paginator;
	}

	/**
	 * @param array $params
	 */
	protected function beforeRender(array $params = [])
	{
		$this->template->pagination = $this->paginator;
	}
}