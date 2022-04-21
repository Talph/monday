<?php

namespace App\Traits;

trait UserNames {

    public function getUserNames($id){

        if($id === 8613056 || $id === 11531028 || $id === 11531028){
            $username = "Laurence McCann";
        }elseif($id === 8613640){
            $username = "Pieter Lotz";
        }elseif($id === 8614169){
            $username = "Nerina Venter";
        }elseif($id === 8614193){
            $username = "Philip Wessels";
        }elseif($id === 8632120){
            $username = "Hennie Maritz";
        }elseif($id === 8790528){
            $username = "John Bolton";
        }elseif($id === 8790529){
            $username = "Mihir Gulabbhai";
        }elseif($id === 8790530){
            $username = "Awikal Dwivedi";
        }elseif($id === 8790531){
            $username = "Rehaan Abdulla";
        }elseif($id === 8790533){
            $username = "Alan Payne";
        }elseif($id === 8790538){
            $username = "Stian Kruger";
        }elseif($id === 8790538){
            $username = "Stuart Scanlon";
        }elseif($id === 8843988){
            $username = "Simon V H";
        }elseif($id === 8843990){
            $username = "Mpumi Khoza";
        }elseif($id === 11769650){
            $username = "Ondrej Dvoulety";
        }elseif($id === 11769670){
            $username = "Koketso M";
        }elseif($id === 12373329){
            $username = "Dnyanraj Patil";
        }elseif($id === 13233103){
            $username = "Vishal Sharma";
        }elseif($id === 13338918){
            $username = "Daneel";
        }elseif($id === 13805254){
            $username = "Melissa Stephenson";
        }elseif($id === 15878476){
            $username = "Sizwe Malaza";
        }elseif($id === 17660191){
            $username = "Stephan Theron";
        }elseif($id === 20651271){
            $username = "Naazim Saley";
        }elseif($id === 20693428){
            $username = "Emile Engelbrecht";
        }elseif($id === 21218241){
            $username = "Deirdré van Wyk";
        }elseif($id === 21310553){
            $username = "Savio Venkatsamy";
        }elseif($id === 22461722){
            $username = "Craig Parrymore";
        }elseif($id === 22485496){
            $username = "Topaz Booysen";
        }elseif($id === 22983192){
            $username = "Kreelan Naidoo";
        }elseif($id === 22983193){
            $username = "Annelie du Toit";
        }elseif($id === 23225106){
            $username = "Aneen L";
        }elseif($id === 23737864){
            $username = "Anandie Cutler";
        }elseif($id === 25077070){
            $username = "Hendrik H";
        }elseif($id === 26293288){
            $username = "Carel Jordaan";
        }elseif($id === 27748366){
            $username = "Danielle Conradie";
        }elseif($id === 28157619){
            $username = "Marnus Heunis";
        }elseif($id === 28197410){
            $username = "Marno Louwrens";
        }elseif($id === 28484506){
            $username = "Flip Joubert";
        }elseif($id === 28486408){
            $username = "Tafara Shamu";
        }elseif($id === 28787086){
            $username = "Marnus";
        }else {
            $username = "Unknown";
        }

        return $username;
    }
}