<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', "HomeController@index");
Route::post('/login', 'HomeController@login');


Route::group(['prefix' => 'maintenance'], function(){

	/* Agency */

		Route::resource('agency', 'AgencyController');
			Route::post('agency/update', 'AgencyController@update');
			Route::post('agency/destroy', 'AgencyController@delete');

	/* end of Agency */

	/* Category */

		Route::resource('category', 'CategoryController');
			Route::post('category/update', 'CategoryController@update');
			Route::post('category/destroy', 'CategoryController@delete');

	/* end of Category */

	/* Department */

		Route::resource('department', 'DepartmentController');
			Route::post('department/update', 'DepartmentController@update');
			Route::post('department/destroy', 'DepartmentController@delete');

	/* end of Department */

	/* Designation */

		Route::resource('designation', 'DesignationController');
			Route::post('designation/update', 'DesignationController@update');
			Route::post('designation/destroy', 'DesignationController@delete');

	/* end of Designation */

	/* Item */

		Route::resource('item', 'ItemController');
			Route::post('item/update', 'ItemController@update');
			Route::post('item/destroy', 'ItemController@delete');

	/* end of Item */

	/* Office */

		Route::resource('office', 'OfficeController');
			Route::post('office/update', 'OfficeController@update');
			Route::post('office/destroy', 'OfficeController@delete');

	/* end of Office */

	/* Section */

		Route::resource('section', 'SectionController');
			Route::post('section/update', 'SectionController@update');
			Route::post('section/destroy', 'SectionController@delete');

	/* end of Section */

	/* Supplier */

		Route::resource('supplier', 'SupplierController');
			Route::post('supplier/update', 'SupplierController@update');
			Route::post('supplier/destroy', 'SupplierController@delete');

	/* end of Supplier */

	/* Unit */

		Route::resource('unit', 'UnitController');
			Route::post('unit/update', 'UnitController@update');
			Route::post('unit/destroy', 'UnitController@delete');

	/* end of Unit */

	/* User */

		Route::resource('user', 'UserController');
			Route::post('user/update', 'UserController@update');
			Route::post('user/destroy', 'UserController@delete');

	/* end of User */

});

Route::group(['prefix' => 'transaction'], function(){

	/* Purchase Request */

		Route::get('purchase-request-show', 'PurchaseRequestController@show_pr');
		Route::resource('purchase-request', 'PurchaseRequestController');
		
			Route::post('purchase-request/update', 'PurchaseRequestController@update');
			Route::post('purchase-request/destroy', 'PurchaseRequestController@delete');

			Route::post('purchase-request/add-supplier', 'PurchaseRequestController@add_supplier');
			Route::post('purchase-request/del-supplier', 'PurchaseRequestController@del_supplier');

			Route::post('purchase-request/add-item', 'PurchaseRequestController@add_item');
			Route::post('purchase-request/edit-item', 'PurchaseRequestController@edit_item');

			Route::post('purchase-request/new-category', 'PurchaseRequestController@new_category');

	/* end of Purchase Request */

	/* Request For Quotation */

		Route::get('request-for-quotation-show', 'RequestForQuotationController@show_rfq');
		Route::resource('request-for-quotation', 'RequestForQuotationController');

			Route::post('request-for-quotation-search', 'RequestForQuotationController@get_rfq');

			Route::post('request-for-quotation/update', 'RequestForQuotationController@update');
			Route::post('request-for-quotation/destroy', 'RequestForQuotationController@delete');

	/* end of Request For Quotation */

	/* Abstract For Quotation */

		Route::resource('abstract-quotation', 'AbstractQuotationController');

			Route::post('abstract-quotation-search', 'AbstractQuotationController@get_rfq');

	/* end of Abstract For Quotation */

	/* Purchase Order */

		Route::resource('purchase-order', 'PurchaseOrderController');

	/* end of Purchase Order */

	/* Acceptance */

		Route::resource('acceptance', 'AcceptanceController');

	/* end of Acceptance*/

	/* Issuance */

		Route::resource('issuance', 'IssuanceController');

	/* end of Issuance*/

});