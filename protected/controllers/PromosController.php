<?php

class PromosController extends Controller
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
				'actions'=>array('index','view', 'getpromoupdate', 'getPromos'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('*'),
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
		$model=$this->loadModel($id);

		setrawcookie("MIB-REFERER", $_SERVER["REQUEST_URI"], 0, "/");

		$modelStudents = new Students('search');
		$modelStudents->attributes = array('idschools' => $model->idschools, 'idyears' => $model->idyears, 'iddivision' => $model->iddivision, 'idshifts' => $model->idshifts);


		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Promos']))
		{
			$model->attributes=$_POST['Promos'];
			$tmpfile = CUploadedFile::getInstance($model,'image_promo');
			if($tmpfile){
				$tmpfile_contents = file_get_contents( $tmpfile->tempName );
				$model->image_promo = 'data:'.$tmpfile->type.";base64,".base64_encode($tmpfile_contents);
			}
			if($model->save())
				$this->redirect(array('/schools/update/'.$model->idschools));
		}

		$this->render('update',array(
			'model'=>$model,
			'modelStudents' => $modelStudents
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Promos;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Promos']))
		{
			
			$model->attributes=$_POST['Promos'];
			$model->date_contract = Utils::format_date($_POST['Promos']['date_contract'], 'en');
			$model->date_delivery = Utils::format_date($_POST['Promos']['date_delivery'], 'en');
			$tmpfile = CUploadedFile::getInstance($model,'image_promo');
			if($tmpfile){
				$tmpfile_contents = file_get_contents( $tmpfile->tempName );
				$model->image_promo = 'data:'.$tmpfile->type.";base64,".base64_encode($tmpfile_contents);
			}
			// var_dump($model->image_promo);die;
			if($model->save())
				$this->redirect(array('/students/create/'.$model->idpromos));
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

		if(isset($_POST['Promos']))
		{
			$model->attributes=$_POST['Promos'];
			$model->date_delivery = $_POST['Promos']['date_delivery'] ? Utils::format_date($_POST['Promos']['date_delivery'], 'en') : '';
			$model->date_contract = $_POST['Promos']['date_contract'] ? Utils::format_date($_POST['Promos']['date_contract'], 'en') : '';
			$tmpfile = CUploadedFile::getInstance($model,'image_promo');
			if($tmpfile){
				$tmpfile_contents = file_get_contents( $tmpfile->tempName );
				$model->image_promo = 'data:'.$tmpfile->type.";base64,".base64_encode($tmpfile_contents);
			}
			if($model->save())
				$this->redirect(array('/schools/update/'.$model->idschools));
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
		$dataProvider=new CActiveDataProvider('Promos');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Promos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Promos']))
			$model->attributes=$_GET['Promos'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionGetPromoUpdate()
	{
		if($_POST['q']){
			$model=$this->loadModel($_POST['q']);
			$model->date_delivery = $model->date_delivery ? Utils::format_date($model->date_delivery, 'es') : '';
			$model->date_contract = $model->date_contract ? Utils::format_date($model->date_contract, 'es') : '';
			echo json_encode($model->attributes);
		}
	}

	public function actionGetPromos()
	{
		if(isset($_POST['q'])){
			$request = json_decode($_POST['q']);
			$select = "SELECT ";
			$field = "promos.*, years.year, divisions.division, shifts.shift ";
			$from = "FROM ";
			$table = "promos, years, divisions, shifts ";
			$where = "WHERE ";

			// $query = "SELECT promos.*, years.year, divisions.division, shifts.shift FROM promos, years, divisions, shifts WHERE ";
			if($request->idschools != '0'){
				$field_validate = " promos.idschools = $request->idschools AND promos.idyears = years.idyears AND promos.iddivision = divisions.iddivision AND promos.idshifts = shifts.idshifts";
			}

			if($request->idyears != '0'){
				// $field .= ", years.year ";
				// $table .= ", years ";
				$field_validate .= " AND promos.idyears = $request->idyears ";
			}

			if($request->iddivision != '0'){
				// $field .= ", divisions.division ";
				// $table .= ", divisions ";
				$field_validate .= " AND promos.iddivision = $request->iddivision ";
			}

			if($request->idshifts != '0'){
				// $field .= ", shifts.shift ";
				// $table .= ", shifts ";
				$field_validate .= " AND promos.idshifts = $request->idshifts ";
			}

			$query = "$select $field $from $table $where $field_validate";
			// echo $query;die;

			$data = Yii::app()->db->createCommand($query)->queryAll();

			$result = array();

			if(count($data)>0){
				foreach($data as $key => $items){
					$result['promo'][$key] = array('id' => $items['year_promo'], 'text' => $items['year_promo']);
					$result['curso'][$key] = array('id' => $items['idyears'], 'text' => $items['year']);
					$result['division'][$key] = array('id' => $items['iddivision'], 'text' => $items['division']);
					$result['turno'][$key] = array('id' => $items['idshifts'], 'text' => $items['shift']);
				}

				$r_promo['promo'] = Utils::unique_multidim_array($result['promo'], 'id');
				$r_curso['curso'] = Utils::unique_multidim_array($result['curso'], 'id');
				$r_division['division'] = Utils::unique_multidim_array($result['division'], 'id');
				$r_turno['turno'] = Utils::unique_multidim_array($result['turno'], 'id');

				$result = array(array_merge($r_promo, $r_curso, $r_division, $r_turno));
			}
			echo json_encode($result);

		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Promos the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Promos::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Promos $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='promos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
