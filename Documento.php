<?php
    abstract class Documento{

        protected $numero;

        abstract public function eValido();

        abstract public function formata();

        public function setNumero($numero){
            $this-> numero = preg_replace( '/[^0-9]/','', $numero); //expressão regular
        }

        public function getNumero(){
            return $this-> numero;
        }

        public function calculaModulo11( $qtdeNumeros, $peso ){
            $digito = 0;
            $somatorio = 0;
            $documento = substr($this-> getNumero(),0,$qtdeNumeros);
            
            for( $index = 0; $index < $qtdeNumeros; $index ++){
                $somatorio += $documento[$index] * $peso--;  
                
                if($peso < 2 ){
                    $peso = 9;
                }
                     
            }

            $modulo11 = $somatorio % 11;

            $digito = 11 - $modulo11;

            if( $digito > 9 ){
                $digito = 0;
            }

            return $digito;

        }

    }

    class CPF extends Documento{

        public function __construct( $numero ){            
            $this-> setNumero($numero);
        }

        public function eValido(){
            $digitoX = $this->calculaModulo11(9,10);
            $digitoY = $this->calculaModulo11(10,11);
            
            $CPFCalculado = substr( $this-> getNumero(),0,9);

            $CPFCalculado = $CPFCalculado . $digitoX . $digitoY;

            if( $this-> getNumero() == $CPFCalculado ){
                return true;
            }else{
                return false;
            }           


        }

        public function formata(){
            // Formato do CPF: ###.###.###-##
            return substr( $this-> numero, 0, 3) . '.' .
                   substr( $this-> numero, 3, 3) . '.' .
                   substr( $this-> numero, 6, 3) . '-' .
                   substr( $this-> numero, 9, 2);
        }

    }

    class CNPJ extends Documento{

        public function __construct($numero){
            $this->setNumero( $numero );
        }
        
        public function eValido(){
            $digitoX = $this->calculaModulo11(12,5);
            $digitoY = $this->calculaModulo11(13,6);
            
            $CNPJCalculado = substr( $this-> getNumero(),0,9);

            $CNPJCalculado = $CNPJCalculado . $digitoX . $digitoY;

            if( $this-> getNumero() == $CNPJCalculado ){
                return true;
            }else{
                return false;
            }    
/*
            $CNPJX = substr( $this-> getNumero(),0, 12 );
            $somatorio = 0;

            $somatorio = $somatorio + $CNPJX[0] * 5;
            $somatorio = $somatorio + $CNPJX[1] * 4;
            $somatorio = $somatorio + $CNPJX[2] * 3;
            $somatorio = $somatorio + $CNPJX[3] * 2;
            $somatorio = $somatorio + $CNPJX[4] * 9;
            $somatorio = $somatorio + $CNPJX[5] * 8;
            $somatorio = $somatorio + $CNPJX[6] * 7;
            $somatorio = $somatorio + $CNPJX[7] * 6;
            $somatorio = $somatorio + $CNPJX[8] * 5;
            $somatorio = $somatorio + $CNPJX[9] * 4;
            $somatorio = $somatorio + $CNPJX[10] * 3;
            $somatorio = $somatorio + $CNPJX[11] * 2;

            $peso = 5;
            for( $index = 0; $index < strlen($CNPJX); $index++ ){
                $somatorio = $somatorio + $CNPJX[$index] * $peso--;

                if($peso < 2 ){
                    $peso = 9;
                }

            }

            echo $somatorio . "<br/>";
            $moduloX = $somatorio % 11;
            echo $moduloX . "<br/>";

            $resto = 11 - $moduloX;
            echo $resto . "<br/>";

            $digitoX = $resto;
            if($digitoX > 9 ){
                $digitoX = 0;
            }
            echo $digitoX . "<br/>";


            $CNPJY = substr( $this-> getNumero(),0, 13 );
            $somatorio = 0;

            $somatorio = $somatorio + $CNPJY[0] * 6;
            $somatorio = $somatorio + $CNPJY[1] * 5;
            $somatorio = $somatorio + $CNPJY[2] * 4;
            $somatorio = $somatorio + $CNPJY[3] * 3;
            $somatorio = $somatorio + $CNPJY[4] * 2;
            $somatorio = $somatorio + $CNPJY[5] * 9;
            $somatorio = $somatorio + $CNPJY[6] * 8;
            $somatorio = $somatorio + $CNPJY[7] * 7;
            $somatorio = $somatorio + $CNPJY[8] * 6;
            $somatorio = $somatorio + $CNPJY[9] * 5;
            $somatorio = $somatorio + $CNPJY[10] * 4;
            $somatorio = $somatorio + $CNPJY[11] * 3;
            $somatorio = $somatorio + $CNPJY[12] * 2;
            echo $somatorio . "<br/>";
            $moduloY = $somatorio % 11;
            echo $moduloY . "<br/>";

            $resto = 11 - $moduloY;
            echo $resto . "<br/>";

            $digitoY = $resto;
            if($digitoY > 9 ){
                $digitoY = 0;
            }
            echo $digitoY . "<br/>";

            $CNPJCalculado = substr( $this-> getNumero(),0, 12 );
            $CNPJCalculado = $CNPJCalculado . $digitoX . $digitoY;

            if($this-> getNumero() == $CNPJCalculado ){
                return true;
            }else{
                return false;
            }
*/

        }

        public function formata(){
            
        }

    }

    class CNH extends Documento{
        
        private $categoria;

        public function __construct($numero, $categoria)
        {
            $this-> setNumero($numero);
            $this-> categoria = $categoria;
        }

        public function eValido(){

        }

        public function formata(){
            
        }

        public function setCategoria($categoria){
            $this-> categoria = $categoria;
        }

        public function getCategoria(){
            return $this-> categoria;
        }

    }
/*
    echo "<------ CPF do Matheus ------> ";
    $cpfMatheus = new CPF("501.479.628-11");
    if( $cpfMatheus-> eValido() ){
        echo "CPF Válido";
    }else{
        echo "CPF Inválido";
    }

    echo "<br/>";
    echo "<------ CPF do Celso ------> ";
    $cpfCelso = new CPF("171.865.758-72");
    if( $cpfCelso-> eValido() ){
        echo "CPF Válido";
    }else{
        echo "CPF Inválido";
    }
*/
    echo "<br/>";
    $cnpjSenac = new CNPJ("03.709.814/0025-65" );
    if( $cnpjSenac-> eValido() ){
        echo "CNPJ Válido";
    }else{
        echo "CNPJ Inválido";
    }

    /*
    $cpf = new CPF('115.858.758-88');
    echo $cpf-> formata();

    $cpf-> setNumero('CPF: 545.855.565-85');    

    echo '</br>';
    echo $cpf-> getNumero();

    echo '</br>';

    $cnpjSenac = new CNPJ('03.709.814/0025-65');
    echo $cnpjSenac-> getNumero();

    echo '</br>';

    $cnhFulano = new CNH('1255656','AB');
    echo $cnhFulano-> getNumero() .' Cat.: ' . $cnhFulano-> getCategoria();
*/

?>