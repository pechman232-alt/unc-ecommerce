<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;
use App\Models\EasyLink;
use App\Models\SiteMenu;

class SettingController extends Controller
{
    public function index(){
        $logos = Settings::where('key','site.logo.front')->first();
        $sitesIcon = Settings::where('key', 'site.icon')->first();
        $siteName = Settings::where('key', 'site.sitename')->first();
        return view('backend.Settings.index',['logos'=>$logos, 'sitesIcon'=>$sitesIcon, 'siteName'=>$siteName]);
    }

    // --------------------------- Header Logo --------------------------------------------------
    public function uploadLogo(){
        $logos = Settings::where('key','site.logo.front')->first();
        return view('backend.Settings.Header.update-logo',['logos'=>$logos]);
    }

    public function updateLogo(Request $request, $id){
        $logos = Settings::where('key','site.logo.front')->firstorfail();

        $file = $request->file('header-logo');
        if(!empty($file)){
            $name = md5($file->getFilename() . time()) . '.' . $file->getClientOriginalExtension();
            $file_dir  = '/logos/';
            $file->move(storage_path($file_dir), $name);
            $logos->value = $name;
        }
        $logos->update();
        return redirect()->back()->with('update','Header Logo Updated Successully!');
    }

    // --------------------------- End Header Logo --------------------------------------------------


    // --------------------------- Icon and Sitename --------------------------------------------------
    public function uploadSites(){
        $sitesIcon = Settings::where('key', 'site.icon')->first();
        $siteName = Settings::where('key', 'site.sitename')->first();
        return view('backend.Settings.Header.update-icons-sitename',['sitesIcon'=>$sitesIcon, 'siteName'=>$siteName]);
    }

    public function updateSiteIcon(Request $request, $id){
        $sitesIcon = Settings::where('key', 'site.icon')->first();
        $sitesIcon->updated_by = auth('user')->user()->full_name;

        $file = $request->file('site-icon');
        if(!empty($file)){
            $name = md5($file->getFilename() . time()) . '.' . $file->getClientOriginalExtension();
            $file_dir  = '/logos/';
            $file->move(storage_path($file_dir), $name);
            $sitesIcon->value = $name;
        }
        $sitesIcon->update();
        return redirect()->back()->with('update','IconSite is Updated Successully!');
    }

    public function updateSiteName(Request $request, $id){
        $siteName = Settings::where('key', 'site.sitename')->first();
        $siteName->value = $request->value;
        $siteName->updated_by = auth('user')->user()->full_name;
        $siteName->update();

        return redirect()->back()->with('success','Sitename is Updated Successully!');
    }
    // --------------------------- End Icon and Sitename --------------------------------------------------

    // --------------------------- Header Phonenumber --------------------------------------------------

    public function updatePhoneMails(){
        $getNumberphone = Settings::where('key', 'site.phonenumber')->first();
        $getMail = Settings::where('key', 'site.mail')->first();
        return view('backend.Settings.Header.update-phonenumber',['getNumberphone'=>$getNumberphone,'getMail'=>$getMail]);
    }

    public function updatePhonenumber(Request $request, $id){
        $numberPhone = Settings::where('key', 'site.phonenumber')->first();
        $numberPhone->value = $request->value;
        $numberPhone->updated_by = auth('user')->user()->full_name;
        $numberPhone->update();

        return redirect()->back()->with('success','Phone Number is Updated Successully!');
    }

    public function updateMail(Request $request, $id){
        $mail = Settings::where('key', 'site.mail')->first();
        $mail->value = $request->value;
        $mail->updated_by = auth('user')->user()->full_name;
        $mail->update();

        return redirect()->back()->with('success','Mail is Updated Successully!');
    }

    // --------------------------- End Header Phonenumber ----------------------------------------------

    // Others Color Code
    public function colorCode(){
        $getColorCodes = Settings::where('key','site.color')->first();
        $getTextfooter = Settings::where('key', 'site.textfooter')->first();
        return view('backend.Settings.Others.update-color-footer',['getColorCodes'=>$getColorCodes, 'getTextfooter'=>$getTextfooter]);
    }

    public function updateColorCode(Request $request, $id){
        $colorCode = Settings::where('key','site.color')->first();
        $colorCode->value = $request->value;
        $colorCode->updated_by = auth('user')->user()->full_name;
        $colorCode->update();

        return redirect()->back()->with('success','ColorCode is Updated Successully!');
    }

    public function updateTextfooter(Request $request, $id){
        $textfooter = Settings::where('key','site.textfooter')->first();
        $textfooter->value = $request->value;
        $textfooter->updated_by = auth( 'user')->user()->full_name;
        $textfooter->update();

        return redirect()->back()->with('success','TextFooter is Updated Successully!');
    }

    // Others Links Chat
    public function linkChat(){
        $getLinkChat = Settings::where('key','site.chat')->first();
        $getLinkTelegram = Settings::where('key','site.telegram')->first();

        return view('backend.Settings.Others.update-link-chat',['getLinkChat'=>$getLinkChat,'getLinkTelegram'=>$getLinkTelegram]);
    }

    public function updateLinkChat(Request $request, $id){
        $linkChat = Settings::where('key','site.chat')->first();
        $linkChat->link = $request->link;
        $linkChat->updated_by = auth('user')->user()->full_name;
        $linkChat->update();

        return redirect()->back()->with('success','Link Chat is Updated Successully!');
    }

    public function updateLinkTelegram(Request $request, $id){
        $linkTelegram = Settings::where('key','site.telegram')->first();
        $linkTelegram->link = $request->link;
        $linkTelegram->updated_by = auth('user')->user()->full_name;
        $linkTelegram->update();

        return redirect()->back()->with('success','Link Telegram is Updated Successully!');
    }

