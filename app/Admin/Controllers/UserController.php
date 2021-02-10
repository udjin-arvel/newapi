<?php

namespace App\Admin\Controllers;

use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Пользователи книги';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User);

        $grid->column('id', __('Id'));
        $grid->column('name', __('Имя'));
        $grid->column('email', __('Email'));
        
        $grid->column('created_at', __('Создан'))
            ->sortable()
            ->display(function ($date) {
                return date("d.m.Y (H:i:s)", strtotime($date));
            });
        
        $grid->column('level', __('Уровень'))->sortable();
        $grid->column('experience', __('Опыт'))->sortable();
        
        $grid->column('status', __('Статус'))
            ->display(function ($status) {
                return array_key_exists($status, User::getStatuses())
                    ? User::getStatuses()[$status]
                    : 'Неопределен';
            });
        
        $grid->column('age', __('Возраст'));
        $grid->column('sex', __('Пол'));
        $grid->column('city', __('Город'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('full_name', __('Full name'));
        $show->field('email', __('Email'));
        $show->field('email_verified_at', __('Email verified at'));
        $show->field('password', __('Password'));
        $show->field('remember_token', __('Remember token'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('level', __('Level'));
        $show->field('experience', __('Experience'));
        $show->field('status', __('Status'));
        $show->field('poster', __('Poster'));
        $show->field('age', __('Age'));
        $show->field('sex', __('Sex'));
        $show->field('city', __('City'));
        $show->field('info', __('Info'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User);

        $form->text('name', __('Name'));
        $form->text('full_name', __('Full name'));
        $form->email('email', __('Email'));
        $form->datetime('email_verified_at', __('Email verified at'))->default(date('Y-m-d H:i:s'));
        $form->password('password', __('Password'));
        $form->text('remember_token', __('Remember token'));
        $form->switch('level', __('Level'))->default(1);
        $form->number('experience', __('Experience'));
        $form->switch('status', __('Status'))->default(1);
        $form->text('poster', __('Poster'));
        $form->switch('age', __('Age'));
        $form->switch('sex', __('Sex'));
        $form->text('city', __('City'));
        $form->text('info', __('Info'));

        return $form;
    }
}
