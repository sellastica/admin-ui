<?php
namespace Sellastica\AdminUI\Component;

use Nette;
use Sellastica\AdminUI\User\Service\AdminAuthenticator;
use Sellastica\UI\Form\Form;
use Sellastica\UI\Form\FormFactory;

class SignInForm extends BaseControl
{
	/** @var array */
	public $onSuccess = [];
	/** @var array */
	public $onError = [];

	/** @var Nette\Security\User */
	private $user;
	/** @var AdminAuthenticator */
	private $authenticator;
	/** @var FormFactory */
	private $formFactory;


	/**
	 * @param Nette\Security\User $user
	 * @param AdminAuthenticator $authenticator
	 * @param FormFactory $formFactory
	 */
	public function __construct(
		Nette\Security\User $user,
		AdminAuthenticator $authenticator,
		FormFactory $formFactory
	)
	{
		parent::__construct();
		$this->user = $user;
		$this->formFactory = $formFactory;
		$this->authenticator = $authenticator;
	}

	/**
	 * @return \Sellastica\UI\Form\Form
	 */
	public function createComponentSignInForm()
	{
		$form = $this->formFactory->create();
		$form->addText('email', 'Email')
			->setRequired()
			->addRule(Form::EMAIL);
		$form->addPassword('password', 'Password')
			->setRequired();
		$form->addSubmit('submit', 'admin.sign.submit_label');
		$form->onSuccess[] = [$this, 'processForm'];

		return $form;
	}

	/**
	 * @param \Sellastica\UI\Form\Form $form
	 * @param mixed $values
	 */
	public function processForm(Form $form, $values)
	{
		try {
			$this->user->setExpiration('+ 14 days', false);
			$this->authenticator->login([$values->email, $values->password]);
			$this->onSuccess($form);
		} catch (Nette\Security\AuthenticationException $e) {
			$form->addError($e->getMessage());
			$this->onError($form);
		}
	}

	/**
	 * @param array $params
	 */
	protected function beforeRender(array $params = [])
	{
	}
}
