<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Form\NestedForm;
use \App\Models\SaccoMember;
use \App\Models\Sacco;
use Encore\Admin\Facades\Admin;


class ApplicationController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'SaccoMember';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SaccoMember());
       //show the user only their requests
        $user = Admin::user();
        if($user->isRole('sacco')){
            $sacco_email = Admin::user()->email;
            $sacco = Sacco::where('email', $sacco_email)->first();
            $grid->model()->where('sacco_id', $sacco->id)->where('status', '!=', 'accepted')->orderBy('id', 'desc');
        } 

        
        //disable create button
        $grid->disableCreateButton();

        //disable delete action button
        $grid->actions(function ($actions) {
            $actions->disableDelete();
        });
        
        $grid->column('full_name', __('Full name'));
        $grid->column('image', __('Image'));
        $grid->column('email', __('Email'));
        $grid->column('phone_number', __('Phone number'));
        $grid->column('membership_type', __('Membership type'));
        $grid->column('membership_id', __('Membership id'));
       

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
        $show = new Show(SaccoMember::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('full_name', __('Full name'));
        $show->field('date_of_birth', __('Date of birth'));
        $show->field('gender', __('Gender'));
        $show->field('image', __('Image'));
        $show->field('nationality', __('Nationality'));
        $show->field('identification_number', __('Identification number'));
        $show->field('physical_address', __('Physical address'));
        $show->field('postal_address', __('Postal address'));
        $show->field('email', __('Email'));
        $show->field('phone_number', __('Phone number'));
        $show->field('employment_status', __('Employment status'));
        $show->field('employer_name', __('Employer name'));
        $show->field('monthly_income', __('Monthly income'));
        $show->field('bank_account_number', __('Bank account number'));
        $show->field('bank_name', __('Bank name'));
        $show->field('membership_type', __('Membership type'));
        $show->field('membership_id', __('Membership id'));
        $show->field('date_of_joining', __('Date of joining'));
        $show->field('next_of_kin_name', __('Next of kin name'));
        $show->field('next_of_kin_contact', __('Next of kin contact'));
        $show->field('beneficiary_name', __('Beneficiary name'));
        $show->field('beneficiary_relationship', __('Beneficiary relationship'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        //disable the delete button
        $show->panel()->tools(function ($tools) {
            $tools->disableDelete();
        });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new SaccoMember());
       
       $user = Admin::user();

     //show the sacco only requests from members
      if($form->isEditing()){
        $sacco_email = Admin::user()->email;
        $sacco = Sacco::where('email', $sacco_email)->first();
        $form->display('sacco_id', __('Sacco'))->default($sacco->name); 

        $form->display('full_name', __('Full name'));
        $form->display('date_of_birth', __('Date of birth'))->default(date('Y-m-d'));
        $form->display('gender', __('Gender'));
        $form->display('image', __('Image'));
        $form->display('nationality', __('Nationality'));
        $form->display('identification_number', __('Identification number'));
        $form->display('physical_address', __('Physical address'));
        $form->display('postal_address', __('Postal address'));
        $form->display('email', __('Email'));
        $form->display('phone_number', __('Phone number'));
        $form->display('employment_status', __('Employment status'));
        $form->display('employer_name', __('Employer name'));
        $form->display('monthly_income', __('Monthly income'));
        $form->display('bank_account_number', __('Bank account number'));
        $form->display('bank_name', __('Bank name'));
        $form->display('membership_type', __('Membership type'));
        $form->display('membership_id', __('Membership id'));
        $form->display('date_of_joining', __('Date of joining'))->default(date('Y-m-d'));
        $form->display('next_of_kin_name', __('Next of kin name'));
        $form->display('next_of_kin_contact', __('Next of kin contact'));
        $form->display('beneficiary_name', __('Beneficiary name'));
        $form->display('beneficiary_relationship', __('Beneficiary relationship'));
        $form->divider();
        $form->select('status', __('Status'))->options(['pending' => 'Pending', 'accepted' => 'Accepted', 'rejected' => 'Rejected'])->rules('required');
        $form->textarea('reason', __('Reason for rejection'))->rules('required_if:status,rejected');
     
      }

      //disable the delete button
        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
        });


       // return to list after saving
        $form->saved(function (Form $form) {
            return redirect(admin_url('sacco-members'));
        });
        
        

        return $form;
    }
}
