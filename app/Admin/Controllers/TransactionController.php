<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use \App\Models\Transaction;

class TransactionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Transaction';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Transaction());

        $grid->column('id', __('Id'));
        $grid->column('member_id', __('Member id'));
        $grid->column('transaction_type', __('Transaction type'));
        $grid->column('amount', __('Amount'));
        $grid->column('status', __('Status'));
        $grid->column('comment', __('Comment'));
        $grid->column('date', __('Date'));
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
        $show = new Show(Transaction::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('member_id', __('Member id'));
        $show->field('transaction_type', __('Transaction type'));
        $show->field('amount', __('Amount'));
        $show->field('status', __('Status'));
        $show->field('comment', __('Comment'));
        $show->field('date', __('Date'));
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
        $form = new Form(new Transaction());

        $form->number('member_id', __('Member id'));
        $form->text('transaction_type', __('Transaction type'));
        $form->decimal('amount', __('Amount'));
        $form->text('status', __('Status'));
        $form->text('comment', __('Comment'));
        $form->date('date', __('Date'))->default(date('Y-m-d'));

        return $form;
    }
}
