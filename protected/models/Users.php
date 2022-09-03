<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $idusers
 * @property string $user
 * @property string $password
 * @property string $name
 * @property string $surname
 * @property integer $roles_idroles
 *
 * The followings are the available model relations:
 * @property Orders[] $orders
 * @property Roles $rolesIdroles
 */
class Users extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user, password, name, surname, roles_idroles, idbranch_offices', 'required'),
			array('roles_idroles, idbranch_offices', 'numerical', 'integerOnly'=>true),
			array('user, name, surname', 'length', 'max'=>45),
			array('password', 'length', 'max'=>65),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idusers, user, password, name, surname, roles_idroles, idbranch_offices', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'orders' => array(self::HAS_MANY, 'Orders', 'idusers'),
			'rolesIdroles' => array(self::BELONGS_TO, 'Roles', 'roles_idroles'),
			'idbranchoffices' => array(self::BELONGS_TO, 'BranchOffices', 'idbranch_offices'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idusers' => 'Idusers',
			'user' => 'Usuario',
			'password' => 'Constraseña',
			'name' => 'Nombre',
			'surname' => 'Apellido',
			'roles_idroles' => 'Rol',
			'idbranch_offices' => 'Sucursal'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('idusers',$this->idusers);
		$criteria->compare('user',$this->user,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('surname',$this->surname,true);
		$criteria->compare('roles_idroles',$this->roles_idroles);
		$criteria->compare('idbranch_offices',$this->idbranch_offices);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>false
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * Checks if the given password is correct.
	 * @param string the password to be validated
	 * @return boolean whether the password is valid
	 */
	public function validatePassword($password)
	{
		return CPasswordHelper::verifyPassword($password,$this->password);
	}

	/**
	 * Generates the password hash.
	 * @param string password
	 * @return string hash
	 */
	public function hashPassword($password)
	{
		return CPasswordHelper::hashPassword($password);
	}
}
