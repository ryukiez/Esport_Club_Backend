<?php 

use Slim\Http\Request; //namespace 
use Slim\Http\Response; //namespace 

//include adminProc.php file 
include __DIR__ .'/function/studentplayerProc.php';


//alow cors
$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});
//end

//function Access-Control-Allow-Origin untuk connect server to server

//FOR ADMIN
//read table admin 

$app->get('/admin', function (Request $request, Response $response, array $arg){

    return $this->response->withJson(array('data' => 'success'), 200); });  
 
// read all data from table admin 
$app->get('/alladmin',function (Request $request, Response $response,  array $arg) { 

    $data = getAllAdmin($this->db); 
    if (is_null($data)) { 

        return $this->response->withHeader('Access-Control-Allow-Origin', '*')->withJson(array('error' => 'no data'), 404); 
} 
    return $this->response->withJson(array('data' => $data), 200); }); 

//request table admin by condition (cust id) 
$app->get('/admin/[{id}]', function ($request, $response, $args){   
    $adminId = $args['id']; 
    if (!is_numeric($adminId)) { 

        return $this->response->withJson(array('error' => 'numeric paremeter required'), 500);  
} 
    $data = getAdmin($this->db, $adminId); 
    if (empty($data)) { 

        return $this->response->withJson(array('error' => 'no data'), 500); 
} 

return $this->response->withJson(array('data' => $data), 200);});

//post method admin
$app->post('/admin/add', function ($request, $response, $args) { 

    $form_data = $request->getParsedBody(); 
    $data = createAdmin($this->db, $form_data); 
    if (is_null($data)) {

        return $this->response->withJson(array('error' => 'add data fail'), 500);
    }
    return $this->response->withJson(array('add data' => 'success'), 200); 
    }  );


//delete row admin
$app->delete('/admin/del/[{id}]', function ($request, $response, $args){   
    $adminId = $args['id']; 
    
   if (!is_numeric($adminId)) { 

       return $this->response->withJson(array('error' => 'numeric paremeter required'), 422); } 
       $data = deleteAdmin($this->db,$adminId); 
       if (empty($data)) { 

           return $this->response->withJson(array($adminId=> 'is successfully deleted'), 202);}; }); 
 
   
//put table admin 
$app->put('/admin/put/[{id}]', function ($request, $response, $args){
    $adminId = $args['id']; 
    
    if (!is_numeric($adminId)) { 
        
        return $this->response->withJson(array('error' => 'numeric paremeter required'), 422); } 
        $form_dat=$request->getParsedBody(); 
        $data=updateAdmin($this->db,$form_dat,$adminId); if ($data <=0)
        return $this->response->withJson(array('data' => 'successfully updated'), 200); 
});


// FOR STUDENTS

//read table students 
$app->get('/students', function (Request $request, Response $response, array $arg){

    return $this->response->withJson(array('data' => 'success'), 200); });  
 
// read all data from table students 
$app->get('/allstudents',function (Request $request, Response $response,  array $arg) { 

    $data = getAllStudents($this->db); 
    if (is_null($data)) { 

        return $this->response->withHeader('Access-Control-Allow-Origin', '*')->withJson(array('error' => 'no data'), 404); 
} 
    return $this->response->withJson(array('data' => $data), 200); }); 

//request table students by condition (student id) 
$app->get('/students/[{id}]', function ($request, $response, $args){   
    $studentId = $args['id']; 
    if (!is_numeric($studentId)) { 

        return $this->response->withJson(array('error' => 'numeric paremeter required'), 500);  
} 
    $data = getStudent($this->db, $studentId); 
    if (empty($data)) { 

        return $this->response->withJson(array('error' => 'no data'), 500); 
} 

return $this->response->withJson(array('data' => $data), 200);});

//post method students
$app->post('/students/add', function ($request, $response, $args) { 

    $form_data = $request->getParsedBody(); 
    $data = createStudent($this->db, $form_data); 
    if (is_null($data)) { 

        return $this->response->withHeader('Access-Control-Allow-Origin', '*')->withJson(array('error' => 'no data'), 404); 
} 
    return $this->response->withJson(array('data' => $data), 200); }); 


//delete row students
$app->delete('/students/del/[{id}]', function ($request, $response, $args){   
    $studentId = $args['id']; 
    
   if (!is_numeric($studentId)) { 

       return $this->response->withJson(array('error' => 'numeric paremeter required'), 422); } 
       $data = deleteStudent($this->db,$studentId); 
       if (empty($data)) { 

           return $this->response->withJson(array($studentId=> 'is successfully deleted'), 202);}; }); 
 

   
//put table student 
$app->put('/students/put/[{id}]', function ($request, $response, $args){
    $studentId = $args['id']; 
    
    if (!is_numeric($studentId)) { 
        
        return $this->response->withJson(array('error' => 'numeric paremeter required'), 422); } 
        $form_dat=$request->getParsedBody(); 
        $data=updateStudent($this->db,$form_dat,$studentId); 
        if ($data <=0)
        return $this->response->withJson(array('data' => 'successfully updated'), 200); 
});
   