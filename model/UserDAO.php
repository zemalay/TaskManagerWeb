<?php
include_once '/DAO.php';

/**
 * Contém operações de banco de dados referente ao objeto do tipo User
 *
 * @version 1.1
 * @access public
 * @package model
 * @author Douglas Rafael
 */
class UserDAO extends DAO {
	
	/**
	 * Construtor
	 *
	 * @access public
	 */
	public function __construct() {
		parent::__construct ();
	}
	
	/**
	 * Autentica o usuário no sistema.
	 * Se o usuário existir o objeto User é retornado, caso contrário é retornado false.
	 *
	 * @param string $email        	
	 * @param string $password        	
	 * 
	 * @throws DAOException
	 * @return User $user Retorna o uusário logado ou false
	 */
	public function login($email, $password) {
		$conn = parent::connect ();
		
		try {
			$statement = $conn->prepare ( 'SELECT * FROM user WHERE email=:email LIMIT 1;' );
			$statement->bindParam ( ":email", $email );
			$statement->execute ();
			
			$user = $statement->fetchObject ( User::class );
			
			/**
			 * Verifcia se a consulta retornou o usuário com email igual ao passado como parâmtro.
			 * Verifica se a senha passada como pârametro é igual ao do usuário retornado na consulta.
			 *
			 * Se valido! é retornado o objeto User. Caso contrário, false.
			 */
			if ($user && password_verify ( $password, $user->getPassword () )) {
				return $this->get ( $user->getId () );
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
	 * @see DAO::get()
	 */
	public function get($id) {
		$conn = parent::connect ();
		
		try {
			$statement = $conn->prepare ( 'SELECT * FROM user WHERE id=:id;' );
			$statement->bindParam ( ":id", $id );
			$statement->execute ();
			
			return $statement->fetchObject ( User::class );
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
			$statement = $conn->prepare ( 'DELETE FROM user WHERE id=:id;' );
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
	public function insert($user) {
		$conn = parent::connect ();
		
		try {
			$statement = $conn->prepare ( 'INSERT INTO user (name, email, password, avatar, registrationDate) 
					VALUES (:name, :email, :password, :avatar, CURRENT_TIMESTAMP);' );
			$statement->bindValue ( ":name", $user->getName () );
			$statement->bindValue ( ":email", $user->getEmail () );
			$statement->bindValue ( ":password", $user->getPassword () );
			$statement->bindValue ( ":avatar", $user->getAvatar () );
			
			$statement->execute ();
			if ($statement->rowCount () > 0) {
				return true;
			}
			return false;
		} catch ( PDOException $e ) {
			throw new DAOException ( $e->getMessage (), $e->errorInfo[1], $e );
		} finally {
			$conn = null;
			$statement->closeCursor ();
		}
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 * @see DAO::update()
	 */
	public function update($user) {
		$conn = parent::connect ();
		
		try {
			if ($user->getPassword () == null) { // Não atualiza senha
				$statement = $conn->prepare ( 'UPDATE user SET name=:name, email=:email, avatar=:avatar WHERE id=:id;' );
			} else { // atualiza tudo
				$statement = $conn->prepare ( 'UPDATE user SET name=:name, email=:email, password=:password, avatar=:avatar WHERE id=:id;' );
				$statement->bindValue ( ":password", $user->getPassword () );
			}
			
			$statement->bindValue ( ":name", $user->getName () );
			$statement->bindValue ( ":email", $user->getEmail () );
			$statement->bindValue ( ":avatar", $user->getAvatar () );
			$statement->bindValue ( ":id", $user->getId () );
			
			$statement->execute ();
			if ($statement->rowCount () > 0) {
				return true;
			}
			return false;
		} catch ( PDOException $e ) {
			throw new DAOException ( $e->getMessage (), $e->errorInfo [1], $e );
		} finally {
			$conn = null;
			$statement->closeCursor ();
		}
	}
	
	/**
	 * Não há necessidade a implmentação
	 *
	 * {@inheritdoc}
	 *
	 * @see DAO::listAll()
	 */
	public function listAll($start = 0, $limit = 100, $fieldOrder = "id", $order = "DESC") {
	}
	
	/**
	 * Não há necessidade a implmentação
	 *
	 * {@inheritdoc}
	 *
	 * @see DAO::search()
	 */
	public function search($term, $start = 0, $limit = 100, $fieldOrder = "id", $order = "DESC") {
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
			$result = $conn->query ( 'SELECT COUNT(*) FROM user;' );
			return ( int ) $result->fetchColumn ( 0 );
		} catch ( PDOException $e ) {
			throw new DAOException ( $e->getMessage (), null, $e );
		} finally {
			$conn = null;
		}
	}
}