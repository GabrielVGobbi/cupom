<?php

class ClientesController extends controller
{

    public function __construct()
    {
        parent::__construct();

        $this->user = new Users();
        $this->user->setLoggedUser();

        $this->id_company = $this->user->getCompany();

        if ($this->user->isLogged() == false) {
            header("Location: " . BASE_URL_PAINEL . "login");
            exit();
        }

        $this->filtro = array();
        $this->cliente = new Cliente();
        $this->painel = new Painel();
        $this->permissions = new Permissions();

        $this->dataInfo = array(
            'pageController' => 'clientes',
            'nome_tabela'   => 'cliente',
            'titlePage' => 'clientes',
            'filtro' => array()
        );
    }

    public function index()
    {

        if (isset($_GET['filtros'])) {
            $this->dataInfo['filtro'] = $_GET['filtros'];
        }


        $this->dataInfo['p'] = 1;
        if (isset($_GET['p']) && !empty($_GET['p'])) {
            $this->dataInfo['p'] = intval($_GET['p']);
            if ($this->dataInfo['p'] == 0) {
                $this->dataInfo['p'] = 1;
            }
        }

        $offset = (10 * ($this->dataInfo['p'] - 1));

        $this->cliente = new Cliente($offset, $this->dataInfo['filtro'], '0', $this->user->getCompany());

        $this->dataInfo['getCount']    = $this->cliente->row;
        $this->dataInfo['p_count']     = ceil($this->dataInfo['getCount'] / 10);
        $this->dataInfo['tableDados']  = $this->cliente->clienteInfo;


        $this->loadView($this->dataInfo['pageController'] . "/index", $this->dataInfo);
    }

    public function action()
    {

        isset($_POST['EnVID']) && !empty($_POST['EnVID']) 
            ? $this->cliente->edit($_POST, $this->user->getCompany(), $this->user->getId()) 
            : $this->cliente->add($_POST, $this->user->getCompany(), $_FILES);

        header('Location:' . BASE_URL_PAINEL . $this->dataInfo['pageController']);

        exit();
    }

}
