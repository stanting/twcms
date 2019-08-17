@extends('layouts.app')
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{$tw[titles]} - {{ config('app.name') }}</title>
	<meta name="keywords" content="{$tw[seo_keywords]}" />
	<meta name="description" content="{$tw[seo_description]}" />
        <link rel="shortcut icon" type="image/x-icon" href= "{{ asset('favicon.ico') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset(mix('css/global.css')) }}" />
</head>

<body>
<div class="wrap">
	<!--头部开始-->
	<div class="head cf">
            <div class="logo"><a href="{{ config('app.url') }}"><img src="{{ asset('img/logo.gif') }}" alt="{{ config('app.name') }}" title="{{ config('app.name') }}" /></a></div>
		<div class="search">
			<form id="search_form" method="get" action="{$tw[webdir]}index.php">
				<input type="hidden" name="u" value="search-index" />
				<select name="mid" class="s_set">
					{loop:$tw[mod_name] $v $k}<option value="{$k}"{if:isset($_GET['mid']) && $_GET['mid']==$k} selected="selected"{/if}>{$v}</option>{/loop}
				</select>
				<input class="s_tit" type="text" name="keyword" value="{$keyword}" />
				<input class="s_sub" type="submit" value="" />
			</form>
		</div>
	</div>
	<!--头部结束-->

	<!--导航开始-->
	{block:navigate}
	<div class="nav">
		<div class="n_p"></div>
		<div class="n_c">
			<dl{if:empty($tw_var['topcid'])} class="on"{/if}>
				<dt><a href="{{ config('app.url') }}">首页</a></dt>
			</dl>
			{loop:$data $v}
			<dl{if:$tw_var['topcid'] == $v['cid']} class="on"{/if}>
				<dt><a href="{$v[url]}" target="{$v[target]}">{$v[name]}</a></dt>
				<dd>
					{loop:$v[son] $v2}<a href="{$v2[url]}" target="{$v2[target]}">{$v2[name]}</a>{/loop}
				</dd>
			</dl>
			{/loop}
		</div>
		<div class="n_n"></div>
		<dl class="n_hover"></dl>
	</div>
	{/block}
	<!--导航结束-->


	<!--banner开始-->
	<div class="banner">
		<ul>
			<li><a href="http://www.twcms.com" title="TWCMS官方网站" target="_blank"><img src="{$tw[tpl]}banner/b1.jpg" alt="TWCMS官方网站"></a></li>
			<li><a href="http://www.twcms.com" title="TWCMS官方网站" target="_blank"><img src="{$tw[tpl]}banner/b2.jpg" alt="TWCMS官方网站"></a></li>
			<li><a href="http://www.twcms.com" title="TWCMS官方网站" target="_blank"><img src="{$tw[tpl]}banner/b3.jpg" alt="TWCMS官方网站"></a></li>
		</ul>
	</div>
	<!--banner结束-->

	<!--两列开始-->
	<div class="cont cf">
		<div class="c2_l b1_top">
			<div class="b1_tit">
				<div class="ct_p"></div>
				<div class="ct_c">程序简介</div>
				<div class="ct_n"></div>
				<a class="more" href="">更多</a>
			</div>
			<div class="b1_cont">
				<div class="info_l"><img src="{$tw[tpl]}img/brief.jpg"></div>
				<div class="info_r">
					<p>TWCMS由中国首家网络营销策划机构《通王科技》推出的一款亿级负载的轻量级CMS（根据官方测试，负载能力远超discuz、phpwind等论坛程序）。程序采用面向对象(OOP)+面向切面(AOP)的设计思想，基于MVC设计模式开发。</p>
					<p>TWCMS的特点：1.体积小功能强; 2.速度快性能高; 3.高安全够稳定; 4.完全符合SEO; 5.好插件扩展强; 6.用户体验良好; 7.模板引擎易用; 8.完全开源免费</p>
				</div>
			</div>
		</div>

		{block:list mid="4" limit="2" orderby="time" titlenum="28"}
		<div class="c2_r b1_top">
			<div class="b1_tit">
				<a class="more" href="{$data[cate_url]}">更多</a>
				<div class="ct_p"></div>
				<div class="ct_c">客户案例</div>
				<div class="ct_n"></div>
			</div>
			<div class="b1_cont caselist">
				{loop:$data[list] $v}
				<p><a href="{$v[url]}"><img src="{$v[pic]}"><b>{$v[subject]}</b><i>{$v[intro]}</i></a></p>
				{/loop}
			</div>
		</div>
		{/block}
	</div>
	<!--两列结束-->

	<!--产品开始-->
	{block:list mid="3" limit="10" orderby="time" titlenum="28"}
	<div class="cont cf">
		<h2 class="b2_tit">
			<a class="more" href="{$data[cate_url]}">更多</a>
			<b>产品展示</b>
		</h2>
		<div class="b2_cont piclist">
			<a class="p_prev" href="javascript:;"></a>
			<div class="p_cont">
				<ul class="cf">
					{loop:$data[list] $v}
					<li><a href="{$v[url]}" title="{$v[title]}&#10;发表于:{$v[date]}" target="_blank"><img src="{$v[pic]}" /><u>{$v[subject]}</u></a></li>
					{/loop}
				</ul>
			</div>
			<a class="p_next" href="javascript:;"></a>
		</div>
	</div>
	{/block}
	<!--产品结束-->

	<!--三列开始-->
	<div class="cont c3">
		<div class="c3_m cf">
			{block:list_flag flag="1" limit="8" orderby="time" titlenum="28"}
			<div class="c3_l">
				<h2 class="b2_tit">
					<b>推荐</b>
				</h2>
				<ul class="b2_cont lists cf">
					{loop:$data[list] $v}<li><a href="{$v[url]}" title="{$v[title]}&#10;发表于:{$v[date]}" target="_blank">{$v[subject]}</a></li>{/loop}
				</ul>
			</div>
			{/block}

			{block:list_flag flag="2" limit="8" orderby="time" titlenum="28"}
			<div class="c3_l">
				<h2 class="b2_tit">
					<b>热点</b>
				</h2>
				<ul class="b2_cont lists cf">
					{loop:$data[list] $v}<li><a href="{$v[url]}" title="{$v[title]}&#10;发表于:{$v[date]}" target="_blank">{$v[subject]}</a></li>{/loop}
				</ul>
			</div>
			{/block}

			{block:list_flag flag="3" limit="8" orderby="time" titlenum="28"}
			<div class="c3_l">
				<h2 class="b2_tit">
					<b>头条</b>
				</h2>
				<ul class="b2_cont lists cf">
					{loop:$data[list] $v}<li><a href="{$v[url]}" title="{$v[title]}&#10;发表于:{$v[date]}" target="_blank">{$v[subject]}</a></li>{/loop}
				</ul>
			</div>
			{/block}

			{block:listeach limit="8"}
				{loop:$data $v}
				<div class="c3_l">
					<h2 class="b2_tit">
						<a class="more" href="{$v[cate_url]}">更多</a>
						<b>{$v[cate_name]}</b>
					</h2>
					<ul class="b2_cont lists cf">
						{loop:$v[list] $lv}
						<li><span>{$lv[date]}</span><a href="{$lv[url]}" target="_blank">{$lv[subject]}</a></li>
						{/loop}
					</ul>
				</div>
				{/loop}
			{/block}
		</div>
	</div>
	<!--三列结束-->

	<!--友情链接开始-->
	{block:links}
	<div class="cont cf">
		<h2 class="b2_tit">
			<b>友情链接</b>
		</h2>
		<ul class="b2_cont flink cf">
			{loop:$data $v}<li><a href="{$v[url]}" target="_blank">{$v[name]}</a></li>{/loop}
		</ul>
	</div>
	{/block}
	<!--友情链接结束-->


	<!--底部开始-->
	<div class="foot">
		<p>
			Copyright &#169; 2012-2014 <a href="{{ config('app.url') }}">{{ config('app.name') }}</a> Inc. 保留所有权利。

			<!-- 感谢您使用TWCMS,通王因您更精彩!为支持TWCMS的发展,请保留TWCMS的链接信息. -->
			Powered by <a href="{{ config('app.url') }}" target="_blank" title="{{ config('app.name') }}">{{ config('app.name') }}</a>
		</p>
		<p>{php} echo '页面耗时'.runtime().'秒, 内存占用'.runmem().', 访问数据库'.$_ENV['_sqlnum'].'次'; {/php}</p>
		<p>{$tw[beian]}</p>
		<p>{$tw[tongji]}</p>
	</div>
	<!--底部结束-->
</div>

    <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset(mix('js/main.js')) }}"></script>
</body>
</html>