<?php
namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\user;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{
    public function index(){
        $allSellersp=product::where('type','Best Sellers')->get();
        $allArrivalsp=product::where('type',' New Arrivals')->get();
        $allproducts=product::all();
       
     
        return view('Home',compact('allSellersp','allArrivalsp','allproducts'));
    }
    // public function showproduct(){
      
    //     return view('component.productSection',);
    // }
    public function cart(){
        return view('cart');
    }
    public function checkout(){
        return view('checkout');
    }
    public function shop(){
        return view('pages.shop');
    }
    public function singleproduct($id){
            $products=product::findOrFail($id);
        return view('singleproduct',compact('products'));
    }

    public function Register(){
        return view('pages.Register');
    }
    public function Registeruser(Request $request)
    {
        $newUser = new User();
        $newUser->fullname = $request->input('fullname');
        $newUser->email = $request->input('email');
        
        // Handling picture upload
        if ($request->hasFile('picture')) {
            $picture = $request->file('picture');
            $pictureName = $picture->getClientOriginalName();
            $picture->move('uploads/profiles', $pictureName);
            $newUser->picture = $pictureName;
        }
        
        $newUser->password = bcrypt($request->input('password')); // Securely hash the password
        $newUser->type = "customer";
    
        if ($newUser->save()){
            return redirect('/login')->with("success", "Congratulations! Your account is ready.");
        }
    
        // If there's an error while saving, return to the login page with an error message
        return redirect()->back()->withInput()->with("error", "Failed to create the account. Please try again.");
    }
    

    public function login(){
        return view('pages.login');
    }
    public function loginuser(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();
    
        if ($user && Hash::check($request->input('password'), $user->password)) {
            // Correct email and password combination
    
            session()->put('id', $user->id);
            session()->put('type', $user->type);
    
            if ($user->type === "customer") {
                return redirect('/');
            }
        } else {
            // Invalid email or password
            return redirect('/login')->with("error", "Email or password is incorrect.");
        }
    }
    
    public function addToCart(Request $request)
    {
        $cartItem = new Cart();
        $cartItem->product_id = $request->input('product_id');
        $cartItem->price = $request->input('price');
        $cartItem->quantity = $request->input('quantity');
        $cartItem->save();
    
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    
    



















}
   

