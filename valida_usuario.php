<?php
	require_once("conexao.php");
	session_start();
	$login = $_POST['txtLogin'];
	$senha = $_POST['txtSenha'];

	if(empty($login)){
		$_SESSION['mensagem']="Preencha o campo Login";
		header("location: login_usuario.php");

	}else if (empty($senha)){
		$_SESSION['mensagem']="Preencha o campo Senha";
		header("location: login_usuario.php");

	}else{
		$sql = "SELECT * FROM usuario WHERE login='$login' AND senha='$senha'";
		$resultado = mysql_query($sql);
		$dados = mysql_fetch_assoc($resultado);
		
		if($dados['login'] == $login and $dados['senha'] == $senha) {
			$usuario = array("login"=>$dados['login'], "senha"=>$dados['senha'],"perfil"=>$dados['perfil']);
			$_SESSION['usuario']=$usuario;
			header("Location: telaLogin.php");
		}else{
			$_SESSION['mensagem']="Login ou Senha invalido";
			header("location: login_usuario.php");
		}
	}
?>