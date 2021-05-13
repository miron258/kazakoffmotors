<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cart\FormOrder\FormOrder;
use App\Models\Cart\FormOrder\FormOrderPersonal;
use App\Models\Cart\FormOrder\FormOrderProduct;
use App\Models\Cart\FormOrder\FormOrderAddressDelivery;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FormOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formOrders = FormOrder::with(['personal', 'delivery'])->orderBy('id','desc')->paginate(300);



        //Передаем в представление наш массив со страницами
        return view('auth.form_order.index', compact('formOrders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(FormOrder $formOrder)
    {
        return view('auth.form_order.show', compact('formOrder'));
    }

    /** * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(FormOrder $formOrder)
    {
        return view('auth.form_order.form', compact('formOrder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FormOrder $formOrder)
    {
        $formOrder->delete(); //Удаляем галерею из базы данных
        $formOrderName = $formOrder->name . " " . $formOrder->surname;

        return redirect()->route('formOrder.index')->with('message', 'Форма заказа товаров клиента' . $formOrderName . ' успешно удалена');
    }
}
