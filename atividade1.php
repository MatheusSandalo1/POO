<?php

    abstract class conta {

        private  string $tipoDeConta = " ";

        public function gettipoDeConta(){
            return $this-> tipoDeConta;
        }
        public function settipoDeConta(string $tipoDeConta){
            $this-> tipoDeConta = $tipoDeConta;
        }

        private string $agencia;

        public function getagencia(){
            return $this-> agencia;
        }

        public function setagencia(string $agencia){
            $this-> agencia = $agencia;
        }

        public string $conta = " ";

        public function getconta(){
            return $this-> conta;
        }

        public function setconta(string $conta){
            $this-> conta = $conta;
        }

        protected float $saldo = 0.0;
        // public tem acesso em qualquer lugar
        // private pode ser usada apenas dentro da classe
        //protected pode ser usada na classe mãe e na classe

        public function imprimeExtrato(){
            ECHO "CONTA: " . $this->tipoDeConta . "Agência: " . $this->agencia .  "Conta: " . $this->conta . "Saldo: " . $this->calcularSaldo();
        }

        public function deposito(float $valorDepositado){
            if($valorDepositado > 0){
                $this->saldo += $valorDepositado;
                echo "Deposito realizado com sucesso <br>";
            }else{
                echo "Não é possivel realizar esse deposito. <br>";
            }
             

        }

        public function saque(float $valorRetirado){

            if($this->saldo >= $valorRetirado){
                $this->saldo -= $valorRetirado;
                echo "Saque realizado com sucesso <br>";
            } else{
                echo "Saque insuficiente. <br>";
            }
            
        }

        abstract public function calcularSaldo(); 
    }

    class Poupanca extends conta{

            public $reajuste;

            public function __construct(string $agencia, string $conta, float $reajuste)
            {
                $this-> settipoDeConta('Poupança');
                $this-> setagencia($agencia);
                $this-> setconta($conta);
                $this-> reajuste = $reajuste;
            }

            public function calcularSaldo()
            {
                return $this->saldo + ($this->saldo * $this->reajuste / 100);
            }
    }

    class Especial extends conta{

        public $saldoEspecial;

        public function __construct(string $agencia, string $conta, float $saldoEspecial)
        {
            $this-> settipoDeConta('Especial');
            $this-> setagencia($agencia);
            $this-> setconta($conta);
            $this-> saldoEspecial = $saldoEspecial;
        }
            public function calcularSaldo()
            {
                return $this-> saldoEspecial + $this-> saldo;
            }
}

$ctaPoup = new Poupanca( '0002-7', '85588-88', 0.54);
//$ctaPoup-> saldo = -1500; //nao pode acessar atributo protegido
$ctaPoup-> deposito (1500);
$ctaPoup-> saque(3000);
$ctaPoup-> imprimeExtrato();

echo '<br>';

$ctaEspecial = new Especial ('0055-2', '75588-42', 2300);
$ctaEspecial-> deposito(1500);
$ctaEspecial-> imprimeExtrato();

?>