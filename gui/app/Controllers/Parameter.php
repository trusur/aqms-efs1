<?php

namespace App\Controllers;

use App\Models\m_parameter;
use App\Models\m_sensor_value;
use Exception;

class Parameter extends BaseController
{

	public function __construct()
	{
		parent::__construct();
		$this->parameter = new m_parameter();
		$this->sensor_value = new m_sensor_value();
	}
	public function index()
	{
		if (!$this->session->get("loggedin")) return redirect()->to(base_url() . '/login?url_direction=parameter');

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			return $this->saving();
		}
		$data['__modulename'] = 'Parameters'; /* Title */
		$data['__routename'] = 'parameter'; /* Route for check menu */
		$data['sensor_values'] = @$this->sensor_value->select('sensor_values.id as id,sensor_reader_id,driver,pin')->join('sensor_readers', 'sensor_readers.id = sensor_values.sensor_reader_id', 'left')->findAll();
		$data['gases'] = $this->parameter->where(['p_type' => 'gas'])->findAll();
		$data['particulates'] = $this->parameter->where(['p_type' => 'particulate'])->findAll();
		$data['particulate_flows'] = $this->parameter->where(['p_type' => 'particulate_flow'])->findAll();
		$data['weathers'] = $this->parameter->where(['p_type' => 'weather'])->findAll();
		$data['flow_meters'] = $this->parameter->where(['p_type' => 'flowmeter'])->findAll();
		echo view("parameter/v_index", $data);
	}
	public function saving()
	{
		try {
			$req = $this->request;
			$id = $req->getPost('id');
			$data['code'] = $req->getPost('code');
			$data['caption_id'] = $req->getPost('caption_id');
			$data['molecular_mass'] = $req->getPost('molecular_mass');
			$data['is_view'] = $req->getPost('is_view');
			$data['is_graph'] = $req->getPost('is_graph');
			$data['sensor_value_id'] = $req->getPost('sensor_value_id') * 1;
			$data['voltage1'] = $req->getPost('voltage1') * 1;
			$data['voltage2'] = $req->getPost('voltage2') * 1;
			$data['concentration1'] = $req->getPost('concentration1') * 1;
			$data['concentration2'] = $req->getPost('concentration2') * 1;
			$data['formula'] = $req->getPost('formula');
			$this->parameter->update($id, $data);
			$data['success'] = true;
			$data['message'] = 'Parameter berhasil diubah';
		} catch (Exception $e) {
			$data['success'] = false;
			$data['message'] = 'Error : ' . $e->getMessage();
		}
		return $this->response->setJSON($data);
	}
	public function detail()
	{
		try {
			$id = $this->request->getGet('id');
			$data['success'] = true;
			$data['data'] = @$this->parameter->find($id);
		} catch (Exception $e) {
			$data['success'] = false;
			$data['message'] = $e->getMessage();
		}
		return $this->response->setJSON($data);
	}
	public function voltage()
	{
		try {
			$id = $this->request->getGet('sensor_value_id');
			$data['success'] = true;
			$data['data'] = @$this->sensor_value->select('value,pin,sensor_reader_id')->find($id);
		} catch (Exception $e) {
			$data['success'] = false;
			$data['message'] = $e->getMessage();
		}
		return $this->response->setJSON($data);
	}
}
