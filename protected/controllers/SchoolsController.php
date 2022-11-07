<?php

class SchoolsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='main';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			// 'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>Yii::app()->user->getRules(),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('?'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Schools;
		$modelPromo = new Promos('search');
		$modelPromo->unsetAttributes();  // clear any default values
		$modelPromo->attributes = array('idschools' => -1);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Schools']))
		{
			$model->attributes=$_POST['Schools'];
			if($model->save()){
				Yii::app()->user->setFlash('success', 'ok');
				$this->redirect(array('/schools/update/'.$model->idschools));
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'modelPromo' => $modelPromo
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$mpromo = new Promos;
		$mpromo->idschools = $id;

		$modelPromo = new Promos('search');
		$modelPromo->attributes = array('idschools'=>$id, 'price_old'=>null);


		// echo "<pre>";
		// print_r($modelPromo);die;

		setrawcookie("MIB-REFERER", $_SERVER["REQUEST_URI"], 0, "/");

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Schools']))
		{
			$model->attributes=$_POST['Schools'];
			if($model->save()){
				Yii::app()->user->setFlash('success', 'ok');
				$this->redirect(array('/schools'));
			}
		}

		$this->render('update',array(
			'model'=>$model,
			'modelPromo' => $modelPromo,
			'mpromo' => $mpromo
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if($this->loadModel($id)->delete()){
			$data = array(
				'status' => true,
				'message' => 'success'
			);
			echo json_encode($data);
		}else{
			$data = array(
				'status' => false,
				'message' => 'error'
			);
			echo json_encode($data);
		}
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		// if(!isset($_GET['ajax']))
		// 	$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Schools');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Schools('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Schools'])){
			$model->attributes=$_GET['Schools'];
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Schools the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Schools::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Schools $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='schools-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
