<?php

use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;

Form::forget(['map', 'editor']);
    
Admin::css('/css/bootstrap.min.css');
Admin::css('/css/admin.css');

Admin::js('/js/bootstrap.bundle.min.js');
