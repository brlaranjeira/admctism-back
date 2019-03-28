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

	static function getById($id) {
		require __DIR__ . "/../bootstrap.php";
		if ($id === null) {
			return null;
		}
		$grupo = $entity_manager->find('\entities\Usuario',$id);
		return $grupo;
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