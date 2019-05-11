<?php

function get_sales_manage_table_headers()
{
	$CI =& get_instance();

	$headers = array(
		array('sale_id' => $CI->lang->line('common_id')),
		array('sale_time' => $CI->lang->line('transaction_time')),
		array('customer_name' => $CI->lang->line('customers_customer')),
		array('amount_due' => $CI->lang->line('transaction_amount_due')),
		array('amount_tendered' => $CI->lang->line('transaction_amount_tendered')),
		array('change_due' => $CI->lang->line('transaction_change_due')),
		//array('payment_type' => $CI->lang->line('sales_payment_type'))
	);
	
	if($CI->config->item('invoice_enable') == TRUE)
	{
		$headers[] = array('invoice_number' => $CI->lang->line('sales_invoice_number'));
		$headers[] = array('invoice' => '&nbsp', 'sortable' => FALSE);
	}

	return transform_headers(array_merge($headers, array(array('receipt' => '&nbsp', 'sortable' => FALSE))));
}

/*
 Gets the html data rows for the sales.
 */
function get_sale_data_last_row($sales, $controller)
{
	$CI =& get_instance();
	$sum_amount_due = 0;
	$sum_amount_tendered = 0;
	$sum_change_due = 0;

	foreach($sales->result() as $key=>$sale)
	{
		$sum_amount_due += $sale->amount_due;
		$sum_amount_tendered += $sale->amount_tendered;
		$sum_change_due += $sale->change_due;
	}

	return array(
		'sale_id' => '-',
		'sale_time' => '<b>'.$CI->lang->line('sales_total').'</b>',
		'amount_due' => '<b>'.to_currency($sum_amount_due).'</b>',
		'amount_tendered' => '<b>'. to_currency($sum_amount_tendered).'</b>',
		'change_due' => '<b>'.to_currency($sum_change_due).'</b>'
	);
}

function get_sale_data_row($sale, $controller)
{
	$CI =& get_instance();
	$controller_name = $CI->uri->segment(1);

	$row = array (
		'sale_id' => $sale->sale_id,
		'sale_time' => date( $CI->config->item('dateformat') . ' ' . $CI->config->item('timeformat'), strtotime($sale->sale_time) ),
		'customer_name' => $sale->customer_name,
		'amount_due' => to_currency($sale->amount_due),
		'amount_tendered' => to_currency($sale->amount_tendered),
		'change_due' => to_currency($sale->change_due),
		//'payment_type' => $sale->payment_type
	);

	if($CI->config->item('invoice_enable'))
	{
		$row['invoice_number'] = $sale->invoice_number;
		$row['invoice'] = empty($sale->invoice_number) ? '' : anchor($controller_name."/invoice/$sale->sale_id", '<span class="glyphicon glyphicon-list-alt"></span>',
			array('title'=>$CI->lang->line('sales_show_invoice'))
		);
	}

	$row['receipt'] = "";/*anchor($controller_name."/receipt/$sale->sale_id", '<span class="glyphicon glyphicon-usd"></span>',
		array('title' => $CI->lang->line('sales_show_receipt'))
	);*/

	if($controller_name=='sales'){
		$row['edit'] = anchor("sales/update?id=$sale->sale_id", '<span class="glyphicon glyphicon-edit"></span>',
			array('target'=>'_blank'));
	}else{
		$row['edit'] = anchor($controller_name."/edit/$sale->sale_id", '<span class="glyphicon glyphicon-edit"></span>',
			array('class' => 'modal-dlg print_hide', 'data-btn-delete' => $CI->lang->line('common_delete'), 'data-btn-submit' => $CI->lang->line('common_submit'), 'title' => $CI->lang->line($controller_name.'_update'))
		);
	}

	return $row;
}

//Get the sales payments summary

function get_sales_manage_payments_summary($payments, $sales, $controller)
{
	$CI =& get_instance();
	$table = '<div id="report_summary">';

	foreach($payments as $key=>$payment)
	{
		$amount = $payment['payment_amount'];

		// WARNING: the strong assumption here is that if a change is due it was a cash transaction always
		// therefore we remove from the total cash amount any change due
		if( $payment['payment_type'] == $CI->lang->line('sales_cash') )
		{
			foreach($sales->result_array() as $key=>$sale)
			{
				$amount -= $sale['change_due'];
			}
		}
		$table .= '<div class="summary_row">' . $payment['payment_type'] . ': ' . to_currency( $amount ) . '</div>';
	}
	$table .= '</div>';

	return $table;
}

