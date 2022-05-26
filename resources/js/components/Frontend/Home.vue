<template>
   <div class="app-content">

            <!--====== Primary Slider ======-->
                   
                    <carousel v-if="Sliders.length >0"  :items="1" :autoplay="true" :nav="false" :dots="false" >
                        <div  v-for="Slider in Sliders"  :key='Slider.index' v-bind:style="{ 'background-image': 'url(' + Slider.photo + ')' }" class="img_slider" >
                            <div class="container slider">
                            <div class="row">
                                <div class="col-12">
                                    <div class="slider-content slider-content--animation ">


                                        <span class="content-span-2 colorslider maxwith">{{ Slider.title }}</span>
                                        <br>
                                        <span class="content-span-3 colorslider slidermaxwith">{{ Slider.short_description }}</span>
                                        <br><br>
                                        <router-link class="shop-now-link btn--e-brand maxwithbutton" :to='{name:"Category",params:{slug:Slider.category.slug}}'>SHOP NOW</router-link>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </carousel>
                  
            <!--====== End - Primary Slider ======-->


            <!--====== Section 3 ======-->
            <div v-if="ProductHasDiscount.length >0" class="u-s-p-b-60">

                <!--====== Section Intro ======-->
                <div  class="section__intro u-s-m-b-46">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section__text-wrap">
                                    <h1 class="section__heading u-c-secondary u-s-m-b-12">DEAL OF THE DAY</h1>

                                    <span class="section__span u-c-silver">BUY DEAL OF THE DAY, HURRY UP! THESE NEW PRODUCTS WILL EXPIRE SOON.</span>

                                    <span class="section__span u-c-silver">ADD THESE ON YOUR CART.</span>
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
                            <div v-if="ProductHasDiscount.length <= 1 " class="col-lg-2 col-md-2 u-s-m-b-30" >

                            </div>
                            <div  v-for="Product in ProductHasDiscount" :key="Product.index" :class="ProductHasDiscount.length <= 1 ? 'col-lg-8 col-md-8 u-s-m-b-30':'col-lg-6 col-md-6 u-s-m-b-30'">
                                <div class="product-o product-o--radius product-o--hover-off u-h-100">
                                    <div class="product-o__wrap">
                                        <a class="aspect aspect--bg-grey aspect--square u-d-block" href="product-detail.html">
                                            <img class="aspect__img" v-lazy="Product.thumbnail" alt=""></a>
                                        <flip-countdown v-if='Product.discount.expired_at != null'  :deadline="Product.discount.expired_at" class="product-o__special-count-wrap">
                                        </flip-countdown >
                                        <div class="product-o__action-wrap">
                                            <ul class="product-o__action-list">
                                                <li>

                                                    <router-link :to='{name:"Product",params:{slug:Product.slug}}' data-modal="modal" data-modal-id="#quick-look" data-tooltip="tooltip" data-placement="top" title="Quick View"><i class="fas fa-search-plus"></i></router-link></li>
                                                <li>

                                                    <a data-modal="modal" @click.prevent="addtocart(Product.slug)" data-modal-id="#add-to-cart" data-tooltip="tooltip" data-placement="top" title="Add to Cart"><i class="fas fa-shopping-bag"></i></a></li>
                                                <li>

                                                    <a @click.prevent="addtowishlist(Product.slug)" data-tooltip="tooltip" data-placement="top" title="Add to Wishlist"><i class="fas fa-heart"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <span class="product-o__category">

                                        <router-link :to='{name:"Category",params:{slug:Product.category.slug}}'><i :class='Product.category.icon + " fa-lg"'> </i> {{ Product.category.name }}</router-link></span>

                                    <span class="product-o__name">

                                       <router-link :to='{name:"Product",params:{slug:Product.slug}}'>{{ Product.name }}</router-link></span>
                                    <div class="product-o__rating gl-rating-style">
                                        <i v-if="Product.reviewStar >=1" class="fas fa-star"></i>
                                        <i v-if="Product.reviewStar >1 && Product.reviewStar<2" class="fas fa-star-half-alt"></i>
                                        <i v-if="Product.reviewStar >=2" class="fas fa-star"></i>
                                        <i v-if="Product.reviewStar >2 && Product.reviewStar<3" class="fas fa-star-half-alt"></i>
                                        <i v-if="Product.reviewStar >=3" class="fas fa-star"></i>
                                        <i v-if="Product.reviewStar >3 && Product.reviewStar<4" class="fas fa-star-half-alt"></i>
                                        <i v-if="Product.reviewStar >=4" class="fas fa-star"></i>
                                        <i v-if="Product.reviewStar >4 && Product.reviewStar<5" class="fas fa-star-half-alt"></i>
                                        <i v-if="Product.reviewStar >=5" class="fas fa-star"></i>
                                        <i v-if="Product.reviewStar == 0">
                                                <i class="fas fa-star colorstar"></i>
                                                <i class="fas fa-star colorstar"></i>
                                                <i class="fas fa-star colorstar"></i>
                                                <i class="fas fa-star colorstar"></i>
                                                <i class="fas fa-star colorstar"></i>
                                        </i>
                                        <span class="product-o__review">({{ Product.reviewcount }})</span></div>

                                    <span class="product-o__price">${{ parseFloat(Product.price - ((Product.discount.discount*Product.price)/100)).toFixed(0) }}

                                        <span class="product-o__discount">${{ Product.price }}</span></span>
                                </div>
                            </div>
                            <div v-if="ProductHasDiscount.length <= 1" class="col-lg-2 col-md-2 u-s-m-b-30">

                            </div>
                        </div>
                    </div>
                </div>
                <!--====== End - Section Content ======-->
            </div>
                   <div class="u-s-p-b-60">

                <!--====== Section Intro ======-->
                <div class="section__intro u-s-m-b-16">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section__text-wrap">
                                    <h1 class="section__heading u-c-secondary u-s-m-b-12">TOP PRODUCT</h1>

                                    <span class="section__span u-c-silver">CHOOSE PRODUCT FROM TOP TRENDING PRODUCT</span>
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
                            <div class="col-lg-12">
                                <div class=" u-s-m-t-30">
                                    <div class="row">
                                            <div v-for="Product in TopProduct" :key='Product.index' class="col-xl-4 col-lg-4 col-md-4 col-sm-6 u-s-m-b-30 filter__item">
                                            <div class="product-o product-o--hover-on product-o--radius">
                                                <div class="product-o__wrap">

                                                    <a class="aspect aspect--bg-grey aspect--square u-d-block" href="product-detail.html">

                                                        <img class="aspect__img" v-lazy="Product.thumbnail" alt=""></a>
                                                    <div class="product-o__action-wrap">
                                                        <ul class="product-o__action-list">
                                                            <li>

                                                            <router-link :to='{name:"Product",params:{slug:Product.slug}}'  data-modal="modal" data-modal-id="#quick-look" data-tooltip="tooltip" data-placement="top" title="Quick View"><i class="fas fa-search-plus"></i></router-link></li>
                                                            <li>

                                                                <a data-modal="modal" @click.prevent="addtocart(Product.slug)" data-modal-id="#add-to-cart" data-tooltip="tooltip" data-placement="top" title="Add to Cart"><i class="fas fa-shopping-bag"></i></a></li>
                                                            <li>

                                                                <a  @click.prevent="addtowishlist(Product.slug)" data-tooltip="tooltip" data-placement="top" title="Add to Wishlist"><i class="fas fa-heart"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                
                                    <span class="product-o__category">

                                        <router-link :to='{name:"Category",params:{slug:Product.category.slug}}'><i :class='Product.category.icon + " fa-lg"'> </i> {{ Product.category.name }}</router-link></span>

                                    <span class="product-o__name">

                                       <router-link :to='{name:"Product",params:{slug:Product.slug}}'>{{ Product.name }}</router-link></span>
                                    <div class="product-o__rating gl-rating-style">
                                         <i v-if="Product.reviewStar >=1" class="fas fa-star"></i>
                                        <i v-if="Product.reviewStar >1 && Product.reviewStar<2" class="fas fa-star-half-alt"></i>
                                        <i v-if="Product.reviewStar >=2" class="fas fa-star"></i>
                                        <i v-if="Product.reviewStar >2 && Product.reviewStar<3" class="fas fa-star-half-alt"></i>
                                        <i v-if="Product.reviewStar >=3" class="fas fa-star"></i>
                                        <i v-if="Product.reviewStar >3 && Product.reviewStar<4" class="fas fa-star-half-alt"></i>
                                        <i v-if="Product.reviewStar >=4" class="fas fa-star"></i>
                                        <i v-if="Product.reviewStar >4 && Product.reviewStar<5" class="fas fa-star-half-alt"></i>
                                        <i v-if="Product.reviewStar >=5" class="fas fa-star"></i>
                                        <i v-if="Product.reviewStar == 0">
                                                <i class="fas fa-star colorstar"></i>
                                                <i class="fas fa-star colorstar"></i>
                                                <i class="fas fa-star colorstar"></i>
                                                <i class="fas fa-star colorstar"></i>
                                                <i class="fas fa-star colorstar"></i>
                                        </i>
                                        <span class="product-o__review">({{ Product.reviewcount }})</span></div>

                                        <span v-if="Product.discount == null" class="product-o__price">$ {{ Product.price }}
                                        <span class="product-o__discount"></span></span>
                                        <span v-else class="product-o__price">${{ parseFloat(Product.price - ((Product.discount.discount*Product.price)/100)).toFixed(0)}}
                                        <span class="product-o__discount">${{ Product.price  }}</span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="load-more">

                                    <button v-if="LoadMorelink != null" @click.prevent='LoadMore()'  class="btn btn--e-brand" type="button">Load More</button>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--====== End - Section Content ======-->
            </div>
            <!--====== End - Section 3 ======-->

                 <div class="u-s-p-b-60">

                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 u-s-m-b-30">
                                <div class="service u-h-100">
                                    <div class="service__icon"><i class="fas fa-truck"></i></div>
                                    <div class="service__info-wrap">

                                        <span class="service__info-text-1">Free Shipping</span>

                                        <span class="service__info-text-2">Free shipping on all US order or order above $200</span></div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 u-s-m-b-30">
                                <div class="service u-h-100">
                                    <div class="service__icon"><i class="fas fa-redo"></i></div>
                                    <div class="service__info-wrap">

                                        <span class="service__info-text-1">Shop with Confidence</span>

                                        <span class="service__info-text-2">Our Protection covers your purchase from click to delivery</span></div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 u-s-m-b-30">
                                <div class="service u-h-100">
                                    <div class="service__icon"><i class="fas fa-headphones-alt"></i></div>
                                    <div class="service__info-wrap">

                                        <span class="service__info-text-1">24/7 Help Center</span>

                                        <span class="service__info-text-2">Round-the-clock assistance for a smooth shopping experience</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--====== End - Section Content ======-->
            </div>  
              <div v-if="Feedback.length >0" class="u-s-p-b-90 u-s-m-b-30">

                <!--====== Section Intro ======-->
                <div class="section__intro u-s-m-b-46">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section__text-wrap">
                                    <h1 class="section__heading u-c-secondary u-s-m-b-12">CLIENTS FEEDBACK</h1>

                                    <span class="section__span u-c-silver">WHAT OUR CLIENTS SAY</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--====== End - Section Intro ======-->


                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container">
                         <carousel v-if="Feedback.length >0"  :items="1" :autoplay="true" :nav="false" :dots="false" >
                         <div  v-for="feedback in Feedback">
                             <img class="photowith" :src="feedback.photo" alt="">
                             <br>
                             <h2 class="text-center">{{feedback.name}}</h2>
                             <br>
                             <h4 class="text-center">{{feedback.message}}</h4>
                         </div>
                    </carousel>
                        
                 </div>
                  </div>
                        
                        <!--====== End - Testimonial Slider ======-->

                <!--====== End - Section Content ======-->
            </div>
                                

            <!--====== Section 2 ======-->
       
            <!--====== End - Section 2 ======-->

            <!--====== Section 9 ======-->
           


  

        </div>
