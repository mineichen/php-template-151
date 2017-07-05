<?php

namespace ihrname;

class Session {
	public function __construct() {
		session_start ();
	}
	public function get($key, $default=null) {
		if (!array_key_exists($key, $_SESSION)) {
			return $default;
		}
		return $_SESSION[$key];
	}
	public function set($key, $value) {
		$_SESSION[$key] = $value;
	}
	
	public function unset($key) {
		unset( $_SESSION [$key] );
	}
	
	public function regenerateId() {
		session_regenerate_id ();
	}
	
	/**
	 * Sets a Message into the Session which can be obtained just once
	 */
	public function addFlash($tag, $message) {
		if(array_key_exists($tag, $_SESSION)) {
			if(is_array($_SESSION[$tag])) {
				$tag[] = $message;
			} else {
				throw new \Exception(sprintf("Session already contains single value in key '%s'", $tag));
			}
		} else {
			$_SESSION[$tag] = [$message];
		}
	}
	
	/**
	 * Get and removes all Messages of a given Tag
	 */
	public function extractFlash($tag) {
		if(array_key_exists($tag, $_SESSION)) {
			if(is_array($_SESSION[$tag])) {
				$data = $_SESSION[$tag];
				unset($_SESSION[$tag]);
				return $data;
			} else {
				throw new \Exception(sprintf("Session doesn't contain Flash-Values in key '%s'", $tag));
			}
		} else {
			return [];
		}
	}
	
	/**
	 * Checks, if a key contains Flashmessages
	 */
	public function hasFlash($tag)
	{
		return array_key_exists($tag, $_SESSION)
			&& is_array($_SESSION[$tag]);
	}
}