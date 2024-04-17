<?php

namespace App\Livewire\Back\Summary;

use App\Models\User;
use Livewire\Component;
use Carbon\Carbon;
class Index extends Component
{
    public $usersWithLoginCounts;
    public $users;
    public $user_id;
    public function mount()
    {
        $this->users = User::orderBy('last_name')->get();
        $this->usersWithLoginCounts = User::withCount([
            'userLogins',
            'userLogins as logins_today' => function ($query) {
                $query->whereDate('login_at', Carbon::today());
            },
            'userLogins as logins_this_week' => function ($query) {
                $query->whereBetween('login_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            },
            'userLogins as logins_this_month' => function ($query) {
                $query->whereMonth('login_at', Carbon::now()->month);
            },
            'userLogins as total_logins',
        ])->get();
    }
    public function updatedUserId($id)
    {
        if ($id) {
            $this->usersWithLoginCounts = User::where('id', $id)
                ->withCount([
                    'userLogins',
                    'userLogins as logins_today' => function ($query) {
                        $query->whereDate('login_at', Carbon::today());
                    },
                    'userLogins as logins_this_week' => function ($query) {
                        $query->whereBetween('login_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                    },
                    'userLogins as logins_this_month' => function ($query) {
                        $query->whereMonth('login_at', Carbon::now()->month);
                    },
                    'userLogins as total_logins',
                ])
                ->get();
        } else {
            $this->usersWithLoginCounts = User::withCount([
                'userLogins',
                'userLogins as logins_today' => function ($query) {
                    $query->whereDate('login_at', Carbon::today());
                },
                'userLogins as logins_this_week' => function ($query) {
                    $query->whereBetween('login_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                },
                'userLogins as logins_this_month' => function ($query) {
                    $query->whereMonth('login_at', Carbon::now()->month);
                },
                'userLogins as total_logins',
            ])->get();
        }
    }
    public function render()
    {
        return view('livewire.back.summary.index');
    }
}
