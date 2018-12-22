<?php

namespace App\Service;

use App\Utils\RR\HTMLParseHelper as Parser;

/**
 * Class DepartmentRequestEntity
 * @package App
 * @property int buildings = 0
 * @property int gold = 0
 * @property int oil = 0
 * @property int ore = 0
 * @property int diamonds = 0
 * @property int uranium = 0
 * @property int oxygen = 0
 * @property int helium = 0
 * @property int army = 0
 * @property int space = 0
 * @property int ships = 0
 */
class DepartmentRequestEntity {

    const DEPARTMENTS = ['buildings', 'gold', 'oil', 'ore', 'diamonds',
        'uranium', 'oxygen', 'helium', 'army', 'space', 'ships'];

    public function __construct(array $options = []) {
        try {
            $documentation = (new \ReflectionClass(static::class))->getDocComment();
            $properties = Parser::findAll('/@property int (\w+)/', $documentation, true)[1];
            foreach ($properties as $property)
                $this->$property = key_exists($property, $options) ? $options[$property] : 0;
        } catch (\ReflectionException $e) {/*STUB: never happen*/}
    }

    public function __set(string $name, int $value) {
        if ($value <= (10 - $this->count()))
            $this->$name = $value;
    }

    private function count(): int {
        return $this->buildings + $this->gold + $this->ore + $this->diamonds + $this->uranium + $this->oxygen
            + $this->helium + $this->army + $this->space + $this->ships;
    }

    public function toString(array $order): string {
        $result = '';
        foreach ($order as $value)
            $result .= '"w' . $value . '": ' . $this->{static::DEPARTMENTS[intval($value) - 1]} . ', ';
        return substr($result, 0, strlen($result) - 2);
    }
}