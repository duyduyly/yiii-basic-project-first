<?php

namespace modules\auth;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'modules\\auth\\controllers';
    public $defaultRoute = 'auth/index';

    public function init()
    {
        parent::init();
    }
}

