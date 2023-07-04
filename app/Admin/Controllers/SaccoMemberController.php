<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Form\NestedForm;
use \App\Models\SaccoMember;
use \App\Models\Sacco;
use \App\Models\SaccoUser;


class SaccoMemberController extends AdminController
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

        $form->hasMany('sacco',__('Select Sacco'),
        function (NestedForm $form)
        {   
              //get available saccos from the database
            $saccos = Sacco::all();
            $saccoArray = [];
            foreach ($saccos as $sacco) {
                $saccoArray[$sacco->id] = $sacco->name;
        }

        $form->select('sacco_id', __('Sacco'))->options($saccoArray)->rules('required'); 
        });  
        $form->text('full_name', __('Full name'));
        $form->date('date_of_birth', __('Date of birth'))->default(date('Y-m-d'));
        $form->text('gender', __('Gender'));
        $form->image('image', __('Image'));
        $form->text('nationality', __('Nationality'));
        $form->text('identification_number', __('Identification number'));
        $form->text('physical_address', __('Physical address'));
        $form->text('postal_address', __('Postal address'));
        $form->email('email', __('Email'));
        $form->text('phone_number', __('Phone number'));
        $form->text('employment_status', __('Employment status'));
        $form->text('employer_name', __('Employer name'));
        $form->decimal('monthly_income', __('Monthly income'));
        $form->text('bank_account_number', __('Bank account number'));
        $form->text('bank_name', __('Bank name'));
        $form->text('membership_type', __('Membership type'));
        $form->text('membership_id', __('Membership id'));
        $form->date('date_of_joining', __('Date of joining'))->default(date('Y-m-d'));
        $form->text('next_of_kin_name', __('Next of kin name'));
        $form->text('next_of_kin_contact', __('Next of kin contact'));
        $form->text('beneficiary_name', __('Beneficiary name'));
        $form->text('beneficiary_relationship', __('Beneficiary relationship'));
        $form->hidden('password', __('Password'))->default('12345678');

       // return to list after saving
        $form->saved(function (Form $form) {
            return redirect(admin_url('sacco-members'));
        });
        
        $form->setAction(route('custom-store'));

        return $form;
    }
}
