<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/pics/logo/logobg.png" type="image/x-icon">
    <title>SECURE GATE</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }

        h1 {
            margin-bottom: 20px;
            color: #333;
        }

        .button-container {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: center;
            width: 50%;
        }

        .btn {
            padding: 15px 30px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        /* Responsive design */
        @media (max-width: 600px) {
            .btn {
                width: 100%;
                text-align: center;
                margin: 5px 0;
            }
        }
    </style>
</head>
<body>

    <h1>SECURE GATE</h1>

    <div class="button-container">
        <a href="sgadmin/index.php" class="btn">Admin</a>
        <a href="resident/index.php" class="btn">Resident</a>
        <a href="gatekeeper/index.php" class="btn">Gatekeeper</a>
    </div>

</body>
</html>
