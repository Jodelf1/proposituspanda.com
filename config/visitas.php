<?php
abstract class ClassConexao{
public function Conectar()
{
    try{
        $Con=new PDO("mysql:host=localhost;dbname=lijorh_propositus_panda_bd","root","");
        return $Con;
    }catch (PDOException $Erro){
        return $Erro->getMessage();
    }
}
}

class ClassVisitas extends ClassConexao{
    private $Id, $Ip , $Data , $Hora , $Limite;

    #Construtor para setar atributos
    public function __construct()
    {
        $this->Id=0;
        $this->Ip=$_SERVER['REMOTE_ADDR'];
        $this->Data=date("Y/m/d");
        $this->Hora=date("H:i");
        $this->Limite=50;
    }

    #Verifica se o usuário recebeu visita recentemente
    public function VerificaUsuario()
    {
        $Select=$this->Conectar()->prepare("select * from visitas_tb where Ip=:ip and Data=:datas order by Id desc");
        $Select->bindParam(":ip",$this->Ip,PDO::PARAM_STR);
        $Select->bindParam(":datas",$this->Data,PDO::PARAM_STR);
        $Select->execute();
        if($Select->rowCount() == 0){
            $this->InserindoVisitas();
        }else{
            $FSelect=$Select->fetch(PDO::FETCH_ASSOC);
            $HoraDB=strtotime($FSelect['Hora']);
            $HoraAtual=strtotime($this->Hora);
            $HoraSubtracao=$HoraAtual-$HoraDB;

            if($HoraSubtracao > $this->Limite){
                $this->InserindoVisitas();
            }
        }
    }

    #Inseri a visita no banco de dados
    public function InserindoVisitas()
    {
        $Select=$this->Conectar()->prepare("insert into visitas_tb values (:id , :ip , :datas , :hora)");
        $Select->bindParam(":id",$this->Id,PDO::PARAM_STR);
        $Select->bindParam(":ip",$this->Ip,PDO::PARAM_STR);
        $Select->bindParam(":datas",$this->Data,PDO::PARAM_STR);
        $Select->bindParam(":hora",$this->Hora,PDO::PARAM_STR);
        $Select->execute();
    }
}