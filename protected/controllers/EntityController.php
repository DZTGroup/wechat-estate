<?php

class EntityController extends Controller
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
				'actions'=>array(),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view','ajaxsave','ajaxgetentitybyestateid','create','update','ajaxgetimpressionsbyestateid'),
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
		$model=new Entity;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Entity']))
		{
			$model->attributes=$_POST['Entity'];
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

		if(isset($_POST['Entity']))
		{
			$model->attributes=$_POST['Entity'];
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
		$dataProvider=new CActiveDataProvider('Entity');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Entity('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Entity']))
			$model->attributes=$_GET['Entity'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Entity the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Entity::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Entity $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='entity-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    public function InsertDataToAudit($data){
        $model = Audit::model();

        $model->entity_id=$data['id'];
        $model->operator_id=Yii::app()->user->getId();
        $model->entity_status=$data['status'];
        $model->estate_id=$data['estate_id'];
        $model->entity_type=$data['entity_type'];

        $model->save();

    }

    public function actionAjaxSave(){
        if(isset($_POST['estate_id']) && $_POST['type'] && $_POST['content']){
            $estate_id = $_POST['estate_id'];
            $type = $_POST['type'];
            $content = $_POST['content'];

            $model = Entity::model()->find('estate_id=:estate_id and type=:type and status=:status',array(':type'=>$type,':estate_id'=>$estate_id,':status'=>'1'));

            if($model==null){
                $exist = false;
                //没有未审核的数据，插入一条,有的话就update
                $model = new Entity();
            }else{
                $exist = true;
            }

            $model->estate_id = $estate_id;
            $model->type = $type;
            $model->content = $content;
            $model->status = '1';
            $model->save();

            echo json_encode(array(
               'code'=>200,
               'data'=>array(
                   'estate_id'=>$model->estate_id,
                   'type'=>$model->type,
                   'content'=>$model->content,
                   'status'=>$model->status,
                   'exist'=>$exist
               )
            ));
        }
    }

    public function actionAjaxGetEntityByEstateId(){
        //根据楼盘ID 拿到对应的'未审核'
        if(isset($_POST['estate_id']) && isset($_POST['type'])){
            $model = Entity::model()->find('estate_id=:estate_id and type=:type and status=:status',array(
                ':estate_id'=>$_POST['estate_id'],
                ':type'=>$_POST['type'],
                ':status'=>'1'
            ));
            if($model!=null){
                echo json_encode(array(
                    'code'=>200,
                    'data'=>array(
                        'estate_id'=>$model->estate_id,
                        'content'=>$model->content,
                        'type'=>$model->type
                    )
                ));
            }else{
                echo json_encode(array(
                    'code'=>200,
                    'data'=> array()
                ));
            }
        }
    }

    public function actionAjaxGetEntityById(){
        if(isset($_POST['id']) && isset($_POST['type'])){
            $model = Entity::model()->find('estate_id=:estate_id and type=:type and status=:status',array(
                ':estate_id'=>$_POST['estate_id'],
                ':type'=>$_POST['type'],
                ':status'=>'1'
            ));
            if($model!=null){
                echo json_encode(array(
                    'code'=>200,
                    'data'=>array(
                        'estate_id'=>$model->estate_id,
                        'content'=>$model->content,
                        'type'=>$model->type
                    )
                ));
            }else{
                echo json_encode(array(
                    'code'=>200,
                    'data'=> array()
                ));
            }
        }
    }

    public function actionAjaxGetImpressionsByEstateId(){
        if(isset($_POST['estate_id'])){
            $model =Yii::app()->db->createCommand()
                ->select('e2.content as estate_name,e1.*')
                ->from('Entity e1')
                ->join('Entity e2', 'e1.estate_id=e2.estate_id')
                ->where('e2.type="estate" and e1.type="impression" and e1.status="1" and e1.estate_id', array(':estate_id'=>$_POST['estate_id']))
                ->query();

            $arr = array();

            forEach($model as $k=>$row){
                array_push($arr,$row);
            }

            echo json_encode(array(
                'code' => 200,
                'data' => $arr
            ));

            return;
        }
    }

}
