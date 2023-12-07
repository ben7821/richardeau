<?php
class Player
{
    private int $id;
    private string $pseudo;
    private array $lesPlayer;
    private int $scrore;

    public function __construct($id, $pseudo)
    {
        $this->id = $id;
        $this->pseudo = $pseudo;
        $this->lesPlayer = [];
    }


}







?>