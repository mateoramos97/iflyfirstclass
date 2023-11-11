<?php

namespace common\components\rbac;
use Yii;
use yii\rbac\Rule;
class UserRoleRule extends Rule
{
    public $name = 'userRole';
    public function execute($user, $item, $params)
    {
        if(!Yii::$app->user->isGuest) {
            $group = Yii::$app->authManager->getRolesByUser($user);
            if ($item->name === 'developer') {
                return isset($group[$item->name]);
            } elseif ($item->name === 'admin') {
                return isset($group[$item->name]);
            }
        }
        return false;
    }
}