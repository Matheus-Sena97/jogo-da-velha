<?php
require_once 'Player.class.php';

class Table{
 private Player $player;
 private array $squares = [
   '','','',
   '','','',
   '','','',
 ];
 
 public function __construct(Player $player, array $squares){
    $this->player = $player;
    if(!empty($squares)) $this->squares = $squares;
 }
 
 public function getPlayer(){
    return $this->player;
 }

 public function setPlayer(Player $player){
   $this->player = $player;
 }

 public function getSquares(){
   return $this->squares;
 }

 public function setMarker(int $square){
   if(empty($this->squares[$square])){
      $this->squares[$square] = $this->player->getMarker();
      return true;
   }
   return false;
 }

 public function winnerGame() {
  
  if(!empty($this->squares[0]) && ($this->squares[0] == $this->squares[1] && $this->squares[0] == $this->squares[2])){
    return true;
  }
  if(!empty($this->squares[3]) && ($this->squares[3] == $this->squares[4] && $this->squares[3] == $this->squares[5])){
    return true;
  }
  if(!empty($this->squares[6]) && ($this->squares[6] == $this->squares[7] && $this->squares[6] == $this->squares[8])){
    return true;
  }
  if(!empty($this->squares[0]) && ($this->squares[0] == $this->squares[3] && $this->squares[0] == $this->squares[6])){
    return true;
  }
  if(!empty($this->squares[1]) && ($this->squares[1] == $this->squares[4] && $this->squares[1] == $this->squares[7])){
    return true;
  }
  if(!empty($this->squares[2]) && ($this->squares[2] == $this->squares[5] && $this->squares[2] == $this->squares[8])){
    return true;
  }
  if(!empty($this->squares[2]) && ($this->squares[2] == $this->squares[4] && $this->squares[2] == $this->squares[6])){
    return true;
  }
  if(!empty($this->squares[0]) && ($this->squares[0] == $this->squares[4] && $this->squares[0] == $this->squares[8])){
    return true;
  }
  return false;
 }

 public function drawGame(){
  if(!in_array('',$this->squares)){
    return true;
  }
  return false;
 }

 public function render(){
    print('<div style="width: 250px">');
    foreach($this->squares as $key => $square){
      require 'parts/squares.php';
    }
    print('</div>');
 }
    
 
}
?>