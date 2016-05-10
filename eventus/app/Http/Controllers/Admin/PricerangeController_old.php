<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Pricerange;
use App\Models\PricerangeTranslation;
use App\Helper\Languagehelper;
use DB;
use Lang;


class PricerangeController extends Controller
{
	
   public function __construct()
   {
      $this->middleware('admins');
   }
   public function index(Request $request)
   {      
   	  $id=Input::get('id'); 
      $price_range_title  = Input::get('price_range_title');
      $todo  = Input::get('todo');
      $sorting  = Input::get('sorting');
      if($sorting== 'Title')
      $sort_col = 'ptrans.price_range_title';
      elseif($sorting== 'Lower Range')
      $sort_col = 'pr.lower_range';
      elseif($sorting== 'Upper Range')
      $sort_col = 'pr.upper_range';
      else
      $sort_col = '';
      if($request->wantsJson() || $request->isJson()){         
         if($todo == 'search')
         {            
            $priceRange = DB::table('price_range as pr')
            ->select('*')
            ->join('price_range_translation as ptrans', 'pr.id', '=', 'ptrans.price_range_id')
            ->where('ptrans.price_range_title','like','%'.$price_range_title.'%')
            ->where('ptrans.language_id',env('default_language'))  
             ->where('pr.currency_id',$id)         
            ->get();
            
         }
         elseif($todo=='sort_asc'){
            
            $priceRange = DB::table('price_range as pr')
            ->select('*')
            ->join('price_range_translation as ptrans', 'pr.id', '=', 'ptrans.price_range_id')
             ->where('pr.currency_id',$id)
            ->where('ptrans.language_id',env('default_language'))
            ->orderBy($sort_col, 'asc')->get();
            
            
            
         }
         elseif($todo=='sort_desc'){
            $priceRange = DB::table('price_range as pr')
            ->select('*')
            ->join('price_range_translation as ptrans', 'pr.id', '=', 'ptrans.price_range_id')
             ->where('pr.currency_id',$id)
            ->where('ptrans.language_id',env('default_language'))
            ->orderBy($sort_col, 'desc')->get();
            
         }
         else
         {
            $priceRange = DB::table('price_range as pr')
            ->select('*')
            ->join('price_range_translation as ptrans', 'pr.id', '=', 'ptrans.price_range_id')
            ->where('pr.currency_id',$id)            
            ->where('ptrans.language_id',env('default_language'))            
            ->get();
         }
        
         return response()->json($priceRange);
      }
      return view('admin.pricerange.index', ['title' => 'Price Range','heading' => 'Price Range']);
   }
   
   public function create()
   {
   		$currency_id = Input::get('currency_id');
   		$language = Languagehelper::getlanguage();
   		//$lowerRange = DB::raw("(select max(`lower_range`) from price_range")->get();
   		$lowerRange = DB::table('price_range')->where('currency_id',$currency_id)->max('upper_range');
   		$lowerRange = $lowerRange+1;
   		return view('admin.pricerange.pricerange',['language' => $language,'heading' => 'Price Range','subHeading' => 'Add Price Range', 'saveBtn' => 'Add', 'lowerRange' => $lowerRange, 'currency_id' => $currency_id]);
   }
   
   public function show($id='',Request $request)
   {
	$language = Languagehelper::getlanguage();
      /*$clients = DB::table('client')
         ->where('id',$id)
         ->get();*/
         
      $pricerange = DB::table('price_range as pr')
            ->select('*')
            ->join('price_range_translation as ptrans', 'pr.id', '=', 'ptrans.price_range_id')
            ->where('pr.id',$id)
            ->get();
       

      if($request->wantsJson() || $request->isJson()){
         return response()->json($pricerange);
      }

      return view('admin.pricerange.pricerange', ['title' => 'Update Client','language' => $language,'heading' => 'Price Range','subHeading' => 'Update Price Range', 'saveBtn' => 'Save', 'lowerRange' => '','currency_id' => '']);
   }

