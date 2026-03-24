<?php

namespace modules\clazz;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'modules\\clazz\\controllers';
    public $defaultRoute = 'clazz/index';

    public function init()
    {
        parent::init();
    }
}

