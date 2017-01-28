<?php

/**
 * Representa exceção geral do sistema Task Manager.
 * Outros tipos de exceção contidas no sistema deverão a estender.
 *
 * @version 1.1
 * @access public
 * @package exception
 * @author Douglas Rafael
 */
class TaskManagerException extends Exception {
	
	/**
	 * Contrutor
	 *
	 * @access public
	 *        
	 * @param string $message        	
	 * @param int $code        	
	 * @param Exception $previous        	
	 */
	public function __construct($message, $code = null, Exception $previous = null) {
		parent::__construct ( $message, $code, $previous );
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 * @see Exception::__toString()
	 */
	public function __toString() {
		return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
	}
	
	/**
	 * Exibe mensagem personalizada que pode ser de:
	 * Sucesso, aviso, informação, ou perigo;
	 *
	 * @access public
	 *        
	 * @param string $message        	
	 * @param string $type - O tipo de mensagem a ser exibida: info, warning, danger ou success (valor default)
	 */
	public function printMessage($message = null, $type = "success") {
		switch ($type) {
			case 'info' :
				$type = 'alert-info';
				break;
			case 'warning' :
				$type = 'alert-warning';
				break;
			case 'danger' :
				$type = 'alert-danger';
				break;
			default :
				$type = 'alert-success';
				break;
		}
		echo "<div class='alert {$type}' role='alert'>" . (($message == NULL) ? $this->message : $message) . '</div>';
	}
	
	/**
	 * Exibe mensagem de sucesso.
	 *
	 * @access public
	 *        
	 * @param string $message        	
	 */
	public function printMessageSuccess($message = null) {
		$this->printMessage ( $message, 'success' );
	}
	
	/**
	 * Exibe mensagem de informação.
	 *
	 * @access public
	 *        
	 * @param string $message        	
	 */
	public function printMessageInfo($message = null) {
		$this->printMessage ( $message, 'info' );
	}
	
	/**
	 * Exibe mensagem de aviso.
	 *
	 * @access public
	 *        
	 * @param string $message        	
	 */
	public function printMessageWarning($message = null) {
		$this->printMessage ( $message, 'warning' );
	}
	
	/**
	 * Exibe mensagem de perigo.
	 *
	 * @access public
	 *        
	 * @param string $message        	
	 */
	public function printMessageDanger($message = null) {
		$this->printMessage ( $message, 'danger' );
	}
}