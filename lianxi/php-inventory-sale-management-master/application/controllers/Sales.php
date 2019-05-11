<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once("Secure_Controller.php");

class Sales extends Secure_Controller
{
	public function __construct()
	{
		parent::__construct('sales');

		$this->load->library('sale_lib');
		//$this->load->library('barcode_lib');
		//$this->load->library('email_lib');
	}

	private function check_stock_location(&$data){
		$location_id=$this->sale_lib->get_transaction_items_location();
		$location_id_default=$this->Stock_location->get_default_location_id();
		//echo $location_id;echo $location_id_default;
		if($location_id_default!=$location_id){
			$location_name=$this->Stock_location->get_location_name_session($location_id);
			$location_name_default=$this->Stock_location->get_location_name_session($location_id_default);
			$data['warning']='这笔交易是在“'.$location_name.'”进行的，不是当前所查看的仓库“'.
			$location_name_default.'”。需要将仓库切换到“'.$location_name.'”才能修改，或者点击'.
			'<a href="sales/change_sale_to_current_location" title="下面所列的所有交易物品所在的仓库地址将改成'.$location_name_default.'">这里</a>'.
			'将这笔交易的地址改成“'.$location_name_default.'”';

			$data['transaction_editable']=0;
		}
	}

	public function load(){
		$this->_reload();
	}
	public function create(){
		$this->cancel();
	}

	public function index()
	{
		//$this->_reload();
		$this->manage();
	}
	
	public function manage()
	{
		$person_id = $this->session->userdata('person_id');

		$from_sale_id  = $this->input->get('from_id');

		/*if(!$this->Employee->has_grant('reports_sales', $person_id))
		{
			redirect('no_access/sales/reports_sales');
		}
		else*/
		{
			$data['table_headers'] = get_sales_manage_table_headers();

			// filters that will be loaded in the multiselect dropdown
			if($this->config->item('invoice_enable') == TRUE)
			{
				$data['filters'] = array('only_cash' => $this->lang->line('sales_cash_filter'),
										'only_invoices' => $this->lang->line('sales_invoice_filter'));
			}
			else
			{
				$data['filters'] = array('only_cash' => $this->lang->line('sales_cash_filter'));
			}

			if(!empty($from_sale_id)){$data['from_sale_id']=$from_sale_id;}
			$data['last_search']=$this->sale_lib->get_search_params();

			$this->load->view('transaction/manage', $data);
		}
	}
	
	public function get_row($row_id)
	{
		$sale_info = $this->Sale->get_info($row_id)->row();
		$data_row = $this->xss_clean(get_sale_data_row($sale_info, $this));

		echo json_encode($data_row);
	}

	public function search()
	{
		$this->sale_lib->save_search_params();

		$search = $this->input->get('search');
		$limit  = $this->input->get('limit');
		$offset = $this->input->get('offset');
		$sort   = $this->input->get('sort');
		$order  = $this->input->get('order');

		$filters = array('sale_type' => 'all',
						'location_id' => 'all',
						'start_date' => $this->input->get('start_date'),
						'end_date' => $this->input->get('end_date'),
						'only_cash' => FALSE,
						'only_invoices' => $this->config->item('invoice_enable') && $this->input->get('only_invoices'),
						'is_valid_receipt' => $this->Sale->is_valid_receipt($search));

		// check if any filter is set in the multiselect dropdown
		$filledup = array_fill_keys($this->input->get('filters'), TRUE);
		$filters = array_merge($filters, $filledup);

		$sales = $this->Sale->search($search, $filters, $limit, $offset, $sort, $order);
		$total_rows = $this->Sale->get_found_rows($search, $filters);
		//$payments = $this->Sale->get_payments_summary($search, $filters);
		//$payment_summary = $this->xss_clean(get_sales_manage_payments_summary($payments, $sales, $this));

		$data_rows = array();
		foreach($sales->result() as $sale)
		{
			$data_rows[] = $this->xss_clean(get_sale_data_row($sale, $this));
		}

		/*if($total_rows > 0)
		{
			$data_rows[] = $this->xss_clean(get_sale_data_last_row($sales, $this));
		}*/

		echo json_encode(array('total' => $total_rows, 'rows' => $data_rows));//, 'payment_summary' => $payment_summary)
	}

