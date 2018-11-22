<?php

use app\model\PessoaFisicaModel;
use app\dao\PessoaFisicaDao;

require_once('autoload.php');

 //inserir pessoa_fisica
 /*
try {
    $pf = new PessoaFisicaModel(null, 'Pati', 'F', '923', '777');
    $pfDao = new PessoaFisicaDao($pf);
    $pfDao->insertUpdate();
} catch (Exception $ex) {
    echo "<p><strong>Erro:</strong>: {$ex->getMessage()}</p>";
}
*/

//..recuperar por id
//$pf = (new PessoaFisicaDao())->findById(4);
//var_dump($pf);

//..excluir
//(new PessoaFisicaDao())->delete(4);

//..listar
$data = (new PessoaFisicaDao())->selectAll();
var_dump($data);