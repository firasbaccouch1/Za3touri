<template>
<div class="app-content">


            <!--====== Section 1 ======-->
            <div class="u-s-p-y-60">

                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container">
                        <div class="breadcrumb">
                            <div class="breadcrumb__wrap">
                                <ul class="breadcrumb__list">
                                    <li class="has-separator">
                                        <router-link :to="{name:'Home'}">Home</router-link></li>
                                    <li class="is-marked">
                                        <router-link :to="{name:'Checkout'}" >Checkout</router-link></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section 1 ======-->


            <!--====== Section 2 ======-->
            <div v-if="activecoupon == false" class="u-s-p-b-60">

                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="checkout-msg-group">
                                    <div class="msg">

                                        <span class="msg__text">Have a coupon?

                                            <a class="gl-link" href="#have-coupon" data-toggle="collapse">Click Here to enter your code</a></span>
                                        <div class="collapse" id="have-coupon" data-parent="#checkout-msg-group">
                                            <div class="c-f u-s-m-b-16">

                                                <span class="gl-text u-s-m-b-16">Enter your coupon code if you have one.</span>
                                                <form class="c-f__form">
                                                    <div class="u-s-m-b-16">
                                                        <div class="u-s-m-b-15">
                                                            <label for="coupon"></label>

                                                            <input class="input-text input-text--primary-style" v-model="form.coupon" type="text" id="coupon" placeholder="Coupon Code"></div>
                                                        <div class="u-s-m-b-15">

                                                            <button class="btn btn--e-transparent-brand-b-2" @click.prevent="ApplyCoupon()" type="submit">APPLY</button></div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--====== End - Section Content ======-->
            </div>
            <!--====== End - Section 2 ======-->


            <!--====== Section 3 ======-->
            <div class="u-s-p-b-60">

                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container">
                        <div class="checkout-f">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h1 class="checkout-f__h1">DELIVERY INFORMATION</h1>
                                    <form class="checkout-f__delivery">
                                        <div class="u-s-m-b-30">
                                          
                                            <div class="u-s-m-b-15">

                                                <!--====== Check Box ======-->
                                                <div class="check-box">

                                                    <input v-model="loading"  @click='usedefaultAddress($event)'    type="checkbox" id="checkboxdefault" >
                                                    <div class="check-box__state check-box__state--primary">

                                                        <label class="check-box__label" for="checkboxdefault">Use default shipping and billing address from account</label></div>
                                                </div>
                                                <!--====== End - Check Box ======-->
                                            </div>
                                                  <fieldset  :disabled="loading">
                                                             <ul class="dash__f-list">
                                                <li v-for="error in errors" :key='error.index'>
                                                    <span  class="text-danger" >- {{ error[0] }}</span>
                                                </li>
                                            </ul>
                                            <!--====== First Name, Last Name ======-->
                                            <div class="gl-inline">
                                                <div class="u-s-m-b-15">

                                                    <label class="gl-label" for="billing-fname">FIRST NAME *</label>

                                                    <input v-model="form.first_name" class="input-text input-text--primary-style" type="text" id="billing-fname" data-bill=""></div>
                                                <div class="u-s-m-b-15">

                                                    <label class="gl-label" for="billing-lname">LAST NAME *</label>

                                                    <input v-model="form.last_name" class="input-text input-text--primary-style" type="text" id="billing-lname" data-bill=""></div>
                                            </div>
                                            <!--====== End - First Name, Last Name ======-->


                                            <!--====== E-MAIL ======-->
                                            <div class="u-s-m-b-15">

                                                <label class="gl-label" for="billing-email">E-MAIL *</label>

                                                <input v-model="form.email" class="input-text input-text--primary-style" type="text" id="billing-email" data-bill=""></div>
                                            <!--====== End - E-MAIL ======-->


                                            <!--====== PHONE ======-->
                                            <div class="u-s-m-b-15">

                                                <label class="gl-label" for="billing-phone">PHONE *</label>

                                                <input v-model="form.phone" class="input-text input-text--primary-style" type="text" id="billing-phone" data-bill=""></div>
                                            <!--====== End - PHONE ======-->


                                            <!--====== Street Address ======-->
                                            <div class="u-s-m-b-15">

                                                <label  class="gl-label" for="billing-street">STREET ADDRESS *</label>

                                                <input v-model="form.street_address" class="input-text input-text--primary-style" type="text" id="billing-street" placeholder="House name and street name" data-bill=""></div>
                                            <!--====== End - Street Address ======-->


                                            <!--====== Country ======-->
                                            <div class="u-s-m-b-15">

                                                <!--====== Select Box ======-->

                                                <label class="gl-label" for="billing-country">COUNTRY *</label>
                                                <select @change="changecountry($event)" class="select-box select-box--primary-style" id="billing-country" data-bill="">
                                                    <option disabled selected="" value="">Choose Country</option>
                                                    <option :value="Country.id" v-for='Country in Countries' :key='Country.index'>{{ Country.nicename }} ({{ Country.iso }})</option>
                                                </select>
                                                <!--====== End - Select Box ======-->
                                            </div>
                                            <!--====== End - Country ======-->


                                            <!--====== Town / City ======-->
                                            <div class="u-s-m-b-15">

                                                <label class="gl-label" for="billing-town-city">TOWN/CITY *</label>

                                                <input v-model="form.city" class="input-text input-text--primary-style" type="text" id="billing-town-city" data-bill=""></div>
                                            <!--====== End - Town / City ======-->


                                            <!--====== STATE/PROVINCE ======-->
                                            <div class="u-s-m-b-15">

                                                <label class="gl-label" for="billing-state">STATE/PROVINCE *</label>

                                                <input v-model="form.state" class="input-text input-text--primary-style" type="text" id="billing-state" data-bill=""></div>
                                            <!--====== End - STATE/PROVINCE ======-->


                                            <!--====== ZIP/POSTAL ======-->
                                            <div class="u-s-m-b-15">

                                                <label class="gl-label" for="billing-zip">ZIP/POSTAL CODE *</label>

                                                <input v-model="form.zip_code" class="input-text input-text--primary-style" type="text" id="billing-zip" placeholder="Zip/Postal Code" data-bill=""></div>
                                            <!--====== End - ZIP/POSTAL ======-->
                                            </fieldset> 
                                            <div class="u-s-m-b-10">
                                            </div>
                                            <div class="u-s-m-b-10">
                                                <router-link class="gl-link" :to='{name:"AddressBook"}' >Want to create a new shipping & billing address?</router-link></div>
                                            <div class="u-s-m-b-10">

                                                <label class="gl-label" for="order-note">ORDER NOTE</label>
                                                <textarea v-model="form.note" class="text-area text-area--primary-style" id="order-note"></textarea></div>
                                       
                                       </div>
                                    </form>
                                </div>
                                <div class="col-lg-6">
                                    <h1 class="checkout-f__h1">ORDER SUMMARY</h1>

                                    <!--====== Order Summary ======-->
                                    <div class="o-summary">
                                        <div class="o-summary__section u-s-m-b-30">
                                            <div class="o-summary__item-wrap gl-scroll">
                                                <div v-for="Cart in cart.Cart_Data" :key='Cart.index' class="o-card">
                                                    <div class="o-card__flex">
                                                        <div class="o-card__img-wrap">

                                                            <img class="u-img-fluid" v-lazy="Cart.product.thumbnail" alt=""></div>
                                                        <div class="o-card__info-wrap">

                                                            <span class="o-card__name">

                                                                <router-link :to='{name:"Product",params:{slug:Cart.product.slug}}'>{{ Cart.product.name }}</router-link></span>

                                                            <span class="o-card__quantity">Quantity x {{ Cart.quantity }}</span>

                                                            <span v-if="Cart.product.discount != null" class="mini-product__price">${{ parseFloat(Cart.product.price - ((Cart.product.discount.discount*Cart.product.price)/100)).toFixed(0) }}
                                                            <span class="product-o__discount">${{ Cart.product.price }}</span></span>
                                                            <span v-else class="mini-product__price">${{ parseFloat(Cart.product.price * Cart.quantity).toFixed(0)}}</span>
                                                            </div>
                                                    </div>

                                                    <a @click='DeleteCart(Cart.product.slug)' class="o-card__del far fa-trash-alt"></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div v-if="loading" class="o-summary__section u-s-m-b-30">
                                            <div class="o-summary__box">
                                                <h1 class="checkout-f__h1">SHIPPING &amp; BILLING</h1>
                                                <div class="ship-b">
                                                    <div class="ship-b__box">

                                                        <span class="ship-b__text">Bill to default billing address</span>

                                                        <router-link :to='{name:"AddressBook"}' class="ship-b__edit btn--e-transparent-platinum-b-2" >Edit</router-link>
                                                    </div>
                                                    <span class="ship-b__text">Ship to:</span>
                                                    <div class="ship-b__box u-s-m-b-10">
                                                        <p class="ship-b__p">{{ AddressBook.country.nicename }} {{ AddressBook.state }} {{ AddressBook.street_address }} (+{{AddressBook.country.phonecode }}) {{ AddressBook.phone }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="o-summary__section u-s-m-b-30">
                                            <div class="o-summary__box">
                                                <table class="o-summary__table">
                                                    <tbody>
                                                            <tr>
                                                                <td>SHIPPING</td>
                                                                <td>${{ cart.Shipping }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>TAX</td>
                                                                <td>%{{ cart.Tax }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>SUBTOTAL</td>
                                                                <td>$ {{ parseFloat(cart.Sub_Total).toFixed(0) }}</td>
                                                            </tr>
                                                            <tr v-if="activecoupon ==true">
                                                                <td>Coupon</td>
                                                                <td>-${{ parseFloat(((cart.Total*Coupon.discount)/100)).toFixed(0) }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>GRAND TOTAL</td>
                                                            <td >${{ parseFloat(cart.Total - cart.Total*Coupon.discount/100).toFixed(0)}}</td>
                                                            </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="o-summary__section u-s-m-b-30">
                                            <div class="o-summary__box">
                                                <h1 class="checkout-f__h1">PAYMENT INFORMATION</h1>
                                                <form class="checkout-f__payment">
                                                    <div class="u-s-m-b-10">

                                                        <!--====== Radio Box ======-->
                                                        <div class="radio-box">

                                                            <input type="radio" id="pay-with-card" checked name="payment">
                                                            <div class="radio-box__state radio-box__state--primary">

                                                                <label class="radio-box__label" for="pay-with-card">Pay With Credit / Debit Card</label></div>
                                                        </div>
                                                        <!--====== End - Radio Box ======-->
                                                        <span class="gl-text u-s-m-t-6">International Credit Cards must be eligible for use within the United States.</span>
                                                    </div>
                                                    <div class="u-s-m-b-15">

                                                        <!--====== Check Box ======-->
                                                        <div class="check-box">

                                                            <input type="checkbox" id="term-and-condition">
                                                            <div class="check-box__state check-box__state--primary">

                                                                <label class="check-box__label" for="term-and-condition">I consent to the</label></div>
                                                        </div>
                                                        <!--====== End - Check Box ======-->

                                                        <a class="gl-link">Terms of Service.</a>
                                                    </div>
                                                     <fieldset  :disabled="paymentprocessing">
                                                    <div>
                                                            
                                                        <button @click.prevent='PaymentOptions()' class="btn btn--e-brand-b-2" type="submit">PLACE ORDER</button></div>   
                                                     </fieldset>
                                                        
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!--====== End - Order Summary ======-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--====== End - Section Content ======-->
            </div>
         
            <!--====== End - Section 3 ======-->
        </div>
</template>
<script>
import { mapGetters } from 'vuex';
import Api from '../../../app/frontend/Api/Api';
export default {
    data(){
        return {
            paymentprocessing:false,
            Countries:[],
            AddressBook:[],
            coupon:'',
            loading:false,
            errors:[],
            activecoupon:false,
            Coupon:{
                discount:0,
            },
            form:{
                coupon:'',
                first_name:'',
                last_name:'',
                email:'',
                phone:'',
                street_address:'',
                country:'',
                state:'',
                city:'',
                zip_code:'',
                note:'',
            },
        }
    },methods:{
        ApplyCoupon(){
           Api.get('/Apply-Coupon/'+this.form.coupon).then(res => {
               this.activecoupon=true
               this.Coupon = res.data.data
               this.$toasted.show(res.data.msg)
           }).catch(err => {
               this.$toasted.show(err.response.data.msg,{
             type : 'warning',
            icon : 'exclamation-triangle-triangleash'
               })  
           })
        },DeleteCart(slug){
           Api.get('/remove-itemtocart/'+slug).then(res=>{
                 this.$store.commit('SET_CART',res.data.data)
             this.$toasted.show(res.data.msg,{
             type : 'success',
            icon : 'trash'
               }) 
           }).catch(err => {
            this.$toasted.show('Somthing Went Wrong Try Again Later',{
             type : 'error',
             icon : 'exclamation-triangle'
            }) 
        })
        },usedefaultAddress(event){
                if (event.target.checked) {
                    if (this.AddressBook == null) {
                                this.$toasted.show("you don't have default shipping and billing address from account",{
                        type : 'error',
                     icon : 'exclamation-triangle'
                        }) 
                        document.getElementById("checkboxdefault").checked = false;  
                    }else{
                          this.loading = true
                          this.errors = [];
                          document.getElementById("checkboxdefault").checked = true;
                    }
                }else{
                    this.loading = false
                    document.getElementById("checkboxdefault").checked = false;
                }   
                
        },changecountry(event){
           this.form.country = event.target.value;
           

        },CheckoutComponent(){
            Api.get('/CheckoutComponent').then(res => {
                this.Countries = res.data.data.countries
                this.AddressBook = res.data.data.addressbook
            })
        },PaymentOptions(){
            if (this.loading == true) {
            Api.post('/PlaceOrderWithDefaultAddress',this.form).then(res => {
                this.$toasted.show('we will redirect you to payment method after few seconds')
                this.paymentprocessing=true;
                this.$store.dispatch('SET_ORDER_COUNT','plus')
                 window.location.href = res.data.data

                
            }).catch(err => {
            if (err.response.data.errors) {
                this.errors = err.response.data.errors
            }else{
                this.errors = [];
            this.$toasted.show(err.response.data.msg,{
                     type : 'error',
                    icon : 'exclamation-triangle'
               }) 
            }
        })
            }else{
            Api.post('/PlaceOrder',this.form).then(res => {
                this.$toasted.show('we will redirect you to payment method after few seconds')
                this.paymentprocessing=true;
                this.$store.dispatch('SET_ORDER_COUNT','plus')
                window.location.href = res.data.data
            }).catch(err => {
            if (err.response.data.errors){
                this.errors = err.response.data.errors
            }else{ 
                this.errors = [];
            this.$toasted.show(err.response.data.msg,{
                     type : 'error',
                    icon : 'exclamation-triangle'
               }) 

            }
        })
            }

    }
    },computed: { 
            ...mapGetters({
        cart: 'cart',
    }),
    },created(){
        this.CheckoutComponent();
    }

}
</script>
<style scoped>
fieldset {
    border: none;

}
.text-danger{
    color: red;
    
}
 
</style>