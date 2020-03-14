<?php
class Model
{
    //Objeto DB
    protected $db;
    //Tabela relacionada ao model
    protected $table;
    //Quantidade de linhas no retorno (afetadas)
    private $row = 0;
    //Resultado QUERY
    private $result = array();

    /**
     * Inicializa o objeto de DB a partir da conexão global
     */
    public function __construct()
    {
        $this->db = DB::getConn();
    }
    /**
     * Retorna a quantidade de linhas afetadas pela QUERY
     * @return int Quantidade de linhas
     */
    public function getRowCount()
    {
        return $this->row;
    }
    /**
     * Retorna o resultado da QUERY
     * @return array Resultado da QUERY
     */
    public function getResult()
    {
        return $this->result;
    }
    /**
     * Faz a inserção de novos dados
     * @param  array $columns Colunas que irá receber os valores ['coluna1', 'coluna2']
     * @return boolean TRUE ou FALSE
     */
    public function insert(array $columns)
    {
        if (!empty($this->table) && (is_array($columns)) && count($columns) > 0) {
            $data = array();
            foreach (array_keys($columns) as $value) {
                $data[] = ":" . ($value) . "";
            }
            $sql = "INSERT INTO " . $this->table . "(" . implode(', ', array_keys($columns)) . ") VALUES (" . implode(', ', $data) . ")";
            $sql = $this->db->prepare($sql);
            for ($i = 0; $i < count($data); $i++) {
                $sql->bindValue($data[$i], trim(addslashes(array_values($columns)[$i])));
            }
            return $sql->execute();
        }
    }

    public function insert_painel($arr, $tabela, $id_company)
    {
        $certo = true;
        $nome_tabela = $tabela;
        $parametros[] = $id_company;


        foreach ($arr as $key => $value) {
            $nome_coluna[] = '`' . $key . '`';
        }

        $params = implode(',', $nome_coluna);

        $query = "INSERT INTO `$nome_tabela` (`id_company`,$params) VALUES (?";

        foreach ($arr as $key => $value) {
            $nome = $key;
            $valor = $value;
            if ($nome == 'id')
                continue;
            if ($value == '') {
                $certo = false;
                break;
            }
            $query .=  ",?";
            $parametros[] .= ($value);
        }

        $query .= ")";

        if ($certo == true) {
            $sql = $this->db->prepare($query);
            if ($sql->execute($parametros)) {
                return $this->retorno = 'sucess';
            } else {
                return $this->retorno = 'error';
            }
        }
    }
    /**
     * Atualiza dados
     * @param  array $columns     Colunas a serem alteradas
     * @param  array  $where      Cláusula WHERE ['id' => 1, 'name' => 'test']
     * @param  string $where_cond Condição da cláusula WHERE
     * @return boolean TRUE ou FALSE
     */
    public function update($columns, $where = array(), $where_cond = 'AND')
    {

        if (!empty($this->table) && count($columns) > 0) {
            $update = array();
            foreach ($columns as $key => $value) {
                $update[] = $key . ' = ' . ':' . $key;
            }
            $sql = "UPDATE " . $this->table . " SET " . implode(', ', $update);
            if (count($where) > 0) {
                $data = array();
                foreach ($where as $key => $value) {
                    $data[] = $key . ' = ' . ":" . $key;
                }
                $sql .= " WHERE " . implode(' ' . $where_cond . ' ', $data);
            }
            $sql = $this->db->prepare($sql);
            for ($i = 0; $i < count($update); $i++) {
                $sql->bindValue(':' . array_keys($columns)[$i], trim(addslashes(array_values($columns)[$i])));
            }
            for ($j = 0; $j < count($data); $j++) {
                $sql->bindValue(':' . array_keys($where)[$j], trim(addslashes(array_values($where)[$j])));
            }
            return $sql->execute();
        }
    }

    public function editPainel($arr, $nome_tabela, $id_company, $single = false, $WhereId = false)
    {
        $certo = true;
        $first = false;

        $arr['id'] = $WhereId;



        if ($WhereId)
            $query = "UPDATE `$nome_tabela` SET ";
        foreach ($arr as $key => $value) {
            $nome = $key;
            $valor = $value;

            if (
                $nome == 'acao'
                || $nome == 'nome_tabela' || $nome == 'id' || $value == ''
                || $nome == 'type'
                || $nome == 'EnVID'
            )
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
                $sql = $this->db->prepare($query . ' WHERE ' . $arr['type'] . '=?');

                $sql->execute($parametros);
            } else {
                $sql = $this->db->prepare($query);
                $sql->execute($parametros);
            }
        }
        return $WhereId;
    }

    /**
     * Seleciona dados
     * @param  mixed $columns     Colunas a serem selecionadas
     * @param  array  $where      Cláusula WHERE ['id' => 1, 'name' => 'test']
     * @param  string $where_cond Condição da cláusula WHERE
     */
    public function select($columns = '*',  $where = array(),  $where_cond = 'AND')
    {
        if (!empty($this->table)) {
            if (is_array($columns) && count($columns) > 0) {
                $columns = implode(", ", $columns);
            } else {
                $columns = '*';
            }
            $sql = "SELECT " . ($columns) . " FROM " . $this->table;
            $data = array();
            if (count($where) > 0) {
                foreach ($where as $key => $value) {
                    $data[] = $key . ' = ' . ":" . $key;
                }
                $sql .= " WHERE " . implode(' ' . $where_cond . ' ', $data);
            }
            $sql = $this->db->prepare($sql);
            for ($j = 0; $j < count($data); $j++) {
                $sql->bindValue(':' . array_keys($where)[$j], trim(addslashes(array_values($where)[$j])));
            }
            $sql->execute();
            $this->row = $sql->rowCount();
            $this->result = $sql->fetchAll();
        }
    }
    /**
     * Conta os registros da tabela
     * @param  string $column Coluna para contagem
     */
    public function count($column = 'id')
    {
        $sql = $this->db->query("SELECT $column FROM " . $this->table);
        return $sql->rowCount();
    }
}
