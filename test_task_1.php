<?php

// Исправьте ошибки в приведенном ниже коде. Ваш исправленный код должен корректно выполнять поставленные задачи

/**
* Вычисляет логарифм
*/
function calculateFactorial(int $number): int {
  if ($number === 0) {
    return 1;
  }
  
  return (int)($number * calculateFactorial($number - 1));
}

/**
 * Проверяет, является ли число простым
 */
function isPrime(int $num): int {
  if ($num <= 1) {
    return false;
  }
  for ($i = 2; $i * $i <= $num; $i++) {
    if ($num % $i === 0) {
      return false;
    }
  }
  return true;
}

echo "Введите число: ";
$number = (int)readline();

if ($number < 0) {
  echo "\$nubmer не может быть меньше 0 \n";
  exit;
}

echo "Факториал $number is: " . calculateFactorial($number) . "\n";

if (isPrime($number)) {
  echo "$number - это простое число.\n";
} else {
  echo "$number - это не простое число.\n";
}

?>
