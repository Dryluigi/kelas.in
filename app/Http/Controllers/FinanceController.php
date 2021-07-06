<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Finance\Finance;
use App\Models\Finance\FinanceType;

class FinanceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Kelas $kelas)
    {
        $data = $this->getTemplateData($kelas);
        $data['finances'] = $kelas->finances()->orderBy('created_at', 'desc')->get();

        return view('finances.index')->with($data);
    }

    public function create(Kelas $kelas)
    {
        $this->authorize('create', [Finance::class, $kelas]);
        
        $data = $this->getTemplateData($kelas);
        $data['financeTypes'] = FinanceType::all();

        return view('finances.create')->with($data);
    }

    public function manage(Kelas $kelas)
    {
        $this->authorize('create', [Finance::class, $kelas]);
        
        $data = $this->getTemplateData($kelas);
        $data['finances'] = $kelas->finances()->with('financeType')->orderBy('created_at', 'desc')->get();

        return view('finances.manage')->with($data);
    }

    public function store(Request $request, Kelas $kelas)
    {   
        $this->validate($request, [
            'judul' => 'required',
            'jumlah' => 'required|integer',
            'finance_type_id' => 'required',
        ]);

        $finance = $kelas->finances()->create($request->only('judul', 'deskripsi', 'jumlah','finance_type_id'));

        $this->resolveCashUpdate($finance, $kelas);

        $data = $this->getTemplateData($kelas);
        $data['success'] = 'Data transaksi berhasil ditambahkan';

        return redirect()->route('classes.finances', $kelas)->with($data);
    }

    public function edit(Kelas $kelas, Finance $finance)
    {
        $this->authorize('edit', [$finance, $kelas]);
        
        $data = $this->getTemplateData($kelas);
        $data['financeTypes'] = FinanceType::all();
        $data['finance'] = $finance;

        return view('finances.edit', $kelas)->with($data);
    }

    public function update(Request $request, Kelas $kelas, Finance $finance)
    {
        $this->authorize('edit', [$finance, $kelas]);

        $this->validate($request, [
            'judul' => 'required',
            'jumlah' => 'required|integer',
            'finance_type_id' => 'required',
        ]);

        $oldMoney = (int) $finance->jumlah;
        $newMoney = (int) $request->jumlah;
        $diff = $newMoney - $oldMoney;
        $oldType = $finance->finance_type_id;
        $newType = $request->finance_type_id;
        $current = (int) $kelas->cash;

        if($oldType == $newType) {
            if($oldType == FinanceType::PEMASUKAN_ID) {
                $this->updateClassCash($kelas, $current + $diff);
            } else {
                $this->updateClassCash($kelas, $current - $diff);
            }
        } else {
            if($newType == FinanceType::PEMASUKAN_ID) {
                $this->updateClassCash($kelas, $current + $oldMoney + $newMoney);
            } else {
                $this->updateClassCash($kelas, $current - $oldMoney - $newMoney);
            }
        }

        $finance->update($request->only('judul', 'deskripsi', 'jumlah', 'finance_type_id'));
        
        $data = $this->getTemplateData($kelas);
        $data['success'] = 'Data keuangan berhasil diupdate';

        return redirect()->route('classes.finances.manage', $kelas)->with($data);
    }

    public function destroy(Request $request, Kelas $kelas, Finance $finance)
    {
        $this->authorize('delete', [$finance, $kelas]);

        $oldMoney = (int) $finance->jumlah;
        $oldType = $finance->finance_type_id;
        $current = (int) $kelas->cash;

        $kelas->finances()->where('id', $finance->id)->delete();

        if ($oldType == FinanceType::PEMASUKAN_ID) {
            $kelas->update([
                'cash' => $current - $oldMoney,
            ]);
        } else {
            $kelas->update([
                'cash' => $current + $oldMoney,
            ]);
        }

        return back()->with(['success' => 'Data berhasil dihapus']);
    }

    private function getTemplateData(Kelas $kelas)
    {
        return [
            'user' => auth()->user(),
            'class' => $kelas,
            'role' => $kelas->getUserRole(auth()->user()),
        ];
    }

    private function updateClassCash(Kelas $kelas, $amount)
    {
        $kelas->update([
            'cash' => $amount
        ]);
    }

    private function resolveCashUpdate(Finance $finance, Kelas $kelas)
    {
        $money = (int) $finance->jumlah;
        $initial = (int) $kelas->cash;

        if($finance->finance_type_id == FinanceType::PEMASUKAN_ID) {
            $kelas->update([
                'cash' => $initial + $money,
            ]);
        } else {
            $kelas->update([
                'cash' => $initial - $money,
            ]);
        }
    }
}
