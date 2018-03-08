<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;
	use App\Category;
	use App\Product;
	use Validator;

	class AdminProductsController extends \crocodicstudio\crudbooster\controllers\CBController {

		private $categoryId;

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "name";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = true;
			$this->button_edit = true;
			$this->button_delete = true;
			$this->button_detail = true;
			$this->button_show = true;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "products";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Product Designers","name"=>"product_designers_id","join"=>"product_designers,name"];
			$this->col[] = ["label"=>"Product Categories","name"=>"product_categories_id","join"=>"product_categories,name"];
			$this->col[] = ["label"=>"Product Code","name"=>"product_code"];
			$this->col[] = ["label"=>"Name","name"=>"name"];
			$this->col[] = ["label"=>"Status","name"=>"is_active"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Product Designers','name'=>'product_designers_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'product_designers,name'];
            $this->form[] = ['label'=>'Product Categories','name'=>'product_categories_id','type'=>'custom','validation'=>'required','width'=>'col-sm-10', 'html' => $this->categories()];
            $this->form[] = ['label'=>'Name','name'=>'name','type'=>'text','validation'=>'required|string|min:3|max:70','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Color','name'=>'product_colors_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'product_colors,name'];
			$this->form[] = ['label'=>'Content','name'=>'content','type'=>'wysiwyg','validation'=>'string','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Detail And Care','name'=>'detail_and_care','type'=>'wysiwyg','validation'=>'string','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Size And Fit','name'=>'size_and_fit','type'=>'wysiwyg','validation'=>'string','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Currency','name'=>'currency','type'=>'select','validation'=>'required','width'=>'col-sm-10','dataenum'=>'IDR','value'=>'IDR'];
//			$this->form[] = ['label'=>'Price','name'=>'price','type'=>'money','validation'=>'required|integer|min:0','width'=>'col-sm-10','help'=>'Starting Price on IDR'];
            $this->form[] = ['label'=>'Price Before Discount','name'=>'price_before_discount','type'=>'money','validation'=>'integer|min:0','width'=>'col-sm-10','help'=>'Discount (Price before Sell Price on IDR)'];
            $this->form[] = ['label'=>'Sell Price','name'=>'sell_price','type'=>'money','validation'=>'required|integer|min:0','width'=>'col-sm-10','help'=>'Selling Price on IDR'];
			$this->form[] = ['label'=>'Weight','name'=>'weight','type'=>'number','validation'=>'required|integer|min:50','width'=>'col-sm-2','help'=>'on Gram, Min. 50 Gram','placeholder'=>'gram'];
			$this->form[] = ['label'=>'Length','name'=>'length','type'=>'number','validation'=>'integer|min:0','width'=>'col-sm-2','help'=>'on Cm','placeholder'=>'cm'];
			$this->form[] = ['label'=>'Width','name'=>'width','type'=>'number','validation'=>'integer|min:0','width'=>'col-sm-2','help'=>'on Cm','placeholder'=>'cm'];
			$this->form[] = ['label'=>'Height','name'=>'height','type'=>'number','validation'=>'integer|min:0','width'=>'col-sm-2','help'=>'on Cm','placeholder'=>'cm'];
			$this->form[] = ['label'=>'Diameter','name'=>'diameter','type'=>'number','validation'=>'integer|min:0','width'=>'col-sm-2','help'=>'on Cm','placeholder'=>'cm'];
			$this->form[] = ['label'=>'Status','name'=>'is_active','type'=>'radio','width'=>'col-sm-10','dataenum'=>'0|Unactive;1|Active','value'=>0];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ['label'=>'Product Designers','name'=>'product_designers_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'product_designers,name'];
			//$this->form[] = ['label'=>'Product Categories','name'=>'product_categories_id','type'=>'custom','validation'=>'required','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Name','name'=>'name','type'=>'text','validation'=>'required|string|min:3|max:70','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Color','name'=>'color','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Content','name'=>'content','type'=>'textarea','validation'=>'required|string','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Detail And Care','name'=>'detail_and_care','type'=>'textarea','validation'=>'string','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Size And Fit','name'=>'size_and_fit','type'=>'textarea','validation'=>'string','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Technical Specification','name'=>'technical_specification','type'=>'textarea','validation'=>'string','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Currency','name'=>'currency','type'=>'select2','validation'=>'required','width'=>'col-sm-10','dataenum'=>'USD'];
			//$this->form[] = ['label'=>'Price','name'=>'price','type'=>'money','validation'=>'required|integer|min:0','width'=>'col-sm-10','help'=>'Starting Price'];
			//$this->form[] = ['label'=>'Sell Price','name'=>'sell_price','type'=>'money','validation'=>'required|integer|min:0','width'=>'col-sm-10','help'=>'Selling Price'];
			//$this->form[] = ['label'=>'Price Before Discount','name'=>'price_before_discount','type'=>'number','validation'=>'integer|min:0','width'=>'col-sm-10','help'=>'Discount (Price before Sell Price)'];
			//$this->form[] = ['label'=>'Weight','name'=>'weight','type'=>'number','validation'=>'integer|min:0','width'=>'col-sm-2','placeholder'=>'gram'];
			//$this->form[] = ['label'=>'Length','name'=>'length','type'=>'number','validation'=>'integer|min:0','width'=>'col-sm-2','placeholder'=>'cm'];
			//$this->form[] = ['label'=>'Width','name'=>'width','type'=>'number','validation'=>'integer|min:0','width'=>'col-sm-2','placeholder'=>'cm'];
			//$this->form[] = ['label'=>'Height','name'=>'height','type'=>'number','validation'=>'integer|min:0','width'=>'col-sm-2','placeholder'=>'cm'];
			//$this->form[] = ['label'=>'Diameter','name'=>'diameter','type'=>'number','validation'=>'integer|min:0','width'=>'col-sm-2','placeholder'=>'cm'];
			//$this->form[] = ['label'=>'Is Active','name'=>'is_active','type'=>'checkbox','width'=>'col-sm-10','dataenum'=>'Active'];
			//$this->form[] = ['label'=>'Tags','name'=>'tags','type'=>'multitext','validation'=>'min:1|max:20','width'=>'col-sm-10'];
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
	        $this->sub_module[] = [
	        	'label'=>'Photos',
	        	'path'=>'product-images',
	        	'parent_columns'=>'name',
	        	'foreign_key'=>'products_id',
	        	'button_color'=>'success',
	        	'button_icon'=>'fa fa-picture-o'
	        ];

	        $this->sub_module[] = [
	        	'label'=>'Stocks',
	        	'path'=>'product-stocks',
	        	'parent_columns'=>'name',
	        	'foreign_key'=>'products_id',
	        	'button_color'=>'success',
	        	'button_icon'=>'fa fa-bars'
	        ];


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



	        /*
	        | ----------------------------------------------------------------------
	        | Add javascript at body
	        | ----------------------------------------------------------------------
	        | javascript code in the variable
	        | $this->script_js = "function() { ... }";
	        |
	        */
	        $this->script_js = NULL;


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
            if($column_index==5) {
                if ($column_value == '0') {
                    $column_value = '<span class="label label-warning">Unactive</span>';
                } else {
                    $column_value = '<span class="label label-success">Active</span>';
                }
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
            $product_code = $this->generateProductDate();
	        $postdata['product_code'] = $product_code;


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
	        $products = DB::table('products');
	        $product = $products->where('id', $id)->first();
	        $postdata['slug'] = str_slug($product->name.' '.$product->id);
	        $products->update($postdata);
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
	        //Your code here
            $product = Product::where('id', $id)->first();
            $product_code = strtoupper(substr($product->product_code,0,2));

            if($product_code == 'P2' || $product_code == 'KP'){
                $pc = $this->generateProductDate();
                $postdata['product_code'] = $pc;
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
	        $products = DB::table('products');
	        $product = $products->where('id', $id)->first();
	        $postdata['slug'] = str_slug($product->name.' '.$product->id);
	        $products->update($postdata);
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

	    public function getEdit($id)
	    {
	    	$this->setCategoryId($id);
	    	$this->cbLoader();
	    	$row = \DB::table($this->table)->where($this->primary_key,$id)->first();

			if(!CRUDBooster::isRead() && $this->global_privilege==FALSE || $this->button_edit==FALSE) {
				CRUDBooster::insertLog(trans("crudbooster.log_try_edit",['name'=>$row->{$this->title_field},'module'=>CRUDBooster::getCurrentModule()->name]));
				CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
			}


			$page_menu       = \Route::getCurrentRoute()->getActionName();
			$page_title 	 = trans("crudbooster.edit_data_page_title",['module'=>CRUDBooster::getCurrentModule()->name,'name'=>$row->{$this->title_field}]);
			$command 		 = 'edit';
			Session::put('current_row_id',$id);
			return view('crudbooster::default.form',compact('id','row','page_menu','page_title','command'));
	    }


	    private function categories()
	    {
	    	$id = $this->getCategoryId();

	    	$product = $this->getProductById($id);


	    	return Category::attr([
	    		'name' => 'product_categories_id',
	    		'class' => 'form-control'
	    	])
		    ->selected($product->product_categories_id)
		    ->renderAsDropdown();
	    }

	    private function getProductById($id)
	    {
	    	return Product::where('id', $id)->first();
	    }

	    private function setCategoryId($value)
	    {
	    	$this->categoryId = $value;
	    	return $this;
	    }

	    private function getCategoryId()
	    {
	    	return $this->categoryId;
	    }

	    public function generateProductDate(){
            $product_code = 'PC'.date('ym').rand(1000,9999);
            $validator = \Validator::make(['product_code'=>$product_code],['product_code'=>'unique:products,product_code']);

            if($validator->fails()){
                $this->generateProductDate();
            }
            return $product_code;
        }

	}
