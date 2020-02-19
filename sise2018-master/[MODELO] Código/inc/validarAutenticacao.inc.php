<?php
	// Se o usuário não estiver logado ou se o mesmo estiver desativado, força o usuário a efetuar login.
	if(!isset($_SESSION['status']) || $_SESSION['status'] == 0){
		header("Location: login");
		exit();
	}
?>