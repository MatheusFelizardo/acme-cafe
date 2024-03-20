<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserVoucher;
use App\Models\Voucher;
use App\Services\VoucherService;
use Illuminate\Http\Request;

class VoucherController extends Controller
{

    public function index()
    {
        $voucherService = new VoucherService();
        $voucher = $voucherService->get_vouchers();
        return response()->json($voucher);
    }

    /**
     * Store a newly created resource in storage. Used if we want to create a new voucher via api.
     */
    public function generate()
    {
        $voucherService = new VoucherService();
        $voucher = $voucherService->generate_accumulated_payment_voucher();
        return response()->json($voucher);
    }

    public function associate($code, $userId)
    {
        $voucher = Voucher::where('code', $code)->first();
        if (!$voucher) {
            return response()->json(['message' => 'Voucher not found'], 404);
        }

        $user = User::find($userId);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user_voucher = UserVoucher::create([
            'user_id' => $user->id,
            'voucher_code' => $voucher->code
        ]);

        return response()->json($user_voucher);
    }
}
