<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('Secure_Controller.php');

class Reports extends Secure_Controller
{
	public function __construct()
	{
		parent::__construct('reports');

		$method_name = $this->uri->segment(2);
		$exploder = explode('_', $method_name);

		if(sizeof($exploder) > 1)
		{
			preg_match('/(?:inventory)|([^_.]*)(?:_graph|_row)?$/', $method_name, $matches);
			preg_match('/^(.*?)([sy])?$/', array_pop($matches), $matches);
			$submodule_id = $matches[1] . ((count($matches) > 2) ? $matches[2] : 's');

			$this->track_page('reports/' . $submodule_id, 'reports_' . $submodule_id);

			// check access to report submodule
			if(!$this->Employee->has_grant('reports_' . $submodule_id, $this->Employee->get_logged_in_employee_info()->person_id))
			{
				redirect('no_access/reports/reports_' . $submodule_id);
			}
		}

		$this->load->helper('report');
	}

	//Initial report listing screen
	public function index()
	{
		$data['grants'] = $this->xss_clean($this->Employee->get_employee_grants($this->session->userdata('person_id')));
		
		$this->load->view('reports/listing', $data);
	}

	//Summary sales report
	public function summary_sales($start_date, $end_date, $sale_type, $location_id = 'all')
	{
		$inputs = array('start_date' => $start_date, 'end_date' => $end_date, 'sale_type' => $sale_type, 'location_id' => $location_id);

		$this->load->model('reports/Summary_sales');
		$model = $this->Summary_sales;

		$report_data = $model->getData($inputs);
		$summary = $this->xss_clean($model->getSummaryData($inputs));

		$tabular_data = array();
		foreach($report_data as $row)
		{
			$tabular_data[] = $this->xss_clean(array(
				'sale_date' => $row['sale_date'],
				'quantity' => to_quantity_decimals($row['quantity_purchased']),
				'subtotal' => to_currency($row['subtotal']),
				'tax' => to_currency($row['tax']),
				'total' => to_currency($row['total']),
				'cost' => to_currency($row['cost']),
				'profit' => to_currency($row['profit'])
			));
		}

		$data = array(
			'title' => $this->lang->line('reports_sales_summary_report'),
			'subtitle' => date($this->config->item('dateformat'), strtotime($start_date)) . '-' . date($this->config->item('dateformat'), strtotime($end_date)),
			'headers' => $this->xss_clean($model->getDataColumns()),
			'data' => $tabular_data,
			'summary_data' => $summary
		);

		$this->load->view('reports/tabular', $data);
	}

	//Summary categories report
	public function summary_categories($start_date, $end_date, $sale_type, $location_id = 'all')
	{
		$inputs = array('start_date' => $start_date, 'end_date' => $end_date, 'sale_type' => $sale_type, 'location_id' => $location_id);

		$this->load->model('reports/Summary_categories');
		$model = $this->Summary_categories;

		$report_data = $model->getData($inputs);
		$summary = $this->xss_clean($model->getSummaryData($inputs));

		$tabular_data = array();
		foreach($report_data as $row)
		{
			$tabular_data[] = $this->xss_clean(array(
				'category' => $row['category'],
				'quantity' => to_quantity_decimals($row['quantity_purchased']),
				'subtotal' => to_currency($row['subtotal']),
				'tax' => to_currency($row['tax']),
				'total' => to_currency($row['total']),
				'cost' => to_currency($row['cost']),
				'profit' => to_currency($row['profit'])
			));
		}

		$data = array(
			'title' => $this->lang->line('reports_categories_summary_report'),
			'subtitle' => date($this->config->item('dateformat'), strtotime($start_date)) . '-' . date($this->config->item('dateformat'), strtotime($end_date)),
			'headers' => $this->xss_clean($model->getDataColumns()),
			'data' => $tabular_data,
			'summary_data' => $summary
		);

		$this->load->view('reports/tabular', $data);
	}

	//Summary customers report
	public function summary_customers($start_date, $end_date, $sale_type, $location_id = 'all')
	{
		$inputs = array('start_date' => $start_date, 'end_date' => $end_date, 'sale_type' => $sale_type, 'location_id' => $location_id);

		$this->load->model('reports/Summary_customers');
		$model = $this->Summary_customers;

		$report_data = $model->getData($inputs);
		$summary = $this->xss_clean($model->getSummaryData($inputs));

		$tabular_data = array();
		foreach($report_data as $row)
		{
			$tabular_data[] = $this->xss_clean(array(
				'customer_name' => $row['customer'],
				'quantity' => to_quantity_decimals($row['quantity_purchased']),
				'subtotal' => to_currency($row['subtotal']),
				'tax' => to_currency($row['tax']),
				'total' => to_currency($row['total']),
				'cost' => to_currency($row['cost']),
				'profit' => to_currency($row['profit'])
			));
		}

		$data = array(
			'title' => $this->lang->line('reports_customers_summary_report'),
			'subtitle' => date($this->config->item('dateformat'), strtotime($start_date)) . '-' . date($this->config->item('dateformat'), strtotime($end_date)),
			'headers' => $this->xss_clean($model->getDataColumns()),
			'data' => $tabular_data,
			'summary_data' => $summary
		);

		$this->load->view('reports/tabular', $data);
	}

