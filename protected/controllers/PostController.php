<?php

class PostController extends Controller
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
				'actions'=>array('index','view','list','ajaxcreatenewcomment','ajaxgetpostlist','ajaxcreatenewpost','detail','ajaxgetpostdetail'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','update'),
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
		$model=new BBSPost;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['BBSPost']))
		{
			$model->attributes=$_POST['BBSPost'];
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

		if(isset($_POST['BBSPost']))
		{
			$model->attributes=$_POST['BBSPost'];
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
		$dataProvider=new CActiveDataProvider('BBSPost');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

    public function actionList()
    {
        $this->render('list');
    }

    public function actionDetail(){

        $this->render('detail');
    }

    public function actionAjaxGetPostList(){
        $page_size=3;
        $model = Yii::app()->db->createCommand()
            ->select('p.*,sum(case when c.post_id is not null then 1 else 0 end) as comment_num')
            ->from('BBS_Post p')
            ->leftJoin('BBS_Comment c','p.id=c.post_id')
            ->where('estate_id=:estate_id group by p.id order by create_time desc limit 0,'.$page_size*$_POST['page_num'],array(':estate_id'=>$_POST['estate_id']))
            ->query();
        if($model!==null){

            BBSPost::model()->updateAll(array('pv_num'=>new CDbExpression('pv_num+1')),'estate_id=:estate_id',
                array(':estate_id'=>$_POST['estate_id'],));
            $arr = array();

            forEach($model as $k=>$row){
                array_push($arr,$row);
            }

            echo json_encode(array(
                'code' => 200,
                'data' => $arr
            ));
        }
        else{
            echo json_encode(array(
                'code' => 500
            ));
        }

    }

    public function actionAjaxGetPostDetail(){
        $model = Yii::app()->db->createCommand()
            ->select('*')
            ->from('BBS_Post')
            ->where('id=:id',array(':id'=>$_POST['id']))
            ->query();
        $comment= Yii::app()->db->createCommand()
            ->select('*')
            ->from('BBS_Comment')
            ->where('post_id=:post_id order by create_time desc',array(':post_id'=>$_POST['id']))
            ->query();

        BBSPost::model()->updateByPk($_POST['id'],array('pv_num'=>new CDbExpression('pv_num+1')));

        $arr = array();

        forEach($model as $k=>$row){
            array_push($arr,$row);
        }

        $arr_comment=array();
        forEach($comment as $k=>$row){
            array_push($arr_comment,$row);
        }

        echo json_encode(array(
            'code' => 200,
            'data' => $arr,
            'comment'=>$arr_comment
        ));
    }

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new BBSPost('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['BBSPost']))
			$model->attributes=$_GET['BBSPost'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return BBSPost the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=BBSPost::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param BBSPost $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='bbspost-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    public function actionAjaxCreateNewPost(){
        $bbs_post=new BBSPost();
        $bbs_post->estate_id = $_POST['estate_id'];
        $bbs_post->title = $_POST['post_title'];
        $bbs_post->content = $_POST['post_content'];
        $bbs_post->wechat_id = $_POST['wechat_id'];

        $result=$bbs_post->save();
        if ($result) {
            echo json_encode(array(
                'code' => 200,
            ));
        } else {
            echo json_encode(array(
                'code' => 500,
            ));
        }
    }

    public function actionAjaxCreateNewComment(){
        $bbs_comment=new BBSComment();
        $bbs_comment->post_id = $_POST['post_id'];
        $bbs_comment->content = $_POST['comment_content'];
        $bbs_comment->wechat_id = $_POST['wechat_id'];

        $result=$bbs_comment->save();
        if ($result) {
            echo json_encode(array(
                'code' => 200,
            ));
        } else {
            echo json_encode(array(
                'code' => 500,
            ));
        }
    }
}
