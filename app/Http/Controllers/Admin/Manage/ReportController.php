<?php

namespace App\Http\Controllers\Admin\Manage;
use App\Models\UserLogin;
use App\Models\User;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Factor;
use App\Models\Advertise;
use App\Models\Forum;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:general_manager');
    }
    public function getReport()
    {
        $user_login_today = UserLogin::where('created_at','>', Carbon::now()->subDays(1) )->count();
        $user_login = UserLogin::get()->count();

        $user_mounth = User::where('created_at','>', Carbon::now()->subDays(30) )->count();
        $user_all = User::get()->count();

        $product_all = Product::get()->count();
        $product_available = Product::where('status',Product::STATUS_AVAILABLE)->get()->count();

        $advertise = Advertise::get()->count();
        $advertise_active = Advertise::where('status',Advertise::STATUS_ACTIVE)->get()->count();

        // $all_comment = Comment::get()->count();

        $forum_all = Forum::get()->count();
        $forum_active = Forum::where('status', Forum::STATUS_ACTIVE)->get()->count();
        $forum_post = Forum::where('forum_id',null)->get()->count();

        $month_time = \Carbon\carbon::now()->subDays(30);
        $week_time = \Carbon\carbon::now()->subDays(7);
        $today_time = \Carbon\carbon::now()->subDays(1);

        $factors = Factor::select('id', 'created_at')->get();
        $factor_count_all = $factors->count();
        $factor_count_month = $factors->where('created_at', '>', $month_time)->count();
        $factor_count_week = $factors->where('created_at', '>', $week_time)->count();
        $factor_count_today = $factors ->where('created_at', '>', $today_time)->count();

        $factors = Factor::select('id', 'total_price', 'created_at')->get();
        $factor_total_price_all = $factors->sum('total_price');
        $factor_total_price_month = $factors->where('created_at', '>', $month_time)->sum('total_price');
        $factor_total_price_week = $factors->where('created_at', '>', $week_time)->sum('total_price');
        $factor_total_price_today = $factors ->where('created_at', '>', $today_time)->sum('total_price');

        $users = User::select('id', 'created_at')->get();
        $user_all = User::get()->count();
        $user_month = $users->where('created_at', '>', $month_time)->count();
        $user_week = $users->where('created_at', '>', $week_time)->count();
        $user_today = $users ->where('created_at', '>', $today_time)->count();

        $user_logins = UserLogin::select('id', 'created_at')->get();
        $user_login_all = $user_logins->count();
        $user_login_month = $user_logins->where('created_at', '>', $month_time)->count();
        $user_login_week = $user_logins->where('created_at', '>', $week_time)->count();
        $user_login_today = $user_logins ->where('created_at', '>', $today_time)->count();


        // view ha
        // filter ha emal beshe -> status , date
        return view('admin.manage.report.index', compact(
            'product_all',
            'product_available',
            'advertise',
            'advertise_active',
            'forum_all',
            'forum_active',
            'forum_post',
            'factor_count_all',
            'factor_count_month',
            'factor_count_week',
            'factor_count_today',
            'factor_total_price_all',
            'factor_total_price_month',
            'factor_total_price_week',
            'factor_total_price_today',
            'user_login_all',
            'user_login_month',
            'user_login_week',
            'user_login_today',
            'user_all',
            'user_month',
            'user_week',
            'user_today'
        ) );
    }
}





