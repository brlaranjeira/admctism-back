<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 14/03/19
 * Time: 17:42
 */

namespace entities;

/**
 * @Entity
 * @Table(name="usuario")
 */
class Usuario
{

	/**
	 * @Id
	 * @GeneratedValue
	 * @Column(type="bigint")
	 */
	private $id;

	/**
	 * @Column(type="string",name="login")
	 */
	private $login;

	/**
	 * @Column(type="string",name="uid_number")
	 */
	private $uidnumber;

	/**
	 * @Column(type="string",name="email")
	 */
	private $email;

	/**
	 * @ManyToOne(targetEntity="Grupo")
	 * @JoinColumn(name="grupo",referencedColumnName="id",nullable=true)
	 */
	private $grupo;

	/**
	 * @Column(type="string", name="nome")
	 */
	private $nome;

	/**
	 * @Column(type="string", name="matricula")
	 */
	private $matricula;

	/**
	 * @Column(type="string", name="fone")
	 */
	private $fone;

	/**
	 * @Column(type="string", name="curso")
	 */
	private $curso;

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
     * Set ldapUid.
     *
     * @param string $ldapUid
     *
     * @return Usuario
     */
    public function setLdapUid($ldapUid)
    {
        $this->ldapUid = $ldapUid;

        return $this;
    }

    /**
     * Get ldapUid.
     *
     * @return string
     */
    public function getLdapUid()
    {
        return $this->ldapUid;
    }

    /**
     * Set ldapUidnumber.
     *
     * @param string $ldapUidnumber
     *
     * @return Usuario
     */
    public function setLdapUidnumber($ldapUidnumber)
    {
        $this->ldapUidnumber = $ldapUidnumber;

        return $this;
    }

    /**
     * Get ldapUidnumber.
     *
     * @return string
     */
    public function getLdapUidnumber()
    {
        return $this->ldapUidnumber;
    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return Usuario
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set grupo.
     *
     * @param \entities\Grupo|null $grupo
     *
     * @return Usuario
     */
    public function setGrupo(\entities\Grupo $grupo = null)
    {
        $this->grupo = $grupo;

        return $this;
    }

    /**
     * Get grupo.
     *
     * @return \entities\Grupo|null
     */
    public function getGrupo()
    {
        return $this->grupo;
    }

    /**
     * Set login.
     *
     * @param string $login
     *
     * @return Usuario
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login.
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set uidnumber.
     *
     * @param string $uidnumber
     *
     * @return Usuario
     */
    public function setUidnumber($uidnumber)
    {
        $this->uidnumber = $uidnumber;

        return $this;
    }

    /**
     * Get uidnumber.
     *
     * @return string
     */
    public function getUidnumber()
    {
        return $this->uidnumber;
    }

    /**
     * Set nome.
     *
     * @param string $nome
     *
     * @return Usuario
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
     * Set matricula.
     *
     * @param string $matricula
     *
     * @return Usuario
     */
    public function setMatricula($matricula)
    {
        $this->matricula = $matricula;

        return $this;
    }

    /**
     * Get matricula.
     *
     * @return string
     */
    public function getMatricula()
    {
        return $this->matricula;
    }

    /**
     * Set fone.
     *
     * @param string $fone
     *
     * @return Usuario
     */
    public function setFone($fone)
    {
        $this->fone = $fone;

        return $this;
    }

    /**
     * Get fone.
     *
     * @return string
     */
    public function getFone()
    {
        return $this->fone;
    }

    /**
     * Set curso.
     *
     * @param string $curso
     *
     * @return Usuario
     */
    public function setCurso($curso)
    {
        $this->curso = $curso;

        return $this;
    }

    /**
     * Get curso.
     *
     * @return string
     */
    public function getCurso()
    {
        return $this->curso;
    }

    public function asJSON() {
    	$str = '{';
		$grupo = $this->grupo->asJSON();
		$str .= "\"id\": \"$this->id\",";
		$str .= "\"login\": \"$this->login\",";
		$str .= "\"uidnumber\": \"$this->uidnumber\",";
		$str .= "\"email\": \"$this->email\",";
		$str .= "\"grupo\": $grupo,";
		$str .= "\"nome\": \"$this->nome\",";
		$str .= "\"matricula\": \"$this->matricula\",";
		$str .= "\"fone\": \"$this->fone\",";
		$str .= "\"curso\": \"$this->curso\"";
		$str .= '}';
		return $str;
	}

}
