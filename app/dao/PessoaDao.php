<?php
namespace app\dao;

use core\dao\Dao;
use app\model\PessoaFisicaModel;

class PessoaDao extends Dao
{

    const COL_NOME = 'nome';

    public function __construct(PessoaFisicaModel $model = null)
    {
        $this->tableName = 'pessoa';
        $this->model = is_null($model) ? new PessoaFisicaModel() : $model;
        $this->tableId = 'id';
        $this->setColumns();
    }

    public function setColumns()
    {
        $this->columns = array(
            self::COL_NOME => $this->model->getNome()
        );
    }

    public function insertUpdate($returnId = 'seq_pessoa')
    {
        return parent::insertUpdate($returnId); //..retorna o id inserido   
    }

}