@extends('base.base')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card with Switch</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .custom-card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 160px;
            margin: 10px;
            background: #ffffff;
        }

        .custom-card-body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .custom-icon-container {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .custom-icon {
            color: #ccc;
            font-size: 1.5rem;
            margin-right: 10px;
            transition: color 0.4s;
        }

        .custom-icon.on {
            color: #00ff00;
        }

        .custom-card-title {
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .custom-card-text {
            font-size: 1rem;
            font-weight: bold;
            margin: 0;
        }

        .custom-switch-container {
            margin-top: 15px;
        }

        .custom-switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 25px;
        }

        .custom-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .custom-switch-label {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 25px;
        }

        .custom-switch-label:before {
            position: absolute;
            content: "";
            height: 17px;
            width: 17px;
            border-radius: 50%;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
        }

        .custom-switch input:checked+.custom-switch-label {
            background-color: #28a745;
        }

        .custom-switch input:checked+.custom-switch-label:before {
            transform: translateX(24px);
        }

        .card-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }
    </style>
</head>

<body>
    <div class="card-container">
        <div class="custom-card text-center">
            <div class="custom-card-body">
                <div class="custom-icon-container">
                    <i class="fas fa-lightbulb custom-icon" id="icon-1"></i>
                    <div>
                        <h5 class="custom-card-title">Lamp</h5>
                        <p class="custom-card-text">1,0 Kwh</p>
                    </div>
                </div>
                <div class="custom-switch-container">
                    <label class="custom-switch">
                        <input type="checkbox" id="custom-switch-1" onclick="toggleLight(1)">
                        <span class="custom-switch-label"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="custom-card text-center">
            <div class="custom-card-body">
                <div class="custom-icon-container">
                    <i class="fas fa-lightbulb custom-icon" id="icon-2"></i>
                    <div>
                        <h5 class="custom-card-title">Lamp</h5>
                        <p class="custom-card-text">1,0 Kwh</p>
                    </div>
                </div>
                <div class="custom-switch-container">
                    <label class="custom-switch">
                        <input type="checkbox" id="custom-switch-2" onclick="toggleLight(2)">
                        <span class="custom-switch-label"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="custom-card text-center">
            <div class="custom-card-body">
                <div class="custom-icon-container">
                    <i class="fas fa-lightbulb custom-icon" id="icon-3"></i>
                    <div>
                        <h5 class="custom-card-title">Lamp</h5>
                        <p class="custom-card-text">1,0 Kwh</p>
                    </div>
                </div>
                <div class="custom-switch-container">
                    <label class="custom-switch">
                        <input type="checkbox" id="custom-switch-3" onclick="toggleLight(3)">
                        <span class="custom-switch-label"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="custom-card text-center">
            <div class="custom-card-body">
                <div class="custom-icon-container">
                    <i class="fas fa-lightbulb custom-icon" id="icon-4"></i>
                    <div>
                        <h5 class="custom-card-title">Lamp</h5>
                        <p class="custom-card-text">1,0 Kwh</p>
                    </div>
                </div>
                <div class="custom-switch-container">
                    <label class="custom-switch">
                        <input type="checkbox" id="custom-switch-4" onclick="toggleLight(4)">
                        <span class="custom-switch-label"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="custom-card text-center">
            <div class="custom-card-body">
                <div class="custom-icon-container">
                    <i class="fas fa-lightbulb custom-icon" id="icon-5"></i>
                    <div>
                        <h5 class="custom-card-title">Lamp</h5>
                        <p class="custom-card-text">1,0 Kwh</p>
                    </div>
                </div>
                <div class="custom-switch-container">
                    <label class="custom-switch">
                        <input type="checkbox" id="custom-switch-5" onclick="toggleLight(5)">
                        <span class="custom-switch-label"></span>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleLight(id) {
            var switchLabel = document.querySelector('#custom-switch-' + id + ' + .custom-switch-label');
            var icon = document.getElementById('icon-' + id);
            var isChecked = document.getElementById('custom-switch-' + id).checked;
            if (isChecked) {
                switchLabel.style.backgroundColor = '#00ff00';
                icon.classList.add('on');
            } else {
                switchLabel.style.backgroundColor = '#ccc';
                icon.classList.remove('on');
            }
        }
    </script>
</body>

</html>
@endsection
@section('title', 'Room Lights')