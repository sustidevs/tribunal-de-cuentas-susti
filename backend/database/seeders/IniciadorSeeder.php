<?php

namespace Database\Seeders;

use App\Models\Iniciador;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IniciadorSeeder extends Seeder
{
    
    Private $arrayIniciadores = array(
        array('prefijo'=> '010','nombre'=> 'Ministerio de Seguridad','tipo_entidad_id'=>1,'cuit'=>30669643248,'area_reparticiones'=>'Dirección de Administración – Servicio Penitenciario – Jefatura de Policía – Subsecretaria de Gobierno – Subsecretaria de Seguridad – Dirección de Defensa Civil.'),
        array('prefijo'=> '011','nombre'=>'Ministerio de Hacienda y Finanzas','tipo_entidad_id'=>1,'cuit'=>30707085726,'area_reparticiones'=>'Contaduría General de la Provincia – Subsistemas y tecnologías de la Información – Tesorería General – Dirección General de Rentas – Suep – Subsistemas y tecnologías de la Información (SUSTI).'),
        array('prefijo'=> '012','nombre'=>'Ministerio de Educación','tipo_entidad_id'=>1,'cuit'=>30707318240,'area_reparticiones'=>''),
        array('prefijo'=> '013','nombre'=>'Ministerio de Salud Pública','tipo_entidad_id'=>1,'cuit'=>30687953866,'area_reparticiones'=>'Dirección General UEP – Arancelamientos.'),
        array('prefijo'=> '014','nombre'=>'Ministerio de Producción','tipo_entidad_id'=>1,'cuit'=>30688007611,'area_reparticiones'=>'Dirección de Recursos Forestales – Dirección de Cooperativas.'),
        array('prefijo'=> '015','nombre'=>'Ministerio de Obras y Servicios Públicos','tipo_entidad_id'=>1,'cuit'=>33707172709,'area_reparticiones'=>'UCAPFI – Dirección de Transporte terrestre.'),
        array('prefijo'=> '016','nombre'=>'Ministerio Secretaria General de la Gobernación','tipo_entidad_id'=>1,'cuit'=>30707175520,'area_reparticiones'=>'Dirección de Aeronáutica – Escuela de Gobierno – Secretaria Privada – Secretaria Legal y Técnica.'),
        array('prefijo'=> '017','nombre'=>'Poder Judicial','tipo_entidad_id'=>1,'cuit'=>30623047950,'area_reparticiones'=>'Dirección General de Administración.'),
        array('prefijo'=> '018','nombre'=>'Poder Legislativo','tipo_entidad_id'=>1,'cuit'=>30688009835,'area_reparticiones'=>'Honorable Cámara de Senadores – Honorable Cámara de Diputados – Defensoría del Pueblo.'),
        array('prefijo'=> '019','nombre'=>'Fiscalía de Estado','tipo_entidad_id'=>1,'cuit'=>30687967549,'area_reparticiones'=>'Dirección General de Administración.'),
        array('prefijo'=> '020','nombre'=>'Ministerio de Coordinación y Planificación','tipo_entidad_id'=>1,'cuit'=>30714339601,'area_reparticiones'=>''),
        array('prefijo'=> '021','nombre'=>'Ministerio de Justicia y Derechos Humanos','tipo_entidad_id'=>1,'cuit'=>30712274154,'area_reparticiones'=>'Inspección General de Personas Jurídicas – Registro provincial de las personas.'),
        array('prefijo'=> '022','nombre'=>'Secretaria de Energía','tipo_entidad_id'=>1,'cuit'=>30712509453,'area_reparticiones'=>''),
        array('prefijo'=> '023','nombre'=>'Ministerio de Industria, Trabajo y Comercio','tipo_entidad_id'=>1,'cuit'=>30714349763,'area_reparticiones'=>'Subsecretaria de Comercio – Subsecretaria de Industria – Subsecretaria de Trabajo'),
        array('prefijo'=> '024','nombre'=>'Ministerio de Turismo','tipo_entidad_id'=>1,'cuit'=>30714330442,'area_reparticiones'=>'Dirección de Parques y reservas – Dirección de Recursos Naturales – Subsecretaria de Turismo.'),
        array('prefijo'=> '025','nombre'=>'Tribunal de Cuentas de la Provincia de Corrientes','tipo_entidad_id'=>1,'cuit'=>30707613862,'area_reparticiones'=>''),
        array('prefijo'=> '025','nombre'=>'Ministerio de Ciencia y Tecnología','tipo_entidad_id'=>1,'cuit'=>30716846403,'area_reparticiones'=>''),
        array('prefijo'=> '026','nombre'=>'Instituto de Lotería Y Casinos','tipo_entidad_id'=>2,'cuit'=>'','area_reparticiones'=>''),
        array('prefijo'=> '027','nombre'=>'Instituto de Cardiología de Corrientes','tipo_entidad_id'=>2,'cuit'=>'','area_reparticiones'=>''),
        array('prefijo'=> '028','nombre'=>'Instituto Provincial del Tabaco (IPT)','tipo_entidad_id'=>2,'cuit'=>'','area_reparticiones'=>''),
        array('prefijo'=> '029','nombre'=>'Instituto Correntino del Agua y del medio Ambiente (ICAA)','tipo_entidad_id'=>2,'cuit'=>'','area_reparticiones'=>''),
        array('prefijo'=> '030','nombre'=>'Instituto de Cultura de Corrientes','tipo_entidad_id'=>2,'cuit'=>'','area_reparticiones'=>''),
        array('prefijo'=> '031','nombre'=>'Instituto de Vivienda de Corrientes (INVICO)','tipo_entidad_id'=>2,'cuit'=>'','area_reparticiones'=>''),
        array('prefijo'=> '032','nombre'=>'Dirección Provincial de Vialidad (DPV)','tipo_entidad_id'=>2,'cuit'=>'','area_reparticiones'=>''),
        array('prefijo'=> '033','nombre'=>'Administración de Obras sanitarias','tipo_entidad_id'=>2,'cuit'=>'','area_reparticiones'=>''),
        array('prefijo'=> '034','nombre'=>'Ente Provincial regulador de la electricidad (EPRE)','tipo_entidad_id'=>2,'cuit'=>'','area_reparticiones'=>''),
        array('prefijo'=> '035','nombre'=>'Instituto de Previsión social (IPS)','tipo_entidad_id'=>2,'cuit'=>'','area_reparticiones'=>''),
        array('prefijo'=> '036','nombre'=>'Instituto de Obra social de Corrientes (IOSCOR)','tipo_entidad_id'=>2,'cuit'=>'','area_reparticiones'=>''),
        array('prefijo'=> '037','nombre'=>'Instituto de Desarrollo rural (ley N° 6.124)','tipo_entidad_id'=>2,'cuit'=>'','area_reparticiones'=>''),
        array('prefijo'=> '038','nombre'=>'Dirección Provincial de Energía de Corrientes (DPEC)','tipo_entidad_id'=>3,'cuit'=>'','area_reparticiones'=>''),
        array('prefijo'=> '039','nombre'=>'Instituto de Fomento empresarial Soc. Econ. Mixta – ley 5864 (IFE)','tipo_entidad_id'=>3,'cuit'=>'','area_reparticiones'=>''),
        array('prefijo'=> '040','nombre'=>'Energía Correntina S.A (ENCOR SA)','tipo_entidad_id'=>3,'cuit'=>'','area_reparticiones'=>''),
        array('prefijo'=> '041','nombre'=>'Sociedad del Estado para la Producción, Fomento e investigación de Cannabis medicinal (SEPROFI)','tipo_entidad_id'=>3,'cuit'=>'','area_reparticiones'=>''),
        array('prefijo'=> '042','nombre'=>'Corrientes Telecomunicaciones (S.A.P.E.M.)','tipo_entidad_id'=>3,'cuit'=>'','area_reparticiones'=>''),
        array('prefijo'=> '043','nombre'=>'Salud Publica – Unidad Ejecutora Provincial (UEP)','tipo_entidad_id'=>4,'cuit'=>'','area_reparticiones'=>''),
        array('prefijo'=> '044','nombre'=>'Salud Publica – Arancelamiento Hospitalario (Ley 3.593)','tipo_entidad_id'=>4,'cuit'=>'','area_reparticiones'=>''),
        array('prefijo'=> '045','nombre'=>'Salud Publica – Obra social de Pensionados (EX – PROFE)','tipo_entidad_id'=>4,'cuit'=>'','area_reparticiones'=>''),
        array('prefijo'=> '046','nombre'=>'Fondo de Desarrollo Rural  (ley 5.552)','tipo_entidad_id'=>4,'cuit'=>'','area_reparticiones'=>''),
        array('prefijo'=> '047','nombre'=>'Fondo Microcréditos (ley 5.574)','tipo_entidad_id'=>4,'cuit'=>'','area_reparticiones'=>''),
        array('prefijo'=> '048','nombre'=>'Fondo Fiduciario Desarrollo de Parques y Zonas Industriales','tipo_entidad_id'=>4,'cuit'=>'','area_reparticiones'=>''),
        array('prefijo'=> '049','nombre'=>'Fondo Fiduciario Foresto Industrial (FFFI)','tipo_entidad_id'=>4,'cuit'=>'','area_reparticiones'=>''),
        array('prefijo'=> '050','nombre'=>'Fondo fiduciario Ganadería (ley 5.835)','tipo_entidad_id'=>4,'cuit'=>'','area_reparticiones'=>''),
        array('prefijo'=> '051','nombre'=>'Ministerio de Seguridad – Fondo especial de Seguridad (FOESE)','tipo_entidad_id'=>4,'cuit'=>'','area_reparticiones'=>''),
        array('prefijo'=> '052','nombre'=>'Mercado de Concentraciones','tipo_entidad_id'=>4,'cuit'=>'','area_reparticiones'=>''),
        array('prefijo'=> '053','nombre'=>'Fondo fiduciario de Desarrollo Industrial (FODIN)','tipo_entidad_id'=>4,'cuit'=>'','area_reparticiones'=>''),
        array('prefijo'=> '054','nombre'=>'Fondo de Inversión para Desarrollo de Corrientes (FIDECOR)','tipo_entidad_id'=>4,'cuit'=>'','area_reparticiones'=>''),
        array('prefijo'=> '055','nombre'=>'Adelanto Ctes. Sociedad de Garantías Reciprocas (Ley 5.675)','tipo_entidad_id'=>4,'cuit'=>'','area_reparticiones'=>'')
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('iniciadores')->delete();
        foreach($this->arrayIniciadores as $iniciador){
            $i = new Iniciador();
            $i->nombre = $iniciador['nombre'];
            $i->id_tipo_entidad = $iniciador['tipo_entidad_id'];
            if ($iniciador['cuit'] != null){
                $i->cuit = $iniciador['cuit'];
            }
            $i->area_reparticiones = $iniciador['area_reparticiones'];
            $i->prefijo = $iniciador['prefijo'];
            $i->save();
        }
    }
}
