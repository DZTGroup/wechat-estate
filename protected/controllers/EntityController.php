<?php

class EntityController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

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

    function  generateId()
    {
        $post = new UUID();
        $post->save();
        return $post->id;
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
                'actions' => array(),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index', 'view', 'ajaxinsert', 'ajaxupdata', 'ajaxgetentitybyestateid', 'create', 'update', 'ajaxgetentitiesbyestateid'),
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



    public function InsertDataToAudit($data)
    {
        $model = Audit::model();

        $model->entity_id = $data['id'];
        $model->operator_id = Yii::app()->user->getUserId();
        $model->entity_status = $data['status'];
        $model->estate_id = $data['estate_id'];
        $model->entity_type = $data['entity_type'];

        $model->save();

    }

    protected function insert($estate_id, $type, $content, $status,$group_id)
    {
        $model = new Entity();
        $model->group_id = $group_id;
        $model->estate_id = $estate_id;
        $model->type = $type;
        $model->content = $content;
        $model->status = $status;
        $result = $model->save();

        $audit = Audit::model()->find('entity_id=:entity_id', array(
            ':entity_id' => $model->id,));
        if ($audit == null) {
            $audit = new Audit();
        }

        $audit->entity_id = $model->id;
        $audit->operator_id = Yii::app()->user->getUserId();
        $audit->entity_status = '0';
        $audit->estate_id = $estate_id;
        $audit->entity_type = $type;

        $audit->save();

        return array(
            'model' => $model,
            'result' => $result
        );

    }

    protected function update($id, $content)
    {
        $model = Entity::model()->find('id=:id', array(
            ':id' => $id,
        ));
        if ($model->status == '0') {
            $model->content = $content;
            $result = $model->save();
            return array(
                'model' => $model,
                'result' => $result
            );
        } else {
            //就直接插一条group_id 一样的
            return $this->insert($model->estate_id, $model->type, $content, '0',$model->group_id);
        }
    }

    public function actionAjaxInsert()
    {
        if (isset($_POST['estate_id']) && $_POST['type'] && $_POST['content']) {
            $estate_id = $_POST['estate_id'];
            $type = $_POST['type'];
            $content = $_POST['content'];

            $r = $this->insert($estate_id, $type, $content, '0',$this->generateId());
            $model = $r['model'];

            $result = $r['result'];
            if ($result) {
                echo json_encode(array(
                    'code' => 200,
                    'data' => array(
                        'estate_id' => $model->estate_id,
                        'type' => $model->type,
                        'content' => $model->content,
                        'status' => $model->status,
                        'group_id' => $model->group_id
                    )
                ));
            } else {
                echo json_encode(array(
                    'code' => 500,
                    'data' => array()
                ));
            }


        }
    }

    public function actionAjaxUpdate()
    {
        if (isset($_POST['id']) && $_POST['content']) {
            $id = $_POST['id'];
            $content = $_POST['content'];

            $r = $this->update($id, $content);
            $model = $r['model'];

            echo json_encode(array(
                'code' => 200,
                'data' => array(
                    'estate_id' => $model->estate_id,
                    'type' => $model->type,
                    'content' => $model->content,
                    'status' => $model->status
                )
            ));
        }
    }

    public function actionAjaxGetEntityByEstateId()
    {
        //根据楼盘ID 拿到对应的'未审核' entity
        if (isset($_POST['estate_id']) && isset($_POST['type'])) {
            $model = Entity::model()->find('estate_id=:estate_id and type=:type and status=:status', array(
                ':estate_id' => $_POST['estate_id'],
                ':type' => $_POST['type'],
                ':status' => '0'
            ));
            if ($model != null) {
                echo json_encode(array(
                    'code' => 200,
                    'data' => array(
                        'estate_id' => $model->estate_id,
                        'content' => $model->content,
                        'type' => $model->type
                    )
                ));
            } else {
                echo json_encode(array(
                    'code' => 200,
                    'data' => array()
                ));
            }
        }
    }

    public function actionAjaxGetEntitiesByEstateId()
    {
        //根据楼盘ID 拿entities

        if (isset($_POST['estate_id']) && isset($_POST['type'])) {
            $group_table = 'select group_id,max(create_time) as create_time from Entity where type="'.$_POST['type'].'" and estate_id="'.$_POST['estate_id'].'" group by group_id';
            $subTable = 'select t2.* from ('.$group_table.')t1 left join Entity t2 on t1.group_id=t2.group_id and t1.create_time=t2.create_time ';
            $list = Yii::app()->db
                ->createCommand('select Estate.name as estate_name ,entity.* from  (' . $subTable . ') as entity,Estate where entity.estate_id=Estate.id')
                ->queryAll();

            echo json_encode(array(
                'code' => 200,
                'data' => $list
            ));
        }
    }

    public function actionAjaxGetEntityById()
    {
        //根据ID 拿entity记录
        if (isset($_POST['id'])) {
            $model = Entity::model()->find('id=:id', array(
                ':id' => $_POST['id']
            ));
            if ($model != null) {
                echo json_encode(array(
                    'code' => 200,
                    'data' => array(
                        'id' => $model->id,
                        'estate_id' => $model->estate_id,
                        'content' => $model->content,
                        'type' => $model->type
                    )
                ));
            } else {
                echo json_encode(array(
                    'code' => 200,
                    'data' => array()
                ));
            }
        }
    }


}
