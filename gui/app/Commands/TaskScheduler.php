<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\Models\m_configuration;
use Exception;

class TaskScheduler extends BaseCommand
{
	/**
	 * The Command's Group
	 *
	 * @var string
	 */
	protected $group = 'CodeIgniter';

	protected $configurations;


	public function __construct()
	{
		$this->configurations =  new m_configuration();
	}
	/**
	 * The Command's Name
	 *
	 * @var string
	 */
	protected $name = 'command:task_scheduler';

	/**
	 * The Command's Description
	 *
	 * @var string
	 */
	protected $description = '';

	/**
	 * The Command's Usage
	 *
	 * @var string
	 */
	protected $usage = 'command:name [arguments] [options]';

	/**
	 * The Command's Arguments
	 *
	 * @var array
	 */
	protected $arguments = [];

	/**
	 * The Command's Options
	 *
	 * @var array
	 */
	protected $options = [];

	/**
	 * Actually execute a command.
	 *
	 * @param array $params
	 */
	public function run(array $params)
	{
		while (true) {
			try {
				$restart_schedule = @$this->configurations->where(["name" => "restart_schedule"])->find()[0]->content;
				if ($restart_schedule != "") {
					$last_restart_schedule = @$this->configurations->where(["name" => "last_restart_schedule"])->find()[0]->content;
					if (substr($restart_schedule, 0, 5) == date("H:i") && substr($restart_schedule, 0, 5) . ":00" <= date("H:i:s") && $last_restart_schedule != date("Y-m-d H:i")) {
						$this->configurations->where(["name" => "last_restart_schedule"])->set(["content" => date("Y-m-d") . " " . substr($restart_schedule, 0, 5)])->update();
						$this->configurations->where(["name" => "is_psu_restarting"])->set(["content" => "1"])->update();
					}
				}
			} catch (Exception $e) {
			}
			sleep(1);
		}
	}
}
