<?php

namespace Config;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var array
	 */
	public $ruleSets = [
		\CodeIgniter\Validation\Rules::class,
		\CodeIgniter\Validation\FormatRules::class,
		\CodeIgniter\Validation\FileRules::class,
		\CodeIgniter\Validation\CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------
	public $upload = [
		'file_excel'         => 'uploaded[file_excel]|ext_in[file_excel,xls,xlsx]|max_size[file_excel,5000]',
	];

	public $upload_errors = [
		'file_excel' => [
			'ext_in'    => 'File Excel hanya boleh diisi dengan xls atau xlsx.',
			'max_size'  => 'File Excel maksimal 5mb',
			'uploaded'  => 'File Excel wajib diisi'
		]
	];

	public $instrument = [
		'name' => 'required',
		'stack_id' => 'required',
		'parameter_id' => 'required',
		'parameter_id.*' => 'required',
		'i_type' => 'required',
		'status_id' => 'required',
	];

	public $instrument_errors = [
		'name' => ['required' => 'Instrument name cant be empty!'],
		'stack_id' => ['required' => 'You must choose stack'],
		'parameter_id' => ['required' => 'Parameter cant be empty!'],
		'parameter_id.*' => ['required' => 'Parameter cant be empty!'],
		'i_type' => ['required' => 'You must choose type!'],
		'status_id' => ['required' => 'You must choose status instrument!'],
	];
}