	public function item_search()
	{
		$suggestions = array();
		$receipt = $search = $this->input->get('term') != '' ? $this->input->get('term') : NULL;

		if($this->sale_lib->get_mode() == 'return' && $this->Sale->is_valid_receipt($receipt))
		{
			// if a valid receipt or invoice was found the search term will be replaced with a receipt number (POS #)
			$suggestions[] = $receipt;
		}
		$suggestions = array_merge($suggestions, $this->Item_kit->get_search_suggestions($search));
		$suggestions = array_merge($suggestions, $this->Item->get_search_suggestions($search, array('search_custom' => FALSE, 'is_deleted' => FALSE), TRUE));
		
		$suggestions = $this->xss_clean($suggestions);

		echo json_encode($suggestions);
	}

	public function suggest_search()
	{
		$search = $this->input->post('term') != '' ? $this->input->post('term') : NULL;
		
		$suggestions = $this->xss_clean($this->Sale->get_search_suggestions($search));
		
		echo json_encode($suggestions);
	}

	public function select_customer()
	{
		$customer_id = $this->input->post('customer');
		if($this->Customer->exists($customer_id))
		{
			$this->sale_lib->set_customer($customer_id);

			/*$discount_percent = $this->Customer->get_info($customer_id)->discount_percent;

			// apply customer default discount to items that have 0 discount
			if($discount_percent != '')
			{	
				$this->sale_lib->apply_customer_discount($discount_percent);
			}*/
		}
		
		$this->_reload();
	}

	public function change_mode()
	{
		$stock_location = $this->input->post('stock_location');
		if (!$stock_location || $stock_location == $this->sale_lib->get_transaction_location())
		{
			$mode = $this->input->post('mode');
			$this->sale_lib->set_mode($mode);
		} 
		elseif($this->Stock_location->is_allowed_location($stock_location, 'sales'))
		{
			$this->sale_lib->set_transaction_location($stock_location);
		}

		$this->_reload();
	}
	
	public function set_comment() 
	{
		$this->sale_lib->set_comment($this->input->post('comment'));
	}
	public function set_mailState() 
	{
		$this->sale_lib->set_mailState($this->input->post('mail_state'));
	}
	
	public function set_invoice_number()
	{
		$this->sale_lib->set_invoice_number($this->input->post('sales_invoice_number'));
	}
	
	public function set_invoice_number_enabled()
	{
		$this->sale_lib->set_invoice_number_enabled($this->input->post('sales_invoice_number_enabled'));
	}
	
	public function set_print_after_transaction()
	{
		$this->sale_lib->set_print_after_transaction($this->input->post('sales_print_after_sale'));
	}
	
	public function set_email_receipt()
	{
 		$this->sale_lib->set_email_receipt($this->input->post('email_receipt'));
	}

	// Multiple Payments
	public function add_payment()
	{
		$data = array();
		$this->form_validation->set_rules('amount_tendered', 'lang:sales_amount_tendered', 'trim|required|callback_numeric');

		$payment_type = $this->input->post('payment_type');

		if($this->form_validation->run() == FALSE)
		{
			if($payment_type == $this->lang->line('sales_giftcard'))
			{
				$data['error'] = $this->lang->line('sales_must_enter_numeric_giftcard');
			}
			else
			{
				$data['error'] = $this->lang->line('sales_must_enter_numeric');
			}
		}
		else
		{
			if($payment_type == $this->lang->line('sales_giftcard'))
			{
				// in case of giftcard payment the register input amount_tendered becomes the giftcard number
				$giftcard_num = $this->input->post('amount_tendered');

				$payments = $this->sale_lib->get_payments();
				$payment_type = $payment_type . ':' . $giftcard_num;
				$current_payments_with_giftcard = isset($payments[$payment_type]) ? $payments[$payment_type]['payment_amount'] : 0;
				$cur_giftcard_value = $this->Giftcard->get_giftcard_value($giftcard_num);
				
				if(($cur_giftcard_value - $current_payments_with_giftcard) <= 0)
				{
					$data['error'] = $this->lang->line('giftcards_remaining_balance', $giftcard_num, to_currency($cur_giftcard_value));
				}
				else
				{
					$new_giftcard_value = $this->Giftcard->get_giftcard_value($giftcard_num) - $this->sale_lib->get_amount_due();
					$new_giftcard_value = $new_giftcard_value >= 0 ? $new_giftcard_value : 0;
					$this->sale_lib->set_giftcard_remainder($new_giftcard_value);
					$new_giftcard_value = str_replace('$', '\$', to_currency($new_giftcard_value));
					$data['warning'] = $this->lang->line('giftcards_remaining_balance', $giftcard_num, $new_giftcard_value);
					$amount_tendered = min( $this->sale_lib->get_amount_due(), $this->Giftcard->get_giftcard_value($giftcard_num) );

					$this->sale_lib->add_payment($payment_type, $amount_tendered);
				}
			}
			else
			{
				$amount_tendered = $this->input->post('amount_tendered');

				$this->sale_lib->add_payment($payment_type, $amount_tendered);
			}
		}

		$this->_reload($data);
	}

