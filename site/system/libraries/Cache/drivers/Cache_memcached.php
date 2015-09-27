<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2015, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 2.0
 * @filesource
 */
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

/**
 * CodeIgniter Memcached Caching Class
 *
 * @package CodeIgniter
 * @subpackage Libraries
 * @category Core
 * @author EllisLab Dev Team
 * @link
 *
 */
class CI_Cache_memcached extends CI_Driver {
	
	/**
	 * Holds the memcached object
	 *
	 * @var object
	 */
	protected $_memcached;
	
	/**
	 * Memcached configuration
	 *
	 * @var array
	 */
	protected $_memcache_conf = array (
			'default' => array (
					'host' => '127.0.0.1',
					'port' => 11211,
					'weight' => 1 
			) 
	);

	/**
	 * Fetch from cache
	 *
	 * @param string $id        	
	 * @return mixed on success, FALSE on failure
	 */
	public function get($id) {
		$data = $this->_memcached->get ( $id );
		
		return is_array ( $data ) ? $data [0] : $data;
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Save
	 *
	 * @param string $id        	
	 * @param mixed $data
	 *        	cached
	 * @param int $ttl
	 *        	live
	 * @param bool $raw
	 *        	store the raw value
	 * @return bool on success, FALSE on failure
	 */
	public function save($id, $data, $ttl = 60, $raw = FALSE) {
		if ($raw !== TRUE) {
			$data = array (
					$data,
					time (),
					$ttl 
			);
		}
		
		if (get_class ( $this->_memcached ) === 'Memcached') {
			return $this->_memcached->set ( $id, $data, $ttl );
		} elseif (get_class ( $this->_memcached ) === 'Memcache') {
			return $this->_memcached->set ( $id, $data, 0, $ttl );
		}
		
		return FALSE;
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Delete from Cache
	 *
	 * @param
	 *        	mixed key to be deleted.
	 * @return bool on success, false on failure
	 */
	public function delete($id) {
		return $this->_memcached->delete ( $id );
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Increment a raw value
	 *
	 * @param string $id        	
	 * @param int $offset
	 *        	add
	 * @return mixed value on success or FALSE on failure
	 */
	public function increment($id, $offset = 1) {
		return $this->_memcached->increment ( $id, $offset );
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Decrement a raw value
	 *
	 * @param string $id        	
	 * @param int $offset
	 *        	reduce by
	 * @return mixed value on success or FALSE on failure
	 */
	public function decrement($id, $offset = 1) {
		return $this->_memcached->decrement ( $id, $offset );
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Clean the Cache
	 *
	 * @return bool on failure/true on success
	 */
	public function clean() {
		return $this->_memcached->flush ();
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Cache Info
	 *
	 * @return mixed on success, false on failure
	 */
	public function cache_info() {
		return $this->_memcached->getStats ();
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Get Cache Metadata
	 *
	 * @param
	 *        	mixed key to get cache metadata on
	 * @return mixed on failure, array on success.
	 */
	public function get_metadata($id) {
		$stored = $this->_memcached->get ( $id );
		
		if (count ( $stored ) !== 3) {
			return FALSE;
		}
		
		list ( $data, $time, $ttl ) = $stored;
		
		return array (
				'expire' => $time + $ttl,
				'mtime' => $time,
				'data' => $data 
		);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Setup memcached.
	 *
	 * @return bool
	 */
	protected function _setup_memcached() {
		// Try to load memcached server info from the config file.
		$CI = & get_instance ();
		$defaults = $this->_memcache_conf ['default'];
		
		if ($CI->config->load ( 'memcached', TRUE, TRUE )) {
			if (is_array ( $CI->config->config ['memcached'] )) {
				$this->_memcache_conf = array ();
				
				foreach ( $CI->config->config ['memcached'] as $name => $conf ) {
					$this->_memcache_conf [$name] = $conf;
				}
			}
		}
		
		if (class_exists ( 'Memcached', FALSE )) {
			$this->_memcached = new Memcached ();
		} elseif (class_exists ( 'Memcache', FALSE )) {
			$this->_memcached = new Memcache ();
		} else {
			log_message ( 'error', 'Failed to create object for Memcached Cache; extension not loaded?' );
			return FALSE;
		}
		
		foreach ( $this->_memcache_conf as $cache_server ) {
			isset ( $cache_server ['hostname'] ) or $cache_server ['hostname'] = $defaults ['host'];
			isset ( $cache_server ['port'] ) or $cache_server ['port'] = $defaults ['port'];
			isset ( $cache_server ['weight'] ) or $cache_server ['weight'] = $defaults ['weight'];
			
			if (get_class ( $this->_memcached ) === 'Memcache') {
				// Third parameter is persistance and defaults to TRUE.
				$this->_memcached->addServer ( $cache_server ['hostname'], $cache_server ['port'], TRUE, $cache_server ['weight'] );
			} else {
				$this->_memcached->addServer ( $cache_server ['hostname'], $cache_server ['port'], $cache_server ['weight'] );
			}
		}
		
		return TRUE;
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Is supported
	 *
	 * Returns FALSE if memcached is not supported on the system.
	 * If it is, we setup the memcached object & return TRUE
	 *
	 * @return bool
	 */
	public function is_supported() {
		if (! extension_loaded ( 'memcached' ) && ! extension_loaded ( 'memcache' )) {
			log_message ( 'debug', 'The Memcached Extension must be loaded to use Memcached Cache.' );
			return FALSE;
		}
		
		return $this->_setup_memcached ();
	}
}
