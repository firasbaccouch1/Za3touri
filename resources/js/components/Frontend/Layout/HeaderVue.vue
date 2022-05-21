<template>
<header class="header--style-1">

    <!--====== Nav 1 ======-->
    <nav class="primary-nav primary-nav-wrapper--border">
        <div class="container">

            <!--====== Primary Nav ======-->
            <div class="primary-nav">

                <!--====== Main Logo ======-->
                       
                <router-link class="main-logo" :to='{name:"Home"}'>

                    <img v-lazy="base_url +'/backend/img/settings/logo_site/logo_site.webp'" alt=""></router-link>
                <!--====== End - Main Logo ======-->
                    

                <!--====== Search Form ======-->
                <form class="main-form">

                    <label for="main-search"></label>

                    <input  v-model="search" class="input-text input-text--border-radius input-text--style-1" type="text" id="main-search" placeholder="Search">

                    <button @click.prevent='searchbtn()' class="btn btn--icon fas fa-search main-search-button" type="submit"></button></form>
                <!--====== End - Search Form ======-->


                <!--====== Dropdown Main plugin ======-->
                <div class="menu-init" id="navigation">

                    <button class="btn btn--icon toggle-button toggle-button--secondary fas fa-cogs" type="button"></button>

                    <!--====== Menu ======-->
                    <div class="ah-lg-mode">

                        <span class="ah-close">✕ Close</span>

                        <!--====== List ======-->
                        <ul class="ah-list ah-list--design1 ah-list--link-color-secondary">
                            <li class="has-dropdown" data-tooltip="tooltip" data-placement="left" title="Account">

                                <a><i class="far fa-user-circle"></i></a>

                                <!--====== Dropdown ======-->

                                <span class="js-menu-toggle"></span>
                                     
                                        <ul v-if="authenticated" style="width:200px">
                                            <li>
                                                <router-link :to='{name:"ManageMyAccount"}'><i class="fa-solid fa-id-card-clip u-s-m-r-6"></i>
                                                    <span>Manage My Account</span></router-link>
                                            </li>
                                            <li>
                                                <router-link :to='{name:"Profile"}'><i class="fas fa-user-circle u-s-m-r-6"></i>
                                                    <span>Profile</span></router-link>
                                            </li>
                                            <li>
                                                <router-link :to='{name:"AddressBook"}'><i class="fa-solid fa-map-location-dot u-s-m-r-6"></i>
                                                    <span>Address Book</span></router-link>
                                            </li>
                                            <li>
                                                <router-link :to='{name:"Orders"}'><i class="fa-solid fa-box-archive u-s-m-r-6"></i>
                                                    <span>Orders</span></router-link>
                                            </li>

                                            <li>
                                                <router-link :to='{name:"ReturnsCancellations"}'><i class="fa-solid fa-trash-can u-s-m-r-6"></i>
                                                    <span>Returns & Cancellations</span></router-link>
                                            </li>
                                            <li>
                                                <a @click.prevent='logout()'><i class="fas fa-lock-open u-s-m-r-6"></i>
                                                    <span>Signout</span></a>
                                            </li>
                                        </ul> 
                                       
                                    
                                    <ul  v-else style="width:170px">
                                        <li>
    
                                            <router-link :to="{name:'Register'}"><i class="fas fa-user-plus u-s-m-r-6"></i>
    
                                                <span>Signup</span></router-link></li>
                                        <li>
    
                                            <router-link :to="{name:'Login'}" ><i class="fas fa-lock u-s-m-r-6"></i>
    
                                                <span>Signin</span></router-link></li>
                                    </ul>
                                    
                                <!--====== End - Dropdown ======-->
                            </li>
                            <li class="has-dropdown" data-tooltip="tooltip" data-placement="left" title="Settings">

                                <a><i class="fas fa-user-cog"></i></a>

                                <!--====== Dropdown ======-->

                                <span class="js-menu-toggle"></span>
                                <ul style="width:120px">
                                    <li class="has-dropdown has-dropdown--ul-right-100">

                                        <a>Language<i class="fas fa-angle-down u-s-m-l-6"></i></a>

                                        <!--====== Dropdown ======-->

                                        <span class="js-menu-toggle"></span>
                                        <ul style="width:120px">
                                            <li>

                                                <a class="u-c-brand">ENGLISH</a></li>
                                            <li>

                                                <a @click.prevent='arablang()'>ARABIC</a></li>
                                            
                                        </ul>
                                        <!--====== End - Dropdown ======-->
                                    </li>
                                </ul>
                                <!--====== End - Dropdown ======-->
                            </li>
                            <li data-tooltip="tooltip" data-placement="left" title="Contact">

                                <a href="tel:+0900901904"><i class="fas fa-phone-volume"></i></a></li>
                            <li data-tooltip="tooltip"  data-placement="left" title="Mail">

                                <a><i class="far fa-envelope"></i></a></li>
                        </ul>
                        <!--====== End - List ======-->
                    </div>
                    <!--====== End - Menu ======-->
                </div>
                <!--====== End - Dropdown Main plugin ======-->
            </div>
            <!--====== End - Primary Nav ======-->
        </div>
    </nav>
    <!--====== End - Nav 1 ======-->


    <!--====== Nav 2 ======-->
    <nav class="secondary-nav-wrapper">
        <div class="container">

            <!--====== Secondary Nav ======-->
            <div class="secondary-nav">

                <!--====== Dropdown Main plugin ======-->
                <div class="menu-init" id="navigation1">
                    <!--====== Menu ======-->

                    <!--====== End - Menu ======-->
                </div>
                <!--====== End - Dropdown Main plugin ======-->


                <!--====== Dropdown Main plugin ======-->
                <div class="menu-init" id="navigation2">

                    <button class="btn btn--icon toggle-button toggle-button--secondary fas fa-cog" type="button"></button>

                    <!--====== Menu ======-->
                    <div class="ah-lg-mode">

                        <span class="ah-close">✕ Close</span>

                        <!--====== List ======-->
                        <ul class="ah-list ah-list--design2 ah-list--link-color-secondary">
                            <li>
                                <router-link :to='{name:"Home"}' >HOME</router-link></li>
                             <li>
                                <router-link :to='{name:"FilterProduct"}' >FILTER PRODUCTS</router-link></li>

                            <li class="has-dropdown">

                                <a>CATEGORIES<i class="fas fa-angle-down u-s-m-l-6"></i></a>

                                <!--====== Dropdown ======-->

                                <span class="js-menu-toggle"></span>
                                <ul style="width:200px">
                                    <li  v-for="category in Categoires" :key='category.index'>
                                        <router-link :to='{name:"Category",params:{slug:category.slug}}' ><i :class='category.icon + " fa-lg"'> </i> {{ category.name }}</router-link>
                                        
                                        </li>

                                </ul>
                                <!--====== End - Dropdown ======-->
                            </li>
                                                    <li class="has-dropdown">

                                <a>ABOUT US<i class="fas fa-angle-down u-s-m-l-6"></i></a>

                                <!--====== Dropdown ======-->

                                <span class="js-menu-toggle"></span>
                                <ul style="width:200px">
                                    <li > <router-link  :to="{name:'Contact'}">Contact</router-link> </li>
                                    <li > <router-link  :to="{name:'AboutUs'}">About us</router-link> </li>
                                    <li > <router-link  :to="{name:'Feedback'}">Feedback</router-link> </li>

                                    

                                </ul>
                                <!--====== End - Dropdown ======-->
                                                <!--====== End - Dropdown Main plugin -->
                            </li>
                            <!--====== this where if you want to add another link
                            <li>

                                <a href="shop-side-version-2.html">GIFT CARDS</a></li>
                        -->
                        </ul>
                        <!--====== End - List ======-->
                    </div>
                    <!--====== End - Menu ======-->
                </div>
                <!--====== End - Dropdown Main plugin ======-->


                <!--====== Dropdown Main plugin ======-->
                <div class="menu-init" id="navigation3">

                    <button class="btn btn--icon toggle-button toggle-button--secondary fas fa-shopping-bag toggle-button-shop" type="button"></button>

                    <span v-if="cart.count  <= 0" class="total-item-round">0</span>
                    <span v-else class="total-item-round"> {{ cart.count    }} </span>

                    <!--====== Menu ======-->
                    <div class="ah-lg-mode">

                        <span class="ah-close">✕ Close</span>

                        <!--====== List ======-->
                        <ul class="ah-list ah-list--design1 ah-list--link-color-secondary">
                            <li>

                                <router-link :to='{name:"Home"}'><i class="fas fa-home u-c-brand"></i></router-link></li>
                            <li>

                                <router-link :to='{name:"Wishlist"}'><i class="far fa-heart"></i></router-link></li>
                            <li class="has-dropdown">

                                <router-link :to='{name:"Cart"}'  class="mini-cart-shop-link"><i class="fas fa-shopping-bag"></i>
                                    <span v-if="cart.count  <= 0" class="total-item-round">0</span>
                                    <span v-else class="total-item-round"> {{ cart.count    }} </span>
                                </router-link >
                                <!--====== Dropdown ======-->

                                <span class="js-menu-toggle"></span>
                                <div v-if="cart.count  > 0" class="mini-cart">

                                    <!--====== Mini Product Container ======-->
                                    <div class="mini-product-container gl-scroll u-s-m-b-15">

                                        <!--====== Card for mini cart ======-->
                                        <div v-for="Cart  in cart.Cart_Data" :key='Cart.index' class="card-mini-product">
                                            <div class="mini-product">
                                                <div class="mini-product__image-wrapper">

                                                    <router-link class="mini-product__link" :to='{name:"Product",params:{slug:Cart.product.slug}}'>

                                                        <img class="u-img-fluid" v-lazy="base_url+'/'+Cart.product.thumbnail" ></router-link> </div>
                                                <div class="mini-product__info-wrapper">

                                                    <span class="mini-product__category">
                                                    <router-link :to='{name:"Category",params:{slug:Cart.product.category.slug}}'><i :class='Cart.product.category.icon + " fa-lg"'> </i> {{Cart.product.category.name }}</router-link>
                                                </span>

                                                    <span class="mini-product__name">
                                                    <router-link class="mini-product__name" :to='{name:"Product",params:{slug:Cart.product.slug}}'>{{ Cart.product.name }}</router-link></span>

                                                    <span class="mini-product__quantity">{{ Cart.quantity }} * </span>
                                                        
                                                     <span v-if="Cart.product.discount != null" class="mini-product__price">${{ parseFloat(Cart.product.price - ((Cart.product.discount.discount*Cart.product.price)/100)).toFixed(0) }}
                                                    <span class="product-o__discount">${{ Cart.product.price }}</span></span>
                                                    <span v-else class="mini-product__price">${{ parseFloat(Cart.product.price * Cart.quantity).toFixed(0)}}</span>
                                                    </div>
                                            </div>

                                            <a @click="DeleteCart(Cart.product.slug)" class="mini-product__delete-link far fa-trash-alt"></a>
                                        </div>
                                        <!--====== End - Card for mini cart ======-->
                                    </div>
                                    <!--====== End - Mini Product Container ======-->


                                    <!--====== Mini Product Statistics ======-->
                                    <div class="mini-product-stat">
                                        <div class="mini-total">

                                            <span class="subtotal-text">SUBTOTAL</span>

                                            <span class="subtotal-value">${{ parseFloat(cart.Sub_Total).toFixed(0) }}</span></div>
                                        <div class="mini-action">

                                            <router-link class="mini-link btn--e-brand-b-2" :to='{name:"Checkout"}' >PROCEED TO CHECKOUT</router-link>

                                            <router-link class="mini-link btn--e-transparent-secondary-b-2" :to='{name:"Cart"}'>VIEW CART</router-link></div>
                                    </div>
                                    <!--====== End - Mini Product Statistics ======-->
                                </div>
                                <div v-else>

                                        </div>
                                <!--====== End - Dropdown ======-->
                            </li>
                        </ul>
                        <!--====== End - List ======-->
                    </div>
                    <!--====== End - Menu ======-->
                </div>
                <!--====== End - Dropdown Main plugin ======-->
            </div>
            <!--====== End - Secondary Nav ======-->
        </div>
    </nav>
    <!--====== End - Nav 2 ======-->

