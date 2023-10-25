                <div class="row border-bottom">
                    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                        <div class="navbar-header">
                            <div class="navbar-minimalize minimalize-styl-2 btn btn-primary" data-state="<?php echo $navigation_state; ?>"><i class="fa fa-bars"></i> </div>
                        </div>
                        <ul class="nav navbar-top-links navbar-right">
                            <?php if (array($token_session_data_user) && !empty($token_session_data_user["id_user"])) { ?>
                                <?php if (!empty($_have_alerts)) {  ?>
                                    <li class="dropdown">
                                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#" aria-expanded="false">
                                            <i class="fa fa-bell"></i> <span class="label label-primary"><?php if (!empty($_private_alerts_total)) {
                                                                                                                echo $_private_alerts_total;
                                                                                                            } ?></span>
                                        </a>
                                        <?php if (!empty($_private_alerts)) {
                                            echo $_private_alerts;
                                        } ?>
                                    </li>
                                <?php } ?>
                                <li>
                                    <span class="block m-t-xs font-bold"><?php echo $token_session_data_user["first_name"]; ?></span>
                                </li>

                                <li>
                                    <div class="dropdown user">
                                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                            <img alt="image" class="rounded-circle" src="<?php echo $_user_image; ?>" /> <b class="caret"></b>
                                        </a>
                                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                            <!-- <li><a class="dropdown-item" href="profesionales-dashboard.php?id_user=<?php echo $token_session_data_user['id_user']; ?>">&nbsp;<i class="fa fa-user-circle-o"></i> Perfil</a></li> -->
                                            <!-- <li class="divider"></li> -->
                                            <li><a class="dropdown-item" href="perfil.php">&nbsp;<i class="fa fa-pencil-square-o"></i> Editar Perfil</a></li>
                                            <li class="divider"></li>
                                            <li><a class="dropdown-item" href="logout.php">&nbsp;<i class="fa fa-sign-out"></i> Cerrar Sesión</a></li>
                                        </ul>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>

                    </nav>
                </div>