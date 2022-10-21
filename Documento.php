<?php








    abstract class Documento
    {
        protected $numero;

        abstract public function eValido();

        abstract public function formata();

        public function setNumero($numero)
        {
            $this-> numero = preg_replace('/[^0-9]/', '', $numero); //expressão regular
        }

        public function getNumero()
        {
            return $this-> numero;
        }
    }

    class CPF extends Documento
    {
        public function __construct($numero)
        {
            $this-> setNumero($numero);
        }

        public function eValido()
        {
            $digitoX = 0;
            $somatorioX = 0;
            $cpfX = substr($this-> getNumero(),0,9);
            $peso = 10;

            for($index = 0; $index < 9; $index++){
                $somatorioX += $cpfX[$index] * $peso--;
                // $peso --;
            }


            /*
            $somatorioX = $somatorioX + ($cpfX[0] * 10 ); 
            $somatorioX = $somatorioX + ($cpfX[1] * 9 ); 
            $somatorioX = $somatorioX + ($cpfX[2] * 8 ); 
            $somatorioX = $somatorioX + ($cpfX[3] * 7 ); 
            $somatorioX = $somatorioX + ($cpfX[4] * 6 ); 
            $somatorioX = $somatorioX + ($cpfX[5] * 5 ); 
            $somatorioX = $somatorioX + ($cpfX[6] * 4 ); 
            $somatorioX = $somatorioX + ($cpfX[7] * 3 ); 
            $somatorioX = $somatorioX + ($cpfX[8] * 2 ); 
            */
            echo $somatorioX;
            $modulo11 = $somatorioX % 11;
            echo '<br>' . $modulo11;
            
            $digitoX = 11 - $modulo11;
            echo '<br>' . $digitoX;
        }

        public function formata()
        {
            // Formato do CPF: ###.###.###-##
            return substr($this-> numero, 0, 3) . '.' .
                   substr($this-> numero, 3, 3) . '.' .
                   substr($this-> numero, 6, 3) . '-' .
                   substr($this-> numero, 9, 2);
        }
    }

    class CNPJ extends Documento
    {
        public function __construct($numero)
        {
            $this->setNumero($numero);
        }

        public function eValido()
        {
        }

        public function formata()
        {
        }
    }

    class CNH extends Documento
    {
        private $categoria;

        public function __construct($numero, $categoria)
        {
            $this-> setNumero($numero);
            $this-> categoria = $categoria;
        }

        public function eValido()
        {
        }

        public function formata()
        {
        }

        public function setCategoria($categoria)
        {
            $this-> categoria = $categoria;
        }

        public function getCategoria()
        {
            return $this-> categoria;
        }
    }

    $cpfMatheus = new cpf("501.479.628-11");
    $cpfMatheus-> eValido();


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
    $cnhFulano = new CNH('1255656', 'AB');

    echo $cnhFulano-> getNumero() .' Cat.: ' . $cnhFulano-> getCategoria();
    */