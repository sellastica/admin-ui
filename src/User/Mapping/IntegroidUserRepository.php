<?php
namespace Sellastica\AdminUI\User\Mapping;

use Sellastica\Entity\Mapping\Repository;
use Sellastica\AdminUI\User\Entity\IntegroidUser;
use Sellastica\AdminUI\User\Entity\IIntegroidUserRepository;

/**
 * @property IntegroidUserDao $dao
 * @see IntegroidUser
 */
class IntegroidUserRepository extends Repository implements IIntegroidUserRepository
{
	use \Sellastica\DataGrid\Mapping\Dibi\TFilterRulesRepository;
}