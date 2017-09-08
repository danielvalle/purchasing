<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

use App\Item;
use App\StockCard;
use App\OutrightExpense;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
    
    public function index(){

        $items = Item::all();
        $stock_cards = \DB::table('stock_card as a')
                ->leftJoin("office as b", "a.office_fk", "=", "b.id")
                ->select("a.*", "b.office_name")
                ->orderBy('date')
                ->orderBy('reference', 'ASC')
                ->get();
        $outright_expenses = OutrightExpense::all();

        return view("maintenance.maintenance-item")
                ->with('items', $items)
                ->with("stock_cards", $stock_cards)
                ->with("outright_expenses", $outright_expenses);
    }

    public function store(Request $request)
    {        
        $item_check = \DB::table('item')
                    ->where('item_name', trim($request->input('add-item-name')))
                    ->first();

        if($item_check == null)
        {
            $item = Item::create(array(
                'stock_no' => trim($request->input('add-stock-no')),
                'item_name' => trim($request->input('add-item-name')),
                'item_quantity' => $request->input('add-stock-on-hand'),
                'stock_quantity' => $request->input('add-stock-on-hand'),
                'stock_date' =>  $request->input('add-stock-date') != '' ? date("Y-m-d", strtotime($request->input('add-stock-date'))) : null,
                'item_description' => trim($request->input('add-item-description')),
                'is_active' => 1
            ));

            $item->save();

            \Session::flash('item_new_success', "Item is successfully added.");
        }
        else if($item_check != null)
        {
            \Session::flash('item_new_fail', "Stock No. is already used.");
        }

        return redirect('maintenance/item');
    }

    public function update(Request $request)
    {
        $item_check = \DB::table('item')
                    ->where('item_name', trim($request->input('edit-item-name')))
                    ->where('id', '!=', $request->input('edit-item-id'))
                    ->first();

        if($item_check == null)
        {
            $item = Item::find($request->input('edit-item-id'));

            $item->stock_no = trim($request->input('edit-stock-no'));
            $item->item_name = trim($request->input('edit-item-name'));
            $item->item_description = trim($request->input('edit-item-description'));
            $item->stock_date = $request->input('edit-stock-date') != '' ? date("Y-m-d", strtotime($request->input('edit-stock-date'))) : null;
            
            $item->save();
           
            \Session::flash('item_edit_success', trim($request->input('edit-item-name')) . " is successfully updated.");
        }
        else if($item_check->stock_no == trim($request->input('edit-stock-no')) && $item_check->id != $request->input('edit-item-id')) 
        {
            \Session::flash('item_edit_fail', trim($request->input('edit-stock-no')) . " already exists.");
        }

        return redirect('maintenance/item');
    }

    public function delete(Request $request)
    {

        $item = Item::find($request->input('del-item-id'));

        $item->is_active = 0;
        $item->save();

        return redirect('maintenance/item');
    }

    public function stock_card_pdf(Request $request)
    {
        $stock_card = \DB::table('stock_card as sc')
                    ->leftJoin('office', 'office.id', '=', 'sc.office_fk')
                    ->select('sc.*', 'office.office_name')
                    ->where('item_fk', $request->input('hdn-item-id'))
                    ->orderBy('date')
                    ->orderBy('reference', 'asc')
                    ->get();

        $item = \DB::table('item')
                    ->select('*')
                    ->where('id', $request->input('hdn-item-id'))
                    ->first();
        //dd($stock_card);

        view()->share("sc", $stock_card);
        view()->share('item', $item);

        $pdf = PDF::loadView('pdf.stock-card-pdf');
        return $pdf->download('SC-' . sprintf('%04d', $item->id) . '.pdf');
    }
    
}