function transform_headers_readonly($array)
{
	$result = array();
	foreach($array as $key => $value)
	{
		$result[] = array('field' => $key, 'title' => $value, 'sortable' => $value != '', 'switchable' => !preg_match('(^$|&nbsp)', $value));
	}

	return json_encode($result);
}

function transform_headers($array, $readonly = FALSE, $editable = TRUE)
{
	$result = array();

	if (!$readonly)
	{
		$array = array_merge(array(array('checkbox' => 'select', 'sortable' => FALSE)), $array);
	}

	if ($editable)
	{
		$array[] = array('edit' => '');
	}

	foreach($array as $element)
	{
		$result[] = array('field' => key($element),
			'title' => current($element),
			'switchable' => isset($element['switchable']) ?
				$element['switchable'] : !preg_match('(^$|&nbsp)', current($element)),
			'sortable' => isset($element['sortable']) ?
				$element['sortable'] : current($element) != '',
			'checkbox' => isset($element['checkbox']) ?
				$element['checkbox'] : FALSE,
			'class' => isset($element['checkbox']) || preg_match('(^$|&nbsp)', current($element)) ?
				'print_hide' : '',
			'sorter' => isset($element['sorter']) ?
				$element ['sorter'] : '');
	}
	return json_encode($result);
}

function get_people_manage_table_headers()
{
	$CI =& get_instance();

	$headers = array(
		array('people.person_id' => $CI->lang->line('common_id')),
		//array('last_name' => $CI->lang->line('common_last_name')),
		array('first_name' => $CI->lang->line('common_first_name')),
		//array('email' => $CI->lang->line('common_email')),
		array('phone_number' => $CI->lang->line('common_phone_number'))
	);

	/*if($CI->Employee->has_grant('messages', $CI->session->userdata('person_id')))
	{
		$headers[] = array('messages' => '', 'sortable' => FALSE);
	}*/
	
	return transform_headers($headers);
}

function get_person_data_row($person, $controller)
{
	$CI =& get_instance();
	$controller_name=strtolower(get_class($CI));

	return array (
		'people.person_id' => $person->person_id,
		//'last_name' => $person->last_name,
		'first_name' => $person->first_name,
		//'email' => empty($person->email) ? '' : mailto($person->email, $person->email),
		'phone_number' => $person->phone_number,
		/*'messages' => empty($person->phone_number) ? '' : anchor("Messages/view/$person->person_id", '<span class="glyphicon glyphicon-phone"></span>', 
			array('class'=>'modal-dlg', 'data-btn-submit' => $CI->lang->line('common_submit'), 'title'=>$CI->lang->line('messages_sms_send'))),*/
		'edit' => anchor($controller_name."/view/$person->person_id", '<span class="glyphicon glyphicon-edit"></span>',
			array('class'=>'modal-dlg', 'data-btn-submit' => $CI->lang->line('common_submit'), 'title'=>$CI->lang->line($controller_name.'_update'))
	));
}

function get_suppliers_manage_table_headers()
{
	$CI =& get_instance();

	$headers = array(
		array('people.person_id' => $CI->lang->line('common_id')),
		array('company_name' => $CI->lang->line('suppliers_company_name')),
		//array('agency_name' => $CI->lang->line('suppliers_agency_name')),
		//array('last_name' => $CI->lang->line('common_last_name')),
		array('first_name' => $CI->lang->line('common_first_name')),
		//array('email' => $CI->lang->line('common_email')),
		array('phone_number' => $CI->lang->line('common_phone_number'))
	);

	/*if($CI->Employee->has_grant('messages', $CI->session->userdata('person_id')))
	{
		$headers[] = array('messages' => '');
	}*/

	return transform_headers($headers);
}

function get_supplier_data_row($supplier, $controller)
{
	$CI =& get_instance();
	$controller_name=strtolower(get_class($CI));

	return array (
		'people.person_id' => $supplier->person_id,
		'company_name' => $supplier->company_name,
		//'agency_name' => $supplier->agency_name,
		//'last_name' => $supplier->last_name,
		'first_name' => $supplier->first_name,
		//'email' => empty($supplier->email) ? '' : mailto($supplier->email, $supplier->email),
		'phone_number' => $supplier->phone_number,
		/*'messages' => empty($supplier->phone_number) ? '' : anchor("Messages/view/$supplier->person_id", '<span class="glyphicon glyphicon-phone"></span>', 
			array('class'=>"modal-dlg", 'data-btn-submit' => $CI->lang->line('common_submit'), 'title'=>$CI->lang->line('messages_sms_send'))),*/
		'edit' => anchor($controller_name."/view/$supplier->person_id", '<span class="glyphicon glyphicon-edit"></span>',
			array('class'=>"modal-dlg", 'data-btn-submit' => $CI->lang->line('common_submit'), 'title'=>$CI->lang->line($controller_name.'_update')))
		);
}

