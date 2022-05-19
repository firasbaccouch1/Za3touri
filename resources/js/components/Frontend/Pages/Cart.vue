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

                                        <router-link :to='{name:"Home"}'>Home</router-link></li>
                                    <li class="is-marked">

                                        <router-link :to='{name:"Cart"}'>Cart</router-link></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section 1 ======-->


            <!--====== Section 2 ======-->
            <div v-if="cart.count > 0" class="u-s-p-b-60">

                <!--====== Section Intro ======-->
                <div class="section__intro u-s-m-b-60">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section__text-wrap">
                                    <h1 class="section__heading u-c-secondary">SHOPPING CART</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--====== End - Section Intro ======-->


                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container">
                        <div class="row">
                            <div  class="col-lg-12 col-md-12 col-sm-12 u-s-m-b-30">
                                <div class="table-responsive">
                                    <table class="table-p">
                                        <tbody>

                                            <!--====== Row ======-->
                                            <tr v-for="(Cart,index) in cart.Cart_Data" :key="Cart.index">
                                                <td>
                                                    <div class="table-p__box">
                                                        <div class="table-p__img-wrap">

                                                            <img class="u-img-fluid" v-lazy="Cart.product.thumbnail" alt=""></div>
                                                        <div class="table-p__info">

                                                            <span class="table-p__name">

                                                                <router-link :to='{name:"Product",params:{slug:Cart.product.slug}}'>{{ Cart.product.name }}</router-link></span>

                                                            <span class="table-p__category">

                                                                <router-link :to='{name:"Category",params:{slug:Cart.product.category.slug}}'><i :class="Cart.product.category.icon +' fa-lg icon'"></i>{{ Cart.product.category.name }}</router-link></span>

                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span v-if="Cart.product.discount != null" class="table-p__price">${{ parseFloat( (Cart.product.price - ((Cart.product.discount.discount*Cart.product.price)/100))* Cart.quantity ).toFixed(0)}}
                                                    <span class="product-o__discount">${{ Cart.product.price }}</span></span>
                                                    <span v-else class="table-p__price">${{parseFloat( Cart.product.price * Cart.quantity).toFixed(0)}}</span>
                                                </td>
                                                <td>
                                                    <div class="table-p__input-counter-wrap">

                                                        <!--====== Input Counter ======-->
                                                        <div class="input-counter">

                                                            <span @click='Quantityminus(Cart.quantity,index)' class="input-counter__minus fas fa-minus"></span>

                                                            <input class="input-counter__text input-counter--text-primary-style" type="text" :value="Cart.quantity" data-min="1" data-max="1000">

                                                            <span @click='Quantityplus(Cart.quantity,index)' class="input-counter__plus fas fa-plus"></span></div>
                                                        <!--====== End - Input Counter ======-->
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="table-p__del-wrap">

                                                        <a @click.prevent='deleteCart(Cart.product.slug)' class="far fa-trash-alt table-p__delete-link" ></a></div>
                                                        
                                                </td>
                                            </tr>
                                            <!--====== End - Row ======-->

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="route-box">
                                    <div class="route-box__g1">

                                        <router-link class="route-box__link" :to='{name:"Home"}'><i class="fas fa-long-arrow-alt-left"></i>

                                            <span>CONTINUE SHOPPING</span></router-link></div>
                                    <div class="route-box__g2">

                                        <a @click.prevent="ClearCart()" class="route-box__link" ><i class="fas fa-trash"></i>

                                            <span>CLEAR CART</span></a>

                                        <a @click.prevent="UpdateCart()" class="route-box__link" ><i class="fas fa-sync"></i>

                                            <span>UPDATE CART</span></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--====== End - Section Content ======-->
            </div>
            <!--====== End - Section 2 ======-->


            <!--====== Section 3 ======-->
            <div  v-if="cart.count > 0" class="u-s-p-b-60">

                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 u-s-m-b-30">
                                <form class="f-cart">
                                    <div class="row">
                                        <div v-if="cart.Sub_Total > 0" class="col-lg-12 col-md-12 u-s-m-b-30">
                                            <div class="f-cart__pad-box">
                                                <div class="u-s-m-b-30">
                                                    <table class="f-cart__table">
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
                                                            <tr>
                                                                <td>GRAND TOTAL</td>
                                                            <td >${{ parseFloat(cart.Total).toFixed(0)}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div >

                                                    <router-link  class="btn btn--e-brand-b-2 checkout-btn" :to='{name:"Checkout"}'> PROCEED TO CHECKOUT</router-link ></div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--====== End - Section Content ======-->
            </div>
            <div  v-else class="u-s-p-y-60">

                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 u-s-m-b-30">
                                <div class="empty">
                                    <div class="empty__wrap">

                                        <span class="empty__big-text">EMPTY</span>

                                        <span class="empty__text-1">No items found on your cart.</span>

                                        <router-link class="empty__redirect-link btn--e-brand" :to='{name:"Home"}'>CONTINUE SHOPPING</router-link></div>
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
import Api from '../../../app/frontend/Api/Api'
import { mapGetters } from 'vuex';
export default {
    data(){ 
        return {
        
        }
    },computed: { 
            ...mapGetters({
        cart: 'cart',
    }),
    },methods:{
        UpdateCart(){
            let arr = {
                data:[],
            }
                $.each(this.cart.Cart_Data, function(key, value) {
                    arr.data.push({'product': value.product_id,'quantity':value.quantity});
             });
        Api.post('/update-cart',arr).then(res => {
            this.$store.commit('SET_CART',res.data.data)
            this.$toasted.show(res.data.msg,{
                
                     type : 'success',
                    icon : 'cart-arrow-down'
               }) 
        })

        },
        ClearCart(){
        Api.get('/clear-cart').then(res => {
            this.$toasted.show(res.data.msg)
    this.$store.commit('SET_CART',res.data.data.Cart)
        })
        },Quantityminus(quantity,index){
            if (quantity <= 1) {
            this.$toasted.show('Min Quantity You Can Buy Is 1',{
                     type : 'info',
                    icon : 'exclamation-triangle'
               }) 
            }else{
                  this.cart.Cart_Data[index].quantity = quantity - 1
            }

        },Quantityplus(quantity,index){
            if (quantity >= 10) {
               this.$toasted.show('Max Quantity You Can Buy Is 10',{
                     type : 'info',
                    icon : 'exclamation-triangle'
               }) 
            }else{
                this.cart.Cart_Data[index].quantity = quantity + 1
            }
        },deleteCart(slug){
        Api.get('remove-itemtocart/'+slug).then(res => {
                    this.$store.commit('SET_CART',res.data.data)
             this.$toasted.show(res.data.msg,{
                     type : 'success',
                    icon : 'trash'
               }) 
        });
    }
    }
}
</script>
<style scoped>
.checkout-btn{
    width: 100%;
    display: inline-block;
    text-align: center;
    
}
.icon{
    padding: 5px;
}
.img-cart{
    width: 100%;
    
}
</style>