	// Multiple Payments
	public function delete_payment($payment_id)
	{
		$this->sale_lib->delete_payment($payment_id);

		$this->_reload();
	}

	public function add()
	{
		$data = array();
		
		$discount = 0;

		// check if any discount is assigned to the selected customer
		/*$customer_id = $this->sale_lib->get_customer();
		if($customer_id != -1)
		{
			// load the customer discount if any
			$discount_percent = $this->Customer->get_info($customer_id)->discount_percent;
			if($discount_percent != '')
			{
				$discount = $discount_percent;
			}
		}

		// if the customer discount is 0 or no customer is selected apply the default sales discount
		if($discount == 0)
		{
			$discount = $this->config->item('default_sales_discount');
		}*/

		//$mode = $this->sale_lib->get_mode();
		$quantity = 1;//($mode == 'return') ? -1 : 1;
		$item_location = $this->sale_lib->get_transaction_location();
		$item_id_or_number_or_item_kit_or_receipt = $this->input->post('item');

		/*if($mode == 'return' && $this->Sale->is_valid_receipt($item_id_or_number_or_item_kit_or_receipt))
		{
			$this->sale_lib->return_entire_transaction($item_id_or_number_or_item_kit_or_receipt);
		}
		else*/if($this->Item_kit->is_valid_item_kit($item_id_or_number_or_item_kit_or_receipt))
		{
			if(!$this->sale_lib->add_item_kit($item_id_or_number_or_item_kit_or_receipt, $item_location, $discount))
			{
				$data['error'] = $this->lang->line('sales_unable_to_add_item');
			}
		}
		else
		{
			if(!$this->sale_lib->add_item($item_id_or_number_or_item_kit_or_receipt, $quantity, $item_location, $discount))
			{
				$data['error'] = $this->lang->line('sales_unable_to_add_item');
			}
			else
			{
				$data['warning'] = $this->sale_lib->out_of_stock($item_id_or_number_or_item_kit_or_receipt, $item_location);
			}
		}

		$this->_reload($data);
	}

	public function edit_item($item_id)
	{
		$data = array();

		$this->form_validation->set_rules('price', 'lang:items_price', 'required|callback_numeric');
		$this->form_validation->set_rules('quantity', 'lang:items_quantity', 'required|callback_numeric');
		//$this->form_validation->set_rules('discount', 'lang:items_discount', 'required|callback_numeric');

		$description = $this->input->post('description');
		$serialnumber = $this->input->post('serialnumber');
		$price = parse_decimals($this->input->post('price'));
		$quantity = parse_decimals($this->input->post('quantity'));
		$discount = 0;//parse_decimals($this->input->post('discount'));
		$item_location = $this->input->post('location');

		$price=abs($price);$quantity=abs($quantity);

		if($this->form_validation->run() != FALSE)
		{
			$this->sale_lib->edit_item($item_id, $description, $serialnumber, $quantity, $discount, $price);
		}
		else
		{
			$data['error'] = $this->lang->line('sales_error_editing_item');
		}

		$data['warning'] = $this->sale_lib->out_of_stock($this->sale_lib->get_item_id($item_id), $item_location);

		$this->_reload($data);
	}

	public function delete_item($item_number)
	{
		$this->sale_lib->delete_item($item_number);

		$this->_reload();
	}

	public function remove_customer()
	{
		$this->sale_lib->clear_giftcard_remainder();
		$this->sale_lib->clear_invoice_number();
		$this->sale_lib->remove_customer();

		$this->_reload();
	}