	//Summary suppliers report
	public function summary_suppliers($start_date, $end_date, $sale_type, $location_id = 'all')
	{
		$inputs = array('start_date' => $start_date, 'end_date' => $end_date, 'sale_type' => $sale_type, 'location_id' => $location_id);

		$this->load->model('reports/Summary_suppliers');
		$model = $this->Summary_suppliers;

		$report_data = $model->getData($inputs);
		$summary = $this->xss_clean($model->getSummaryData($inputs));

		$tabular_data = array();
		foreach($report_data as $row)
		{
			$tabular_data[] = $this->xss_clean(array(
				'supplier_name' => $row['supplier'],
				'quantity' => to_quantity_decimals($row['quantity_purchased']),
				'subtotal' => to_currency($row['subtotal']),
				'tax' => to_currency($row['tax']),
				'total' => to_currency($row['total']),
				'cost' => to_currency($row['cost']),
				'profit' => to_currency($row['profit'])
			));
		}

		$data = array(
			'title' => $this->lang->line('reports_suppliers_summary_report'),
			'subtitle' => date($this->config->item('dateformat'), strtotime($start_date)) . '-' . date($this->config->item('dateformat'), strtotime($end_date)),
			'headers' => $this->xss_clean($model->getDataColumns()),
			'data' => $tabular_data,
			'summary_data' => $summary
		);

		$this->load->view('reports/tabular', $data);
	}

	//Summary items report
	public function summary_items($start_date, $end_date, $sale_type, $location_id = 'all')
	{
		$inputs = array('start_date' => $start_date, 'end_date' => $end_date, 'sale_type' => $sale_type, 'location_id' => $location_id);

		$this->load->model('reports/Summary_items');
		$model = $this->Summary_items;

		$report_data = $model->getData($inputs);
		$summary = $this->xss_clean($model->getSummaryData($inputs));

		$tabular_data = array();
		foreach($report_data as $row)
		{
			$tabular_data[] = $this->xss_clean(array(
				'item_name' => $row['name'],
				'quantity' => to_quantity_decimals($row['quantity_purchased']),
				'subtotal' => to_currency($row['subtotal']),
				'tax'  => to_currency($row['tax']),
				'total' => to_currency($row['total']),
				'cost' => to_currency($row['cost']),
				'profit' => to_currency($row['profit'])
			));
		}

		$data = array(
			'title' => $this->lang->line('reports_items_summary_report'),
			'subtitle' => date($this->config->item('dateformat'), strtotime($start_date)) . '-' . date($this->config->item('dateformat'), strtotime($end_date)),
			'headers' => $this->xss_clean($model->getDataColumns()),
			'data' => $tabular_data,
			'summary_data' => $summary
		);

		$this->load->view('reports/tabular', $data);
	}

	//Summary employees report
	public function summary_employees($start_date, $end_date, $sale_type, $location_id = 'all')
	{
		$inputs = array('start_date' => $start_date, 'end_date' => $end_date, 'sale_type' => $sale_type, 'location_id' => $location_id);

		$this->load->model('reports/Summary_employees');
		$model = $this->Summary_employees;

		$report_data = $model->getData($inputs);
		$summary = $this->xss_clean($model->getSummaryData($inputs));

		$tabular_data = array();
		foreach($report_data as $row)
		{
			$tabular_data[] = $this->xss_clean(array(
				'employee_name' => $row['employee'],
				'quantity' => to_quantity_decimals($row['quantity_purchased']),
				'subtotal' => to_currency($row['subtotal']),
				'tax' => to_currency($row['tax']),
				'total' => to_currency($row['total']),
				'cost' => to_currency($row['cost']),
				'profit' => to_currency($row['profit'])
			));
		}

		$data = array(
			'title' => $this->lang->line('reports_employees_summary_report'),
			'subtitle' => date($this->config->item('dateformat'), strtotime($start_date)) . '-' . date($this->config->item('dateformat'), strtotime($end_date)),
			'headers' => $this->xss_clean($model->getDataColumns()),
			'data' => $tabular_data,
			'summary_data' => $summary
		);

		$this->load->view('reports/tabular', $data);
	}

	//Summary taxes report
	public function summary_taxes($start_date, $end_date, $sale_type, $location_id = 'all')
	{
		$inputs = array('start_date' => $start_date, 'end_date' => $end_date, 'sale_type' => $sale_type, 'location_id' => $location_id);

		$this->load->model('reports/Summary_taxes');
		$model = $this->Summary_taxes;

		$report_data = $model->getData($inputs);
		$summary = $this->xss_clean($model->getSummaryData($inputs));

		$tabular_data = array();
		foreach($report_data as $row)
		{
			$tabular_data[] = $this->xss_clean(array(
				'tax_percent' => $row['percent'],
				'report_count' => $row['count'],
				'subtotal' => to_currency($row['subtotal']),
				'tax' => to_currency($row['tax']),
				'total' => to_currency($row['total'])
			));
		}

		$data = array(
			'title' => $this->lang->line('reports_taxes_summary_report'),
			'subtitle' => date($this->config->item('dateformat'), strtotime($start_date)) . '-' . date($this->config->item('dateformat'), strtotime($end_date)),
			'headers' => $this->xss_clean($model->getDataColumns()),
			'data' => $tabular_data,
			'summary_data' => $summary
		);

		$this->load->view('reports/tabular', $data);
	}

	//Summary discounts report
	public function summary_discounts($start_date, $end_date, $sale_type, $location_id = 'all')
	{
		$inputs = array('start_date' => $start_date, 'end_date' => $end_date, 'sale_type' => $sale_type, 'location_id' => $location_id);

		$this->load->model('reports/Summary_discounts');
		$model = $this->Summary_discounts;

		$report_data = $model->getData($inputs);
		$summary = $this->xss_clean($model->getSummaryData($inputs));

		$tabular_data = array();
		foreach($report_data as $row)
		{
			$tabular_data[] = $this->xss_clean(array(
				'discount' => $row['discount_percent'],
				'count' => $row['count']
			));
		}

		$data = array(
			'title' => $this->lang->line('reports_discounts_summary_report'),
			'subtitle' => date($this->config->item('dateformat'), strtotime($start_date)) . '-' . date($this->config->item('dateformat'), strtotime($end_date)),
			'headers' => $this->xss_clean($model->getDataColumns()),
			'data' => $tabular_data,
			'summary_data' => $summary
		);

		$this->load->view('reports/tabular', $data);
	}

