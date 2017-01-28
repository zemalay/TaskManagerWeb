<?php

/**
 * Representa objeto do tipo User
 *
 * @version 0.6
 * @access public
 * @package model
 * @author Douglas Rafael
 */
class User {
	private $id;
	private $name;
	private $email;
	private $password;
	private $avatar;
	private $registrationDate;
	
	/**
	 * Construtor
	 *
	 * @access public
	 *        
	 * @param string $name        	
	 * @param string $email        	
	 * @param string $password        	
	 * @param string $avatar        	
	 * @param string $registrationDate        	
	 */
	public function __construct($name = null, $email = null, $password = null, $avatar = null, $registrationDate = null) {
		$this->name = $name === null ? $this->name : $name;
		$this->email = $email === null ? $this->email : $email;
		$this->password = $password === null ? $this->password : password_hash ( $password, PASSWORD_DEFAULT );
		$this->avatar = $avatar === null ? $this->avatar : $avatar;
		$this->registrationDate = $registrationDate === null ? $this->registrationDate : $registrationDate;
	}
	
	/**
	 * 
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * 
	 * @param int $id
	 */
	public function setId($id) {
		$this->id = $id;
	}
	
	/**
	 * 
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	 * 
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
	}
	
	/**
	 * 
	 * @return string
	 */
	public function getEmail() {
		return $this->email;
	}
	
	/**
	 * 
	 * @param string $email
	 */
	public function setEmail($email) {
		$this->email = $email;
	}
	
	/**
	 * 
	 * @return string
	 */
	public function getPassword() {
		return $this->password;
	}
	
	/**
	 * 
	 * @param string $password
	 */
	public function setPassword($password) {
		$this->password = password_hash ( $password, PASSWORD_DEFAULT );
	}
	
	/**
	 * 
	 * @return string
	 */
	public function getAvatar() {
		return $this->avatar;
	}
	
	/**
	 * 
	 * @param string $avatar
	 */
	public function setAvatar($avatar) {
		$this->avatar = $avatar;
	}
	
	/**
	 * 
	 * @return string
	 */
	public function getRegistrationDate() {
		return $this->registrationDate;
	}
	
	/**
	 * 
	 * @param string $registrationDate
	 */
	public function setRegistrationDate($registrationDate) {
		$this->registrationDate = $registrationDate;
	}
}