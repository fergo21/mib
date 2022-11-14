<?php

/**
 * This is the model class for table "tutores".
 *
 * The followings are the available columns in table 'tutores':
 * @property integer $idtutores
 * @property string $name
 * @property string $surname
 * @property string $phone
 * @property string $mail
 * @property string $ci
 *
 * The followings are the available model relations:
 * @property Students[] $students
 */
class Tutores extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tutores';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, surname, phone, ci', 'required', 'message'=>'El campo "{attribute}" no puede estar en blanco'),
			array('idtutores', 'numerical', 'integerOnly'=>true),
			array('name, surname, phone, mail', 'length', 'max'=>45),
			array('ci', 'length', 'max'=>8),
			// array('ci', 'unique', 'on'=>'insert'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idtutores, name, surname, phone, mail, ci', 'safe', 'on'=>'search'),
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
			'students' => array(self::HAS_MANY, 'Students', 'idtutores'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idtutores' => 'Idtutores',
			'name' => 'Nombres',
			'surname' => 'Apellidos',
			'phone' => 'Teléfono',
			'mail' => 'E-mail',
			'ci' => 'DNI',
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

		$criteria->compare('idtutores',$this->idtutores);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('surname',$this->surname,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('mail',$this->mail,true);
		$criteria->compare('ci',$this->ci,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>false
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tutores the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
