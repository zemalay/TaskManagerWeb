<?php
include_once '/TaskManagerException.php';

/**
 * Representa exceção do tipo Validation
 *
 * @version 1.0
 * @access public
 * @package exception
 * @author Douglas Rafael
 */
class DAOException extends TaskManagerException {
	
	/**
	 * Contrutor
	 *
	 * @param string $message        	
	 * @param int $code        	
	 * @param Exception $previous        	
	 */
	public function __construct($message, $code = 0, Exception $previous = null) {
		parent::__construct ( $message, $code, $previous );
	}
}