<?php

/**
 * This is the model class for table "promos".
 *
 * The followings are the available columns in table 'promos':
 * @property integer $idpromos
 * @property string $image_promo
 * @property string $year_promo
 * @property integer $tel_manager
 * @property integer $idschools
 * @property integer $iddivision
 * @property integer $idshifts
 * @property integer $idyears
 *
 * The followings are the available model relations:
 * @property Divisions $iddivision0
 * @property Schools $idschools0
 * @property Shifts $idshifts0
 * @property Years $idyears0
 */
class Promos1 extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'promos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('image_promo, year_promo, idschools, iddivision, idshifts, idyears', 'required'),
			array('tel_manager, idschools, iddivision, idshifts, idyears', 'numerical', 'integerOnly'=>true),
			array('year_promo', 'length', 'max'=>4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idpromos, image_promo, year_promo, tel_manager, idschools, iddivision, idshifts, idyears', 'safe', 'on'=>'search'),
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
			'idpromos' => 'Idpromos',
			'image_promo' => 'Diseño',
			'year_promo' => 'Promo',
			'tel_manager' => 'Tel. encargado',
			'idschools' => 'Escuela',
			'iddivision' => 'División',
			'idshifts' => 'Turno',
			'idyears' => 'Curso',
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

		$criteria->compare('idpromos',$this->idpromos);
		$criteria->compare('image_promo',$this->image_promo,true);
		$criteria->compare('year_promo',$this->year_promo,true);
		$criteria->compare('tel_manager',$this->tel_manager);
		$criteria->compare('idschools',$this->idschools);
		$criteria->compare('iddivision',$this->iddivision);
		$criteria->compare('idshifts',$this->idshifts);
		$criteria->compare('idyears',$this->idyears);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Promos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
