<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/9/3
 * Time: 0:21
 */

namespace App\Admin\Controllers;


use App\Http\Controllers\Controller;
use App\Http\Models\SectionModel;
use App\Http\Models\LuckyModel;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class LuckyController extends Controller
{
    use ModelForm;

    public $times;
    public $sections;

    public function __construct()
    {
        $this->times = ['9.25-10.1'=>'9.25-10.1', '10.2-10.8'=>'10.2-10.8', '10.9-10.15'=>'10.9-10.15', '10.16-10.22'=>'10.16-10.22', '10.23-10.25'=>'10.23-10.25'];
        $this->sections = SectionModel::pluck('name', 'id');
    }

    public function index()
    {
        return Admin::content(function (Content $content) {
            $content->header('中奖名单列表');
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
            $content->header('编辑中奖信息');
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
            $content->header('新增中奖信息');
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
        return Admin::grid(LuckyModel::class, function (Grid $grid) {
            $grid->id('ID')->sortable();
            $grid->sectionName('板块名');
            $grid->title('显示标题');
            $grid->time('期数');
            $grid->names('获奖名单');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(LuckyModel::class, function (Form $form) {
            $form->select('section', '模块')->options($this->sections);
            $form->select('time', '时间段')->options($this->times);
            $form->text('names', '中奖名单')->help('名字与名字之间用英文状态下的;隔开。例如:张三;李四;王二')->rules('required');
            $form->text('title', '标题')->help('例如:第一期中奖名单')->rules('required');
        });
    }
}