function get_items_manage_table_headers()
{
	$CI =& get_instance();

	$headers = array(
		array('items.item_id' => $CI->lang->line('common_id')),
		//array('item_number' => $CI->lang->line('items_item_number')),
		array('name' => $CI->lang->line('items_name')),
		//array('category' => $CI->lang->line('items_category')),
		//array('company_name' => $CI->lang->line('suppliers_company_name')),
		//array('cost_price' => $CI->lang->line('items_cost_price')),
		array('unit_price' => $CI->lang->line('items_unit_price')),
		array('quantity' => $CI->lang->line('items_quantity')),
		//array('tax_percents' => $CI->lang->line('items_tax_percents'), 'sortable' => FALSE),
		//array('item_pic' => $CI->lang->line('items_image'), 'sortable' => FALSE),
		array('inventory' => ''),
		array('stock' => '')
	);

	return transform_headers($headers);
}

function get_item_data_row($item, $controller)
{
	$CI =& get_instance();
	$item_tax_info = $CI->Item_taxes->get_info($item->item_id);
	$tax_percents = '';
	foreach($item_tax_info as $tax_info)
	{
		$tax_percents .= to_tax_decimals($tax_info['percent']) . '%, ';
	}
	// remove ', ' from last item
	$tax_percents = substr($tax_percents, 0, -2);
	$controller_name = strtolower(get_class($CI));

	$image = '';
	if ($item->pic_id != '')
	{
		$images = glob('./uploads/item_pics/' . $item->pic_id . '.*');
		if (sizeof($images) > 0)
		{
			$image .= '<a class="rollover" href="'. base_url($images[0]) .'"><img src="'.site_url('items/pic_thumb/'.$item->pic_id).'"></a>';
		}
	}

	return array (
		'items.item_id' => $item->item_id,
		//'item_number' => $item->item_number,
		'name' => $item->name,
		//'category' => $item->category,
		//'company_name' => $item->company_name,
		//'cost_price' => to_currency($item->cost_price),
		'unit_price' => to_currency($item->unit_price),
		'quantity' => ($item->is_infinite==1)?'-':to_quantity_decimals($item->quantity),
		//'tax_percents' => !$tax_percents ? '-' : $tax_percents,
		//'item_pic' => $image,
		'inventory' => anchor($controller_name."/inventory/$item->item_id", '<span class="glyphicon glyphicon-pushpin"></span>',
			array('class' => 'modal-dlg', 'data-btn-submit' => $CI->lang->line('common_submit'), 'title' => $CI->lang->line($controller_name.'_count'))
		),
		'stock' => anchor($controller_name."/count_details/$item->item_id", '<span class="glyphicon glyphicon-list-alt"></span>',
			array('class' => 'modal-dlg', 'title' => $CI->lang->line($controller_name.'_details_count'))
		),
		'edit' => anchor($controller_name."/view/$item->item_id", '<span class="glyphicon glyphicon-edit"></span>',
			array('class' => 'modal-dlg', 'data-btn-submit' => $CI->lang->line('common_submit'), 'title' => $CI->lang->line($controller_name.'_update'))
		));
}

function get_giftcards_manage_table_headers()
{
	$CI =& get_instance();

	$headers = array(
		array('giftcard_id' => $CI->lang->line('common_id')),
		array('last_name' => $CI->lang->line('common_last_name')),
		array('first_name' => $CI->lang->line('common_first_name')),
		array('giftcard_number' => $CI->lang->line('giftcards_giftcard_number')),
		array('value' => $CI->lang->line('giftcards_card_value'))
	);

	return transform_headers($headers);
}

