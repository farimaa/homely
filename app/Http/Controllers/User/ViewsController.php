<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Article;
use App\Models\News;
use App\Models\Brand;
use App\Models\Baner;
use App\Models\User;
use App\Models\Factor;
use App\Models\Payment;
use Intervention\Image\ImageManagerStatic as Image;

class ViewsController extends Controller
{
    public function searchResults()
    {
        return view('homely.search-results');
    }

    public function propertyListing()
    {
        return view('homely.property-listing');
    }

    public function propertyView() 
    {
        return view('homely.property-view');
    }

	public function welcome() 
    {
        return view('homely.welcome');
    }

    public function register() 
    {
        return view('homely.register');
    }

    public function login() 
    {
        return view('homely.login');
    }

    public function map() 
    {
        return view('homely.map');
    }

    public function image($x)
    {
        return 1;
        $url = '/resources/img/home.png';
        $image = Image::make($url);

        return $image;
    }

    public function currentUser()
    {
        $res = '{"currentUser":{"guid":null,"authorities":[{"authority":"ROLE_GUEST"}],"password":null,"username":"anonymous","profileType":"Anonymous","displayName":"Guest","guest":true,"emailConfirmed":false,"enabled":true,"accountNonLocked":true,"accountNonExpired":true,"credentialsNonExpired":true}}';

        return $res;
    }

    public function metaPopularCities()
    {
        $res = '{"popularCities":[{"key":"copenhagen"},{"key":"aarhus"},{"key":"odense"}]}';
        
        return $res;
    }

    public function loadProperty()
    {
        $res = '{"property":{}}';
        
        return $res;
    }

    public function loadPropertySlides()
    {
        $res = '{"property":{}}';
        
        return $res;
    }

    public function metaListing()
    {
        $res = '{"propertyStatuses":["Published","NotPublished"],"propertyTypes":["Apartment","Condo","Duplex","House","Loft","Room","Townhouse"],"amenities":["WasherOrDryerUnits","Gym","PoolElevator","ParkingSpot","AirConditioning","DishwasherStorage","HardwoodFloors","Balcony","View","HighRise","Fireplace","Doorman","Deck","Wheelchair","AccessibleGarden","Furnished","StudentFriendly","UtilitiesIncluded"],"cities":[{"key":"copenhagen"},{"key":"aarhus"},{"key":"odense"},{"key":"aalborg"},{"key":"esbjerg"},{"key":"kolding"}],"animalPolicies":["Allowed","Disallowed","Discussable"],"rentingPeriods":["TwoToTwelveMonths","OneToTwoYears","TwoOrMoreYears","Unlimited"],"countries":[{"key":"dk"}]}';

        return $res;
    }

