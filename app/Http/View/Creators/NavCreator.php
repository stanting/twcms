<?php

namespace App\Http\View\Creators;

use Illuminate\View\View;

class NavCreator
{
    public function create(View $view)
    {
        $view->with('nav', [
            'menu' => [
                'my' => '我的',
                'setting' => '设置',
                'category' => '分类',
                'content' => '内容',
//                'theme' => '主题',
                'plugin' => '插件',
                'tool' => '工具',
            ],
            'child' => [
                'my' => [
                    route('admin.my.my.index') => '后台首页',
                    route('admin.my.password.index') => '修改密码',
                ],
                'setting' => [
                    route('admin.setting.base.index') => '基本设置',
                    route('admin.setting.seo.index') => 'SEO设置',
                    route('admin.setting.link.index') => '链接设置',
                    route('admin.setting.upload.index') => '上传设置',
                    route('admin.setting.image.index') => '图片设置',
                ],
                'category' => [
                    route('admin.category.category.index') => '分类管理',
                    route('admin.category.navigate.index') => '导航管理',
                ],
                'content' => [
                    route('admin.content.article.index') => '文章管理',
                    route('admin.content.product.index') => '产品管理',
                    route('admin.content.photo.index') => '图集管理',
                    route('admin.content.comment.index') => '评论管理',
                    route('admin.content.tag.index') => '标签管理',
                ],
//                'theme' => [
//                    'theme-index' => '主题管理',
//                ],
                'plugin' => [
                    route('admin.plugin.link.index') => '友情链接',
                ],
                'tool' => [
                    route('admin.tool.cache.index') => '清除缓存',
                    route('admin.tool.count.index') => '重新统计',
                ],
            ],
        ]);
    }
}
