<?php

namespace App\View\Components\Stats;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TotalFiles extends Component
{
    public function render(): View
    {
        return view('components.stats.total-files', [
            'count' => auth()->user()->files()->count(),
        ]);
    }
}
