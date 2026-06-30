<?php

foreach (App\Models\Employee::all() as $e) {
    echo $e->employee_id . ' - ' . $e->name . ' (' . $e->department . ')' . PHP_EOL;
}
