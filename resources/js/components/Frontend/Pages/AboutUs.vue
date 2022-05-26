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

                                        <a href="index.html">Home</a></li>
                                    <li class="is-marked">

                                        <a href="about.html">About</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section 1 ======-->


            <!--====== Section 2 ======-->
            <div class="u-s-p-b-60">

                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="about">
                                    <div class="about__container">
                                        <div class="about__info">
                                            <h2 class="about__h2">Welcome to Za3touri Store!</h2>
                                            <div class="about__p-wrap">
                                                <p class="about__p">This site was created by me, Firas baccouch, as a graduation project. It took me 3 months to complete it, I am hosting this project to include it to my portfolio and start my career after experimenting in Laravel and vue js for 2 years,
Feel free to contact me if you want to bring your business idea to life.
<br>
Email: firasbaccouch5@gmail.com <br>
You can also contact me via Facebook or the linkedin which you can find below</p>
                                            </div>

                                            <router-link class="about__link btn--e-secondary" :to='{name:"Home"}' target="_blank">Shop Now</router-link>
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

                <!--====== Section Intro ======-->
                <div class="section__intro u-s-m-b-46">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section__text-wrap">
                                    <h1 class="section__heading u-c-secondary">Developed By</h1>
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
                            <div class="col-lg-2 col-md-2  u-s-m-b-30"></div>
                            <div class="col-lg-4 col-md-4  u-s-m-b-30">
                                <div class="team-member u-h-100">
                                    <div class="team-member__wrap">
                                        <div class="aspect aspect--bg-grey-fb aspect--square">

                                            <img class="aspect__img team-member__img" v-lazy="baseURL+'/frontend/images/developer/developer.jpg'" alt=""></div>
                                        <div class="team-member__social-wrap">
                                            <ul class="team-member__social-list">

                                                <li>

                                                    <a  target=”_blank” href='https://www.facebook.com/firas.baccouch.90/' class="s-fb--bgcolor-hover" ><i class="fab fa-facebook-f"></i></a></li>
                                                <li>

                                                    <a  target=”_blank” href="https://www.instagram.com/firas_bbh/" class="s-insta--bgcolor-hover" ><i class="fab fa-instagram"></i></a></li>
                                                <li>

                                                    <a  target=”_blank” href="https://www.linkedin.com/in/firas-baccouch-12429323a/" class="s-linked--bgcolor-hover" ><i class="fab fa-linkedin"></i></a></li>
                                                   
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="team-member__info">

                                        <span class="team-member__name">Firas Baccouch</span>

                                        <span class="team-member__job-title">Full Stack Developer</span></div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4  u-s-m-b-30">
                                <div class="team-member u-h-100">
                                    <div class="team-member__wrap">
                                        <div class="aspect aspect--bg-grey-fb aspect--square">

                                            <img class="aspect__img team-member__img" v-lazy="baseURL+'/frontend/images/developer/developer1.jpg'" alt=""></div>
                                        <div class="team-member__social-wrap">
                                            <ul class="team-member__social-list">

                                                <li>

                                                    <a  target=”_blank” href='https://www.facebook.com/wassim.justin.5' class="s-fb--bgcolor-hover" ><i class="fab fa-facebook-f"></i></a></li>
                                                <li>

                                                    <a  target=”_blank” href="https://www.instagram.com/wassim_bbh/" class="s-insta--bgcolor-hover" ><i class="fab fa-instagram"></i></a></li>
                                                <li>

                                                    <a  target=”_blank” href="https://www.linkedin.com/in/wassim-laaouini-072146223/" class="s-linked--bgcolor-hover" ><i class="fab fa-linkedin"></i></a></li>
                                                   
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="team-member__info">

                                        <span class="team-member__name">Wassim Laaouini</span>

                                        <span class="team-member__job-title">Full Stack Developer</span></div>
                                </div>
                            </div>
                            
                            <div class="col-lg-2 col-md-2  u-s-m-b-30"></div>
                        </div>
                    </div>
                </div>
                <!--====== End - Section Content ======-->
            </div>
            <!--====== End - Section 3 ======-->


            <!--====== Section 4 ======-->

            <!--====== End - Section 4 ======-->
        </div>
</template>
<script>
export default {
    data(){
        return{
            baseURL:window.location.origin,

        }
    }
}
</script>