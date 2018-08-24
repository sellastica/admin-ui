<?php
namespace Sellastica\AdminUI\User\Entity;

/**
 * @generate-builder
 * @see IntegroidUserBuilder
 */
class IntegroidUser extends \Sellastica\AdminUI\User\Entity\AdminUser
{
	use \Sellastica\Entity\Entity\TAbstractEntity;

	/** @var int|null @optional */
	private $projectId;


	/**
	 * @param IntegroidUserBuilder $builder
	 */
	public function __construct(IntegroidUserBuilder $builder)
	{
		$this->hydrate($builder);
		$this->invalidLogin = $this->invalidLogin ?? new \Sellastica\Identity\Model\InvalidLogin();
	}

	/**
	 * @return int|null
	 */
	public function getProjectId(): ?int
	{
		return $this->projectId;
	}

	/**
	 * @param int|null $projectId
	 */
	public function setProjectId(?int $projectId): void
	{
		$this->projectId = $projectId;
	}

	/**
	 * @return array
	 */
	public function toArray(): array
	{
		return array_merge(
			parent::toArray(),
			[
				'projectId' => $this->projectId,
			]
		);
	}
}