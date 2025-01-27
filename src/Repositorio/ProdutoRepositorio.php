<?php


class ProdutoRepositorio
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function opcoesCafe(): array
    {
        $query = "SELECT * FROM produtos WHERE tipo = 'Café' ORDER BY preco ASC";
        $stmt = $this->pdo->query($query);
        $produtosCafe = $stmt->fetchAll();

        $dadosCafe = array_map(function($cafe) {
            return $this->formatarObjeto($cafe);
        }, $produtosCafe);

        return $dadosCafe;
    }

    public function opcoesAlmoco(): array
    {
        $query = "SELECT * FROM produtos WHERE tipo = 'Almoco' ORDER BY preco ASC";
        $stmt = $this->pdo->query($query);
        $produtosAlmoco = $stmt->fetchAll();

        $dadosAlmoco = array_map(function($almoco) {
            return $this->formatarObjeto($almoco);
        }, $produtosAlmoco);

        return $dadosAlmoco;
    }

    public function buscarTodos(): array
    {
        $query = "SELECT * FROM produtos ORDER BY preco";
        $stmt = $this->pdo->query($query);
        $produtosAlmoco = $stmt->fetchAll();

        $dadosAlmoco = array_map(function($almoco) {
            return $this->formatarObjeto($almoco);
        }, $produtosAlmoco);

        return $dadosAlmoco;
    }

    public function buscar(int $id): Produto
    {
        $query = "SELECT * FROM produtos WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        $produto = $stmt->fetch();

        $dados = $this->formatarObjeto($produto);

        return $dados;
    }

    public function deletar(int $id)
    {
        $query = "DELETE FROM produtos WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
    }

    public function create(Produto $produto)
    {
        $query = "INSERT INTO produtos(nome, tipo, descricao, preco, imagem) VALUES(:nome, :tipo, :descricao, :preco, :imagem)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":nome", $produto->getNome());
        $stmt->bindValue(":tipo", $produto->getTipo());
        $stmt->bindValue(":descricao", $produto->getDescricao());
        $stmt->bindValue(":preco", $produto->getPreco());
        $stmt->bindValue(":imagem", $produto->getImagem());
        $stmt->execute();
    }

    public function update(Produto $produto)
    {
        $query = "UPDATE produtos 
                  SET tipo = :tipo, 
                      nome = :nome,
                      descricao = :descricao, 
                      preco = :preco
                  WHERE id = :id";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":nome", $produto->getNome());
        $stmt->bindValue(":tipo", $produto->getTipo());
        $stmt->bindValue(":descricao", $produto->getDescricao());
        $stmt->bindValue(":preco", $produto->getPreco());
        $stmt->bindValue(":id", $produto->getId());
        $stmt->execute();

        if($produto->getImagem() !== 'logo-serenatto.png'){

            $this->atualizarFoto($produto);
        }
    }

    private function atualizarFoto(Produto $produto)
    {
        $sql = "UPDATE produtos SET imagem = :imagem WHERE id = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(":imagem", $produto->getImagem());
        $statement->bindValue(":id", $produto->getId());
        $statement->execute();
    }

    private function formatarObjeto($objeto){
        return new Produto(
            $objeto['id'],
            $objeto['tipo'],
            $objeto['nome'],
            $objeto['descricao'],
            $objeto['preco'],
            $objeto['imagem']
        );
    }
}