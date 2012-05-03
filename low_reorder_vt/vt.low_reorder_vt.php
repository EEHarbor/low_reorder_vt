<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Low_reorder_vt extends Low_variables_type {

	/**
	 * Variable Type info
	 *
	 * @access     public
	 * @var        array
	 */
	public $info = array(
		'name'    => 'Low Reorder',
		'version' => '0.0.1'
	);

	/**
	 * Default settings for this variable type
	 *
	 * @access     public
	 * @var        array
	 */
	public $default_settings = array();

	// --------------------------------------------------------------------

	/**
	 * Display input field for regular user
	 *
	 * @access     public
	 * @param      int       $var_id        The id of the variable
	 * @param      string    $var_data      The value of the variable
	 * @param      array     $var_settings  The settings of the variable
	 * @return     string
	 */
	function display_input($var_id, $var_data, $var_settings)
	{
		// Keep track of all LR Sets
		static $sets;

		// Get them if not existing
		if ( ! $sets)
		{
			$query = $this->EE->db->select('set_id, set_label')
			       ->from('low_reorder_sets')
			       ->where('site_id', $this->EE->config->item('site_id'))
			       ->order_by('set_label', 'asc')
			       ->get();

			$sets = low_flatten_results($query->result_array(), 'set_label', 'set_id');
		}

		// Prepend empty option
		$options = array('' => '--') + $sets;

		// Return select element
		return form_dropdown("var[{$var_id}]", $options, $var_data);
	}
}
// End Low_reorder_vt class