	public function complete()
	{return;
		/*$data = array();

		$data['cart'] = $this->sale_lib->get_cart();
		$data['subtotal'] = $this->sale_lib->get_subtotal();
		$data['discounted_subtotal'] = $this->sale_lib->get_subtotal(TRUE);
		$data['tax_exclusive_subtotal'] = $this->sale_lib->get_subtotal(TRUE, TRUE);
		$data['taxes'] = $this->sale_lib->get_taxes();
		$data['total'] = $this->sale_lib->get_total();
		$data['discount'] = $this->sale_lib->get_discount();
		$data['receipt_title'] = $this->lang->line('sales_receipt');
		$data['transaction_time'] = date($this->config->item('dateformat') . ' ' . $this->config->item('timeformat'));
		$data['transaction_date'] = date($this->config->item('dateformat'));
		$data['show_stock_locations'] = $this->Stock_location->show_locations('sales');
		$data['comments'] = $this->sale_lib->get_comment();
		$data['payments'] = $this->sale_lib->get_payments();
		$data['amount_change'] = $this->sale_lib->get_amount_due() * -1;
		$data['amount_due'] = $this->sale_lib->get_amount_due();
		$employee_id = $this->Employee->get_logged_in_employee_info()->person_id;
		$employee_info = $this->Employee->get_info($employee_id);
		$data['employee'] = $employee_info->first_name  . ' ' . $employee_info->last_name[0];
		$data['company_info'] = implode("\n", array(
			$this->config->item('address'),
			$this->config->item('phone'),
			$this->config->item('account_number')
		));
		$customer_id = $this->sale_lib->get_customer();
		$customer_info = $this->_load_customer_data($customer_id, $data);
		$invoice_number = $this->_substitute_invoice_number($customer_info);

		if($this->sale_lib->is_invoice_number_enabled() && $this->Sale->check_invoice_number_exists($invoice_number))
		{
			$data['error'] = $this->lang->line('sales_invoice_number_duplicate');

			$this->_reload($data);
		}
		elseif ($this->sale_lib->get_mailState()!=3) {
			$data['error'] = "还没有完成收货";$this->_reload($data);
		}
		else 
		{
			$invoice_number = $this->sale_lib->is_invoice_number_enabled() ? $invoice_number : NULL;
			$data['invoice_number'] = $invoice_number;
			$data['sale_id_num'] = $this->Sale->save($data['cart'], $customer_id, $employee_id, $data['comments'], $invoice_number, $data['payments']);
			$data['sale_id'] = 'POS ' . $data['sale_id_num'];
			
			$data = $this->xss_clean($data);
			
			if($data['sale_id_num'] == -1)
			{
				$data['error_message'] = $this->lang->line('sales_transaction_failed');
			}
			else
			{
				$data['barcode'] = $this->barcode_lib->generate_receipt_barcode($data['sale_id']);
			}

			$data['cur_giftcard_value'] = $this->sale_lib->get_giftcard_remainder();
			$data['print_after_sale'] = $this->sale_lib->is_print_after_transaction();
			$data['email_receipt'] = $this->sale_lib->get_email_receipt();
			
			if($this->sale_lib->is_invoice_number_enabled())
			{
				$this->load->view('transaction/invoice', $data);
			}
			else
			{
				$this->load->view('transaction/receipt', $data);
			}

			$this->sale_lib->clear_all();
		}*/
	}

	public function send_invoice($sale_id)
	{
		$sale_data = $this->_load_sale_data($sale_id);

		$result = FALSE;
		$message = $this->lang->line('sales_invoice_no_email');

		if(!empty($sale_data['customer_email']))
		{
			$to = $sale_data['customer_email'];
			$subject = $this->lang->line('sales_invoice') . ' ' . $sale_data['invoice_number'];

			$text = $this->config->item('invoice_email_message');
			$text = str_replace('$INV', $sale_data['invoice_number'], $text);
			$text = str_replace('$CO', 'POS ' . $sale_data['sale_id'], $text);
			$text = $this->_substitute_customer($text, (object) $sale_data);

			// generate email attachment: invoice in pdf format
			$html = $this->load->view('transaction/invoice_email', $sale_data, TRUE);
			// load pdf helper
			$this->load->helper(array('dompdf', 'file'));
			$filename = sys_get_temp_dir() . '/' . $this->lang->line('sales_invoice') . '-' . str_replace('/', '-' , $sale_data['invoice_number']) . '.pdf';
			if(file_put_contents($filename, pdf_create($html)) !== FALSE)
			{
				$result = $this->email_lib->sendEmail($to, $subject, $text, $filename);	
			}

			$message = $this->lang->line($result ? 'sales_invoice_sent' : 'sales_invoice_unsent') . ' ' . $to;
		}

		echo json_encode(array('success' => $result, 'message' => $message, 'id' => $sale_id));

		$this->sale_lib->clear_all();

		return $result;
	}

