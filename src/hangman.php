<?php
class Game
{
    private $letters_guessed;
    private $answer;
    private $guesses;

    function __construct($answer)
    {
        $this->letters_guessed = [];
        $this->answer = $answer;
        $this->guesses = 5;
    }

}
 ?>
