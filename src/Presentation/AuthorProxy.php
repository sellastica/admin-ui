<?php
namespace Sellastica\AdminUI\Presentation;

use Sellastica\Twig\Model\ProxyEntity;

/**
 * {@inheritdoc}
 * @property \Sellastica\AdminUI\User\Entity\AdminUser $parent
 */
class AuthorProxy extends ProxyEntity
{
	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->parent->getId();
	}

	/**
	 * @return string
	 */
	public function getFull_name()
	{
		return $this->parent->getContact()->getFullName();
	}

	/**
	 * @return string
	 */
	public function getEmail()
	{
		return $this->parent->getContact()->getEmail();
	}

	/**
	 * @return string
	 */
	public function getBio()
	{
		return $this->parent->getBio();
	}

	/**
	 * @return string
	 */
	public function getHomepage()
	{
		return $this->parent->getHomepage();
	}

	/**
	 * @return string
	 */
	public function getShortName()
	{
		return 'author';
	}

	/**
	 * @return array
	 */
	public function getAllowedProperties()
	{
		return [
			'id',
			'full_name',
			'email',
			'bio',
			'homepage',
		];
	}
}