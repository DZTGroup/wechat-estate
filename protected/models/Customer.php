<?php

/**
 * This is the model class for table "Customer".
 *
 * The followings are the available columns in table 'Customer':
 * @property string $customer_id
 * @property string $customer_nickname
 * @property string $sex
 * @property string $last_modified
 */
class Customer extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Customer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('customer_id, customer_nickname, sex, last_modified', 'required'),
			array('customer_id', 'length', 'max'=>255),
			array('customer_nickname', 'length', 'max'=>45),
			array('sex', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('customer_id, customer_nickname, sex, last_modified', 'safe', 'on'=>'search'),
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
			'customer_id' => 'Customer',
			'customer_nickname' => 'Customer Nickname',
			'sex' => 'Sex',
			'last_modified' => 'Last Modified',
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

		$criteria->compare('customer_id',$this->customer_id,true);
		$criteria->compare('customer_nickname',$this->customer_nickname,true);
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('last_modified',$this->last_modified,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Customer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
