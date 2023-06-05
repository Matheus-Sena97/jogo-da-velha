<?php

session_start();

require_once 'class/Table.class.php';

$player0 = $player =  new Player('Matheus', 'X');
$player1 = new Player('Bruno','O');

if(isset($_SESSION['player']) && $_SESSION['player'] == 1){
    $player = $player1;
}

$table = new Table($player, isset($_SESSION['squares']) ? unserialize($_SESSION['squares']): [] );

if(!isset($_SESSION['finish']) && isset($_POST['square']) && is_numeric($_POST['square']) && $table->setMarker($_POST['square'])){
    
    if($table->winnerGame()){
        $_SESSION['finish'] = true;
        echo 'Vencedor: ';
    }elseif($table->drawGame()){
        $_SESSION['finish'] = true;
        echo 'Empate: ';    
    
    } else {
        
        if($player == $player0){
            $player = $player1;
            $_SESSION['player'] = 1;
        }else{
            $player = $player0;
            $_SESSION['player'] = 0;
        }
    }
    if($table->winnerGame() && $player == $player0){
        $_SESSION['SP1']++;
       }elseif ($table->winnerGame() && $player == $player1){
        $_SESSION['SP2']++;
       }
}

print('<b>'.$table->getPlayer()->getName().'</b>'.'</br> Pontuação: '. $_SESSION['SP1'] .'</br> Pontuação 2: '.$_SESSION['SP2']);

$table->render($_SESSION['finish']??false);

$_SESSION['squares'] = serialize($table->getSquares());

if(isset($_POST['reset'])){
$SP1 = $_SESSION['SP1'];
$SP2 = $_SESSION['SP2'];
unset($_SESSION['player']);
unset($_SESSION['squares']);
unset($_SESSION['finish']);
$_SESSION['SP1'] = $SP1;
$_SESSION['SP2'] = $SP2;
}

if(isset($_POST['erase'])){
unset($_SESSION['SP1']);
unset($_SESSION['SP2']);
unset($_SESSION['squares']);
unset($_SESSION['player']);
unset($_SESSION['finish']);
$_SESSION['SP1'] = 0;
$_SESSION['SP2'] = 0;
} 

?>

<form method="post" action="index.php">
<input type="submit" name="reset" value="Jogar Novamente">
<input type="submit" name="erase" value="Apagar Pontuação">
</form>
