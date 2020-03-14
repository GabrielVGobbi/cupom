<?php

class homeController extends controller
{


	public function __construct()
	{

		$this->user 	= new Users();
		$this->user->setLoggedUser();
		if ($this->user->isLogged() == false) {
			header("Location: " . BASE_URL_PAINEL . "login");
			exit();
		}
		$this->id_company = $this->user->getCompany();

		$this->filtro = array();
		$this->cliente = new Cliente();
		$this->painel = new Painel();

		$this->dataInfo = array(
			'pageController' => 'home',
			'titlePage' => 'Dashboard'
		);
	}

	public function index()
	{


		$this->loadView('home', $this->dataInfo);
	}
}
