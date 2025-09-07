<?php

namespace App\View\Components\Stats;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TotalDownloads extends Component
{
    public function render(): View
    {
        return view('components.stats.total-downloads', [
            'count' => auth()->user()->downloads()->count(),
        ]);
    }
}
