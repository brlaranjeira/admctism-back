<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 14/03/19
 * Time: 17:44
 */

namespace entities;

/**
 * @Entity
 * @Table(name="grupo")
 */
class Grupo
{

	/**
	 * @Id
	 * @GeneratedValue
	 * @Column(type="bigint")
	 */
	private $id;

	/**
	 * @ManyToOne(targetEntity="Grupo", inversedBy="subgrupos")
	 * @JoinColumn(name="supergrupo",referencedColumnName="id", nullable=true)
	 */
	private $supergrupo;


	/**
	 * @OneToMany(targetEntity="Grupo", mappedBy="supergrupo",fetch="EAGER")
	 */
	private $subgrupos;


	/**
	 * @Column(type="boolean",name="admin")
	 */
	private $admin;

	/**
	 * @Column(type="string",name="nome")
	 */
	private $nome;


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
     * Set admin.
     *
     * @param bool $admin
     *
     * @return Grupo
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;

        return $this;
    }

    /**
     * Get admin.
     *
     * @return bool
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * Set nome.
     *
     * @param string $nome
     *
     * @return Grupo
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome.
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set supergrupo.
     *
     * @param \entities\Grupo|null $supergrupo
     *
     * @return Grupo
     */
    public function setSupergrupo(\entities\Grupo $supergrupo = null)
    {
        $this->supergrupo = $supergrupo;

        return $this;
    }

    /**
     * Get supergrupo.
     *
     * @return \entities\Grupo|null
     */
    public function getSupergrupo()
    {
        return $this->supergrupo;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->subgrupos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add subgrupo.
     *
     * @param \entities\Grupo $subgrupo
     *
     * @return Grupo
     */
    public function addSubgrupo(\entities\Grupo $subgrupo)
    {
        $this->subgrupos[] = $subgrupo;

        return $this;
    }

    /**
     * Remove subgrupo.
     *
     * @param \entities\Grupo $subgrupo
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeSubgrupo(\entities\Grupo $subgrupo)
    {
        return $this->subgrupos->removeElement($subgrupo);
    }

    /**
     * Get subgrupos.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubgrupos() {
        return $this->subgrupos;
    }

    public function asJSON() {
    	$sub = '[]';
    	if (!$this->subgrupos->isEmpty()) {
    		$sub = '[';
			for ($i=0;$i<$this->subgrupos->count();$i++) {
				if ($i > 0) {
					$sub .= ',';
				}
				$sub .= $this->subgrupos->get($i)->asJSON();
			}
			$sub .= ']';
		}
    	$super = null;
    	$id = $this->id;
    	$admin = $this->admin;
    	$nome = $this->nome;
		$x = "{";
		$x .= "\"id\": \"$id\",";
		$x .= "\"admin\": \"$admin\",";
		$x .= "\"subgrupos\": $sub,";
		$x .= '"nome": "' . $nome . '"';
		$x .= "}";
    	return $x;
	}
}
