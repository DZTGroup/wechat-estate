<?php

class AuditController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('ajaxupdateauditbyid','group','impression','comment','reservation','picture','list','ajaxgetauditdata'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('estate','ajaxgetauditestatedata','ajaxgetauditpasseddata','ajaxgetauditdatabyestateid'),
				'users'=>array('@'),
			),

			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Audit the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Audit::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Audit $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='audit-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    public function actionEstate()
    {
        $model=new Audit();
        $this->render('estate',array(
            'model'=>$model,
        ));
    }

    public function actionGroup()
    {
        $model=new Audit();
        $this->render('group',array(
            'model'=>$model,
        ));
    }
    public function actionImpression()
    {
        $model=new Audit();
        $this->render('impression',array(
            'model'=>$model,
        ));
    }
    public function actionComment()
    {
        $model=new Audit();
        $this->render('comment',array(
            'model'=>$model,
        ));
    }

    public function actionReservation()
    {
        $model=new Audit();
        $this->render('reservation',array(
            'model'=>$model,
        ));
    }

    public function actionPicture()
    {
        $model=new Audit();
        $this->render('picture',array(
            'model'=>$model,
        ));
    }
    public function actionAjaxGetAuditEstateData(){

        $model = Yii::app()->db->createCommand()
            ->select('e1.*,e2.name,e3.name as username')
            ->from('Audit e1')
            ->join('Estate e2', 'e1.estate_id=e2.id')
            ->join('User e3','e3.id=e1.operator_id')
            ->where('e1.entity_type=:entity_type and e1.entity_status=:status', array(
                ':entity_type'=>'intro',
                ':status'=>0
            ))->query();
        $arr = array();

        forEach($model as $k=>$row){
            array_push($arr,$row);
        }

        echo json_encode(array(
            'code' => 200,
            'data' => $arr
        ));
    }

    public function actionAjaxUpdateAuditById(){
        $count1 =Audit::model()->updateByPk($_POST['id'],array('entity_status'=>$_POST['status']));
        if($_POST['status']=='1'&& $_POST['entity_type']!='group'){
            $count2=Entity::model()->updateAll(array('status'=>'3'),'estate_id=:estate_id and type=:type and status=:status',
                array(':estate_id'=>$_POST['estate_id'],':type'=>$_POST['entity_type'],':status'=>'1'
            ));
            if($count2<0)
            {
                return;
            }

        }
         $count3 =Entity::model()->updateByPk($_POST['entity_id'],array('status'=>$_POST['status']));
        if($count1>0&&$count3>0){
            echo json_encode(array(
                'code'=>200,
                'data'=> array()
            ));
        }
    }

    public function actionList(){
        $model=new Audit();
        $this->render('list',array(
            'model'=>$model,
        ));
    }

    public function actionAjaxGetAuditPassedData(){
        $model = Yii::app()->db->createCommand()
            ->select('e1.*,e2.name')
            ->from('Audit e1')
            ->join('Estate e2', 'e1.estate_id=e2.id')
            ->where('e1.entity_status=:status order by e1.estate_id', array(
                ':status'=>1
            ))->query();
        $arr = array();

        forEach($model as $k=>$row){
            array_push($arr,$row);
        }

        echo json_encode(array(
            'code' => 200,
            'data' => $arr
        ));
    }

    public function actionAjaxGetAuditData(){
        $model = Yii::app()->db->createCommand()
            ->select('e1.*,e2.name,e4.name as username')
            ->from('Audit e1')
            ->join('Estate e2', 'e1.estate_id=e2.id')
            ->join('User e4','e4.id=e1.operator_id')
            ->where('e1.entity_type=:entity_type and e1.entity_status=:status order by e1.estate_id', array(
                ':entity_type'=>$_POST['type'],
                ':status'=>0,

            ))->query();
        $arr = array();

        forEach($model as $k=>$row){
            array_push($arr,$row);
        }

        echo json_encode(array(
            'code' => 200,
            'data' => $arr
        ));
    }

    public function actionAjaxGetAuditDataByEstateId(){

        $model = Yii::app()->db->createCommand()
            ->select('e1.*,e2.name,e4.name as username')
            ->from('Audit e1')
            ->join('Estate e2', 'e1.estate_id=e2.id')
            ->join('User e4','e4.id=e1.operator_id')
            ->where('e1.estate_id=:estate_id and e1.entity_type=:entity_type and e1.entity_status=:status order by e1.estate_id', array(
                'estate_id'=>$_POST['estate_id'],
                ':entity_type'=>$_POST['entity_type'],
                ':status'=>0,

            ))->query();
        $arr = array();

        forEach($model as $k=>$row){
            array_push($arr,$row);
        }

        echo json_encode(array(
            'code' => 200,
            'data' => $arr
        ));
    }
}
