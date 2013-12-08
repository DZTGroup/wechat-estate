<?php

class EstateController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/layout';

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
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'ajaxgetestatebyid','ajaxdelete','ajaxsave'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView()
    {
        $list = Estate::model()->findAll('user_id=:user_id', array(':user_id' => Yii::app()->user->getUserId()));
        $this->render('view', array(
            'list' => $list
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $list = Estate::model()->findAll('user_id=:user_id', array(':user_id' => Yii::app()->user->getUserId()));
        $this->render('create', array(
            'list' => $list
        ));
    }

    public function actionAjaxGetEstateById()
    {
        if (isset($_POST['id'])) {
            $model = Estate::model()->find('id=:id', array(
                ':id' => $_POST['id']
            ));
            if ($model == null) {
                echo json_encode(array(
                    'code' => 200,
                    'data' => array()
                ));
            } else {
                echo json_encode(array(
                    'code' => 200,
                    'data' => array(
                        'id' => $model->id,
                        'wechat_id' => $model->wechat_id,
                        'app_key' => $model->app_key,
                        'app_id' => $model->app_id,
                        'name' => $model->name
                    )
                ));
            }
        }
    }

    public function actionAjaxSave(){
        if(isset($_POST['id'])){
            $id = $_POST['id'];
            $model = Estate::model()->find('id=:id',array(
                'id'=>$id
            ));
        }else{
            $model = new Estate();
        }
        $name = $_POST['name'];
        $app_id = $_POST['app_id'];
        $app_key = $_POST['app_key'];
        $wechat_id = $_POST['wechat_id'];

        $model->name = $name;
        $model->app_id = $app_id;
        $model->app_key = $app_key;
        $model->wechat_id = $wechat_id;
        $model->user_id = YII::app()->user->getUserId();
        $model->save();

        echo json_encode(array(
            'code'=>200,
            'data'=>array(
                'name'=>$model->name,
                'id'=>$model->id,
                'app_id'=>$model->app_id,
                'app_key'=>$model->app_key
            )
        ));
    }

    public function actionAjaxDelete()
    {
        if (isset($_POST['id'])) {
            $model = Yii::app()->db->createCommand()
                ->delete('Estate', 'id=:id', array(
                    'id' => $_POST['id']
                ));

            echo json_encode(array(
                'code' => 200,
                'data' => array()
            ));
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Estate'])) {
            $model->attributes = $_POST['Estate'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
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
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Estate');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Estate('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Estate']))
            $model->attributes = $_GET['Estate'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Estate the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Estate::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Estate $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'estate-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
