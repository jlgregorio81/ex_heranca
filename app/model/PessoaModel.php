<?php
namespace app\model;

use core\mvc\Model;

abstract class PessoaModel extends Model{

    protected $nome;

    public function __construct($id = null, $nome = null)
    {
        parent::__construct($id);
        $this->nome = $nome;
        
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }


}