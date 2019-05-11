<?php
if(!defined('IN_DZZ')) {
	exit('Access Denied');
}
?>
<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>加载中 - Epub阅读器</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <link rel="stylesheet" href="<?php echo MOD_PATH;?>/reader/css/normalize.css">
        <link rel="stylesheet" href="<?php echo MOD_PATH;?>/reader/css/main.css">
        <link rel="stylesheet" href="<?php echo MOD_PATH;?>/reader/css/popup.css">
        <link rel="stylesheet" href="<?php echo MOD_PATH;?>/reader/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo MOD_PATH;?>/reader/css/metro-icons.min.css">
        <script src="<?php echo MOD_PATH;?>/reader/js/libs/jquery.min.js"></script>
        <script src="<?php echo MOD_PATH;?>/reader/js/libs/zip.min.js"></script>
        <script>
        "use strict";
        var cpos=0;
        var isGreen=false;
       
        var fontsize=100; 
		
        </script>
    </head>
    <body>
      <div id="sidebar">
        <div id="panels">
          <p style="margin:0;text-align:center;color:white;font-family:'等线','微软雅黑'">
            <span>Epub阅读器</span>
          <a id="show-Toc" class="show_view mif-paragraph-justify active" data-view="Toc" title="目录"></a>
          <a id="show-Bookmarks" class="show_view mif-bookmarks" data-view="Bookmarks" title="书签"></a></p>
          <!--input id="searchBox" placeholder="搜索" type="search">

          <a id="show-Search" class="show_view icon-search" data-view="Search" title="搜索">搜索</a>
          <a id="show-Toc" class="show_view icon-list-1 active" data-view="Toc" title="目录">目录</a>
          <a id="show-Bookmarks" class="show_view icon-bookmark" data-view="Bookmarks" title="书签">书签</a-->

        </div>
        <div id="tocView" class="view">
        </div>
        <div id="searchView" class="view">
          <ul id="searchResults"></ul>
        </div>
        <div id="bookmarksView" class="view">
          <ul id="bookmarks"></ul>
        </div>
      </div>
      <div id="main" style="background: rgb(246,244,236);">

        <div id="titlebar">
          <div id="opener">
            <a id="slider" class="icon-menu" title="导航菜单">导航菜单</a>
          </div>
          <div id="metainfo">
            <span id="book-title"></span>
            <span id="title-seperator">&nbsp;&nbsp;–&nbsp;&nbsp;</span>
            <span id="chapter-title"></span><br />
            <a id="prevChapter" title="上一章" onclick="reader.book.prevChapter();"><span class="glyphicon glyphicon-chevron-left"></span></a><a id="chapter-name">[加载中...]</a><a id="nextChapter" title="下一章" onclick="reader.book.nextChapter();"><span class="glyphicon glyphicon-chevron-right"></span></a>
          </div>
          <div id="title-controls">
            <a id="fullscreen" class="icon-resize-full" title="全屏阅读">全屏阅读</a><br />
            <a id="zoom_in" title="护眼模式" onclick="green();"><span class="glyphicon glyphicon-leaf"></span></a><br />
            <a id="zoom_in" title="放大" onclick="zoomin();"><span class="glyphicon glyphicon-zoom-in"></span></a><br />
            <a id="zoom_out" title="缩小" onclick="zoomout();"><span class="glyphicon glyphicon-zoom-out"></span></a><br />
            <a id="bookmark" class="icon-bookmark-empty" title="添加书签">添加书签</a><br />
            <a id="info" title="EPUB信息" onclick="$('#epub-info').addClass('md-show');">i</a><br />
            <a id="setting" class="icon-cog" title="设置">设置</a>
          </div>
        </div>

        <div id="divider"></div>
        <div id="prev" class="arrow">‹</div>
        <div id="viewer"></div>
        <div id="next" class="arrow">›</div>

        <div id="loader"><img src="<?php echo MOD_PATH;?>/reader/img/loader.gif"></div>
        <p id="pg_view" style="display:none;">
            第&nbsp;<span id="cur_pg">…</span>&nbsp;页&nbsp;&nbsp;/&nbsp;&nbsp;共&nbsp;<span id="all_pg">…</span>&nbsp;页 
        </p>
      </div>
      <div class="modal md-effect-1" id="settings-modal">
          <div class="md-content">
              <h3>EPUB阅读器 - 设置</h3>
              <div>
                  <p>
                    正文字体设置：
                    <select id="fonts" onchange="fontSet(this.value)">
                        <option value="黑体">黑体</option>
                        <option value="微软雅黑">微软雅黑</option>
                        <option value="等线">等线</option>
                        <option value="隶书">隶书</option>
                        <option value="幼圆">幼圆</option>
                        <option value="宋体">宋体</option>
                    </select>
                  </p>
              </div>
              <div class="closer icon-cancel-circled"></div>
          </div>
      </div>
      <div class="modal md-effect-1" id="epub-info">
          <div class="md-content">
              <h3>EPUB文件信息</h3>
              <div style="height:150px;padding-bottom:0px;">
                  <img id="cover" style="height:150px;width:120px;float:left;" />
                    <p style="inline-block;float:right">
                    作者：<span id="creator">[加载中...]</span>
                    </p>
                   <p style="inline-block;padding-left: 132px;">
                    《<span id="booktitle">[加载中...]</span>》
                    </p>
                   <hr style="margin:0;" />
                   <p style="padding-left: 132px;">
                     发行方：<span id="publisher"></span><br />
                     出版时间：<span id="pubdate"></span><br />
                     修改时间：<span id="modified_date"></span><br />
                     语言/区域：<span id="language"></span><br />
                     文件识别ID：<span id="identifier"></span><br />
                   </p>
              </div>
              <div style="height:89px;padding-bottom:10px;padding-top:0px;margin-top:10px;border-top:solid 1px #9a9a9a;">
                  <p>
                     描述：<span id="description">[加载中...]</span><br />
                  </p>
              </div>
              <div class="closer icon-cancel-circled" onclick="$(this).parent().parent().removeClass('md-show')"></div>
          </div>
      </div>
      <div class="overlay"></div>
        <script>
            "use strict";  
			var cpos=0;
       		var isGreen=false;
            var cover_tmp;
            // fileStorage.filePath = EPUBJS.filePath;
			var appOptions = {
			    filePath:"<?php echo(IO::getFileUri(dzzdecode($_GET['path'])));?>",
			    epubStatic:"/<?php echo MOD_PATH;?>/reader/",
		    }
      
        </script>
         <!-- File Storage -->
        <script src="<?php echo MOD_PATH;?>/reader/js/libs/localforage.min.js"></script>
        <!-- Full Screen -->
        <script src="<?php echo MOD_PATH;?>/reader/js/libs/screenfull.min.js"></script>
        <!-- Render -->
        <script src="<?php echo MOD_PATH;?>/reader/js/epub.min.js"></script>
        <!-- Hooks -->
        <script src="<?php echo MOD_PATH;?>/reader/js/hooks.min.js"></script>
        <!-- Reader -->
        <script src="<?php echo MOD_PATH;?>/reader/js/reader.min.js"></script>
        <script src="<?php echo MOD_PATH;?>/reader/js/libs/jquery.min.js"></script>
        <script src="<?php echo MOD_PATH;?>/reader/js/libs/zip.min.js"></script>
        <script src="<?php echo MOD_PATH;?>/reader/js/page.js"></script>
    </body>
</html>
