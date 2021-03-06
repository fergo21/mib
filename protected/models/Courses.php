<?php

/**
 * This is the model class for table "courses".
 *
 * The followings are the available columns in table 'courses':
 * @property integer $idcourses
 * @property string $division
 * @property string $shift
 * @property string $year
 * @property integer $number_students
 *
 * The followings are the available model relations:
 * @property SchoolCourses[] $schoolCourses
 */
class Courses extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'courses';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('number_students', 'numerical', 'integerOnly'=>true),
			array('division, shift', 'length', 'max'=>45),
			array('year', 'length', 'max'=>4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idcourses, division, shift, year, number_students', 'safe', 'on'=>'search'),
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
			'schoolCourses' => array(self::HAS_MANY, 'SchoolCourses', 'idcourses'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idcourses' => 'Idcourses',
			'division' => 'Division',
			'shift' => 'Shift',
			'year' => 'Year',
			'number_students' => 'Number Students',
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

		$criteria->compare('idcourses',$this->idcourses);
		$criteria->compare('division',$this->division,true);
		$criteria->compare('shift',$this->shift,true);
		$criteria->compare('year',$this->year,true);
		$criteria->compare('number_students',$this->number_students);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>false
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Courses the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getListCourses() 
	{
		return $this->year."?? ".$this->division." - T: ".$this->shift;
	}
}
