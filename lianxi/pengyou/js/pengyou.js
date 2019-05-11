// JavaScript Document
			var zthight = byId('dingwei').scrollHeight,
				zwidth = byId('dingwei').scrollWidth,
				kheight = byId('dingwei').offsetHeight;
	function tcdzpl(id){
		var Zid='#pengyou-lm'+id;
		if ($(Zid).css('right')=='-150px'){
			$(Zid).css('right','0');
		}else{
			$(Zid).css('right','-150px');
		}
	}
	var tccebianlan = function(){
		var cebianlan=$('#pengyou-cebianlan'),
			xscbl=$('#pengyou-cebianlandingwei');	
		if(cebianlan.css('left')=='-300px'){
				xscbl.css('z-index','0');
		   		cebianlan.css('left','0px');
		   }else{
			   cebianlan.css('left','-300px');
			   setTimeout(function(){xscbl.css('z-index','-1');},500);
		   }
	}
	var tcpinglunk = function(id,px){
		if($('#pinglun-pinglun').css('display')=='none'){
			tcdzpl(px);
			$('#pinglunk').attr('plid',id);
			$('#pinglunk').attr('plpx',px);
			$('#pinglun-pinglun').css('display','block');
		}else{
			tcdzpl(px);
			$('#pinglun-pinglun').css('display','none');
		}
	}
	$('#pinglunk').keyup(function(event){
		var anxia = event.keyCode;
		if(anxia==13){
			var content = $('#pinglunk').val(),
				toId = $('#pinglunk').attr('plid'),
				paixu = $('#pinglunk').attr('plpx');
				$.post("pinglun.php", { 
					"content":content,
					"biaoshi":toId
				},
				   function(data){
					if(data.success){
					 tishi(2,data.msg,1500); // John
					 var pl = $('#sspinglun'+paixu),
						 pl1=document.createElement("div");
						pl1.className='pengyou-shuoshuo-right-pinglun-wz';
						pl1.innerHTML='<div class="pengyou-shuoshuo-right-pinglun-wz-left"><span onclick="Dqopenuser('+data.user+')">'+data.name+'</span></div><div class="pengyou-shuoshuo-right-pinglun-wz-right"><span>'+data.content+'</span></div>';
					pl.append(pl1);
					$('#pinglunk').val('');
					$('#pinglun-pinglun').css("display",'none');
					}else{
						 tishi(1,data.msg,1500);
						$('#pinglun-pinglun').css("display",'none');
					}
				   }, "json");
		   }
		
	});
	var dianzan = function(id,px){
		 $.get("dianzan.php", {
			 Id:id
		 },
		  function(data){
			tcdzpl(px);
			if(data.success==true){
				 	var zanlie = $('#zanlie'+px),
						pl1=document.createElement("span");
					pl1.innerText=data.name;
					zanlie.append(pl1);
					if(zanlie.css("display")=='none'){
						zanlie.css("display","block")
					   }
			}else{
				tishi(1,data.msg,1500);
			}
		  },"json");
	}
		
		var fdimg = function(Id){
			var hqzhezhao = byId('zhezhao2');
			if(hqzhezhao){
				$('#zhezhao2').remove();
				$('#pengyou-fdimg').remove();
			}else{
				var zhezhao = document.createElement('div'),
				fdimg = document.createElement('div');
				zhezhao.id='zhezhao2';
				zhezhao.style.height=zthight+'px';
				$('#dingwei').append(zhezhao);
				fdimg.id='pengyou-fdimg';
				var imgsrc =byId('fdimg'+Id).src;
				fdimg.innerHTML='<img onclick="fdimg('+Id+')" src="'+imgsrc+'" style="width:'+zwidth+'px;" id="pyimg-'+Id+'">'
				$('#dingwei').append(fdimg);
				var pyimghight =byId('pyimg'+Id);
			}
			
		}
$(document).ready(function(){
		var pege=1;
            $('#dingwei').scroll(function(){
				var dwzHeight = document.getElementById('dingwei').scrollHeight,
					dwSoroll= $('#dingwei').scrollTop(),
					dwHeight=parseInt($('#dingwei').css('height'));
              if(dwSoroll>=dwzHeight-dwHeight){
                var div1tem = $('#container').height()
                var str =''
				pege++;
                $.ajax({
                    type:"GET",
                    url:'data.php?page='+pege,
                    dataType:'json',
                    beforeSend:function(){
                      $('.ajax_loading').show() //显示加载时候的提示
                    },
                    success:function(ret){
                     $("#pengyou-content").before(ret) //将ajxa请求的数据追加到内容里面
					 var shuoshuo = document.createElement('div');
						shuoshuo.className='pengyou-shuoshuo';
						shuoshuo.innerHTML='';
						$('#pengyou-content').append(shuoshuo);
                     $('.ajax_loading').hide() //请求成功,隐藏加载提示
                    }
                })
              }
            });

			$('.sltfd').click(function(){
			var hqzhezhao = byId('zhezhao2');
				var zhezhao = document.createElement('div'),
				fdimg = document.createElement('div');
				zhezhao.id='zhezhao2';
				zhezhao.style.height=zthight+'px';
				zhezhao.setAttribute("onClick", "csa()");
				$('#dingwei').append(zhezhao);
				fdimg.id='pengyou-fdimg';
				fdimg.setAttribute("onClick", "csa()");
				var imgsrc =this.src;
				fdimg.innerHTML='<img src="'+imgsrc+'" style="width:'+zwidth+'px;" onclick="wcimg()">'
				$('#dingwei').append(fdimg);
				});

	
	
});