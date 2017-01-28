<?php
include_once '../model/Task.php';
include_once '../model/TaskDAO.php';
include_once '../model/UserDAO.php';
include_once '../model/User.php';

$task = new Task ();
$manager = new TaskDAO ();

var_dump(new User());
$dao = new UserDAO ();

var_dump($dao->login("admin@taskmanager.com", "26+9"));

// var_dump ( $dao->get ( 71 ) );
// var_dump($dao->count());
// var_dump($dao->delete(2));
$u = new User ( "Administrator I", "admins@taskmanager.com", "123456", "ava.nhp" );
try {
// 	$dao->insert ( $u );
	$user = $dao->get ( 51 );
	$user->setEmail("admin@taskmanager.com");
	$user->setName("ADMINISTRADOR");
	$user->setPassword("26+9");
	var_dump($dao->update($user));	
} catch ( DAOException $e ) {
	if ($e->getCode () == Database::DUPLICATE_ENTRY) {
		$e->printMessageWarning ( "OPS! Esse email já possui cadastro!" );
	}
	// echo $e->getCode();
}
