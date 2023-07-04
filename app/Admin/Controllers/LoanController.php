<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use \App\Models\Loan;

class LoanController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Loan';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Loan());

        $grid->column('id', __('Id'));
        $grid->column('user_id', __('User id'));
        $grid->column('sacco_id', __('Sacco id'));
        $grid->column('name', __('Name'));
        $grid->column('address', __('Address'));
        $grid->column('city', __('City'));
        $grid->column('tin', __('Tin'));
        $grid->column('loan_amount', __('Loan amount'));
        $grid->column('purpose', __('Purpose'));
        $grid->column('guarantor', __('Guarantor'));
        $grid->column('source_of_repayment', __('Source of repayment'));
        $grid->column('picture_id', __('Picture id'));
        $grid->column('are_you_a_member', __('Are you a member'));
        $grid->column('collateral_description', __('Collateral description'));
        $grid->column('term_required', __('Term required'));
        $grid->column('status', __('Status'));
        $grid->column('comment', __('Comment'));
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
        $show = new Show(Loan::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('sacco_id', __('Sacco id'));
        $show->field('name', __('Name'));
        $show->field('address', __('Address'));
        $show->field('city', __('City'));
        $show->field('tin', __('Tin'));
        $show->field('loan_amount', __('Loan amount'));
        $show->field('purpose', __('Purpose'));
        $show->field('guarantor', __('Guarantor'));
        $show->field('source_of_repayment', __('Source of repayment'));
        $show->field('picture_id', __('Picture id'));
        $show->field('are_you_a_member', __('Are you a member'));
        $show->field('collateral_description', __('Collateral description'));
        $show->field('term_required', __('Term required'));
        $show->field('status', __('Status'));
        $show->field('comment', __('Comment'));
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
        $form = new Form(new Loan());

        $form->number('user_id', __('User id'));
        $form->number('sacco_id', __('Sacco id'));
        $form->text('name', __('Name'));
        $form->text('address', __('Address'));
        $form->text('city', __('City'));
        $form->text('tin', __('Tin'));
        $form->text('loan_amount', __('Loan amount'));
        $form->text('purpose', __('Purpose'));
        $form->text('guarantor', __('Guarantor'));
        $form->text('source_of_repayment', __('Source of repayment'));
        $form->text('picture_id', __('Picture id'));
        $form->text('are_you_a_member', __('Are you a member'));
        $form->text('collateral_description', __('Collateral description'));
        $form->text('term_required', __('Term required'));
        $form->text('status', __('Status'));
        $form->text('comment', __('Comment'));

      
        return $form;
    }
}
