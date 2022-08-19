<?php

class SettingController extends Controller
{
	public $layout='main';

	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>Yii::app()->user->getRules(),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex()
	{
		$setting = Utils::readJson('settings');

		$this->render('index', array('setting'=>$setting));
	}

	public function actionUpdate()
	{
		if(isset($_POST)){
			$data = array();
			// print_r($_POST);die;
			$data['expiration_day'] = intval($_POST['setting_expiration_day']);
			$data['expiration_day_2'] = intval($_POST['setting_expiration_day_2']);
			$data['percent_cc'] = floatval(Utils::formatPercent($_POST['setting_percent_cc']));
			$data['percent_expiration'] = floatval(Utils::formatPercent($_POST['setting_percent_expiration']));

			$data['percent_f_4'] = floatval(Utils::formatPercent($_POST['setting_percent_f_4']));
			$data['percent_f_5'] = floatval(Utils::formatPercent($_POST['setting_percent_f_5']));
			$data['percent_f_6'] = floatval(Utils::formatPercent($_POST['setting_percent_f_6']));

			$data['percent_qp_2'] = floatval(Utils::formatPercent($_POST['setting_percent_qp_2']));
			$data['percent_qp_3'] = floatval(Utils::formatPercent($_POST['setting_percent_qp_3']));
			$data['percent_qp_4'] = floatval(Utils::formatPercent($_POST['setting_percent_qp_4']));
			$data['percent_qp_more'] = floatval(Utils::formatPercent($_POST['setting_percent_qp_more']));

			if(file_put_contents('json/settings.json', json_encode($data, JSON_PRETTY_PRINT))){
				Yii::app()->user->setFlash('success', 'ok');
				$this->redirect(array('/more-settings'));
			}
		}
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}