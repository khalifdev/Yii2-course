<?php


namespace app\components;


use app\base\BaseComponent;
use app\rules\OwnerActivityRule;
use yii\rbac\ManagerInterface;

class RbacInitComponent extends BaseComponent
{
    private $manager;

    public function __construct($config = [])
    {
        parent::__construct($config);

        $this->manager = \Yii::$app->authManager;
    }

//    private function getManager(): ManagerInterface
//    {
//        return \Yii::$app->authManager;
//    }

    public function generateRbac()
    {
//        $manager = $this->getManager();
        $this->manager->removeAll();

        $admin = $this->manager->createRole('admin');
        $user = $this->manager->createRole('user');

        $this->manager->add($admin);
        $this->manager->add($user);

        $rule=new OwnerActivityRule();
        $this->manager->add($rule);

        $createActivity = $this->manager->createPermission('createActivity');
        $createActivity->description = 'Создание активностей';
        $this->manager->add($createActivity);

        $viewOwnerActivity = $this->manager->createPermission('viewOwnerActivity');
        $viewOwnerActivity->description = 'Просмотр своей активности';
        $viewOwnerActivity->ruleName = $rule->name;
        $this->manager->add($viewOwnerActivity);

        $adminActivity = $this->manager->createPermission('adminActivity');
        $adminActivity->description = 'Доступ к любым активностям';
        $this->manager->add($adminActivity);

        $this->manager->addChild($user, $createActivity);
        $this->manager->addChild($user, $viewOwnerActivity);
        $this->manager->addChild($admin, $user);
        $this->manager->addChild($admin, $adminActivity);

        $this->manager->assign($user, 1);
        $this->manager->assign($admin, 2);
    }
}