<?php


namespace console\controllers;

use common\modules\user\models\User;
use Yii;
use yii\console\ExitCode;
use yii\helpers\Console;


class RbacController extends \yii\console\Controller
{
    public function actionAddRole($id, $name)
    {
        if(!$id || is_int($id)) {
            $this->stdout("'Param 'id' must be set!\n", Console::BG_RED);

            return ExitCode::UNSPECIFIED_ERROR;
        }

        //Есть ли пользователь с таким id
        $user = (new User())->findIdentity($id);
        if(!$user){
            // throw new \yii\base\InvalidConfigException("User witch id:'$id' is not found");
            $this->stdout("User witch id:'$id' is not found!\n", Console::BG_RED);
            return ExitCode::UNSPECIFIED_ERROR;
        }

        //Получаем объект yii\rbac\DbManager, который назначили в конфиге для компонента authManager
        $auth = Yii::$app->authManager;

        //Получаем объект роли
        $role = $auth->getRole($name);

        //Удаляем все роли пользователя
        $auth->revokeAll($id);

        //Присваиваем роль админа по id
        $auth->assign($role, $id);

        //Выводим сообщение об успехе и возвращаем соответствующий код
        $this->stdout("Done!\n", Console::BOLD);
        return ExitCode::OK;
    }

    public function actionMakeRoles() {

        $auth = Yii::$app->authManager;

        // добавляем роль "user"
        $user = $auth->createRole('user');
        $auth->add($user);

        // добавляем роль "user"
        $manager = $auth->createRole('manager');
        $auth->add($manager);

        // добавляем роль "admin"
        $admin = $auth->createRole('admin');
        $auth->add($admin);


        $auth->addChild($admin, $manager);

        $auth->addChild($manager, $user);
    }
}