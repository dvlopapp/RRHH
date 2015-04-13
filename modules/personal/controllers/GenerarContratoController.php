<?php
/*
* ---------------------------------------
* --------- CREATED BY CREATOR ----------
* fecha: 10-04-2015 17:04:01 
* Descripcion : GenerarContratoController.php
* ---------------------------------------
*/    

class GenerarContratoController extends Controller{
    
    private static $GenerarContratoModel;
    
    public function __construct() {
        self::$GenerarContratoModel = $this->loadModel();
    }
    
    public function index(){ 
        Obj::run()->View->render();
    }
    
    public function getGridGenerarContrato(){
        $rows = array();
        $data =  self::$GenerarContratoModel->getGridGenerarContrato();
        foreach ($data as $value) {
            $rows[] = array(
                "id_trabajador"=>AesCtr::en($value["id_trabajador"]),
                "nombrecompleto"=> $value["nombrecompleto"],
                "numerodocumento"=> $value["numerodocumento"],
                "area"=> $value["area"],
                "cargo"=> $value["cargo"],
                "fe_ini"=> $value["fe_ini"],
                "fe_fin"=> $value["fe_fin"],
                "estadoct"=> Functions::labelState($value["estadoct"]),
                "total"=> $value["total"]
            );
        }
        echo json_encode($rows);
    }
    
    public function getGridSinContrato(){
        $rows = array();
        $data =  self::$GenerarContratoModel->getGridSinContrato();
        foreach ($data as $value) {
            $rows[] = array(
                "id_trabajador"=>AesCtr::en($value["id_trabajador"]),
                "nombrecompleto"=> $value["nombrecompleto"],
                "numerodocumento"=> $value["numerodocumento"],
                "fe_ini"=> $value["fe_ini"],
                "fe_fin"=> $value["fe_fin"],
                "estadoct"=> Functions::labelState($value["estadoct"]),
                "total"=> $value["total"]
            );
        }
        echo json_encode($rows);
    }
    
    public function getGridHistorial(){
        $rows = array();
        $data =  self::$GenerarContratoModel->getGridHistorial();
        foreach ($data as $value) {
            $rows[] = array(
                "id_contrato"=>AesCtr::en($value["id_contrato"]),
                "fecha_inicio"=> $value["fecha_inicio"],
                "fecha_fin"=> $value["fecha_fin"],
                "total"=> $value["total"]
            );
        }
        echo json_encode($rows);
    }
    
    /*carga formulario (formNewGenerarContrato.phtml) para nuevo registro: GenerarContrato*/
    public function formNewGenerarContrato(){
        Obj::run()->View->render();
    }
    
    public function formHistorial(){
        Obj::run()->View->render();
    }
    
    /*envia datos para grabar registro: GenerarContrato*/
    public function generarContrato(){
        $chkb = SimpleForm::getParam(GNCTR.'gridSinContrato_chk');
        $fini = SimpleForm::getParam(GNCTR.'txt_fechacontratoini');
        $ffin = SimpleForm::getParam(GNCTR.'txt_fechacontratofin');
        
        $cadena = '';
        foreach ($chkb as $key => $chk) {
            $cadena .= AesCtr::de($chk).'*'.Functions::dateFormat($fini[$key],'Y-m-d').'*'.Functions::dateFormat($ffin[$key],'Y-m-d').'#';
        }
        
        $data = self::$GenerarContratoModel->mantenimientoGenerarContrato($cadena,  count($chkb));
        
        echo json_encode($data);
    }
    
    /*envia datos para eliminar registro: GenerarContrato*/
    public function postDeleteContrato(){
        $data = self::$GenerarContratoModel->mantenimientoGenerarContrato();
        
        echo json_encode($data);
    }
    
}
