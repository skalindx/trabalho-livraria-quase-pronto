<?php
    class AutorDAO {
        public function create($autor) {
            try {
                $query = BD:: getConexao()->prepare(
                    "INSERT INTO autor(nome, nacionalidade, idade)
                    VALUES (:n, :nc, :i)"
                );
                $query->bindValue(':n', $autor->getNome(),PDO::PARAM_STR);
                $query->bindValue(':nc', $autor->getNacionalidade(),PDO::PARAM_STR);
                $query->bindValue(':i', $autor->getIdade(),PDO::PARAM_STR);


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
                $query = BD::getConexao()->prepare("SELECT * FROM autor");
                
                if(!$query->execute()) {
                    print_r($query->errorInfo());
                }

                $listaAutores = array();
                foreach($query->fetchAll(PDO::FETCH_ASSOC) as $linha) {
                    $autor = new autor(); // Classe bean
                    $autor->setId($linha['id_autor']);
                    $autor->setNome($linha['nome']);
                    $autor->setNacionalidade($linha['nacionalidade']);
                    $autor->setIdade($linha['idade']);


                    array_push($listaAutores, $autor);
                }
                
                return $listaAutores;
            } 
            catch(PDOException $e) {
                echo "Erro #2: " . $e->getMessage();
            }            
        }
         
        public function find($id) {
            try {
                $query = BD::getConexao()->prepare("SELECT * FROM autor WHERE id_autor = :id");
                $query->bindValue(':id', $id, PDO::PARAM_INT);
                
                if(!$query->execute()) {
                    print_r($query->errorInfo());
                }

                $listaautors = array();
                if ($linha = $query->fetch(PDO::FETCH_ASSOC)) {
                    $autor = new autor(); // Classe bean
                    $autor->setId($linha['id_autor']);
                    $autor->setNome($linha['nome']);
                    $autor->setNacionalidade($linha['nacionalidade']);
                    $autor->setIdade($linha['idade']);

                    array_push($listaautors, $autor);
                }
                
                return $autor;
            } 
            catch(PDOException $e) {
                echo "Erro #3: " . $e->getMessage();
            }            
        }

          public function update($autor) {
            try {
                $query = BD:: getConexao()->prepare(
                    "UPDATE autor
                    SET nome = :n, nacionalidade  = :nc, idade= :i
                    WHERE id_autor = :id"
                );

                $query->bindValue(':n', $autor->getNome(),PDO::PARAM_STR);
                $query->bindValue(':nc', $autor->getNacionalidade(),PDO::PARAM_STR);
                $query->bindValue(':i', $autor->getIdade(),PDO::PARAM_STR);
                $query->bindValue(':id', $autor->getID(),PDO::PARAM_INT);


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
                    "DELETE FROM autor
                     WHERE id_autor = :id"
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