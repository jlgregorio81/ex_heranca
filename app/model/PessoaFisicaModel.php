<?php
namespace app\model;

class PessoaFisicaModel extends PessoaModel{

    private $sexo;
    private $rg;
    private $cpf;

    public function __construct($id = null, $nome = null, $sexo = null, $rg = null, $cpf = null)
    {
        parent::__construct($id,$nome);
        $this->sexo = $sexo;
        $this->rg = $rg;
        $this->cpf = $cpf;
    }

    public function getSexo()
    {
        return $this->sexo;
    }
 
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

    public function getRg()
    {
        return $this->rg;
    }

    public function setRg($rg)
    {
        $this->rg = $rg;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }


}