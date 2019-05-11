<?php $this->load->view("partial/header"); ?>

<script type="text/javascript">
$(document).ready(function()
{
	// when any filter is clicked and the dropdown window is closed
	$('#filters').on('hidden.bs.select', function(e) {
		table_support.refresh();
	});

	<?php 
	if(!empty($last_search)){
		echo "var last_start_date='".$last_search['start_date']."';";
		echo "var last_end_date='".$last_search['end_date']."';";
	}
	?>

	// load the preset datarange picker
	<?php $this->load->view('partial/daterangepicker'); ?>

	$("#daterangepicker").on('apply.daterangepicker', function(ev, picker) {
		table_support.refresh();
	});

	$('#btn_refresh').on('click',function(){
		table_support.refresh();
	});

	<?php $this->load->view('partial/bootstrap_tables_locale'); ?>

	var singlename="<?php echo $controller_name;?>".slice(0,-1);//console.log(singlename);

	table_support.init({
		resource: '<?php echo site_url($controller_name);?>',
		headers: <?php echo $table_headers; ?>,
		pageSize: <?php echo $this->config->item('lines_per_page'); ?>,
		uniqueId: singlename+'_id',
		onLoadSuccess: function(response) {
			/*if($("#table tbody tr").length > 1) {
				$("#payment_summary").html(response.payment_summary);
				$("#table tbody tr:last td:first").html("");
			}*/
		},
		queryParams: function() {
			return $.extend(arguments[0], {
				start_date: start_date,
				end_date: end_date,
				filters: $("#filters").val() || [""]
			});
		},
		columns: {
			'invoice': {
				align: 'center'
			}
		}
	});
});
</script>

<div id="title_bar" class="print_hide btn-toolbar">
	<a href="<?php echo $controller_name;?>/load" class="btn btn-info btn-sm pull-right">打开正在编辑的<?php echo $this->lang->line('module_'.$controller_name);?></a>
	<a href="<?php echo $controller_name;?>/create" class="btn btn-info btn-sm pull-right">创建新的<?php echo $this->lang->line('module_'.$controller_name);?></a>
</div>

<div id="toolbar">
	<div class="pull-left form-inline" role="toolbar">
		<button id="delete" class="btn btn-default btn-sm print_hide">
			<span class="glyphicon glyphicon-trash">&nbsp</span><?php echo $this->lang->line("common_delete");?>
		</button>

		<?php echo form_input(array('name'=>'daterangepicker', 'class'=>'form-control input-sm', 'id'=>'daterangepicker')); ?>
		<?php //echo form_multiselect('filters[]', $filters, '', array('id'=>'filters', 'data-none-selected-text'=>$this->lang->line('common_none_selected_text'), 'class'=>'selectpicker show-menu-arrow', 'data-selected-text-format'=>'count > 1', 'data-style'=>'btn-default btn-sm', 'data-width'=>'fit')); ?>
	</div>
</div>

<div id="table_holder">
	<table id="table"></table>
</div>

<div id="payment_summary">
</div>

<?php $this->load->view("partial/footer"); ?>
