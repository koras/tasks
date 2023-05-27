<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

/**
 * Задача от Руслана Хасанова
 * https://www.youtube.com/live/T2XOf1K_YHo?feature=share&t=3560
 *
 * @koras
 *
 */

class Shop
{
    /**
     * @param array $packages - какие объёмы упаковок бывают
     * @param int $items - сколько продуктов хочет купить клиент
     */
    function __construct(array $packages, int $items)
    {
        $this->getBox($packages, $items);
    }

    /**
     *
     * $result array - current result
     * $leftover int - как много на текущий момент остатков
     * $package пакеты
     */
    private function calculate(array &$result, int &$leftover, int $package)
    {
        $boxing = $leftover / $package;
        if ((int)$boxing > 0) {
            // только при положительном результате сохраняем уппаковку
            $result[$package] = (int)$boxing;
        }
        $leftover -= (((int)$boxing) * $package);
    }


    private function getBox(array $packages, int $items)
    {
        echo "Клиент хочет купить $items бутылок <br/>";
        $result = [];
        // сортируем для удобного перебора элементов. На вход мы можем получить в разном порядке элементы
        rsort($packages);

        foreach ($packages as $value) {
            // Подбираем упаковки по остаткам
            $this->calculate($result, $items, $value);
        }
        if ($items > 0 && count($result) > 0) {
            echo "Клиент получит<br/>";
            print_r($result);
            foreach ($result as $box => $value) {
                echo "$value упаковок(у/и) в котором $box бутылок. <br/>";
            }
        } else {
            echo "Клиент не сможет купить ничего<br/>";
        }
        echo "<br/><br/> ";
    }
}

new Shop([3, 6, 20], 0);
new Shop([3, 6, 20], 5); // Array ( [3] => 1 )
new Shop([3, 6, 20], 10); // Array ( [6] => 1 [3] => 1 )
new Shop([3, 20, 6], 30); // Array ( [20] => 1 [6] => 1 [3] => 1 )

/*
Клиент хочет купить 0 бутылок
Клиент не сможет купить ничего


Клиент хочет купить 5 бутылок
Клиент получит
Array ( [3] => 1 ) 1 упаковок(у/и) в котором 3 бутылок.


Клиент хочет купить 10 бутылок
Клиент получит
Array ( [6] => 1 [3] => 1 ) 1 упаковок(у/и) в котором 6 бутылок.
1 упаковок(у/и) в котором 3 бутылок.


Клиент хочет купить 30 бутылок
Клиент получит
Array ( [20] => 1 [6] => 1 [3] => 1 ) 1 упаковок(у/и) в котором 20 бутылок.
1 упаковок(у/и) в котором 6 бутылок.
1 упаковок(у/и) в котором 3 бутылок.
*/