   public function store(Request $request)
   {
      if($request->wantsJson() || $request->isJson()) {
         try{  
         	              
            $pricerangeId = DB::table('price_range')->insertGetId(
							[								
								'currency_id'=>$request->currency_id,
								'lower_range'=>$request->lower_range,
								'upper_range'=>$request->upper_range,								
								'created_at' => date('Y-m-d H:i:s'),
								'updated_at' => date('Y-m-d H:i:s')
							]
						);
			
			DB::table('price_range_translation')->insert([
				    ['price_range_id' =>$pricerangeId, 'language_id' =>1, 'price_range_title' => $request->price_range_title_1],
				    ['price_range_id' =>$pricerangeId, 'language_id' =>2, 'price_range_title' => $request->price_range_title_2]
				]);
            return response()->json(['status'=>'success', 'data'=>$pricerangeId]);
         }
         catch(\Illuminate\Database\QueryException $e) {
            return response()->json(['status'=>'error','code'=>500, 'data'=>'database error','message'=>Lang::get('messages.query_exception'),
               'errorInfo' => $e->errorInfo[2]]);
         }
      }
   }
   public function update($id,Request $request)
   {

      if($request->wantsJson() || $request->isJson()) {
         try{
           
            $data = DB::table('price_range')
            ->where('id', $id)
            ->update([
						'lower_range'=>$request->lower_range,
						'upper_range'=>$request->upper_range,
            			'updated_at' => date('Y-m-d H:i:s')
            		 ]
            		);
            
            DB::table('price_range_translation')
            ->where('price_range_id', $id)
            ->where('language_id', 1)
            ->update(['price_range_title' => $request->price_range_title_1]);
            
            DB::table('price_range_translation')
            ->where('price_range_id', $id)
            ->where('language_id', 2)
            ->update(['price_range_title' => $request->price_range_title_2]);
            
            return response()->json(['status'=>'success', 'data'=>$data]);
         }catch(\Illuminate\Database\QueryException $e) {
            return response()->json(['status'=>'error','code'=>500, 'data'=>'database error','message'=>Lang::get('messages.query_exception')]);
         }
      }
   }
   public function delete($id,Request $request)
   {
   if($request->isJson() || $request->wantsJson()){            
            try {        
                
                $max_order = DB::table('price_range')->where('order_id', DB::raw("(select max(`order_id`) from ev_price_range)"))->get();
                $min_order = DB::table('price_range')->where('order_id', DB::raw("(select min(`order_id`) from ev_price_range)"))->get();
                $order = DB::table('price_range')->where('id',$id)->get();
                 
                if($order[0]->order_id==$min_order[0]->order_id) {
                  
                   DB::table('price_range')
                  ->where('order_id','>', $order[0]->order_id)
                  //->update(['order_id' => 'order_id-1']);
                  ->decrement('order_id');
                
                }
                elseif($order[0]->order_id>$min_order[0]->order_id && $order[0]->order_id<$max_order[0]->order_id) {
                
                 DB::table('price_range')
                  ->where('order_id','>', $order[0]->order_id)
                  ->decrement('order_id');
                   
                }
                $query =  DB::table('price_range_translation');
                $findRow1 = $query->where('price_range_id',$id)->get();
                
                foreach($findRow1 as $row):
                DB::table('price_range_translation')->where('price_range_translation_id', $row->price_range_id)->delete();        
                endforeach;     
                          
                $findRow2 = Halltype::findOrFail($id);            
                $delete2 = $findRow2->delete();
                return response()->json([
                    'status' => 'success', 
                    'data' => $delete2
                ]);
            }catch(Exception $e){
                return response()->json([
                    'status'=>'error',
                    'code'=>500,
                    'data' => Lang::get('messages.response_error_db'),
                    'message'=>Lang::get('messages.query_exception'),                    
                ]);
            }                
        }
   }
   
   /*public function selectcurrency(Request $request)
   {   	
		$currency = DB::table('currency')
			->select('*')
			->get();
		if ($request->wantsJson() || $request->isJson()) {
			return response()->json($currency);
		}
   }*/
}
