<?php
namespace Sellastica\AdminUI\User\Entity;

class AdminUserRelations implements \Sellastica\Entity\Relation\IEntityRelations
{
	/** @var AdminUser */
	private $adminUser;
	/** @var \Sellastica\Entity\EntityManager */
	private $em;


	/**
	 * @param AdminUser $adminUser
	 * @param \Sellastica\Entity\EntityManager $em
	 */
	public function __construct(
		AdminUser $adminUser,
		\Sellastica\Entity\EntityManager $em
	)
	{
		$this->adminUser = $adminUser;
		$this->em = $em;
	}

	/**
	 * @return \Sellastica\Project\Entity\Project|null
	 */
	public function getProject(): ?\Sellastica\Project\Entity\Project
	{
		return $this->em->getRepository(\Sellastica\Project\Entity\Project::class)->find(
			$this->adminUser->getProjectId()
		);
	}
}