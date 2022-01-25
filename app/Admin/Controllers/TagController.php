<?php

namespace App\Admin\Controllers;

use App\Models\Tag;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class TagController extends AdminController
{
	/**
	 * @var string
	 */
	protected $title = 'Tags';
	
	/**
	 * @return string
	 */
	protected function grid()
	{
		$grid = new Grid(new Tag);
		
		$grid->column('id', __('Id'))->sortable();
		$grid->column('name', __('Name'))->sortable();
		$grid->column('stem', __('Stem'))->sortable();
		
		$grid->disableExport();
		
		return $grid;
	}
	
	/**
	 * @param int $id
	 * @return Show
	 */
	protected function detail(int $id)
	{
		$show = new Show(Tag::findOrFail($id));
		
		$show->field('id', __('Id'));
		$show->field('name', __('Name'));
		$show->field('stem', __('Stem'));
		
		return $show;
	}
	
	/**
	 * @return string
	 */
	protected function form()
	{
		$form = new Form(new Tag);
		
		$form->display('id', __('Id'));
		$form->text('name', __('Name'))->required();
		$form->text('stem', __('Stem'))->required();
		
		return $form;
	}
}
