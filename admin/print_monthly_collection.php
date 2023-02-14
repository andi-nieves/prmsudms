<?php
require_once('../config.php');
$month = $_GET['month'] ?? date("Y-m");
$collections = $dbhelper->query("SELECT 
p.*, 
s.code,
CONCAT(s.lastname, ', ', s.firstname, ' ', SUBSTR(s.middlename, 1,1), '.' ) as name,
CONCAT(d.name, ' - ', r.name) as dorm
FROM payment_list as p 
    INNER JOIN student_list as s ON p.account_id = s.id 
    INNER JOIN account_list as a ON s.id = a.student_id 
    INNER JOIN room_list as r ON r.id = a.room_id 
    INNER JOIN dorm_list as d ON r.dorm_id = d.id
    WHERE p.month_of =:month", array(':month' => $month));
$total = array_sum(array_column($collections, 'amount'));
$name = $dbhelper->get_user_meta($_SESSION['id'], 'first_name'). ' '.$dbhelper->get_user_meta($_SESSION['id'], 'middle_name').' '.$dbhelper->get_user_meta($_SESSION['id'], 'last_name')
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRMSU Dorm Monthly Report - Print View - <?= $month ?>
    </title>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
            color: #333;
            font-size: 12px;
        }
        html, body {
            margin: 0;
            padding: 0;
        }
        body {
            background-color: rgba(50, 50, 50, 0.05);
        }
        .wrapper {
            max-width: 1000px;
            margin: auto;
            background-color: #FFF;
            min-height: 100vh;
            padding: 10px 20px;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            border-radius: 15px;
            border-collapse: collapse;
            border: #9e9e9e solid 1px;
        }

        .table th:not(:last-child),
        table.dataTable td:not(:last-child) {
            border-right: #9e9e9e solid 1px;
        }

        table th {
            padding: 10px;
        }

        table td {
            padding: 5px;
        }

        table tr td:not(:last-child) {
            border-right: #9e9e9e solid 1px !important;
        }

        table tr:not(:last-child) td {
            border-bottom: #9e9e9e solid 1px !important;
        }

        table thead tr {
            border-bottom: #9e9e9e solid 2px !important;
        }

        table tr:not(:last-child) td {
            border-bottom: #9e9e9e solid 1px !important;
        }

        table thead tr {
            border-bottom: #9e9e9e solid 2px !important;
        }

        table th:nth-last-child(-n + 2) {
            max-width: 80px !important;
        }

        table tfoot {
            border-top: #9e9e9e solid 2px !important;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <p class="text-center">
            Republic of the Philippines<br />
            <b>PRESIDENT RAMON MAGSAYSAY STATE UNIVERSITY</b><br />
            Dorm Collection Office<br />
            Iba, Zambales
        </p>
        <p>Month of <?= date('F Y', strtotime($month)) ?></p>
        </p>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Student</th>
                    <th>Account Code</th>
                    <th>Dorm</th>
                    <th>Date Created</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($collections as $key => $collection): ?>
                <tr>
                    <td>
                        <?=++$key ?>
                    </td>
                    <td>
                        <?= $collection->name ?>
                    </td>
                    <td>
                        <?= $collection->code ?>
                    </td>
                    <td>
                        <?= $collection->dorm ?>
                    </td>
                    <td>
                        <?= $collection->date_created ?>
                    </td>
                    <td>
                        <?= $collection->amount ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <th class="py-1 text-right" style="padding: 10px !important;" colspan="5">Total Collections</th>
                <th class="py-1 text-left">
                    <?= number_format($total, 2) ?>
                </th>
            </tfoot>
        </table>

        <p>Prepared by: <br/><br/> <?= $name ?></p>
    </div>

</body>

</html>