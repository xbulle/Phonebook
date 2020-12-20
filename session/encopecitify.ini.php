<?php

class Token {
    /**
     * The deciphered string
     * @var string
     */
    private $auto;
    function __construct() {}
    function generate_token ($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $token = '';
        for ($i = 0; $i < $length; $i++) { $token .= $characters[rand(0, $charactersLength - 1)]; }
        return $token;
    }
    function Cipher($ch, $key) {
        if (!ctype_alpha($ch))
            return $ch;

        $offset = ord(ctype_upper($ch) ? 'A' : 'a');
        return chr(fmod(((ord($ch) + $key) - $offset), 26) + $offset);
    }

    function Encipher($input, $key) {
        $output = "";

        $inputArr = str_split($input);
        foreach ($inputArr as $ch)
            $output .= $this->Cipher($ch, $key);
        return $output;
    }

    function Decipher($input, $key) {
        return $this->Encipher($input, 26 - $key);
    }
    function val () {
        if (empty($this->auto)) {
            $this->auto = $this->generate_token(80);
        }
        return $this->auto;
    }
}