<?php

class YearsController extends Controller
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
			//'postOnly + delete', // we only allow deletion via POST request
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
		$model=new Years;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Years']))
		{
			$model->attributes=$_POST['Years'];
			if($model->save()){
				$this->redirect(array('/schools-settings'));
			}
		}

		$this->render('create',array(
			'model'=>$model,
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Years']))
		{
			$model->attributes=$_POST['Years'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->idyears));
		}

		$this->render('update',array(
			'model'=>$model,
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
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new Years('search');
		$model->unsetAttributes();  // clear any default values
		
		$model_division = new Divisions('search');
		$model_division->unsetAttributes();  // clear any default values

		if(isset($_GET['Years']))
			$model->attributes=$_GET['Years'];

		if(isset($_GET['Divisions']))
			$model_division->attributes=$_GET['Divisions'];

		$this->render('index',array(
			'model'=>$model,
			'model_division'=>$model_division
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Years('search');
		$model->unsetAttributes();  // clear any default values
		// if(isset($_GET['Years']))
		// 	$model->attributes=$_GET['Years'];

		$this->render('admin',array(
			'model'=>$model
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Years the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Years::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Years $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='years-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
