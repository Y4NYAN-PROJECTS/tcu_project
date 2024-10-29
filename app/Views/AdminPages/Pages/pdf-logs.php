<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logs - <?= $date ?></title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h5,
        .header h1,
        .header small {
            margin: 0;
            padding: 0;
        }

        hr {
            border: none;
            border-top: 1px solid black;
            margin: 10px 0;
        }

        h4 {
            text-align: center;
            margin: 10px 0;
        }

        .table-container {
            width: 100%;
            overflow-x: auto;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            text-align: left;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #555;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .footer-text {
            text-align: center;
            margin-top: 15px;
            font-style: italic;
            color: #555;
        }
    </style>
</head>

<body>

    <div class="header">
        <h5>Republic of the Philippines</h5>
        <h1>TAGUIG CITY UNIVERSITY</h1>
        <small>Gen. Santos Ave. Central Bicutan, Taguig City</small><br>
        <small>http://www.tcu.edu.ph | Telefax: 8635-8300</small>
    </div>

    <hr style="margin-bottom: 20px;">

    <small>Log Records as of <strong><?= $date ?></strong></small>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Time In</th>
                    <th>Time Out</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($logs as $log): ?>
                    <tr>
                        <td><?= $log['full_name'] ?></td>
                        <td><?= (new DateTime($log['date_created']))->format('F j, Y') ?></td>
                        <td><?= (new DateTime($log['time_in']))->format('g:i A') ?></td>
                        <td><?= (new DateTime($log['time_out']))->format('g:i A') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <p class="footer-text">******* Nothing Follows *******</p>

</body>

</html>