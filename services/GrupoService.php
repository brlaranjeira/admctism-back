<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 14/03/19
 * Time: 18:05
 */

namespace services;


class GrupoService {




	static function getGruposByParent( $parent=null ) {
		require __DIR__ . "/../bootstrap.php";
		$grupos = $entity_manager->getRepository('\entities\Grupo')
			->findBy(array('supergrupo' => $parent));
		return $grupos;
	}

	static function getById($id) {
		require __DIR__ . "/../bootstrap.php";
		if ($id === null) {
			return null;
		}
		$grupo = $entity_manager->find('\entities\Grupo',$id);
		return $grupo;
	}

	static function addGrupo( $name , $admin , $superGroup ) {
		require __DIR__ . "/../bootstrap.php";
		$group = new \entities\Grupo();
		$group->setNome($name);
		$group->setAdmin($admin);
		$group->setSuperGrupo($superGroup);
		$entity_manager->merge($group);
		$entity_manager->flush();
		return $group;
	}

	public static function updateGrupo($grupo) {
		require __DIR__ . "/../bootstrap.php";
		$entity_manager->merge($grupo);
		$entity_manager->flush();
		return $grupo;
	}

	public static function getGroupUsers($grupo) {
		require __DIR__ . "/../bootstrap.php";
		$usuarios = $entity_manager->getRepository('\entities\Usuario')
			->findBy(array('grupo'=>$grupo));
		return $usuarios;
	}

}