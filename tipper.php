<!DOCTYPE HTML>
<?php error_reporting(E_ALL) ?>
<head>
  <title>Tipper</title>
  <style type="text/css">
  body {
    font: 2.5em "AppleGothic", sans-serif;
    text-align: center;
    background-color: #eee;
  }
  </style>
</head>
<body>
<h1>Tipper</h1>
<form action="tipper.php" method="GET">
  Bill: <input type="text" name="bill" value="<?php echo isset($_GET["bill"]) ?
  $_GET["bill"] : "" ?>" placeholder="How many" maxlength="20"> dollars<br>
  Percent:
  <?php
  for ($i = 0; $i < 3; $i++) {
    $prct = 10 + $i * 5
    ?>
    <input type="radio" name="prct" <?php echo ($_GET["prct"] == $prct) ?
    "checked" : (((isset($_GET["prct"]) || $_GET["prct"] == "")  && $i !== 0) ?
    "unchecked": "checked") ?> value=<?php echo $prct; ?>>
    <?php
    echo $prct . "%";
  }
  ?><br>
  Split: <input type="text" name="splt" value="<?php echo isset($_GET["splt"]) ?
  $_GET["splt"] : "" ?>" placeholder="How many"> people<br>
  <input type="submit" name="sbmt" value="Submit" size=/>
</form><br>
<?php
  if (isset($_GET["bill"]) && isset($_GET["prct"])) {
    $bill = $_GET["bill"];
    $prct = $_GET["prct"];
    if (is_numeric($bill) && is_numeric($prct) && $bill > 0) {
      $tips = $bill * $prct / 100;
      $totl = $tips + $bill;
      $tip1 = number_format($tips, 2);
      $ttl1 = number_format($totl, 2);
      echo "Tip: $" . $tip1;
      echo "<br />\n";
      echo "Total: $" . $ttl1;
      echo "<br />\n";
      if (isset($_GET["splt"]) && $_GET["splt"] != "") {
        $splt = $_GET["splt"];
        if (ctype_digit($splt) && $splt > 1) {
          $itip = number_format($tips/$splt, 2);
          $ittl = number_format($totl/$splt, 2);
          echo "Tip per person: $" . $itip . "<br />\n";
          echo "Total per person: $" . $ittl . "<br />\n";
        } else {
          echo "Invalid Split.";
        }
      }
    } else {
      echo "Invalid Input.";
    }
  }
?>
</body>
</html>
