<?php
namespace Sellastica\AdminUI\User\Service;

use Nette;
use Nette\Localization\ITranslator;
use Sellastica\AdminUI\User\Entity\AdminUser;

class AdminAuthenticator extends \Sellastica\Core\Model\AbstractAuthenticator
{
	/** @var \Sellastica\Localization\Model\LocalizationAccessor */
	private $localizationAccessor;
	/** @var ITranslator */
	private $translator;


	/**
	 * @param Nette\Security\User $user
	 * @param Nette\Http\Session $session
	 * @param \Sellastica\Entity\EntityManager $em
	 * @param \Sellastica\Localization\Model\LocalizationAccessor $localizationAccessor
	 * @param ITranslator $translator
	 */
	public function __construct(
		Nette\Security\User $user,
		Nette\Http\Session $session,
		\Sellastica\Entity\EntityManager $em,
		\Sellastica\Localization\Model\LocalizationAccessor $localizationAccessor,
		ITranslator $translator
	)
	{
		parent::__construct($user, $session, $em->getRepository(AdminUser::class), $em);
		$this->localizationAccessor = $localizationAccessor;
		$this->translator = $translator;
	}

	/**
	 * {@inheritdoc}
	 */
	public function authenticate(array $credentials)
	{
		list($email, $password) = $credentials;

		/** @var AdminUser $adminUser */
		$adminUser = $this->repository->findOneBy(['email' => $email]);
		if (!isset($adminUser)) {
			//user not found
			throw new Nette\Security\AuthenticationException(
				$this->translator->translate('admin.authentication.invalid_credentials'),
				Nette\Security\IAuthenticator::IDENTITY_NOT_FOUND
			);
		} elseif (!$adminUser->isVisible()) {
			//user is deactivated
			throw new Nette\Security\AuthenticationException(
				$this->translator->translate('admin.authentication.user_is_deactivated'),
				Nette\Security\IAuthenticator::NOT_APPROVED
			);
		} elseif ($isBannedTill = $adminUser->getBannedTill()) {
			//brute force prevention
			//notify user, but do NOT log invalid login
			throw new Nette\Security\AuthenticationException(
				$this->translator->translate(
					'admin.authentication.notApproved',
					['isBannedTill' => $isBannedTill->format($this->localizationAccessor->get()->getTimeFormatWithSeconds())]
				),
				Nette\Security\IAuthenticator::NOT_APPROVED
			);
		} elseif (!Nette\Security\Passwords::verify($password, $adminUser->getPassword())) {
			//user password is incorrect
			//notify user and log invalid login
			$this->logInvalidLogin($adminUser);
			if ($isBannedTill = $adminUser->getBannedTill()) {
				throw new Nette\Security\AuthenticationException(
					$this->translator->translate(
						'admin.authentication.notApproved',
						['isBannedTill' => $isBannedTill->format($this->localizationAccessor->get()->getTimeFormatWithSeconds())]
					),
					Nette\Security\IAuthenticator::INVALID_CREDENTIAL
				);
			} else {
				throw new Nette\Security\AuthenticationException(
					'admin.authentication.invalid_credentials', Nette\Security\IAuthenticator::INVALID_CREDENTIAL
				);
			}
		} elseif (Nette\Security\Passwords::needsRehash($adminUser->getPassword())) {
			//checks aganst cost, if hash is strong inough
			//TODO
//			$this->changePassword($adminUser, $password);
		}

		//successfull login
		$this->logSuccessfullLogin($adminUser);
		return new Nette\Security\Identity($adminUser->getId(), $adminUser->getRole()->getRole());
	}
}