	//Summary payments report
	public function summary_payments($start_date, $end_date, $sale_type, $location_id = 'all')
	{
		$inputs = array('start_date' => $start_date, 'end_date' => $end_date, 'sale_type' => $sale_type, 'location_id' => $location_id);

		$this->load->model('reports/Summary_payments');
		$model = $this->Summary_payments;

		$report_data = $model->getData($inputs);
		$summary = $this->xss_clean($model->getSummaryData($inputs));

		$tabular_data = array();
		foreach($report_data as $row)
		{
			$tabular_data[] = $this->xss_clean(array(
				'payment_type' => $row['payment_type'],
				'report_count' => $row['count'],
				'amount_tendered' => to_currency($row['payment_amount'])
			));
		}

		$data = array(
			'title' => $this->lang->line('reports_payments_summary_report'),
			'subtitle' => date($this->config->item('dateformat'), strtotime($start_date)) . '-' . date($this->config->item('dateformat'), strtotime($end_date)),
			'headers' => $this->xss_clean($model->getDataColumns()),
			'data' => $tabular_data,
			'summary_data' => $summary
		);

		$this->load->view('reports/tabular', $data);
	}

	//Input for reports that require only a date range. (see routes.php to see that all graphical summary reports route here)
	public function date_input()
	{
		$data = array();
		$stock_locations = $data = $this->xss_clean($this->Stock_location->get_allowed_locations('sales'));
		$stock_locations['all'] = $this->lang->line('reports_all');
		$data['stock_locations'] = array_reverse($stock_locations, TRUE);
		$data['mode'] = 'sale';

		$this->load->view('reports/date_input', $data);
	}

	//Input for reports that require only a date range. (see routes.php to see that all graphical summary reports route here)
	public function date_input_sales()
	{
		$data = array();
		$stock_locations = $data = $this->xss_clean($this->Stock_location->get_allowed_locations('sales'));
		$stock_locations['all'] =  $this->lang->line('reports_all');
		$data['stock_locations'] = array_reverse($stock_locations, TRUE);
        $data['mode'] = 'sale';

		$this->load->view('reports/date_input', $data);
	}

    public function date_input_recv()
    {
        $data = array();
		$stock_locations = $data = $this->xss_clean($this->Stock_location->get_allowed_locations('receivings'));
		$stock_locations['all'] =  $this->lang->line('reports_all');
		$data['stock_locations'] = array_reverse($stock_locations, TRUE);
 		$data['mode'] = 'receiving';

        $this->load->view('reports/date_input', $data);
    }

	//Graphical summary sales report
	public function graphical_summary_sales($start_date, $end_date, $sale_type, $location_id = 'all')
	{
		$inputs = array('start_date' => $start_date, 'end_date' => $end_date, 'sale_type' => $sale_type, 'location_id' => $location_id);

		$this->load->model('reports/Summary_sales');
		$model = $this->Summary_sales;

		$report_data = $model->getData($inputs);
		$summary = $this->xss_clean($model->getSummaryData($inputs));

		$labels = array();
		$series = array();
		foreach($report_data as $row)
		{
			$row = $this->xss_clean($row);

			$date = date($this->config->item('dateformat'), strtotime($row['sale_date']));
			$labels[] = $date;
			$series[] = array('meta' => $date, 'value' => $row['total']);
		}

		$data = array(
			'title' => $this->lang->line('reports_sales_summary_report'),
			'subtitle' => date($this->config->item('dateformat'), strtotime($start_date)) . '-' . date($this->config->item('dateformat'), strtotime($end_date)),
			'chart_type' => 'reports/graphs/line',
			'labels_1' => $labels,
			'series_data_1' => $series,
			'summary_data_1' => $summary,
			'yaxis_title' => $this->lang->line('reports_revenue'),
			'xaxis_title' => $this->lang->line('reports_date'),
			'show_currency' => TRUE
		);

		$this->load->view('reports/graphical', $data);
	}

	//Graphical summary items report
	public function graphical_summary_items($start_date, $end_date, $sale_type, $location_id = 'all')
	{
		$inputs = array('start_date' => $start_date, 'end_date' => $end_date, 'sale_type' => $sale_type, 'location_id' => $location_id);

		$this->load->model('reports/Summary_items');
		$model = $this->Summary_items;

		$report_data = $model->getData($inputs);
		$summary = $this->xss_clean($model->getSummaryData($inputs));

		$labels = array();
		$series = array();
		foreach($report_data as $row)
		{
			$row = $this->xss_clean($row);

			$labels[] = $row['name'];
			$series[] = $row['total'];
		}

		$data = array(
			'title' => $this->lang->line('reports_items_summary_report'),
			'subtitle' => date($this->config->item('dateformat'), strtotime($start_date)) . '-' . date($this->config->item('dateformat'), strtotime($end_date)),
			'chart_type' => 'reports/graphs/hbar',
			'labels_1' => $labels,
			'series_data_1' => $series,
			'summary_data_1' => $summary,
			'yaxis_title' => $this->lang->line('reports_items'),
			'xaxis_title' => $this->lang->line('reports_revenue'),
			'show_currency' => TRUE
		);

		$this->load->view('reports/graphical', $data);
	}

