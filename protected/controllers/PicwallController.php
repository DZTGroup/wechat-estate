<?php

class PicwallController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/lauout1';

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
                'actions' => array('index', 'search','ajaxsearch','ajaxdelete'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
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


    public function actionCreate()
    {

        $this->render('create');
    }

    public function actionSearch()
    {

        $this->render('search');
    }

    public function actionAjaxSearch()
    {
        if (isset($_POST['estate_id'])) {
            $estate_id = $_POST['estate_id'];
            $start_time = $_POST['start_time'];
            $end_time = $_POST['end_time'];
            $sql = 'select * from Picture_Wall where estate_id="' . $estate_id . '"';
            $time_sql = '';
            if ($start_time && !$end_time) {
                $time_sql = 'create_time>="' . $start_time . '"';
            } else if ($start_time && $end_time) {
                $time_sql = 'create_time>="' . $start_time . '" and create_time<="' . $end_time . '"';
            } else if (!$start_time && $end_time) {
                $time_sql = 'create_time<="' . $end_time . '"';
            }
            if ($time_sql) {
                $sql = $sql . " and " . $time_sql;
            }
            $model = Yii::app()->db
                ->createCommand($sql)
                ->queryAll();

            echo json_encode(array(
                'code' => 200,
                'data' => $model
            ));

        }
    }
    public function actionAjaxDelete()
    {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            Yii::app()->db->createCommand()
                ->delete('Picture_Wall', 'id=:id', array(
                    'id' => $id
                ));

            echo json_encode(array(
                'code' => 200,
                'data' => array()
            ));

        }
    }

}
