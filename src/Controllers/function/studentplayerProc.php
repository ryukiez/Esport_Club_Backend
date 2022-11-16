<?php 
//FOR ADMIN FUCNYUINON
//get all admin 
function getAllAdmin($db) {

    $sql = 'Select * FROM admin '; 
    $stmt = $db->prepare ($sql); 
    $stmt ->execute(); 
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
} 

//get admin by id 
function getAdmin($db, $adminId) {

    $sql = 'Select a.adminName, a.password, a.email FROM admin a  ';
    $sql .= 'Where a.adminid = :id';
    $stmt = $db->prepare ($sql);
    $id = (int) $adminId;
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 

}

//add new admin 
function createAdmin($db, $form_data) { 
    
    $sql = 'Insert into admin (adminName, password, email)'; 
    $sql .= 'values (:adminName, :password, :email)';  
    $stmt = $db->prepare ($sql); 
    $stmt->bindParam(':adminName', $form_data['adminName']); 
    $stmt->bindParam(':password', $form_data['password']);  
    //$stmt->bindParam(':username', ($form_data['username']));  
    $stmt->bindParam(':email', ($form_data['email']));
    $stmt->execute(); 
    return $db->lastInsertID();
}


//delete admin by id 
function deleteAdmin($db,$adminId) { 

    $sql = ' Delete from admin where adminId = :id';
    $stmt = $db->prepare($sql);  
    $id = (int)$adminId; 
    $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
    $stmt->execute(); 
} 

//update admin by id 
function updateAdmin($db,$form_dat,$adminId) { 

    $sql = 'UPDATE admin SET adminName = :adminName , password = :password ,  email = :email'; 
    $sql .=' WHERE adminId = :id'; 
    $stmt = $db->prepare ($sql); 
    $id = (int)$adminId; 
    $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
    $stmt->bindParam(':adminName', $form_dat['adminName']); 
    $stmt->bindParam(':password', $form_dat['password']); 
    $stmt->bindParam(':email',($form_dat['email']));
    $stmt->execute(); 
}


// FOR student FUNCTION
//get all student 
function getAllStudents($db) {

    
    $sql = 'Select * FROM students '; 
    $stmt = $db->prepare ($sql); 
    $stmt ->execute(); 
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
} 

//get student by id 
function getStudent($db, $studentId) {

    $sql = 'Select o.metric, o.studentName, o.age, o.email, o.programme FROM students o  ';
    $sql .= 'Where o.id = :id';
    $stmt = $db->prepare ($sql);
    $id = (int) $studentId;
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 

}

//add new student
function createStudent($db, $form_data) { 
  
    $sql = 'Insert into students ( metric, studentName, age, email, programme)'; 
    $sql .= 'values (:metric, :studentName, :age, :email, :programme)';  
    $stmt = $db->prepare ($sql); 
    $stmt->bindParam(':metric', $form_data['metric']);  
    $stmt->bindParam(':studentName', ($form_data['studentName']));
    $stmt->bindParam(':age', ($form_data['age']));
    $stmt->bindParam(':email', ($form_data['email']));
    $stmt->bindParam(':programme', ($form_data['programme']));
    $stmt->execute(); 
    return $db->lastInsertID();
}


//delete student by id 
function deleteStudent($db,$studentId) { 

    $sql = ' Delete from students where id = :id';
    $stmt = $db->prepare($sql);  
    $id = (int)$studentId; 
    $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
    $stmt->execute(); 
} 

//update student by id 
function updateStudent($db,$form_dat,$studentId) { 

    
    $sql = 'UPDATE students SET metric = :metric , studentName = :studentName , age = :age , email = :email , programme = :programme'; 
    $sql .=' WHERE id = :id'; 
    $stmt = $db->prepare ($sql); 
    $id = (int)$studentId;  
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':metric', $form_dat['metric']);  
    $stmt->bindParam(':studentName', ($form_dat['studentName']));
    $stmt->bindParam(':age', ($form_dat['age']));
    $stmt->bindParam(':email', ($form_dat['email']));
    $stmt->bindParam(':programme', ($form_dat['programme']));
    $stmt->execute(); 
}