	public function send_receipt($sale_id)
	{
		$sale_data = $this->_load_sale_data($sale_id);

		$result = FALSE;
		$message = $this->lang->line('sales_receipt_no_email');

		if(!empty($sale_data['customer_email']))
		{
			$sale_data['barcode'] = $this->barcode_lib->generate_receipt_barcode($sale_data['sale_id']);

			$to = $sale_data['customer_email'];
			$subject = $this->lang->line('sales_receipt');

			$text = $this->load->view('transaction/receipt_email', $sale_data, TRUE);
			
			$result = $this->email_lib->sendEmail($to, $subject, $text);

			$message = $this->lang->line($result ? 'sales_receipt_sent' : 'sales_receipt_unsent') . ' ' . $to;
		}

		echo json_encode(array('success' => $result, 'message' => $message, 'id' => $sale_id));

		$this->sale_lib->clear_all();

		return $result;
	}

	private function _substitute_variable($text, $variable, $object, $function)
	{
		// don't query if this variable isn't used
		if(strstr($text, $variable))
		{
			$value = call_user_func(array($object, $function));
			$text = str_replace($variable, $value, $text);
		}

		return $text;
	}

	private function _substitute_customer($text, $customer_info)
	{
		// substitute customer info
		$customer_id = $this->sale_lib->get_customer();
		if($customer_id != -1 && $customer_info != '')
		{
			$text = str_replace('$CU', $customer_info->first_name . ' ' . $customer_info->last_name, $text);
			$words = preg_split("/\s+/", trim($customer_info->first_name . ' ' . $customer_info->last_name));
			$acronym = '';
			foreach($words as $w)
			{
				$acronym .= $w[0];
			}
			$text = str_replace('$CI', $acronym, $text);
		}

		return $text;
	}

	private function _is_custom_invoice_number($customer_info)
	{
		$invoice_number = $this->config->config['sales_invoice_format'];
		$invoice_number = $this->_substitute_variables($invoice_number, $customer_info);

		return $this->sale_lib->get_invoice_number() != $invoice_number;
	}

	private function _substitute_variables($text, $customer_info)
	{
		$text = $this->_substitute_variable($text, '$YCO', $this->Sale, 'get_invoice_number_for_year');
		$text = $this->_substitute_variable($text, '$CO', $this->Sale , 'get_invoice_count');
		$text = $this->_substitute_variable($text, '$SCO', $this->Sale_suspended, 'get_invoice_count');
		$text = strftime($text);
		$text = $this->_substitute_customer($text, $customer_info);

		return $text;
	}

	private function _substitute_invoice_number($customer_info)
	{
		$invoice_number = $this->config->config['sales_invoice_format'];
		$invoice_number = $this->_substitute_variables($invoice_number, $customer_info);
		$this->sale_lib->set_invoice_number($invoice_number, TRUE);

		return $this->sale_lib->get_invoice_number();
	}

	private function _load_customer_data($customer_id, &$data, $totals = FALSE)
	{	
		$customer_info = '';

		if($customer_id != -1)
		{
			$customer_info = $this->Customer->get_info($customer_id);
			/*if(isset($customer_info->company_name))
			{
				$data['partner'] = $customer_info->company_name;
			}
			else
			{
				$data['partner'] = $customer_info->first_name . ' ' . $customer_info->last_name;
			}*/
			$data['partner'] = $customer_info->first_name;
			if(isset($customer_info->company_name)){$data['partner'].='('.$customer_info->company_name.')';}

			$data['first_name'] = $customer_info->first_name;
			$data['last_name'] = '';//$customer_info->last_name;
			$data['partner_email'] = $customer_info->email;
			$data['partner_address'] = $customer_info->address_1;
			if(!empty($customer_info->zip) or !empty($customer_info->city))
			{
				$data['partner_location'] = $customer_info->zip . ' ' . $customer_info->city;				
			}
			else
			{
				$data['partner_location'] = '';
			}
			$data['partner_account_number'] = $customer_info->account_number;
			$data['partner_discount_percent'] = 0;//$customer_info->discount_percent;
			/*if($totals)
			{
				$cust_totals = $this->Customer->get_totals($customer_id);

				$data['customer_total'] = $cust_totals->total;
			}*/
			$data['partner_info'] = implode("\n", array(
				$data['partner'],
				$data['partner_address'],
				$data['partner_location'],
				$data['partner_account_number']
			));
		}

		return $customer_info;
	}

