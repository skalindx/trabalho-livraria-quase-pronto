<?php
class LivroDAO {
    public function create($livro) {
        try {
            $query = BD::getConexao()->prepare(
                "INSERT INTO livro (titulo, ano_publicado, editora, quant_disponivel, categoria_id_autor)
                 VALUES (:t, :a, :e, :q, :c)"
            );

            $categoriaId = is_object($livro->getCategoria())
                ? $livro->getCategoria()->getId()
                : $livro->getCategoria();

            $query->bindValue(':t',$livro->getTitulo(), PDO::PARAM_STR);
            $query->bindValue(':a',$livro->getAno_publicado(), PDO::PARAM_STR);
            $query->bindValue(':e',$livro->getEditora(), PDO::PARAM_STR);
            $query->bindValue(':q',$livro->getQuant_disponivel(), PDO::PARAM_STR);
            $query->bindValue(':c',$categoriaId, PDO::PARAM_INT);

            if (!$query->execute()) {
                print_r($query->errorInfo());
            }
        } catch (PDOException $e) {
            echo "Erro #1: " . $e->getMessage();
        }
    }

    public function read() {
        try {
            $query = BD::getConexao()->prepare("SELECT * FROM livro");

            if (!$query->execute()) {
                print_r($query->errorInfo());
            }

            $listaLivro = array();$daoCategoria = new CategoriaDAO();

            foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $linha) {$livro = new Livro();
                $livro->setId($linha['id_livro']);
                $livro->setTitulo($linha['titulo']);
                $livro->setAno_publicado($linha['ano_publicado']);
                $livro->setEditora($linha['editora']);
                $livro->setQuant_disponivel($linha['quant_disponivel']);

                $categoria = $daoCategoria->find($linha['categoria_id_autor']);
                $livro->setCategoria($categoria);

                $listaLivro[] =$livro;
            }

            return $listaLivro;
        } catch (PDOException $e) {
            echo "Erro #2: " . $e->getMessage();
        }
    }

    public function find($id) {
        try {
            $query = BD::getConexao()->prepare(
                "SELECT * FROM livro WHERE id_livro = :id"
            );

            $query->bindValue(':id', $id, PDO::PARAM_INT);$query->execute();

            $livro = null;

            if ($linha = $query->fetch(PDO::FETCH_ASSOC)) {$livro = new Livro();
                $livro->setId($linha['id_livro']);
                $livro->setTitulo($linha['titulo']);
                $livro->setAno_publicado($linha['ano_publicado']);
                $livro->setEditora($linha['editora']);
                $livro->setQuant_disponivel($linha['quant_disponivel']);

                $daoCategoria = new CategoriaDAO();$categoria = $daoCategoria->find($linha['categoria_id_autor']);
                $livro->setCategoria($categoria);
            }

            return $livro;
        } catch (PDOException $e) {
            echo "Erro #3: " . $e->getMessage();
        }
    }

    public function update($livro) {
        try {
            $query = BD::getConexao()->prepare(
                "UPDATE livro
                 SET titulo = :t, ano_publicado = :a, editora = :e, quant_disponivel = :q, categoria_id_autor = :c
                 WHERE id_livro = :id"
            );

            $categoriaId = is_object($livro->getCategoria())
                ? $livro->getCategoria()->getId()
                : $livro->getCategoria();

            $query->bindValue(':t',$livro->getTitulo(), PDO::PARAM_STR);
            $query->bindValue(':a',$livro->getAno_publicado(), PDO::PARAM_STR);
            $query->bindValue(':e',$livro->getEditora(), PDO::PARAM_STR);
            $query->bindValue(':q',$livro->getQuant_disponivel(), PDO::PARAM_STR);
            $query->bindValue(':c',$categoriaId, PDO::PARAM_INT);
            $query->bindValue(':id',$livro->getId(), PDO::PARAM_INT);

            if (!$query->execute()) {
                print_r($query->errorInfo());
            }
        } catch (PDOException $e) {
            echo "Erro #4: " . $e->getMessage();
        }
    }

    public function destroy($id) {
        try {
            $query = BD::getConexao()->prepare(
                "DELETE FROM livro WHERE id_livro = :id"
            );

            $query->bindValue(':id',$id, PDO::PARAM_INT);

            if (!$query->execute()) {
                print_r($query->errorInfo());
            }
        } catch (PDOException $e) {
            echo "Erro #5: " . $e->getMessage();
        }
    }
}