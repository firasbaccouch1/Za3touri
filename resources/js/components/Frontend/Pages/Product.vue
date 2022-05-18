<template>
<div  class="app-content">
            <!--====== Section 1 ======-->
            <div>
            <div  class="u-s-p-t-90">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">

                            <!--====== Product Breadcrumb ======-->
                            <div class="pd-breadcrumb u-s-m-b-30">
                                <ul class="pd-breadcrumb__list">
                                    <li class="has-separator">

                                        <router-link :to='{name:"Home"}'>Home</router-link></li>
                                    <li class="has-separator">

                                        <router-link v-if="Product.category.slug" :to='{name:"Category",params:{slug:Product.category.slug}}' >{{ Product.category.name }}</router-link></li>
                                </ul>
                            </div>
                            <!--====== End - Product Breadcrumb ======-->


                            <!--====== Product Detail Zoom ======-->
                            <div class="pd u-s-m-b-30">
                                <div class="pd-wrap">
                                    <div  id="pd-o-initiate" class="slick-initialized slick-slider">
                                        <div class="slick-list draggable"><div class="slick-track" style="opacity: 1; width: 2225px;">
                                            <div class="pd-o-img-wrap slick-slide slick-current slick-active" style="width: 445px; position: relative; left: 0px; top: 0px; z-index: 999; opacity: 1;" >

                                            <img class="u-img-fluid" :src="this.image"  alt=""></div></div></div>
                                        
                                        
                                        
                                        
                                    </div>
                                </div>
                                <div v-if="Product.multi_img != null" class="u-s-m-t-15">
                                    <div>
                                        <div id="pd-o-thumbnail" class="slick-initialized slick-slider">
                                            <div class="slick-list draggable"><div class="slick-track" style="opacity: 1; width: 560px; transform: translate3d(0px, 0px, 0px);">
                                                <div @click='changeimg(Product.thumbnail)' :class="base_url+'/'+Product.thumbnail ==  image?'slick-slide slick-current slick-active ':'slick-slide'"   style="width: 112px;">
                                                    <img class="u-img-fluid" :src="base_url+'/'+this.Product.thumbnail" alt="">
                                                </div>
                                                <div @click='changeimg(img.images)' v-for="img in Product.multi_img" :key='img.index'  :class="base_url+'/'+img.images ==  image?'slick-slide slick-current slick-active':' slick-slide '"  style="width: 112px;">
                                                    <img class="u-img-fluid" :src="base_url+'/'+img.images" alt="">
                                                </div>
                                             </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--====== End - Product Detail Zoom ======-->
                        </div>
                        <div class="col-lg-7">

                            <!--====== Product Right Side Details ======-->
                            <div class="pd-detail">
                                <div>

                                    <span class="pd-detail__name">{{ Product.name }}</span></div>
                                <div>
                                    <div v-if="Product.discount == null && Product.category.discount == null" class="pd-detail__inline">

                                        <span class="pd-detail__price">${{ Product.price }}</span>
                                    </div>
                                    <div v-else class="pd-detail__inline">

                                        <span v-if="Product.discount != null" class="pd-detail__price">${{ parseFloat( (Product.price - ((Product.discount.discount*Product.price)/100))).toFixed(0)}}</span>
                                         <span v-if="Product.category.discount != null" class="pd-detail__price">${{ parseFloat( (Product.price - ((Product.category.discount.discount*Product.price)/100))).toFixed(0)}}</span>

                                        <span v-if="Product.discount != null" class="pd-detail__discount">({{ Product.discount.discount }}% OFF)</span><del v-if="Product.discount != null" class="pd-detail__del">${{ Product.price }}</del>
                                        <span v-if="Product.category.discount != null" class="pd-detail__discount">({{ Product.category.discount.discount }}% OFF)</span><del v-if="Product.category.discount != null" class="pd-detail__del">${{ Product.price }}</del>
                                    </div>
                                </div>
                                <div class="u-s-m-b-15">
                                    <div class="pd-detail__rating gl-rating-style">
                                        <i v-if="reviewStar >=1" class="fas fa-star"></i>
                                        <i v-if="reviewStar >1 && reviewStar<2" class="fas fa-star-half-alt"></i>
                                        <i v-if="reviewStar >=2" class="fas fa-star"></i>
                                        <i v-if="reviewStar >2 && reviewStar<3" class="fas fa-star-half-alt"></i>
                                        <i v-if="reviewStar >=3" class="fas fa-star"></i>
                                        <i v-if="reviewStar >3 && reviewStar<4" class="fas fa-star-half-alt"></i>
                                        <i v-if="reviewStar >=4" class="fas fa-star"></i>
                                        <i v-if="reviewStar >4 && reviewStar<5" class="fas fa-star-half-alt"></i>
                                        <i v-if="reviewStar >=5" class="fas fa-star"></i>
                                        <i v-if="reviewStar == 0">
                                                <i class="fas fa-star colorstar"></i>
                                                <i class="fas fa-star colorstar"></i>
                                                <i class="fas fa-star colorstar"></i>
                                                <i class="fas fa-star colorstar"></i>
                                                <i class="fas fa-star colorstar"></i>
                                        </i>
                                        <span class="pd-detail__review u-s-m-l-4">

                                            <a data-click-scroll="#view-review">{{ review_count }} Reviews</a></span></div>
                                </div>
                                <div class="u-s-m-b-15">
                                    <div class="pd-detail__inline">

                                        <span v-if="Product.qantite > 20" class="pd-detail__stock">{{ Product.qantite }} in stock</span>

                                        <span v-else class="pd-detail__left">Only {{ Product.qantite }} left</span>
                                        </div>
                                </div>
                                <div class="u-s-m-b-15">

                                    <span class="pd-detail__preview-desc">{{ Product.discription }}</span></div>
                                <div class="u-s-m-b-15">
                                    <div class="pd-detail__inline">

                                        <span class="pd-detail__click-wrap"><i class="far fa-heart u-s-m-r-6"></i>

                                            <a @click.prevent='addtowishlist(Product.slug)'>Add to Wishlist</a>

                                            <span class="pd-detail__click-count">({{ wishlist }})</span></span></div>
                                </div>
                                <div class="u-s-m-b-15">
                                    <div class="pd-detail__inline">

                                        <span class="pd-detail__click-wrap"><i class="far fa-envelope u-s-m-r-6"></i>

                                            <a @click='EmailMeWhenPriceDrope(Product.slug)'>Email me When the price drops</a>

                                            <span class="pd-detail__click-count">({{ Email_me }})</span></span></div>
                                </div>
                                <div class="u-s-m-b-15">
                                    <div class="pd-detail__form">
                                        <div class="pd-detail-inline-2">
                                            <div class="u-s-m-b-15">

                                                <!--====== Input Counter ======-->
                                                <div class="input-counter">

                                                    <span @click="minusquantity()" class="input-counter__minus fas fa-minus"></span>

                                                    <input class="input-counter__text input-counter--text-primary-style" type="text" :value="this.quantity">

                                                    <span @click='plusquantity()' class="input-counter__plus fas fa-plus"></span></div>
                                                <!--====== End - Input Counter ======-->
                                            </div>
                                            <div class="u-s-m-b-15">

                                                <button @click.prevent='addtocart(Product.slug)' class="btn btn--e-brand-b-2" type="submit">Add to Cart</button></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="u-s-m-b-15">

                                    <span class="pd-detail__label u-s-m-b-8">Product Policy:</span>
                                    <ul class="pd-detail__policy-list">
                                        <li><i class="fas fa-check-circle u-s-m-r-8"></i>

                                            <span>Buyer Protection.</span></li>
                                        <li><i class="fas fa-check-circle u-s-m-r-8"></i>

                                            <span>Full Refund if you don't receive your order.</span></li>
                                        <li><i class="fas fa-check-circle u-s-m-r-8"></i>

                                            <span>Returns accepted if product not as described.</span></li>
                                    </ul>
                                </div>
                            </div>
                            <!--====== End - Product Right Side Details ======-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="u-s-p-y-90">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="pd-tab">
                                <div class="u-s-m-b-30">
                                    <ul class="nav pd-tab__list">
                                        <li class="nav-item">

                                            <a class="nav-link active" data-toggle="tab" href="#pd-desc">DESCRIPTION</a></li>
                                        <li class="nav-item">

                                            <a class="nav-link" id="view-review" data-toggle="tab" href="#pd-rev">REVIEWS

                                                <span>({{ review_count }})</span></a></li>
                                    </ul>
                                </div>
                                <div class="tab-content">

                                    <!--====== Tab 1 ======-->
                                    <div class="tab-pane fade show active" id="pd-desc">
                                        <div class="pd-tab__desc">
                                            <div class="u-s-m-b-15">
                                                <p>{{ Product.discription  }}</p>
                                            </div>
                                            <div class="u-s-m-b-30">
                                                <ul>
                                                    <li><i class="fas fa-check u-s-m-r-8"></i>

                                                        <span>Buyer Protection.</span></li>
                                                    <li><i class="fas fa-check u-s-m-r-8"></i>

                                                        <span>Full Refund if you don't receive your order.</span></li>
                                                    <li><i class="fas fa-check u-s-m-r-8"></i>

                                                        <span>Returns accepted if product not as described.</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!--====== End - Tab 1 ======-->


                                    <!--====== Tab 3 ======-->
                                    <div class="tab-pane" id="pd-rev">
                                        <div class="pd-tab__rev">
                                            <div class="u-s-m-b-30">
                                                <div class="pd-tab__rev-score">
                                                    <div class="u-s-m-b-8">
                                                        <h2>{{ review_count }} Reviews - {{ reviewStar }} (Overall)</h2>
                                                    </div>
                                                    <div v-if="reviewStar == 1" class="gl-rating-style-2 u-s-m-b-8">
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    <div v-if=" 1 < reviewStar && reviewStar < 2" class="gl-rating-style-2 u-s-m-b-8">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star-half-alt"></i>
                                                    </div>
                                                    <div v-if="reviewStar == 2" class="gl-rating-style-2 u-s-m-b-8">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    <div v-if=" 2< reviewStar &&  reviewStar < 3" class="gl-rating-style-2 u-s-m-b-8">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star-half-alt"></i>
                                                    </div>
                                                    <div v-if="reviewStar ==3" class="gl-rating-style-2 u-s-m-b-8">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    <div v-if=" 3 < reviewStar && reviewStar < 4" class="gl-rating-style-2 u-s-m-b-8">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star-half-alt"></i>
                                                    </div>
                                                    <div v-if="reviewStar ==4" class="gl-rating-style-2 u-s-m-b-8">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    <div v-if="4 < reviewStar && reviewStar< 5" class="gl-rating-style-2 u-s-m-b-8">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star-half-alt"></i>
                                                    </div>
                                                      <div v-if="reviewStar ==5" class="gl-rating-style-2 u-s-m-b-8">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    <div class="u-s-m-b-8">
                                                        <h4>We want to hear from you!</h4>
                                                    </div>

                                                    <span class="gl-text">Tell us what you think about this item</span>
                                                </div>
                                            </div>
                                            <div class="u-s-m-b-30">
                                                <form class="pd-tab__rev-f1">
                                                    <div class="rev-f1__group">
                                                        <div class="u-s-m-b-15">
                                                            <h2>{{ review_count }} Review(s) for {{ Product.name }}</h2>
                                                        </div>
                                                    </div>
                                                    <div class="rev-f1__review">
                                                        <div v-for="review in reviews" :key='review.index' class="review-o u-s-m-b-15">
                                                            <div class="review-o__info u-s-m-b-8">

                                                                <span class="review-o__name">{{ review.username }}</span>

                                                                <span class="review-o__date">{{ review.created_at }}</span>
                                                                &#160;&#160;&#160;
                                                                <a @click="deletereview()" v-if="review.user_id == user.id" title="delete"><i class="fa-solid fa-trash" ></i></a>
                                                                </div>
                                                                
                                                            <div v-if="review.star ==1" class="review-o__rating gl-rating-style u-s-m-b-8">
                                                                <i class="fas fa-star"></i>
                                                                <span>({{ review.star}})</span>
                                                            </div>
                                                            <div v-if="review.star ==1.5" class="review-o__rating gl-rating-style u-s-m-b-8">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star-half-alt"></i>  
                                                                <span>({{ review.star}})</span>
                                                            </div>
                                                            <div v-if="review.star ==2" class="review-o__rating gl-rating-style u-s-m-b-8">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <span>({{ review.star}})</span>
                                                            </div>
                                                            <div v-if="review.star ==2.5" class="review-o__rating gl-rating-style u-s-m-b-8">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star-half-alt"></i> 
                                                                <span>({{ review.star}})</span>
                                                            </div>
                                                            <div v-if="review.star ==3" class="review-o__rating gl-rating-style u-s-m-b-8">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <span>({{ review.star}})</span>
                                                            </div>
                                                            <div v-if="review.star ==3.5" class="review-o__rating gl-rating-style u-s-m-b-8">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star-half-alt"></i> 
                                                                <span>({{ review.star}})</span>
                                                            </div>
                                                            <div v-if="review.star ==4" class="review-o__rating gl-rating-style u-s-m-b-8">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i> 
                                                                <span>({{ review.star}})</span>
                                                            </div>
                                                            <div v-if="review.star ==4.5" class="review-o__rating gl-rating-style u-s-m-b-8">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star-half-alt"></i> 
                                                                <span>({{ review.star}})</span>
                                                            </div>
                                                            <div v-if="review.star ==5" class="review-o__rating gl-rating-style u-s-m-b-8">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i> 
                                                                <span>({{ review.star}})</span>
                                                            </div>
                                                            <p  class="review-o__text">{{ review.comment }}</p>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="u-s-m-b-30">
                                                <form class="pd-tab__rev-f2">
                                                    <h2 class="u-s-m-b-15">Add a Review</h2>

                                                    <span class="gl-text u-s-m-b-15">Your email address will not be published. Required fields are marked *</span>
                                                         <ul class="dash__f-list">
                                                           <li v-for="error in errors" :key='error.index'>
                                                                <span  class="text-danger" >- {{ error[0] }}</span>
                                                            </li>
                                                        </ul>
                                                    <div class="u-s-m-b-30">
                                                        <div class="rev-f2__table-wrap gl-scroll">
                                                            <table class="rev-f2__table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>
                                                                            <div class="gl-rating-style-2"><i class="fas fa-star"></i>

                                                                                <span>(1)</span></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="gl-rating-style-2"><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>

                                                                                <span>(1.5)</span></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="gl-rating-style-2"><i class="fas fa-star"></i><i class="fas fa-star"></i>

                                                                                <span>(2)</span></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="gl-rating-style-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>

                                                                                <span>(2.5)</span></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="gl-rating-style-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>

                                                                                <span>(3)</span></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="gl-rating-style-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>

                                                                                <span>(3.5)</span></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="gl-rating-style-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>

                                                                                <span>(4)</span></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="gl-rating-style-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>

                                                                                <span>(4.5)</span></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="gl-rating-style-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>

                                                                                <span>(5)</span></div>
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>

                                                                            <!--====== Radio Box ======-->
                                                                            <div class="radio-box">

                                                                                <input v-model="form.star" value="1" type="radio"  id="star-1" name="rating">
                                                                                <div class="radio-box__state radio-box__state--primary">

                                                                                    <label class="radio-box__label" for="star-1"></label></div>
                                                                            </div>
                                                                            <!--====== End - Radio Box ======-->
                                                                        </td>
                                                                        <td>

                                                                            <!--====== Radio Box ======-->
                                                                            <div class="radio-box">

                                                                                <input v-model="form.star" value="1.5" type="radio" id="star-1.5" name="rating">
                                                                                <div class="radio-box__state radio-box__state--primary">

                                                                                    <label class="radio-box__label" for="star-1.5"></label></div>
                                                                            </div>
                                                                            <!--====== End - Radio Box ======-->
                                                                        </td>
                                                                        <td>

                                                                            <!--====== Radio Box ======-->
                                                                            <div class="radio-box">

                                                                                <input v-model="form.star" value="2" type="radio" id="star-2" name="rating">
                                                                                <div class="radio-box__state radio-box__state--primary">

                                                                                    <label class="radio-box__label" for="star-2"></label></div>
                                                                            </div>
                                                                            <!--====== End - Radio Box ======-->
                                                                        </td>
                                                                        <td>

                                                                            <!--====== Radio Box ======-->
                                                                            <div class="radio-box">

                                                                                <input type="radio" v-model="form.star" value="2.5" id="star-2.5" name="rating">
                                                                                <div class="radio-box__state radio-box__state--primary">

                                                                                    <label class="radio-box__label" for="star-2.5"></label></div>
                                                                            </div>
                                                                            <!--====== End - Radio Box ======-->
                                                                        </td>
                                                                        <td>

                                                                            <!--====== Radio Box ======-->
                                                                            <div class="radio-box">

                                                                                <input v-model="form.star" value="3" type="radio" id="star-3" name="rating">
                                                                                <div class="radio-box__state radio-box__state--primary">

                                                                                    <label class="radio-box__label" for="star-3"></label></div>
                                                                            </div>
                                                                            <!--====== End - Radio Box ======-->
                                                                        </td>
                                                                        <td>

                                                                            <!--====== Radio Box ======-->
                                                                            <div class="radio-box">

                                                                                <input v-model="form.star" value="3.5" type="radio" id="star-3.5" name="rating">
                                                                                <div class="radio-box__state radio-box__state--primary">

                                                                                    <label class="radio-box__label" for="star-3.5"></label></div>
                                                                            </div>
                                                                            <!--====== End - Radio Box ======-->
                                                                        </td>
                                                                        <td>

                                                                            <!--====== Radio Box ======-->
                                                                            <div class="radio-box">

                                                                                <input v-model="form.star" value="4" type="radio" id="star-4" name="rating">
                                                                                <div class="radio-box__state radio-box__state--primary">

                                                                                    <label class="radio-box__label" for="star-4"></label></div>
                                                                            </div>
                                                                            <!--====== End - Radio Box ======-->
                                                                        </td>
                                                                        <td>

                                                                            <!--====== Radio Box ======-->
                                                                            <div class="radio-box">

                                                                                <input type="radio" v-model="form.star" value="4.5" id="star-4.5" name="rating">
                                                                                <div class="radio-box__state radio-box__state--primary">

                                                                                    <label class="radio-box__label" for="star-4.5"></label></div>
                                                                            </div>
                                                                            <!--====== End - Radio Box ======-->
                                                                        </td>
                                                                        <td>

                                                                            <!--====== Radio Box ======-->
                                                                            <div class="radio-box">

                                                                                <input v-model="form.star" value="5" type="radio" id="star-5" name="rating">
                                                                                <div class="radio-box__state radio-box__state--primary">

                                                                                    <label class="radio-box__label" for="star-5"></label></div>
                                                                            </div>
                                                                            <!--====== End - Radio Box ======-->
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="rev-f2__group">
                                                        <div class="u-s-m-b-30">

                                                            <label class="gl-label" for="reviewer-text">YOUR REVIEW *(Max {{totalRemainCount}})</label>
                                                            <textarea class="text-area text-area--primary-style" @keyup='liveCountDown' v-model="form.comment" maxlength="900" id="reviewer-text"></textarea>
                                                            </div>
                                                    </div>
                                                    <div>

                                                        <button class="btn btn--e-brand-shadow" @click.prevent="Addreview()" type="submit">SUBMIT</button></div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!--====== End - Tab 3 ======-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>

            <!--====== End - Section 1 ======-->
        </div>