	private function _load_sale_data($sale_id)
	{
		$this->sale_lib->clear_all();
		$sale_info = $this->Sale->get_info($sale_id)->row_array();
		$this->sale_lib->copy_entire_transaction($sale_id);
		$data = array();
		$data['cart'] = $this->sale_lib->get_cart();
		$data['payments'] = $this->sale_lib->get_payments();
		$data['subtotal'] = $this->sale_lib->get_subtotal();
		$data['discounted_subtotal'] = $this->sale_lib->get_subtotal(TRUE);
		$data['tax_exclusive_subtotal'] = $this->sale_lib->get_subtotal(TRUE, TRUE);
		$data['taxes'] = $this->sale_lib->get_taxes();
		$data['total'] = $this->sale_lib->get_total();
		$data['discount'] = $this->sale_lib->get_discount();
		$data['receipt_title'] = $this->lang->line('sales_receipt');
		$data['transaction_time'] = date($this->config->item('dateformat') . ' ' . $this->config->item('timeformat'), strtotime($sale_info['sale_time']));
		$data['transaction_date'] = date($this->config->item('dateformat'), strtotime($sale_info['sale_time']));
		$data['show_stock_locations'] = $this->Stock_location->show_locations('sales');
		$data['amount_change'] = $this->sale_lib->get_amount_due() * -1;
		$data['amount_due'] = $this->sale_lib->get_amount_due();
		$employee_info = $this->Employee->get_info($this->sale_lib->get_employee());
		$data['employee'] = $employee_info->first_name . ' ' . $employee_info->last_name[0];
		$this->_load_customer_data($this->sale_lib->get_customer(), $data);

		$data['sale_id_num'] = $sale_id;
		$data['sale_id'] = 'POS ' . $sale_id;
		$data['comments'] = $sale_info['comment'];
		$data['invoice_number'] = $sale_info['invoice_number'];
		$data['company_info'] = implode("\n", array(
			$this->config->item('address'),
			$this->config->item('phone'),
			$this->config->item('account_number')
		));
		$data['barcode'] = $this->barcode_lib->generate_receipt_barcode($data['sale_id']);
		$data['print_after_sale'] = FALSE;

		return $this->xss_clean($data);
	}

	private function _reload($data = array())
	{		
		$data['cart'] = $this->sale_lib->get_cart();	 
		$data['modes'] = array('sale' => $this->lang->line('sales_sale'), 'return' => $this->lang->line('sales_return'));
		$data['mode'] = $this->sale_lib->get_mode();
		$data['stock_locations'] = $this->Stock_location->get_allowed_locations('sales');
		$data['stock_location'] = $this->sale_lib->get_transaction_location();
		$data['subtotal'] = $this->sale_lib->get_subtotal(TRUE);
		$data['tax_exclusive_subtotal'] = $this->sale_lib->get_subtotal(TRUE, TRUE);
		$data['taxes'] = $this->sale_lib->get_taxes();
		$data['discount'] = $this->sale_lib->get_discount();
		$data['total'] = $this->sale_lib->get_total();
		$data['comment'] = $this->sale_lib->get_comment();
		$data['email_receipt'] = $this->sale_lib->get_email_receipt();
		$data['payments_total'] = $this->sale_lib->get_payments_total();
		$data['amount_due'] = $this->sale_lib->get_amount_due();
		$data['payments'] = $this->sale_lib->get_payments();
		$data['payment_options'] = $this->Sale->get_payment_options();

		$data['items_module_allowed'] = $this->Employee->has_grant('items', $this->Employee->get_logged_in_employee_info()->person_id);

		$customer_info = $this->_load_customer_data($this->sale_lib->get_customer(), $data, FALSE);
		$data['invoice_number'] = $this->_substitute_invoice_number($customer_info);
		$data['invoice_number_enabled'] = $this->sale_lib->is_invoice_number_enabled();
		$data['print_after_sale'] = $this->sale_lib->is_print_after_transaction();
		$data['payments_cover_total'] = $this->sale_lib->get_amount_due() <= 0;
		
		$data['mail_state']=$this->sale_lib->get_mailState();
		$sale_id=$this->sale_lib->get_transaction_id();
		if(FALSE!=$sale_id){$data['transaction_id']=$sale_id;}

		$data['partner_type']='customer';

		$data = $this->xss_clean($data);

		$this->check_stock_location($data);

		$this->load->view('transaction/register', $data);
	}

