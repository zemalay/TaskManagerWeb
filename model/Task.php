<?php

/**
 * Representa objeto do tipo Task
 * 
 * @version 1.1
 * @access public
 * @package model 
 * @author Douglas Rafael
 */
class Task {
	private $id;
	private $title;
	private $description;
	private $priority;
	private $labels;
	private $registrationDate;
	private $completionDate;
	private $noticeDate;
	private $isFinalized;
	private $user_id;
	
	/**
	 *
	 * @param unknown $title        	
	 * @param unknown $description        	
	 * @param unknown $priority        	
	 * @param unknown $labels        	
	 * @param unknown $registrationDate        	
	 * @param unknown $completionDate        	
	 * @param unknown $noticeDate        	
	 * @param unknown $isFinalized        	
	 * @param unknown $user_id        	
	 */
	public function __construct($title = null, $description = null, $priority = null, $labels = null,
			$registrationDate = null, $completionDate = null, $noticeDate = null, $isFinalized = null, $user_id = null) {
		$this->title = $title === null ? $this->title : $title;
		$this->description = $description === null ? $this->description : $description;
		$this->priority = $priority === null ? $this->priority : $priority;
		$this->labels = $labels === null ? $this->labels : $labels;
		$this->registrationDate = $registrationDate === null ? $this->registrationDate : $registrationDate;
		$this->completionDate = $completionDate === null ? $this->completionDate : $completionDate;
		$this->noticeDate = $noticeDate === null ? $this->noticeDate : $noticeDate;
		$this->isFinalized = $isFinalized === null ? $this->isFinalized : $isFinalized;
		$this->user_id = $user_id === null ? $this->user_id : $user_id;
	}
	
	/**
	 * 
	 * @return unknown
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * 
	 * @param unknown $id
	 */
	public function setId($id) {
		$this->id = $id;
	}
	
	/**
	 * 
	 * @return unknown
	 */
	public function getTitle() {
		return $this->title;
	}
	
	/**
	 * 
	 * @param unknown $title
	 */
	public function setTitle($title) {
		$this->title = $title;
	}
	
	/**
	 * 
	 * @return unknown
	 */
	public function getDescription() {
		return $this->description;
	}
	
	/**
	 * 
	 * @param string $description
	 */
	public function setDescription($description) {
		$this->description = $description;
	}
	
	/**
	 * 
	 * @return unknown
	 */
	public function getPriority() {
		return $this->priority;
	}
	
	/**
	 * 
	 * @param unknown $priority
	 */
	public function setPriority($priority) {
		$this->priority = $priority;
	}
	
	/**
	 * 
	 * @return unknown
	 */
	public function getLabels() {
		return $this->labels;
	}
	
	/**
	 * 
	 * @param unknown $labels
	 */
	public function setLabels($labels) {
		$this->labels = $labels;
	}
	
	/**
	 * 
	 * @return unknown
	 */
	public function getRegistrationDate() {
		return $this->registrationDate;
	}
	
	/**
	 * 
	 * @param unknown $registrationDate
	 */
	public function setRegistrationDate($registrationDate) {
		$this->registrationDate = $registrationDate;
	}
	
	/**
	 * 
	 * @return unknown
	 */
	public function getCompletionDate() {
		return $this->completionDate;
	}
	
	/**
	 * 
	 * @param unknown $completionDate
	 */
	public function setCompletionDate($completionDate) {
		$this->completionDate = $completionDate;
	}
	
	/**
	 * 
	 * @return unknown
	 */
	public function getNoticeDate() {
		return $this->noticeDate;
	}
	
	/**
	 * 
	 * @param unknown $noticeDate
	 */
	public function setNoticeDate($noticeDate) {
		$this->noticeDate = $noticeDate;
	}
	
	/**
	 * 
	 * @return unknown
	 */
	public function isFinalized() {
		return $this->isFinalized;
	}
	
	/**
	 * 
	 * @param unknown $isFinalized
	 */
	public function setFinalized($isFinalized) {
		$this->isFinalized = $isFinalized;
	}
	
	/**
	 * 
	 * @return unknown
	 */
	public function getUser_id() {
		return $this->user_id;
	}
	
	/**
	 * 
	 * @param unknown $user_id
	 */
	public function setUser_id($user_id) {
		$this->user_id = $user_id;
	}
}