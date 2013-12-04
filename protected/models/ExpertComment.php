<?php

/**
 * This is the model class for table "Expert_Comment".
 *
 * The followings are the available columns in table 'Expert_Comment':
 * @property integer $id
 * @property integer $estate_id
 * @property string $expert_name
 * @property string $expert_title
 * @property string $expert_introduction
 * @property string $comment_title
 * @property string $comment_content
 * @property string $create_time
 * @property string $status
 * @property string $reserved_field_1
 * @property string $reserved_field_2
 */
class ExpertComment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Expert_Comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('estate_id, expert_name, expert_title, expert_introduction, comment_title, comment_content, create_time, status', 'required'),
			array('estate_id', 'numerical', 'integerOnly'=>true),
			array('expert_name, expert_title, comment_title, reserved_field_1, reserved_field_2', 'length', 'max'=>45),
			array('expert_introduction, comment_content', 'length', 'max'=>200),
			array('status', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, estate_id, expert_name, expert_title, expert_introduction, comment_title, comment_content, create_time, status, reserved_field_1, reserved_field_2', 'safe', 'on'=>'search'),
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
			'expert_name' => 'Expert Name',
			'expert_title' => 'Expert Title',
			'expert_introduction' => 'Expert Introduction',
			'comment_title' => 'Comment Title',
			'comment_content' => 'Comment Content',
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
		$criteria->compare('estate_id',$this->estate_id);
		$criteria->compare('expert_name',$this->expert_name,true);
		$criteria->compare('expert_title',$this->expert_title,true);
		$criteria->compare('expert_introduction',$this->expert_introduction,true);
		$criteria->compare('comment_title',$this->comment_title,true);
		$criteria->compare('comment_content',$this->comment_content,true);
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
	 * @return ExpertComment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
