<?php

namespace App\Livewire\Back\Summary;

use App\Models\User;
use Livewire\Component;
use Carbon\Carbon;

class Index extends Component
{
    public $usersWithLoginTimes;
    public $users;
    public $user_id;

    public function mount()
    {
        $this->fetchUsersWithLoginTimes();
    }

    public function updatedUserId($id)
    {
        if ($id == null) {
            $this->fetchUsersWithLoginTimes();
        } else {
            $this->fetchUserWithLoginTimes($id);
        }
    }

    private function fetchUsersWithLoginTimes()
    {
        $this->users = User::orderBy('last_name')->get();
        $this->usersWithLoginTimes = collect();

        foreach ($this->users as $user) {
            $this->calculateLoginTimes($user);
        }
    }

    private function fetchUserWithLoginTimes($id)
    {
        $user = User::findOrFail($id);
        $this->usersWithLoginTimes = collect();
        $this->calculateLoginTimes($user);
    }

    private function calculateLoginTimes($user)
    {
        $totalLoginTime = $user->userLogins->sum('duration');
        $loginsToday = $user->userLogins->where('login_at', '>=', Carbon::today())->sum('duration');
        $loginsThisWeek = $user->userLogins->whereBetween('login_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('duration');
        $loginsThisMonth = $user->userLogins()->whereMonth('login_at', Carbon::now()->month)->get()->sum('duration');

        $this->usersWithLoginTimes->push([
            'user' => $user,
            'total_login_time' => $totalLoginTime,
            'login_time_today' => $loginsToday,
            'login_time_this_week' => $loginsThisWeek,
            'login_time_this_month' => $loginsThisMonth,
        ]);
    }

    public function render()
    {
        return view('livewire.back.summary.index', [
            'usersWithLoginTimes' => $this->usersWithLoginTimes,
            'users' => $this->users
        ]);
    }
}
