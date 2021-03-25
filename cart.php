<?php
    include('common/connection.php');
    session_start();
    // unset($_SESSION['order_details']);

    $order_details = isset($_SESSION['order_details']) ? $_SESSION['order_details'] : array();

    if(isset($_POST['action']) && $_POST['action'] == 'showCart'){ // The goal is to show cartItems
        echo json_encode($order_details);
    }else if(isset($_POST['action']) && $_POST['action'] == 'deleteItem'){ // Delete existing cart item
        foreach($order_details as $order){
            if(array_key_exists($_POST['ref'], $order)){
                unset($order_details[key($order)][$newRef]);
            }
        }
        unset($_SESSION['order_details']);
        $_SESSION['order_details'] = $order_details;
        echo json_encode($order_details);
    } else if(isset($_POST['action']) && $_POST['action'] == 'makePurchase'){
        // Validation de la commande
        unset($_SESSION['order_details']);
        echo json_encode(count($order_details));
    }else{
        if(isset($_POST['ref'])){
            $newRef = trim($_POST['ref']);
            $found = false;
            // foreach($order_details as $order){
            //     if(array_key_exists($newRef, $order)){
            //         $found = true;
            //         $order_details[key($order_details)][$newRef]['quantity'] += 1;
            //     }
            // }

            if(!$found){
                $newOrder = array(
                    $newRef => array(
                                        "name" => $_POST['name'],
                                        "price" => floatval($_POST['price']), 
                                        "image" => $_POST['image'],
                                        "quantity" => 1
                                    )
                );
                array_push($order_details, $newOrder);
            }
            $_SESSION['order_details'] = $order_details;
        }
        echo json_encode(count($order_details)); // count number of items in the cart
    }
    
?>