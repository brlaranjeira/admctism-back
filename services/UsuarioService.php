<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 25/03/19
 * Time: 13:15
 */

namespace services;


class UsuarioService {

	static function getAll() {
		require __DIR__ . "/../bootstrap.php";
		$usuarios = $entity_manager->getRepository('\entities\Usuario')
			->findAll();
		return $usuarios;
	}

	static function getByLogin($login) {
		require __DIR__ . "/../bootstrap.php";
		if ($login === null) {
			return null;
		}
		$usuario = $entity_manager->getRepository('\entities\Usuario')
			->findOneBy(array('login'=>$login));
		return $usuario;
	}

	static function getById($id) {
		require __DIR__ . "/../bootstrap.php";
		if ($id === null) {
			return null;
		}
		$usuario = \Utils::getEntityManager()->find('\entities\Usuario',$id);
		return $usuario;
	}

	public static function changeGrupo($userId, $grupo) {
		require __DIR__ . "/../bootstrap.php";
		$usuario = self::getById($userId);
		$grupo = \services\GrupoService::getById($grupo);
		$usuario->setGrupo($grupo);
		$entity_manager->merge($usuario);
		$entity_manager->flush();
	}

	private static function getJWTKey() {
		return file_get_contents($GLOBALS['JWT_KEY']);
	}

	public static function getFromJWT($jwt) {
		require __DIR__ . "/../bootstrap.php";
		if (!isset($jwt) || empty($jwt)) {
			return null;
		}
		try {
			$usr = \Firebase\JWT\JWT::decode($jwt, self::getJWTKey(), ['HS256']);
			return self::getById($usr->id);
		} catch (Throwable $t) {
			echo $t->getTraceAsString();
			return null;
		}
	}

	public static function getJWT($id) {
		require __DIR__.'/../bootstrap.php';
		$usr = self::getById($id);
		$arr = [
			"iss" => 'intranet.ctism.ufsm.br',
			"id" => $id,
			"username"=>$usr->getLogin(),
			"idnumber" =>$usr->getUidnumber(),
			"email" =>$usr->getEmail(),
			"grupo" => $usr->getGrupo()->asJSON(),
			"fullname"=> $usr->getNome(),
			"curso" =>$usr->getCurso(),
			"exp" => time() + 3600
		];
		return \Firebase\JWT\JWT::encode($arr,self::getJWTKey());
	}

	public static function auth($userName, $password) {
		require_once (__DIR__ . '/../lib/ldap.php');
		$ldap = new \ldap();
		if ($ldap->auth($userName,$password)) {
			return true;
		}
		return false;
	}

}