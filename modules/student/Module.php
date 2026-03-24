<?php

namespace modules\student;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'modules\\student\\controllers';
    public $defaultRoute = 'student/index';

    public function init()
    {
        parent::init();
    }
}

