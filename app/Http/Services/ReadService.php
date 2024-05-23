<?php

namespace App\Http\Services;

use App\Interface\ColumnsInterface;
use App\Interface\ViewInterface;
use App\Models\Additional_links;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ReadService implements ViewInterface, ColumnsInterface
{
    public function adminDashboard(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {

        $userInfo = User::query()->find(auth()->id());
        if ($userInfo !== null)
            $userInfo->load(['visitors.notification','images','skills','posts','images']);

        return view(self::VIEW_ADMIN_DASHBOARD,compact(
            'userInfo'
        ));
    }
    public function adminForm(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $userInfo = User::query()->find(auth()->id());
        $links=Additional_links::query()->get();

        if ($userInfo !== null)
            $userInfo->load(['educations','informations','skills','posts.additionalLinks','images']);

        return view(self::VIEW_ADMIN_FORM,compact(
                'userInfo','links'
            )
        );
    }
    public function adminTable(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $userInfo = User::query()->first();
        $links=Additional_links::query()->get();
        $jobs = DB::table('failed_jobs')->get();

        if ($userInfo !== null)
            $userInfo->load(['educations','informations','skills','posts']);

        return view(self::VIEW_ADMIN_TABLE,compact('userInfo', 'jobs', 'links'));
    }

}
