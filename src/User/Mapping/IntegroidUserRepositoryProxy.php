<?php
namespace Sellastica\AdminUI\User\Mapping;

use Sellastica\Entity\Mapping\RepositoryProxy;
use Sellastica\AdminUI\User\Entity\IIntegroidUserRepository;
use Sellastica\AdminUI\User\Entity\IntegroidUser;

/**
 * @method IntegroidUserRepository getRepository()
 * @see IntegroidUser
 */
class IntegroidUserRepositoryProxy extends RepositoryProxy implements IIntegroidUserRepository
{
	use \Sellastica\DataGrid\Mapping\Dibi\TFilterRulesRepositoryProxy;
}