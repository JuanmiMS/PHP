<?php

function time_counter($funcion, $parametro)
{
    $time_start = microtime(true);

    $funcion($parametro);

    $time_end = microtime(true);
    $time = $time_end - $time_start;

    echo "La función $funcion ha tardado $time en completarse" . "<br>";
    echo "<br>";
}

function quick_sort($arr)
{
    if (count($arr) <= 1) {
        return $arr;
    } else {
        $pivot = $arr[0];
        $left = array();
        $right = array();
        for ($i = 1; $i < count($arr); $i++) {
            if ($arr[$i] < $pivot) {
                $left[] = $arr[$i];
            } else {
                $right[] = $arr[$i];
            }
        }
        return array_merge(quick_sort($left), array($pivot), quick_sort($right));
    }
}

function bubble_sort($arr)
{
    $size = count($arr) - 1;
    for ($i = 0; $i < $size; $i++) {
        for ($j = 0; $j < $size - $i; $j++) {
            $k = $j + 1;
            if ($arr[$k] < $arr[$j]) {
                list($arr[$j], $arr[$k]) = array($arr[$k], $arr[$j]);
            }
        }
    }
    return $arr;
}

function direct_insertion($A)
{
    $n = sizeof($A);

    for ($i = 1; $i < $n; $i++) {
        $v = $A[$i];
        $j = $i - 1;
        while ($j >= 0 && $A[$j] > $v) {
            $A[$j + 1] = $A[$j];
            $j--;
        }

        $A[$j + 1] = $v;
    }

    return $A;
}

function binary_insertion($A)
{
    $n = sizeof($A);
    for ($i = 1; $i < $n; $i++) {
        $aux = $A[$i];
        $izq = 0;
        $der = $i - 1;

        while ($izq <= $der) {
            $m = (($izq + $der) / 2);
            if ($aux < $A[$m])
                $der = $m - 1;
            else
                $izq = $m + 1;
        }
        $j = $i - 1;

        while ($j >= $izq) {
            $A[$j + 1] = $A[$j];
            $j = $j - 1;
        }
        $A[$izq] = $aux;
    }

    return $A;
}

function selection_sort($A)
{
    $n = sizeof($A);

    for ($i = 0; $i < $n - 1; $i++) {
        $min = $i;
        for ($j = $i + 1; $j < $n; $j++)
            if ($A[$min] > $A[$j])
                $min = $j;
        $aux = $A[$min];
        $A[$min] = $A[$i];
        $A[$i] = $aux;
    }
    return $A;
}

function show_manual()
{
    //Datos introducidos manualmente
    echo "Datos introducido: " . $_POST['manual'] . "<br><br>";
    $unsorted = explode(", ", $_POST['manual']);
    time_counter($_POST['select'], $unsorted);
    print_r($_POST['select']($unsorted));

}

function show_random()
{
    $random_number_array = range(0, $_POST['random']);
    shuffle($random_number_array);
    $random_number_array = array_slice($random_number_array, 0, $_POST['random']);
    print_r($random_number_array);
    echo "<br><br>";
    time_counter($_POST['select'], $random_number_array);
    print_r($_POST['select']($random_number_array));
}

function show_file()
{
    echo "No hecho";
}

function show_predeterminated()
{
    $det = array(5, 2, 6, 1, 5, 9, 11, 94, 72, 36);
    echo "Datos introducido: " . $_POST['predeter'] . "<br><br>";
    time_counter($_POST['select'], $det);
    print_r($_POST['select']($det));
}

?>
<html>
<head>
    <title>Algoritmos Ordenacion</title>
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".selectBox").click(function () {
            $("#manualDivForm").hide();
            $("#fileDivForm").hide();
            $("#randomDivForm").hide();
            $("#predDivForm").hide();
            $("#" + $(this).attr("id") + "Form").show();
        });
    });
</script>

