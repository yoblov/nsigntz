<?php

namespace common\filters;

use common\models\User;
use Yii;

class AccessRule extends \yii\filters\AccessRule
{
    /** @inheritdoc */
    protected function matchRole($user)
    {

        if (empty($this->roles)) {
            return false;
        }
        $access = false;
        $user = Yii::$app->user;
        foreach ($this->roles as $role) {
            switch ($role) {
                case '?':
                    $access |= $user->isGuest;
                    break;
                case '@':
                    $access |= !$user->isGuest;
                    break;
                case 'admin':
                    $access |= !$user->isGuest && $user->identity->role === 1;
                    break;
            }
        }
        return $access;
    }
}