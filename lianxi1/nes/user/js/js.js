
// 新 //

    $(document).ready(function(){
    $(".l1").click(function(){
    $(".l1").addClass("on");
    $(".l2").removeClass("on");
    $("#ct1").show();
    $("#ct2").hide();
  });
});

     $(document).ready(function(){
    $(".l2").click(function(){
    $(".l2").addClass("on");
    $(".l1").removeClass("on");
    $("#ct2").show();
    $("#ct1").hide();
  });
});

    $(document).ready(function(){
    $(".wx").click(function(){
    $(".weixin").fadeIn();
    $(".btnoff").fadeIn();
    $(".cover").show();
  });
});

    $(document).ready(function(){
    $(".btnoff").click(function(){
    $(".weixin").fadeOut();
    $(".btnoff").fadeOut();
    $(".cover").fadeOut();
  });
});

function Click(num){
            if(num==8){
                num=0;
            }
            for(i=0;i<8;i++){
                if(i==num){
                     $("#list"+num+"").fadeIn("show");
                      $(".tabul li:eq("+num+")").addClass("on");
                      $(".tabfen li:eq("+num+")").addClass("on");
                }else{
                     $("#list"+i+"").hide();
                      $(".tabul li:eq("+i+")").removeClass("on");
                      $(".tabfen li:eq("+i+")").removeClass("on");
                }
                }
            }