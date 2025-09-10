<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class StatusEntity implements ValidationRule
{
    protected string $table;
    protected string $column;
    protected string $expected;

    public function __construct(string $table, string $column, mixed $expected)
    {
        $this->table = $table;
        $this->column = $column;
        $this->expected = $expected;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $record = DB::table($this->table)->find($value);

        if(!$record || $record->{$this->column} !== $this->expected){
            $fail('Выбранный статус {$attribute} не валидный!');
        }
    }
}