</template>

<script>
import Api from '../../app/frontend/Api/Api';
import FlipCountdown from 'vue2-flip-countdown'
import carousel from 'vue-owl-carousel'
    export default { 
components: { FlipCountdown, carousel },
      data(){
            return {
                baseUrl:window.location.origin,
                Sliders:[],
                ProductHasDiscount:[],
                Category:[],
                TopProduct:[],
                LoadMorelink:'',
                Feedback:[],
                

            }
        },methods:{
            HomeData(){
            Api.get('/HomeComponent').then(res => {
                this.ProductHasDiscount = res.data.data.DisconutProducts
                this.Sliders = res.data.data.Sliders
                this.Category = res.data.data.Category
                this.TopProduct = res.data.data.allProduct.data;
                this.LoadMorelink = res.data.data.allProduct.links.next
                this.Feedback = res.data.data.feedback
            }).catch(err => {
                console.log('problem sliders')
            })
            },
            LoadMore(){
                Api.get(this.LoadMorelink).then(res => {
                 res.data.data.allProduct.data.map(Element => {
                    this.TopProduct.push(Element);
                 }) 
                 this.LoadMorelink = res.data.data.allProduct.links.next
                }) 
                

            },addtocart(slug){
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
        },addtowishlist(slug){
                if (this.$store.state.authenticated == true) {
         Api.get('/add-itemtowishlist/'+slug).then(res => {
             this.$toasted.show(res.data.msg)
             this.$store.dispatch('SET_WISHLIST_COUNT','plus')
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
            }

        }, 
          created(){
            this.HomeData();
        }
            
        
                    
    }
</script>
<style>
.colorslider{
color: #c6fff2;
}
.slider{
    position: relative;
    top: 15%;
}
@media screen and (max-width: 1170px) {
.img_slider{
    width:100%;
    height: 500px;
    background-position: center top;
    background-size: 100% 100%;

}
}
@media screen and (min-width: 1170px) {
.img_slider{
    width:100%;
    height: 650px;
    background-position: center top;
    background-size: 100% 100%;

}

}
@media screen and (max-width: 700px) {
.img_slider{
    width:100%;
    height: 400px;
    background-position: center top;
    background-size: 100% 100%;

}
.colorslider{
    font-size: 13px;

}
.maxwithbutton{
padding: 10px 15px 10px 15px;

}
.maxwith{
    font-size: 24px;
}

}
@media screen and (max-width: 400px) {
.slidermaxwith{
    word-wrap: break-word;
max-width: 400px !important;

}

}

.colorstar{
    color: #cfcfcfd5;
}.photowith{
     display: block;
  margin-left: auto;
  margin-right: auto;
  border-radius: 50%!important;
  height: 25%!important;
  width: 20%!important;
}.text-center{
     text-align: center;
 
}



</style>