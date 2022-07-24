<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableAjaxValidation'=>true,
)); ?>

	<div class="mdl-layout mdl-js-layout color--gray is-small-screen login">
	    <main class="mdl-layout__content">
	        <div class="mdl-card mdl-card__login mdl-shadow--2dp">
	            <div class="mdl-card__supporting-text color--dark-gray">
	                <div class="mdl-grid">
	                    <div class="mdl-cell mdl-cell--12-col mdl-cell--4-col-phone">
                            <span class="mdl-card__title-text text-color--smooth-gray">MIB Indumentaria</span>
                        </div>
                        <div class="mdl-cell mdl-cell--12-col mdl-cell--4-col-phone">
                            <span class="login-name text-color--white">Acceso</span>
                            <span class="login-secondary-text text-color--smoke">Ingrese sus datos para ingresar</span>
                        </div>
	                    <div class="mdl-cell mdl-cell--12-col mdl-cell--4-col-phone">
	                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
	                            <?php echo $form->labelEx($model,'user', array('class'=>'mdl-textfield__label ')); ?>
								<?php echo $form->textField($model,'user',array('class'=>'mdl-textfield__input')); ?>
								<?php echo $form->error($model,'user'); ?>
	                        </div>
	                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
	                            <?php echo $form->labelEx($model,'password', array('class'=>'mdl-textfield__label ')); ?>
								<?php echo $form->passwordField($model,'password',array('class'=>'mdl-textfield__input')); ?>
								<?php echo $form->error($model,'password'); ?>
	                        </div>
	                        <!-- <a href="forgot-password.html" class="login-link">Forgot password?</a> -->
	                    </div>
	                    <div class="mdl-cell mdl-cell--12-col mdl-cell--4-col-phone submit-cell">
	                        <!-- <a href="sign-up.html" class="login-link">Don't have account?</a> -->
	                        <div class="mdl-layout-spacer"></div>
	                        <a href="index.html">
	                        	<?php echo CHtml::submitButton('Entrar', array('class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button--colored-orange')); ?>
	                        </a>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </main>
	</div>

<?php $this->endWidget(); ?>

