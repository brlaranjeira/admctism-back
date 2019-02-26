<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 30/01/19
 * Time: 11:21
 */

namespace entities;

/**
 * @Entity
 * @Table(name="arquivo")
 */
class Arquivo
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="bigint")
     */
    private $id;

    /**
     * @Column(type="string",name="content_hash")
     */
    private $contentHash;

    /**
     * @Column(type="string",name="original_name")
     */
    private $originalName;

    /**
     * @Column(type="string")
     */
    private $name;

    /**
     * @Column(type="datetime",name="dthr_criacao",nullable=true,options={"default":"CURRENT_TIMESTAMP"})
     */
    private $dateTimeCriacao;


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
     * Set contentHash.
     *
     * @param string $contentHash
     *
     * @return Arquivo
     */
    public function setContentHash($contentHash)
    {
        $this->contentHash = $contentHash;

        return $this;
    }

    /**
     * Get contentHash.
     *
     * @return string
     */
    public function getContentHash()
    {
        return $this->contentHash;
    }

    /**
     * Set originalName.
     *
     * @param string $originalName
     *
     * @return Arquivo
     */
    public function setOriginalName($originalName)
    {
        $this->originalName = $originalName;

        return $this;
    }

    /**
     * Get originalName.
     *
     * @return string
     */
    public function getOriginalName()
    {
        return $this->originalName;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Arquivo
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set dateTimeCriacao.
     *
     * @param \DateTime $dateTimeCriacao
     *
     * @return Arquivo
     */
    public function setDateTimeCriacao($dateTimeCriacao)
    {
        $this->dateTimeCriacao = $dateTimeCriacao;

        return $this;
    }

    /**
     * Get dateTimeCriacao.
     *
     * @return \DateTime
     */
    public function getDateTimeCriacao()
    {
        return $this->dateTimeCriacao;
    }

    public function asJSON() {
        return json_encode([
            "id" => $this->id,
            "contentHash" => $this->contentHash,
            "originalName" => $this->originalName,
            "name" => $this->name,
            "datetimeCriacao" => $this->dateTimeCriacao
        ]);
    }

    public static function create($location,$originalName,$persist=true) {
        require __DIR__ . '/../bootstrap.php';
        $arq = new \entities\Arquivo();
        $arq->contentHash = hash_file('sha256',$location);
        $extension = strrchr($originalName,'.');

        $arq->originalName = substr(substr($originalName,0,strlen($originalName)-strlen($extension)),0,50-strlen($extension)) . $extension;
        $arquivoIdentico = $entity_manager->getRepository('\entities\Arquivo')->findOneBy(['contentHash'=>$arq->contentHash]);
        if (isset($arquivoIdentico)) {
            $arq->name = $arquivoIdentico->name;
        } else {
            $name = \Utils::newFileName();
            $moveOk = move_uploaded_file($location,$name);
            if (!$moveOk) {
                throw new \Exception('err');
            }
            //pega o que tem depois da ultima barra (i.e., soh o nome do arquivo)
            $arq->name = substr(strrchr($name,'/'),1);
        }
        if ($persist) {
            $entity_manager->persist($arq);
            $entity_manager->flush();
        }
        return $arq;
    }


}
