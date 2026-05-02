@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page_title', 'Dashboard Admin')

@section('content')
<div class="space-y-8">
    <!-- Statistics Cards -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
        <div class="card !p-6 border-b-4 border-blue-500 shadow-sm hover:shadow-md transition-shadow">
            <h4 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Total</h4>
            <div class="text-3xl font-bold text-black tracking-tight">{{ $stats['total'] }}</div>
        </div>
        <div class="card !p-6 border-b-4 border-orange-500 shadow-sm hover:shadow-md transition-shadow">
            <h4 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">New</h4>
            <div class="text-3xl font-bold text-black tracking-tight">{{ $stats['new'] }}</div>
        </div>
        <div class="card !p-6 border-b-4 border-blue-400 shadow-sm hover:shadow-md transition-shadow">
            <h4 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">On Progress</h4>
            <div class="text-3xl font-bold text-black tracking-tight">{{ $stats['progress'] }}</div>
        </div>
        <div class="card !p-6 border-b-4 border-green-500 shadow-sm hover:shadow-md transition-shadow">
            <h4 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Done</h4>
            <div class="text-3xl font-bold text-black tracking-tight">{{ $stats['done'] }}</div>
        </div>
        <div class="card !p-6 border-b-4 border-red-500 shadow-sm hover:shadow-md transition-shadow">
            <h4 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Cancel</h4>
            <div class="text-3xl font-bold text-black tracking-tight">{{ $stats['cancel'] }}</div>
        </div>
    </div>
</div>
@endsection
