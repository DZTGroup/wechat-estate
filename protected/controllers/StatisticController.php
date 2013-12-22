<?php

class StatisticController extends Controller
{
    public $layout='//layouts/column2';

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(

            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('view'),
                'expression'=>'$user->isAdmin()',
            ),
        );
    }

    public function actionView()
    {
        $this->render('view');
    }

    public function actionAjaxSearch(){
        $estate_id = $_POST['estate_id'];
        $start_time = $_POST['start_time'];
        $end_time = $_POST['end_time'];

        if(isset($estate_id)){
            $sql = 'select sum(pv_num) as pv,page_name from Statistic where eid="' . $estate_id . '"';
            $sql_uv = 'select page_name, count(distinct open_id) as uv from Statistic where eid="' . $estate_id . '"';
            $time_sql = '';
            if ($start_time && !$end_time) {
                $time_sql = 'time>="' . $start_time . '"';
            } else if ($start_time && $end_time) {
                $time_sql = 'time>="' . $start_time . '" and time<="' . $end_time . '"';
            } else if (!$start_time && $end_time) {
                $time_sql = 'time<="' . $end_time . '"';
            }
            if ($time_sql) {
                $sql = $sql . " and " . $time_sql;
                $sql_uv = $sql_uv . " and " . $time_sql;
            }
            $sql = $sql . ' group by page_name';
            $sql_uv = $sql_uv.'group by page_name';


            $pv = Yii::app()->db
                ->createCommand($sql)
                ->queryAll();
            $uv = Yii::app()->db
                ->createCommand($sql_uv)
                ->queryAll();

            echo json_encode(array(
                'code' => 200,
                'data' => array(
                    'pv'=>$pv,
                    'uv'=>$uv
                )
            ));
        }
    }
}