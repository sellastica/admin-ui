<?php
namespace Sellastica\AdminUI\User\Model;

use Sellastica\AdminUI\Page\AdminPage;

interface IAclManagerFactory
{
	/**
	 * @param AdminPage $adminPage
	 * @return AclManager
	 */
	function create(
		AdminPage $adminPage
	);
}