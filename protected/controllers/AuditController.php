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
				'actions'=>array('index','view','ajaxupdateauditbyid','group'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','estate','ajaxgetauditestatedata'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Audit;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Audit']))
		{
			$model->attributes=$_POST['Audit'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Audit']))
		{
			$model->attributes=$_POST['Audit'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Audit');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Audit('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Audit']))
			$model->attributes=$_GET['Audit'];

		$this->render('admin',array(
			'model'=>$model,
		));
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
    public function actionAjaxGetAuditEstateData(){

        $model = Yii::app()->db->createCommand()
            ->select('e1.*,e2.name,e3.name as username')
            ->from('Audit e1')
            ->join('Estate e2', 'e1.estate_id=e2.id')
            ->join('User e3','e3.id=e1.operator_id')
            ->where('e1.entity_type=:entity_type and e1.entity_status=:status', array(
                ':entity_type'=>'estate',
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
        $count2 =Entity::model()->updateByPk($_POST['entity_id'],array('status'=>$_POST['status']));
        if($count1>0&&$count2>0){
            echo json_encode(array(
                'code'=>200,
                'data'=> array()
            ));
        }
    }

}
