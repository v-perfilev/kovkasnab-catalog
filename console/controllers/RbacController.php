<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {

        $auth = Yii::$app->authManager;

        // create and add "user" role
        $user = $auth->createRole('user');
        $user->description = 'Пользователь';
        $auth->add($user);

        // create and add "admin" role
        $admin = $auth->createRole('admin');
        $admin->description = 'Администратор';
        $auth->add($admin);

    }
}