	//Graphical summary customers report
	public function graphical_summary_categories($start_date, $end_date, $sale_type, $location_id = 'all')
	{
		$inputs = array('start_date' => $start_date, 'end_date' => $end_date, 'sale_type' => $sale_type, 'location_id' => $location_id);

		$this->load->model('reports/Summary_categories');
		$model = $this->Summary_categories;

		$report_data = $model->getData($inputs);
		$summary = $this->xss_clean($model->getSummaryData($inputs));

		$labels = array();
		$series = array();
		foreach($report_data as $row)
		{
			$row = $this->xss_clean($row);

			$labels[] = $row['category'];
			$series[] = array('meta' => $row['category'] . ' ' . round($row['total'] / $summary['total'] * 100, 2) . '%', 'value' => $row['total']);
		}

		$data = array(
			'title' => $this->lang->line('reports_categories_summary_report'),
			'subtitle' => date($this->config->item('dateformat'), strtotime($start_date)) . '-' . date($this->config->item('dateformat'), strtotime($end_date)),
			'chart_type' => 'reports/graphs/pie',
			'labels_1' => $labels,
			'series_data_1' => $series,
			'summary_data_1' => $summary,
			'show_currency' => TRUE
		);

		$this->load->view('reports/graphical', $data);
	}

	//Graphical summary suppliers report
	public function graphical_summary_suppliers($start_date, $end_date, $sale_type, $location_id = 'all')
	{
		$inputs = array('start_date' => $start_date, 'end_date' => $end_date, 'sale_type' => $sale_type, 'location_id' => $location_id);

		$this->load->model('reports/Summary_suppliers');
		$model = $this->Summary_suppliers;

		$report_data = $model->getData($inputs);
		$summary = $this->xss_clean($model->getSummaryData($inputs));

		$labels = array();
		$series = array();
		foreach($report_data as $row)
		{
			$row = $this->xss_clean($row);

			$labels[] = $row['supplier'];
			$series[] = array('meta' => $row['supplier'] . ' ' . round($row['total'] / $summary['total'] * 100, 2) . '%', 'value' => $row['total']);
		}

		$data = array(
			'title' => $this->lang->line('reports_suppliers_summary_report'),
			'subtitle' => date($this->config->item('dateformat'), strtotime($start_date)) . '-' . date($this->config->item('dateformat'), strtotime($end_date)),
			'chart_type' => 'reports/graphs/pie',
			'labels_1' => $labels,
			'series_data_1' => $series,
			'summary_data_1' => $summary,
			'show_currency' => TRUE
		);

		$this->load->view('reports/graphical', $data);
	}

	//Graphical summary employees report
	public function graphical_summary_employees($start_date, $end_date, $sale_type, $location_id = 'all')
	{
		$inputs = array('start_date' => $start_date, 'end_date' => $end_date, 'sale_type' => $sale_type, 'location_id' => $location_id);

		$this->load->model('reports/Summary_employees');
		$model = $this->Summary_employees;
		
		$report_data = $model->getData($inputs);
		$summary = $this->xss_clean($model->getSummaryData($inputs));

		$labels = array();
		$series = array();
		foreach($report_data as $row)
		{
			$row = $this->xss_clean($row);

			$labels[] = $row['employee'];
			$series[] = array('meta' => $row['employee'] . ' ' . round($row['total'] / $summary['total'] * 100, 2) . '%', 'value' => $row['total']);
		}

		$data = array(
			'title' => $this->lang->line('reports_employees_summary_report'),
			'subtitle' => date($this->config->item('dateformat'), strtotime($start_date)) . '-' . date($this->config->item('dateformat'), strtotime($end_date)),
			'chart_type' => 'reports/graphs/pie',
			'labels_1' => $labels,
			'series_data_1' => $series,
			'summary_data_1' => $summary,
			'show_currency' => TRUE
		);

		$this->load->view('reports/graphical', $data);
	}

	//Graphical summary taxes report
	public function graphical_summary_taxes($start_date, $end_date, $sale_type, $location_id = 'all')
	{
		$inputs = array('start_date' => $start_date, 'end_date' => $end_date, 'sale_type' => $sale_type, 'location_id' => $location_id);

		$this->load->model('reports/Summary_taxes');
		$model = $this->Summary_taxes;
		
		$report_data = $model->getData($inputs);
		$summary = $this->xss_clean($model->getSummaryData($inputs));

		$labels = array();
		$series = array();
		foreach($report_data as $row)
		{
			$row = $this->xss_clean($row);

			$labels[] = $row['percent'];
			$series[] = array('meta' => $row['percent'] . ' ' . round($row['total'] / $summary['total'] * 100, 2) . '%', 'value' => $row['total']);
		}

		$data = array(
			'title' => $this->lang->line('reports_taxes_summary_report'),
			'subtitle' => date($this->config->item('dateformat'), strtotime($start_date)) . '-' . date($this->config->item('dateformat'), strtotime($end_date)),
			'chart_type' => 'reports/graphs/pie',
			'labels_1' => $labels,
			'series_data_1' => $series,
			'summary_data_1' => $summary,
			'show_currency' => TRUE
		);

		$this->load->view('reports/graphical', $data);
	}

