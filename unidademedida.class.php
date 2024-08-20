 <?php
    require_once("database.class.php");

class UnidadeMedida{
    private $id;
    private $descricao;

    public function __construct(int $id = 0, String $descricao = "Descricao") {
        $this->setId($id);
        $this->setDescricao($descricao);
     
    }
    public function setId($id){
        if ($id < 0)
            throw new Exception("Erro: id inválido!"); //dispara uma exceção
        else
            $this->id = $id;
    }

    public function setDescricao($descricao){
        if(empty($descricao))
            throw new Exception("Erro: descricao inválido!"); //dispara uma exceção    
        else
            $this->descricao = $descricao;}


    public function getId(){
        return $this->id;}

    public function getDescricao(){
        return $this->descricao;}



    static public function listar($tipo,$busca){
    
        $conexao = Database::getInstance();
       
        $sql = "SELECT * FROM unidademedida";        
        if ($tipo > 0 )
            switch($tipo){
                case 1: $sql .= " WHERE id = :busca"; break;
            }
        $comando = $conexao->prepare($sql);      
        if ($tipo > 0 )
            $comando->bindValue(':busca',$busca); 
        $comando->execute(); 
        $unidades = array();           
        while($registro = $comando->fetch(PDO::FETCH_ASSOC)){   
            $unidade = new UnidadeMedida($registro['id'],$registro['un']); 
            array_push($unidades, $unidade); 
        }
        return $unidades;  
    }

    public function inserir(){
        $sql = "INSERT INTO unidade (un) VALUES (:descricao)";
        $atributos = [
            ":descricao" => $this->descricao,
            ];

        return Database::executar($sql, $atributos);
    }

     public function editar(){
        $conexao = Database::getInstance();
        $sql = 'UPDATE quadrado
                   SET un = :un
                 WHERE id = :id';
        $parametros = array(
        ':id'=>$this->getId(),
        ':un'=>$this->getDescricao());
        Database::executar($sql,$parametros);
        return true;
    }

     public function excluir(){
        $sql = "DELETE FROM unidade WHERE id = :id";
        return Database::executar($sql, [":id"=>$this->getId()]);
    }

}
?>