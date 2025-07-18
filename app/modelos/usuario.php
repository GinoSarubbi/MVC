<?php
class Usuario
{
    private  $nombre;
    private  $email;
    private  $password;
    private  $genero;

    public function __construct($nombre, $email, $password, $genero = '')
    {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->password = $password;
        $this->genero = $genero;
    }


    public function getNombre()
    {
        return $this->nombre;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getGenero()
    {
        return $this->genero;
    }

    public function setGenero($genero)
    {
        $this->genero = $genero;
    }

    public function setNombre(string $nombre)
    {
        $this->nombre = $nombre;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function setPassword(string $password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function verificarPassword(string $password)
    {
        return password_verify($password, $this->password);
    }
}