	//Graphical summary customers report
	public function graphical_summary_customers($start_date, $end_date, $sale_type, $location_id = 'all')
	{
		$inputs = array('start_date' => $start_date, 'end_date' => $end_date, 'sale_type' => $sale_type, 'location_id' => $location_id);
		
		$this->load->model('reports/Summary_customers');
		$model = $this->Summary_customers;
		
		$report_data = $model->getData($inputs);
		$summary = $this->xss_clean($model->getSummaryData($inputs));

		$labels = array();
		$series = array();
		foreach($report_data as $row)
		{
			$row = $this->xss_clean($row);

			$labels[] = $row['customer'];
			$series[] = $row['total'];
		}

		$data = array(
			'title' => $this->lang->line('reports_customers_summary_report'),
			'subtitle' => date($this->config->item('dateformat'), strtotime($start_date)) . '-' . date($this->config->item('dateformat'), strtotime($end_date)),
			'chart_type' => 'reports/graphs/hbar',
			'labels_1' => $labels,
			'series_data_1' => $series,
			'summary_data_1' => $summary,
			'yaxis_title' => $this->lang->line('reports_customers'),
			'xaxis_title' => $this->lang->line('reports_revenue'),
			'show_currency' => TRUE
		);

		$this->load->view('reports/graphical', $data);
	}

	//Graphical summary discounts report
	public function graphical_summary_discounts($start_date, $end_date, $sale_type, $location_id = 'all')
	{
		$inputs = array('start_date' => $start_date, 'end_date' => $end_date, 'sale_type' => $sale_type, 'location_id' => $location_id);

		$this->load->model('reports/Summary_discounts');
		$model = $this->Summary_discounts;
		
		$report_data = $model->getData($inputs);
		$summary = $this->xss_clean($model->getSummaryData($inputs));

		$labels = array();
		$series = array();
		foreach($report_data as $row)
		{
			$row = $this->xss_clean($row);

			$labels[] = $row['discount_percent'];
			$series[] = $row['count'];
		}

		$data = array(
			'title' => $this->lang->line('reports_discounts_summary_report'),
			'subtitle' => date($this->config->item('dateformat'), strtotime($start_date)) . '-' . date($this->config->item('dateformat'), strtotime($end_date)),
			'chart_type' => 'reports/graphs/bar',
			'labels_1' => $labels,
			'series_data_1' => $series,
			'summary_data_1' => $summary,
			'yaxis_title' => $this->lang->line('reports_count'),
			'xaxis_title' => $this->lang->line('reports_discount_percent'),
			'show_currency' => FALSE
		);

		$this->load->view('reports/graphical', $data);
	}

	//Graphical summary payments report
	public function graphical_summary_payments($start_date, $end_date, $sale_type, $location_id = 'all')
	{
		$inputs = array('start_date' => $start_date, 'end_date' => $end_date, 'sale_type' => $sale_type, 'location_id' => $location_id);
		
		$this->load->model('reports/Summary_payments');
		$model = $this->Summary_payments;
		
		$report_data = $model->getData($inputs);
		$summary = $this->xss_clean($model->getSummaryData($inputs));

		$labels = array();
		$series = array();
		foreach($report_data as $row)
		{
			$row = $this->xss_clean($row);

			$labels[] = $row['payment_type'];
			$series[] = array('meta' => $row['payment_type'] . ' ' . round($row['payment_amount'] / $summary['total'] * 100, 2) . '%', 'value' => $row['payment_amount']);
		}

		$data = array(
			'title' => $this->lang->line('reports_payments_summary_report'),
			'subtitle' => date($this->config->item('dateformat'), strtotime($start_date)) . '-' . date($this->config->item('dateformat'), strtotime($end_date)),
			'chart_type' => 'reports/graphs/pie',
			'labels_1' => $labels,
			'series_data_1' => $series,
			'summary_data_1' => $summary,
			'show_currency' => TRUE
		);

		$this->load->view('reports/graphical', $data);
	}

	public function specific_customer_input()
	{
		$data = array();
		$data['specific_input_name'] = $this->lang->line('reports_customer');

		$customers = array();
		foreach($this->Customer->get_all()->result() as $customer)
		{		
			$customers[$customer->person_id] = $this->xss_clean($customer->first_name . ' ' . $customer->last_name);
		}
		$data['specific_input_data'] = $customers;

		$this->load->view('reports/specific_input', $data);
	}

	public function specific_customer($start_date, $end_date, $customer_id, $sale_type)
	{
		$inputs = array('start_date' => $start_date, 'end_date' => $end_date, 'customer_id' => $customer_id, 'sale_type' => $sale_type);
		
		$this->load->model('reports/Specific_customer');
		$model = $this->Specific_customer;

		$model->create($inputs);

		$headers = $this->xss_clean($model->getDataColumns());
		$report_data = $model->getData($inputs);

		$summary_data = array();
		$details_data = array();

		foreach($report_data['summary'] as $key => $row)
		{
			$summary_data[] = $this->xss_clean(array(
				'id' => anchor('sales/receipt/'.$row['sale_id'], 'POS '.$row['sale_id'], array('target'=>'_blank')),
				'sale_date' => $row['sale_date'],
				'quantity' => to_quantity_decimals($row['items_purchased']),
				'employee_name' => $row['employee_name'],
				'subtotal' => to_currency($row['subtotal']),
				'tax' => to_currency($row['tax']),
				'total' => to_currency($row['total']),
				'cost' => to_currency($row['cost']),
				'profit' => to_currency($row['profit']),
				'payment_type' => $row['payment_type'],
				'comment' => $row['comment']));

			foreach($report_data['details'][$key] as $drow)
			{
				$details_data[$row['sale_id']][] = $this->xss_clean(array($drow['name'], $drow['category'], $drow['serialnumber'], $drow['description'], to_quantity_decimals($drow['quantity_purchased']), to_currency($drow['subtotal']), to_currency($drow['tax']), to_currency($drow['total']), to_currency($drow['cost']), to_currency($drow['profit']), $drow['discount_percent'].'%'));
			}
		}

		$customer_info = $this->Customer->get_info($customer_id);
		$data = array(
			'title' => $this->xss_clean($customer_info->first_name . ' ' . $customer_info->last_name . ' ' . $this->lang->line('reports_report')),
			'subtitle' => date($this->config->item('dateformat'), strtotime($start_date)) . '-' . date($this->config->item('dateformat'), strtotime($end_date)),
			'headers' => $headers,
			'summary_data' => $summary_data,
			'details_data' => $details_data,
			'overall_summary_data' => $this->xss_clean($model->getSummaryData($inputs))
		);

		$this->load->view('reports/tabular_details', $data);
	}

