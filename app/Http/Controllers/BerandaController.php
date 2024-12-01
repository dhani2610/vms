<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BerandaController extends Controller
{


    public function register()
    {
        $data['page_title'] = 'Register';
        return view('backend.auth.register', $data);
    }

    public function registerStore(Request $request)
    {

        try {
            $request->validate([
                'email' => 'required|max:100|email|unique:admins',
                'password' => 'required|min:6',
                'region' => 'required',
                'entity_type' => 'required',
                'company_name' => 'required',
                'office_phone' => 'required',
                'company_email' => 'required|email',
                'fax' => 'required',
                'domicile_address' => 'required',
                'operational_address' => 'required',
                'npwp_company' => 'required',
                'akta_pendiri_perusahaan' => 'required',
                'nib' => 'required',
                'postal_code' => 'required',
                'pic_name' => 'required',
                'pic_position' => 'required',
                'pic_phone' => 'required',
                'pic_email' => 'required|email',
            ]);

            // Buat VENDOR Baru
            $admin = new Admin();
            $admin->name = $request->pic_name;
            $admin->username = $request->pic_name;
            $admin->email = $request->email;
            $admin->password = Hash::make($request->password);
            $admin->region = $request->region;
            $admin->entity_type = $request->entity_type;
            $admin->company_name = $request->company_name;
            $admin->office_phone = $request->office_phone;
            $admin->company_email = $request->company_email;
            $admin->fax = $request->fax;
            $admin->domicile_address = $request->domicile_address;
            $admin->operational_address = $request->operational_address;
            $admin->npwp_company = $request->npwp_company;
            $admin->akta_pendiri_perusahaan = $request->akta_pendiri_perusahaan;
            $admin->nib = $request->nib;
            $admin->postal_code = $request->postal_code;
            $admin->pic_name = $request->pic_name;
            $admin->pic_position = $request->pic_position;
            $admin->pic_phone = $request->pic_phone;
            $admin->pic_email = $request->pic_email;
            $admin->status_verifikasi = 'pending'; // Default status pending
            $admin->type = 'vendor';
            $admin->save();

            // Assign Role to Admin
            $admin->assignRole('user');

            session()->flash('success', 'Register berhasil silahkan login.');
            return redirect('admin/login');
        } catch (\Throwable $th) {
            session()->flash('failed', $th->getMessage());
            return redirect('admin/register');
        }
    }
}
