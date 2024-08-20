<?php
require_once("../classes/Database.class.php");

class Quadrado{
   
    private $id; 
    private $lado;
    private $cor; 
    private $un; 

    public function __construct($id = 0, $lado = "null", $cor = "null",UnidadeMedida $un = null){
        $this->setId($id); 
        $this->setLado($lado);
        $this->setCor($cor); 
        $this->setUn($un);
       
    }
   
   
    public function setId($novoId){
        if ($novoId < 0)
            throw new Exception("Erro: id inválido!"); 
        else
            $this->id = $novoId;
    }
    
    public function setLado($novaLado){
        if ($novaLado == "")
            throw new Exception("Erro: lado inválido!");
        else
            $this->lado = $novaLado;
    }
    public function setCor($novoCor){
        if ($novoCor == "")
            throw new Exception("Erro: Cor inválido!");
        else
            $this->cor = $novoCor;
    }
    public function setUn($novoUn){
        if ($novoUn == "")
            throw new Exception("Erro: Unidade inválido!");
        else
            $this->un = $novoUn;
    }
   
    public function getId(){ return $this->id; }
    public function getLado() { return $this->lado;}
    public function getCor() { return $this->cor;}
    public function getUn() { return $this->un;}
   
        
    public function incluir(){
        
      //  $conexao = Database::getInstance(); 
        $sql = 'INSERT INTO quadrado (lado, opt, cor, id_un)   
                     VALUES (:lado, :opt, :cor, :id_un)';
       // $conexao->beginTransaction();
       // $comando = $conexao->prepare($sql);  
       $parametros = array(':lado'=>$this->getLado(),   
                           ':opt'=>1,
                           ':cor'=>$this->getCor(),
                           ':id_un'=>$this->getUn()->getId());
    return Database::executar($sql, $parametros);
       
    }    
    
    public function excluir(){
        
        $sql = 'DELETE 
                  FROM pessoa
                 WHERE id = :id';
       $parametros =  array('id' =>$this->id);
        return Database::executar($sql,$parametros);
    }  

    
    public function alterar(){
        $conexao = Database::getInstance();
        $sql = 'UPDATE quadrado
                   SET lado = :lado, cor = :cor, id_un = :id_un;
                 WHERE id = :id';
        $parametros = array(':id'=>$this->getId(),
        'lado'=>$this->getLado(),
        ':cor'=>$this->getCor(),
        ':id_un'=>$this->getUn()->getId());
        Database::executar($sql,$parametros);
        return true;
    }    

    
    public static function listar($tipo = 0, $busca = "" ){
        $conexao = Database::getInstance();
       
        $sql = "SELECT * FROM quadrado";        
        if ($tipo > 0 )
            switch($tipo){
                case 1: $sql .= " WHERE id = :busca"; break;
                case 2: $sql .= " WHERE cor like :busca"; $busca = "%{$busca}%"; break;
                case 3: $sql .= " WHERE tamanho like :busca";  $busca = "%{$busca}%";  break;
                case 4: $sql .= " WHERE unidade like :busca";  $busca = "%{$busca}%";  break;
            }
        $comando = $conexao->prepare($sql);      
        if ($tipo > 0 )
            $comando->bindValue(':busca',$busca); 
        $comando->execute(); 
        $quadrados = array();           
        while($registro = $comando->fetch(PDO::FETCH_ASSOC)){  
            $un = UnidadeMedida::listar(1,$registro['id_un'] )[0]; 
            $quadrado = new Quadrado($registro['id'],$registro['cor'],$registro['lado'],$un); 
            array_push($quadrados, $quadrado); 
        }
        return $quadrados;  

    
    }    
    public function desenhar(){

        return '<div style="width= ; height= ; background-color= $cor"></div>';
    }
}

?>
<?php
/*<div style="width= ; height= ; background-color= $cor">

</div>//
?>