<?php
class ReservaDAO {
    private function extrairId($valor) {
        return is_object($valor) ? $valor->getId() : $valor;
    }

    public function create($reserva) {
        try {
            $usuarioId = $this->extrairId($reserva->getUsuario());
            $livroId = $this->extrairId($reserva->getLivro());

            $query = BD::getConexao()->prepare(
                "INSERT INTO reserva (data_reserva, usuario_id_usuario, livro_id_livro, id_usuario, id_livro)
                 VALUES (:d, :u, :l, :u2, :l2)"
            );

            $query->bindValue(':d', $reserva->getDataReserva(), PDO::PARAM_STR);
            $query->bindValue(':u', $usuarioId, PDO::PARAM_INT);
            $query->bindValue(':l', $livroId, PDO::PARAM_INT);
            $query->bindValue(':u2', $usuarioId, PDO::PARAM_INT);
            $query->bindValue(':l2', $livroId, PDO::PARAM_INT);

            if (!$query->execute()) {
                print_r($query->errorInfo());
            }
        } catch (PDOException $e) {
            echo "Erro #1: " . $e->getMessage();
        }
    }

    public function read() {
        try {
            $query = BD::getConexao()->prepare("SELECT * FROM reserva");

            if (!$query->execute()) {
                print_r($query->errorInfo());
            }

            $listaReservas = array();
            $daoUsuario = new UsuarioDAO();
            $daoLivro = new LivroDAO();

            foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $linha) {
                $reserva = new Reserva();
                $reserva->setId($linha['id_reserva']);
                $reserva->setDataReserva($linha['data_reserva']);

                $uid = !empty($linha['usuario_id_usuario']) ? $linha['usuario_id_usuario'] : $linha['id_usuario'];
                $lid = !empty($linha['livro_id_livro']) ? $linha['livro_id_livro'] : $linha['id_livro'];

                $reserva->setUsuario($daoUsuario->find($uid));
                $reserva->setLivro($daoLivro->find($lid));

                $listaReservas[] = $reserva;
            }

            return $listaReservas;
        } catch (PDOException $e) {
            echo "Erro #2: " . $e->getMessage();
        }
    }

    public function find($id) {
        try {
            $query = BD::getConexao()->prepare(
                "SELECT * FROM reserva WHERE id_reserva = :i"
            );

            $query->bindValue(':i', $id, PDO::PARAM_INT);

            if (!$query->execute()) {
                print_r($query->errorInfo());
            }

            $reserva = null;

            if ($linha = $query->fetch(PDO::FETCH_ASSOC)) {
                $reserva = new Reserva();
                $reserva->setId($linha['id_reserva']);
                $reserva->setDataReserva($linha['data_reserva']);

                $uid = !empty($linha['usuario_id_usuario']) ? $linha['usuario_id_usuario'] : $linha['id_usuario'];
                $lid = !empty($linha['livro_id_livro']) ? $linha['livro_id_livro'] : $linha['id_livro'];

                $daoUsuario = new UsuarioDAO();
                $daoLivro = new LivroDAO();

                $reserva->setUsuario($daoUsuario->find($uid));
                $reserva->setLivro($daoLivro->find($lid));
            }

            return $reserva;
        } catch (PDOException $e) {
            echo "Erro #3: " . $e->getMessage();
        }
    }

    public function update($reserva) {
        try {
            $usuarioId = $this->extrairId($reserva->getUsuario());
            $livroId = $this->extrairId($reserva->getLivro());

            $query = BD::getConexao()->prepare(
                "UPDATE reserva
                 SET data_reserva = :d,
                     usuario_id_usuario = :u,
                     livro_id_livro = :l,
                     id_usuario = :u2,
                     id_livro = :l2
                 WHERE id_reserva = :i"
            );

            $query->bindValue(':d', $reserva->getDataReserva(), PDO::PARAM_STR);
            $query->bindValue(':u', $usuarioId, PDO::PARAM_INT);
            $query->bindValue(':l', $livroId, PDO::PARAM_INT);
            $query->bindValue(':u2', $usuarioId, PDO::PARAM_INT);
            $query->bindValue(':l2', $livroId, PDO::PARAM_INT);
            $query->bindValue(':i', $reserva->getId(), PDO::PARAM_INT);

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
                "DELETE FROM reserva WHERE id_reserva = :i"
            );

            $query->bindValue(':i', $id, PDO::PARAM_INT);

            if (!$query->execute()) {
                print_r($query->errorInfo());
            }
        } catch (PDOException $e) {
            echo "Erro #5: " . $e->getMessage();
        }
    }
}