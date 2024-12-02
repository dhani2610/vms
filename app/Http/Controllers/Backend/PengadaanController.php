<?php
namespace App\Http\Controllers\Backend;

use App\Models\Pengadaan;
use App\Http\Controllers\Controller;
use App\Mail\NotificationNewPengadaanMail;
use App\Models\Admin;
use App\Models\Fungsi;
use App\Models\VendorPengadaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Svg\Tag\Rect;

class PengadaanController extends Controller
{

    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['page_title'] = 'Pengadaan';
        $data['pengadaans'] = Pengadaan::orderBy('created_at', 'desc')->get();

        return view('backend.pages.pengadaan.index', $data);
    }
    public function list()
    {
        $data['page_title'] = 'Pengadaan';
        $data['pengadaans'] = Pengadaan::orderBy('created_at', 'desc')->where('sampai_tanggal','>=',date('Y-m-d'))->get();


        return view('backend.pages.pengadaan.vendor', $data);
    }
    public function pengumuman()
    {
        $data['page_title'] = 'Pengumuman Pengadaan';
        $dataJoin = VendorPengadaan::where('id_vendor',Auth::guard('admin')->user()->id)->get()->pluck('id_pengadaan');
        $data['pengadaans'] = Pengadaan::whereIn('id',$dataJoin)->orderBy('created_at', 'desc')->get();

        return view('backend.pages.pengadaan.pengumuman', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['page_title'] = 'Tambah Data Pengadaan';
        $data['vendor'] = Admin::where('type','vendor')->where('status_verifikasi','approve')->orderBy('created_at', 'desc')->get();
        $data['fungsis'] = Fungsi::orderBy('created_at', 'desc')->get();
        return view('backend.pages.pengadaan.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = new Pengadaan();
            $data->judul = $request->judul;
            $data->dari_tanggal = $request->dari_tanggal;
            $data->sampai_tanggal = $request->sampai_tanggal;
            $data->deskripsi = $request->deskripsi;
            $data->id_fungsi = $request->fungsi;
            $data->type = $request->type;
            $data->category = $request->category;
            $data->status = 1;

            $dokumenval = $request->file('upload');
    
            if ($dokumenval != null) {
                $documentPath = public_path('documents/');
                $documentName = $dokumenval->getClientOriginalName();
                $i = 1;
                while (file_exists($documentPath . $documentName)) {
                    $documentName = pathinfo($dokumenval->getClientOriginalName(), PATHINFO_FILENAME) . "($i)." . $dokumenval->getClientOriginalExtension();
                    $i++;
                }
                $dokumenval->move($documentPath, $documentName);
                $data->file = $documentName;
            }
            if ($data->save()) {
                if ($request->vendor != null) {
                    foreach ($request->vendor as $key => $value) {
                        $this->sendEmail($value,$data->id);
                    }
                }
            }

            session()->flash('success', 'Data Berhasil Disimpan!');
            return redirect()->route('pengadaan');
        } catch (\Throwable $th) {
            session()->flash('failed', $th->getMessage());
            return redirect()->route('pengadaan');
        }
    }

    public function sendEmail($id,$pengadaan)
    {
        try {

            $data = Pengadaan::find($pengadaan);

            if (empty($data)) {
                return response()->json(['failed' => true, 'msg' => 'data tidak tersedia!']);
            }

            $admin = Admin::find($id);
            $email = $admin->email;
            $company_email = $admin->company_email;

            // Kirim email pic
            Mail::to($email)->send(new NotificationNewPengadaanMail([
                'email' => $email,
                'pengadaan' => $data,
            ]));
            // Kirim email perusahaan
            Mail::to($email)->send(new NotificationNewPengadaanMail([
                'email' => $company_email,
                'pengadaan' => $data,
            ]));
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengadaan $pengadaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['page_title'] = 'Tambah Data Pengadaan';
        $data['pengadaan'] = Pengadaan::find($id);
        $data['vendor'] = Admin::where('type','vendor')->where('status_verifikasi','approve')->orderBy('created_at', 'desc')->get();
        $data['fungsis'] = Fungsi::orderBy('created_at', 'desc')->get();

        return view('backend.pages.pengadaan.edit', $data);
    }
    public function vendor($id)
    {
        $data['page_title'] = 'Tambah Data Pengadaan';
        $data['pengadaan'] = Pengadaan::find($id);
        $dataJoin = VendorPengadaan::where('id_pengadaan',$id)->get()->pluck('id_vendor');
        $data['fungsis'] = Fungsi::orderBy('created_at', 'desc')->get();
        $data['vendors'] = Admin::whereIn('id',$dataJoin)->where('type','vendor')->where('status_verifikasi','approve')->orderBy('created_at', 'desc')->get();
        return view('backend.pages.pengadaan.vendor-list', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $data = Pengadaan::find($id);
            $data->judul = $request->judul;
            $data->dari_tanggal = $request->dari_tanggal;
            $data->sampai_tanggal = $request->sampai_tanggal;
            $data->deskripsi = $request->deskripsi;
            $data->id_fungsi = $request->fungsi;
            $data->status = $request->status;
            $data->type = $request->type;
            $data->category = $request->category;

            $dokumenval = $request->file('upload');
    
            if ($dokumenval != null) {
                $documentPath = public_path('documents/');
                $documentName = $dokumenval->getClientOriginalName();
                $i = 1;
                while (file_exists($documentPath . $documentName)) {
                    $documentName = pathinfo($dokumenval->getClientOriginalName(), PATHINFO_FILENAME) . "($i)." . $dokumenval->getClientOriginalExtension();
                    $i++;
                }
                $dokumenval->move($documentPath, $documentName);
                $data->file = $documentName;
            }
            $data->save();

            session()->flash('success', 'Data Berhasil Disimpan!');
            return redirect()->route('pengadaan');
        } catch (\Throwable $th) {
            session()->flash('failed', $th->getMessage());
            return redirect()->route('pengadaan');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $data = Pengadaan::find($id);
            $data->delete();

            session()->flash('success', 'Data Berhasil Dihapus!');
            return redirect()->route('pengadaan');
        } catch (\Throwable $th) {
            session()->flash('failed', $th->getMessage());
            return redirect()->route('pengadaan');
        }
    }
    public function join($id,$vendor)
    {
        try {
            $data = new VendorPengadaan();
            $data->id_pengadaan = $id;
            $data->id_vendor = $vendor;
            $data->status = 1;
            $data->save();

            session()->flash('success', 'Berhasil ikuti pengadaan! ');
            return redirect()->back();
        } catch (\Throwable $th) {
            session()->flash('failed', $th->getMessage());
            return redirect()->back();
        }
    }
    public function updateVerifikasi(Request $request, $id)
    {
        try {
            $data = VendorPengadaan::find($id);
            $data->status = $request->status;
            $data->save();

            session()->flash('success', 'Berhasil update status verifikasi! ');
            return redirect()->back();
        } catch (\Throwable $th) {
            session()->flash('failed', $th->getMessage());
            return redirect()->back();
        }
    }
}
