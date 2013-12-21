<?php

class UserpicwallController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='';

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
				'actions'=>array('index','view','list','ajaxgetpicwalldata'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
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
		$model=new UserPictureWall;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['UserPictureWall']))
		{
			$model->attributes=$_POST['UserPictureWall'];
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

		if(isset($_POST['UserPictureWall']))
		{
			$model->attributes=$_POST['UserPictureWall'];
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
		$dataProvider=new CActiveDataProvider('UserPictureWall');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

    public function actionList()
    {
        $this->render('list');
    }

    public function actionAjaxGetPicWallData(){
        $estate_id=$_POST["eid"];
        $pagesize = $_POST["pagesize"];
        $pageindex = $_POST["pageindex"];

        $num_start = $pagesize * ($pageindex - 1);

        $model = Yii::app()->db->createCommand()
            ->select('*')
            ->from('Picture_Wall')
            ->where('estate_id=:estate_id order by create_time desc limit '.$num_start.','.$pagesize,array(':estate_id'=>$estate_id))
            ->query();

        $count=Yii::app()->db->createCommand()
            ->select('count(1) as total')
            ->from('Picture_Wall')
            ->where('estate_id=:estate_id order by create_time desc',array(':estate_id'=>$estate_id))
            ->query();

        $count_temp=array();
        forEach($count as $k=>$row)
        {
            array_push($count_temp,$row);
        }

        $arr_pic=array();
        forEach($model as $k=>$row){
            $id=$row['wechat_id'];
            $ts=$row['create_time'];
            $url=$row['url'];
            $pic_array=array('createts'=>$ts,'height'=>0,'id'=>$id,'nickname'=>$id,
                'thumbnailurl'=>'','url'=>$url,'width'=>0);
            array_push($arr_pic,$pic_array);
        }
        $data=array('msg'=>'ok','ret'=>0,'picture'=>$arr_pic,
                    'ret'=>0,'total'=>$count_temp[0]['total'],);

        echo json_encode(array(
            'code' => 200,
            'data' =>$data,
        ));
    }

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new UserPictureWall('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['UserPictureWall']))
			$model->attributes=$_GET['UserPictureWall'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return UserPictureWall the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=UserPictureWall::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param UserPictureWall $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-picture-wall-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