function get_giftcard_data_row($giftcard, $controller)
{
	$CI =& get_instance();
	$controller_name=strtolower(get_class($CI));

	return array (
		'giftcard_id' => $giftcard->giftcard_id,
		'last_name' => $giftcard->last_name,
		'first_name' => $giftcard->first_name,
		'giftcard_number' => $giftcard->giftcard_number,
		'value' => to_currency($giftcard->value),
		'edit' => anchor($controller_name."/view/$giftcard->giftcard_id", '<span class="glyphicon glyphicon-edit"></span>',
			array('class'=>'modal-dlg', 'data-btn-submit' => $CI->lang->line('common_submit'), 'title'=>$CI->lang->line($controller_name.'_update'))
		));
}

function get_item_kits_manage_table_headers()
{
	$CI =& get_instance();

	$headers = array(
		array('item_kit_id' => $CI->lang->line('item_kits_kit')),
		array('name' => $CI->lang->line('item_kits_name')),
		//array('description' => $CI->lang->line('item_kits_description')),
		array('cost_price' => $CI->lang->line('items_cost_price'), 'sortable' => FALSE),
		array('unit_price' => $CI->lang->line('items_unit_price'), 'sortable' => FALSE)
	);

	return transform_headers($headers);
}

function get_item_kit_data_row($item_kit, $controller)
{
	$CI =& get_instance();
	$controller_name=strtolower(get_class($CI));

	return array (
		'item_kit_id' => $item_kit->item_kit_id,
		'name' => $item_kit->name,
		//'description' => $item_kit->description,
		'cost_price' => to_currency($item_kit->total_cost_price),
		'unit_price' => to_currency($item_kit->total_unit_price),
		'edit' => anchor($controller_name."/view/$item_kit->item_kit_id", '<span class="glyphicon glyphicon-edit"></span>',
			array('class'=>'modal-dlg', 'data-btn-submit' => $CI->lang->line('common_submit'), 'title'=>$CI->lang->line($controller_name.'_update'))
		));
}


function get_receivings_manage_table_headers()
{
	$CI =& get_instance();

	$headers = array(
		array('receiving_id' => $CI->lang->line('common_id')),
		array('receiving_time' => $CI->lang->line('transaction_time')),
		array('supplier_name' => $CI->lang->line('suppliers_supplier')),
		array('amount_due' => $CI->lang->line('transaction_amount_due')),
		array('amount_tendered' => $CI->lang->line('transaction_amount_tendered')),
		array('change_due' => $CI->lang->line('transaction_change_due')),
		//array('payment_type' => $CI->lang->line('receivings_payment_type'))
	);
	
	if($CI->config->item('invoice_enable') == TRUE)
	{
		$headers[] = array('invoice_number' => $CI->lang->line('receivings_invoice_number'));
		$headers[] = array('invoice' => '&nbsp', 'sortable' => FALSE);
	}

	return transform_headers(array_merge($headers, array(array('receipt' => '&nbsp', 'sortable' => FALSE))));
}

/*
 Gets the html data rows for the receivings.
 */
function get_receiving_data_last_row($receivings, $controller)
{
	$CI =& get_instance();
	$sum_amount_due = 0;
	$sum_amount_tendered = 0;
	$sum_change_due = 0;

	foreach($receivings->result() as $key=>$receiving)
	{
		$sum_amount_due += $receiving->amount_due;
		$sum_amount_tendered += $receiving->amount_tendered;
		$sum_change_due += $receiving->change_due;
	}

	return array(
		'receiving_id' => '-',
		'receiving_time' => '<b>'.$CI->lang->line('receivings_total').'</b>',
		'amount_due' => '<b>'.to_currency($sum_amount_due).'</b>',
		'amount_tendered' => '<b>'. to_currency($sum_amount_tendered).'</b>',
		'change_due' => '<b>'.to_currency($sum_change_due).'</b>'
	);
}

