<?php

class TicketsController extends Controller
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
			'postOnly + delete', // we only allow deletion via POST request
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
				'actions'=>array('print'),
				'users'=>array('*'),
			),
			array('allow',
				'actions' => array('getcollection'),
				'users' => array('@'),
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
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
	public function actionCreate()
	{
		$model=new Tickets;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Tickets']))
		{
			// echo "<pre>";
			// print_r($_POST['Tickets']);die;
			$model->attributes=$_POST['Tickets'];
			$model->date = Utils::format_date($_POST['Tickets']['date'], 'en');
			$model->saldo = $_POST['Tickets']['saldo'] ? Utils::format_price($_POST['Tickets']['saldo'], true) : 0.00;
			$model->idusers = Yii::app()->user->id;
			$model->amount = $_POST['Tickets']['amount'] ? Utils::format_price($_POST['Tickets']['amount'], true) : 0.00;

			if($model->save()){
				$order = Orders::model()->find("idorders=:idorders", array(":idorders"=>$model->idorders));
				$arr = explode(",", $model->dues);
				$lastDue = array_pop($arr);

				switch(Utils::calculatePercentDue($lastDue, $order->dues)){
					case "50":
						if($order->status == 'Pedido' || $order->status == '0'){
							$order->status = 'Producción';
							$order->save();
						}
					break;
					case "100":
						if($order->status == 'Proceso'){
							$order->status = "Terminado";
							$order->save();
						}
					break;
				}

				Yii::app()->user->setFlash('success', 'ok');
				Yii::app()->user->setFlash('redirect', '/tickets/print/'.$model->idtickets);

				// if($order->dues === $ticket){
				// 	$this->redirect(array('/tickets')); //ver si redirecciono a algun lado una vez cancelado todo
				// }else{
					$this->redirect(array('/tickets'));
				// }
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

		if(isset($_POST['Tickets']))
		{
			$model->attributes=$_POST['Tickets'];
			$model->idusers = Yii::app()->user->id;
			$model->amount = $_POST['Tickets']['amount'] ? Utils::format_price($_POST['Tickets']['amount'], true) : 0.00;

			if($model->save())
				$this->redirect(array('view','id'=>$model->idtickets));
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
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Tickets');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Tickets('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Tickets']))
			$model->attributes=$_GET['Tickets'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionPrint($id){

		$this->layout = 'print';
		
		$model = $this->loadModel($id);
		$modelOrder = Orders::model()->findByPk($model->idorders);
		$modelStudent = Students::model()->findByPk($modelOrder->idstudents);
		$modelTutor = Tutores::model()->findByPk($modelStudent->idtutores);
		$this->render('print',array(
			'model'=>$model,
			'modelOrder'=>$modelOrder,
			'modelStudent'=>$modelStudent,
			'modelTutor'=>$modelTutor
		));
	}

	public function actionGetCollection() {
		$data = array();
		
		if(isset($_POST) && isset($_POST['d']) && isset($_POST['h'])){
			$desde = $_POST['d'];
			$hasta = $_POST['h'];

			$query = "SELECT SUM(tickets.amount) as amount, branch_offices.office FROM tickets, users, branch_offices WHERE tickets.idusers = users.idusers AND users.idbranch_offices = branch_offices.idbranch_offices AND tickets.date BETWEEN '".$desde."' AND '".$hasta."' GROUP BY branch_offices.idbranch_offices";

			$response = Yii::app()->db->createCommand($query)->queryAll();

			$queryU = "SELECT SUM(tickets.amount) as amount, users.name, users.surname, roles.type FROM tickets, users, roles WHERE tickets.idusers = users.idusers AND users.roles_idroles = roles.idroles AND tickets.date BETWEEN '".$desde."' AND '".$hasta."' GROUP BY users.idusers";

			$responseU = Yii::app()->db->createCommand($queryU)->queryAll();

			foreach($response as $i => $value){
				$data['office'][$i]['label'] = $value['office'];
				$data['office'][$i]['value'] = floatval($value['amount']);
			}

			foreach ($responseU as $i => $value) {
				$data['seller'][$i]['label'] = $value['name'].' '.$value['surname'].' ('.$value['type'].')';
				$data['seller'][$i]['value'] = floatval($value['amount']);
			}
		}
		echo json_encode($data);

	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Tickets the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Tickets::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Tickets $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tickets-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
