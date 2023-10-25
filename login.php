<?php
    $usuario = "";
    $senha = "";
    while($usuario != "Enigma" or $senha != "15082007Walmonn")
    {
        /*$usuario = $_REQUEST['usuario'];
        $senha = $_REQUEST['senha'];*/
        $usuario = readline("Digite seu usuário: ");
        $senha = readline("Digite sua senha: ");
        if($usuario != "Enigma" or $senha != "15082007Walmonn")
        {
            print "Acesso negado!\n";
            sleep(3);
            system('cls',$limpa);
        }
        else
        {
            print "Acesso autorizado!";
     
        }
    }
?>
