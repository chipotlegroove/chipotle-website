<?php

use App\Console\Commands\DeleteCommentEmailCommand;
use Illuminate\Support\Facades\Schedule;

Schedule::call(DeleteCommentEmailCommand::class)->daily();
