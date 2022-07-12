<div class="mdl-layout__drawer">
    <header>MIB</header>
    <div class="scroll__wrapper" id="scroll__wrapper">
        <div class="scroller" id="scroller">
            <div class="scroll__container" id="scroll__container">
                <nav class="mdl-navigation">
                    <a class="mdl-navigation__link mdl-navigation__link--current" href="<?= Yii::app()->baseUrl; ?>">
                        <i class="material-icons" role="presentation">dashboard</i>
                        Dashboard
                    </a>
                    <a class="mdl-navigation__link" href="<?= Yii::app()->baseUrl; ?>/schools/admin">
                        <i class="material-icons">school</i>
                        Escuelas
                    </a>
                    <a class="mdl-navigation__link" href="<?= Yii::app()->baseUrl; ?>/students/admin">
                        <i class="material-icons" role="presentation">person</i>
                        Estudiantes
                    </a>
                    <a class="mdl-navigation__link" href="<?= Yii::app()->baseUrl; ?>/tickets">
                        <i class="material-icons" role="presentation">payment</i>
                        Facturación
                    </a>
                    <!-- <a class="mdl-navigation__link" href="<?= Yii::app()->baseUrl; ?>">
                        <i class="material-icons">multiline_chart</i>
                        Estadísticas
                    </a> -->
                    <!-- <a class="mdl-navigation__link" href="<?= Yii::app()->baseUrl; ?>">
                        <i class="material-icons" role="presentation">supervisor_account</i>
                        Proveedores
                    </a> -->
                    <div class="sub-navigation">
                        <a class="mdl-navigation__link">
                            <i class="material-icons">settings</i>
                            Configuración
                            <i class="material-icons">keyboard_arrow_down</i>
                        </a>
                        <div class="mdl-navigation">
                            <a class="mdl-navigation__link" href="<?= Yii::app()->baseUrl; ?>/users/admin">
                                Usuarios
                            </a>
                        </div>
                        <div class="mdl-navigation">
                            <a class="mdl-navigation__link" href="<?= Yii::app()->baseUrl; ?>/products/admin">
                                Productos
                            </a>
                        </div>
                        <div class="mdl-navigation">
                            <a class="mdl-navigation__link" href="<?= Yii::app()->baseUrl; ?>/schools-settings">
                                Escuelas
                            </a>
                        </div>
                        <div class="mdl-navigation">
                            <a class="mdl-navigation__link" href="<?= Yii::app()->baseUrl; ?>/more-settings">
                                Más configuraciones
                            </a>
                        </div>
                    </div>
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