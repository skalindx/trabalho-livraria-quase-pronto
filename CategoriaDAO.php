<?php
    class CategoriaDAO {
        public function create($categoria) {
            try {
                $query = BD:: getConexao()->prepare(
                    "INSERT INTO categoria(nome, descricao)
                    VALUES (:n, :d)"
                );
                $query->bindValue(':n', $categoria->getNome(),PDO::PARAM_STR);
                $query->bindValue(':d', $categoria->getDescricao(),PDO::PARAM_STR);


                if(!$query->execute()) {
                    print_r($query->errorInfo());
                }
            }
            catch(PDOException $e) {
                echo "Erro #1: " . $e->getMessage();
            }   
        }

        public function read() {
            try {
                $query = BD::getConexao()->prepare("SELECT * FROM categoria");
                
                if(!$query->execute()) {
                    print_r($query->errorInfo());
                }

                $listaCategoria = array();
                foreach($query->fetchAll(PDO::FETCH_ASSOC) as $linha) {
                    $categoria = new categoria(); // Classe bean
                    $categoria->setId($linha['id_categoria']);
                    $categoria->setNome($linha['nome']);
                    $categoria->setDescricao($linha['descricao']);


                    array_push($listaCategoria, $categoria);
                }
                
                return $listaCategoria;
            } 
            catch(PDOException $e) {
                echo "Erro #2: " . $e->getMessage();
            }            
        }
         
        public function find($id) {
            try {
                        $query = BD::getConexao()->prepare(
                    "SELECT * FROM categoria WHERE id_categoria = :id"
                );

                $query->bindValue(':id', $id, PDO::PARAM_INT);
                $query->execute();

                $categoria = null;

                if ($linha = $query->fetch(PDO::FETCH_ASSOC)) {
                    $categoria = new Categoria();
                    $categoria->setId($linha['id_categoria']);
                    $categoria->setNome($linha['nome']);
                    $categoria->setDescricao($linha['descricao']);
                }

                return $categoria;
                    } 
                    catch(PDOException $e) {
                        echo "Erro #3: " . $e->getMessage();
                    }            
                }

          public function update($categoria) {
            try {
                $query = BD:: getConexao()->prepare(
                    "UPDATE categoria
                    SET nome = :n, descricao  = :d
                    WHERE id_categoria = :id"
                );

                $query->bindValue(':n', $categoria->getNome(),PDO::PARAM_STR);
                $query->bindValue(':d', $categoria->getDescricao(),PDO::PARAM_STR);
                $query->bindValue(':id', $categoria->getID(),PDO::PARAM_INT);


                if(!$query->execute()) {
                    print_r($query->errorInfo());
                }
            }
            catch(PDOException $e) {
                echo "Erro #4: " . $e->getMessage();
            }   
        }

        public function destroy($id) {
            try {
                $query = BD:: getConexao()->prepare(
                    "DELETE FROM categoria
                     WHERE id_categoria = :id"
                );

                $query->bindValue(':id', $id, PDO::PARAM_INT);


                if(!$query->execute()) {
                    print_r($query->errorInfo());
                }
            }
            catch(PDOException $e) {
                echo "Erro #5: " . $e->getMessage();
            }   
        }
    }