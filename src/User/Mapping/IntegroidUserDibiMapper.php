<?php
namespace Sellastica\AdminUI\User\Mapping;

/**
 * @see \Sellastica\AdminUI\User\Entity\IntegroidUser
 */
class IntegroidUserDibiMapper extends \Sellastica\Entity\Mapping\DibiMapper
{
	use \Sellastica\DataGrid\Mapping\Dibi\TFilterRulesDibiMapper;

	/**
	 * @param bool $databaseName
	 * @return string
	 */
	protected function getTableName($databaseName = false): string
	{
		return 'admin_user';
	}
}