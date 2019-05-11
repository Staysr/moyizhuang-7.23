<?php $this->lang->load("calendar"); $this->lang->load("date"); ?>

var start_date = "<?php echo date('Y-m-d') ?>";
var end_date   = "<?php echo date('Y-m-d') ?>";

if(typeof(last_start_date)!='undefined'){
	start_date=last_start_date;end_date=last_end_date;
}

$('#daterangepicker').daterangepicker({
	"ranges": {
		"<?php echo $this->lang->line("datepicker_today"); ?>": [
			"<?php echo date($this->config->item('dateformat'), mktime(0,0,0,date("m"),date("d"),date("Y")));?>",
			"<?php echo date($this->config->item('dateformat'), mktime(0,0,0,date("m"),date("d")+1,date("Y"))-1);?>"
		],
		"<?php echo $this->lang->line("datepicker_yesterday"); ?>": [
			"<?php echo date($this->config->item('dateformat'), mktime(0,0,0,date("m"),date("d")-1,date("Y")));?>",
			"<?php echo date($this->config->item('dateformat'), mktime(0,0,0,date("m"),date("d"),date("Y"))-1);?>"
		],
		"<?php echo $this->lang->line("datepicker_last_7"); ?>": [
			"<?php echo date($this->config->item('dateformat'), mktime(0,0,0,date("m"),date("d")-6,date("Y")));?>",
			"<?php echo date($this->config->item('dateformat'), mktime(0,0,0,date("m"),date("d")+1,date("Y"))-1);?>"
		],
		"<?php echo $this->lang->line("datepicker_last_30"); ?>": [
			"<?php echo date($this->config->item('dateformat'), mktime(0,0,0,date("m"),date("d")-29,date("Y")));?>",
			"<?php echo date($this->config->item('dateformat'), mktime(0,0,0,date("m"),date("d")+1,date("Y"))-1);?>"
		],
		"<?php echo $this->lang->line("datepicker_this_month"); ?>": [
			"<?php echo date($this->config->item('dateformat'), mktime(0,0,0,date("m"),1,date("Y")));?>",
			"<?php echo date($this->config->item('dateformat'), mktime(0,0,0,date("m")+1,1,date("Y"))-1);?>"
		],
		"<?php echo $this->lang->line("datepicker_last_month"); ?>": [
			"<?php echo date($this->config->item('dateformat'), mktime(0,0,0,date("m")-1,1,date("Y")));?>",
			"<?php echo date($this->config->item('dateformat'), mktime(0,0,0,date("m"),1,date("Y"))-1);?>"
		],
		"<?php echo $this->lang->line("datepicker_this_year"); ?>": [
			"<?php echo date($this->config->item('dateformat'), mktime(0,0,0,1,1,date("Y")));?>",
			"<?php echo date($this->config->item('dateformat'), mktime(0,0,0,date("m"),1,date("Y")+1)-1);?>"
		],
		"<?php echo $this->lang->line("datepicker_all_time"); ?>": [
			"<?php echo date($this->config->item('dateformat'), mktime(0,0,0,01,01,2010));?>",
			"<?php echo date($this->config->item('dateformat'), mktime(0,0,0,date("m"),date("d")+1,date("Y"))-1);?>"
		],
	},
	"locale": {
		"format": '<?php echo dateformat_momentjs($this->config->item("dateformat"))?>',
		"separator": " - ",
		"applyLabel": "<?php echo $this->lang->line("datepicker_apply"); ?>",
		"cancelLabel": "<?php echo $this->lang->line("datepicker_cancel"); ?>",
		"fromLabel": "<?php echo $this->lang->line("datepicker_from"); ?>",
		"toLabel": "<?php echo $this->lang->line("datepicker_to"); ?>",
		"customRangeLabel": "<?php echo $this->lang->line("datepicker_custom"); ?>",
		"daysOfWeek": [
			"<?php echo $this->lang->line("cal_su"); ?>",
			"<?php echo $this->lang->line("cal_mo"); ?>",
			"<?php echo $this->lang->line("cal_tu"); ?>",
			"<?php echo $this->lang->line("cal_we"); ?>",
			"<?php echo $this->lang->line("cal_th"); ?>",
			"<?php echo $this->lang->line("cal_fr"); ?>",
			"<?php echo $this->lang->line("cal_sa"); ?>",
			"<?php echo $this->lang->line("cal_su"); ?>"
		],
		"monthNames": [
			"<?php echo $this->lang->line("cal_january"); ?>",
			"<?php echo $this->lang->line("cal_february"); ?>",
			"<?php echo $this->lang->line("cal_march"); ?>",
			"<?php echo $this->lang->line("cal_april"); ?>",
			"<?php echo $this->lang->line("cal_may"); ?>",
			"<?php echo $this->lang->line("cal_june"); ?>",
			"<?php echo $this->lang->line("cal_july"); ?>",
			"<?php echo $this->lang->line("cal_august"); ?>",
			"<?php echo $this->lang->line("cal_september"); ?>",
			"<?php echo $this->lang->line("cal_october"); ?>",
			"<?php echo $this->lang->line("cal_november"); ?>",
			"<?php echo $this->lang->line("cal_december"); ?>"
		],
		"firstDay": <?php echo $this->lang->line("datepicker_weekstart"); ?>
	},
	"alwaysShowCalendars": true,
	"startDate": start_date,
	"endDate": end_date,
	"minDate": "<?php echo date($this->config->item('dateformat'), mktime(0,0,0,01,01,2010));?>",
	"maxDate": "<?php echo date($this->config->item('dateformat'), mktime(0,0,0,date("m"),date("d")+1,date("Y"))-1);?>"
}, function(start, end, label) {//console.log('got',label)
	start_date = start.format('YYYY-MM-DD');
	end_date = end.format('YYYY-MM-DD');
});

//console.log(start_date,end_date,'final')