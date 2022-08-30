<?php

class StudentsController extends Controller
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
				'actions'=>array('index','view', 'getstudents', 'getstudent'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>Yii::app()->user->getRules(),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
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
	public function actionCreate($id = null)
	{
		$model=new Students;
		$model_tutor = new Tutores;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_GET['id'])){
			$promo = Promos::model()->findByPk($_GET['id']);
			$model->idschools = $promo->idschools;
			$model->idyears = $promo->idyears;
			$model->iddivision = $promo->iddivision;
			$model->idshifts = $promo->idshifts;
			$model->graduation_year = $promo->year_promo;
		}
		if(isset($_POST['Students']) && isset($_POST['Tutores']))
		{	
			$model->attributes=$_POST['Students'];
			$model_tutor = Tutores::model()->find('ci=:ci', array(':ci'=>$_POST['Tutores']['ci']));
			if($model_tutor){
				$model->idtutores = $model_tutor->idtutores;
				if($model->save()){
					Yii::app()->user->setFlash('success', 'ok');
					Yii::app()->user->setFlash('redirect', '/orders/create/'.$model->idstudents);
					$this->redirect(array('/students'));
					// $this->redirect(array('/orders/create/'.$model->idstudents));
				}
			}else{
				$model_tutor = new Tutores;
				$model_tutor->attributes = $_POST['Tutores'];
				if($model_tutor->save()){
					$model->idtutores = $model_tutor->idtutores;
					if($model->save()){
						Yii::app()->user->setFlash('success', 'ok');
						Yii::app()->user->setFlash('redirect', '/orders/create/'.$model->idstudents);
						$this->redirect(array('/students'));
						// $this->redirect(array('/orders/create/'.$model->idstudents));
					}
				}
			}
			
		}

		$this->render('create',array(
			'model'=>$model,
			'model_tutor'=>$model_tutor
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
		$model_tutor = Tutores::model()->findByPk($model->idtutores);

		if(!$model_tutor){
			$model_tutor = new Tutores;
		}
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Students']) && isset($_POST['Tutores']))
		{
			$model->attributes=$_POST['Students'];

			$model_tutor = Tutores::model()->find('ci=:ci', array(':ci'=>$_POST['Tutores']['ci']));
			if($model_tutor){
				$model->idtutores = $model_tutor->idtutores;
			}else{
				$model_tutor->attributes = $_POST['Tutores'];
			}
			if($model_tutor->save()){
				if($model->save()){
					$validateOrder = Orders::model()->find('idstudents=:idstudents', array(':idstudents'=>$model->idstudents));
					if($validateOrder){
						$this->redirect(array('/orders/update/'.$validateOrder->idorders));
					}else{
						$this->redirect(array('/orders/create/'.$model->idstudents));
					}

				}
			}
		}

		$this->render('update',array(
			'model'=>$model,
			'model_tutor' => $model_tutor
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
		$dataProvider=new CActiveDataProvider('Students');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		setrawcookie("MIB-REFERER", $_SERVER["REQUEST_URI"], 0, "/");

		$model=new Students('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Students']))
			$model->attributes=$_GET['Students'];
		
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionGetStudents() 
	{
		if($_POST['q']){
			// $response = Students::model()->findAll('ci=:ci', array(':ci'=>$_POST['q']));
			
			$data = array();
			$query = "SELECT 
						students.idstudents, 
						students.name, 
						students.surname, 
						schools.name as school,
						schools.city,
						years.year, 
						shifts.shift, 
						divisions.division, 
						promos.* FROM students, promos, schools, years, shifts, divisions WHERE
						promos.idschools = schools.idschools
						AND promos.year_promo = students.graduation_year 
						AND promos.idyears = years.idyears 
						AND promos.iddivision = divisions.iddivision 
						AND promos.idshifts = shifts.idshifts 
						AND students.idschools = promos.idschools 
						AND students.idyears = promos.idyears 
						AND students.iddivision = promos.iddivision 
						AND students.idshifts = promos.idshifts 
						AND students.ci = ".$_POST['q'];
			$data = Yii::app()->db->createCommand($query)->queryAll();
			$responseOrder = Orders::model()->count("idstudents=:idstudents", array(":idstudents" => $data[0]['idstudents']));
			// echo "<pre>";
			// print_r($responseOrder);die;
			if($responseOrder == '0'){
				if(count($data)>0){
					$data[0]['date_delivery'] = Utils::format_date($data[0]['date_delivery'], 'es');
				}
			// }else{
			// 	$data = array();
			}
			echo json_encode($data);
		}
	}

	public function actionGetStudent()
	{
		echo "aqui";die;
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Students the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Students::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Students $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='students-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
