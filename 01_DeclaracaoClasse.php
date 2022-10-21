<?php




 abstract class Forma
 {
     public $tipoDeForma;

     public function imprimeForma()
     {
		echo $this->tipoDeForma . 'com Área de: ' . $this-> calcularArea(). '<br>';
     }

    abstract public function calcularArea();
 }

    class Quadrado extends Forma
    {
        public $lado;

		   public function __construct(float $varLado){

				$this-> tipoDeForma = 'Quadrado';
				$this-> lado = $varLado;
			}	

        public function calcularArea(){

            return $this-> lado * $this-> lado;
         }
    }

	class Retangulo extends Forma
	{
		public $base;
		public $altura;

			public function __construct(float $varBaseRet, float $varAltura){

				$this-> tipoDeForma = 'Retangulo';
				$this-> base = $varBaseRet;
				$this-> altura = $varAltura;
			}

			public function calcularArea(){

				return $this-> base * $this-> altura;
			}
		}

	class Triangulo extends Forma{

		public $cumprimentoBase;
		public $altura;

		public function __construct(float $baseTri, float $alturaTri){

			$this-> tipoDeForma = 'Triangulo';
			$this-> cumprimentoBase = $baseTri;
			$this-> altura = $alturaTri;
		}

		public function calcularArea()
		{
			return ($this-> cumprimentoBase * $this-> altura) /2;
		}
	}


 $obj = new Quadrado(5);
 $obj-> imprimeForma();

 $obj1 = new Quadrado(100);
 $obj1-> imprimeForma();

 $obj2 = new Retangulo(5,10);
 $obj2-> imprimeForma();

 $obj3 = new Triangulo(5,4);
 $obj3-> imprimeForma();
