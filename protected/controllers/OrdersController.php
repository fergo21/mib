<?php

class OrdersController extends Controller
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
				'actions'=>array('getorders', 'getcombos', 'out', 'downloadlist', 'getstatus'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
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
	public function actionCreate($id=null)
	{
		$model=new Orders;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_GET['id'])){
			$student = Students::model()->findByPk($_GET['id']);
			$promo = Promos::model()->find("idschools=".$student->idschools." AND idyears=".$student->idyears." AND iddivision=".$student->iddivision." AND idshifts=".$student->idshifts." AND year_promo='".$student->graduation_year."'");
			$model->idstudents = $student->idstudents;
		}
		if(isset($_POST['Orders']))
		{
			// echo "<pre>";
			// 	var_dump(json_encode($_POST['Orders']['size']));die;
			$model->attributes=$_POST['Orders'];
			$model->size = $_POST['Orders']['size'];
			$model->idusers = Yii::app()->user->id;
			$model->date = Utils::format_date($_POST['Orders']['date'], "en");
			$model->date_delivery = Utils::format_date($_POST['Orders']['date_delivery'], "en");
			$model->percent = $_POST['Orders']['percent'] ? $_POST['Orders']['percent'] : 0.0;
			$model->advance_payment = $_POST['Orders']['advance_payment'] ? Utils::format_price($_POST['Orders']['advance_payment'], true) : 0.0;
			$model->extra_amount = $_POST['Orders']['extra_amount'] ? Utils::format_price($_POST['Orders']['extra_amount'], true) : 0.0;
			$model->total_amount = $_POST['Orders']['total_amount'] ? Utils::format_price($_POST['Orders']['total_amount'], true) : 0.00;
			
			if($model->save()){
				if(isset($_GET['id'])){
			// print_r($promo);die;
					Yii::app()->user->setFlash('success', 'ok');
					Yii::app()->user->setFlash('redirect', '/students/create/'.$promo->idpromos);
					$this->redirect(array('/orders'));
				}else{
					$this->redirect(array('/orders'));
				}
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

		if(isset($_POST['Orders']))
		{
			// echo "<pre>";
			// print_r($_POST);die;
			$model->attributes=$_POST['Orders'];
			$model->size = $_POST['Orders']['size'];
			$model->idusers = Yii::app()->user->id;
			$model->date = Utils::format_date($_POST['Orders']['date'], "en");
			$model->date_delivery = Utils::format_date($_POST['Orders']['date_delivery'], "en");
			$model->percent = $_POST['Orders']['percent'] ? $_POST['Orders']['percent'] : 0.0; 
			$model->advance_payment = $_POST['Orders']['advance_payment'] ? $_POST['Orders']['advance_payment'] : 0.0; 
			$model->extra_amount = $_POST['Orders']['extra_amount'] ? $_POST['Orders']['extra_amount'] : 0.0;
			if($model->save())
				$this->redirect(array('/orders'));
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
		$dataProvider=new CActiveDataProvider('Orders');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Orders('search');
		$model->unsetAttributes();  // clear any default values

		$modelSchool = new Schools('search');
		$modelYear = new Years('search');
		$modelDivision = new Divisions('search');
		$modelShift = new Shifts('search');
		$modelPromo = new Promos('search');

		$modelSchool->unsetAttributes();  // clear any default values
		$modelYear->unsetAttributes();
		$modelDivision->unsetAttributes();
		$modelShift->unsetAttributes();
		$modelPromo->unsetAttributes();

		if(isset($_GET['Orders'])){
			$response = false;
			if(isset($_GET['Schools']['idschools'])){
				$modelSchool->attributes = $_GET['Schools'];				
			}
			// die;
			$model->attributes=$_GET['Orders'];
			// $model = $response;
			// // $model->attributes=$_GET['Orders'];
			// echo "<pre>";
			// print_r($modelSchool);die;
		}

		$this->render('admin',array(
			'model'=>$model,
			'modelSchool'=>$modelSchool,
			'modelYear'=>$modelYear,
			'modelDivision'=>$modelDivision,
			'modelShift'=>$modelShift,
			'modelPromo'=>$modelPromo,
		));
	}

	public function actionGetOrders() 
	{
		if($_POST['q']){
			$setting = Utils::readJson('settings');

			$data = array();
			$i = 0;

			$query = "SELECT orders.*, students.name, students.surname, schools.expiration_day FROM orders, students, tutores, schools WHERE orders.idstudents = students.idstudents AND students.idtutores = tutores.idtutores AND students.idschools = schools.idschools AND (tutores.ci = '".$_POST['q']."' OR students.ci = '".$_POST['q']."')";
			$response = Yii::app()->db->createCommand($query)->queryAll();

			foreach($response as $order){

				$saldo = 00.0;
				$paid = false;
				$total_by_products = 0.00;

				$ticketResponse = Tickets::model()->findAll('idorders=:idorders', array(':idorders'=>$order['idorders']));
				$countTicket = count($ticketResponse);
				
				if($countTicket <= 0){
					$data[$i]['ticket']['dues_paid'] = 0; 
					$data[$i]['ticket']['saldo'] = 0;
				}else if($countTicket < $order['dues']){
					$data[$i]['ticket']['dues_paid'] = intval(mb_substr($ticketResponse[$countTicket-1]['dues'], -1));
					foreach($ticketResponse as $ticket){
						$saldo = $ticket->saldo;
					}
				}else{
					$paid = true;
					//$data[$i]['option'] = array();
				}
				if(!$paid){
					// echo "<pre>";
					// print_r(json_decode($order['size']));die;
					foreach(json_decode($order['size']) as $products){
						$total_by_products = $total_by_products + intval($products->unitPrice);
					}

					$data[$i]['value'] = $order['idorders'];
					$data[$i]['label'] = 'P'.$order['idorders'].' - '.$order['name'].' '.$order['surname'];
					$data[$i]['dues'] = $order['dues'];
					// $data[$i]['description'] = count($newOrderSize) > 0 ? json_encode($newOrderSize) : $order['size'];
					$data[$i]['description'] = $order['size'];
					$data[$i]['code'] = intval(time());
					$data[$i]['saldo'] = $saldo;
					$data[$i]['total_amount'] = Utils::format_price(Utils::calculatePercentTicket($order['total_amount'], $order['dues']));
					$data[$i]['expiration_day'] = $order['expiration_day'];
					$data[$i]['date_create'] = $order['date'];
					$data[$i]['percent'] = $order['percent'];
					$data[$i]['advance_payment'] = $order['advance_payment'];
					$data[$i]['extra_amount'] = $order['extra_amount'] ? $order['extra_amount'] : 0.00;
					$data[$i]['financed'] = intval($order['dues']) > 3 ? Utils::formatPercent($setting['percent_f_'.$order['dues']], false) : 0.0;
					$data[$i]['total_amount_products'] = Utils::format_price(Utils::validateQuantity($total_by_products, count(json_decode($order['size']))));
					
					$i++;
				}
			}
			echo json_encode($data);
		}
	}

	public function actionGetCombos()
	{
		
		if(isset($_POST['q']) && strlen($_POST['q']) > 2){
			$payload = json_decode($_POST['q']);

			$prod = "";
			$quantity = 0;
			foreach($payload as $product){
				$prod .= $product->idproducts. ',';
				$quantity = $quantity + $product->quantity;
			}

			$prod = trim($prod, ',');


			$query = "SELECT * FROM `products` WHERE idproducts IN (".$prod.")";
			$query=Yii::app()->db->createCommand($query)->queryAll();
			
			$data = array();
			$total = 0;
			foreach($query as $key => $prod) {
				foreach($payload as $product){
					if($product->idproducts == $prod['idproducts']){
						$data["products"][$key] = array(
							"i"=>$prod['idproducts'], 
							"name"=>$prod['name'], 
							"totalPriceProduct"=> ($_POST['old'] === 'true' ? $prod['price_old'] : $prod['price']) * $product->quantity,
							"unitPrice"=>intval(($_POST['old'] === 'true' ? $prod['price_old'] : $prod['price']))
						);

						$total = $total + $data["products"][$key]['totalPriceProduct'];
					}
				}

			}

			$extra_amount = isset($_POST['e']) && !empty($_POST['e']) ? floatval(Utils::format_price($_POST['e'])) : 0.0;
			// var_dump($total);die;

			$total = Utils::validateQuantity($total, $quantity);
			$total = Utils::calculatePercent($_POST['p'], $total);

			$data["total"] = Utils::format_price($total + $extra_amount);

			if(count($data)>0){
				echo json_encode($data);
			}else{
				echo json_encode([]);
			}
		}else{
			echo json_encode([]);
		}
	}

	public function actionOut()
	{
		if(isset($_POST['q']) && isset($_POST['i'])){
			$model = $this->loadModel($_POST['q']);
			$model->out_production = $_POST['i'];
			if($model->save()){
				$data = array(
					'status' => true,
					'message' => 'success'
				);
			}else{
				$data = array(
					'status' => false,
					'message' => 'error'
				);
			}
			echo json_encode($data);
		}
	}

	public function actionDownloadList()
	{
		if(isset($_POST['data_download'])){
			$data = preg_split("/- /",$_POST['data_download']);
		
			$responseSchools = Schools::model()->find("name=:name", array(":name"=>$data[0]));
			$responseYears = Years::model()->find("year=:year", array(":year"=>$data[1]));
			$responseDivisions = Divisions::model()->find("division=:division", array(":division"=>$data[2]));
			$responseShifts = Shifts::model()->find("shift=:shift", array(":shift"=>$data[3]));
			
			$criteria = new CDbCriteria();
			$criteria->condition = "year_promo='$data[4]' AND idyears=$responseYears->idyears AND idschools=$responseSchools->idschools AND iddivision=$responseDivisions->iddivision AND idshifts=$responseShifts->idshifts";
			$responsePromos = Promos::model()->find($criteria);

			$dataStatus = '';

			if(!empty($data[5])){
				$dataStatus = str_replace('ó', 'o', $data[5]);
				$dataStatus = "AND orders.status LIKE '".$dataStatus."'";
			}
			// print_r($responsePromos);die;

			if($responseSchools && $responseYears && $responseDivisions && $responseShifts && $responsePromos){
				$query = "SELECT CONCAT(students.name,' ', students.surname) as fullName, students.ci, students.graduation_year, schools.name as schools, years.year, divisions.division, shifts.shift, orders.size, orders.dues, orders.description, orders.out_production,
					    (SELECT tickets.dues FROM tickets WHERE orders.idorders = tickets.idorders ORDER BY tickets.idtickets DESC LIMIT 1) as duespaid
					FROM orders, students, schools, years, divisions, shifts, promos
					WHERE orders.idstudents = students.idstudents 
					AND students.idschools = schools.idschools 
					AND students.idyears = years.idyears
					AND students.iddivision = divisions.iddivision
					AND students.idshifts = shifts.idshifts
					AND promos.idschools = schools.idschools
					AND promos.year_promo
					AND schools.idschools = $responseSchools->idschools
					AND divisions.iddivision = $responseDivisions->iddivision
					AND promos.idpromos = $responsePromos->idpromos
					AND years.idyears = $responsePromos->idyears
					$dataStatus";

				$response=Yii::app()->db->createCommand($query)->queryAll();

				if(count($response)>0){
					self::outputCsv($response);
					// self::downloadImage($responsePromos->image_promo);
				}else{
					Yii::app()->user->setFlash('warning', 'ok');
					$this->redirect(array('/orders/admin'));
				}
			}else{
				Yii::app()->user->setFlash('warning', 'ok');
				$this->redirect(array('/orders/admin'));
			}
		}
	}

	public function downloadImage($base64Image){
define('UPLOAD_DIR', 'images/');
$image_parts = explode(";base64,", $base64Image);
$image_type_aux = explode("image/", $image_parts[0]);
$image_type = $image_type_aux[1];
$image_base64 = base64_decode($image_parts[1]);
$file = UPLOAD_DIR . uniqid() . '.png';
file_put_contents($file, $image_base64);

//falta descargarla :(

	}

	public function outputCsv($response){
		
		header("Pragma: public");
		header("Expires: 0");
		$filename = utf8_decode($response[0]["schools"])."-".$response[0]["year"]."".$response[0]["division"]."-T:".utf8_decode($response[0]["shift"])."-".$response[0]["graduation_year"].".xls";
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=$filename");
		header("Pragma: no-cache");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

		$rows = "";
		$size = "";
		foreach($response as $column){
			$status = "";
			if($column['out_production'] === "1"){
				$status = "<td style='background:#ff7878;'>Fuera de produccion</td>";
			}else{
				$status = utf8_decode(Utils::displayStatusExcel($column['duespaid'], $column['dues']));
			}
			$size = "<table>";
			$rowspan = count(json_decode($column['size']));
			foreach(json_decode($column['size']) as $sizes){
				$size .= "<tr>
							<td>".utf8_decode($sizes->apodo)."</td>
							<td>".utf8_decode($sizes->product)."</td>
							<td>".$sizes->quantity."</td>
							<td>".$sizes->talles."</td>
						</tr>";

			}
			$size .= "</table>";
			$rows .= "<tr>
				<td>". utf8_decode($column['fullName'])."</td>
				<td>".$column['ci']."</td>
				<td>".$size."</td>"
				. $status .
				"<td>".utf8_decode($column['description'])."</td>
			</tr>";
		}
		

		$html = "
		<style>
		table td, table th{
			border: 1px solid;
		}
		table th{
			font-size: 18px;
			background-color: #ff9d6e;
		}
		table #encabezado td {
			background-color: #ff9d6e;	
		}
		</style>
		<table>
		<tbody>
			<tr>
				<th colspan='5'>
					".utf8_decode($response[0]["schools"])." - ".$response[0]["year"]."".$response[0]["division"]." - T: ".utf8_decode($response[0]["shift"])." - ".$response[0]["graduation_year"]."
				</th>
			</tr>
			<tr id='encabezado'>
				<td><b>Nombre y Apellido</b></td>
				<td><b>DNI</b></td>
				<td><b>Apodo | Producto | Cantidad | Talle</b></td>
				<td><b>Estado</b></td>
				<td><b>Observaciones</b></td>
			</tr>
			". $rows ."
		</tbody>
		</table>";
		echo $html;
	}

	/*public function outputCsv($response){

		$headMain = array('Escuela: '.utf8_decode($response[0]["schools"]), 'Promo: '.$response[0]["graduation_year"], 'Curso: '.$response[0]["year"], 'Division: '.$response[0]["division"], 'Turno: '.utf8_decode($response[0]["shift"]));
		
		$header = array('Nombre y Apellido', 'DNI', 'Productos/Talles/Apodo', 'Plan de pago', 'Cuotas Pagadas');
	
		
		header('Content-Type: application/csv');
    	header('Content-Disposition: attachment; filename="ListadoProduccion.csv";');

		$f = @fopen('php://output','w');
		// Escribo la cabecera en el documento
		fputcsv($f, $headMain, ';');
		fputcsv($f, $header, ';');

		foreach($response as $i => $column){
			$row[$i]['Nombre y Apellido'] = utf8_decode($column['fullName']);
			$row[$i]['DNI'] = $column['ci'];
			// $row[$i]['Promo'] = $column['graduation_year'];
			// $row[$i]['Escuela'] = utf8_decode($column['schools']);
			// $row[$i]['Curso'] = $column['year'];
			// $row[$i]['Division'] = $column['division'];
			// $row[$i]['Turno'] = utf8_decode($column['shift']);
			$row[$i]['Productos/Talles/Apodo'] = self::formatListProduct(json_decode($column['size']));
			$row[$i]['Plan de pago'] = $column['dues'];
			$row[$i]['Cuotas pagadas'] = $column['duespaid'];
			fputcsv($f, $row[$i], ';');
		}
		// echo "<pre>";
		// print_r($row);die;

		// flush buffer
		ob_flush();
		// fclose($f);
		// exit();

	}

	public function formatListProduct($data){
		$string = "";
		foreach ($data as $key => $value) {
			$string .= $value->product. ' - Cantidad: '.$value->quantity. ' - Talle: '.$value->talles.' - Apodo: '.$value->apodo."\r\n";
		}
		// echo $string;die;
		return utf8_decode($string);
	}*/

	/*public function actionGetStatus(){
		if(isset($_POST['view'])){
			
		}
	}*/

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Orders the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Orders::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Orders $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='orders-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