<style>
    html,
    body {
        height: 100%;
    }

    * {
        margin: 0;
        padding: 0;
    }

    #container {
        background-color: #ffe6ce;
        border-radius: 10px;
        padding: 5px;
        display: block;
        margin: 0 auto;
        border-width: 1px;
        border-color: black;
        border-style: solid;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .selectBox {
        width: 150px;
        height: 150px;
        background-color: aqua;
        border-radius: 5px;
        border-color: black;
        margin: 5px;
        float: left;
        text-align: center;
        vertical-align: middle;
    }

    .selectBox:hover {
        background-color: azure;
        cursor: pointer;
    }

    #fileDivForm, #randomDivForm, #predDivForm {
        display: none;
    }

    .btn-primary {
        width: 40%;
        margin-left: 30%;
        margin-right: 30%;
    }
</style>
<body>
<div id="container">

    <!--Select sort form-->
    <div id="selectBoxes">
        <div class="selectBox manualDiv" id="manualDiv">Introducir números manualmente</div>
        <div class="selectBox fileDiv" id="fileDiv">Agregar archivo</div>
        <div class="selectBox randomDiv" id="randomDiv">Generador random</div>
        <div class="selectBox predDiv" id="predDiv">Matriz predeterminada</div>
    </div>

    <div id="forms">
        <!--Number manual input-->
        <form action="orden.php" method="post" id="manualDivForm" enctype="multipart/form-data">
            <div class="form-group">
                <select class="form-control" name="select">
                    <option>quick_sort</option>
                    <option>bubble_sort</option>
                    <option>direct_insertion</option>
                    <option>binary_insertion</option>
                    <option>selection_sort</option>
                </select>
            </div>

            <div class="form-group manualDiv box">
                <label>Introduzca los números separados por comas</label>
                <input class="form-control" name="manual" placeholder="1, 3, 55, 2, 3, 4">
            </div>

            <button type="submit" class="btn btn-primary mb-2">Ordenar</button>
        </form>

        <!--File input-->
        <form action="orden.php" method="post" id="fileDivForm" enctype="multipart/form-data">
            <div class="form-group">
                <select class="form-control" name="select">
                    <option>quick_sort</option>
                    <option>bubble_sort</option>
                    <option>direct_insertion</option>
                    <option>binary_insertion</option>
                    <option>selection_sort</option>
                </select>
            </div>

            <div class="form-group fileDiv box">
                <label for="exampleInputFile">Introduzca el archivo con números</label>
                <input type="file" class="form-control-file" id="fileToUpload" name="fileToUpload"
                       aria-describedby="fileHelp">
                <small id="fileHelp" class="form-text text-muted">El archivo debe ser *.txt</small>
            </div>

            <button type="submit" class="btn btn-primary mb-2">Ordenar</button>
        </form>

        <!--Random numbers -->
        <form action="orden.php" method="post" id="randomDivForm" enctype="multipart/form-data">
            <div class="form-group">
                <select class="form-control" name="select">
                    <option>quick_sort</option>
                    <option>bubble_sort</option>
                    <option>direct_insertion</option>
                    <option>binary_insertion</option>
                    <option>selection_sort</option>
                </select>
            </div>

            <div class="randomDiv box">
                <label>Introduzca la cantidad de números aleatorios a generar</label>
                <input class="form-control" name="random" placeholder="7">
            </div>

            <button type="submit" class="btn btn-primary mb-2">Ordenar</button>
        </form>

        <!--Matriz predeterminada-->
        <form action="orden.php" method="post" id="predDivForm" enctype="multipart/form-data">
            <div class="form-group">
                <select class="form-control" name="select">
                    <option>quick_sort</option>
                    <option>bubble_sort</option>
                    <option>direct_insertion</option>
                    <option>binary_insertion</option>
                    <option>selection_sort</option>
                </select>
            </div>

            <div name="predeter" class="predDiv box">
                Números predeterminados: 5, 2, 6, 1, 5, 9, 11, 94, 72, 36
            </div>
            <input class="form-control" style="display: none" name="predeter">


            <button type="submit" class="btn btn-primary mb-2">Ordenar</button>
        </form>
    </div>

    <div id="resultado">
        <?php

        if (isset($_POST['manual'])) {
            show_manual();
        }


        //Datos introducidos mediante archivo
        if (isset($_POST['inputfile'])) {
            echo "No hecho";
        }

        //Generar array random
        if (isset($_POST['random'])) {
            show_random();
        }

        if (isset($_POST['predeter'])) {
            show_predeterminated();
        }
        ?>
    </div>
</div>
</body>

</html>