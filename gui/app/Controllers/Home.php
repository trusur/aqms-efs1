<?php

namespace App\Controllers;

use App\Models\m_configuration;
use App\Models\m_parameter;

class Home extends BaseController
{

	public function __construct()
	{
		parent::__construct();
		$this->parameter = new m_parameter();
		$this->configuration = new m_configuration();
	}
	public function index()
	{
		$data['__modulename'] = 'Dashboard'; /* Title */
		$data['__routename'] = 'dashboard'; /* Route for check menu */
		$data['gases'] = $this->parameter->where(['is_view' => 1, 'p_type' => 'gas'])->findAll();
		$data['particulates'] = $this->parameter->where(['is_view' => 1, 'p_type' => 'particulate'])->findAll();
		$data['weathers'] = $this->parameter->where(['is_view' => 1, 'p_type' => 'weather'])->findAll();
		$data['flow_meters'] = $this->parameter->where(['is_view' => 1, 'p_type' => 'flowmeter'])->findAll();
		$data['stationname'] = @$this->configuration->where(['name' => 'nama_stasiun'])->get()->getFirstRow()->content;
		$data['is_cems'] = @$this->configuration->where(['name' => 'is_cems'])->get()->getFirstRow()->content;
		$data['pump_interval'] = @$this->configuration->where(['name' => 'pump_interval'])->get()->getFirstRow()->content;
		echo view("v_home", $data);
	}

	public function pump()
	{
		$getPumpState = $this->configuration->where(["name" => "pump_state"])->findAll()[0];
		$getPumpLast = $this->configuration->where(["name" => "pump_last"])->findAll()[0];
		if ($getPumpState->content == 1) {
			$switch = 0;
		} else {
			$switch = 1;
		}
		$pumpStateData['content'] 	= $switch;
		$pumpLastData['content'] 	= date('Y-m-d H:i:s');
		$this->configuration->update($getPumpState->id, $pumpStateData);
		$this->configuration->update($getPumpLast->id, $pumpLastData);
	}
}
