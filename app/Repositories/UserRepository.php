<?php

namespace App\Repositories;

use App\ConfirmPayment;
use App\User;
use App\CreditCard;
use App\Address;
use DB;
use Exception;
use Carbon\Carbon;
use App\Services\EmailService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Wishlist;
use App\Libraries\ImageFile;
use Storage;
use Image;
use App\Subcriber;
use App\Libraries\Encryption;
use App\Review;

class UserRepository
{

	const DEFAULT_FILE_DRIVER = 'local';
    const RESIZE_IMAGE = [240, null];
    const HOME_PAGE = 'index';

	private $email;

	private $password;

	private $socialMediaType;

	private $socialMediaId;

	private $firstName;

	private $lastName;

	private $phone;

	private $dob;

	private $gender='m';

	private $avatar;

	private $token;

	private $date;

	private $user;

	private $default = 0;

	const EXPIRED_VERIFICATION_TOKEN_IN = 2;

	public function __construct()
	{
		$this->date = Carbon::now('Asia/Jakarta');
	}

	public function model()
	{
		return new User;
	}

	public function create()
	{

		$verificationToken = strtolower(str_random(60));
		$verificationExpired = $this->date->addDay(self::EXPIRED_VERIFICATION_TOKEN_IN);


		$user = $this->model();
		$user->email = $this->getEmail();
		$user->password = $this->getPassword();
		$user->first_name = $this->getFirstName();
		$user->last_name = $this->getLastName();
		$user->phone_number = $this->getPhone();
		$user->dob = $this->getDob();
		$user->gender = $this->getGender();
		$user->social_media_type = $this->getSocialMediaType();
		$user->social_media_id = $this->getSocialMediaId();
		$user->avatar = $this->getAvatar();
		$user->verification_token = $verificationToken;
		$user->verification_expired = $verificationExpired;
		$user->api_token = str_random(60);

		if ($user->social_media_type != 'web' && $user->social_media_type != 'guest') {
			$user->status = 1;
			$user->is_verified = 1;
		}

		if ($user->save() && $user->social_media_type == 'web') {
			$emailService = (new EmailService);
			$emailService->sendActivationCode($user);
		}

		$this->subcriber($user);

		return $user;

	}

	public function getUserByActivationCode($code)
	{
		return $this->model()
			->where('verification_token', $code)
			->first();
	}

