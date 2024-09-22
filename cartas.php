<?php
/*CLASSE CARTAS
-----Class-Carta-----
| Atributos         |
|-------------------|
| - nome            |
| - numero          |
| - img             |
|-------------------|
| Métodos           |
|-------------------|
| + setNome         |
| + getNome         |
| + setNumero       |
| + getNumero       |
| + setImg          |
| + getImg          |
---------------------
__________________________________________________________________________________________________
FUNÇÕES DO PROGRAMA
menu() -> Lista as opições do usuário;
baralho()-> Gera o baralho;
jogar()-> Inicia o jogo;
carta(int $indice) -> Gera uma carta pelo índice dela;
cartas() -> Mostra todas as cartas;
escreva_devagar() -> Função para escrever um texto devagar;
ajuda() -> Auxilia ao usuário instruindo como usar o programa;
__________________________________________________________________________________________________

FUNÇÕES NÃO APRENDIDAS EM AULA
usleep -> espera um tempo em micro segundos; 
strlen -> conta a quantidade de caracteres em uma string;
substr -> pega uma parte de uma string onte (string,posição da string,quantidade de caracteres);
strpos -> procura uma string dentro de outra string;
is_numeric -> verifica se um valor é número;
*/
class Carta
{
    private string $nome;
    private int $numero;
    private array $img;
    /**
     * Get the value of nome
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     */
    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of numero
     */
    public function getNumero(): int
    {
        return $this->numero;
    }

    /**
     * Set the value of numero
     */
    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get the value of img
     */
    public function getImg(): array
    {
        return $this->img;
    }

    /**
     * Set the value of numero
     */
    public function setImg(array $img): self
    {
        $this->img = $img;

        return $this;
    }
}
$cartas = array();
function menu()
{
    system("clear");
    print "-----------Menu----------\n";
    print "| 1 -> Ajuda            |\n";
    print "-------------------------\n";
    print "| 2 -> Mostrar cartas   |\n";
    print "-------------------------\n";
    print "| 3 -> Jogar            |\n";
    print "-------------------------\n";
    print "| 4 -> Finalizar        |\n";
    print "-------------------------\n";
    $esc = readline("Escolha: ");
    switch($esc)
    {
        case 1: ajuda(); menu(); break;
        case 2: cartas(); menu(); break;
        case 3: jogar(); break;
        case 4: die; break;
        default: menu(); break;
    }
}
function baralho()
{
    global $cartas;
    global $imgs;
    $itens = ['A','2','3','4','5','6','7','8','9','10','J','Q','K'];
    $tipos = ['ESPADAS','OUROS','PAUS','COPAS'];
    $i = 0;
    foreach($tipos as $tipo)
    {
        foreach($itens as $item)
        {
            if($item == '10')
            {
                $cartas[$i] = new Carta();
                $cartas[$i]->setNome($item." : ".$tipo);
                $cartas[$i]->setNumero($i);
                $cartas[$i]->setImg($imgs[$i]);
            }
            else
            {
                $cartas[$i] = new Carta();
                $cartas[$i]->setNome($item."  : ".$tipo);
                $cartas[$i]->setNumero($i);
                $cartas[$i]->setImg($imgs[$i]);
            }
            $i++;
        }
    }
}
function jogar()
{
    global $cartas;
    $tnt = array();
    system("clear");
    $m = count($cartas)-1;
    $i = random_int(0,$m);
    $escolhida = $cartas[$i];
    do
    {
        do
        {
            $tentativa = readline("Tente a sorte e escolha um número de 0 a 51: ");
            if(!is_numeric($tentativa))
            {
                system("clear");
                print "O valor dado não é número\n\n";
            }
        }while(!is_numeric($tentativa));
        if(!strpos($tentativa,'.'))
        {

            if($tentativa < $escolhida->getNumero())
            {
                if($tentativa <= 51 && $tentativa > -1)
                {
                    $rep = false;
                    system('clear');
                    carta($tentativa);
                    print "A carta é maior!\n\n";
                    if(count($tnt) > 0)
                    {
                        for($i = 0 ; $i < count($tnt);$i++)
                        {
                            if($tentativa == $tnt[$i])
                            {
                                $rep = true;
                                break;
                            }
                        }
                    }
                    if($rep == false)
                    {
                        $tnt[] = $tentativa;
                    }
                    else
                    {
                        print "Olá Dori você já tentou $tentativa!\n\n";
                    }
                }
                else
                {
                    system("clear");
                    print "Leia a questão novamente!\n\n";
                }
            }
            else
            {
                if($tentativa <= 51 && $tentativa > -1)
                {
                    $rep = false;
                    system('clear');
                    carta($tentativa);
                    print "A carta é menor!\n\n";
                    if(count($tnt) > 0)
                    {
                        for($i = 0 ; $i < count($tnt);$i++)
                        {
                            if($tentativa == $tnt[$i])
                            {
                                $rep = true;
                                break;
                            }
                        }
                    }
                    if($rep == false)
                    {
                        $tnt[] = $tentativa;
                    }
                    else
                    {
                        print "Olá Dori você já tentou $tentativa!\n\n";
                    }
                }
                else
                {
                    system("clear");
                    print "Leia a questão novamente!\n\n";
                }
            }
        }
        else
        {
            system("clear");
            print "O valor não é inteiro!\n\n";
        }
    }while($tentativa != $escolhida->getNumero());
    system("clear");
    print $escolhida->getNome()."\n";
    print "Número: ".$escolhida->getNumero()."\n";
    $img = $escolhida->getImg();
    for($i = 0 ; $i < count($img) ; $i++)
    {
        print $img[$i];
    }
    print "\n";
    print "Você ganhou!\n";
    die;
}
function carta($i)
{
    global $cartas;
    print $cartas[$i]->getNome()."\n";
    print "Número: ".$cartas[$i]->getNumero()."\n";
    $img = $cartas[$i]->getImg();
    for($i = 0 ; $i < count($img) ; $i++)
    {
        print $img[$i];
    }
}
function cartas()
{
    system("clear");
    global $cartas;
    print "=============================================\n\n";
    foreach($cartas as $carta)
    {
        print $carta->getNome()."\n";
        print "Número: ".$carta->getNumero()."\n";
        $img = $carta->getImg();
        for($i = 0 ; $i < count($img) ; $i++)
        {
            print $img[$i];
        }
        print "\n";
        print "=============================================";
        print "\n\n";
    }
    readline("Aperte enter para voltar ao menu!");
}

