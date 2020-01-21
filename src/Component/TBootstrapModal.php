<?php
namespace Sellastica\AdminUI\Component;

trait TBootstrapModal
{
	/**
	 * @return \Sellastica\AdminUI\Component\FoundationModal
	 */
	protected function createComponentModal(): \Sellastica\AdminUI\Component\FoundationModal
	{
		return new \Sellastica\AdminUI\Component\FoundationModal(true);
	}
}
