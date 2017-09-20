<?php

namespace App\Admin\Controllers;
use App\Http\Api\VideoChild;
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

    public $module = [
        VideoChild::VIDEO_SS=>'时尚话题',
        VideoChild::VIDEO_LX=>'旅行话题',
        VideoChild::VIDEO_MZ=>'美妆话题',
        VideoChild::VIDEO_NS=>'美食话题',
        ];
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
            $grid->moduleCN('模块');
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
            $form->select('module', '板块')->options($this->module)->rules('required');
        });
    }
}