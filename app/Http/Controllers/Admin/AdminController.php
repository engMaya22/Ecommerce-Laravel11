<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditSettingRequest;
use App\Models\Contact;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(){
        $recentOrders = Order::orderBy('created_at','DESC')
                             ->get()
                             ->take(10);
        $dashboradData = DB::select("Select sum(total) As TotalAmount,
                                    sum(if(status='ordered',total,0)) As TotalOrderedAmount,
                                    sum(if(status='delivered',total,0)) As TotalDeliveredAmount,
                                    sum(if(status='canceled',total,0)) As TotalCanceledAmount,
                                    Count(*) As Total,

                                    sum(if(status='ordered',1,0)) As TotalOrdered,
                                    sum(if(status='delivered',1,0)) As TotalDelivered,
                                    sum(if(status='canceled',1,0)) As TotalCanceled
                                    From orders

                                     ");

        $monthlyData = DB::select("SELECT M.id As MonthNo , M.name As MonthName ,
                                    IFNULL(D.TotalAmount ,0) As TotalAmount,
                                    IFNULL(D.TotalOrderedAmount ,0) As TotalOrderedAmount,
                                    IFNULL(D.TotalDeliveredAmount ,0) As TotalDeliveredAmount,
                                    IFNULL(D.TotalCanceledAmount ,0) As TotalCanceledAmount
                                    From month_names M
                                    LEFT JOIN (Select DATE_FORMAT(created_at , '%b') As MonthName ,
                                    MONTH(created_at) As MonthNo,
                                    sum(total) As TotalAmount,
                                      sum(if(status='ordered',total,0)) As TotalOrderedAmount,
                                    sum(if(status='delivered',total,0)) As TotalDeliveredAmount,
                                    sum(if(status='canceled',total,0)) As TotalCanceledAmount
                                    From orders WHERE YEAR(created_at) = YEAR(NOW()) GROUP  BY YEAR(created_at),MONTH(created_at),DATE_FORMAT(created_at , '%b')
                                    Order By MONTH(created_at)) D On D.MonthNo=M.id");


        $amountM = implode(',',collect($monthlyData)->pluck('TotalAmount')->toArray());
        $totalOrderedAmountM = implode(',',collect($monthlyData)->pluck('TotalOrderedAmount')->toArray());
        $totalDeliveredAmountM = implode(',',collect($monthlyData)->pluck('TotalDeliveredAmount')->toArray());
        $totalCanceledAmountM = implode(',',collect($monthlyData)->pluck('TotalCanceledAmount')->toArray());

        $totalAmount = collect($monthlyData)->sum('TotalAmount');
        $totalOrderedAmount = collect($monthlyData)->sum('TotalOrderedAmount');
        $totalDeliveredAmount = collect($monthlyData)->sum('TotalDeliveredAmount');
        $totalCanceledAmount = collect($monthlyData)->sum('TotalCanceledAmount');

        return view('admin.index',compact('recentOrders','dashboradData' ,'amountM',
                                             'totalOrderedAmountM',
                                             'totalDeliveredAmountM',
                                             'totalCanceledAmountM',
                                             'totalAmount',
                                            'totalOrderedAmount',
                                            'totalDeliveredAmount',
                                            'totalCanceledAmount'


                                                ));
    }

    public function contacts(){
        $contacts = Contact::orderBy('created_at','DESC')->paginate(10);
        return view('admin.contacts',compact('contacts'));
    }

    public function contactDelete($id){
        Contact::find($id)->delete();
        return redirect()->back()->with('status','Contact has been deleted successfully!');
    }

    public function usersAll(){
        $users = User::with('orders')->paginate(10);
        return view('admin.users.index',compact('users'));
    }


    public function settingsGet(){
        $user = auth()->user();
        return view('admin.setting',compact('user'));
    }

    public function settingsUpdate(EditSettingRequest $request){
        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;

        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Settings updated successfully.');


    }


}