	public function setPassword($value)
	{
		$this->password = $value;

		return $this;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function setEmail($value)
	{
		$this->email = $value;

		return $this;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function setSocialMediaId($value)
	{
		$this->socialMediaId = $value;

		return $this;
	}

	public function getSocialMediaId()
	{
		return $this->socialMediaId;
	}

	public function setSocialMediaType($value)
	{
		$this->socialMediaType = $value;

		return $this;
	}

	public function getSocialMediaType()
	{
		return $this->socialMediaType;
	}

	public function setFirstName($value)
	{
		$this->firstName = $value;

		return $this;
	}

	public function getFirstName()
	{
		return $this->firstName;
	}

	public function setLastName($value)
	{
		$this->lastName = $value;

		return $this;
	}

	public function getLastName()
	{
		return $this->lastName;
	}

	public function setPhone($value)
	{
		$this->phone = $value;

		return $this;
	}

	public function getPhone()
	{
		return $this->phone;
	}

	public function setDob($value)
	{
		$this->dob = $value;

		return $this;
	}

	public function getDob()
	{
		return $this->dob;
	}

	public function setGender($value)
	{
		$this->gender = $value;

		return $this;
	}

	public function getGender()
	{
		return $this->gender;
	}

	public function setRemember($value)
	{
		$this->remember = $value;

		return $this;
	}

	public function getRemember()
	{
		return $this->remember;
	}

	public function setAvatar($value)
	{
		$this->avatar = $value;

		return $this;
	}

	public function getAvatar()
	{
		return $this->avatar;
	}

	public function setToken($value)
	{
		$this->token = $value;

		return $this;
	}

	public function getToken()
	{
		return $this->token;
	}

	public function auth($user = null)
	{
		return is_null($user) ?
		Auth::attempt([
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
            'status' => 1,
            'is_verified' => 1,
        ], $this->getRemember()) :

        Auth::login($user, true);
	}

	public function logout()
	{
		return Auth::logout();
	}

	public function getUserByEmail($email)
	{
		return $this->model()
			->where('email', $email)
			->first();
	}

	public function forgot()
	{
		$user = $this->getUserByEmail($this->getEmail());

		$user->verification_token = strtolower(str_random(60));
		$user->verification_expired = $this->date->addHour();

		if ($user->update()) {
			(new EmailService)->sendForgotCode($user);
		}
	}

	public function reset()
	{
		$user = $this->getUserByActivationCode($this->getToken());

		if (!$user) {
            throw new Exception("Token code not found!", 1);
        }

        if ($user->verification_expired <= $this->date) {
            throw new Exception("Token code expired!", 1);
        }

		$user->password = $this->getPassword();

		$user->update();

	}

	public function update($id)
	{
		$user = $this->model()->where('id', $id)->first();
		$user->first_name = $this->getFirstName();
		$user->last_name = $this->getLastName();
		$user->phone_number = $this->getPhone();
		$user->dob = $this->getDob();
		$user->gender = $this->getGender();

		if ($this->getSocialMediaType()) {
			$user->password = $this->getPassword();
			$user->social_media_type = $this->getSocialMediaType();

			$user->update();

			$user->passwordString = $this->getPassword();
			$emailService = (new EmailService);
			$emailService->sendActivationCode($user);
		} else {
			$user->update();
		}
	}

    public function updateLastLogin($id)
    {
        $user = $this->model()->where('id', $id)->first();
        $user->last_login = $this->date;

        $user->update();
    }

	public function persistCreditCard($request, $id = null)
	{
		$cc = is_null($id) ? new CreditCard : $this->getCreditCardById($id);
		$cc->card_number = $this->encryptCreditCard($request->input('card_number'));
		$cc->expired_date = $request->input('expired_date');
		$cc->name_card = $request->input('name_card');
		$cc->is_default = is_null($id) ? $this->getDefault() : $cc->is_default;

		if (is_null($id)) {
			$cc->user()->associate($this->getUser());
			$cc->address()->associate($request->input('address'));
		}

		$cc->save();
	}

	public function getCreditCardById($id)
	{
		return CreditCard::where('id', $id)
			->first();
	}

	public function setUser($value)
	{
		$this->user = $value;

		return $this;
	}

	public function getUser()
	{
		return $this->user;
	}

	public function persistAddress($request, $id = null)
	{
		$address = is_null($id) ? new Address : $this->getAddressById($id);
		$address->first_name = $request->input('first_name');
		$address->last_name = $request->input('last_name');
		$address->company = $request->input('company');
		$address->address_line = $request->input('address_line');
		$address->city = $request->input('city');
		$address->province = $request->input('province');
		$address->postal = $request->input('postal');
		$address->country = $request->input('country');
		$address->phone_number = $request->input('phone_number');
		$address->sub_district = $request->input('sub_district');
		$address->village = $request->input('village');
		$address->is_default = is_null($id) ? $this->getDefault() : $address->is_default;

		if (is_null($id)) {
			$address->user()->associate($this->getUser());

			//setdefault
			$add = new Address;
			$add->where('users_id', $this->getUser()->id)
			->update(array('is_default' => 0));
		}

		$address->save();
	}

	public function getAddressById($id)
	{
		return Address::where('id', $id)
			->first();
	}

	public function defaultCreditCard($request)
	{
		$ids = array($request->input('default'));

    	$user = $this->getUser();

    	$cc = new CreditCard;

    	$cc->where('users_id', $user->id)
			->whereNotIn('id', $ids)
			->update(array('is_default' => 0));

		$cc->where('users_id', $user->id)
			->whereIn('id', $ids)
			->update(array('is_default' => 1));
	}

	public function defaultAddress($request)
	{
		$ids = array($request->input('default'));

    	$user = $this->getUser();

    	$address = new Address;

    	$address->where('users_id', $user->id)
			->whereNotIn('id', $ids)
			->update(array('is_default' => 0));

		$address->where('users_id', $user->id)
			->whereIn('id', $ids)
			->update(array('is_default' => 1));
	}

	public function updatePassword($request)
	{

		$user = $this->getUser();

		if(Hash::check($request->input('old_password'), $user->password)){

	    	$user->password = $request->input('new_password');
	       	$user->update();
	    }else{

	       throw new Exception("The specified old password does not match the database password", 1);
	    }
	}

	public function persistWishlist($product, $id = null)
	{
		$wishlist = is_null($id) ? new Wishlist : $this->getWishlistById($id);
		$wishlist->content = $product;


		if (is_null($id)) {
			$wishlist->user()->associate($this->getUser());
			$wishlist->stock()->associate($product['products_id']);
		} else {
			$wishlist->stock()->associate($product['products_id']);
		}

		$wishlist->save();
	}

	public function getWishlistById($id)
	{
		return Wishlist::where('id', $id)
			->first();
	}

	public function checkWishlistExist($userId, $productId)
	{
		return Wishlist::where('products_id', $productId)
			->where('users_id', $userId)
			->first();
	}

	public function wishlistDestroy($id)
	{
		return $this->getWishlistById($id)
			->delete();
	}

	public function getWishlistByUserId($userId)
	{
		return DB::table('products')->join('wishlists', function ($join) {
            $join->on('products.id', '=', 'wishlists.products_id');
        })->join('product_images', function ($join) {
            $join->on('products.id', '=', 'product_images.products_id');
        })->join('product_designers', function ($join) {
            $join->on('products.product_designers_id', '=', 'product_designers.id')
            ->whereNull('product_designers.deleted_at');
        })->join('product_categories', function ($join) {
            $join->on('products.product_categories_id', '=', 'product_categories.id');
        })->select(
            'products.id as id',
            'products.name as name',
            'products.slug as slug',
            'products.gender as gender',
            'products.sell_price as sell_price',
            'products.price_before_discount as price_before_discount',
            'products.created_at as created_at',
            'products.updated_at as updated_at',
            'product_categories.name as category_name',
            'product_designers.id as designer_id',
            'product_designers.name as designer_name',
            'product_designers.slug as designer_slug',
            'product_images.photo as photo',
            'wishlists.id as wishlists_id'
        )
        ->where('wishlists.users_id', $userId)
        ->where('products.is_active',1)
        ->whereNull('products.deleted_at')
        ->groupBy('products.id')
        ->get();
	}

	public function changeProfile($request)
	{
		$user = $this->getUser();
		$link = 'uploads/user/profile/';

        $file = $request->file('files')[0];
        $filename = sprintf(
            "%s-%s.%s",
            strtolower($user->first_name),
            date('Ymdhis'),
            $file->getClientOriginalExtension()
        );

        //tmp file in storage local
        $path = storage_path('app/') . $link.$filename;
        //resize image
        $image = new ImageFile(Image::make($file->path())
            ->resize(self::RESIZE_IMAGE[0], self::RESIZE_IMAGE[1], function ($constraint) {
                $constraint->aspectRatio();
            })->save($path));

        $oldFile = $this->linkMergeOrUnMerge($link, $user->avatar);

		if ($oldFile) {
			Storage::delete($link . $oldFile);
		}

        $link = $this->linkMergeOrUnMerge($link.$filename);

        $user->avatar = $link;
        $user->update();

        return $link;
	}

	public function linkMergeOrUnMerge($link, $name = null)
	{
		return is_null($name) ?
		sprintf(
			"%s/%s",
			route(self::HOME_PAGE),
			$link
		) :
		explode(route(self::HOME_PAGE).'/'.$link, $name)[1];
	}

	public function subcriber($user = null)
	{
		if (!is_null($user)) {
			if ($subcriber = $this->getSubcriberByEmail($user->email)) {
				$subcriber->user()->associate($user);
				$subcriber->save();
			} else {
				$subcriber = new Subcriber;
				$subcriber->email = $user->email;
				$subcriber->user()->associate($user);
				$subcriber->save();
			}

		} else {
			$subcriber = new Subcriber;
			$subcriber->email = $this->getEmail();
			$subcriber->save();
		}

		return $subcriber;
	}

	public function getSubcriberByEmail($email)
	{
		return Subcriber::where('email', $email)
			->first();
	}

	public function setDefault($value)
	{
		$this->default = $value;

		return $this;
	}

	public function getDefault()
	{
		return $this->default;
	}

	public function getAddressDefault()
	{
		$user = $this->getUser();
		return Address::where('is_default', 1)
			->where('users_id', $user->id)
			->first();
	}

	public function ccDestroy($id)
	{
		return $this->getCreditCardById($id)
			->delete();
	}

	public function addressDestroy($id)
	{
		return $this->getAddressById($id)
			->delete();
	}

	public function getCreditCardDefault()
	{
		$user = $this->getUser();
		return CreditCard::where('is_default', 1)
			->where('users_id', $user->id)
			->first();
	}

	public function encryptCreditCard($cardNumber)
	{
		$key = config('common.encryption.key');
        $crypt = new Encryption($key);

        return $crypt->encrypt($cardNumber);
	}

	public function decryptCreditCard($cardNumber)
	{
		$key = config('common.encryption.key');
        $crypt = new Encryption($key);

        return $crypt->decrypt($cardNumber);
	}

    public function saveReview($request){

        $review = new Review;

        $review->title =  $request->input('title');
        $review->review =  $request->input('review');
        $review->location =  $request->input('location');
        $review->rating =  $request->input('star');
        $review->user()->associate($this->getUser());
        $review->product()->associate($request->input('products_id'));
        $review->save();
    }

    public function getUserById($id)
    {
        return User::where('id', $id)
            ->first();
    }

    public function getConfirmPaymentByOrderId($id)
    {
        return ConfirmPayment::where('orders_id', $id)
            ->first();
    }

}
