<?php
define ( '__ROOT__', dirname ( dirname ( __FILE__ ) ) );
define ( '__CONFIG_FILE__', __ROOT__ . '/config.ini' );

/**
 * Classe para conexão com o banco de dados
 *
 * @version 1.5
 * @access public
 * @package model
 * @author Douglas Rafael
 */
class Database {
	const DUPLICATE_ENTRY = 1062;
	const ENTRY_NULL = 1048;
	
	protected $conn;
	
	/**
	 * Contrutor
	 *
	 * @access public
	 */
	public function __construct() {
	}
	
	/**
	 * Destrutor.
	 * Chamado sempre que a instância do objeto é encerrada.
	 *
	 * @access public
	 */
	public function __destruct() {
		$this->disconnect ();
	}
	
	/**
	 * Efetua conexao com o banco de dados.
	 *
	 * @access protected
	 *        
	 * @return PDO
	 */
	protected function connect() {
		try {
			if (file_exists ( __CONFIG_FILE__ )) {
				$db = parse_ini_file ( __CONFIG_FILE__ );
			} else {
				throw new Exception ( "Arquivo de configução do BD não encontrado!" );
			}
			$nada = $db ['user'];
			
			$user = $db ['user'];
			$pass = $db ['pass'];
			$name = $db ['name'];
			$host = $db ['host'];
			$type = $db ['type'];
			$port = $db ['port'];
			
			switch ($type) {
				case 'mysql' :
					$this->conn = new PDO ( "{$type}:host={$host};port={$port};dbname={$name}", $user, $pass );
					break;
				case 'pgsql' :
					$this->conn = new PDO ( "pgsql:dbname={$name};user={$user};password={$pass};host={$host}" );
				case 'sqlite' :
					$this->conn = new PDO ( "sqlite:{$name}" );
					break;
				default :
					break;
			}
			$this->conn->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		} catch ( PDOException $e ) {
			// Se houver erro
			die ( "Erro: <code>" . $e->getMessage () . "</code>" );
		}
		
		return $this->conn;
	}
	
	/**
	 * Exibe o SQL a ser preparado antes de tentar executar no banco
	 *
	 * @access protected
	 *        
	 * @param PDOStatement $stm        	
	 * @return string
	 */
	protected function debugSQL($stm) {
		return $stm->debugDumpParams ();
	}
	
	/**
	 * Desconecta do banco de dados
	 *
	 * @access protected
	 */
	protected function disconnect() {
		$this->conn = null;
	}
}