$dados = ['A','2','3','4','5','6','7','8','9','10','J','Q','K'];
$imgs = array();
foreach($dados as $dado)
{
    $i = count($imgs);
    if($dado == '10')
    {
        $imgs[$i][] = "-------------------\n";
        $imgs[$i][] = "| $dado"."___________   |\n";
        $imgs[$i][] = "|   |    E    |   |\n";
        $imgs[$i][] = "|   |    S    |   |\n";
        $imgs[$i][] = "|   |    P    |   |\n";
        $imgs[$i][] = "|   |    A    |   |\n";
        $imgs[$i][] = "|   |    D    |   |\n";
        $imgs[$i][] = "|   |    A    |   |\n";
        $imgs[$i][] = "|   |    S    |   |\n";
        $imgs[$i][] = "|   |_________|   |\n";
        $imgs[$i][] = "|              $dado |\n";
        $imgs[$i][] = "-------------------\n";
    }
    else
    {
        $imgs[$i][] = "-------------------\n";
        $imgs[$i][] = "| $dado ___________   |\n";
        $imgs[$i][] = "|   |    E    |   |\n";
        $imgs[$i][] = "|   |    S    |   |\n";
        $imgs[$i][] = "|   |    P    |   |\n";
        $imgs[$i][] = "|   |    A    |   |\n";
        $imgs[$i][] = "|   |    D    |   |\n";
        $imgs[$i][] = "|   |    A    |   |\n";
        $imgs[$i][] = "|   |    S    |   |\n";
        $imgs[$i][] = "|   |_________|   |\n";
        $imgs[$i][] = "|               $dado |\n";
        $imgs[$i][] = "-------------------\n";
    }
}
foreach($dados as $dado)
{
    $i = count($imgs);
    if($dado == '10')
    {
        $imgs[$i][] = "-------------------\n";
        $imgs[$i][] = "| $dado"."___________   |\n";
        $imgs[$i][] = "|   |         |   |\n";
        $imgs[$i][] = "|   |    O    |   |\n";
        $imgs[$i][] = "|   |    U    |   |\n";
        $imgs[$i][] = "|   |    R    |   |\n";
        $imgs[$i][] = "|   |    O    |   |\n";
        $imgs[$i][] = "|   |    S    |   |\n";
        $imgs[$i][] = "|   |         |   |\n";
        $imgs[$i][] = "|   |_________|   |\n";
        $imgs[$i][] = "|               $dado |\n";
        $imgs[$i][] = "-------------------\n";
    }
    else
    {
        $imgs[$i][] = "-------------------\n";
        $imgs[$i][] = "| $dado ___________   |\n";
        $imgs[$i][] = "|   |         |   |\n";
        $imgs[$i][] = "|   |    O    |   |\n";
        $imgs[$i][] = "|   |    U    |   |\n";
        $imgs[$i][] = "|   |    R    |   |\n";
        $imgs[$i][] = "|   |    O    |   |\n";
        $imgs[$i][] = "|   |    S    |   |\n";
        $imgs[$i][] = "|   |         |   |\n";
        $imgs[$i][] = "|   |_________|   |\n";
        $imgs[$i][] = "|               $dado |\n";
        $imgs[$i][] = "-------------------\n";
    }
}
foreach($dados as $dado)
{
    $i = count($imgs);
    if($dado == '10')
    {
        $imgs[$i][] = "-------------------\n";
        $imgs[$i][] = "| $dado"."___________   |\n";
        $imgs[$i][] = "|   |         |   |\n";
        $imgs[$i][] = "|   |    P    |   |\n";
        $imgs[$i][] = "|   |    A    |   |\n";
        $imgs[$i][] = "|   |    U    |   |\n";
        $imgs[$i][] = "|   |    S    |   |\n";
        $imgs[$i][] = "|   |         |   |\n";
        $imgs[$i][] = "|   |         |   |\n";
        $imgs[$i][] = "|   |_________|   |\n";
        $imgs[$i][] = "|              $dado |\n";
        $imgs[$i][] = "-------------------\n";
    }
    else
    {
        $imgs[$i][] = "-------------------\n";
        $imgs[$i][] = "| $dado ___________   |\n";
        $imgs[$i][] = "|   |         |   |\n";
        $imgs[$i][] = "|   |    P    |   |\n";
        $imgs[$i][] = "|   |    A    |   |\n";
        $imgs[$i][] = "|   |    U    |   |\n";
        $imgs[$i][] = "|   |    S    |   |\n";
        $imgs[$i][] = "|   |         |   |\n";
        $imgs[$i][] = "|   |         |   |\n";
        $imgs[$i][] = "|   |_________|   |\n";
        $imgs[$i][] = "|               $dado |\n";
        $imgs[$i][] = "-------------------\n";
    }
}
foreach($dados as $dado)
{
    $i = count($imgs);
    if($dado == '10')
    {
        $imgs[$i][] = "-------------------\n";
        $imgs[$i][] = "| $dado"."___________   |\n";
        $imgs[$i][] = "|   |         |   |\n";
        $imgs[$i][] = "|   |    C    |   |\n";
        $imgs[$i][] = "|   |    O    |   |\n";
        $imgs[$i][] = "|   |    P    |   |\n";
        $imgs[$i][] = "|   |    A    |   |\n";
        $imgs[$i][] = "|   |    S    |   |\n";
        $imgs[$i][] = "|   |         |   |\n";
        $imgs[$i][] = "|   |_________|   |\n";
        $imgs[$i][] = "|              $dado |\n";
        $imgs[$i][] = "-------------------\n";
    }
    else
    {
        $imgs[$i][] = "-------------------\n";
        $imgs[$i][] = "| $dado ___________   |\n";
        $imgs[$i][] = "|   |         |   |\n";
        $imgs[$i][] = "|   |    C    |   |\n";
        $imgs[$i][] = "|   |    O    |   |\n";
        $imgs[$i][] = "|   |    P    |   |\n";
        $imgs[$i][] = "|   |    A    |   |\n";
        $imgs[$i][] = "|   |    S    |   |\n";
        $imgs[$i][] = "|   |         |   |\n";
        $imgs[$i][] = "|   |_________|   |\n";
        $imgs[$i][] = "|               $dado |\n";
        $imgs[$i][] = "-------------------\n";
    }
}
function escreva_devagar(string $mensagem)
{
    $tamanho = strlen($mensagem);
    for($i = 0 ; $i < $tamanho ; $i++)
    {
        print substr($mensagem,$i,1);
        switch(substr($mensagem,$i,1))
        {
            case '.': usleep(600000) ;break;
            default: usleep(40000) ;break;
        }
    }
}
function ajuda()
{
    system("clear");
    escreva_devagar("Esse é um jogo de cartas onde  você tem  que adivinhar o número escolhido pelo programa o qual representa uma carta.\nQuando o jogo iniciar aparecerá um menu onde você escolhe um número da lista e dá \"ENTER\" para selecionar uma opição\nQuando você iniciar o jogo você deve tentar um número entre 0 e 51 e dar \"Enter\" para fazer a tentativa\n\nAperte \"ENTER\" para iniciar!");
    readline("");
}
ajuda();
baralho();
menu();
?>
