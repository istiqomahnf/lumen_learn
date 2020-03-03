<?php
use Illuminate\Http\Request;
use App\Invoice;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

$router->get('/',['middleware'=>'user.sess', 'as'=> 'index', function() use ($router){
    return view('index', ['message' => '']);
}]);
   
    $router->post('register', 'AuthController@register');
    $router->post('login', 'AuthController@login');
    $router->post('logout', 'AuthController@logout');
    $router->post('/signup', 'AuthController@signUp');
    $router->get('/signup', function() use ($router){
        return view('signup');
    });

    $router->get('/article','ArticleController@view');
    $router->group(['middleware'=>'role'], function () use ($router){
        $router->get('/index','ArticleController@index');
        $router->get('/formadd', 'ArticleController@add');
        $router->get('/formad', 'ArticleController@add');
        $router->get('/trash', 'ArticleController@trash');
    });

// API route group
    $router->group(['prefix' => 'api', 'middleware'=>['role','jwt.verify']], function () use ($router) {
        $router->get('profile', 'UserController@profile');
        $router->get('users/{id}', 'UserController@singleUser');
        $router->get('/article','ArticleController@view');
        $router->post('/article', 'ArticleController@create');
        $router->get('/article/{id}', 'ArticleController@getEdit');
        $router->post('/article/{id}', 'ArticleController@send');
        $router->post('/article1', 'ArticleController@update');
        $router->delete('/article/{id}', 'ArticleController@delete');
        $router->post('/search', 'ArticleController@search');
    });

    $router->group(['prefix'=> 'soft', 'middleware'=> 'jwt.verify'], function () use($router){
        $router->post('/article','ArticleController@restore_delete');
        $router->delete('/article/{id}', 'ArticleController@delete_permanent');
    });

    $router->get('/home','ArticleController@userRole');
    $router->get('/refresh','AuthController@refreshToken');
    $router->post('api/task', 'AuthController@storetask');
    $router->post('/articleadd', 'ArticleController@create');
    $router->get('users', 'UserController@allUsers');
    //Invoice Route
    $router->get('/invoice/{status}', 'InvoiceController@index');
    
    $router->get('/invoice/detail/{id}', function($id){
        return view('invoice.detail_invoice', ['inv_id' => $id]);
    });

    $router->group(['prefix'=>'invoice', 'middleware'=> 'jwt.verify'], function()use ($router){
        $router->post('/credit/r', 'InvoiceController@remove_credit');
        $router->post('/payment/{id}', 'InvoiceController@add_payment');
        $router->post('/mark', 'InvoiceController@mark_process');
        $router->delete('/item', 'InvoiceController@delete_item');
        $router->post('/send/{id}', 'InvoiceController@publish_invoice');
        $router->post('/credit', 'InvoiceController@add_credit');
        $router->post('/invoice1/{id}', 'InvoiceController@update');
        $router->post('/detail/{id}', 'InvoiceController@detail_invoice');
    });
    $router->delete('/invoice/{id}', 'InvoiceController@delete_invoice');
    $router->get('/invoice/add/{id}', 'InvoiceController@add_invoice');
    $router->get('/invoice/details/{id}', 'InvoiceController@client_inv_detail');
    $router->post('/invoice/item', 'InvoiceController@create');
    $router->get('/invoice/v2/{id}', 'ClientController@getInvoice');
    $router->post('/invoice/v1/search','InvoiceController@search_invoice');

    $router->get('/transaction/{id}', function($id){
        return view('transaction.add_transaction', ['clientid'=>$id]);
    });
    $router->get('/transaction/client/{id}', function($id){
        return view('transaction.client_transaction', ['clientid'=>$id]);
    });
    $router->get('/transaction/edit/{id}', function($id){
        return view('transaction.edit_transaction');
    });
    $router->post('/transactions', 'TransactionController@add_transaction');
    $router->delete('/transactions/{id}', 'TransactionController@delete_transaction');
    $router->get('/transactions/{id}', 'TransactionController@getTransaction_byId');
    $router->put('/transactions/{id}', 'TransactionController@update');
    $router->get('/transactions/client/{id}', 'TransactionController@fetch_transaction');

    //client
    $router->group(['prefix'=> 'client', 'middleware'=>'jwt.verify'], function () use($router){
        $router->post('/v1', 'ClientController@create');
        $router->post('/v1/{id}', 'ClientController@update');
        $router->get('/v1/{id}', 'ClientController@singleUser');
    });
    $router->post('/client/login/{id}', 'ClientController@login_client');
    $router->post('/client/login1', 'ClientController@login_client');
    $router->get('/client/login', function(){
        return view('client.login_client');
    });
    $router->get('/client/invoices/{id}', 'ClientController@clientinvoice');
    $router->get('/client/add', function(){
        return view('client.add_client');
    });
    $router->get('/client/all', 'ClientController@all');
    $router->get('/clientdetail/{id}', 'ClientController@detail');
    
    $router->get('/client/data/{id}', function($id){
        return view("client.edit_client", ['clientid'=>$id]);
    });
    $router->get('/clientarea/home/{id}', function($id){
        $data['n_invoice']  = Invoice::where('userid', $id)->where('status','=','Unpaid')->get()->count();
        return view('client.home_client', $data);
    });
    $router->get('/client/v2/{id}', function($id){
        $data['paid']       = Invoice::where('userid', $id)->where('status', "Paid")->get()->count();
        $data['unpaid']     = Invoice::where('userid', $id)->where('status', "Unpaid")->get()->count();
        $data['cancelled']  = Invoice::where('userid', $id)->where('status', "Cancelled")->get()->count();
        return view('client.invoice_client', $data);
    });

    $router->get('/client/invoice/v2/{id}', function(){
        return view('client.add_payment');
    });

    $router->get('/mail/send', 'MailController@send_email');