	public function show_help(){
		echo $this->lang->line('sales_help');
	}

	public function list_items(){
		$items=$this->sale_lib->get_cart();
		$items=$this->sale_lib->unfold_cart($items);

		echo '<table class="table"><thead><tr><th>名称</th><th>数量</th></tr></thead><tbody>';
		foreach ($items as $item) {
			$name=($this->Item->get_info($item['item_id'])->name);
			$id=$item['quantity'];

			echo "<tr><td>".$name."</td><td>".$id."</td></tr>";
		}
		echo "</tbody></table>";
	}

	public function receipt($sale_id)
	{
		$data = $this->_load_sale_data($sale_id);

		$this->load->view('transaction/receipt', $data);

		$this->sale_lib->clear_all();
	}

	public function invoice($sale_id)
	{
		$data = $this->_load_sale_data($sale_id);

		$this->load->view('transaction/invoice', $data);

		$this->sale_lib->clear_all();
	}

	public function edit($sale_id)
	{
		$data = array();

		$data['employees'] = array();
		foreach($this->Employee->get_all()->result() as $employee)
		{
			foreach(get_object_vars($employee) as $property => $value)
			{
				$employee->$property = $this->xss_clean($value);
			}
			
			$data['employees'][$employee->person_id] = $employee->first_name . ' ' . $employee->last_name;
		}

		$sale_info = $this->xss_clean($this->Sale->get_info($sale_id)->row_array());

		$sale_info['transaction_id']=$sale_info['sale_id'];
		$sale_info['transaction_time']=$sale_info['sale_time'];

		$employee=$this->Employee->get_info($sale_info['employee_id']);
		$data['employee_name']=$employee->first_name;

		$data['transaction_info'] = $sale_info;

		/*$data['selected_customer_name'] = $sale_info['customer_name'];
		$data['selected_customer_id'] = $sale_info['customer_id'];
		
		$data['payments'] = array();
		foreach($this->Sale->get_sale_payments($sale_id)->result() as $payment)
		{
			foreach(get_object_vars($payment) as $property => $value)
			{
				$payment->$property = $this->xss_clean($value);
			}
			
			$data['payments'][] = $payment;
		}
		
		// don't allow gift card to be a payment option in a sale transaction edit because it's a complex change
		$data['payment_options'] = $this->xss_clean($this->Sale->get_payment_options(FALSE));*/
		
		$this->load->view('transaction/form', $data);
	}

	public function delete($sale_id = -1, $update_inventory = TRUE)
	{
		$employee_id = $this->Employee->get_logged_in_employee_info()->person_id;
		$sale_ids = $sale_id == -1 ? $this->input->post('ids') : array($sale_id);

		if($this->Sale->delete_list($sale_ids, $employee_id, $update_inventory))
		{
			echo json_encode(array('success' => TRUE, 'message' => $this->lang->line('sales_successfully_deleted') . ' ' .
							count($sale_ids) . ' ' . $this->lang->line('sales_one_or_multiple'), 'ids' => $sale_ids));
		}
		else
		{
			echo json_encode(array('success' => FALSE, 'message' => $this->lang->line('sales_unsuccessfully_deleted')));
		}
	}

	public function save($sale_id = -1)
	{
		$newdate = $this->input->post('date');

		$date_formatter = date_create_from_format($this->config->item('dateformat') . ' ' . $this->config->item('timeformat'), $newdate);

		$sale_data = array(
			'sale_time' => $date_formatter->format('Y-m-d H:i:s'),
			'customer_id' => $this->input->post('customer_id') != '' ? $this->input->post('customer_id') : NULL,
			'employee_id' => $this->input->post('employee_id'),
			'comment' => $this->input->post('comment'),
			'invoice_number' => $this->input->post('invoice_number') != '' ? $this->input->post('invoice_number') : NULL
		);

		// go through all the payment type input from the form, make sure the form matches the name and iterator number
		$payments = array();
		$number_of_payments = $this->input->post('number_of_payments');
		for ($i = 0; $i < $number_of_payments; ++$i)
		{
			$payment_amount = $this->input->post('payment_amount_' . $i);
			$payment_type = $this->input->post('payment_type_' . $i);
			// remove any 0 payment if by mistake any was introduced at sale time
			if($payment_amount != 0)
			{
				// search for any payment of the same type that was already added, if that's the case add up the new payment amount
				$key = FALSE;
				if(!empty($payments))
				{
					// search in the multi array the key of the entry containing the current payment_type
					// NOTE: in PHP5.5 the array_map could be replaced by an array_column
					$key = array_search($payment_type, array_map(function($v){return $v['payment_type'];}, $payments));
				}

				// if no previous payment is found add a new one
				if($key === FALSE)
				{
					$payments[] = array('payment_type' => $payment_type, 'payment_amount' => $payment_amount);
				}
				else
				{
					// add up the new payment amount to an existing payment type
					$payments[$key]['payment_amount'] += $payment_amount;
				}
			}
		}

		if($this->Sale->update($sale_id, $sale_data, $payments))
		{
			echo json_encode(array('success' => TRUE, 'message' => $this->lang->line('sales_successfully_updated'), 'id' => $sale_id));
		}
		else
		{
			echo json_encode(array('success' => FALSE, 'message' => $this->lang->line('sales_unsuccessfully_updated'), 'id' => $sale_id));
		}
	}

