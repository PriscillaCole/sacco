<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use \App\Models\Saving;

class SavingController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Saving';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Saving());

        $grid->column('user_id', __('User id'));
        $grid->column('sacco_id', __('Sacco id'));
        $grid->column('amount', __('Amount'));
        $grid->column('date', __('Date'));
        $grid->column('description', __('Description'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Saving::findOrFail($id));

        $show->field('user_id', __('User id'));
        $show->field('sacco_id', __('Sacco id'));
        $show->field('amount', __('Amount'));
        $show->field('date', __('Date'));
        $show->field('description', __('Description'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Saving());

        $form->number('user_id', __('User id'));
        $form->number('sacco_id', __('Sacco id'));
        $form->decimal('amount', __('Amount'));
        $form->date('date', __('Date'))->default(date('Y-m-d'));
        $form->textarea('description', __('Description'));

        return $form;
    }
}
