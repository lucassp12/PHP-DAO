<?php
require_once("config.php");
//Carrega um usuario
//$root = new Usuario();
//$root->loadById(39);
//echo $root;

//Carrega uma lista de usuarios
//$lista = Usuario::getList();
//echo json_encode($lista);

//Carrega uma lista de usuarios buscando pelo login
//$search = Usuario::search("");
//echo json_encode($search);

//Carrega um usuário usando o login e senha
//$usuario = new Usuario();
//$usuario->login("root","$#@$");
//echo $usuario;

//Insert
//$aluno = new Usuario("aluno", "123");;
//$aluno->insert();
//echo $aluno;

//update
//$usuario = new Usuario();
//$usuario->loadById(37);
//$usuario->update("professor", "123");
//cho $usuario;

//Delete
$usuario = new Usuario();

$usuario->loadById(38);

$usuario->delete();

echo $usuario;

?>