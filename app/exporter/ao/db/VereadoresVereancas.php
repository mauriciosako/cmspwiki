<?php
class app_exporter_ao_db_VereadoresVereancas{
	private $dataBase;
	
	public function __construct() {
		$dataBase = app_importer_lib_DataBase::getInstance();
		$this->dataBase = $dataBase;
	}

	public function getByIdVereador($id){
		$lista = array();
		$query = "SELECT
				id,
				id_vereador,
				id_vereador_anterior,
				data_ini,
				data_fim,
				situacao,
				partido,
				partido_obs,
				obs
				FROM vereadores_vereancas
				WHERE id_vereador = ?
				AND data_ini BETWEEN '2008-12-31' AND '2013-01-01'
				ORDER BY data_ini
				";
		$stmt = $this->dataBase->conn->execute($query,$id);
		if (!$stmt){
			var_dump($id);
			print $this->dataBase->conn->ErrorMsg();
		}
		else {
			while ($l = $stmt->FetchRow()) {
				$objbean = new app_exporter_bean_db_VereadoresVereancas();
				$objbean->id = $l['id'];
				$objbean->id_vereador = $l['id_vereador'];
				$objbean->id_vereador_anterior = $l['id_vereador_anterior'];
				$objbean->setDataIni($l['data_ini']);
				$objbean->setDatafim($l['data_fim']);
				$objbean->situacao = $l['situacao'];
				$objbean->partido = $l['partido'];
				$objbean->partido_obs = $l['partido_obs'];
				$objbean->obs = $l['obs'];
				$lista[] = $objbean;
			}
		}
		return $lista;
	}
}
