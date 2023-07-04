<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use \App\Models\Sacco;

class SaccoController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Sacco';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Sacco());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('type', __('Type'));
        $grid->column('email', __('Email'));
        $grid->column('phone_number', __('Phone number'));
        $grid->column('bank_account_number', __('Bank account number'));
        $grid->column('mobile_money_number', __('Mobile money number'));

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
        $show = new Show(Sacco::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('type', __('Type'));
        $show->field('physical_address', __('Physical address'));
        $show->field('email', __('Email'));
        $show->field('phone_number', __('Phone number'));
        $show->field('bank_account_number', __('Bank account number'));
        $show->field('mobile_money_number', __('Mobile money number'));
        $show->field('sacco_license', __('Sacco license'));
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
        $form = new Form(new Sacco());

        $form->text('name', __('Name'));
        $form->text('type', __('Type'));
        $form->text('physical_address', __('Physical address'));
        $form->email('email', __('Email'));
        $form->text('phone_number', __('Phone number'));
        $form->text('bank_account_number', __('Bank account number'));
        $form->text('mobile_money_number', __('Mobile money number'));
        $form->file('sacco_license', __('Sacco license'));
        
        //return to list after saving
        $form->saved(function (Form $form) {
            return redirect(admin_url('saccos'));
        });

        return $form;
    }
}
