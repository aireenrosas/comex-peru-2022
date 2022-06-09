<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Conexiones;
use DB;
use Auth;
use App\CompanyItemSearched;
use App\CompanyHomeCategory;
use App\Companies;
use App\JobOpening;
use App\Tag;
use Funciones;
use App;
use App\Article;
use App\ArticleLanguage;
use App\ArticleColumns;
use App\User;
use App\Slider;
use App\Subscriber;
use App\Company;
use App\CompanyType;
use App\Seminar;
use App\SeminarLanguage;
use App\SeminarPresentation;

class migrateController extends Controller
{

    public function getUsersOnline()
    {
      $users = DB::connection('sqlsrv')->select('select * from Usuario order by UsuNCod');

      dd($users);
    }
    public function migrateUsers()
    {
      // $users = DB::connection('sqlsrv')->select('select * from Usuario order by UsuNCod');
      //
      // foreach ($users as $key) {
      //   DB::connection('mysql')->table('users')->insert([
      //       'id' => $key->UsuNCod,
      //       'email' => '',
      //       'login' => $key->UsuSLogin,
      //       'name' => $key->UsuSNom,
      //       'autor' => '',
      //       'password' => $key->UsuSPass,
      //       'state' => $key->Estado,
      //       'rol_id' => $key->Relacion,
      //       'ruc' => $key->RUC,
      //       'test_days' => $key->diasprueba,
      //       'created_at' => $key->fecha,
      //       'updated_at' => date('Y-m-d H:i:s'),
      //       'VeritradePass' => $key->VeritradePass,
      //       'description' => $key->Descripcion
      //   ]);

      // }

      //return 'success';
      }
      public function migrateSubscriberDatacomex()
      {
        // $subs = DB::connection('sqlsrv')->select('select * from SuscripcionDatacomex order by ID_SuscripcionDatacomex');
        // //
        // foreach ($subs as $key) {
        //   DB::connection('mysql')->table('subscription_datacomex')->insert([
        //       'name' => $key->Nombres,
        //       'email' => $key->Email,
        //       'company' => $key->Empresa,
        //       'position' => $key->Cargo,
        //       'phone' => $key->Telefono,
        //       'state' => $key->Estado,
        //       'created_at' => $key->Fecha,
        //       'updated_at' => date('Y-m-d H:i:s')
        //
        //   ]);
        //
        // }
        // return 'exito datasus';
      }
      public function migrateSubscriberSemanario()
      {
        // $subs = DB::connection('sqlsrv')->select('select * from SuscripcionSemanario order by ID_SuscripcionSemanario');
        // //
        // foreach ($subs as $key) {
        //   DB::connection('mysql')->table('subscription_semanario')->insert([
        //       'name' => $key->Nombres,
        //       'email' => $key->Email,
        //       'company' => $key->Empresa,
        //       'position' => $key->Cargo,
        //       'phone' => $key->Telefono,
        //       'state' => $key->Estado,
        //       'created_at' => $key->Fecha,
        //       'updated_at' => date('Y-m-d H:i:s')
        //
        //   ]);
        // }
        // return 'exito semanariosus';
      }
      public function migrateSubscriberNegocios()
      {
        // $subs = DB::connection('sqlsrv')->select('select * from SuscripcionNegocios order by ID_SuscripcionNegocios');
        // //
        // foreach ($subs as $key) {
        //   DB::connection('mysql')->table('subscription_negocios')->insert([
        //       'name' => $key->Nombres,
        //       'institution' => $key->Institucion,
        //       'position' => $key->Cargo,
        //       'address' => $key->Direccion,
        //       'address_institution' => $key->DireccionInstitucion,
        //       'ruc' => $key->RUC,
        //       'phone' => $key->Telefono,
        //       'fax' => $key->Fax,
        //       'email' => $key->Email,
        //       'anual_peru' => $key->AnualPeru,
        //       'anual_latinoamerica' => $key->AnualLatinoamerica,
        //       'anual_continentes' => $key->AnualContinentes,
        //       'semestral_peru' => $key->SemestralPeru,
        //       'semestral_latinoamerica' => $key->SemestralLatinoamerica,
        //       'semestral_continentes' => $key->SemestralContinentes,
        //       'state' => $key->Estado,
        //       'created_at' => $key->Fecha,
        //       'updated_at' => date('Y-m-d H:i:s')
        //
        //   ]);
        // }
      }
      public function migrateComexPeru()
      {
        //ini_set('max_execution_time', 300);

        // $publicacion = DB::connection('sqlsrv')->select('select * from documento where idtipo=2 and iddocumento>=1101 order by iddocumento');
        // //
        // foreach ($publicacion as $key) {
        //
        //   $documentos = DB::connection('sqlsrv')->select('select * from detalle_doc where iddocumento='.$key->iddocumento);
        //
        //   foreach ($documentos as $doc) {
        //     $articulo = new Article();
        //     $articulo->is_open = 1;
        //     $articulo->has_languages = 1;
        //     $articulo->publication_id = 1;
        //     $articulo->edition = $key->publicacion;
        //     $articulo->tema = $doc->tema;
        //     $articulo->observacion = $doc->observacion;
        //     $articulo->published_at = $key->fecha;
        //     $articulo->only_file = 1;
        //     $articulo->save();
        //
        //     $lang = new ArticleLanguage();
        //     $lang->article_id = $articulo->id;
        //     $lang->language_id = 1;
        //     $lang->title = $doc->titulo;
        //     $lang->file = $doc->ruta;
        //     $lang->document = '';
        //     $lang->slug = '';
        //     $lang->save();
        //
        //   }
        //
        // }
        // return 'exito semanario COMEXPERU';
      }
      public function migrateNegocios()
      {
        // ini_set('max_execution_time', 300);
        //
        // $publicacion = DB::connection('sqlsrv')->select('select * from documento where idtipo=3 and iddocumento>=733 order by iddocumento');
        // //
        // foreach ($publicacion as $key) {
        //
        //   $documentos = DB::connection('sqlsrv')->select('select * from detalle_doc where iddocumento='.$key->iddocumento);
        //
        //   foreach ($documentos as $doc) {
        //
        //       $articulo = new Article();
        //       $articulo->is_open = 1;
        //       $articulo->has_languages = 1;
        //       $articulo->publication_id = 2;
        //       $articulo->edition = $key->publicacion;
        //       $articulo->tema = $doc->tema;
        //       $articulo->observacion = $doc->observacion;
        //       $articulo->published_at = $key->fecha;
        //       $articulo->only_file = 1;
        //       $articulo->save();
        //
        //       $lang = new ArticleLanguage();
        //       $lang->article_id = $articulo->id;
        //       $lang->language_id = 1;
        //       $lang->title = $doc->titulo;
        //       $lang->file = $doc->ruta;
        //       $lang->document = '';
        //       $lang->slug = '';
        //       $lang->save();
        //
        //
        //   }
        //
        // }
        // return 'exito negocios';
      }
      public function migrateRevistaComex()
      {
        // ini_set('max_execution_time', 300);
        //
        // $publicacion = DB::connection('sqlsrv')->select('select * from documento where idtipo=3 and iddocumento>=446 and iddocumento<=473 order by iddocumento');
        // //
        // foreach ($publicacion as $key) {
        //
        //   $documentos = DB::connection('sqlsrv')->select('select * from detalle_doc where iddocumento='.$key->iddocumento);
        //
        //   foreach ($documentos as $doc) {
        //     $articulo = new Article();
        //     $articulo->is_open = 1;
        //     $articulo->has_languages = 1;
        //     $articulo->publication_id = 8;
        //     $articulo->edition = $key->publicacion;
        //     $articulo->tema = $doc->tema;
        //     $articulo->observacion = $doc->observacion;
        //     $articulo->published_at = $key->fecha;
        //     $articulo->only_file = 1;
        //     $articulo->save();
        //
        //     $lang = new ArticleLanguage();
        //     $lang->article_id = $articulo->id;
        //     $lang->language_id = 1;
        //     $lang->title = $doc->titulo;
        //     $lang->file = $doc->ruta;
        //     $lang->document = '';
        //     $lang->slug = '';
        //     $lang->save();
        //
        //   }
        //
        // }
        // return 'exito revista comex';
      }
      public function migrateDataComex()
      {
        // ini_set('max_execution_time', 300);
        //
        // $articulo = DB::connection('sqlsrv')->select('select * from Datacomex order by ID_Datacomex');
        // //
        // foreach ($articulo as $key) {
        //
        //     $articulo = new Article();
        //     $articulo->is_open = 1;
        //     $articulo->has_languages = 1;
        //     $articulo->publication_id = 4;
        //     $articulo->edition = $key->Edicion;
        //     $articulo->observacion = $key->Descripcion;
        //     $articulo->published_at = $key->FechaPublicacion;
        //     $articulo->only_file = 1;
        //     $articulo->save();
        //
        //     $lang = new ArticleLanguage();
        //     $lang->article_id = $articulo->id;
        //     $lang->language_id = 1;
        //     $lang->file = $key->Archivo;
        //     $lang->document = '';
        //     $lang->slug = '';
        //     $lang->save();
        //
        // }
        // return 'exito data comex';
      }
      public function migrateAgroComex()
      {
        // ini_set('max_execution_time', 300);
        //
        // $articulo = DB::connection('sqlsrv')->select('select * from Agrocomex order by ID_Agrocomex');
        // //
        // foreach ($articulo as $key) {
        //
        //     $articulo = new Article();
        //     $articulo->is_open = 1;
        //     $articulo->has_languages = 1;
        //     $articulo->publication_id = 4;
        //     $articulo->edition = $key->Edicion;
        //     $articulo->observacion = $key->Descripcion;
        //     $articulo->published_at = $key->FechaPublicacion;
        //     $articulo->only_file = 1;
        //     $articulo->save();
        //
        //     $lang = new ArticleLanguage();
        //     $lang->article_id = $articulo->id;
        //     $lang->language_id = 1;
        //     $lang->file = $key->Archivo;
        //     $lang->document = '';
        //     $lang->slug = '';
        //     $lang->save();
        //
        // }
        // return 'exito agro comex';
      }
      public function migrateMemoria()
      {
        // ini_set('max_execution_time', 300);
        //
        // $articulo = DB::connection('sqlsrv')->select('select * from Memoria order by ID_Memoria');
        // //
        // foreach ($articulo as $key) {
        //
        //     $articulo = new Article();
        //     $articulo->is_open = 1;
        //     $articulo->has_languages = 1;
        //     $articulo->publication_id = 5;
        //     $articulo->observacion = $key->Descripcion;
        //     $articulo->only_file = 1;
        //     $articulo->save();
        //
        //     $lang = new ArticleLanguage();
        //     $lang->article_id = $articulo->id;
        //     $lang->language_id = 1;
        //     $lang->file = $key->Archivo;
        //     $lang->document = '';
        //     $lang->slug = '';
        //     $lang->save();
        //
        // }
        // return 'exito memoria anual';
      }
      public function createDocument()
      {
        // ini_set('max_execution_time', 900);
        // $articles = ArticleLanguage::where('id', '>', 5000)->where('id', '<=', 6000)->get();
        // foreach ($articles as $key) {
        //   $item = ArticleLanguage::find($key->id);
        //   $item->document = Funciones::generateDocumentArticle($key->article_id, 1);
        //   $item->save();
        // }
        // return 'exito';
      }
      public function migrateCompanies()
      {
        // ini_set('max_execution_time', 300);
        // //
        // $empresas = DB::connection('sqlsrv')->select('select * from Empresa order by RUC');
        // //
        // foreach ($empresas as $key) {
        //
        //     $empresa = new Company();
        //     $empresa->RUC = $key->RUC;
        //     $empresa->name = $key->NOMBRE;
        //     $empresa->type = $key->TIPO;
        //     $empresa->save();
        //
        // }
        // return 'exito empresas';
      }
      public function migrateCompaniesType()
      {
        // ini_set('max_execution_time', 300);
        // //
        // $tipos = DB::connection('sqlsrv')->select('select * from Tipo order by Id_Tipo');
        // //
        // foreach ($tipos as $key) {
        //
        //     $tipo = new CompanyType();
        //     $tipo->name = $key->NOMBRE;
        //     $tipo->save();
        //
        // }
        // return 'exito tipos';
      }
      public function encriptpass()
      {
        // ini_set('max_execution_time', 300);
        //
        // $users = User::get();
        //
        // foreach ($users as $user) {
        //   $user1 = User::find($user->id);
        //   $user1->password = bcrypt($user->password);
        //   $user1->save();
        // }
        //
        //
        // return 'cambio existoso';
      }
      public function migrateSeminars()
      {
        // ini_set('max_execution_time', 300);
        // //
        // $seminarios = DB::connection('sqlsrv')->select('select * from documento where idtipo=6 order by iddocumento');
        // //
        // foreach ($seminarios as $key) {
        //
        //   $documentos = DB::connection('sqlsrv')->select('select * from detalle_doc where iddocumento='.$key->iddocumento);
        //
        //   $date = strtotime($key->fecha);
        //   $anio = date('Y', $date);
        //   $mes = date('n',$date);
        //   $dia = date('d',$date);
        //
        //   $seminario = new Seminar();
        //   $seminario->date=$key->fecha;
        //   $seminario->month= $mes;
        //   $seminario->day= $dia;
        //   $seminario->year= $anio;
        //   $seminario->save();
        //
        //   $lang = new SeminarLanguage();
        //   $lang->seminar_id = $seminario->id;
        //   $lang->name = $key->cabecera;
        //   $lang->language_id = 1;
        //   $lang->save();
        //
        //   foreach ($documentos as $doc) {
        //     $item = new SeminarPresentation();
        //     $item->seminar_id = $seminario->id;
        //     $item->title = $doc->titulo;
        //     $item->theme = $doc->tema;
        //     $item->observation = $doc->observacion;
        //     $item->file = $doc->ruta;
        //     $item->save();
        //   }
        //
        // }
        // return 'exito seminarios';
      }
      public function migrateInscription()
      {
        // ini_set('max_execution_time', 300);
        // //
        // $inscription = DB::connection('sqlsrv')->select("select * from InscripcionForo where Fecha >= '2017-01-01' order by ID_InscripcionForo");
        //
        // foreach ($inscription as $key) {
        //   switch ($key->ID_Foro) {
        //     case 1:
        //         $id = 239;
        //       break;
        //     case 2:
        //       $id = 241;
        //       break;
        //     case 3:
        //       $id = 242;
        //       break;
        //     case 4:
        //       $id = 244;
        //       break;
        //     case 5:
        //       $id = 245;
        //       break;
        //     case 7:
        //       $id = 246;
        //       break;
        //     case 8:
        //       $id = 247;
        //       break;
        //     default:
        //       $id = 239;
        //       break;
        //   }
        //
        //
        //    DB::connection('mysql')->table('inscriptions')->insert([
        //         'seminar_id' => $id,
        //        'name' => $key->NombreParticipante,
        //        'lastname' => $key->ApellidoParticipante,
        //        'document_type' => $key->TipoDocumento,
        //        'document' => $key->Documento,
        //        'email' => $key->Email,
        //        'company' => $key->Empresa,
        //        'RUC' => $key->RUC,
        //        'position' => $key->Cargo,
        //        'sector' => $key->Sector,
        //        'address' => $key->Direccion,
        //        'phone' => $key->Telefono,
        //        'fax' => $key->Fax,
        //        'state' => $key->Estado,
        //        'created_at' => $key->Fecha,
        //        'updated_at' => date('Y-m-d H:i:s')
        //
        //    ]);
        // }
      }
      public function migratecolumnasdoc()
      {
        // ini_set('max_execution_time', 300);
        //
        //
        //   $documentos = DB::connection('sqlsrv')->select('select * from detalle_doc where iddetalle>=6000 and iddetalle<7000');
        //
        //   foreach ($documentos as $doc) {
        //
        //       $articulo_language = ArticleLanguage::where('title', '=', $doc->titulo)->first();
        //       if($articulo_language){
        //         $articulo = Article::find($articulo_language->article_id);
        //         $articulo->column_id = $doc->idcolumna;
        //         $articulo->save();
        //       }
        //
        //
        //   }
        //
        // return 'exito columnas doc';
      }
      public function migratecolumns()
      {
        // ini_set('max_execution_time', 300);
        // //
        // $columnas = DB::connection('sqlsrv')->select('select * from Columna_doc order by idcolumna');
        // //
        // foreach ($columnas as $key) {
        //
        //   DB::table('article_columns')->insert(
        //       ['id' => $key->idcolumna, 'name_es' => $key->nombre, 'type_id'=> $key->idtipo]
        //   );
        //
        // }
        // return 'exito columnas';
      }

      public function migrateUsersPassword()
      {
        // $users = DB::connection('sqlsrv')->select('select * from Usuario order by UsuNCod');
        //
        // foreach ($users as $key) {
        //   $user = User::where('login', '=', $key->UsuSLogin)->first();
        //   $user_1 = User::find($user->id);
        //   $user_1->password_no_encriptado = $key->UsuSPass;
        //   $user_1->save();
        //
        // }
        //
        // return 'success';
        }


}
