<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="SYSITAC - Sistema de Controle de Ativos de TI">
		<meta name="author" content="Departamento de Sistemas de Informação, DSI, DSIITA">
		<meta name="keyword" content="SYSITAC, Sistema de Controle de Ativos de TI, DSI, Gerenciamento de Ativos de TI, Ativos de TI">
		<link rel="shortcut icon" href="img/favicon.png">

		<title>Login</title>

		<!-- Bootstrap CSS -->
		<link href="Web/View/Layout/css/bootstrap.min.css" rel="stylesheet">
		<!-- bootstrap theme -->
		<link href="Web/View/Layout/css/bootstrap-theme.css" rel="stylesheet">
		<!--external css-->
		<!-- font icon -->
		<link href="Web/View/Layout/css/elegant-icons-style.css" rel="stylesheet" />
		<link href="Web/View/Layout/css/font-awesome.css" rel="stylesheet" />
		<!-- Custom styles -->
		<link href="Web/View/Layout/css/style.css" rel="stylesheet">
		<link href="Web/View/Layout/css/style-responsive.css" rel="stylesheet" />

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
		<!--[if lt IE 9]>
		<script src="js/html5shiv.js"></script>
		<script src="js/respond.min.js"></script>
		<![endif]-->
	</head>
	<body class="login-img3-body">
		<div class="container">
			<form id="form_login" name="form_login" class="login-form" action="login" method="POST">
				<div class="login-wrap">
					<p class="login-img"><i class="icon_lock_alt"></i></p>
					<div class="input-group">
						<span class="input-group-addon"><i class="icon_profile"></i></span>
                                                <input id="login" type="text" pattern="\id{11}" value="<?php if($erro) echo $cpf;?>" name="login" class="form-control" required maxlength="11" placeholder="CPF" autofocus>
					</div>
					<div class="input-group">
						<span class="input-group-addon"><i class="icon_key_alt"></i></span>
						<input id="senha" type="password" name="senha" required class="form-control" maxlength="12" placeholder="Senha">
					</div>
					<label class="checkbox">
						<input type="checkbox" value="remember-me"> Lembrar-me
						<span class="pull-right"><a href="?action=show_rec_senha"> Esqueci minha senha</a></span>
					</label>
					<input type="hidden" name="action" value="autentic" >
					<button class="btn btn-info btn-lg btn-block" type="submit">Entrar</button>
					<br>
					<?php if($erro){ ?>
						<div class="panel panel-danger">
							<div class="panel-heading"><?php echo $mensagem; ?></div>
						</div>
					<?php } ?>
				</div>
			</form>
		</div>
	</body>
</html>