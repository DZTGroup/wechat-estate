<?php

class WatchController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/layout';

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
				'actions'=>array('index','search'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','ajaxwatchlist','ajaxvisitsearch'),
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


	public function actionCreate()
	{

		$this->render('create');
	}

    public  function actionAjaxWatchList(){
        if (isset($_POST['estate_id'])) {
            $id = $_POST['estate_id'];

            $list = Yii::app()->db
                ->createCommand('select * from Entity where estate_id='.$id.' and type="group"')
                ->queryAll();
            echo json_encode(array(
                'code' => 200,
                'data' => $list
            ));
        }
    }
    public  function actionAjaxVisitSearch(){
        if (isset($_POST['estate_id']) && isset($_POST['entity_id'])) {
            $estate_id = $_POST['estate_id'];
            $entity_id = $_POST['entity_id'];

            $list = Yii::app()->db
                ->createCommand('select * from Customer_Visit where estate_id='.$estate_id.' and entity_id='.$entity_id)
                ->queryAll();
            echo json_encode(array(
                'code' => 200,
                'data' => $list
            ));
        }
    }

    public function actionSearch(){
        $this->render('search');
    }


}
