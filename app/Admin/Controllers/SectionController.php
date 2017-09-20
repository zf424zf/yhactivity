<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/9/2
 * Time: 23:15
 */

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Models\SectionModel;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class SectionController extends Controller
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
            $content->body($this->form(1)->edit($id));
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
            $content->header('新增板块');
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
        return Admin::grid(SectionModel::class, function (Grid $grid) {
            $grid->id('ID')->sortable();
            $grid->name('板块名');
            $grid->remark('备注');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form($isUpdate = 0)
    {
        return Admin::form(SectionModel::class, function (Form $form) use ($isUpdate) {
            if($isUpdate == 1){
                $form->text('name', '板块名')->readOnly()->rules('required');
            }else{
                $form->text('name', '板块名')->rules('required');
            }
            $form->text('remark', '备注(可选)');
        });
    }
}