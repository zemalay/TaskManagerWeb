<?php
include_once '/DAO.php';

/**
 * Contém operações de banco de dados referente ao objeto do tipo Task
 *
 * @version 1.6
 * @access public
 * @package model
 * @author Douglas Rafael
 */
class TaskDAO extends DAO {
	
	/**
	 * Construtor
	 *
	 * @access public
	 */
	public function __construct() {
		parent::__construct ();
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 * @see DAO::get()
	 */
	public function get($id) {
		$conn = parent::connect ();
		
		try {
			$statement = $conn->prepare ( 'SELECT * FROM task WHERE id=:id;' );
			$statement->bindParam ( ":id", $id );
			$statement->execute ();
			
			return $statement->fetchObject ( Task::class );
		} catch ( PDOException $e ) {
			throw new DAOException ( $e->getMessage (), null, $e );
		} finally {
			$conn = null;
			$statement->closeCursor ();
		}
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 * @see DAO::delete()
	 */
	public function delete($id) {
		$conn = parent::connect ();
		try {
			$statement = $conn->prepare ( 'DELETE FROM task WHERE id=:id;' );
			$statement->bindParam ( ":id", $id );
			$statement->execute ();
			
			if ($statement->rowCount () > 0) {
				return true;
			}
			return false;
		} catch ( PDOException $e ) {
			throw new DAOException ( $e->getMessage (), null, $e );
		} finally {
			$conn = null;
			$statement->closeCursor ();
		}
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 * @see DAO::insert()
	 */
	public function insert($task) {
		$conn = parent::connect ();
		
		try {
			$statement = $conn->prepare ( 'INSERT INTO task (title, description, priority, labels, registrationDate, completionDate, noticeDate) 
					VALUES (:title, :description, :priority, :labels, CURRENT_TIMESTAMP, :completion_date, :notice_date);' );
			$statement->bindValue ( ":title", $task->getTitle () );
			$statement->bindValue ( ":description", $task->getDescription () );
			$statement->bindValue ( ":priority", $task->getPriority () );
			$statement->bindValue ( ":labels", $task->getLabels () );
			$statement->bindValue ( ":completion_date", $task->getCompletionDate () );
			$statement->bindValue ( ":notice_date", $task->getNoticeDate () );
			
			$statement->execute ();
			if ($statement->rowCount () > 0) {
				return true;
			}
			return false;
		} catch ( PDOException $e ) {
			throw new DAOException ( $e->getMessage (), null, $e );
		} finally {
			$conn = null;
			$statement->closeCursor ();
		}
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 * @see DAO::listAll()
	 */
	public function listAll($start = 0, $limit = 100, $fieldOrder = "id", $order = "DESC") {
		$conn = parent::connect ();
		$result = array ();
		
		try {
			$statement = $conn->prepare ( "SELECT * FROM task ORDER BY {$fieldOrder} {$order} LIMIT :limit OFFSET :offset;" );
			$statement->bindParam ( ':limit', $limit, PDO::PARAM_INT );
			$statement->bindParam ( ':offset', $start, PDO::PARAM_INT );
			
			$statement->execute ();
			
			while ( $task = $statement->fetchObject ( Task::class ) ) {
				array_push ( $result, $task );
			}
		} catch ( PDOException $e ) {
			throw new DAOException ( $e->getMessage (), null, $e );
		} finally {
			$conn = null;
			$statement->closeCursor ();
		}
		return $result;
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 * @see DAO::search()
	 */
	public function search($term, $start = 0, $limit = 100, $fieldOrder = "id", $order = "DESC") {
		$conn = parent::connect ();
		$result = [ ];
		
		try {
			$statement = $conn->prepare ( "SELECT * FROM task WHERE title LIKE :term OR labels LIKE :term 
					ORDER BY {$fieldOrder} {$order} LIMIT :limit OFFSET :offset;" );
			$statement->bindValue ( ':term', '%' . $term . '%' );
			$statement->bindValue ( ':limit', $limit, PDO::PARAM_INT );
			$statement->bindValue ( ':offset', $start, PDO::PARAM_INT );
			
			$statement->execute ();
			
			while ( $task = $statement->fetchObject ( Task::class ) ) {
				array_push ( $result, $task );
			}
		} catch ( PDOException $e ) {
			throw new DAOException ( $e->getMessage (), null, $e );
		} finally {
			$conn = null;
			$statement->closeCursor ();
		}
		return $result;
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 * @see DAO::update()
	 */
	public function update($task) {
		$conn = parent::connect ();
		
		try {
			$statement = $conn->prepare ( 'UPDATE task SET title=:title, description=:description, priority=:priority, 
					labels=:labels, completionDate=:completionDate, noticeDate=:noticeDate WHERE id=:id;' );
			$statement->bindValue ( ":title", $task->getTitle () );
			$statement->bindValue ( ":description", $task->getDescription () );
			$statement->bindValue ( ":priority", $task->getPriority () );
			$statement->bindValue ( ":labels", $task->getLabels () );
			$statement->bindValue ( ":completion_date", $task->getCompletionDate () );
			$statement->bindValue ( ":notice_date", $task->getNoticeDate () );
			$statement->bindValue ( ":id", $task->getId () );
			
			$statement->execute ();
			if ($statement->rowCount () > 0) {
				return true;
			}
			return false;
		} catch ( PDOException $e ) {
			throw new DAOException ( $e->getMessage (), null, $e );
		} finally {
			$conn = null;
			$statement->closeCursor ();
		}
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 * @see DAO::count()
	 */
	public function count() {
		$conn = parent::connect ();
		
		try {
			$result = $conn->query ( 'SELECT COUNT(*) FROM task;' );
			return ( int ) $result->fetchColumn ( 0 );
		} catch ( PDOException $e ) {
			throw new DAOException ( $e->getMessage (), null, $e );
		} finally {
			$conn = null;
		}
	}
	
	/**
	 * Retorna todas labels que foram cadastradas.
	 *
	 * @return array
	 * @throws DAOException
	 */
	public function getAllLabels() {
		$conn = parent::connect ();
		$result = [ ];
		
		try {
			$statement = $conn->prepare ( 'SELECT labels FROM task;' );
			$statement->execute ();
			
			while ( $row = $statement->fetchColumn () ) {
				$labels = explode ( ',', $row );
				
				foreach ( $labels as $label ) {
					if (! in_array ( trim ( $label ), $result ))
						array_push ( $result, trim ( $label ) );
				}
			}
		} catch ( PDOException $e ) {
			throw new DAOException ( $e->getMessage (), null, $e );
		} finally {
			$conn = null;
			$statement->closeCursor ();
		}
		return $result;
	}
	
	/**
	 * Atualiza uma task como finalizada.
	 *
	 * @param int $id
	 * 
	 * @throws DAOException
	 * @return boolean
	 */
	public function taskFinalized($id) {
		$conn = parent::connect ();
		
		try {
			$statement = $conn->prepare ( 'UPDATE task SET isFinalized=1 WHERE id=:id;' );
			$statement->bindValue ( ":id", $task->getId () );
			
			$statement->execute ();
			if ($statement->rowCount () > 0) {
				return true;
			}
			return false;
		} catch ( PDOException $e ) {
			throw new DAOException ( $e->getMessage (), null, $e );
		} finally {
			$conn = null;
			$statement->closeCursor ();
		}
	}
}