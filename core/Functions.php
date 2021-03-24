<?php

class Functions{

    public function redirect(string $url):void{

        header('Location: '.$url);
        exit;
    }
}