	public function specific_employee_input()
	{
		$data = array();
		$data['specific_input_name'] = $this->lang->line('reports_employee');

		$employees = array();
		foreach($this->Employee->get_all()->result() as $employee)
		{
			$employees[$employee->person_id] = $this->xss_clean($employee->first_name . ' ' . $employee->last_name);
		}
		$data['specific_input_data'] = $employees;

		$this->load->view('reports/specific_input', $data);
	}

	public function specific_employee($start_date, $end_date, $employee_id, $sale_type)
	{
		$inputs = array('start_date' => $start_date, 'end_date' => $end_date, 'employee_id' => $employee_id, 'sale_type' => $sale_type);

		$this->load->model('reports/Specific_employee');
		$model = $this->Specific_employee;

		$model->create($inputs);

		$headers = $this->xss_clean($model->getDataColumns());
		$report_data = $model->getData($inputs);

		$summary_data = array();
		$details_data = array();

		foreach($report_data['summary'] as $key => $row)
		{
			$summary_data[] = $this->xss_clean(array(
				'id' => anchor('sales/receipt/'.$row['sale_id'], 'POS '.$row['sale_id'], array('target'=>'_blank')),
				'sale_date' => $row['sale_date'],
				'quantity' => to_quantity_decimals($row['items_purchased']),
				'customer_name' => $row['customer_name'],
				'subtotal' => to_currency($row['subtotal']),
				'tax' => to_currency($row['tax']),
				'total' => to_currency($row['total']),
				'cost' => to_currency($row['cost']),
				'profit' => to_currency($row['profit']),
				'payment_type' => $row['payment_type'],
				'comment' => $row['comment']));

			foreach($report_data['details'][$key] as $drow)
			{
				$details_data[$row['sale_id']][] = $this->xss_clean(array($drow['name'], $drow['category'], $drow['serialnumber'], $drow['description'], to_quantity_decimals($drow['quantity_purchased']), to_currency($drow['subtotal']), to_currency($drow['tax']), to_currency($drow['total']), to_currency($drow['cost']), to_currency($drow['profit']), $drow['discount_percent'].'%'));
			}
		}

		$employee_info = $this->Employee->get_info($employee_id);
		$data = array(
			'title' => $this->xss_clean($employee_info->first_name . ' ' . $employee_info->last_name . ' ' . $this->lang->line('reports_report')),
			'subtitle' => date($this->config->item('dateformat'), strtotime($start_date)) . '-' . date($this->config->item('dateformat'), strtotime($end_date)),
			'headers' => $headers,
			'summary_data' => $summary_data,
			'details_data' => $details_data,
			'overall_summary_data' => $this->xss_clean($model->getSummaryData($inputs))
		);

		$this->load->view('reports/tabular_details', $data);
	}

	public function specific_discount_input()
	{
		$data = array();
		$data['specific_input_name'] = $this->lang->line('reports_discount');

		$discounts = array();
		for ($i = 0; $i <= 100; $i += 10)
		{
			$discounts[$i] = $i . '%';
		}
		$data['specific_input_data'] = $discounts;
		
		$data = $this->xss_clean($data);

		$this->load->view('reports/specific_input', $data);
	}

	public function specific_discount($start_date, $end_date, $discount, $sale_type)
	{
		$inputs = array('start_date' => $start_date, 'end_date' => $end_date, 'discount' => $discount, 'sale_type' => $sale_type);
		
		$this->load->model('reports/Specific_discount');
		$model = $this->Specific_discount;

		$model->create($inputs);

		$headers = $this->xss_clean($model->getDataColumns());
		$report_data = $model->getData($inputs);

		$summary_data = array();
		$details_data = array();

		foreach($report_data['summary'] as $key => $row)
		{
			$summary_data[] = $this->xss_clean(array(
				'id' => anchor('sales/receipt/'.$row['sale_id'], 'POS '.$row['sale_id'], array('target'=>'_blank')),
				'sale_date' => $row['sale_date'],
				'quantity' => to_quantity_decimals($row['items_purchased']),
				'customer_name' => $row['customer_name'],
				'subtotal' => to_currency($row['subtotal']),
				'tax' => to_currency($row['tax']),
				'total' => to_currency($row['total']),
				'profit' => to_currency($row['profit']),
				'payment_type' => $row['payment_type'],
				'comment' => $row['comment']
			));

			foreach($report_data['details'][$key] as $drow)
			{
				$details_data[$row['sale_id']][] = $this->xss_clean(array($drow['name'], $drow['category'], $drow['serialnumber'], $drow['description'], to_quantity_decimals($drow['quantity_purchased']), to_currency($drow['subtotal']), to_currency($drow['tax']), to_currency($drow['total']), to_currency($drow['profit']), $drow['discount_percent'].'%'));
			}
		}

		$data = array(
			'title' => $discount . '% ' . $this->lang->line('reports_discount') . ' ' . $this->lang->line('reports_report'),
			'subtitle' => date($this->config->item('dateformat'), strtotime($start_date)) . '-' . date($this->config->item('dateformat'), strtotime($end_date)),
			'headers' => $headers,
			'summary_data' => $summary_data,
			'details_data' => $details_data,
			'overall_summary_data' => $this->xss_clean($model->getSummaryData($inputs))
		);

		$this->load->view('reports/tabular_details', $data);
	}

