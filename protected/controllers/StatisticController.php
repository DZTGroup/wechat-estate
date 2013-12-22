<?php

class StatisticController extends Controller
{


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
}