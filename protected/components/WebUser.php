<?php 

class WebUser extends CWebUser {

	// Store model to not repeat query.
	private $_model;
	private $_roles;

	protected function loadUser($id=null)
	{
		if($this->_model===null)
		{
			if($id!==null){
				 $this->_model=Users::model()->findByPk($id);
			}
		}
		return $this->_model;
	}

	function getRoles(){
		$user = $this->loadUser(Yii::app()->user->id);
		$rol = Roles::model()->findByPk($user->roles_idroles);
		return $rol;
	}

	function checkAccess($operation, $params=null){
		$access = json_decode($this->getRoles()->access, true);
		if($this->getRoles()->type == "Administrador"){
			return true;
		}else{
			foreach ($access['access'] as $key => $acc) {
				if($acc['view'] == Yii::app()->getController()->getId()){
					if(in_array($operation, $acc['access'])){
						return true;
					}
				}
			}
		}
		return false;
	}
	function getRules(){
		$access = json_decode($this->getRoles()->access, true);
		$views = array();
		if($this->getRoles()->type == "Administrador"){
			$views = array('index', 'view', 'admin', 'create', 'update', 'delete');
		}else{
			foreach ($access['access'] as $key => $acc) {
				if($acc['view'] == Yii::app()->getController()->getId()){
					$views = $acc['access'];	
				}
			}
		}
		return $views;
	}
}