<?php
class Painel extends model
{

    public function __construct()
    {
        parent::__construct();
        
        $this->retorno = array();
    }

    public function editPainel($arr, $nome_tabela, $id_company, $single = false, $WhereId = false)
    {
        $certo = true;
        $first = false;
        
        $arr['id'] = $WhereId;

        if($WhereId)
            $query = "UPDATE `$nome_tabela` SET ";
            foreach ($arr as $key => $value) {
                $nome = $key;
                $valor = $value;

                if ($nome == 'acao' || $nome == 'nome_tabela' || $nome == 'id' || $value == '' || $nome == 'type')
                    continue;


                if ($first == false) {
                    $first = true;
                    $query .= "$nome=?";
                } else {
                    $query .= ",$nome=?";
                }

                $parametros[] = $value;

            }

            if ($certo == true) {
                if ($single == false) {
                    $parametros[] = $arr['id'];
                    $sql = $this->db->prepare($query . ' WHERE '.$arr['type'].'=?');

                    $sql->execute($parametros);

                } else {
                    $sql = $this->db->prepare($query);
                    $sql->execute($parametros);

                }
            }
            return $WhereId;
    }

}
