<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of UserLink
 *
 * @author Main
 */
class UserLink {
    
    private string $name;
    private string $originalLink;
    
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraints('name', [
            new Length([
                "max" => 50
            ])   
        ]);
        $metadata->addPropertyConstraints('originalLink', [
            new NotBlank(),
            new Length([
                "min" => 3,
                "max" => 1000
            ])
        ]);
    }
    
    public function getName(): string {
        return $this->name;
    }

    public function getOriginalLink(): string {
        return $this->originalLink;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function setOriginalLink(string $originalLink): void {
        $this->originalLink = $originalLink;
    }
}
