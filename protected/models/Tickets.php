<?php

/**
 * This is the model class for table "tickets".
 *
 * The followings are the available columns in table 'tickets':
 * @property integer $idtickets
 * @property integer $code
 * @property string $date
 * @property string $form_payment
 * @property string $amount
 * @property integer $dues
 * @property string $description
 * @property string $paid
 * @property integer $idorders
 *
 * The followings are the available model relations:
 * @property Orders $idorders0
 */
class Tickets extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tickets';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, date, form_payment, amount, dues, paid, idorders, idusers', 'required'),
			array('code, idorders, idusers, canceled', 'numerical', 'integerOnly'=>true),
			array('form_payment', 'length', 'max'=>45),
			array('amount, paid, saldo', 'length', 'max'=>10),
			array('description, obs_canceled', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idtickets, code, date, form_payment, amount, dues, description, paid, saldo, canceled, obs_canceled, idorders, idusers', 'safe', 'on'=>'search'),
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
			'idorders0' => array(self::BELONGS_TO, 'Orders', 'idorders'),
			'idusers0' => array(self::BELONGS_TO, 'Users', 'idusers'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idtickets' => 'N° Ticket',
			'code' => 'Código',
			'date' => 'Fecha',
			'form_payment' => 'Forma de pago',
			'amount' => 'Monto',
			'dues' => 'Cuotas',
			'description' => 'Detalle',
			'paid' => 'Pagado',
			'saldo' => 'Saldo',
			'canceled' => 'Anulado',
			'obs_canceled' => 'Oservación',
			'idorders' => 'Cliente'
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

		$criteria->compare('idtickets',$this->idtickets);
		$criteria->compare('code',$this->code);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('form_payment',$this->form_payment,true);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('dues',$this->dues);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('paid',$this->paid,true);
		$criteria->compare('saldo', $this->saldo,true);
		$criteria->compare('canceled',$this->canceled);
		$criteria->compare('obs_canceled',$this->obs_canceled,true);
		$criteria->compare('idorders',$this->idorders);
		$criteria->compare('idusers',$this->idusers);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>false
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tickets the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
