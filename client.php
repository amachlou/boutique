<?php
    include('common/connection.php');
    session_start();

    $order_details = isset($_SESSION['order_details']) ? $_SESSION['order_details'] : array();

    switch($_POST['action']){
        case 'signin':
            $sql = "SELECT * FROM clients WHERE email='".$_POST['email']."' and password='".$_POST['password']."'";
            
            if($pdo->query($sql)){
                $_SESSION['client'] = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
                echo json_encode(array("status" => "OK", "user" => $_SESSION['client']));
            }else{
                echo json_encode(array("status" => "KO", "message" => "Incorrect username or password!"));
            }
        break;
        case 'register':
                try{
                    $sql = "INSERT INTO clients (id_client,first_name,last_name,email,`password`,`address`,phone,birth_day) VALUES (NULL,?,?,?,?,?,?,?)";
                    $stmtProd = $pdo->prepare($sql);
                    $stmtProd->execute(array($_POST['first_name'],$_POST['last_name'],$_POST['email'],$_POST['password'],$_POST['address'],$_POST['phone'],$_POST['birth_day']));
                    
                    $sql = "SELECT * FROM clients WHERE id_client=".$pdo->lastInsertId();
                    $_SESSION['client'] = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
                    header("Location: index.php");
                }catch( PDOException $Exception ) {
                    throw new MyDatabaseException( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
                }
        break;
        case 'getClientSession':
            if(isset($_SESSION['client'])){
                echo json_encode($_SESSION['client']);
            }else{
                echo json_encode('KO');
            }
        break;
        case 'signout':
            unset($_SESSION['client']);
            echo json_encode('KO');
        break;
    }
?>