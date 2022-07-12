<?php

/**
 * This is the model class for table "schools".
 *
 * The followings are the available columns in table 'schools':
 * @property integer $idschools
 * @property string $name
 * @property string $city
 * @property string $address
 * @property integer $idprovince
 *
 * The followings are the available model relations:
 * @property Provinces $idprovince0
 * @property Students[] $students
 */
class Schools extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'schools';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, city, idprovince', 'required'),
			array('idprovince', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>45),
			array('city', 'length', 'max'=>100),
			array('address', 'length', 'max'=>60),
			array('name, city, idprovince', 'isUnique', 'on'=>'insert'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idschools, name, city, address, idprovince', 'safe', 'on'=>'search'),
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
			'promoses' => array(self::HAS_MANY, 'Promos', 'idschools'),
			'idprovince0' => array(self::BELONGS_TO, 'Provinces', 'idprovince'),
			'students' => array(self::HAS_MANY, 'Students', 'idschools'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idschools' => 'Idschools',
			'name' => 'Escuela',
			'city' => 'Ciudad',
			'address' => 'Dirección',
			'idprovince' => 'Provincia',
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
		// $criteria->with = array('idprovince0');
		$criteria->compare('idschools',$this->idschools);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('idprovince',$this->idprovince);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Schools the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function isUnique($attribute, $params){
		$data = array();
		$query = "SELECT COUNT(*) as UNICO FROM schools WHERE name = '".$this->name."' AND city = '".$this->city."' AND idprovince = ". $this->idprovince;
		$data = Yii::app()->db->createCommand($query)->queryAll();
		if(intval($data[0]['UNICO'])>0){
			$this->addError($attribute, 'Ya existe ésta escuela en esa ciudad y provincia.');
		}
	}
}
