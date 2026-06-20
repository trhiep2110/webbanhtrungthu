<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\Favorite;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // ===== TRANG PROFILE TỔNG (GỘP TẤT CẢ TAB) =====
    public function index()
    {
        $user = User::find(session('user')->id);

        $orders = Order::with(['cartDetails.product'])
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        $favorites = Favorite::with('product.category')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        $addresses = Address::where('user_id', $user->id)->latest()->get();

        return view('client.profile', compact('user', 'orders', 'favorites', 'addresses'));
    }

    // ===== CẬP NHẬT THÔNG TIN =====
    public function updateProfile(Request $request)
    {
        $user = User::find(session('user')->id);
        $user->update([
            'fullname' => $request->fullname,
            'phone'    => $request->phone,
        ]);
        session(['user' => $user]);

        return response()->json(['code' => 200, 'message' => 'Cập nhật thông tin thành công!']);
    }

    // ===== ĐỔI MẬT KHẨU =====
    public function changePassword(Request $request)
    {
        $user = User::find(session('user')->id);

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['code' => 400, 'message' => 'Mật khẩu hiện tại không đúng!'], 400);
        }

        $user->update(['password' => Hash::make($request->new_password)]);

        return response()->json(['code' => 200, 'message' => 'Đổi mật khẩu thành công!']);
    }

    // ===== UPLOAD AVATAR =====
    public function uploadAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $user = User::find(session('user')->id);

        // Xóa avatar cũ nếu là file local (không xóa link mặc định)
        if ($user->avatar && str_contains($user->avatar, '/storage/avatars/')) {
            $oldPath = str_replace('/storage/', '', $user->avatar);
            Storage::disk('public')->delete($oldPath);
        }

        $path = $request->file('avatar')->store('avatars', 'public');
        $url  = '/storage/' . $path;

        $user->update(['avatar' => $url]);
        session(['user' => $user]);

        return response()->json([
            'code'    => 200,
            'message' => 'Cập nhật ảnh đại diện thành công!',
            'avatar'  => $url,
        ]);
    }

    // ===== XÓA SẢN PHẨM YÊU THÍCH =====
    public function removeFavorite(Request $request, $id)
    {
        $deleted = Favorite::where('user_id', session('user')->id)
            ->where('id', $id)
            ->delete();

        if (!$deleted) {
            return response()->json(['code' => 404, 'message' => 'Không tìm thấy sản phẩm yêu thích!'], 404);
        }

        return response()->json(['code' => 200, 'message' => 'Đã xóa khỏi danh sách yêu thích!']);
    }

    // ===== ĐỊA CHỈ: THÊM =====
    public function storeAddress(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'phone'         => 'required|string|max:20',
            'street'        => 'required|string|max:255',
            'province_name' => 'required|string',
            'province_id'   => 'required|integer',
            'district_name' => 'required|string',
            'district_id'   => 'required|integer',
            'ward_name'     => 'required|string',
            'ward_code'     => 'required|string',
        ]);

        $address = Address::create([
            'user_id'       => session('user')->id,
            'name'          => $request->name,
            'phone'         => $request->phone,
            'street'        => $request->street,
            'province_name' => $request->province_name,
            'province_id'   => $request->province_id,
            'district_name' => $request->district_name,
            'district_id'   => $request->district_id,
            'ward_name'     => $request->ward_name,
            'ward_code'     => $request->ward_code,
        ]);

        return response()->json(['code' => 200, 'message' => 'Thêm địa chỉ thành công!', 'data' => $address]);
    }

    // ===== ĐỊA CHỈ: XÓA =====
    public function deleteAddress($id)
    {
        $deleted = Address::where('user_id', session('user')->id)->where('id', $id)->delete();

        if (!$deleted) {
            return response()->json(['code' => 404, 'message' => 'Không tìm thấy địa chỉ!'], 404);
        }

        return response()->json(['code' => 200, 'message' => 'Đã xóa địa chỉ!']);
    }
}
