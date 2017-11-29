<?php
namespace Sellastica\AdminUI\Component;

interface ISignInFormFactory
{
	/**
	 * @return SignInForm
	 */
	function create(): SignInForm;
}
