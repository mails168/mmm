<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Fclub
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		Fclub
 * @author		Jasper
 * @copyright           Copyright (c) 2006 - 2012 Fclub, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 2.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Fclub Dummy Caching Class
 *
 * @package		Fclub
 * @subpackage          Libraries
 * @category            Core
 * @author		Jasper
 * @link
 */

class MY_Cache_dummy extends CI_Driver {

	/**
	 * Get
	 *
	 * Since this is the dummy class, it's always going to return FALSE.
	 *
	 * @param 	string
	 * @return 	Boolean		FALSE
	 */
	public function get($id)
	{
		return FALSE;
	}

	// ------------------------------------------------------------------------

	/**
	 * Cache Save
	 *
	 * @param 	string		Unique Key
	 * @param 	mixed		Data to store
	 * @param 	int			Length of time (in seconds) to cache the data
	 *
	 * @return 	boolean		TRUE, Simulating success
	 */
	public function save($id, $data, $ttl = 60)
	{
		return TRUE;
	}

	// ------------------------------------------------------------------------

	/**
	 * Delete from Cache
	 *
	 * @param 	mixed		unique identifier of the item in the cache
	 * @param 	boolean		TRUE, simulating success
	 */
	public function delete($id)
	{
		return TRUE;
	}

	// ------------------------------------------------------------------------

	/**
	 * Clean the cache
	 *
	 * @return 	boolean		TRUE, simulating success
	 */
	public function clean()
	{
		return TRUE;
	}

	// ------------------------------------------------------------------------

	/**
	 * Cache Info
	 *
	 * @param 	string		user/filehits
	 * @return 	boolean		FALSE
	 */
	 public function cache_info($type = NULL)
	 {
		 return FALSE;
	 }

	// ------------------------------------------------------------------------

	/**
	 * Get Cache Metadata
	 *
	 * @param 	mixed		key to get cache metadata on
	 * @return 	boolean		FALSE
	 */
	public function get_metadata($id)
	{
		return FALSE;
	}

	// ------------------------------------------------------------------------

	/**
	 * Is this caching driver supported on the system?
	 * Of course this one is.
	 *
	 * @return TRUE;
	 */
	public function is_supported()
	{
		return TRUE;
	}

	// ------------------------------------------------------------------------

}
// End Class

/* End of file Cache_dummy.php */
/* Location: ./system/libraries/Cache/drivers/Cache_dummy.php */