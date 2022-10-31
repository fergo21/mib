<div class="mdl-layout__drawer">
    <header>MIB</header> 
    <div class="scroll__wrapper" id="scroll__wrapper">
        <div class="scroller" id="scroller">
            <div class="scroll__container" id="scroll__container">
                <nav class="mdl-navigation">
                    <a class="mdl-navigation__link" href="<?= Yii::app()->baseUrl; ?>/">
                        <i class="material-icons" role="presentation">dashboard</i>
                        Dashboard
                    </a>
                    <?php if(Yii::app()->user->checkAccess('index', 'schools')){ ?>
                        <a class="mdl-navigation__link" href="<?= Yii::app()->baseUrl; ?>/schools/admin">
                            <i class="material-icons">school</i>
                            Escuelas
                        </a>
                    <?php } ?>
                    <?php if(Yii::app()->user->checkAccess('index', 'students')){ ?>
                        <a class="mdl-navigation__link" href="<?= Yii::app()->baseUrl; ?>/students/admin">
                            <i class="material-icons" role="presentation">person</i>
                            Estudiantes
                        </a>
                    <?php } ?>
                    <?php if(Yii::app()->user->checkAccess('index', 'tickets')){ ?>
                        <a class="mdl-navigation__link" href="<?= Yii::app()->baseUrl; ?>/tickets">
                            <i class="material-icons" role="presentation">payment</i>
                            Facturación
                        </a>
                    <?php } ?>
                    <!-- <a class="mdl-navigation__link" href="<?= Yii::app()->baseUrl; ?>">
                        <i class="material-icons">multiline_chart</i>
                        Estadísticas
                    </a> -->
                    <!-- <a class="mdl-navigation__link" href="<?= Yii::app()->baseUrl; ?>">
                        <i class="material-icons" role="presentation">supervisor_account</i>
                        Proveedores
                    </a> -->
                    <?php if(Yii::app()->user->checkView()){ ?>
                        <div class="sub-navigation">
                            <a class="mdl-navigation__link">
                                <i class="material-icons">settings</i>
                                Configuración
                                <i class="material-icons">keyboard_arrow_down</i>
                            </a>
                            <?php if(Yii::app()->user->checkAccess('index', 'users')){ ?>
                                <div class="mdl-navigation">
                                    <a class="mdl-navigation__link" href="<?= Yii::app()->baseUrl; ?>/users/admin">
                                        Usuarios
                                    </a>
                                </div>
                            <?php } ?>
                            <?php if(Yii::app()->user->checkAccess('index', 'products')){ ?>
                                <div class="mdl-navigation">
                                    <a class="mdl-navigation__link" href="<?= Yii::app()->baseUrl; ?>/products/admin">
                                        Productos
                                    </a>
                                </div>
                            <?php } ?>
                            <?php if(Yii::app()->user->checkAccess('index', 'schools-settings')){ ?>
                                <div class="mdl-navigation">
                                    <a class="mdl-navigation__link" href="<?= Yii::app()->baseUrl; ?>/schools-settings">
                                        Escuelas
                                    </a>
                                </div>
                            <?php } ?>
                            <?php if(Yii::app()->user->checkAccess('index', 'branchoffices')){ ?>
                                <div class="mdl-navigation">
                                    <a class="mdl-navigation__link" href="<?= Yii::app()->baseUrl; ?>/branchoffices/admin">
                                        Sucursales
                                    </a>
                                </div>
                            <?php } ?>
                            <?php if(Yii::app()->user->checkAccess('index', 'more-settings')){ ?>
                                <div class="mdl-navigation">
                                    <a class="mdl-navigation__link" href="<?= Yii::app()->baseUrl; ?>/more-settings">
                                        Más configuraciones
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <!-- <div class="sub-navigation">
                        <a class="mdl-navigation__link">
                            <i class="material-icons">pages</i>
                            Pages
                            <i class="material-icons">keyboard_arrow_down</i>
                        </a>
                        <div class="mdl-navigation">
                            <a class="mdl-navigation__link" href="login.html">
                                Sign in
                            </a>
                            <a class="mdl-navigation__link" href="sign-up.html">
                                Sign up
                            </a>
                            <a class="mdl-navigation__link" href="forgot-password.html">
                                Forgot password
                            </a>
                            <a class="mdl-navigation__link" href="404.html">
                                404
                            </a>
                        </div>
                    </div>
                    <div class="mdl-layout-spacer"></div>
                     -->
                </nav>
            </div>
        </div>
        <div class='scroller__bar' id="scroller__bar"></div>
    </div>
</div>