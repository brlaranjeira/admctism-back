<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 30/01/19
 * Time: 12:08
 */

namespace entities;

/**
 * @Entity
 * @Table(name="compra")
 */
class Compra {

    /**
     * @Id
     * @GeneratedValue
     * @Column(type="bigint")
     */
    private $id;

    /**
     * @Column(type="boolean",name="despesa_recorrente")
     */
    private $despesaRecorrente;
    /**
     * @Column(type="string",name="cod_projeto")
     */
    private $codProjeto;
    /**
     * @Column(type="string")
     */
    private $justificativa;
    /**
     * @Column(type="string")
     */
    private $obs;
    /**
     * @Column(type="string")
     */
    private $descricao;
    /**
     * @Column(type="integer")
     */
    private $quantidade;
    /**
     * @Column(type="string")
     */
    private $modelo;
    /**
     * @Column(type="string")
     */
    private $usuario;
    /**
     * @ManyToOne(targetEntity="EstadoCompra")
     * @JoinColumn(name="estado",referencedColumnName="id",nullable=false)
     */
    private $estado;
    /**
     * @ManyToOne(targetEntity="TipoDespesa")
     * @JoinColumn(name="tipo_despesa",referencedColumnName="id",nullable=false)
     */
    private $tipoDespesa;
    /**
     * @ManyToOne(targetEntity="TipoSolicitacao")
     * @JoinColumn(name="tipo_solicitacao",referencedColumnName="id",nullable=false)
     */
    private $tipoSolicitacao;
    /**
     * @OneToOne(targetEntity="Arquivo",cascade={"all"})
     * @JoinColumn(name="outroarq",referencedColumnName="id",nullable=true)
     */
    private $arquivo;

    /**
     * @Column(name="dthr_criacao",type="datetime")
     * @var DateTime
     */
    private $dthrCriacao;


    /**
     * @OneToMany(targetEntity="Orcamento", mappedBy="compra",cascade={"all"},fetch="EAGER")
     */
    private $orcamentos;


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
     * Set despesaRecorrente.
     *
     * @param bool $despesaRecorrente
     *
     * @return Compra
     */
    public function setDespesaRecorrente($despesaRecorrente)
    {
        $this->despesaRecorrente = $despesaRecorrente;

        return $this;
    }

    /**
     * Get despesaRecorrente.
     *
     * @return bool
     */
    public function getDespesaRecorrente()
    {
        return $this->despesaRecorrente;
    }

    /**
     * Set codProjeto.
     *
     * @param string $codProjeto
     *
     * @return Compra
     */
    public function setCodProjeto($codProjeto)
    {
        $this->codProjeto = $codProjeto;

        return $this;
    }

    /**
     * Get codProjeto.
     *
     * @return string
     *
    public function getCodProjeto()
    {
        return $this->codProjeto;
    }

    /**
     * Set justificativa.
     *
     * @param string $justificativa
     *
     * @return Compra
     */
    public function setJustificativa($justificativa)
    {
        $this->justificativa = $justificativa;

        return $this;
    }

    /**
     * Get justificativa.
     *
     * @return string
     */
    public function getJustificativa()
    {
        return $this->justificativa;
    }

    /**
     * Set obs.
     *
     * @param string $obs
     *
     * @return Compra
     */
    public function setObs($obs)
    {
        $this->obs = $obs;

        return $this;
    }

    /**
     * Get obs.
     *
     * @return string
     */
    public function getObs()
    {
        return $this->obs;
    }

    /**
     * Set descricao.
     *
     * @param string $descricao
     *
     * @return Compra
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

    /**
     * Set quantidade.
     *
     * @param int $quantidade
     *
     * @return Compra
     */
    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;

        return $this;
    }

    /**
     * Get quantidade.
     *
     * @return int
     */
    public function getQuantidade()
    {
        return $this->quantidade;
    }

    /**
     * Set usuario.
     *
     * @param string $usuario
     *
     * @return Compra
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario.
     *
     * @return string
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set estado.
     *
     * @param \entities\Estado $estado
     *
     * @return Compra
     */
    public function setEstado(\entities\EstadoCompra $estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado.
     *
     * @return \entities\Estado
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set tipoDespesa.
     *
     * @param \entities\TipoDespesa $tipoDespesa
     *
     * @return Compra
     */
    public function setTipoDespesa(\entities\TipoDespesa $tipoDespesa)
    {
        $this->tipoDespesa = $tipoDespesa;

        return $this;
    }

    /**
     * Get tipoDespesa.
     *
     * @return \entities\TipoDespesa
     */
    public function getTipoDespesa()
    {
        return $this->tipoDespesa;
    }


    /**
     * Set arquivo.
     *
     * @param \entities\Arquivo|null $arquivo
     *
     * @return Compra
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
    public function getArquivo()
    {
        return $this->arquivo;
    }

    /**
     * Set tipoSolicitacao.
     *
     * @param \entities\TipoSolicitacao $tipoSolicitacao
     *
     * @return Compra
     */
    public function setTipoSolicitacao(\entities\TipoSolicitacao $tipoSolicitacao)
    {
        $this->tipoSolicitacao = $tipoSolicitacao;

        return $this;
    }

    /**
     * Get tipoSolicitacao.
     *
     * @return \entities\TipoSolicitacao
     */
    public function getTipoSolicitacao()
    {
        return $this->tipoSolicitacao;
    }


    public function asJSON() {
        $usr = new \Usuario($this->usuario,true);

        return json_encode([
            "id" => $this->id,
            "despesaRecorrente" => $this->despesaRecorrente,
            "codProjeto" => $this->codProjeto,
            "justificativa" => $this->justificativa,
            "obs" => $this->obs,
            "descricao" => $this->descricao,
            "quantidade" => $this->quantidade,
            "modelo" => $this->modelo,
            "usuario" => $usr->asJSON(),
            "estado" => $this->estado->asJSON(),
            "tipoDespesa" => $this->tipoDespesa->asJSON(),
            "tipoSolicitacao" => $this->tipoSolicitacao->asJSON(),
            "arquivo"=> isset($this->arquivo) ? $this->arquivo->asJSON() : "null",
            "dthrCriacao" => $this->dthrCriacao,
            "orcamentos" => '[' . implode(',',array_map(function ($o) {return $o->asJSON();},$this->orcamentos->getValues())) . ']'
        ]);
    }



    /**
     * Set dthrCriacao.
     *
     * @param \DateTime $dthrCriacao
     *
     * @return Compra
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
    public function getDthrCriacao()
    {
        return $this->dthrCriacao;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->orcamentos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add orcamento.
     *
     * @param \entities\Orcamento $orcamento
     *
     * @return Compra
     */
    public function addOrcamento(\entities\Orcamento $orcamento)
    {
        $this->orcamentos[] = $orcamento;

        return $this;
    }

    /**
     * Remove orcamento.
     *
     * @param \entities\Orcamento $orcamento
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeOrcamento(\entities\Orcamento $orcamento)
    {
        return $this->orcamentos->removeElement($orcamento);
    }

    /**
     * Get orcamentos.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrcamentos()
    {
        return $this->orcamentos;
    }

    /**
     * Get codProjeto.
     *
     * @return string
     */
    public function getCodProjeto()
    {
        return $this->codProjeto;
    }

    /**
     * Set modelo.
     *
     * @param string $modelo
     *
     * @return Compra
     */
    public function setModelo($modelo)
    {
        $this->modelo = $modelo;

        return $this;
    }

    /**
     * Get modelo.
     *
     * @return string
     */
    public function getModelo()
    {
        return $this->modelo;
    }
}
