<?php

function time_counter($funcion, $parametro){
    $time_start = microtime(true);
    
    $funcion($parametro);

    $time_end = microtime(true);
    $time = $time_end - $time_start;

    echo "la función $funcion ha tardado $time en completarse";
    echo "<br>";
}

function quick_sort($arr)
{
    if(count($arr) <= 1){
        return $arr;
    }
    else{
        $pivot = $arr[0];
        $left = array();
        $right = array();
        for($i = 1; $i < count($arr); $i++)
        {
            if($arr[$i] < $pivot){
                $left[] = $arr[$i];
            }
            else{
                $right[] = $arr[$i];
            }
        }
        return array_merge(quick_sort($left), array($pivot), quick_sort($right));
    }
}
function bubble_sort($arr) {
    $size = count($arr)-1;
    for ($i=0; $i<$size; $i++) {
        for ($j=0; $j<$size-$i; $j++) {
            $k = $j+1;
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

        for ($i = 1; $i < $n; $i++)
        {
                 $v = $A[$i];
                 $j = $i - 1;
                 while ($j >= 0 && $A[$j] > $v)
                 {
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
        for($i=1;$i<$n;$i++)
        {
            $aux = $A[$i];
            $izq=0;
            $der=$i-1;

            while($izq<=$der)
            {
                $m=(($izq+$der)/2);
                if ($aux<$A[$m])
                    $der=$m-1;
                else
                    $izq=$m+1;
            }
            $j=$i-1;

            while($j>=$izq)
            {
                $A[$j+1]=$A[$j];
                $j=$j-1;
            }
            $A[$izq]=$aux;
        }

    return $A;
}
function selectionsort($A)
    {
    $n = sizeof($A);

        for ($i=0; $i<$n-1; $i++)
	{
              $min=$i;
              for($j=$i+1; $j<$n; $j++)
                    if($A[$min] > $A[$j])
                       $min=$j;
              $aux=$A[$min];
              $A[$min]=$A[$i];
              $A[$i]=$aux ;
        }

      return $A;
    }
    $unsorted = array(5, 3, 8, 6, 2, 7, 9, 8);
echo implode(",",$unsorted)." unsorted<br>";
echo "<br>";
//time_counter('quick_sort',$unsorted);
//time_counter('bubble_sort',$unsorted);
//time_counter('direct_insertion',$unsorted);
//time_counter('binary_insertion',$unsorted);
//time_counter('selectionsort',$unsorted);


if(isset($_POST['select'])){
    time_counter($_POST['select'], $unsorted);
}

?>

<html>
<head>
    <title>Algoritmos Ordenacion</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
</style>

</head>
<body>
<div id="container">
<!--Number input-->
<form action="orden.php" method="post" style="width: 500px;">
  <div class="form-group">
    <label for="exampleFormControlInput1">Introducir manualmente address</label>
    <input class="form-control" name="manual" placeholder="1, 3, 5, 2, 3, 4">
  </div>

<!--File input-->
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
  </div>
  <div class="custom-file">
    <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
    <label class="custom-file-label" for="inputGroupFile01">Selecciona archivo</label>
  </div>
</div>

  <div class="form-group">
    <label for="exampleFormControlSelect1">select</label>
    <select class="form-control" name="select">
      <option>quick_sort</option>
      <option>bubble_sort</option>
      <option>direct_insertion</option>
      <option>binary_insertion</option>
      <option>selectionsort</option>
    </select>
  </div>

  <button type="submit" class="btn btn-primary mb-2">Ordenar</button>
</form>
</div>
</body>

</html>