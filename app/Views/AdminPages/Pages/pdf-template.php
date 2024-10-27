<!DOCTYPE html>
<html>

<head>

    <title>PDF Template</title>
    <style>
        .header {
            margin-bottom: 20px;
            /* Adjust the margin as needed */
            overflow: hidden;
            /* Clearfix */
        }

        .logo {
            float: left;
            /* Align the logo to the left */
        }

        .logo img {
            max-width: 100px;
            height: 100px;
            display: block;
        }

        .centered-text {
            text-align: center;
            margin: 0;
            display: inline-block;
            vertical-align: middle;
        }

        .header:after {
            content: "";
            display: table;
            clear: both;
        }

        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 4px;
            font-family: 'Poppins';
        }

        th {
            background-color: #f2f2f2;
            /* Add background color to table header */
            font-family: 'Poppins';
        }

        .list-group-item-action:hover {
            background-color: #f5f5f5;
            /* Add hover effect */
        }

        .margin {
            margin-top: 2;
            margin-bottom: 2;
            font-family: 'Poppins';
        }
    </style>
</head>

<body>

    <div class="header">
        <!-- <div class="logo">
        <img src="/assets/img/icons/tupt-logo.png" alt=""/>
    </div> -->
        <div style="text-align: center;">
            <h4 class="margin">Republic of the Philippines</h4>
            <h4 class="margin">TAGUIG CITY UNIVERSITY</h4>
            <p class="margin">Gen. Santos Ave. Central Bicutan, Taguig City</p>
            <p class="margin">http: www.tcu.edu.ph Telefax: 8635-8300</p>
        </div>
    </div>
    <hr style="margin-bottom: 2;">
    <h4 style="text-align: center; font-family: 'Poppins';"> TAGUIG CITY UNIVERSITY EQUIPMENT LIST</h4>

    <div class="card mt-2">
        <div class="table-responsive text-nowrap list-group-item-action">
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
                        <tr class="list-group-item-action">
                            <td style="text-align: center;"><?= $list['serial_number'] ?></td>
                            <td style="text-align: center;"><?= $list['building'] ?></td>
                            <td style="text-align: center;"><?= $list['room_number'] ?></td>
                            <td style="text-align: center;"><?= $list['equipment_name'] ?></td>
                            <td style="text-align: center;"><?= $list['brand_model'] ?></td>
                            <td style="text-align: center;"><?= $list['color'] ?></td>
                            <td style="text-align: center;"><?= $list['description'] ?></td>
                            <td style="text-align: center;"><?= $list['status'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p style="text-align: center;"> ******* Nothing Follows ******* </p>
        </div>
    </div>
                                                                                                                                                                   
</body>

</html>