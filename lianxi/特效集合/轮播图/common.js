function animate(element,target){
//�������һ�ζ����Ķ��ʱ��
    clearInterval(element.timer);
    //���֮�󣬿������ζ����ļ�ʱ��
    element.timer =  setInterval(function(){
        //1 ��ȡ��ǰֵ
        var currentLeft = element.offsetLeft;
        //2 �޸ĵ�ǰֵ -- ������ͬ�ķ���Ҫ�жϴ���
        //дһ���������������
        var step = 60;
        currentLeft += target >= currentLeft ? step : -step;
        //3 ����left����
        element.style.left = currentLeft + "px";
        //4 ͣ����  -- ���Ǵ���ͣ�����Ĳ��ԣ�  ���Ŀ��λ�ú͵�ǰλ�õľ���С��ÿ���ƶ��ľ��룬��ͣ����
        if( Math.abs(target - currentLeft) <= step){
            clearInterval(element.timer);
            element.style.left = target + "px";
        }
    },20);
}