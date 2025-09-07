<?php

use App\Actions\FileDeleteExpired;
use Illuminate\Support\Facades\Schedule;

Schedule::job(
    new FileDeleteExpired()
)->daily()->onOneServer();
