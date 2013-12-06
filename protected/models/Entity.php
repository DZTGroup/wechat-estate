<?php

/**
 * This is the model class for table "Entity".
 *
 * The followings are the available columns in table 'Entity':
 * @property integer $id
 * @property integer $estate_id
 * @property string $type
 * @property string $content
 * @property string $status
 * @property string $create_time
 * @property string $reserved_field_1
 * @property string $reserved_field_2
 */
class Entity extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Entity';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('estate_id, type, status,content', 'required'),
			array('estate_id', 'numerical', 'integerOnly'=>true),
			array('type', 'length', 'max'=>11),
			array('status', 'length', 'max'=>1),
			array('reserved_field_1, reserved_field_2', 'length', 'max'=>45),
			array('content', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, estate_id, type, content, status, create_time, reserved_field_1, reserved_field_2', 'safe', 'on'=>'search'),
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
			'estate_id' => 'Estate',
			'type' => 'Type',
			'content' => 'Content',
			'status' => 'Status',
			'create_time' => 'Create Time',
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
		$criteria->compare('estate_id',$this->estate_id);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('create_time',$this->create_time,true);
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
	 * @return Entity the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
