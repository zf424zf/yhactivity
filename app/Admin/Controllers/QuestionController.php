<?php

namespace App\Admin\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Models\QuestionModel;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class QuestionController extends Controller
{
    use ModelForm;

    public function index()
    {
        return Admin::content(function (Content $content) {
            $content->header('问题列表');
            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {
            $content->header('编辑问题');
            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {
            $content->header('新增问题');
            $content->body($this->form());
        });
    }
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(QuestionModel::class, function (Grid $grid) {
            $grid->id('ID')->sortable();
            $grid->question('问题');
            $grid->order('排序');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(QuestionModel::class, function (Form $form) {
            $form->text('question', '问题')->rules('required');
            $form->text('order', '排名(可选)')->rules('required')->help('如果不填，则按问题填写的顺序排名');

        });
    }
}