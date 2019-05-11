function tab(group,count,index)
{
	for(i=1;i<=count;i++)
	{
		if(i==index)
		{
			$('#a'+group+'_'+i).addClass('sel');
			$('#c'+group+'_'+i).show();			
		}
		else
		{
			$('#a'+group+'_'+i).removeClass('sel');
			$('#c'+group+'_'+i).hide();
		}		
	}
}