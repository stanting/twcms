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
                'theme' => '主题',
                'plugin' => '插件',
                'tool' => '工具',
            ],
            'child' => [
                'my' => [
                    route('admin.my.index') => '后台首页',
                    route('admin.password.index') => '修改密码',
                ],
                'setting' => [
                    'setting-index' => '基本设置',
                    'setting-seo' => 'SEO设置',
                    'setting-link' => '链接设置',
                    'setting-attach' => '上传设置',
                    'setting-image' => '图片设置',
                ],
                'category' => [
                    'category-index' => '分类管理',
                    'navigate-index' => '导航管理',
                ],
                'content' => [
                    'article-index' => '文章管理',
                    'product-index' => '产品管理',
                    'photo-index' => '图集管理',
                    'comment-index' => '评论管理',
                    'tag-index' => '标签管理',
                ],
                'theme' => [
                    'theme-index' => '主题管理',
                ],
                'plugin' => [
                    'links-index' => '友情链接',
                ],
                'tool' => [
                    'tool-index' => '清除缓存',
                    'tool-rebuild' => '重新统计',
                ],
            ],
        ]);
    }
}
