<?php
class Permissions extends model {

	private $group;
	private $permissions;

	public function setGroup($id, $id_company){
		
		$this->group = $id;
		$this->permissions = array();

		$sql = $this->db->prepare("SELECT * FROM permission_groups WHERE id = :id AND id_company = :id_company LIMIT 1");
		$sql->bindValue(':id', $id);
		$sql->bindValue(':id_company', $id_company);
		$sql->execute();
		#error_log(print_r($sql->rowCount(),1));

		if ($sql->rowCount() == 1 ) {
			$row = $sql->fetch();

			if (empty($row['params'])) {
				$row['params'] = '0';
			}

			$params = $row['params'];

			$sql = $this->db->prepare("SELECT name FROM permission_params pm WHERE id IN($params) AND id_company = :id_company");
			$sql->bindValue(':id_company', $id_company);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				foreach ($sql->fetchAll() as $item) {
					$this->permissions[] = $item['name'];
				}	
			}
		} 	
	}

	public function returnPermission(){
		return $this->permissions;
	}

	public function hasPermission($name){

		if (in_array($name, $this->permissions)) {
			return true;
		} else {
			return false;
		}
	}

}