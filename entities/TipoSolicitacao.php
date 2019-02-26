<?php

namespace entities;

/**
 * @Entity
 * @Table(name="tipo_solicitacao")
 */
class TipoSolicitacao {

	/**
	 * @Id
	 * @GeneratedValue
	 * @Column(type="bigint")
	 */
	private $id;

	/**
	 * @Column(type="string")
	 */
	private $descricao;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set descricao.
     *
     * @param string $descricao
     *
     * @return TipoSolicitacao
     */
    public function setDescricao($descricao) {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao.
     *
     * @return string
     */
    public function getDescricao() {
        return $this->descricao;
    }

    public function asJSON() {
        return json_encode(["id"=>$this->id,"descricao"=>$this->descricao]);
    }
}
