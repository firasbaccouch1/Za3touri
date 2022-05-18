<template>
<div class="app-content">
            <!--====== Section 1 ======-->
            <div v-if="Product" class="u-s-p-y-60">
                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container">
                        <div class="breadcrumb">
                            <div class="breadcrumb__wrap">
                                <ul class="breadcrumb__list">
                                    <li class="has-separator">

                                        <router-link :to='{name:"Home"}'>Home</router-link></li>
                                    <li class="is-marked">

                                        <router-link :to='{name:"Wishlist"}'>Wishlist</router-link></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section 1 ======-->


            <!--====== Section 2 ======-->
            <div v-if="Product" class="u-s-p-b-60">

                <!--====== Section Intro ======-->
                <div class="section__intro u-s-m-b-60">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section__text-wrap">
                                    <h1 class="section__heading u-c-secondary">Wishlist</h1>
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
                            <div class="col-lg-12 col-md-12 col-sm-12">

                                <!--====== Wishlist Product ======-->
                                <div v-for="(product ,index) in Product" :key='product.index' class="w-r u-s-m-b-30">
                                    <div class="w-r__container">
                                        <div class="w-r__wrap-1">
                                            <div class="w-r__img-wrap">

                                                <img class="u-img-fluid" v-lazy="base_url+'/'+product.thumbnail" alt=""></div>
                                            <div class="w-r__info">

                                                <span class="w-r__name">

                                                    <router-link :to='{name:"Product",params:{slug:product.slug}}'>{{ product.name }}</router-link></span>

                                                <span class="w-r__category">

                                                    <router-link :to='{name:"Category",params:{slug:product.category.slug}}'><i :class='product.category.icon + " fa-lg"' style="padding:5px;"></i>{{ product.category.name }}</router-link></span>

                                                    <span v-if="product.discount" class="w-r__price">${{ parseFloat( (product.price - (product.discount.discount*product.price)/100)).toFixed(0)}}

                                                    <span class="w-r__discount">${{ product.price }}</span></span>
                                                    <span v-else class="w-r__price">${{ product.price }}

                                                    <span class="w-r__discount"></span></span>
                                                    </div>
                                        </div>
                                        <div class="w-r__wrap-2"> 

                                            <a class="w-r__link btn--e-brand-b-2" @click.prevent="addtocart(product.slug)">ADD TO CART</a>

                                            <router-link class="w-r__link btn--e-transparent-platinum-b-2" :to="{name:'Product',params:{slug:product.slug}}" >VIEW</router-link>

                                            <a @click.prevent="removeproduct(product.slug,index)" class="w-r__link btn--e-transparent-platinum-b-2" >REMOVE</a></div>
                                    </div>
                                </div>
                                <!--====== End - Wishlist Product ======-->
                            </div>
                            <div class="col-lg-12">
                                <div class="route-box">
                                    <div class="route-box__g">

                                        <router-link class="route-box__link" :to='{name:"Home"}'><i class="fas fa-long-arrow-alt-left"></i>

                                            <span>CONTINUE SHOPPING</span></router-link></div>
                                    <div class="route-box__g">

                                        <a @click.prevent='ClearWishlist()' class="route-box__link" ><i class="fas fa-trash"></i>

                                            <span>CLEAR WISHLIST</span></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--====== End - Section Content ======-->
            </div>
            <div v-else class="u-s-p-y-60">

                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 u-s-m-b-30">
                                <div class="empty">
                                    <div class="empty__wrap">

                                        <span class="empty__big-text">EMPTY</span>

                                        <span class="empty__text-1">No items found on your wishlist.</span>

                                        <router-link :to='{name:"Home"}' class="empty__redirect-link btn--e-brand" >CONTINUE SHOPPING</router-link></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--====== End - Section Content ======-->
            </div>
            <!--====== End - Section 2 ======-->
        </div>
</template>
<script>
import Api from '../../../app/frontend/Api/Api'
export default {
    data(){
        return {
            Product:'',
            base_url: window.location.origin 

        }
    },created(){
    Api.get('/WishListComponent').then(res => {
        if(res.data.data[0]){
    this.Product = res.data.data[0].product
        }
    
    })
    },methods:{
        addtocart(slug){
        if (this.$store.state.authenticated == true) {
          Api.post('/add-itemtocart/'+slug).then(res =>{
                this.$store.commit('SET_CART',res.data.data)
                this.$toasted.show(res.data.msg,{
                    type : 'success',
                    icon : 'cart-plus'
               }) 
             }).catch(err => {
                this.$toasted.show(err.response.data.msg,{
                    type : 'info',
                    icon : 'exclamation'
               }) 
             })
        }else{
            this.$toasted.show('You Need To Login First',{
                    type : 'warning',
                    icon : 'smile-beam'
               }) 
        }
        },removeproduct(slug,index){
            Api.get('/remove-itemtowishlist/'+slug).then(res => {
                 this.Product.splice(index, 1);
                this.$store.dispatch('SET_WISHLIST_COUNT','minus')
                this.$toasted.show(res.data.msg)
            }).catch(err => {
                this.$toasted.show(err.response.data.msg,{
                    type : 'warning',
                    icon : 'exclamation'
               }) 
            })

        },ClearWishlist(){
            Api.get('/clear-wishlist').then(res =>{
                 this.Product = null  
                 this.$store.dispatch('SET_WISHLIST_COUNT',null)
                  this.$toasted.show(res.data.msg)               
            }).catch(err => {
         this.$toasted.show(err.response.data.msg,{
                    type : 'warning',
                    icon : 'exclamation'
               })
            })
        }
    }
}
</script>