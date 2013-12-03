<?php

/**
 * This is the model class for table "Customer_Impression".
 *
 * The followings are the available columns in table 'Customer_Impression':
 * @property integer $id
 * @property integer $customer_id
 * @property string $customer_nickname
 * @property integer $estate_id
 * @property string $impression
 * @property string $create_time
 * @property string $status
 * @property string $reserved_field_1
 * @property string $reserved_field_2
 */
class CustomerImpression extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Customer_Impression';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('customer_id, customer_nickname, estate_id, create_time, status', 'required'),
			array('customer_id, estate_id', 'numerical', 'integerOnly'=>true),
			array('customer_nickname, reserved_field_1, reserved_field_2', 'length', 'max'=>45),
			array('status', 'length', 'max'=>1),
			array('impression', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, customer_id, customer_nickname, estate_id, impression, create_time, status, reserved_field_1, reserved_field_2', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'customer_id' => 'Customer',
			'customer_nickname' => 'Customer Nickname',
			'estate_id' => 'Estate',
			'impression' => 'Impression',
			'create_time' => 'Create Time',
			'status' => 'Status',
			'reserved_field_1' => 'Reserved Field 1',
			'reserved_field_2' => 'Reserved Field 2',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('customer_id',$this->customer_id);
		$criteria->compare('customer_nickname',$this->customer_nickname,true);
		$criteria->compare('estate_id',$this->estate_id);
		$criteria->compare('impression',$this->impression,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('reserved_field_1',$this->reserved_field_1,true);
		$criteria->compare('reserved_field_2',$this->reserved_field_2,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CustomerImpression the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
