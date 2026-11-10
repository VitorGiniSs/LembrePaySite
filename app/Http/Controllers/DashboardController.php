<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        $userBills = auth()->user()->bills();

        $totalBills = (clone $userBills)->count();

        $paidCount = (clone $userBills)
            ->where('status', 'paid')
            ->count();

        $pendingCount = (clone $userBills)
            ->where('status', 'pending')
            ->count();

        $overdueCount = (clone $userBills)
            ->where('status', '!=', 'paid')
            ->whereDate('due_date', '<', today())
            ->count();

        $pendingAmount = (clone $userBills)
            ->where('status', 'pending')
            ->sum('amount');

    $upcomingBills = (clone $userBills)
    ->where('status', 'pending')
    ->orderBy('due_date')
    ->limit(5)
    ->get();

        $activeRecurrences = auth()->user()
            ->recurrences()
            ->where('is_active', true)
            ->count();

        return view('welcome', compact(
            'totalBills',
            'paidCount',
            'pendingCount',
            'overdueCount',
            'pendingAmount',
            'upcomingBills',
            'activeRecurrences'
        ));
    }
}
