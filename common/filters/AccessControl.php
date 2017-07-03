<?php

namespace common\filters;

class AccessControl extends \yii\filters\AccessControl
{
    public $ruleConfig = ['class' => 'common\filters\AccessRule'];
}