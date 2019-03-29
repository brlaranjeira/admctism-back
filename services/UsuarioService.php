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
		$grupo = $entity_manager->find('\entities\Usuario',$id);
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

}