<?php

class Form {

    private $data;
    public $tag = 'p';

    public function __construct($data = array()){
        $this->data = $data;
    }
 
    private function surround($content){
        return "<{$this->tag}>{$content}</{$this->tag}>";
    }
    
    private function getValue($index){
        return isset($this->data[$index]) ? $this->data[$index] : null;
    }

    public function input($name){
        //$name === 'DB_PASSWRD' ? $type = 'password' : $type = 'text';
        if ($name === 'DB_PASSWRD' || $name === 'password') {
            $type = 'password';
        } else {
            $type = 'text';
        }
        
        return $this->surround('<input type="'.$type.'" class= "form-control" name="' .$name. '" value="'.$this->getValue($name).'">');
    }

    public function select($what, $list) { 
        $values = explode(",", $list);
        ?>
        <label for="select">Choisissez une <?= $what;?>:</label>
        <select name="<?= $what ?>-select" id="select">
        <option value="default" selected hidden> -- choisir -- </option>
        <?php
        foreach ($values as $value){
            echo '<option value='.$value.'>'.$value.'</option>';
        }
        ?>
        </select>
        <?php
    }

    public function submit($action){
       return $this->surround('<button type="submit" class="btn btn-primary">' .$action. '</button>');
    }
}