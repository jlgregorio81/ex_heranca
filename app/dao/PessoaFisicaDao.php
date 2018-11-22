<?php
namespace app\dao;

use app\model\PessoaFisicaModel;
use core\dao\Dao;
use core\dao\SqlObject;
use core\dao\Connection;

class PessoaFisicaDao extends Dao
{
    //..pessoa
    const COL_NOME = 'nome';
    //..pessoa física
    const COL_ID = 'id';
    const COL_SEXO = 'sexo';
    const COL_RG = 'rg';
    const COL_CPF = 'cpf';


    private static $table; //..outro atributo de tabela - devido a herança.

    public function __construct(PessoaFisicaModel $model = null)
    {
        $this->model = is_null($model) ? new PessoaFisicaModel() : $model;
        $this->tableName = 'pessoa_fisica';
        $this->tableId = 'id';
        $this->setColumns();
    }

    public function setColumns($id = null)
    {
        $this->columns = array(
            self::COL_SEXO => $this->model->getSexo(),
            self::COL_RG => $this->model->getRg(),
            self::COL_CPF => $this->model->getCpf()
        );
    }

    public function insertUpdate($returnId = null)
    {
        try {
            //..insere primeira a pessoa e pega o id
            $id = (new PessoaDao($this->model))->insertUpdate();
            //..seta o id retornado no model 
            $this->columns[self::COL_ID] = $id;
            //..persiste no banco de dados
            parent::insertUpdate();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function findById($id)
    {
        try {
            $sqlObj = new SqlObject(Connection::getConnection());
            $data = $sqlObj->select("pessoa p, pessoa_fisica pf", "*", "p.id = pf.id and p.id = {$id}");
            return is_null($data) ? null : $this->makeObjectFromData($data[0]);
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function delete($id)
    {
        try {
            parent::delete($id); //..exclui da pessoa_fisica
            (new PessoaDao())->delete($id); //..exclui da pessoa
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function selectAll($criteria = null, $orderBy = null, $groupBy = null, $limit = null, $offSet = null)
    {
        try {
            $sqlObj = new SqlObject(Connection::getConnection());            
            $cri = "p.id = pf.id ";
            if($criteria){ //..se tiver criterio de pesquisa, então adiciona o criterio
                $cri .= " and $criteria";
            }
            $data = $sqlObj->select("pessoa p, pessoa_fisica pf", "*", $cri, $orderBy, $groupBy, $limit, $offSet);
            $arrayObj = new \ArrayObject();
            if ($data){
                foreach ($data as $pf)
                    $arrayObj->append($this->makeObjectFromData($pf));
                return $arrayObj;
            }
            else
                return null;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Retorna um objeto model a partir de um array, geralmente retornado do BD
     */
    public function makeObjectFromData($data)
    {
        return new PessoaFisicaModel(
            $data[self::COL_ID],
            $data[self::COL_NOME],
            $data[self::COL_SEXO],
            $data[self::COL_RG]
        );
    }



}