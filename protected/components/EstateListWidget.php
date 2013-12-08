<?php
/**
 * Created by PhpStorm.
 * User: mangix
 * Date: 13-12-5
 * Time: 下午11:15
 */

class EstateListWidget extends CWidget {
    public $class_name;

    public function init(){

    }
    public function run(){
        $model = Estate::model()->findAll('user_id=:user_id',array(':user_id'=>Yii::app()->user->getUserId()));

        $this->render('estatelist',array(
            'model'=>$model,
            'class_name'=>$this->class_name
        ));
    }

} 