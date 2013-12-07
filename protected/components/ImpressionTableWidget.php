<?php
/**
 * Created by PhpStorm.
 * User: mangix
 * Date: 13-12-6
 * Time: 上午12:19
 */

class ImpressionTableWidget extends CWidget{

    public $estate_id;

    public function init(){

    }
    public function run(){
        //$model = Entity::model()->findAll('estate_id=:estate_id and type=:type',array(':estate_id'=>$this->estate_id,'type'=>'impression'));

        $model = array();
        $this->render('impressiontable',array(
            "model"=>$model
        ));
    }
} 