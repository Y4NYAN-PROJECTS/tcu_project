<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Template</title>
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

    <hr>

    <small>Equipments Report as of <?= date('m/d/Y') ?></small>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Serial Number</th>
                    <th>Building</th>
                    <th>Room #</th>
                    <th>Equipment</th>
                    <th>Model</th>
                    <th>Color</th>
                    <th>Description</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($equipment_list as $list): ?>
                    <tr>
                        <td><?= htmlspecialchars($list['serial_number']) ?></td>
                        <td><?= htmlspecialchars($list['building']) ?></td>
                        <td><?= htmlspecialchars($list['room_number']) ?></td>
                        <td><?= htmlspecialchars($list['equipment_name']) ?></td>
                        <td><?= htmlspecialchars($list['brand_model']) ?></td>
                        <td><?= htmlspecialchars($list['color']) ?></td>
                        <td><?= htmlspecialchars($list['description']) ?></td>
                        <td><?= htmlspecialchars($list['status']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <p class="footer-text">******* Nothing Follows *******</p>

</body>

</html>