<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var string[]
	 */
	public $ruleSets = [
		Rules::class,
		FormatRules::class,
		FileRules::class,
		CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array<string, string>
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// RuleGroups
	//--------------------------------------------------------------------
	public $passvalidationtest = [
        'data.norequirements' 								=> 'trim',
    ];
	public $failvalidationtest = [
        'action.requirements' 								=> ['label' => 'Test', 'rules' => 'required|min_length[2]'],
    ];
	public $contactform = [
        'data.cf_name' 										=> ['label' => 'Name', 'rules' => 'required|min_length[2]'],
		'data.cf_email' 									=> ['label' => 'Email', 'rules' => 'required|valid_email'],
		'data.cf_body' 										=> ['label' => 'Message', 'rules' => 'required|min_length[10]'],
    ];
}