function get_receiving_data_row($receiving, $controller)
{
	$CI =& get_instance();
	$controller_name = $CI->uri->segment(1);

	$row = array (
		'receiving_id' => $receiving->receiving_id,
		'receiving_time' => date( $CI->config->item('dateformat') . ' ' . $CI->config->item('timeformat'), strtotime($receiving->receiving_time) ),
		'supplier_name' => $receiving->supplier_name,
		'amount_due' => to_currency($receiving->amount_due),
		'amount_tendered' => to_currency($receiving->amount_tendered),
		'change_due' => to_currency($receiving->change_due),
		//'payment_type' => $receiving->payment_type
	);

	if($CI->config->item('invoice_enable'))
	{
		$row['invoice_number'] = $receiving->invoice_number;
		$row['invoice'] = empty($receiving->invoice_number) ? '' : anchor($controller_name."/invoice/$receiving->receiving_id", '<span class="glyphicon glyphicon-list-alt"></span>',
			array('title'=>$CI->lang->line('receivings_show_invoice'))
		);
	}

	$row['receipt'] = "";/*anchor($controller_name."/receipt/$receiving->receiving_id", '<span class="glyphicon glyphicon-usd"></span>',
		array('title' => $CI->lang->line('receivings_show_receipt'))
	);*/

	if($controller_name=='receivings'){
		$row['edit'] = anchor("receivings/update?id=$receiving->receiving_id", '<span class="glyphicon glyphicon-edit"></span>',
			array('target'=>'_blank'));
	}else{
		$row['edit'] = anchor($controller_name."/edit/$receiving->receiving_id", '<span class="glyphicon glyphicon-edit"></span>',
			array('class' => 'modal-dlg print_hide', 'data-btn-delete' => $CI->lang->line('common_delete'), 'data-btn-submit' => $CI->lang->line('common_submit'), 'title' => $CI->lang->line($controller_name.'_update'))
		);
	}

	return $row;
}

function get_manufactures_manage_table_headers()
{
	$CI =& get_instance();

	$headers = array(
		array('manufacture_id' => $CI->lang->line('common_id')),
		array('manufacture_time' => $CI->lang->line('transaction_time')),
		array('staff_name' => $CI->lang->line('staffs_staff')),
		array('amount_due' => $CI->lang->line('transaction_amount_due')),
		array('amount_tendered' => $CI->lang->line('transaction_amount_tendered')),
		array('change_due' => $CI->lang->line('transaction_change_due')),
		//array('payment_type' => $CI->lang->line('manufactures_payment_type'))
	);
	
	if($CI->config->item('invoice_enable') == TRUE)
	{
		$headers[] = array('invoice_number' => $CI->lang->line('manufactures_invoice_number'));
		$headers[] = array('invoice' => '&nbsp', 'sortable' => FALSE);
	}

	return transform_headers(array_merge($headers, array(array('receipt' => '&nbsp', 'sortable' => FALSE))));
}

/*
 Gets the html data rows for the manufactures.
 */
function get_manufacture_data_last_row($manufactures, $controller)
{
	$CI =& get_instance();
	$sum_amount_due = 0;
	$sum_amount_tendered = 0;
	$sum_change_due = 0;

	foreach($manufactures->result() as $key=>$manufacture)
	{
		$sum_amount_due += $manufacture->amount_due;
		$sum_amount_tendered += $manufacture->amount_tendered;
		$sum_change_due += $manufacture->change_due;
	}

	return array(
		'manufacture_id' => '-',
		'manufacture_time' => '<b>'.$CI->lang->line('manufactures_total').'</b>',
		'amount_due' => '<b>'.to_currency($sum_amount_due).'</b>',
		'amount_tendered' => '<b>'. to_currency($sum_amount_tendered).'</b>',
		'change_due' => '<b>'.to_currency($sum_change_due).'</b>'
	);
}

function get_manufacture_data_row($manufacture, $controller)
{
	$CI =& get_instance();
	$controller_name = $CI->uri->segment(1);

	$row = array (
		'manufacture_id' => $manufacture->manufacture_id,
		'manufacture_time' => date( $CI->config->item('dateformat') . ' ' . $CI->config->item('timeformat'), strtotime($manufacture->manufacture_time) ),
		'staff_name' => $manufacture->staff_name,
		'amount_due' => to_currency($manufacture->amount_due),
		'amount_tendered' => to_currency($manufacture->amount_tendered),
		'change_due' => to_currency($manufacture->change_due),
		//'payment_type' => $manufacture->payment_type
	);

	if($CI->config->item('invoice_enable'))
	{
		$row['invoice_number'] = $manufacture->invoice_number;
		$row['invoice'] = empty($manufacture->invoice_number) ? '' : anchor($controller_name."/invoice/$manufacture->manufacture_id", '<span class="glyphicon glyphicon-list-alt"></span>',
			array('title'=>$CI->lang->line('manufactures_show_invoice'))
		);
	}

	$row['receipt'] = "";/*anchor($controller_name."/receipt/$manufacture->manufacture_id", '<span class="glyphicon glyphicon-usd"></span>',
		array('title' => $CI->lang->line('manufactures_show_receipt'))
	);*/

	if($controller_name=='manufactures'){
		$row['edit'] = anchor("manufactures/update?id=$manufacture->manufacture_id", '<span class="glyphicon glyphicon-edit"></span>',
			array('target'=>'_blank'));
	}else{
		$row['edit'] = anchor($controller_name."/edit/$manufacture->manufacture_id", '<span class="glyphicon glyphicon-edit"></span>',
			array('class' => 'modal-dlg print_hide', 'data-btn-delete' => $CI->lang->line('common_delete'), 'data-btn-submit' => $CI->lang->line('common_submit'), 'title' => $CI->lang->line($controller_name.'_update'))
		);
	}

	return $row;
}

