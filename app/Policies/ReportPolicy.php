<?php

namespace App\Policies;

use App\Models\Report;
use App\Models\User;

class ReportPolicy
{
    public function create(User $user)
    {
        return $user->role == '0' || $user->role == '1' || $user->role == '2';
    }

    public function update(User $user, Report $report)
    {
        if ($user->role == '0' || $user->role == '1') {
            return true;
        }
    
        if ($user->role == '2' && $report->status == 'Processing') {
            return true;
        }
    
        return false;
    }

    public function delete(User $user, Report $report)
    {
        return $user->role == '0';
    }
}
