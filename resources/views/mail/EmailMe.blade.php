@component('mail::message')
# Email me When Price Drop
Hi {{ $data['users']['first_name'] .' '. $data['users']['last_name'] }},
 <br>
You wanted us to email you when product {{ $data['name'] }} price drop<br>

@if ($data['discount'] != null)
   {{  $data['name'] }} Now has Discount %{{ $data['discount'] }}
@elseif ($data['oldprice'] != null ) 
    {{ $data['name'] }} price was {{ $data['oldprice'] }} Now Product price is ${{ $data['price'] }}
@endif
If you are interested in our offer,<br> click on the link below to be redirected to the product details
@component('mail::button', ['url' => 'http://za3touri.com/Product/'.$data['slug']])
Product details
@endcomponent
Thanks<br>
{{ config('app.name') }}
@endcomponent