	public function cancel()
	{
		$this->sale_lib->clear_all();

		$this->_reload($this->sale_lib->mark_unedited_transaction());
	}

	public function suspend()
	{
		$cart = $this->sale_lib->get_cart();
		$payments = $this->sale_lib->get_payments();
		$employee_id = $this->Employee->get_logged_in_employee_info()->person_id;
		$customer_id = $this->sale_lib->get_customer();
		$customer_info = $this->Customer->get_info($customer_id);
		$invoice_number = $this->_is_custom_invoice_number($customer_info) ? $this->sale_lib->get_invoice_number() : NULL;
		$comment = $this->sale_lib->get_comment();

		$infos=array();
		$infos['mail_state']=$this->sale_lib->get_mailState();
		$infos['cart_diff']=$this->sale_lib->get_cart_diff();
		$infos['sale_items_location']=$this->sale_lib->get_transaction_items_location();

		//SAVE sale to database
		$data = array();
		$sale_id=$this->Sale_suspended->save($cart, $customer_id, $employee_id, $comment, 
			$invoice_number, $payments,$infos,$this->sale_lib->get_transaction_id());
		if( $sale_id == '-1')
		{
			$data['error'] = $this->lang->line('sales_unsuccessfully_suspended_sale');
		}
		else
		{
			$this->sale_lib->set_transaction_id($sale_id);
			$this->sale_lib->clear_all();
			$this->sale_lib->copy_entire_suspended_transaction($sale_id);

			$data['success'] = $this->lang->line('sales_successfully_suspended_sale');
		}

		//$this->sale_lib->clear_all();

		$this->_reload($this->sale_lib->mark_unedited_transaction($data));
	}
	
	public function suspended()
	{	
		/*$data = array();
		$data['suspended_sales'] = $this->xss_clean($this->Sale_suspended->get_all()->result_array());

		$this->load->view('transaction/suspended', $data);*/
	}
	
	public function update(){
		$sale_id = $this->input->get('id');

		$this->sale_lib->clear_all();
		$this->sale_lib->copy_entire_suspended_transaction($sale_id);
		//$this->Sale_suspended->delete_together($sale_id);

		$this->_reload($this->sale_lib->mark_unedited_transaction());
	}
	public function unsuspend()
	{
		/*$sale_id = $this->input->post('suspended_sale_id');

		$this->sale_lib->clear_all();
		$this->sale_lib->copy_entire_suspended_transaction($sale_id);
		//$this->Sale_suspended->delete_together($sale_id);

		$this->_reload($this->sale_lib->mark_unedited_transaction());*/
	}
	
	public function check_invoice_number()
	{
		$sale_id = $this->input->post('sale_id');
		$invoice_number = $this->input->post('invoice_number');
		$exists = !empty($invoice_number) && $this->Sale->check_invoice_number_exists($invoice_number, $sale_id);

		echo !$exists ? 'true' : 'false';
	}

	public function change_sale_to_current_location(){
		$items = $this->sale_lib->get_cart();
		$location_id=$this->Stock_location->get_default_location_id();

		foreach ($items as $key => $item) {
			$item['item_location']=$location_id;
			$item['stock_name']=$this->Stock_location->get_location_name_session($location_id);

			if(1==$item['is_infinite']){continue;}
			$item['in_stock']=$this->Item_quantity->get_item_quantity($item['item_id'], $location_id)->quantity;

			$items[$key]=$item;
		}

		$this->sale_lib->set_cart($items);$this->sale_lib->clear_transaction_items_location();
		$this->_reload();
	}
}
?>
