<?php 
namespace App\Interfaces;


abstract class DBInterfaces {
    abstract public function ConectarBanco();
    abstract public function FecharBanco();
    abstract public function ExecutarSQL($sql);
    abstract public function Consultar($dados);
}
?>