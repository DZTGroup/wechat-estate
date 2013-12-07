<?php

/**
 * This is the model class for table "Estate".
 *
 * The followings are the available columns in table 'Estate':
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $app_key
 * @property string $app_id
 * @property string $wechat_id
 * @property string $create_time
 * @property string $last_modify_time
 */
class Estate extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Estate';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, name', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('name, app_key, app_id, wechat_id', 'length', 'max'=>45),
			array('create_time, last_modify_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, name, app_key, app_id, wechat_id, create_time, last_modify_time', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'name' => 'Name',
			'app_key' => 'App Key',
			'app_id' => 'App',
			'wechat_id' => 'Wechat',
			'create_time' => 'Create Time',
			'last_modify_time' => 'Last Modify Time',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('app_key',$this->app_key,true);
		$criteria->compare('app_id',$this->app_id,true);
		$criteria->compare('wechat_id',$this->wechat_id,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('last_modify_time',$this->last_modify_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Estate the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
