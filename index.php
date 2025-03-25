<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/main.css">
  <title>Calculator</title>
</head>

<body>
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <input type="number" name="num01" placeholder="Number 1">

    <select name="operator">
      <option value="add">Add</option>
      <option value="subtract">Subtract</option>
      <option value="multiply">Multiply</option>
      <option value="divide">Divide</option>
    </select>

    <input type="number" name="num02" placeholder="Number 2">

    <button type="submit">Calculate</button>
  </form>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num1 = filter_input(INPUT_POST, 'num01', FILTER_SANITIZE_NUMBER_FLOAT);
    $num2 = filter_input(INPUT_POST, 'num02', FILTER_SANITIZE_NUMBER_FLOAT);
    $operator = htmlspecialchars($_POST['operator']);

    $errors = false;

    if (empty($num1) || empty($num2) || empty($operator)) {
      echo "<p class='calc-error'>Please, fill in all fields!</p>";
      $errors = true;
    }

    if (!is_numeric($num1) || !is_numeric($num2)) {
      echo "<p class='calc-error'>Only numbers are allowed!</p>";
      $errors = true;
    }

    if (!$errors) {
      $value;
      switch ($operator) {
        case "add":
          $value = $num1 + $num2;
          break;
        case "subtract":
          $value = $num1 - $num2;
          break;
        case "multiply":
          $value = $num1 * $num2;
          break;
        case "divide":
          $value = $num1 / $num2;
          break;
        default:
          echo "<p class='calc-error'>Something went wrong</p>";
          break;
      }

      echo "<p class='calc-success'>$value</p>";
    }
  }
  ?>
</body>

</html>