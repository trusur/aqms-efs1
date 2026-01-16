<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SensorReaders extends Seeder
{
	public function run()
	{
		$this->db->query("TRUNCATE TABLE sensor_readers");
		$data = [
			['driver' => 'pm_alphasense_reader.py', 'sensor_code' => '/dev/ttyPM', 'baud_rate' => '9600', 'pins' => ''],
			['driver' => 'rk900_reader.py', 'sensor_code' => '/dev/ttyWS', 'baud_rate' => '9600', 'pins' => ''],
		];
		$this->db->table('sensor_readers')->insertBatch($data);
	}
}
