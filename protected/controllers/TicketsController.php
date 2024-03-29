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
				'actions' => array('getcollection', 'getticket', 'cancel', 'getaccounts'),
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
				Yii::app()->user->setFlash('redirect', 'ok');
				Yii::app()->user->setFlash('print', '/tickets/print/'.$model->idtickets);

				// if($order->dues === $ticket){
				// 	$this->redirect(array('/tickets')); //ver si redirecciono a algun lado una vez cancelado todo
				// }else{
					$this->redirect(array('/tickets'));
				// }
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'isPresupuesto'=>false
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

	public function actionCancel($id='')
	{
		
		$model = new Tickets;
		if(isset($_GET['id'])){
			$model = $this->loadModel($_GET['id']);
		}
		if(isset($_POST['Tickets'])){
			$model=$this->loadModel($_POST['Tickets']['idtickets']);
			$model->attributes = $_POST['Tickets'];
			$model->canceled = 1;

			if($model->save()){
				Yii::app()->user->setFlash('success', 'ok');
				$this->redirect(array('/tickets/admin'));
			}
		}

		$this->render('cancel',array(
			'model'=>$model,
		));
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
		$model = new Tutores('search');
		$model->unsetAttributes();

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
		$modelUser = Users::model()->findByPk($model->idusers);
		$this->render('print',array(
			'model'=>$model,
			'modelOrder'=>$modelOrder,
			'modelStudent'=>$modelStudent,
			'modelTutor'=>$modelTutor,
			'modelUser'=>$modelUser
		));
	}

	public function actionGetCollection() {
		$data = array();
		
		if(isset($_POST) && isset($_POST['d']) && isset($_POST['h'])){
			$desde = $_POST['d'];
			$hasta = $_POST['h'];

			$query = "SELECT SUM(tickets.paid) as paid, branch_offices.office FROM tickets, users, branch_offices WHERE tickets.idusers = users.idusers AND users.idbranch_offices = branch_offices.idbranch_offices AND (tickets.canceled != 1 OR tickets.canceled IS NULL) AND tickets.date BETWEEN '".$desde."' AND '".$hasta."' GROUP BY branch_offices.idbranch_offices";

			$response = Yii::app()->db->createCommand($query)->queryAll();

			$queryU = "SELECT SUM(tickets.paid) as paid, users.name, users.surname, roles.type FROM tickets, users, roles WHERE tickets.idusers = users.idusers AND users.roles_idroles = roles.idroles AND (tickets.canceled != 1 OR tickets.canceled IS NULL) AND tickets.date BETWEEN '".$desde."' AND '".$hasta."' GROUP BY users.idusers";

			$responseU = Yii::app()->db->createCommand($queryU)->queryAll();

			foreach($response as $i => $value){
				$data['office'][$i]['label'] = $value['office'];
				$data['office'][$i]['value'] = floatval($value['paid']);
			}

			foreach ($responseU as $i => $value) {
				$data['seller'][$i]['label'] = $value['name'].' '.$value['surname'].' ('.$value['type'].')';
				$data['seller'][$i]['value'] = floatval($value['paid']);
			}
		}
		echo json_encode($data);

	}

	public function actionGetTicket($id='')
	{
		$data = array();

		if(!empty($id)){
			$response = $this->loadModel($id);

			$form_payment = array(
				'CE'=>'Efectivo',
				'CT'=>'Transferencia',
				'CC'=>'Tarjeta de crédito',
				'DC'=>'Tarjeta de débito'
			);

			if($response){
				$orders = Orders::model()->findByPk($response->idorders);
				$student = Students::model()->findByPk($orders->idstudents);
				$tutor = Tutores::model()->findByPk($student->idtutores);
				$user = Users::model()->findByPk($response->idusers);

				$data = $response->attributes;
				$data['fullname'] = $tutor->name.' '.$tutor->surname;
				$data['user'] = $user->name.' '.$user->surname;
				$data['form_of_payment'] = $form_payment[$response->form_payment];
			}
		}
		echo json_encode($data);
	}

	public function actionGetAccounts($id)
	{	
		$data = array();
		if(!empty($id)){
			$response = Students::model()->findAll('idtutores=:idtutores', array(':idtutores'=>$id));
			if(count($response)>0){
				foreach($response as $s => $student){
					$data[$s]['fullname'] = $student->name.' '.$student->surname;
					$data[$s]['idstudents'] = $student->idstudents;

					$orders = Orders::model()->find('idstudents=:idstudents', array(':idstudents'=>$student->idstudents));
					if($orders){
						$tickets = Tickets::model()->findAll('idorders=:idorders', array(':idorders'=>$orders->idorders));
						if(count($tickets)>0){
							foreach($tickets as $t => $ticket){
								$data[$s]['tickets'][$t]['idtickets'] = $ticket->idtickets;
								$data[$s]['tickets'][$t]['canceled'] = $ticket->canceled;
							}
						}else{
							$data[$s]['tickets'] = array();
						}
					}else{
						$data[$s]['tickets'] = array();
					}
				}
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
			return false;
			// throw new CHttpException(404,'The requested page does not exist.');
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
