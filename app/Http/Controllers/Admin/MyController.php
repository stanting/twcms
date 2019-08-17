<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MyController extends Controller
{
    protected $used = [
        ['name'=>'发布文章', 'url'=>'article-add', 'img'=>'admin-static/ico/article_add.jpg'],
        ['name'=>'文章管理', 'url'=>'article-index', 'img'=>'admin-static/ico/article_index.jpg'],
        ['name'=>'发布产品', 'url'=>'product-add', 'img'=>'admin-static/ico/product_add.jpg'],
        ['name'=>'产品管理', 'url'=>'product-index', 'img'=>'admin-static/ico/product_index.jpg'],
        ['name'=>'发布图集', 'url'=>'photo-add', 'img'=>'admin-static/ico/photo_add.jpg'],
        ['name'=>'图集管理', 'url'=>'photo-index', 'img'=>'admin-static/ico/photo_index.jpg'],
        ['name'=>'评论管理', 'url'=>'comment-index', 'img'=>'admin-static/ico/comment_index.jpg'],
        ['name'=>'分类管理', 'url'=>'category-index', 'img'=>'admin-static/ico/category_index.jpg'],
    ];
    
    protected function serverInfo()
    {
        return [
            'os' => php_uname(),
            'software' => $_SERVER['SERVER_SOFTWARE'],
            'php_version' => PHP_VERSION,
            'mysql' => DB::select('select version() as version')[0]->version,
            'filesize' => ini_get('upload_max_filesize'),
            'exectime' => ini_get('max_execution_time'),
            'url_fopen' => ini_get('allow_url_fopen') ? 'Yes' : 'No',
            'other' => $this->getExtensions(),
        ];
    }
    
    protected function getExtensions()
    {
        $s = '';
        if(extension_loaded('gd')) {
            function_exists('imagepng') && $s .= 'png ';
            function_exists('imagejpeg') && $s .= 'jpg ';
            function_exists('imagegif') && $s .= 'gif ';
        }
        extension_loaded('iconv') && $s .= 'iconv ';
        extension_loaded('mbstring') && $s .= 'mbstring ';
        extension_loaded('zlib') && $s .= 'zlib ';
        extension_loaded('ftp') && $s .= 'ftp ';
        function_exists('fsockopen') && $s .= 'fsockopen';
        return $s;
    }

        
    public function index()
    {
        return view('admin.my.index')
                ->with('used', $this->used)
                ->with('serverInfo', $this->serverInfo());
    }
}
