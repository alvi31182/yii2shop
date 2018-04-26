<?php
/**
 * Created by PhpStorm.
 * User: ahala
 * Date: 26.04.2018
 * Time: 0:49
 */

namespace app\modules\admin\controllers;
use yii\web\Controller;
use yii\base\Behavior;
use yii\filters\AccessControl;

class AppAdminController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ],
        ];
    }
}