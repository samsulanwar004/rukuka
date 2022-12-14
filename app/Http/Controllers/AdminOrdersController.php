<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;
	use App\Repositories\OrderRepository;
	use App\Repositories\CourierRepository;
    use App\Services\EmailService;
    use App\Services\CurrencyService;
    use Carbon\Carbon;
    use App\Jobs\ProcessDecreaseStock;

	class AdminOrdersController extends \crocodicstudio\crudbooster\controllers\CBController {


	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "orders";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = false;
			$this->button_action_style = "button_text";
			$this->button_add = false;
			$this->button_edit = false;
			$this->button_delete = false;
			$this->button_detail = true;
			$this->button_show = false;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = true;
			$this->table = "orders";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Order Code","name"=>"order_code"];
			$this->col[] = ["label"=>"Payment Method","name"=>"payment_method"];
			$this->col[] = ["label"=>"Payment Status","name"=>"payment_status"];
			$this->col[] = ["label"=>"Order Status","name"=>"order_status"];
			$this->col[] = ["label"=>"Order Subtotal","name"=>"id"];
			$this->col[] = ["label"=>"Order Date","name"=>"order_date"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Users Id','name'=>'users_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'users,first_name'];
			$this->form[] = ['label'=>'Shipping Id','name'=>'shipping_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'shipping,id'];
			$this->form[] = ['label'=>'Payment Id','name'=>'payment_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'payment,id'];
			$this->form[] = ['label'=>'Order Code','name'=>'order_code','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Air Waybill','name'=>'airwaybill','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Payment Method','name'=>'payment_method','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Payment Name','name'=>'payment_name','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Payment Status','name'=>'payment_status','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Payment Validation Status','name'=>'payment_validation_status','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Order Status','name'=>'order_status','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Order Subtotal','name'=>'order_subtotal','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Order Subtotal After Discount','name'=>'order_subtotal_after_discount','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Order Subtotal After Coupon','name'=>'order_subtotal_after_coupon','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Shipping Cost','name'=>'shipping_cost','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Cancel Reason','name'=>'cancel_reason','type'=>'textarea','validation'=>'required|string|min:5|max:5000','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Pending Reason','name'=>'pending_reason','type'=>'textarea','validation'=>'required|string|min:5|max:5000','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Order Date','name'=>'order_date','type'=>'datetime','validation'=>'required|date_format:Y-m-d H:i:s','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Expired Date','name'=>'expired_date','type'=>'datetime','validation'=>'required|date_format:Y-m-d H:i:s','width'=>'col-sm-10'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ['label'=>'Users Id','name'=>'users_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'users,first_name'];
			//$this->form[] = ['label'=>'Shipping Id','name'=>'shipping_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'shipping,id'];
			//$this->form[] = ['label'=>'Payment Id','name'=>'payment_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'payment,id'];
			//$this->form[] = ['label'=>'Order Code','name'=>'order_code','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Payment Method','name'=>'payment_method','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Payment Name','name'=>'payment_name','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Payment Status','name'=>'payment_status','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Payment Validation Status','name'=>'payment_validation_status','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Order Status','name'=>'order_status','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Order Subtotal','name'=>'order_subtotal','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Order Subtotal After Discount','name'=>'order_subtotal_after_discount','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Order Subtotal After Coupon','name'=>'order_subtotal_after_coupon','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Shipping Cost','name'=>'shipping_cost','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Cancel Reason','name'=>'cancel_reason','type'=>'textarea','validation'=>'required|string|min:5|max:5000','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Pending Reason','name'=>'pending_reason','type'=>'textarea','validation'=>'required|string|min:5|max:5000','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Order Date','name'=>'order_date','type'=>'datetime','validation'=>'required|date_format:Y-m-d H:i:s','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Expired Date','name'=>'expired_date','type'=>'datetime','validation'=>'required|date_format:Y-m-d H:i:s','width'=>'col-sm-10'];
			# OLD END FORM

			/* 
	        | ---------------------------------------------------------------------- 
	        | Sub Module
	        | ----------------------------------------------------------------------     
			| @label          = Label of action 
			| @path           = Path of sub module
			| @foreign_key 	  = foreign key of sub table/module
			| @button_color   = Bootstrap Class (primary,success,warning,danger)
			| @button_icon    = Font Awesome Class  
			| @parent_columns = Sparate with comma, e.g : name,created_at
	        | 
	        */
	        $this->sub_module = array();


	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add More Action Button / Menu
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @url         = Target URL, you can use field alias. e.g : [id], [name], [title], etc
	        | @icon        = Font awesome class icon. e.g : fa fa-bars
	        | @color 	   = Default is primary. (primary, warning, succecss, info)     
	        | @showIf 	   = If condition when action show. Use field alias. e.g : [id] == 1
	        | 
	        */
	        $this->addaction = array();


	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add More Button Selected
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @icon 	   = Icon from fontawesome
	        | @name 	   = Name of button 
	        | Then about the action, you should code at actionButtonSelected method 
	        | 
	        */
	        $this->button_selected = array();

	                
	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add alert message to this module at overheader
	        | ----------------------------------------------------------------------     
	        | @message = Text of message 
	        | @type    = warning,success,danger,info        
	        | 
	        */
	        $this->alert        = array();
	                

	        
	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add more button to header button 
	        | ----------------------------------------------------------------------     
	        | @label = Name of button 
	        | @url   = URL Target
	        | @icon  = Icon from Awesome.
	        | 
	        */
	        $this->index_button = array();



	        /* 
	        | ---------------------------------------------------------------------- 
	        | Customize Table Row Color
	        | ----------------------------------------------------------------------     
	        | @condition = If condition. You may use field alias. E.g : [id] == 1
	        | @color = Default is none. You can use bootstrap success,info,warning,danger,primary.        
	        | 
	        */
	        $this->table_row_color = array();     	          

	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | You may use this bellow array to add statistic at dashboard 
	        | ---------------------------------------------------------------------- 
	        | @label, @count, @icon, @color 
	        |
	        */
	        $this->index_statistic = array();
	        $this->index_statistic[] = ['label'=>'Total Order','count' => DB::table('orders')->count(),'icon'=>'fa fa-shopping-cart','color'=>'primary'];
	        $this->index_statistic[] = ['label'=>'New Order','count' => DB::table('orders')->where('payment_status' , 0)->count(),'icon'=>'fa fa-shopping-cart','color'=>'primary'];
	        $this->index_statistic[] = ['label'=>'Payment Success','count' => DB::table('orders')->where('payment_status' , 1)->count(),'icon'=>'fa fa-shopping-cart','color'=>'primary'];
	        $this->index_statistic[] = ['label'=>'Order Finish','count' => DB::table('orders')->where('order_status' , 2)->count(),'icon'=>'fa fa-shopping-cart','color'=>'primary'];



	        /*
	        | ---------------------------------------------------------------------- 
	        | Add javascript at body 
	        | ---------------------------------------------------------------------- 
	        | javascript code in the variable 
	        | $this->script_js = "function() { ... }";
	        |
	        */
	        $this->script_js = "
		        $(document).ready(function(){
				    $('.openPopup').on('click',function(){
				        var dataURL = $(this).attr('data-href');
				        $('.modal-body').load(dataURL,function(){
				            $('#myModal').modal({show:true});
				        });
				    }); 
				});
			";


            /*
	        | ---------------------------------------------------------------------- 
	        | Include HTML Code before index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it before index table
	        | $this->pre_index_html = "<p>test</p>";
	        |
	        */
	        $this->pre_index_html = null;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include HTML Code after index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it after index table
	        | $this->post_index_html = "<p>test</p>";
	        |
	        */
	        $this->post_index_html = null;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include Javascript File 
	        | ---------------------------------------------------------------------- 
	        | URL of your javascript each array 
	        | $this->load_js[] = asset("myfile.js");
	        |
	        */
	        $this->load_js = array();
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Add css style at body 
	        | ---------------------------------------------------------------------- 
	        | css code in the variable 
	        | $this->style_css = ".style{....}";
	        |
	        */
	        $this->style_css = NULL;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include css File 
	        | ---------------------------------------------------------------------- 
	        | URL of your css each array 
	        | $this->load_css[] = asset("myfile.css");
	        |
	        */
	        $this->load_css = array();
	        
	        
	    }


	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for button selected
	    | ---------------------------------------------------------------------- 
	    | @id_selected = the id selected
	    | @button_name = the name of button
	    |
	    */
	    public function actionButtonSelected($id_selected,$button_name) {
	        //Your code here
	            
	    }


	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate query of index result 
	    | ---------------------------------------------------------------------- 
	    | @query = current sql query 
	    |
	    */
	    public function hook_query_index(&$query) {
	        //Your code here    
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate row of index table html 
	    | ---------------------------------------------------------------------- 
	    |
	    */    
	    public function hook_row_index($column_index,&$column_value) {	        
	    	//Your code here
	    	if($column_index==2) {
                if ($column_value == '0') {
                    $column_value = '<span class="label label-primary">Payment Unpaid</span>';
                } else if ($column_value == '1') {
                    $column_value = '<span class="label label-success">Payment Success</span>';
                } else {
                    $column_value = '<span class="label label-danger">Payment Expired</span>';
                }
            }

            if($column_index==3) {
                if ($column_value == '0') {
                    $column_value = '<span class="label label-primary">Sent Pending</span>';
                } else if ($column_value == '1') {
                    $column_value = '<span class="label label-info">Sent Process</span>';
                } else if ($column_value == '2') {
                    $column_value = '<span class="label label-success">Sent Done</span>';
                } else {
                    $column_value = '<span class="label label-danger">Cancel</span>';
                }
            }

            if($column_index==4){
                    $total = $this->sumTotal($column_value);
                    $column_value = "Rp.". number_format($total);
            }
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before add data is execute
	    | ---------------------------------------------------------------------- 
	    | @arr
	    |
	    */
	    public function hook_before_add(&$postdata) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after add public static function called 
	    | ---------------------------------------------------------------------- 
	    | @id = last insert id
	    | 
	    */
	    public function hook_after_add($id) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before update data is execute
	    | ---------------------------------------------------------------------- 
	    | @postdata = input post data 
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_edit(&$postdata,$id) {
            //EMAILSENT
            //Send shipping Notification to buyer
            $order = (new OrderRepository)->getOrderById($id);
            if ($order->order_status == 0 && $postdata['order_status'] == 1) {
                (new EmailService)->sendShipping($order);
            }

            if ($order->payment_status == 0 && $postdata['payment_status'] == 1) {
            	//decrease stock
                ProcessDecreaseStock::dispatch($order)
                    ->onConnection(config('common.queue_active'))
                    ->onQueue(config('common.queue_list.processing'));

            	(new EmailService)->sendInvoicePaid($order);
            }
	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after edit public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_edit($id) {
	        //Your code here 

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command before delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_delete($id) {
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_delete($id) {
	        //Your code here

	    }



	    //By the way, you can still create your own method in here... :) 

	    public function getDetail($id) {
		  //Create an Auth
		  if(!CRUDBooster::isRead() && $this->global_privilege==FALSE || $this->button_edit==FALSE) {    
		    CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
		  }

		  $data = [];
		  $data['page_title'] = 'Detail Data';
		  $data['orderDetail'] = (new OrderRepository)->getOrderDetailByOrderId($id);
		  $data['row'] = $data['orderDetail'][0];
		  $data['currency'] = (new CurrencyService)->getCurrentCurrency($data['orderDetail'][0]->current_currency);
		  $data['return_url'] = request()->input('return_url');
		  $data['tracking'] = null;
		  if ($data['orderDetail'][0]->airwaybill) {
		  	$data['tracking'] =  (new CourierRepository)->getTrackingAndTracePosIndonesia($data['orderDetail'][0]->airwaybill);
		  }

		  //Please use cbView method instead view method from laravel
		  $this->cbView('admin.order_details',$data);
		}

        public function sumTotal($id){

            $order = DB::table('orders')->where('id',$id)->first();
            return $order->order_subtotal + $order->shipping_cost;
        }


	}