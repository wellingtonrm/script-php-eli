<?php

namespace App\Controllers;

require 'App/Controllers/DBController.php';



class Controller {

   
    
    public function getData(){
        $dados = file_get_contents("php://input");
        $json = json_decode($dados);
        return $json;
    }
    public function preDataPai($data){
        $arrPessoa = $data->pessoas;
        $this->removePessoa();
        $this->removeFilho();
        foreach($arrPessoa as $key=>$value) {
            $this->inserirPessoa($key, $value->nome);
            $arrFilhos = $value->filhos;
            foreach($arrFilhos as $keyFilho=>$valueFilho) {
            $this->inserirFilho($key, $valueFilho);
            }
        }
        $resposta = array(
            'response' => 'adiconado com sicesso',
        );
    
        echo json_encode($resposta);
    }
    public function inserirPessoa($key, $nome){
        $conex = new DBController();
        $sql = "INSERT INTO pessoa (id, nome)
        VALUES ('$key','$nome')" ;
        $execute  = $conex->createSQL($sql);
    }
    public function inserirFilho($indexPai, $nomeFilho){
        $conex = new DBController();
        $sql = "INSERT INTO filho (id_pessoa, nome)
        VALUES ('$indexPai','$nomeFilho')" ;
        $execute  = $conex->createSQL($sql);
    }

    public function removePessoa(){
        $conex = new DBController();
        $sqlFilho = "DELETE FROM pessoa" ;
        $executeFilho  = $conex->createSQL($sqlFilho);
        
    }
    public function removeFilho(){
        $conex = new DBController();
        $sqlFilho = "DELETE FROM filho" ;
        $executeFilho  = $conex->createSQL($sqlFilho);
        
    }
    public function findAll(){
        $conex = new DBController();

        $sqlPessoa = "SELECT * from pessoa";
        $executePessoa  = $conex->findSQL($sqlPessoa);

       $pessoa = array(
          'pessoas'=>[]
         ); 
         
       
        // print_r($pessoa);
        foreach($executePessoa as $key=>$value) {
            //PARA CADA PAI É CRIADO UM OBJETO NOVO
           $newPessoaNome = $value["nome"];
           $pessoaObject = (object) array(
             "nome"=> $newPessoaNome,
             "filhos" => array(),
           );
           array_push($pessoa["pessoas"], $pessoaObject);
           //PARA CADA PESSOA BUSCAREMOS DADOS PELO ID NO MYSQL
            $sqlFilho = "SELECT * from filho";
            $executeFilho  = $conex->findSQL($sqlFilho);


            if(count($executeFilho) > 0){
                foreach($executeFilho as $keyFilho=>$valueFilho) {

                    switch ($valueFilho["id_pessoa"] == $value["id"]) {
    
                    case true:
                        array_push($pessoaObject->filhos, $valueFilho["nome"]);
                    
                }
            
            } 

          
            
        }
        }
        //header('Content-type: application/json');
        echo json_encode($pessoa);
        
    }
    
}

?>