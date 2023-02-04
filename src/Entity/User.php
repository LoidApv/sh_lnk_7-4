<?php

namespace App\Entity;

use App\Entity\LinksMap;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;
    
    /**
     * 1-М через М-М
     * @ORM\ManyToMany(targetEntity="LinksMap")
     * @ORM\JoinTable(name="users_links",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="lm_id", referencedColumnName="id", unique=true)}
     *      )
     * @var Collection<int, LinksMap>
     */
    private Collection $links;
    
    function __construct(){
        $this->links = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
    
    public function getLinks(): Collection
    {
        return $this->links;
    }
}
