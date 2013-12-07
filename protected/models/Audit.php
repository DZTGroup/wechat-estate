<?php

/**
 * This is the model class for table "Audit".
 *
 * The followings are the available columns in table 'Audit':
 * @property integer $id
 * @property integer $entity_id
 * @property integer $estate_id
 * @property string $entity_type
 * @property string $entity_status
 * @property integer $operator_id
 * @property integer $admin_id
 * @property string $create_time
 * @property string $last_modify_time
 */
class Audit extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Audit';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('entity_id, estate_id, entity_type, entity_status', 'required'),
			array('entity_id, estate_id, operator_id, admin_id', 'numerical', 'integerOnly'=>true),
			array('entity_type', 'length', 'max'=>11),
			array('entity_status', 'length', 'max'=>1),
			array('create_time, last_modify_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, entity_id, estate_id, entity_type, entity_status, operator_id, admin_id, create_time, last_modify_time', 'safe', 'on'=>'search'),
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
			'entity_id' => 'Entity',
			'estate_id' => 'Estate',
			'entity_type' => 'Entity Type',
			'entity_status' => 'Entity Status',
			'operator_id' => 'Operator',
			'admin_id' => 'Admin',
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
		$criteria->compare('entity_id',$this->entity_id);
		$criteria->compare('estate_id',$this->estate_id);
		$criteria->compare('entity_type',$this->entity_type,true);
		$criteria->compare('entity_status',$this->entity_status,true);
		$criteria->compare('operator_id',$this->operator_id);
		$criteria->compare('admin_id',$this->admin_id);
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
	 * @return Audit the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
