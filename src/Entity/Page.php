<?php

namespace App\Entity;

use App\Repository\PageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PageRepository::class)]
class Page
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

	#[ORM\Column(type: Types::TEXT,nullable: true)]
	private ?string $json = null;

	#[ORM\Column(type: Types::TEXT,nullable: true)]
	private ?string $css = null;

	#[ORM\Column(type: Types::TEXT,nullable: true)]
	private ?string $html = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    public function getId(): ?int
    {
        return $this->id;
    }

	public function getJson(): ?string
         	{
         		return $this->json;
         	}

	public function setJson(?string $json): static
         	{
         		$this->json = $json;
         
         		return $this;
         	}


	public function getHtml(): ?string
         	{
         		return $this->html;
         	}

	public function setHtml(?string $html): static
         	{
         		$this->html = $html;
         
         		return $this;
         	}


	public function getCss(): ?string
         	{
         		return $this->css;
         	}

	public function setCss(?string $css): static
         	{
         		$this->css = $css;
         
         		return $this;
         	}

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }
}
