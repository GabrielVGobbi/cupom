<?php
class Users extends model

{

	private $userInfo;
	private $permissions;

	/**
	 * Ver se o usuario está logado
	 * @return boolean TRUE ou FALSE
	 */
	public function isLogged()
	{
		return isset($_SESSION['ccUser']) && !empty($_SESSION['ccUser']) ? true : false;
	}

	/**
	 * Pegar a Sessão e ver se a Sessão existe usuario
	 * @return boolean TRUE ou FALSE
	 */
	public function setLoggedUser()
	{

		if (isset($_SESSION['ccUser']) && !empty($_SESSION['ccUser'])) {
			$p = new Permissions();

			$id = $_SESSION['ccUser'];
			$sql = $this->db->prepare("SELECT * FROM users WHERE id = :id LIMIT 1");
			$sql->bindValue(':id', $id);
			$sql->execute();

			if ($sql->rowCount() > 0) {

				$this->userInfo = $sql->fetch();
				$id_group = $this->userInfo['id'];
				$p = new Permissions();
				$p->setGroup($id_group, $this->userInfo['id_company']);
			}
		} else {
			return false;
		}
	}

	/**
	 * Verificar Post Login
	 * @return boolean Array ou FALSE
	 */
	public function doLogin($login, $password)
	{
		$login = mb_strtolower($login, 'UTF-8');

		$sql = $this->db->prepare("SELECT * FROM users WHERE email = :login AND password = :password");
		$sql->bindValue(':login', $login);
		$sql->bindValue(':password', md5($password));
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$row = $sql->fetch();
			$_SESSION['ccUser'] = $row['id'];
			return $row;
		} else {
			return false;
		}
	}

	/**
	 * Logout
	 * @return 
	 */
	public function logout()
	{

		session_destroy();
	}

	public function getCompany()
	{
		if (isset($this->userInfo['id_company'])) {

			return $this->userInfo['id_company'];
		} else
			return 0;
	}

	public function getId()
	{
		if (isset($this->userInfo['id'])) {

			return $this->userInfo['id'];
		} else
			return 0;
	}

	public function getEmail()
	{
		if (isset($this->userInfo['email'])) {

			return $this->userInfo['email'];
		} else
			return '';
	}

	public function getInfo($id, $id_company)
	{

		$array = array();

		$sql = $this->db->prepare("SELECT * FROM users WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(':id', $id);
		$sql->bindValue(':id_company', $id_company);
		$sql->execute();


		if ($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array;
	}

}
