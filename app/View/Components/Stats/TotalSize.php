<?php

namespace App\View\Components\Stats;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TotalSize extends Component
{
    public function render(): View
    {
        return view('components.stats.total-size', [
            'bytes' => auth()->user()->files()->sum('size'),
        ]);
    }
}