</template>
<script>
import { mapGetters } from 'vuex';
import Api from '../../../app/frontend/Api/Api'
export default {
    data(){
        return {
            Product:{
                slug:'',
                category:{
                    discount:null
                }
            },
            form:{
                star:'',
                comment:'',
                slug:''
            },
            errors:[],
            limitmaxCount:900,
            totalRemainCount:900,
           base_url: window.location.origin ,
           image:'',
           quantity:1,
           wishlist:0,
           reviews:[],
           review_count:0,
           reviewStar:0,
           Email_me:0,


        }
    },computed:{ 
            ...mapGetters({
        user: 'user',
    }),
    },methods:{
       getproduct(){
          
      let slug = this.$route.params.slug
       this.form.slug =slug
        Api.get('/Product/'+slug).then(res => {
            this.Email_me =res.data.data.Product.emailme_count;
            this.Product =res.data.data.Product;
            this.reviews = res.data.data.review,
            this.review_count = res.data.data.review_count,
            this.wishlist = res.data.data.wishlist;
            this.reviewStar = res.data.data.reviewsStar;
            this.image = window.location.origin+'/'+res.data.data.Product.thumbnail
        }).catch(err => {
            this.$router.push({ name: "Home"})
        })
       },changeimg(img){
           this.image=this.base_url+'/'+img
       },addtowishlist(slug){
                if (this.$store.state.authenticated == true) {
         Api.get('/add-itemtowishlist/'+slug).then(res => {
             this.wishlist = this.wishlist + 1
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
            },addtocart(slug){
        if (this.$store.state.authenticated == true) {
          Api.post('/add-itemtocart/'+slug+'/'+this.quantity).then(res =>{
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
        },plusquantity(){
            if (this.quantity < 10) {
                this.quantity = this.quantity + 1
            }
        },minusquantity(){
            if (this.quantity > 1) {
               this.quantity = this.quantity - 1
            }
        },Addreview(){
            Api.post('/Create-Review',this.form).then(res => {
            this.reviews= res.data.data.review
            this.review_count= res.data.data.review_count
            this.reviewStar= res.data.data.reviewsStar
              this.$toasted.show(res.data.msg)  
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
        },liveCountDown(){
         this.totalRemainCount = this.limitmaxCount - this.form.comment.length;
        },deletereview(){
            Api.get('/Delete-Review/'+this.Product.slug).then(res => {
            this.reviews= res.data.data.review
            this.review_count= res.data.data.review_count
            this.reviewStar= res.data.data.reviewsStar
            this.$toasted.show(res.data.msg) 
            }).catch(err => {
            this.$toasted.show(err.response.data.msg,{
                     type : 'error',
                    icon : 'exclamation-triangle'
               }) 
            })
        },EmailMeWhenPriceDrope(slug){
        Api.get('Email_me/'+slug).then(res=>{
            this.Email_me = this.Email_me+1
           this.$toasted.show(res.data.msg)
            
        }).catch(err=>{
        this.$toasted.show(err.response.data.msg,{
                type : 'error',
            icon : 'exclamation-triangle'
         })  
        })
        }
        },created(){
        this.getproduct()
    }       
         
}
</script>
<style>
.text-danger{
    color: red;  
}

</style>