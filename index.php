<?php
include("connection.php");

//===== Task 1 Start =====//
$sqlTask1 = "SELECT Customers.*, COUNT(Orders.order_id) AS total_orders
FROM Customers
LEFT JOIN Orders ON Customers.customer_id = Orders.customer_id
GROUP BY Customers.customer_id
ORDER BY total_orders DESC;";
$taskResult1 = $mysqli->query($sqlTask1);
//===== Task 1 End =====//

//===== Task 2 Start =====//
$sqlTask2 = "SELECT Products.name AS product_name, Order_Items.quantity, (Order_Items.quantity * Order_Items.unit_price) AS total_amount
FROM Order_Items
JOIN Products ON Order_Items.product_id = Products.product_id
ORDER BY Order_Items.order_id ASC;";
$taskResult2 = $mysqli->query($sqlTask2);
//===== Task 2 End =====//

//===== Task 3 Start =====//
$sqlTask3 = "SELECT Categories.name AS category_name, SUM(Order_Items.quantity * Order_Items.unit_price) AS total_revenue
FROM Order_Items
JOIN Products ON Order_Items.product_id = Products.product_id
JOIN Categories ON Products.category_id = Categories.category_id
GROUP BY Categories.category_id
ORDER BY total_revenue DESC;";
$taskResult3 = $mysqli->query($sqlTask3);
//===== Task 3 End =====//

//===== Task 4 Start =====//
$sqlTask4 = "SELECT Customers.name AS customer_name, SUM(Order_Items.quantity * Order_Items.unit_price) AS total_purchase_amount
FROM Customers
JOIN Orders ON Customers.customer_id = Orders.customer_id
JOIN Order_Items ON Orders.order_id = Order_Items.order_id
GROUP BY Customers.customer_id
ORDER BY total_purchase_amount DESC
LIMIT 5;";
$taskResult4 = $mysqli->query($sqlTask4);
//===== Task 4 End =====//
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solving Real-Life Business</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container pt-4">
    <h2 class="text-center pb-4 text-primary">Developed By Tanvir</h2>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active mr-3" aria-current="page" href="#task1" data-toggle="tab">Task 1</a>
        </li>
        <li class="nav-item">
            <a class="nav-link mr-3" href="#task2" data-toggle="tab">Task 2</a>
        </li>
        <li class="nav-item">
            <a class="nav-link mr-3" href="#task3" data-toggle="tab">Task 3</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#task4" data-toggle="tab">Task 4</a>
        </li>
    </ul>

    <div class="card mt-3">
        <div class="tab-content">
            <!-- Task 1 -->
            <div class="tab-pane fade show active" id="task1">
                <p class="text-center p-3"> <b>Task 1</b> <br> <b>Note: </b>Write a SQL query to retrieve all the customer information along with the total number of orders placed by each customer. Display the result in descending order of the number of orders.</p>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col" class='text-center'>CUSTOMER ID</th>
                        <th scope="col" class='text-center'>NAME</th>
                        <th scope="col" class='text-center'>EMAIL</th>
                        <th scope="col" class='text-center'>LOCATION</th>
                        <th scope="col" class='text-center'>TOTAL ORDERS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach($taskResult1 as $item){
                            $id = $item['customer_id'];
                            $name = $item['name'];
                            $email = $item['email'];
                            $location = $item['location'];
                            $total_orders = $item['total_orders'];

                            echo "<tr>
                            <th scope='row' class='text-center'>{$id}</th>
                            <td class='text-center'>{$name}</td>
                            <td class='text-center'>{$email}</td>
                            <td class='text-center'>{$location}</td>
                            <td class='text-center'>{$total_orders}</td>
                            </tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Task 2 -->
            <div class="tab-pane fade" id="task2">
                <p class="text-center p-3"> <b>Task 2</b> <br> <b>Note: </b>Write a SQL query to retrieve the product name, quantity, and total amount for each order item. Display the result in ascending order of the order ID.</p>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col" class='text-center'>PRODUCT NAME</th>
                        <th scope="col" class='text-center'>QUANTITY</th>
                        <th scope="col" class='text-center'>TOTAL AMOUNT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach($taskResult2 as $item){
                            $product_name = $item['product_name'];
                            $quantity = $item['quantity'];
                            $total_amount = $item['total_amount'];

                            echo "<tr>
                            <th scope='row' class='text-center'>{$product_name}</th>
                            <td class='text-center'>{$quantity}</td>
                            <td class='text-center'>{$total_amount}$</td>
                            </tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Task 3 -->
            <div class="tab-pane fade" id="task3">
                <p class="text-center p-3"> <b>Task 3</b> <br> <b>Note: </b>Write a SQL query to retrieve the total revenue generated by each product category. Display the category name along with the total revenue in descending order of the revenue.</p>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col" class='text-center'>CATEGORY NAME</th>
                        <th scope="col" class='text-center'>TOTAL REVENUE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach($taskResult3 as $item){
                            $category_name = $item['category_name'];
                            $total_revenue = $item['total_revenue'];

                            echo "<tr>
                            <th scope='row' class='text-center'>{$category_name}</th>
                            <td class='text-center'>{$total_revenue}$</td>
                            </tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Task 4 -->
            <div class="tab-pane fade" id="task4">
                <p class="text-center p-3"> <b>Task 4</b> <br> <b>Note: </b>Write a SQL query to retrieve the top 5 customers who have made the highest total purchase amount. Display the customer name along with the total purchase amount in descending order of the purchase amount.</p>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col" class='text-center'>CUSTOMER NAME</th>
                        <th scope="col" class='text-center'>TOTAL PURCHASE AMOUNT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach($taskResult4 as $item){
                            $customer_name = $item['customer_name'];
                            $total_purchase_amount = $item['total_purchase_amount'];

                            echo "<tr>
                            <th scope='row' class='text-center'>{$customer_name}</th>
                            <td class='text-center'>{$total_purchase_amount}$</td>
                            </tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div> 
    </div>
</div>
<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>