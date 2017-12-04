<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
| example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
| https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
| $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
| $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
| $route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples: my-controller/index -> my_controller/index
|   my-controller/my-method -> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

/*
| -------------------------------------------------------------------------
| Sample REST API Routes
| -------------------------------------------------------------------------
*/
$route['templates/(:any)'] = "/templates/$1/#";
$route['locatarios/listar'] = "Locatario/index";
$route['locatarios/atualizar']['put'] = "Locatario/put";
$route['locatarios/cadastrar']['post'] = "Locatario/post";
$route['locatarios/remover']['delete'] = "Locatario/delete";

$route['estadoscivis/listar'] = "EstadoCivil/index";
$route['imoveis/listar'] = "Imovel/index";
$route['tipoimoveis/listar'] = "TipoImovel/index";
$route['tipodespesas/listar'] = "TipoDespesa/index";

$route['contratos/cadastrar']['post'] = "Contrato/post";
$route['contratos/atualizar']['put'] = "Contrato/put";
$route['contratos/remover']['delete'] = "Contrato/delete";
$route['contratos/listar'] = "Contrato/index";
$route['contratos/getContratosVigentes'] = "Contrato/getContratosVigentes";

$route['imoveis/cadastrar']['post'] = "Imovel/post";
$route['imoveis/atualizar']['put'] = "Imovel/put";
$route['imoveis/remover']['delete'] = "Imovel/delete";
$route['imoveis/listar'] = "Imovel/index";

$route['despesas/cadastrar']['post'] = "Despesa/post";
$route['despesas/atualizar']['put'] = "Despesa/put";
$route['despesas/remover']['delete'] = "Despesa/delete";
$route['despesas/listar'] = "Despesa/index";

$route['pagamento/cadastrar']['post'] = "Pagamento/post";
$route['pagamento/atualizar']['put'] = "Pagamento/put";
$route['pagamento/remover']['delete'] = "Pagamento/delete";
$route['pagamento/listar'] = "Pagamento/index";

$route['alugueis/getAlugueisMes'] = "Aluguel/getAlugueisMes";
$route['alugueis/getAlugueisAtrasados'] = "Aluguel/getAlugueisAtrasados";
$route['alugueis/listar'] = "Aluguel/index";

$route['renovacao/getContratosVencidos'] = "Renovacao/index";
$route['renovacao/renovar'] = "Renovacao/post";
$route['renovacao/naoRenovar'] = "Renovacao/put";

$route['login/autenticar'] = "Login/post";
//$route['impressao/imprimir'] = "Impressao/imprimir";