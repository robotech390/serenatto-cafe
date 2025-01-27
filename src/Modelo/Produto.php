<?php

class Produto
{
    private ?int $id;
    private string $tipo;
    private string $nome;
    private string $descricao;
    private string $imagem;
    private float $preco;

    public function __construct(?int $id, string $tipo, string $nome, string $descricao, float $preco, string $imagem = "logo-serenatto.png")
    {
        $this->id = $id;
        $this->tipo = $tipo;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->imagem = $imagem;
        $this->preco = $preco;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getTipo(): string
    {
        return $this->tipo;
    }

    public function setTipo($tipo): void
    {
        $this->tipo = $tipo;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome($nome): void
    {
        $this->nome = $nome;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }


    public function setDescricao($descricao): void
    {
        $this->descricao = $descricao;
    }


    public function getImagem(): string
    {
        return $this->imagem;
    }


    public function setImagem($imagem): void
    {
        $this->imagem = $imagem;
    }

    public function getPreco(): float
    {
        return $this->preco;
    }

    public function setPreco($preco): void
    {
        $this->preco = $preco;
    }

    public function getPrecoFormatted():string
    {
        return "R$ ". number_format($this->preco, 2, ',', '.');
    }

    public function getImagemFormatted():string
    {
        return "img/" . $this->imagem;
    }
}