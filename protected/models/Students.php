<?php

/**
 * This is the model class for table "students".
 *
 * The followings are the available columns in table 'students':
 * @property integer $idstudents
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property integer $ci
 * @property string $graduation_year
 * @property integer $idschools
 * @property integer $idyears
 * @property integer $iddivision
 * @property integer $idshifts
 *
 * The followings are the available model relations:
 * @property Orders[] $orders
 * @property Divisions $iddivision0
 * @property Schools $idschools0
 * @property Shifts $idshifts0
 * @property Years $idyears0
 */
class Students extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'students';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, surname, phone, ci, idschools, idyears, iddivision, idshifts', 'required', 'message'=>'El campo "{attribute}" no puede estar en blanco'),
			array('ci, idschools, idyears, iddivision, idshifts', 'numerical', 'integerOnly'=>true),
			array('name, surname, email, phone, address', 'length', 'max'=>45),
			array('graduation_year', 'length', 'max'=>4),
			array('idschools, idyears, idshifts, iddivision', 'validSelect', 'on' => 'insert, update'),
			array('ci', 'isUnique', 'on' => 'insert'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idstudents, name, surname, email, phone, address, ci, graduation_year, idschools, idyears, iddivision, idshifts', 'safe', 'on'=>'search'),
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
			'orders' => array(self::HAS_MANY, 'Orders', 'idstudents'),
			'iddivision0' => array(self::BELONGS_TO, 'Divisions', 'iddivision'),
			'idschools0' => array(self::BELONGS_TO, 'Schools', 'idschools'),
			'idshifts0' => array(self::BELONGS_TO, 'Shifts', 'idshifts'),
			'idyears0' => array(self::BELONGS_TO, 'Years', 'idyears'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idstudents' => 'Idstudents',
			'name' => 'Nombre',
			'surname' => 'Apellido',
			'email' => 'Correo',
			'phone' => 'Teléfono',
			'address' => 'Dirección',
			'ci' => 'DNI',
			'graduation_year' => 'Año de promo',
			'idschools' => 'Escuela',
			'idyears' => 'Curso',
			'iddivision' => 'División',
			'idshifts' => 'Turno',
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

		$criteria->compare('idstudents',$this->idstudents);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('surname',$this->surname,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('ci',$this->ci);
		$criteria->compare('graduation_year',$this->graduation_year,true);
		$criteria->compare('idschools',$this->idschools);
		$criteria->compare('idyears',$this->idyears);
		$criteria->compare('iddivision',$this->iddivision);
		$criteria->compare('idshifts',$this->idshifts);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>false
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Students the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function validSelect($attribute, $params) {
		if(is_string($this->idschools) || is_string($this->idyears) || is_string($this->iddivision) || is_string($this->idshifts)){
			if($this->$attribute == '0'){
				switch ($attribute) {
					case 'idyears':
						$field = 'Año';
						break;
					case 'iddivision':
						$field = 'División';
						break;
					case 'idshifts':
						$field = 'Turno';
						break;
					default:
						$field = 'Escuela';
						break;
				}
				$this->addError($attribute, 'El campo "'.$field.'" no puede estar en blanco.');
			}
		}
	}

	public function isUnique($attribute, $params){
		$exist = Students::model()->find('ci=:ci', array(':ci'=> $this->ci));
		if($exist){
			$this->addError($attribute, 'Ya existe un registro con ese mismo número.');
		}
	}
}
