<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/9/17
 * Time: 22:02
 */

namespace App\Admin\Controllers;


use App\Http\Api\VideoChild;
use App\Http\Controllers\Controller;
use App\Http\Models\SelfVideoModel;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
class SelfVideoController extends Controller
{
    use ModelForm;

    public $sections = [
        VideoChild::VIDEO_SS=>'时尚',
        VideoChild::VIDEO_NS=>'美食',
        VideoChild::VIDEO_MZ=>'美妆',
        VideoChild::VIDEO_LX=>'旅行'
    ];

    public function index()
    {
        return Admin::content(function (Content $content) {
            $content->header('视频首页显示');
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
            $content->header('编辑视频');
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
            $content->header('新增视频');
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
        return Admin::grid(SelfVideoModel::class, function (Grid $grid) {
            $grid->order('排序')->sortable();
            $grid->nickname('问题');
            $grid->path('视频地址');
            $grid->cover('封面图');
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
        return Admin::form(SelfVideoModel::class, function (Form $form) {
            $form->text('order', '排序')->rules('required|integer');
            $form->text('nickname', '昵称')->rules('required');
            $form->text('headicon', '头像');
            $form->text('path', '视频地址');
            $form->text('cover', '封面图');
            $form->select('module', '模块')->rules('required')->options($this->sections);
        });
    }
}