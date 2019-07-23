<?php
    /**
     * Autor: Daniel Lima
     * Date: 10/03/2017
     */
?>
<header class="main-header">
    <!-- Logo -->
    <a href="home" class="logo" style="background-color: #222d32;">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><img class="img-responsive logo-img" src="imagens/sise/sise.png"></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg" style="text-align: center">
			<img class="img-responsive" style="float:none; display:block; margin-left:auto; margin-right:auto; height: 90%" src="imagens/sise/sise.png">
		</span>
    </a>

    <nav class="navbar navbar-static-top hidden-lg hidden-md hidden-sm" style="background-color: #222d32">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo 'imagens/usuarios/'.$_SESSION['foto']; ?>" class="user-image" alt="User Image">
                        <span style="font-size: 22px;"><?php echo $_SESSION['nome']; ?></span>
                    </a>
                </li>
            </ul>
        </div>

    </nav>

</header>


<aside class="main-sidebar">
    <section class="sidebar">

        <div class="user-panel hidden-xs">
            <div class="pull-left image">
                <img src="<?php echo 'imagens/usuarios/'.$_SESSION['foto']; ?>" class="img-circle" alt="Imagem" />
            </div>
            <div class="pull-left info">
                <p>
                    <?php echo utf8_encode($_SESSION['nome']); ?>
                </p>
            </div>
        </div>

        <ul class="sidebar-menu">
            <li class="header">MENU</li>
            <li class="treeview">
                <a href="home">
                    <i class="glyphicon glyphicon-home"></i><span>Home</span>
                    <span class="pull-right-container"></span>
                </a>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="glyphicon glyphicon-user"></i>
                    <span>Dados Pessoais</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                    <li><a href="usuario?action=show_edit"><i class="glyphicon glyphicon-align-left"></i> Alterar dados</a></li>
                    <li><a href="usuario?action=alterarSenha&idAlterar=2"><i class="glyphicon glyphicon-wrench"></i> Alterar senha</a></li>
                </ul>
            </li>

            <?php if (temPermissao(1)) { ?>

              <li class="treeview">
                <a href="#">
                  <i class="glyphicon glyphicon-list-alt"></i>
                  <span>Organizador</span>
                  <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                  <li><a href="evento?action=gerenciar"><i class="glyphicon glyphicon-triangle-right"></i>Eventos</a></li>
                </ul>
              </li>

            <?php } ?>

            <?php if (temPermissao(2)) { ?>

              <li class="treeview">
                <a href="#">
                  <i class="glyphicon glyphicon-sunglasses"></i>
                  <span>Administrador</span>
                  <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                  <li><a href="#"><i class="glyphicon glyphicon-triangle-right"></i> OP ADM 1</a></li>
                  <li><a href="#"><i class="glyphicon glyphicon-triangle-right"></i> OP ADM 2</a></li>
                </ul>
              </li>

            <?php } ?>

            <li class="treeview">
                <a href="detalhe?action=showInscritos">
                    <i class="glyphicon glyphicon-glass"></i>
                    <span>Meus Eventos</span>
                    <span class="pull-right-container">
                        <span class="label label-primary pull-right"><?php echo $qntEventosInscritos; ?></span>
                    </span>
                </a>
            </li>

            <!--
            <li class="treeview">
                <a href="#">
                    <i class="glyphicon glyphicon-envelope"></i> <span>Contato</span>
                    <span class="pull-right-container"></span>
                </a>
            </li>
            -->

            <li>
                <a href="login?action=logout">
                    <i class="glyphicon glyphicon-remove-circle"></i>
                    <span>Sair</span>
                    <span class="pull-right-container"></span>
                </a>
            </li>
        </ul>
    </section>
</aside>
