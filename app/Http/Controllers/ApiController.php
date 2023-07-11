<?php

namespace App\Http\Controllers;

use App\Models\SurveyPositionOnSurvey;
use App\Models\SurveyAnswer;
use App\Models\SurveyExcel;
use Illuminate\Http\Request;
use App\Models\SurveyParticipant;
use App\Models\SurveyPlace;
use App\Models\SurveySurveyOnStudent;  
use App\Models\SurveyQuestion; 
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

 
class ApiController extends Controller
{
    //
    public function consultar($dni)
    {         
        $participante = SurveyParticipant::where("DocumentId", $dni)->first();

        if($participante){
            return response()->json([
                'message' => 'Ya ha sido llenado.',
                'status' => true
            ], 200);
        } 

       

        try{ 

            //PENDIENTE URL 7.50AM 
            // $response = Http::withHeaders([
            //     'Authorization' => 'Bearer 8|eQ5sFCCQzTpCKP9nXS9rYpzeaku0tF7ib2iNbglb',
            // ])->get('https://inscripciones.admision.unap.edu.pe/api/get-ingresante/'.$dni.'/4');

            // // echo $response["status"];
            // $data = json_decode($response); // decodificar data

            // var_dump(  $data->status);

            // return;

            $data = (Object)[ 
                "nombres"=>"Jhon Ariel",
                "segundo_apellido"=>"Cusacani",
                "primer_apellido"=>"Luque",
                "tipo_documento"=>"1",
                "nro_documento"=>"70757838",
                "sexo"=>"1",
                "estado_civil"=>"1",
                "celular"=>"966636182",
                "fecha_nacimiento"=>"2023-06-23",
                "email"=>"jhon@gmail.com",
                "ubigeo_residencia"=>"201201",
                "ubigeo_nacimiento"=>"201201",
                "direccion"=>"JR: MOLLENDO 423",
                "discapacidad"=>"0",
                "pais_nacimiento"=>"9233",
                "nacionalidad"=>"85",
                "codigo_ingreso"=>"230001",
                "codigo_sede_filial"=>"FS01",
                "tipo_proceso"=>"1",
                "proceso_admision"=>"2023-2",
                "codigo_facultad"=>"13",
                "codigo_programa"=>"05"
            ];
        
            
 

                // $data = json_decode($response); // decodificar data
                // $data = $data->data;   

                //cuarta tabla para insertar datos
                $surveyID = "00f8bb07-09ee-11ee-9726-00505689a76b"; //ficha integral del estudiante universitario — 2023-ii
                $topicID = "45e2f071-eeaf-4e37-abfa-61cf8151cdcb";
                $secionID = "e699c0fc-d251-4d48-bd1c-f3743ead11bb";

                SurveyPositionOnSurvey::create([
                    'DocumentId' =>  $data->nro_documento, 
                    'SurveyId' =>  $surveyID, 
                    'TopicId' =>  $topicID, 
                    'SectionId' =>  $secionID
                ]);

                

                $SurveyParticipantModel = new SurveyParticipant();
 
                $SurveyParticipantModel->TypeDocument = $data->tipo_documento;
                $SurveyParticipantModel->DocumentId = $data->nro_documento;
                //$SurveyParticipantModel->AccessWord = "contrasena";
		        $SurveyParticipantModel->AccessWord = hash('sha224', $data->codigo_ingreso);
                $SurveyParticipantModel->Firstname = $data->nombres;
                $SurveyParticipantModel->Lastname = $data->primer_apellido . ' ' . $data->segundo_apellido;
                $SurveyParticipantModel->Condition = '0';
                $SurveyParticipantModel->RequiredPasswordReset = false;
                $SurveyParticipantModel->IsEnabled = true;

                $SurveyParticipantModel->save();

                

                //====================================================
                SurveySurveyOnStudent::create([
                    'SurveyId' =>  $surveyID, 
                    'DocumentId' =>  $data->nro_documento, 
                    'UniversityId' =>  $data->codigo_ingreso, 
                    'AcademicalProgramId' =>  $data->codigo_programa, 
                ]);

                

                //====================================================
                $nombreID = "78ae9492-a909-459f-ba53-15165c884d87";
                $apellidoPaternoID = "d2574937-e2fc-4eb5-b612-d767e3610a04";
                $apellidoMaternoID = "fb5c10df-f60d-4815-a007-a189e879054e";
                $documentoNacionalDeIdentidadID = "e8367e12-f088-4188-bed8-50342bac562c";
                $fechaDeNacimientoID = "c9175462-8e03-47b1-9450-2f126a1655c2";
                $edadID = "de9c81d9-87d5-4cf4-b2f0-5274399ff94c";
                $generoID = "a3056caa-84a9-44a0-9ee5-46a59ad3f073";
                $estadoCivilID = "ab123cd2-c64d-44d2-8023-af2849bf6f9d";
                $númeroCelularEstudianteID = "bd4313bd-1709-4bfd-8fae-bfe2eb6e5d05";
                $númeroCelularDeUnFamiliarCercanoID = "654a124d-93e4-4a1b-84e2-4e189fb4a0dc";
                $correoElectrónicoPersonalID = "2cb7930e-344f-4371-a2d1-da1579bfe33e";

                $lugarDeNacimientoID = "16373178-2cb7-4a9e-be10-33d1145fcb48";
                $lugarDeProcedenciaID = "43a68e1c-8e59-4ff0-a6d4-60ca9bd27065";
                $lugarDeResidenciaID = "b37c3cce-8d8a-45e3-90bd-59e0bcb9cccb";
                $presentaAlgunaDiscapacidadID = "85c4a938-b006-45a8-bdbd-1c4223656ab6";
                $acreditadoPorConadisID = "4fa928ec-da05-4658-bf7b-a4017e92bb37";
                $elNivelDeGravedadDeDiscapacidadID = "6aec5365-4a8e-42a4-977c-8dc5f1831da0";
                $tipoDeDiscapacidadID = "58544127-d5a9-430b-a3be-b52bd656ec60";
                $codigoDeMatriculaID = "50af5759-8009-4419-bfc2-8df851be62b1";
                $facultadID = "4d36be9a-1567-4d80-a726-a5a1bc2a33c7";
                $programaAcademicoDeEstudiosID = "36f9a47d-457d-4052-ab25-47b4decb887f";
                $cicloDeEstudiosID = "574ba955-5176-4997-8e34-42524cafa862";
                $correoElectronicoInstitucionalID = "6bc3b523-2a89-423d-99bf-53692c004633";
 

                SurveyAnswer::create([
                    'DocumentId' =>  $data->nro_documento,  
                    'QuestionId' => $nombreID,
                    'ResponseText' => $data->nombres,
                ]);  
                

                SurveyAnswer::create([
                    'DocumentId' =>  $data->nro_documento, 
                    'QuestionId' => $apellidoPaternoID,
                    'ResponseText' => $data->primer_apellido  ,
                ]);
                
                SurveyAnswer::create([
                    'DocumentId' =>  $data->nro_documento, 
                    'QuestionId' => $apellidoMaternoID,
                    'ResponseText' => $data->segundo_apellido,
                ]);
    
                
                SurveyAnswer::create([
                    'DocumentId' =>  $data->nro_documento, 
                    'QuestionId' => $documentoNacionalDeIdentidadID,
                    'ResponseText' => $data->nro_documento  ,
                ]);
                
                SurveyAnswer::create([
                    'DocumentId' =>  $data->nro_documento, 
                    'QuestionId' => $fechaDeNacimientoID,
                    'ResponseText' => $data->fecha_nacimiento  ,
                ]);
                
                SurveyAnswer::create([
                    'DocumentId' =>  $data->nro_documento, 
                    'QuestionId' => $edadID,
                    'ResponseText' => Carbon::createFromDate($data->fecha_nacimiento)->age  ,
                ]);
                

                $masculinoID = "b460a70cb10ebc";
                $femeninoID = "0340b0cc9631b5";
                $otroID = "05dd401e2d1ef6";

                if($data->sexo == 1){
                    $genero = $masculinoID;
                }elseif($data->sexo == 2){
                    $genero = $femeninoID;
                }else{
                    $genero = $otroID;
                }

                SurveyAnswer::create([
                    'DocumentId' =>  $data->nro_documento, 
                    'QuestionId' => $generoID,
                    'ResponseOptions' => $genero, //enviar palabra, no array no json
                    'ResponseText' => "",
                ]);

                $estado_civilID="";
                $casadoID = "52e57eb60d862e";
                $divorciadoID = "fdc8dcc8fd1c09"; 
                $viudoID = "4e3e896d692095";
                $convivienteID = "a36b95b806227b";
                $otrosID = "23fc2b37f2704c"; 

                switch ($data->estado_civil) {
                    
                    case 1:
                        //soltero
                        $estado_civilID = $convivienteID;
                        break;
                    case 2:
                        //casado
                        $estado_civilID = $casadoID;
                        break;
                    case 3:
                        //viudo
                        $estado_civilID = $viudoID;
                        break;
                    case 4:
                        // divorciado
                        $estado_civilID = $divorciadoID;
                        break;
                    case "conviviente":
                        // conviviente
                        $estado_civilID = $convivienteID;
                        break;
                    case "otros":
                        // otros
                        $estado_civilID = $otrosID;
                        break;
                    default:
                        $estado_civilID = $otrosID;
                        break;

                }
            
                SurveyAnswer::create([
                    'DocumentId' =>  $data->nro_documento, 
                    'QuestionId' => $estadoCivilID,
                    'ResponseOptions' => $estado_civilID, //enviar palabra, no array no json
                    'ResponseText' => "" ,
                ]);
                
                SurveyAnswer::create([
                    'DocumentId' => $data->nro_documento, 
                    'QuestionId' => $númeroCelularEstudianteID,
                    'ResponseText' => $data->celular 
                ]);
                
                SurveyAnswer::create([
                    'DocumentId' => $data->nro_documento, 
                    'QuestionId' => $númeroCelularDeUnFamiliarCercanoID,
                    'ResponseText' => ""  ,
                ]);
                
                SurveyAnswer::create([
                    'DocumentId' =>  $data->nro_documento, 
                    'QuestionId' => $correoElectrónicoPersonalID,
                    'ResponseText' => $data->email  ,
                ]); 

                //===============================================================
                
                SurveyAnswer::create([
                    'DocumentId' =>  $data->nro_documento,  
                    'QuestionId' => $lugarDeNacimientoID,
                    'ResponseText' => $data->ubigeo_nacimiento,
                ]);  

                SurveyAnswer::create([
                    'DocumentId' =>  $data->nro_documento,  
                    'QuestionId' => $lugarDeProcedenciaID,
                    'ResponseText' => "",
                ]);  

                // 1 SI 83d29c04cf307a
                // 0 NO efd2f964007efc
                if($data->discapacidad == 1){
                    $discapcidad = '83d29c04cf307a';
                }elseif($data->discapacidad == 0){
                    $discapcidad = 'efd2f964007efc';
                } 
                SurveyAnswer::create([
                    'DocumentId' =>  $data->nro_documento,  
                    'QuestionId' => $presentaAlgunaDiscapacidadID,
                    'ResponseOptions' => $discapcidad,
                    'ResponseText' => "",
                ]);

                SurveyAnswer::create([
                    'DocumentId' =>  $data->nro_documento,  
                    'QuestionId' => $lugarDeResidenciaID,
                    'ResponseText' => $data->ubigeo_residencia.'%%%'.$data->direccion,
                ]);  
                
                // 1 SI eaf5219bec02e8
                // 0 NO 3c75d6906ff658
                if($data->discapacidad == 1){
                    $conadis = 'eaf5219bec02e8';
                }elseif($data->discapacidad == 0){
                    $conadis = '3c75d6906ff658';
                }  
                SurveyAnswer::create([
                    'DocumentId' => $data->nro_documento,  
                    'QuestionId' => $acreditadoPorConadisID,
                    'ResponseOptions' => $conadis,
                ]);  

                SurveyAnswer::create([
                    'DocumentId' =>  $data->nro_documento,  
                    'QuestionId' => $elNivelDeGravedadDeDiscapacidadID,
                    'ResponseText' => "",
                ]);  

                SurveyAnswer::create([
                    'DocumentId' =>  $data->nro_documento,  
                    'QuestionId' => $tipoDeDiscapacidadID,
                    'ResponseText' => "",
                ]);  

                SurveyAnswer::create([
                    'DocumentId' =>  $data->nro_documento,  
                    'QuestionId' => $codigoDeMatriculaID,
                    'ResponseText' => $data->codigo_ingreso,
                ]);               

                SurveyAnswer::create([
                    'DocumentId' =>  $data->nro_documento,  
                    'QuestionId' => $facultadID,
                    'ResponseText' => '0'.$data->codigo_facultad,
                ]);

                SurveyAnswer::create([
                    'DocumentId' =>  $data->nro_documento,  
                    'QuestionId' => $programaAcademicoDeEstudiosID,
                    'ResponseText' => $data->codigo_programa,
                ]);

                SurveyAnswer::create([
                    'DocumentId' =>  $data->nro_documento,  
                    'QuestionId' => $cicloDeEstudiosID,
                    'ResponseText' => "1",
                ]);

                SurveyAnswer::create([
                    'DocumentId' =>  $data->nro_documento,  
                    'QuestionId' => $correoElectronicoInstitucionalID,
                    'ResponseText' => "",
                ]);  

                //===============================================================

             

        }catch (\Exception $e) {
            // Manejo de la excepción
            return response()->json([
                'message' => 'Ha ocurrido un error (try catch). '.$e->getMessage(),
                'status' => false,
                'error' => $e->getMessage()
            ], 500);
        }

        return response()->json([
            'message' => "Se ha concluido exitosamente",
            'status' => true,
        ]);

    }
    
    
    public function introducir (){ 
        $participantes = SurveyExcel::all(); 

        // return response()->json([
        //     'message' => $participantes,
        //     'status' => true,
        // ]);
        // return;

        $nombreID = "78ae9492-a909-459f-ba53-15165c884d87";
        $apellidoPaternoID = "d2574937-e2fc-4eb5-b612-d767e3610a04";
        $apellidoMaternoID = "fb5c10df-f60d-4815-a007-a189e879054e";
        $documentoNacionalDeIdentidadID = "e8367e12-f088-4188-bed8-50342bac562c";
        $fechaDeNacimientoID = "c9175462-8e03-47b1-9450-2f126a1655c2";
        $edadID = "de9c81d9-87d5-4cf4-b2f0-5274399ff94c";
        $generoID = "a3056caa-84a9-44a0-9ee5-46a59ad3f073";
        $estadoCivilID = "ab123cd2-c64d-44d2-8023-af2849bf6f9d";
        $númeroCelularEstudianteID = "bd4313bd-1709-4bfd-8fae-bfe2eb6e5d05";
        $númeroCelularDeUnFamiliarCercanoID = "654a124d-93e4-4a1b-84e2-4e189fb4a0dc";
        $correoElectrónicoPersonalID = "2cb7930e-344f-4371-a2d1-da1579bfe33e";

        $lugarDeNacimientoID = "16373178-2cb7-4a9e-be10-33d1145fcb48";
        $lugarDeProcedenciaID = "43a68e1c-8e59-4ff0-a6d4-60ca9bd27065";
        $lugarDeResidenciaID = "b37c3cce-8d8a-45e3-90bd-59e0bcb9cccb";
        $presentaAlgunaDiscapacidadID = "85c4a938-b006-45a8-bdbd-1c4223656ab6";
        $acreditadoPorConadisID = "4fa928ec-da05-4658-bf7b-a4017e92bb37";
        $elNivelDeGravedadDeDiscapacidadID = "6aec5365-4a8e-42a4-977c-8dc5f1831da0";
        $tipoDeDiscapacidadID = "58544127-d5a9-430b-a3be-b52bd656ec60";
        $codigoDeMatriculaID = "50af5759-8009-4419-bfc2-8df851be62b1";
        $facultadID = "4d36be9a-1567-4d80-a726-a5a1bc2a33c7";
        $programaAcademicoDeEstudiosID = "36f9a47d-457d-4052-ab25-47b4decb887f";
        $cicloDeEstudiosID = "574ba955-5176-4997-8e34-42524cafa862";
        $correoElectronicoInstitucionalID = "6bc3b523-2a89-423d-99bf-53692c004633";


        foreach ($participantes as $data) {
            
            // return response()->json([
            //         'message' => $facultades,
            //         'status' => true,
            //     ]);
            //     return;

            // $places = SurveyPlace::where("Region", "LIKE", '%'.$data->departamento.'%')
            // ->where("Department", "LIKE", '%'.$data->departamento.'%')
            // ->where("Province", "LIKE", '%'.$data->departamento.'%')
            // ->where("District", "LIKE", '%'.$data->district.'%')->first(); 
            
            //  return response()->json([
            //     'message' => $places->Id,
            //     'status' => true,
            // ]);
            // return; 
                
            
                $SurveyParticipantModel = new SurveyParticipant();

                // echo var_dump($data->data->nro_documento);
                // return;
                
                $SurveyParticipantModel->TypeDocument = "1";
                $SurveyParticipantModel->DocumentId = $data->dni;
                // $SurveyParticipantModel->AccessWord = "contrasena";
                $SurveyParticipantModel->AccessWord = hash('sha224', $data->codigo_matricula);
                $SurveyParticipantModel->Firstname = $data->nombre;
                $SurveyParticipantModel->Lastname = $data->paterno . ' ' . $data->materno;
                $SurveyParticipantModel->Condition = '0';
                $SurveyParticipantModel->RequiredPasswordReset = false;
                $SurveyParticipantModel->IsEnabled = true;

                $SurveyParticipantModel->save();


                //cuarta tabla para insertar datos
                $surveyID = "00f8bb07-09ee-11ee-9726-00505689a76b"; //ficha integral del estudiante universitario — 2023-ii
                $topicID = "45e2f071-eeaf-4e37-abfa-61cf8151cdcb";
                $secionID = "e699c0fc-d251-4d48-bd1c-f3743ead11bb";

                $surveypositiononsurvey = SurveyPositionOnSurvey::where("DocumentId", $data->dni)->first();
                if(is_null($surveypositiononsurvey)){
                    
                    SurveyPositionOnSurvey::create([
                        'DocumentId' =>  $data->dni, 
                        'SurveyId' =>  $surveyID, 
                        'TopicId' =>  $topicID, 
                        'SectionId' =>  $secionID
                    ]);
                } 


                $surveysurveyonstudent = SurveySurveyOnStudent::where("DocumentId", $data->dni)->first();
                //====================================================
                if(is_null($surveysurveyonstudent)){
                    SurveySurveyOnStudent::create([
                        'SurveyId' =>  $surveyID, 
                        'DocumentId' =>  $data->dni, 
                        'UniversityId' =>  $data->codigo_matricula, 
                        'AcademicalProgramId' =>  $data->escuela_profesional, 
                    ]);
                }

                //====================================================
                SurveyAnswer::create([
                    'DocumentId' =>  $data->dni,  
                    'QuestionId' => $nombreID,
                    'ResponseText' => $data->nombre,
                ]);  

                SurveyAnswer::create([
                    'DocumentId' =>  $data->dni, 
                    'QuestionId' => $apellidoPaternoID,
                    'ResponseText' => $data->paterno  ,
                ]);
                
                SurveyAnswer::create([
                    'DocumentId' =>  $data->dni, 
                    'QuestionId' => $apellidoMaternoID,
                    'ResponseText' => $data->materno,
                ]);    
                
                SurveyAnswer::create([
                    'DocumentId' =>  $data->dni, 
                    'QuestionId' => $documentoNacionalDeIdentidadID,
                    'ResponseText' => $data->dni  ,
                ]);
                
                SurveyAnswer::create([
                    'DocumentId' =>  $data->dni, 
                    'QuestionId' => $fechaDeNacimientoID,
                    'ResponseText' => ""  ,
                ]);
                
                SurveyAnswer::create([
                    'DocumentId' =>  $data->dni, 
                    'QuestionId' => $edadID,
                    'ResponseText' => $data->edad  ,
                ]);

                $masculinoID = 'b460a70cb10ebc';
                $femeninoID = '0340b0cc9631b5';
                $otroID = '05dd401e2d1ef6';

                if($data->sexo == "1"){
                    $genero = $masculinoID;
                }elseif($data->sexo == "2"){
                    $genero = $femeninoID;
                }else{
                    $genero = $otroID;
                }
                SurveyAnswer::create([
                    'DocumentId' =>  $data->dni, 
                    'QuestionId' => $generoID,
                    'ResponseOptions' => $genero
                ]);

                $estado_civilID="";
                $casadoID = "52e57eb60d862e";
                $divorciadoID = "fdc8dcc8fd1c09"; 
                $viudoID = "4e3e896d692095";
                $convivienteID = "a36b95b806227b";
                $otrosID = "23fc2b37f2704c"; 

                // switch ($data->estado_civil) {
                    
                //     case 1:
                //         //soltero
                //         $estado_civilID = $convivienteID;
                //         break;
                //     case 2:
                //         //casado
                //         $estado_civilID = $casadoID;
                //         break;
                //     case 3:
                //         //viudo
                //         $estado_civilID = $viudoID;
                //         break;
                //     case 4:
                //         // divorciado
                //         $estado_civilID = $divorciadoID;
                //         break;
                //     case "conviviente":
                //         // conviviente
                //         $estado_civilID = $convivienteID;
                //         break;
                //     case "otros":
                //         // otros
                //         $estado_civilID = $otrosID;
                //         break;
                //     default:
                //         $estado_civilID = $otrosID;
                //         break;
                // }
            
                SurveyAnswer::create([
                    'DocumentId' =>  $data->dni, 
                    'QuestionId' => $estadoCivilID,
                    // 'ResponseOption' => json_encode($estado_civilID),
                    'ResponseOption' => "",
                    'ResponseText' => "" ,
                ]);
                
                SurveyAnswer::create([
                    'DocumentId' => $data->dni, 
                    'QuestionId' => $númeroCelularEstudianteID,
                    'ResponseText' => "" 
                ]);
                
                SurveyAnswer::create([
                    'DocumentId' =>  $data->dni, 
                    'QuestionId' => $númeroCelularDeUnFamiliarCercanoID,
                    'ResponseText' => ""  ,
                ]);
                
                SurveyAnswer::create([
                    'DocumentId' =>  $data->dni, 
                    'QuestionId' => $correoElectrónicoPersonalID,
                    'ResponseText' => ""  ,
                ]); 

                //===============================================================

                // Conversion de nombre de lugar a ubigeo unico.
                $ubigeoNacimiento = SurveyPlace::where("Region", "LIKE", '%'.$data->departamento.'%')
                ->where("Department", "LIKE", '%'.$data->departamento.'%')
                ->where("Province", "LIKE", '%'.$data->departamento.'%')
                ->where("District", "LIKE", '%'.$data->district.'%')->first(); 

                
                SurveyAnswer::create([
                    'DocumentId' =>  $data->dni,  
                    'QuestionId' => $lugarDeNacimientoID,
                    'ResponseText' => $ubigeoNacimiento ? $ubigeoNacimiento->Id : null,
                ]);  

                SurveyAnswer::create([
                    'DocumentId' =>  $data->dni,  
                    'QuestionId' => $lugarDeProcedenciaID,
                    // 'ResponseText' => $data->ubigeo_nacimiento,
                ]);  

                // 0 NO
                // 1 SI 
                SurveyAnswer::create([
                    'DocumentId' =>  $data->dni,  
                    'QuestionId' => $presentaAlgunaDiscapacidadID,
                    'ResponseText' => "",
                ]);  

                SurveyAnswer::create([
                    'DocumentId' =>  $data->dni,  
                    'QuestionId' => $lugarDeResidenciaID,
                    'ResponseText' => "",
                ]);  
                
                // 0 NO
                // 1 SI 
                SurveyAnswer::create([
                    'DocumentId' =>  $data->dni,  
                    'QuestionId' => $acreditadoPorConadisID,
                    'ResponseText' => "",
                ]);  

                SurveyAnswer::create([
                    'DocumentId' =>  $data->dni,  
                    'QuestionId' => $elNivelDeGravedadDeDiscapacidadID,
                    'ResponseText' => "",
                ]);  

                SurveyAnswer::create([
                    'DocumentId' =>  $data->dni,  
                    'QuestionId' => $tipoDeDiscapacidadID,
                    'ResponseText' => "",
                ]);  
                
                //-----------------------------------------------------------------------------------------------------
                SurveyAnswer::create([
                    'DocumentId' =>  $data->dni,  
                    'QuestionId' => $codigoDeMatriculaID,
                    'ResponseText' => $data->codigo_matricula,
                ]);

                $responseFacultad = Http::get('http://38.43.133.27/SURVEY_FACULTIES/v1/_/');
                
                $IDFACULTAD = "";
                if ($responseFacultad->successful()) {
                    // Request was successful
                    $facultades = json_decode($responseFacultad, true); // decodificar 

                    foreach ($facultades as $facultad) {
                        // $cadena = "El nombre de la provincia es: '". $facultad['id'] ."', y su puntuación es: ". $facultad['title'] ."},";
                        if ( $facultad['title'] == $data->facultad )
                        {
                            $IDFACULTAD = $facultad['id'];
                            break;
                        }                        
                     }                    
                }

                SurveyAnswer::create([
                    'DocumentId' =>  $data->dni,  
                    'QuestionId' => $facultadID,
                    'ResponseText' => $IDFACULTAD,
                ]);

                SurveyAnswer::create([
                    'DocumentId' =>  $data->dni,  
                    'QuestionId' => $programaAcademicoDeEstudiosID,
                    // 'ResponseText' => $data->codigo_programa,
                ]);

                SurveyAnswer::create([
                    'DocumentId' =>  $data->dni,  
                    'QuestionId' => $cicloDeEstudiosID,
                    'ResponseText' => $data->ciclo,
                ]);

                SurveyAnswer::create([
                    'DocumentId' =>  $data->dni,  
                    'QuestionId' => $correoElectronicoInstitucionalID,
                    'ResponseText' => "",
                ]);  

                //===============================================================
             
        }

        return response()->json([
            'message' => "Se ha concluido exitosamente.",
            'status' => true,
        ]); 
    }

}