 	public function get_detailed_sales_row($sale_id)
	{
		$inputs = array('sale_id' => $sale_id);
		
		$this->load->model('reports/Detailed_sales');
		$model = $this->Detailed_sales;

		$model->create($inputs);

		$report_data = $model->getDataBySaleId($sale_id);

		$summary_data = $this->xss_clean(array(
			'sale_id' => $report_data['sale_id'],
			'sale_date' => $report_data['sale_date'],
			'quantity' => to_quantity_decimals($report_data['items_purchased']),
			'employee_name' => $report_data['employee_name'],
			'customer_name' => $report_data['customer_name'],
			'subtotal' => to_currency($report_data['subtotal']),
			'tax' => to_currency($report_data['tax']),
			'total' => to_currency($report_data['total']),
			'cost' => to_currency($report_data['cost']),
			'profit' => to_currency($report_data['profit']),
			'payment_type' => $report_data['payment_type'],
			'comment' => $report_data['comment'],
			'edit' => anchor('sales/edit/'. $report_data['sale_id'], '<span class="glyphicon glyphicon-edit"></span>',
				array('class'=>'modal-dlg print_hide', 'data-btn-delete' => $this->lang->line('common_delete'), 'data-btn-submit' => $this->lang->line('common_submit'), 'title' => $this->lang->line('sales_update'))
			)
		));

		echo json_encode(array($sale_id => $summary_data));
	}

	public function detailed_sales($start_date, $end_date, $sale_type, $location_id = 'all')
	{
		$inputs = array('start_date' => $start_date, 'end_date' => $end_date, 'sale_type' => $sale_type, 'location_id' => $location_id);
		
		$this->load->model('reports/Detailed_sales');
		$model = $this->Detailed_sales;
		
		$model->create($inputs);

		$headers = $this->xss_clean($model->getDataColumns());
		$report_data = $model->getData($inputs);

		$summary_data = array();
		$details_data = array();

		$show_locations = $this->xss_clean($this->Stock_location->multiple_locations());

		foreach($report_data['summary'] as $key => $row)
		{
			$summary_data[] = $this->xss_clean(array(
				'id' => $row['sale_id'],
				'sale_date' => $row['sale_date'],
				'quantity' => to_quantity_decimals($row['items_purchased']),
				'employee_name' => $row['employee_name'],
				'customer_name' => $row['customer_name'],
				'subtotal' => to_currency($row['subtotal']),
				'tax' => to_currency($row['tax']),
				'total' => to_currency($row['total']),
				'cost' => to_currency($row['cost']),
				'profit' => to_currency($row['profit']),
				'payment_type' => $row['payment_type'],
				'comment' => $row['comment'],
				'edit' => anchor('sales/edit/'.$row['sale_id'], '<span class="glyphicon glyphicon-edit"></span>',
					array('class' => 'modal-dlg print_hide', 'data-btn-delete' => $this->lang->line('common_delete'), 'data-btn-submit' => $this->lang->line('common_submit'), 'title' => $this->lang->line('sales_update'))
				)
			));

			foreach($report_data['details'][$key] as $drow)
			{
				$quantity_purchased = to_quantity_decimals($drow['quantity_purchased']);
				if($show_locations)
				{
					$quantity_purchased .= ' [' . $this->Stock_location->get_location_name($drow['item_location']) . ']';
				}
				$details_data[$row['sale_id']][] = $this->xss_clean(array($drow['name'], $drow['category'], $drow['serialnumber'], $drow['description'], $quantity_purchased, to_currency($drow['subtotal']), to_currency($drow['tax']), to_currency($drow['total']), to_currency($drow['cost']), to_currency($drow['profit']), $drow['discount_percent'].'%'));
			}
		}

		$data = array(
			'title' => $this->lang->line('reports_detailed_sales_report'),
			'subtitle' => date($this->config->item('dateformat'), strtotime($start_date)) . '-' . date($this->config->item('dateformat'), strtotime($end_date)),
			'headers' => $headers,
			'editable' => 'sales',
			'summary_data' => $summary_data,
			'details_data' => $details_data,
			'overall_summary_data' => $this->xss_clean($model->getSummaryData($inputs))
		);

		$this->load->view('reports/tabular_details', $data);
	}

	public function get_detailed_receivings_row($receiving_id)
	{
		$inputs = array('receiving_id' => $receiving_id);

		$this->load->model('reports/Detailed_receivings');
		$model = $this->Detailed_receivings;
		
		$model->create($inputs);

		$report_data = $model->getDataByReceivingId($receiving_id);

		$summary_data = $this->xss_clean(array(
			'receiving_id' => $report_data['receiving_id'],
			'receiving_date' => $report_data['receiving_date'],
			'quantity' => to_quantity_decimals($report_data['items_purchased']),
			'employee_name' => $report_data['employee_name'],
			'supplier_name' => $report_data['supplier_name'],
			'total' => to_currency($report_data['total']),
			'payment_type' => $report_data['payment_type'],
			'reference' => $report_data['reference'],
			'comment' => $report_data['comment'],
			'edit' => anchor('receivings/edit/'. $report_data['receiving_id'], '<span class="glyphicon glyphicon-edit"></span>',
				array('class'=>'modal-dlg print_hide', 'data-btn-submit' => $this->lang->line('common_submit'), 'data-btn-delete' => $this->lang->line('common_delete'), 'title' => $this->lang->line('receivings_update'))
			)
		));

		echo json_encode(array($receiving_id => $summary_data));
	}