</header>

</template>
<script >

import Api from '../../../app/frontend/Api/Api'
import Auth from '../../../app/frontend/Store/Auth'
import { mapGetters } from 'vuex';
export default {
    data(){
        return{
            Categoires:[],
            search:null,
            base_url: window.location.origin 
        }
    },methods:{
        logout(){
            Auth.logout().then(res => {
                this.$store.commit('SET_AUTHENTICATED',false)
                this.$store.commit('SET_USER','')
                this.$router.push({ name: "Login"})
                this.$toasted.show(res.data.msg)
            }).catch(err => {
                  this.$toasted.show('somthing went wrong try again later',{
             type : 'warning',
            icon : 'exclamation'
           })
            })
        },HeaderComponent(){
                    Api.get('/HeaderComponent').then(res => {
                    this.Categoires = res.data.data.Category
            }).catch(err => {

            }) 
        },DeleteCart(slug){
           Api.get('/remove-itemtocart/'+slug).then(res=>{
                 this.$store.commit('SET_CART',res.data.data)
             this.$toasted.show(res.data.msg,{
             type : 'success',
            icon : 'trash'
               }) 
           }).catch(err => {
               this.$toasted.show(err.response.data.msg,{
             type : 'warning',
            icon : 'exclamation'
           })
           })
        },CartComponent(){
         Api.get('/CartComponent').then(res => {
         this.$store.commit('SET_CART',res.data.data.Cart)
            })
        },arablang(){
                this.$toasted.show('This language is not available yet',{
                type : 'info',
                icon : 'smile-beam'
               })  
        },searchbtn(){
            if (this.search != null && this.search != '') {
              this.$router.push({name: "Search",params:{ name:this.search}})
            }
        } 
    },
    created(){
     if (this.$cookies.get('checkauth') == 'true') {
        Auth.userwithCart().then(res=> {
        this.$store.commit('SET_AUTHENTICATED',true)
        this.$store.commit('SET_USER',res.data.data.user)
        this.$store.commit('SET_CART',res.data.data.Cart)     
        })
     }
    
    },
    computed: { 
            ...mapGetters({
        authenticated: 'authenticated',
        cart: 'cart',
    }),
      checkstate(){
    return this.$store.state.authenticated
        }
      
    },mounted(){
      this.HeaderComponent();
    },watch:{
        checkstate(value){
            if (value == 'true') {
                this.CartComponent();
            }else{
            this.cart.Cart_data = []
            this.cart.Sub_Total = 0
             this.cart.Total = 0
            this.cart.count = 0
            }
        }

    }


}
</script>

<style>
.NewProduct{
    color: rgba(255, 0, 0, 0.836) !important;
}


</style>