    // -----------------------------------------------------------------


    // Easy Links
    public function easyLinks(){
        $easyLinks = EasyLink::selectRaw(
            'easy_links.id,
            site_menu.name as name'
        )
        ->join('site_menu','site_menu.id','=','easy_links.menu_id')
        ->where('easy_links.status', 1)
        ->get();
        
        $getSiteMenus = SiteMenu::get();
        return view('backend.Settings.Footer.Easy-Links.index',['easyLinks' => $easyLinks,'getSiteMenus' => $getSiteMenus]);
    }

    public function insertEasylink(Request $request){

        $sitMenu = SiteMenu::where('id', $request->menu_id)->first();

        $easyLinks = New EasyLink;
        $easyLinks->menu_id = $request->menu_id;

        if($sitMenu->isActiveMenu == '1'){
            $easyLinks->route = "pages";
        }else{
            $easyLinks->route = "page";
        }
        $easyLinks->created_by = auth('user')->user()->full_name;
        $easyLinks->status = 1;
        $easyLinks->save();
        return redirect()->back()->with('success','EasyLinks is Inserted Successully!');
    }

    public function destroyEasaLink($id){
        $ID = decrypt($id);
        $easyLinks = EasyLink::where('id', $ID)->firstorfail()->delete();
        return redirect()->back()->with('delete','EasyLinks is Deleted SSuccessully');
    }

    // Contact Us
    public function contactUs(){
        $locations = Settings::where('key', 'site.location')->first();
        $emails = Settings::where('key','site.email')->first();
        $numberphones = Settings::where('key','site.numberphone')->first();
        return view('backend.Settings.Footer.Contacts-Us.index',['locations' => $locations,'emails' => $emails,'numberphones' => $numberphones]);
    }

    public function updatedLocations(Request $request){
        $locations = Settings::where('key','site.location')->first();
        $locations->value = $request->value;

        $file = $request->file('icon_photo');
        if(!empty($file)){
            $name = md5($file->getFilename() . time()) . '.' . $file->getClientOriginalExtension();
            $file_dir  = '/logos/';
            $file->move(storage_path($file_dir), $name);
            $locations->link = $name;
        }

        $locations->updated_by = auth('user')->user()->full_name;
        $locations->update();
        return redirect()->back()->with('update','Locations is Updated Successully!');

    }

    public function updatedEmail(Request $request){
        $emails = Settings::where('key','site.email')->first();
        $emails->value = $request->value;

        $file = $request->file('icon_photo');
        if(!empty($file)){
            $name = md5($file->getFilename() . time()) . '.' . $file->getClientOriginalExtension();
            $file_dir  = '/logos/';
            $file->move(storage_path($file_dir), $name);
            $emails->link = $name;
        }

        $emails->updated_by = auth('user')->user()->full_name;
        $emails->update();
        return redirect()->back()->with('update','Emails is Updated Successully!');
    }

    public function updatedNumberPhone(Request $request){
        $numberPhones = Settings::where('key','site.numberphone')->first();
        $numberPhones->value = $request->value;

        $file = $request->file('icon_photo');
        if(!empty($file)){
            $name = md5($file->getFilename() . time()) . '.' . $file->getClientOriginalExtension();
            $file_dir  = '/logos/';
            $file->move(storage_path($file_dir), $name);
            $numberPhones->link = $name;
        }

        $numberPhones->updated_by = auth('user')->user()->full_name;
        $numberPhones->update();
        return redirect()->back()->with('update','NumberPhone is Updated Successully!');
    }

    // Payment Accepet
    public function paymentAccepet(){
        $getImages = Settings::where('key','site.payment_image')->get();
        return view('backend.Settings.Footer.Payment-Accepet.index',['getImages' => $getImages]);
    }

    public function uploadImagePayment(Request $request){

        $request->validate([
            'img_payment' => 'required'
        ]);

        $imgPayments = new Settings;
        $imgPayments->key = "site.payment_image";
        $imgPayments->status = 1;
        $imgPayments->updated_by = auth('user')->user()->full_name;

        $file = $request->file('img_payment');
        if(!empty($file)){
            $name = md5($file->getFilename() . time()) . '.' . $file->getClientOriginalExtension();
            $file_dir  = '/logos/';
            $file->move(storage_path($file_dir), $name);
            $imgPayments->value = $name;
        }

        $imgPayments->save();
        return redirect()->back()->with('success','Image Payment is Inserted Successully!');
    }

    public function destroyImagePayment($id){
        $ID = decrypt($id);
        $imgPayments = Settings::where('id', $ID)->firstorfail()->delete();
        return redirect()->back()->with('delete','Image Payment is Delete Successully!');
    }

    // Follow Us
    public function indexFollowUs(){
        $getFollowUs = Settings::where('key','site.follow_us')->get();
        return view('backend.Settings.Footer.Follow-Us.index',['getFollowUs' => $getFollowUs]);
    }

    public function uploadFollowUs(Request $request){

        $request->validate([
            'link' => 'required',
            'follow_us' => 'required'
        ]);

        $followUs = New Settings();
        $followUs->key = "site.follow_us";
        $followUs->link = $request->link;
        $followUs->status = 1;
        $followUs->updated_by = auth('user')->user()->full_name;

        $file = $request->file('follow_us');
        if(!empty($file)){
            $name = md5($file->getFilename() . time()) . '.' . $file->getClientOriginalExtension();
            $file_dir  = '/logos/';
            $file->move(storage_path($file_dir), $name);
            $followUs->value = $name;
        }

        $followUs->save();
        return redirect()->back()->with('success','Follow is Upload Successully!');

    }

    public function logos($path){
        $storagePath = storage_path('/logos/'.$path);
        return response()->file($storagePath);
    }
}
