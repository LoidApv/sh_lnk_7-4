<?php

namespace App\Entity;

use App\Repository\LinksMapRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LinksMapRepository::class)
 */
class LinksMap
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length=50, nullable=true, options={"default": ""})
     */
    private $name;
    
    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $originalLink;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $shortLinkSlug;

    /**
     * @ORM\Column(type="datetime")
     */
    private $lastUpdate;
    
    function __construct(){
        $this->lastUpdate = new \Datetime;
    }
    
    /**
     * @ORM\preUpdate
     */
    function preUpdate(){    //  Не знаю работает ли, но чтоб было
        $this->lastUpdate = new \Datetime;
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }
    
    public function getOriginalLink(): ?string
    {
        return $this->originalLink;
    }

    public function setOriginalLink(?string $originalLink): self
    {
        $this->originalLink = $originalLink;

        return $this;
    }

    public function getShortLinkSlug(): ?string
    {
        return $this->shortLinkSlug;
    }

    public function setShortLinkSlag(?string $shortLinkSlug): self
    {
        $this->shortLinkSlug = $shortLinkSlug;

        return $this;
    }

    public function getLastUpdate(): ?\DateTimeInterface
    {
        return $this->lastUpdate;
    }

    public function setLastUpdate(\DateTimeInterface $lastUpdate): self
    {
        $this->lastUpdate = $lastUpdate;

        return $this;
    }
}
