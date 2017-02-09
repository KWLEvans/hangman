<?php
class Game
{
    private $letters_guessed;
    private $answer;
    private $current_string;
    private $guesses;

    function __construct($answer)
    {
        $this->letters_guessed = [];
        $this->answer = strtolower($answer);
        $this->current_string;
        for ($i = 0; $i < strlen($answer); $i++) {
            $this->current_string.="_";
        }
        $this->guesses = 5;
    }

    function check($user_guess)
    {
        array_push($this->letters_guessed, $user_guess);
        $answers_array = [];
        for ($i = 0; $i < strlen($this->answer); $i++) {
            if ($user_guess == $this->answer[$i]) {
                array_push($answers_array, $i);
            }
        }

        if ($answers_array) {
            foreach ($answers_array as $index) {
                $this->current_string[$index] = $user_guess;
            }
            return $this->current_string;
        } else {
            $this->guesses--;
            return false;
        }
    }

    function spaceify()
    {
        $spacified_string = "";
        for ($i = 0; $i < strlen($this->current_string); $i++) {
            $spacified_string.= $this->current_string[$i] . " ";
        }
        return $spacified_string;
    }

    function save()
    {
        $_SESSION["game"] = $this;
    }

    static function getGame()
    {
        return $_SESSION["game"];
    }

}
 ?>
