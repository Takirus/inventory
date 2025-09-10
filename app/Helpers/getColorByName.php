<?php

namespace App\Helpers;

class getColorByName {
    public static function getColor($color) {
        $colors = [
            'primary',
            'secondary',
            'info',
            'success',
            'danger',
            'dark',
            'warning',
        ];

        return in_array($color,$colors) ? $color : 'dark';
    }

}