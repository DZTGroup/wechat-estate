<?php

/**
 * This is the model class for table "BBS_Post".
 *
 * The followings are the available columns in table 'BBS_Post':
 * @property integer $id
 * @property integer $estate_id
 * @property string $title
 * @property string $content
 * @property string $picture_url
 * @property string $wechat_id
 * @property string $create_time
 * @property integer $pv_num
 * @property integer $praise_num
 */
class BBSPost extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'BBS_Post';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('estate_id, title, content, wechat_id', 'required'),
			array('estate_id, pv_num, praise_num', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>25),
			array('content, picture_url, wechat_id', 'length', 'max'=>45),
			array('create_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, estate_id, title, content, picture_url, wechat_id, create_time, pv_num, praise_num', 'safe', 'on'=>'search'),
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
			'title' => 'Title',
			'content' => 'Content',
			'picture_url' => 'Picture Url',
			'wechat_id' => 'Wechat',
			'create_time' => 'Create Time',
			'pv_num' => 'Pv Num',
			'praise_num' => 'Praise Num',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('picture_url',$this->picture_url,true);
		$criteria->compare('wechat_id',$this->wechat_id,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('pv_num',$this->pv_num);
		$criteria->compare('praise_num',$this->praise_num);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BBSPost the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
