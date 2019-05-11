

  <nav class="navbar navbar-fixed-top navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">������ť</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="./">�����µ�ϵͳ��������</a>
      </div><!-- /.navbar-header -->
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
          <li class="<?php echo checkIfActive('index,')?>">
            <a href="./"><span class="glyphicon glyphicon-user"></span> ƽ̨��ҳ</a>
          </li>
		  <li class="<?php echo checkIfActive('list,export')?>">
            <a href="./list.php"><span class="glyphicon glyphicon-list"></span> ��������</a>
          </li>
		  <li class="<?php echo checkIfActive('classlist,shoplist,kmlist')?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon glyphicon-shopping-cart"></span> ��Ʒ����<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="./classlist.php">�����б�</a></li>
			  <li><a href="./shoplist.php">��Ʒ�б�</a></li>
			  <li><a href="./kmlist.php">�����б�</a></li>
            </ul>
          </li>
		  <li class="<?php echo checkIfActive('fakalist,fakakms')?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-th"></span> ��������<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="./fakalist.php">������</a></li>
			  <li><a href="./fakakms.php?my=add">��ӿ���</a></li>
			   <li><a href="./set.php?mod=mailcon">����ģ��</a></li>
            </ul>
          </li>
		  <li class="<?php echo checkIfActive('sitelist,tixian,record,rank')?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-globe"></span> ��վ����<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="./sitelist.php">��վ�б�</a></li>
			  <li><a href="./record.php">��֧��ϸ</a></li>
			  <li><a href="./set.php?mod=fenzhan">��վ����</a></li>
			  <?php if($conf['fenzhan_tixian']==1){?><li><a href="./tixian.php">�������</a><li><?php }?>
			  	<li><a href="./rank.php">��վ����</a></li>
            </ul>
          </li>
		  <li class="<?php echo checkIfActive('set,shequlist')?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span> ϵͳ����<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="./set.php?mod=site">��վ��Ϣ����</a></li>
			  <li><a href="./set.php?mod=gonggao">��վ��������</a></li>
			  <li><a href="./shequlist.php">����/���˶Խ�����</a><li>
			  <li><a href="./set.php?mod=mail">������������</a><li>
			  <li><a href="./set.php?mod=pay">֧���ӿ�����</a><li>
			  <li><a href="./set.php?mod=template">��ҳģ������</a><li>
			  <li><a href="./set.php?mod=upimg">��վLogo�ϴ�</a><li>
			  <li><a href="./clean.php">ϵͳ��������</a><li>
			  <li><a href="./update.php">���汾����</a><li>
			  <li><a href="http:www.xydai.cn/">����֧��</a><li>
            </ul>
          </li>
          <li><a href="./login.php?logout"><span class="glyphicon glyphicon-log-out"></span> �˳���½</a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
  </nav><!-- /.navbar -->
