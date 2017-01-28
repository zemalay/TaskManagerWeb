<?php
include_once '/Database.php';
include_once __ROOT__ . '/exception/DAOException.php';

/**
 * Contém assinaturas dos métodos que deverão ser implementados pelas classes que a estender.
 *
 * @version 1.0
 * @access abstract
 * @package model
 * @author Douglas Rafael
 */
abstract class DAO extends Database {
	
	/**
	 * Construtor
	 *
	 * @access public
	 */
	public function __construct() {
		parent::__construct ();
	}
	
	/**
	 * Lista objetos de acordo com os parâmetros.
	 *
	 * @access public
	 *        
	 * @param int $start
	 *        	- Sinaliza onde o cursor da busca deve inicar
	 * @param number $limit
	 *        	- Limita o total de objetos que deverão ser retornados
	 * @param string $fieldOrder
	 *        	- Campo que será usado na ordenação
	 * @param string $order
	 *        	- DESC ou ASC
	 *        	
	 * @throws DAOException
	 */
	abstract public function listAll($start = 0, $limit = 100, $fieldOrder = "id", $order = "DESC");
	
	/**
	 * Seleciona objeto de acordo com o id passado como parâmetro.
	 *
	 * @access public
	 *        
	 * @param int $obj        	
	 *
	 * @throws DAOException
	 * @return object
	 */
	abstract public function get($id);
	
	/**
	 * Insere objeto no banco
	 *
	 * @access public
	 *        
	 * @param object $obj        	
	 *
	 * @throws DAOException
	 * @return boolean
	 */
	abstract public function insert($obj);
	
	/**
	 * Atualiza dados do objeto no banco.
	 *
	 * @access public
	 *        
	 * @param object $obj        	
	 *
	 * @throws DAOException
	 * @return boolean
	 */
	abstract public function update($obj);
	
	/**
	 * Remove objeto do banco de acordo com o id passado como parâmetro
	 *
	 * @access public
	 *        
	 * @param int $id        	
	 *
	 * @throws DAOException
	 * @return boolean
	 */
	abstract public function delete($id);
	
	/**
	 * Busca por objetos no banco e retorna um array com os objetos encontrados de acordo com o termo buscado e parâmetros.
	 *
	 * @access public
	 *        
	 * @param string $term        	
	 * @param int $start        	
	 * @param int $limit        	
	 * @param string $fieldOrder - Campo que será usado na ordenação
	 * @param string $order        	
	 *
	 * @throws DAOException
	 */
	abstract public function search($term, $start = 0, $limit = 100, $fieldOrder = "id", $order = "DESC");
	
	/**
	 * Retorna o total de registros contidos no banco
	 *
	 * @access public
	 *        
	 * @throws DAOException
	 * @return int
	 */
	abstract public function count();
}