    public function searchPublished()
    {
        $res = '{"profiles":[{"guid":"7cc28c2d-fed1-4de0-949c-a7a077a89bc0","ownerGuid":"c278bd12-2b3b-489e-b049-94c7fec8624f","alias":"Room A","address":{"addressLine1":"Copenhagen","addressLine2":null,"postcode":"2400","city":"copenhagen","country":"dk"},"type":"Room","amenities":{"Gym":true,"Balcony":true,"View":true,"AccessibleGarden":true},"bedrooms":1,"area":10.0,"animalPolicy":"Disallowed","economy":{"monthlyRent":5000.0,"utilities":0.0,"deposit":15000.0,"advanceRent":15000.0,"totalOnMoveIn":35000.0},"moveInDate":null,"moveOutDate":null,"description":"Best room in the universe","imageId":"4f7356f3-a891-441c-ba2b-d93cd4eadf18","propertyStatus":"Published","rentingPeriod":"TwoToTwelveMonths"},{"guid":"1599b47b-a06b-4b52-82c2-c78a20bd6367","ownerGuid":"6b43386e-5592-4b4b-85c3-173aaa873870","alias":"App22","address":{"addressLine1":"fg","addressLine2":"g","postcode":"1111","city":"copenhagen","country":"dk"},"type":"Room","amenities":{},"bedrooms":3,"area":111.0,"animalPolicy":"Allowed","economy":{"monthlyRent":0.0,"utilities":309.0,"deposit":0.0,"advanceRent":3423.0,"totalOnMoveIn":3732.0},"moveInDate":null,"moveOutDate":null,"description":"","imageId":"42ebcb3c-026b-4923-b974-2d4826b9be17","propertyStatus":"Published","rentingPeriod":"TwoToTwelveMonths"},{"guid":"0526f56d-0bb2-4110-bdd8-ee3c5e73f243","ownerGuid":"6b43386e-5592-4b4b-85c3-173aaa873870","alias":"Capelookh","address":{"addressLine1":"1","addressLine2":null,"postcode":"1111","city":"copenhagen","country":"dk"},"type":"Apartment","amenities":{"WasherOrDryerUnits":true,"Balcony":true,"View":true,"HighRise":true,"Fireplace":true,"Doorman":true,"UtilitiesIncluded":true,"StudentFriendly":true,"Furnished":true},"bedrooms":2,"area":111.0,"animalPolicy":"Allowed","economy":{"monthlyRent":1.9999999999999998E23,"utilities":2.0,"deposit":2.0,"advanceRent":2.0,"totalOnMoveIn":1.9999999999999998E23},"moveInDate":null,"moveOutDate":null,"description":"Shlyapa","imageId":"322cf262-44d0-464b-b445-9b134aba7912","propertyStatus":"Published","rentingPeriod":"TwoToTwelveMonths"},{"guid":"3954a9dc-14c5-4a31-9d94-f28c68b3aebe","ownerGuid":"c3a6e06f-d77c-467e-9e74-22f8063d6ee1","alias":"Cool Room in Copenhagen","address":{"addressLine1":"Kultorvet 11, 4th floor","addressLine2":null,"postcode":"1175","city":"copenhagen","country":"dk"},"type":"Apartment","amenities":{"WasherOrDryerUnits":true,"AirConditioning":true,"View":true},"bedrooms":1,"area":10.0,"animalPolicy":"Disallowed","economy":{"monthlyRent":5000.0,"utilities":1000.0,"deposit":10000.0,"advanceRent":10000.0,"totalOnMoveIn":26000.0},"moveInDate":null,"moveOutDate":null,"description":"A great place to live - other info coming soon but trust me, you want to live here","imageId":"a15cada5-aaae-40de-87a8-cb85c77d813a","propertyStatus":"Published","rentingPeriod":"TwoToTwelveMonths"},{"guid":"84da23db-7ec4-40c4-bb5a-f37c455e31d5","ownerGuid":"174a8ee0-3108-4ead-bec4-4b2909deb079","alias":"my first listing","address":{"addressLine1":"my sample address","addressLine2":"my sample address2","postcode":"1111","city":"copenhagen","country":"dk"},"type":"Apartment","amenities":{"Gym":true,"PoolElevator":true,"ParkingSpot":true},"bedrooms":3,"area":100.0,"animalPolicy":"Allowed","economy":{"monthlyRent":1000.0,"utilities":1000.0,"deposit":1000.0,"advanceRent":1000.0,"totalOnMoveIn":4000.0},"moveInDate":null,"moveOutDate":null,"description":"my first listing description","imageId":"0aa2a854-2bd2-4534-99a1-70e7a7e3b506","propertyStatus":"Published","rentingPeriod":"OneToTwoYears"}]}';

        return $res;
    }
    public function translate()
    {
       return '{"listing.utilities":"Utilities","listing.deposit.placeholder":"Input deposit amount","listing.amenities.ParkingSpot":"Parking spot","profile.password.tip":"In edit mode you will be able to change your password","payment.methods.account.number.error":"Should be valid IBAN","listing.type.Loft":"Loft","listing.renting.period.Unlimited":"Unlimited","listing.min.area":"Min area (m²) ","listing.monthly.rent.placeholder":"Input monthly rate","system.return":"Navigate back","listing.group.amenities":"Amenities","listing.title.update":"Update listing","listing.group.details":"Details","rent.state.status.Accepted":"Accepted","email.confirmation.error":"Error. We cannot confirm your email. Please re-try from your profile page.","listing.type":"Property type","listing.address.city.help":"Should be non-empty","payment.methods.address.line2":"Address Line 2","sign.up.header":"Sign up","payment.methods.address.line1":"Address Line 1","listing.amenities.Wheelchair":"Wheelchair","listing.group.move.in":"Move in","sign.in.password.recover":"Forgot?","password.recover.email.error":"Please enter valid email","listing.amenities.PoolElevator":"Pool elevator","profile.update.error.forbidden":"Forbidden. Please make sure you input correct password.","listing.address.line2.placeholder":"Specify address line 2 for this listing","sign.in.remember.me":"Remember me","profile.update.error.general":"Cannot update profile","header.select.language":"Language","welcome.search.help":"Use either search box above or select one of the popular cities below","listing.address.postcode.placeholder":"Specify postcode","sign.up.email.label":"Email","payment.methods.display.name.error":"Should be non-empty and contain full name","sign.up.profile.type.tenant":"Tenant","footer-copyright":"Homely Project (C) 2018","rent.state.status.Rejected":"Rejected","listing.amenities.AccessibleGarden":"Accessible garden","sign.in.email.placeholder":"Specify your email address","listing.advance.rent":"Advance rent","rent.state.status.Expired":"Expired","payment.methods.account.number":"Account number/IBAN","listing.amenities.WasherOrDryerUnits":"Washer or dryer units","listing.type.Townhouse":"Townhouse","listing.bedrooms.help":"Should be integer value from zero up","payment.methods.swift.address":"BIC (swift address)","sign.in.go.register":"No account yet?","password.recover.email":"Your email","password.recover.title":"Recover password","header.menu.messages":"Messages","listing.search.placeholder":"Search by street, city or alias","listing.renting.period.TwoToTwelveMonths":"2-12 months","welcome.header":"Hello! Where do you want to live?","sign.up.display.name.error":"Should not be empty","listing.alias":"Alias","payment.methods.city":"City","welcome.search.placeholder":"Search by city name or zip code","listing.monthly.rent":"Monthly rate","search.results.title":"Search listings","sign.up.profile.type.landlord":"Landlord","rent.state.status.Offered":"Offered","listing.monthly.rent.help":"Should be non-empty","listing.status":"Property visibility status","sign.in.password.placeholder":"Specify your password","profile.update.success":"Profile was updates successfully","listing.amenities.Deck":"Deck","system.currency":"DKK","profile.old.password.placeholder":"Specify current password","profile.email.unconfirmed":"Email not confirmed yet. Re-send confirmation link.","sign.up.password.repeat.error":"Password inputs dont match","sign.up.email.placeholder":"Specify your email address","listing.address.city.placeholder":"Select city","profile.new.password":"New password","profile.email.confirmation.sent":"Email confirmation re-sent","listing.animals.Disallowed":"No way","listing.address.country":"Country","sign.up.password.repeat.placeholder":"Please specify your password again","profile.new.password.confirm":"Confirm new password","gallery.management.primary":"Primary image","sign.in.email.label":"Email","payment.methods.address.line1.error":"At least address line 1 should not be empty","property.view.contact":"Contact","sign.up.display.name.placeholder":"Specify your real full name","email.confirmation.success":"Thank you! Your email is now confirmed.","profile.old.password":"Current password","sign.up.sign.in":"Already registered? Sign in","listing.amenities.Furnished":"Furnished","listing.address.line2":"Address line 2","listing.description.placeholder":"Specify description for this listing","listing.address.line1":"Address line 1","listing.amenities.HardwoodFloors":"Hardwood floors","sign.up.sign.up":"SIGN UP","listing.amenities.Balcony":"Balcony","password.recover.email.placeholder":"Specify your email","sign.in.password.label":"Password","payment.methods.display.name.placeholder":"Specify payment receiver name","sign.up.password.label":"Password","listing.area":"Area (m²)","listing.back":"Back to listings","sign.up.profiletype.error":"Please select your profile type in system","header.welcome":"Signed as:","profile.new.password.confirm.error":"Passwords dont match","end.date.unlimited":"Unlimited","listing.title.new":"Creating new listing","listing.animals.Allowed":"Allowed","header.log.out":"Sign out","listing.amenities.Doorman":"Doorman","password.recover.sent":"Check your email for instructions","property.view.map":"Map","listing.renting.period.TwoOrMoreYears":"2+ years","header.select.language.en":"English","payment.methods.country":"Country","payment.methods.postcode":"Postal code","password.recover.send":"Send link","sign.in.sign.in":"SIGN IN","system.password.help":"Minimum eight characters, at least one upper case letter, one lower case letter and one number","search.no.results":"No results","listing.group.basic":"Basic","listing.type.Apartment":"Apartment","payment.methods.account.number.placeholder":"Specify valid IBAN","gallery.management.upload":"Upload images","listing.utilities.help":"Should be non-empty","listing.type.House":"House","sign.up.display.name.label":"Display name","payment.methods.swift.address.placeholder":"Specify BIC","sign.up.profile.type.label":"I am","listing.group.address":"Address","listing.address.postcode.help":"Should be non-empty Danish postcode","listing.save":"Save","listing.advance.rent.placeholder":"Input advance rent amount","profile.new.password.placeholder":"Specify your new password","listing.area.help":"Should be positive numeric value","payment.methods.address.line1.placeholder":"Specify address","listing.image.help":"You will be able to upload images after property is saved","listing.type.Room":"Room","sign.in.header":"Sign in","listing.status.NotPublished":"Not published","header.select.language.da":"Dansk","listing.alias.help":"Should be non-empty string. Try to give meaningful value you can search later.","listing.group.economy":"Economy","listing.animals.Discussable":"Discussable","listing.amenities.Fireplace":"Fireplace","listing.renting.period":"Renting period","property.view.owner":"Owner","sign.up.password.repeat.label":"Confirm password","listing.deposit.help":"Should be non-empty","header.menu.listings":"Listings","listing.status.Published":"Published","listing.address.postcode":"Postcode","listing.total.on.move.in.max":"Max total on move in","payment.methods.swift.address.error":"Should be valid BIC","listing.amenities.AirConditioning":"Air conditioning","listing.renting.period.OneToTwoYears":"1-2 years","listing.type.Duplex":"Duplex","header.menu.profile":"Profile","listing.address.city":"City","property.view.description":"Description","payment.methods.save":"Save","property.view.button.offer":"Make Offer Now","profile.header":"Manage profile","listing.animals":"Animal policy","listing.advance.rent.help":"Should be non-empty","listing.type.Condo":"Condo","listing.utilities.placeholder":"Input utilities amount","payment.methods.postcode.error":"Should not-empty 4 digits code","listing.address.line1.placeholder":"Specify address line 1 for this listing","sign.up.password.placeholder":"Specify your password","password.recover.back":"Return to login","properties.listing.filter":"Filter","listing.amenities.HighRise":"High rise","listing.alias.placeholder":"Specify alias for this listing","listing.create.new":"List new place","city.aalborg":"Aalborg","rent.state.status.Canceled":"Canceled","listing.manage.gallery":"Manage gallery","listing.total.on.move.in":"Total on move in","payment.methods.title":"Payment Methods","listing.title":"Manage listings","listing.amenities.DishwasherStorage":"Dishwasher storage","gallery.management.delete":"Delete","listing.description":"Description","profile.old.password.error":"Should not be empty","payment.methods.postcode.placeholder":"Specify postal code","header.sign.up":"Sign up","listing.area.placeholder":"Specify property area","sign.up.email.error":"Cannot recognize valid email","gallery.management.back":"Back","profile.new.password.confirm.placeholder":"Confirm your new password","payment.methods.display.name":"Name","listing.bedrooms.placeholder":"Specify number of bedrooms","city.aarhus":"Aarhus","listing.amenities.UtilitiesIncluded":"Utilities included","city.copenhagen":"Copenhagen","profile.cancel":"Cancel","listing.deposit":"Deposit","country.dk":"Denmark","economy.currency.dkk":"DKK","profile.edit":"Edit profile","payment.methods.address.line2.placeholder":"Specify address","listing.address.line1.help":"Should be non-empty","search.filter.go":"Run filter","listing.amenities.StudentFriendly":"Student friendly","listing.monthly.rent.max":"Max monthly rate","city.esbjerg":"Esbjerg","welcome.search.button":"Search","profile.update":"Update","listing.bedrooms":"Bedrooms","header.menu.bookings":"Bookings","city.odense":"Odense","header.log.in":"Sign in","search.filter.clear":"Clear filters","listing.amenities.Gym":"Gym","sign.up.profile.type.placeholder":"Click here to select your profile type","header.menu.payment.methods":"Payment methods","city.kolding":"Kolding","listing.amenities.View":"View","gallery.management.title":"Manage property gallery"}'; 
    }
}