	public function detailed_receivings($start_date, $end_date, $receiving_type, $location_id = 'all')
	{
		$inputs = array('start_date' => $start_date, 'end_date' => $end_date, 'receiving_type' => $receiving_type, 'location_id' => $location_id);
		
		$this->load->model('reports/Detailed_receivings');
		$model = $this->Detailed_receivings;
		
		$model->create($inputs);

		$headers = $this->xss_clean($model->getDataColumns());
		$report_data = $model->getData($inputs);

		$summary_data = array();
		$details_data = array();

		$show_locations = $this->xss_clean($this->Stock_location->multiple_locations());

		foreach($report_data['summary'] as $key => $row)
		{
			$summary_data[] = $this->xss_clean(array(
				'id' => $row['receiving_id'],
				'receiving_date' => $row['receiving_date'],
				'quantity' => to_quantity_decimals($row['items_purchased']),
				'employee_name' => $row['employee_name'],
				'supplier_name' => $row['supplier_name'],
				'total' => to_currency($row['total']),
				'payment_type' => $row['payment_type'],
				'reference' => $row['reference'],
				'comment' => $row['comment'],
				'edit' => anchor('receivings/edit/' . $row['receiving_id'], '<span class="glyphicon glyphicon-edit"></span>',
					array('class' => 'modal-dlg print_hide', 'data-btn-delete' => $this->lang->line('common_delete'), 'data-btn-submit' => $this->lang->line('common_submit'), 'title' => $this->lang->line('receivings_update'))
				)
			));

			foreach($report_data['details'][$key] as $drow)
			{
				$quantity_purchased = $drow['receiving_quantity'] > 1 ? to_quantity_decimals($drow['quantity_purchased']) . ' x ' . to_quantity_decimals($drow['receiving_quantity']) : to_quantity_decimals($drow['quantity_purchased']);
				if ($show_locations)
				{
					$quantity_purchased .= ' [' . $this->Stock_location->get_location_name($drow['item_location']) . ']';
				}
				$details_data[$row['receiving_id']][] = $this->xss_clean(array($drow['item_number'], $drow['name'], $drow['category'], $quantity_purchased, to_currency($drow['total']), $drow['discount_percent'].'%'));
			}
		}

		$data = array(
			'title' => $this->lang->line('reports_detailed_receivings_report'),
			'subtitle' => date($this->config->item('dateformat'), strtotime($start_date)) . '-' . date($this->config->item('dateformat'), strtotime($end_date)),
			'headers' => $headers,
			'editable' => 'receivings',
			'summary_data' => $summary_data,
			'details_data' => $details_data,
			'overall_summary_data' => $this->xss_clean($model->getSummaryData($inputs))
		);

		$this->load->view('reports/tabular_details', $data);
	}

	public function inventory_low()
	{
		$inputs = array();

		$this->load->model('reports/Inventory_low');
		$model = $this->Inventory_low;

		$report_data = $model->getData($inputs);
		
		$tabular_data = array();
		foreach($report_data as $row)
		{
			$tabular_data[] = $this->xss_clean(array(
				'item_name' => $row['name'],
				'item_number' => $row['item_number'],
				'quantity' => to_quantity_decimals($row['quantity']),
				'reorder_level' => to_quantity_decimals($row['reorder_level']),
				'location_name' => $row['location_name']
			));
		}

		$data = array(
			'title' => $this->lang->line('reports_inventory_low_report'),
			'subtitle' => '',
			'headers' => $this->xss_clean($model->getDataColumns()),
			'data' => $tabular_data,
			'summary_data' => $this->xss_clean($model->getSummaryData($inputs))
		);

		$this->load->view('reports/tabular', $data);
	}

	public function inventory_summary_input()
	{
		$this->load->model('reports/Inventory_summary');
		$model = $this->Inventory_summary;
		
		$data = array();
		$data['item_count'] = $model->getItemCountDropdownArray();

		$stock_locations = $this->xss_clean($this->Stock_location->get_allowed_locations());
		$stock_locations['all'] = $this->lang->line('reports_all');
		$data['stock_locations'] = array_reverse($stock_locations, TRUE);

		$this->load->view('reports/inventory_summary_input', $data);
	}

	public function inventory_summary($location_id = 'all', $item_count = 'all')
	{
		$inputs = array('location_id' => $location_id, 'item_count' => $item_count);
		
		$this->load->model('reports/Inventory_summary');
		$model = $this->Inventory_summary;

		$report_data = $model->getData($inputs);

		$tabular_data = array();
		foreach($report_data as $row)
		{
			$tabular_data[] = $this->xss_clean(array(
				'item_name' => $row['name'],
				'item_number' => $row['item_number'],
				'quantity' => to_quantity_decimals($row['quantity']),
				'reorder_level' => to_quantity_decimals($row['reorder_level']),
				'location_name' => $row['location_name'],
				'cost_price' => to_currency($row['cost_price']),
				'unit_price' => to_currency($row['unit_price']),
				'subtotal' => to_currency($row['sub_total_value'])
			));
		}

		$data = array(
			'title' => $this->lang->line('reports_inventory_summary_report'),
			'subtitle' => '',
			'headers' => $this->xss_clean($model->getDataColumns()),
			'data' => $tabular_data,
			'summary_data' => $this->xss_clean($model->getSummaryData($report_data))
		);

		$this->load->view('reports/tabular', $data);
	}
}
?>