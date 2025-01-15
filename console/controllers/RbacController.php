<?php


use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit() {
        $auth = Yii::$app->authManager;
        $auth->removeAll(); // удаление всех ролей

        $manager = $auth->getRole('manager');
        if (!$manager) {
            $manager = $auth->createRole('manager');
            $manager->description = 'Менеджер';
            $auth->add($manager);
        }

        $admin = $auth->getRole('admin');
        if (!$admin) {
            $admin = $auth->createRole('admin');
            $admin->description = 'Администратор';
            $auth->add($admin);
        }

        //$auth->addChild($admin, $manager);
    }
}
