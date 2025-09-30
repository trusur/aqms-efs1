<?php

namespace App\Controllers;

use App\Models\m_configuration;
use App\Models\m_measurement;
use App\Models\m_parameter;

class Export extends BaseController
{

	public function __construct()
	{
		parent::__construct();
		$this->measurement = new m_measurement();
		$this->configuration = new m_configuration();
		$this->parameters = new m_parameter();
	}
	public function index()
	{
		$data['__modulename'] = 'Exports'; /* Title */
		$data['__routename'] = 'export'; /* Route for check menu */
		$data['parameters'] = $this->parameters->where('is_view', 1)->findAll();
		echo view("export/v_index", $data);
	}
	public function datatable()
	{
		// Configuration
		$id_station = @$this->configuration->where('name', 'id_stasiun')->get()->getFirstRow()->content;
		/*
			Filter
		*/
		$begindate = $this->request->getGet('begindate');
		$enddate = $this->request->getGet('enddate');
		if (isset($begindate) && isset($enddate)) { // Filter Date
			$where = "DATE_FORMAT(time_group, '%Y-%m-%d') >= '{$begindate}' ";
			$where .= "AND DATE_FORMAT(time_group, '%Y-%m-%d') <= '{$enddate}' ";
			$tGroups = $this->measurement->selectMax('id')->select('time_group')->where($where)->groupBy('time_group')->orderBy('time_group', 'DESC')->findAll(100);
		} else {
			$tGroups = $this->measurement->selectMax('id')->select('time_group')->groupBy('time_group')->orderBy('time_group', 'DESC')->findAll(100);
		}
		$parameters = [];
		foreach ($tGroups as $key => $tGroup) {
			@$parameters[$key]['id_stasiun'] = $id_station;
			@$parameters[$key]['waktu'] = $tGroup->time_group;
			foreach ($this->parameters->where('is_view', 1)->findAll() as $parameter) {
				@$parameters[$key][$parameter->code] = $this->measurement->where(['time_group' => $tGroup->time_group, 'parameter_id' => $parameter->id])->get()->getFirstRow()->value;
			}
		}
		$record = (isset($key) ? $key + 1 : 0);
		$data['draw'] = @$this->request->getGet('draw');
		$data['recordsTotal'] = $record;
		$data['recordsFiltered'] = $record;
		$data['data'] = $parameters;
		return json_encode($data);
	}
}