function get_transports_manage_table_headers()
{
	$CI =& get_instance();

	$headers = array(
		array('transport_id' => $CI->lang->line('common_id')),
		array('transport_time' => $CI->lang->line('transaction_time')),
		array('stock_location_name' => $CI->lang->line('stock_locations_stock_location')),
		array('amount_due' => $CI->lang->line('transaction_amount_due')),
		array('amount_tendered' => $CI->lang->line('transaction_amount_tendered')),
		array('change_due' => $CI->lang->line('transaction_change_due')),
		//array('payment_type' => $CI->lang->line('transports_payment_type'))
	);
	
	if($CI->config->item('invoice_enable') == TRUE)
	{
		$headers[] = array('invoice_number' => $CI->lang->line('transports_invoice_number'));
		$headers[] = array('invoice' => '&nbsp', 'sortable' => FALSE);
	}

	return transform_headers(array_merge($headers, array(array('receipt' => '&nbsp', 'sortable' => FALSE))));
}

/*
 Gets the html data rows for the transports.
 */
function get_transport_data_last_row($transports, $controller)
{
	$CI =& get_instance();
	$sum_amount_due = 0;
	$sum_amount_tendered = 0;
	$sum_change_due = 0;

	foreach($transports->result() as $key=>$transport)
	{
		$sum_amount_due += $transport->amount_due;
		$sum_amount_tendered += $transport->amount_tendered;
		$sum_change_due += $transport->change_due;
	}

	return array(
		'transport_id' => '-',
		'transport_time' => '<b>'.$CI->lang->line('transports_total').'</b>',
		'amount_due' => '<b>'.to_currency($sum_amount_due).'</b>',
		'amount_tendered' => '<b>'. to_currency($sum_amount_tendered).'</b>',
		'change_due' => '<b>'.to_currency($sum_change_due).'</b>'
	);
}

function get_transport_data_row($transport, $controller)
{
	$CI =& get_instance();
	$controller_name = $CI->uri->segment(1);

	$row = array (
		'transport_id' => $transport->transport_id,
		'transport_time' => date( $CI->config->item('dateformat') . ' ' . $CI->config->item('timeformat'), strtotime($transport->transport_time) ),
		'stock_location_name' => $transport->stock_location_name,
		'amount_due' => to_currency($transport->amount_due),
		'amount_tendered' => to_currency($transport->amount_tendered),
		'change_due' => to_currency($transport->change_due),
		//'payment_type' => $transport->payment_type
	);

	if($CI->config->item('invoice_enable'))
	{
		$row['invoice_number'] = $transport->invoice_number;
		$row['invoice'] = empty($transport->invoice_number) ? '' : anchor($controller_name."/invoice/$transport->transport_id", '<span class="glyphicon glyphicon-list-alt"></span>',
			array('title'=>$CI->lang->line('transports_show_invoice'))
		);
	}

	$row['receipt'] = "";/*anchor($controller_name."/receipt/$transport->transport_id", '<span class="glyphicon glyphicon-usd"></span>',
		array('title' => $CI->lang->line('transports_show_receipt'))
	);*/

	if($controller_name=='transports'){
		$row['edit'] = anchor("transports/update?id=$transport->transport_id", '<span class="glyphicon glyphicon-edit"></span>',
			array('target'=>'_blank'));
	}else{
		$row['edit'] = anchor($controller_name."/edit/$transport->transport_id", '<span class="glyphicon glyphicon-edit"></span>',
			array('class' => 'modal-dlg print_hide', 'data-btn-delete' => $CI->lang->line('common_delete'), 'data-btn-submit' => $CI->lang->line('common_submit'), 'title' => $CI->lang->line($controller_name.'_update'))
		);
	}

	return $row;
}

