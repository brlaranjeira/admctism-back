<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 30/01/19
 * Time: 11:08
 */

namespace entities;

/**
 * @Entity
 * @Table(name="estado_compra")
 */
class EstadoCompra {

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
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set descricao.
     *
     * @param string $descricao
     *
     * @return EstadoCompra
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao.
     *
     * @return string
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    public function asJSON() {
        return json_encode(["id"=>$this->id,"descricao"=>$this->descricao]);
    }
}
