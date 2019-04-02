<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 30/01/19
 * Time: 11:41
 */

namespace entities;

/**
 * @Entity
 * @Table(name="orcamento")
 */
class Orcamento {

    /**
     * @Id
     * @GeneratedValue()
     * @Column(type="bigint")
     */
    private $id;
    /**
     * @OneToOne(targetEntity="Arquivo",cascade={"persist", "remove"})
     * @JoinColumn(name="arquivo",referencedColumnName="id")
     * @var Arquivo
     */
    private $arquivo;
    /**
     * @Column(type="decimal")
     */
    private $valor;
    /**
     * @Column(name="dthr_criacao",type="datetime")
     */
    private $dthrCriacao;
    /**
     * @Column(name="dthr_modificacao",type="datetime")
     */
    private $dthrModificacao;
    /**
     * @ManyToOne(targetEntity="Compra", inversedBy="orcamentos", fetch="LAZY")
     * @JoinColumn(name="compra",referencedColumnName="id", nullable=false)
     */
    private $compra;
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
     * Set valor.
     *
     * @param int $valor
     *
     * @return Orcamento
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }
    /**
     * Get valor.
     *
     * @return int
     */
    public function getValor()
    {
        return $this->valor;
    }
    /**
     * Set dthrCriacao.
     *
     * @param \DateTime $dthrCriacao
     *
     * @return Orcamento
     */
    public function setDthrCriacao($dthrCriacao)
    {
        $this->dthrCriacao = $dthrCriacao;

        return $this;
    }
    /**
     * Get dthrCriacao.
     *
     * @return \DateTime
     */
    public function getDthrCriacao() {
        return $this->dthrCriacao;
    }
    /**
     * Set dthrModificacao.
     *
     * @param \DateTime $dthrModificacao
     *
     * @return Orcamento
     */
    public function setDthrModificacao($dthrModificacao)
    {
        $this->dthrModificacao = $dthrModificacao;

        return $this;
    }
    /**
     * Get dthrModificacao.
     *
     * @return \DateTime
     */
    public function getDthrModificacao()
    {
        return $this->dthrModificacao;
    }
    /**
     * Set arquivo.
     *
     * @param \entities\Arquivo|null $arquivo
     *
     * @return Orcamento
     */
    public function setArquivo(\entities\Arquivo $arquivo = null)
    {
        $this->arquivo = $arquivo;

        return $this;
    }
    /**
     * Get arquivo.
     *
     * @return \entities\Arquivo|null
     */
    public function getArquivo() {
        return $this->arquivo;
    }

    public function asJSON() {
        return json_encode([
            "id"=>$this->id,
            "arquivo"=> isset($this->arquivo) ? $this->arquivo->asJSON() : "null",
            "valor"=>$this->valor,
            "dthrCriacao"=>$this->dthrCriacao,
            "dthrModificacao"=>$this->dthrModificacao
        ]);
    }

    /**
     * Set compra.
     *
     * @param \entities\Compra $compra
     *
     * @return Orcamento
     */
    public function setCompra(\entities\Compra $compra)
    {
        $this->compra = $compra;

        return $this;
    }

    /**
     * Get compra.
     *
     * @return \entities\Compra
     */
    public function getCompra()
    {
        return $this->compra;
    }
}
