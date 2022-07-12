<?php

/**
 * This is the model class for table "orders".
 *
 * The followings are the available columns in table 'orders':
 * @property integer $idorders
 * @property string $date
 * @property string $description
 * @property string $date_delivery
 * @property string $total_amount
 * @property integer $dues
 * @property string $status
 * @property integer $idstudents
 * @property integer $idusers
 * @property integer $idcombo_products
 *
 * The followings are the available model relations:
 * @property ComboProducts $idcomboProducts
 * @property Students $idstudents0
 * @property Users $idusers0
 * @property Tickets[] $tickets
 */
class Orders extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'orders';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date, date_delivery, idstudents, idusers, idcombo_products', 'required'),
			array('dues, idstudents, idusers, idcombo_products', 'numerical', 'integerOnly'=>true),
			array('total_amount', 'length', 'max'=>10),
			array('status', 'length', 'max'=>45),
			array('description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idorders, date, description, date_delivery, total_amount, dues, status, idstudents, idusers, idcombo_products', 'safe', 'on'=>'search'),
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
			'idcomboProducts' => array(self::BELONGS_TO, 'ComboProducts', 'idcombo_products'),
			'idstudents0' => array(self::BELONGS_TO, 'Students', 'idstudents'),
			'idusers0' => array(self::BELONGS_TO, 'Users', 'idusers'),
			'tickets' => array(self::HAS_MANY, 'Tickets', 'idorders'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idorders' => 'N° pedido',
			'date' => 'Fecha',
			'description' => 'Descripción',
			'date_delivery' => 'Fecha de entrega',
			'total_amount' => 'Total',
			'dues' => 'Cuotas',
			'status' => 'Estado',
			'idstudents' => 'Estudiante',
			'idusers' => 'Usuario',
			'idcombo_products' => 'Combos',
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

		$criteria->compare('idorders',$this->idorders);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('date_delivery',$this->date_delivery,true);
		$criteria->compare('total_amount',$this->total_amount,true);
		$criteria->compare('dues',$this->dues);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('idstudents',$this->idstudents);
		$criteria->compare('idusers',$this->idusers);
		$criteria->compare('idcombo_products',$this->idcombo_products);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Orders the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
