function image_change(sender){   
    if(!sender.value.match(/.jpg|.jpeg|.gif|.png|.bmp/i))
	{   
        alert('图片格式无效');   
        return false;   
    }  
}