<?php
class Cliente extends model

{

	public $clienteInfo;
	
	public $row = 0;

	protected $table = 'cliente';

	public $result = array();

	public function __construct($offset = 0, $filtro = array(), $id_cliente = 0, $id_company = 0)
	{
		parent::__construct();

		$id_cliente != 0 ? $this->getInfo($id_cliente) : $this->getAll($offset, $filtro, $id_company);
		
	}

	public function getAll($offset, $filtro, $id_company)
	{

		$where = $this->buildWhere($filtro, $id_company);

		$sql = "SELECT * FROM cliente cli WHERE " . implode(' AND ', $where) . " LIMIT $offset, 10";

		$sql = $this->db->prepare($sql);

		$this->bindWhere($filtro, $sql);

		$sql->execute();

		if ($sql->rowCount() > 0) {
			$this->clienteInfo = $sql->fetchAll();
			$this->row = $sql->rowCount();
			#foreach ($this->clienteInfo as $cli) {
			#	$this->clienteInfo['arrayCupom'] = array();
#
			#	$id_cliente = $cli['id_cliente'];
			#	$arrayCupom = $this->getCuponsClient($id_cliente);
			#	$this->clienteInfo['arrayCupom'] += $arrayCupom;
#
			#}
		}
		
		return $this->clienteInfo;
	}

	private function buildWhere($filtro, $id)
	{
		$where = array(
			'id_company='.$id
		);

		if (!empty($filtro['razao_social'])) {

			if ($filtro['razao_social'] != '') {

				$where[] = "sev.sev_nome LIKE :razao_social";
			}
		}

		if (!empty($filtro['id'])) {

			if ($filtro['id'] != '') {

				$where[] = "sev.id = :id";
			}
		}

		return $where;
	}

	private function bindWhere($filtro, &$sql)
	{

		if (!empty($filtro['razao_social'])) {
			if ($filtro['razao_social'] != '') {
				$sql->bindValue(":razao_social", '%' . $filtro['razao_social'] . '%');
			}
		}

		if (!empty($filtro['id'])) {
			if ($filtro['id'] != '') {
				$sql->bindValue(":id", $filtro['id']);
			}
		}
	}

	public function getCount($offset, $filtro){
		
		return $this->row;

	}

	public function getInfo($id_cliente){

		$sql = "SELECT * FROM cliente WHERE id_cliente = :id_cliente LIMIT 1";

		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id_cliente', $id_cliente);
		$sql->execute();

		if ($sql->rowCount() == 1) {
			$this->clienteInfo = $sql->fetch();
		}
		
		return $this->clienteInfo;
	}

	public function edit($Parametros, $id_company, $id_user){

		$Parametros['type'] = 'id_cliente';

		$this->editPainel($Parametros, $this->table, $id_company, false, $Parametros['EnVID']);
	
	}

	public function add($Parametros, $id_company, $id_user){

		$this->insert_painel($Parametros, $this->table, $id_company);
	}

	public function getCuponsClient($id_cliente){
		$arrayCupom = array();
		$sql = "SELECT * FROM cupom_cliente cupCli
			INNER JOIN cupom cup ON (cup.id_cupom = cupCli.id_cupom)
		
		WHERE id_cliente = :id_cliente";

		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id_cliente', $id_cliente);
		$sql->execute();

		if ($sql->rowCount() == 1) {
			$arrayCupom = $sql->fetchALL();
		}
		
		return $arrayCupom;

	}

}
