<template>
    <div>
        <!-- main-start -->
        <el-row>
            <!-- top-light -->
            <el-col :xs="24" class="light__wrapper">
                <div class="light"></div>
                <div class="light_1"></div>
                <div class="light_2"></div>
            </el-col>
            <div class="main__wrapper">
            <!-- left-logo-and-btn -->
                <el-col :xs="24" :sm="24" :md="24" :lg="12"  class="main__left__wrapper">
                        <el-col :xs="24" :sm="24" :md="24">
                            <div class="logo__wrapper">
                                <img id="logo" src="/image/logo.png" alt="">
                            </div>
                        </el-col>
                        <el-col :xs="24" :sm="24" :md="24">
                            <el-col :xs="12" :sm="12" :md="12" :lg="12">
                                <div class="main__btn__wrapper">
                                    <img v-if="is_login == false" src="/image/btn/login.png" alt="" @click="loginbtn" >
                                    <img v-if="is_login == true" src="/image/btn/info.png" alt="" @click="personal_infor">
                                </div>
                            </el-col>
                            <el-col :xs="12" :sm="12" :md="12" :lg="12">
                                <div class="main__btn__wrapper">
                                    <img src="/image/btn/share.png" alt="" @click="share">
                                </div>
                            </el-col>
                            <el-col :xs="12" :sm="12" :md="12" :lg="12">
                                <div class="main__btn__wrapper">
                                    <a href="#rule_form">
                                        <img src="/image/btn/rule.png" alt="" >
                                    </a>
                                </div>
                            </el-col>
                            <el-col :xs="12" :sm="12" :md="12" :lg="12">
                                <div class="main__btn__wrapper">
                                    <a href="#prize_form">
                                        <img src="/image/btn/prize.png" alt="" >
                                    </a>
                                </div>
                            </el-col>
                        </el-col>
                </el-col>
                <!-- right-gashapon -->
                <el-col :xs="24" :sm="24" :md="24" :lg="12"  class="main__right__wrapper">
                        <div class="gashapon__wrapper" v-html="gashapon" @click="clickHandler"></div>
                </el-col>
            </div>
        </el-row>
        <!-- main-end -->
        <!-- login-form-start -->
        <el-dialog class="login_form"  :visible.sync="loginFormVisible" center>
            <el-row>
                <el-col :xs="24" :sm="24" :md="24">
                    <el-form :model="loginForm" label-width="100px">
                        <el-form-item label="登入電話">
                            <el-input type="tel" v-model="loginForm.phone" auto-complete="off"></el-input>
                        </el-form-item>
                        <el-form-item label="登入密碼">
                            <el-input v-model="loginForm.passwd" type="password" auto-complete="off"></el-input>
                        </el-form-item>
                    </el-form>
                </el-col>
                <!-- image -->
                <span class="login_image_left"><img src="/image/login_image_left.png" alt=""></span>
                <span class="login_image_right"><img src="/image/login_image_right.png" alt=""></span>
            </el-row>
            <el-row class="u-text-center login_form_wrapper">
                <el-col :xs="24" :sm="24" :md="8" class="u-mb-8">
                    <el-button type="primary" @click="normallogin" id="normal_login_btn">登入</el-button>
                </el-col>
                <el-col :xs="24" :sm="24" :md="16">
                    <el-button type="primary" @click="facebooklogin" id="fb_login_btn">Facebook</el-button>
                </el-col>
            </el-row>
            <span style="display: block;text-align: center;">※請使用TripMatch帳號登入，或<a target="_blank" href="https://www.tripmatch.com.tw/#/signup">點此註冊</a></span>
        </el-dialog>
        <!-- login-form-end -->
        <!-- prize-form-start -->
        <div class="lightbox-target" id="rule_form">
            <img src="/image/rule.png">
            <a class="lightbox-close" href="#"></a>
        </div>
        <!-- prize-form-end -->
        <!-- prize-form-start -->
        <div class="lightbox-target" id="prize_form">
            <img src="/image/prize.png">
            <a class="lightbox-close" href="#"></a>
        </div>
        <!-- prize-form-end -->
        <!-- personal-prize-image-start -->
        <div class="lightbox-target" id="prize_image">
            <img src="" id="personal_prize_image">
            <a class="lightbox-close" href="#"></a>
        </div>
        <!-- personal-prize-image-end -->
        <!-- personal-infor-start -->
        <span class="personal_infor">
        <el-dialog :visible.sync="personalInforVisible" >
            <el-table :data="personalInforData">
                <el-table-column property="created_at" label="日期" width="200"></el-table-column>
                <el-table-column property="prize" label="獎項"></el-table-column>
            </el-table>
        </el-dialog>
        </span>
        <!-- personal-infor-end -->
        <!-- volume-start -->
        <span class="si-icons si-icons-default volume">
            <span class="si-icon si-icons-easing si-icon-volume " data-icon-name="volume" @click="music"></span>
            <audio id="bgmusic" src="/audio/xmas.mp3" autoplay="autoplay" loop></audio>
        </span>
        <!-- volume-end -->
        <!-- sound-effect-start -->
        <audio id="lotteryAudio">
            <source src="/audio/lottery.ogg" type="audio/ogg">
            <source src="/audio/lottery.mp3" type="audio/mpeg">
            <source src="/audio/lottery.wav" type="audio/wav">
        </audio>
        <!-- sound-effect-end -->
        <!-- facebook-start -->
        <div id="fb-root"></div>
        <!-- facebook-end -->
        <!-- illustration-start -->
        <span id="illustration1"></span>
        <span id="illustration2"></span>
        <span id="illustration3"></span>
        <span id="illustration4"></span>
        <span id="illustration5"></span>
        <span id="illustration6"></span>
        <!-- illustration-end -->
    </div>
</template>

<script>
export default {
    data() {
        return {
            fields: 0,
            is_login: false,
            user:{
                phone:'',
                name:'',
                birth:'',
                email:'',
                quota:0,
            },
            loginFormVisible: false,
            loginForm: {
                phone:'',
                passwd:''
            },
            bgMusicPlay: true,
            gashapon:'',
            personalInforVisible: false,
            personalInforData: '',
        };
    },
    created() {
        window.fbAsyncInit = function() {
        FB.init({
            appId      : '269081420163880',
            cookie     : true,  
            xfbml      : true,  
            version    : 'v2.8' 
        });
        };
        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/zh-TW/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        // gashapon
        Vue.axios.get('/image/gashapon.svg')
        .then(response=>{
            this.gashapon = response.data;
        })
        .catch(function (error) {
            this.alert('很抱歉，扭蛋機似乎有點故障了，請聯繫客服人員，或稍後再次嘗試');
        });

    },
    mounted: function(){        
        // volume
        document.getElementById("bgmusic").volume = 0.3;
        document.getElementById('bgmusic').play();
        // document.getElementById('bgmusic').pause();
        (function() {
            [].slice.call( document.querySelectorAll( '.si-icons-default > .si-icon' ) ).forEach( function( el ) {
                var svgicon = new svgIcon( el, svgIconConfig );
            } );
        })();
    },
    methods:{

        
        clickHandler(e) {
            var vm = this;
            if (e.target.parentElement.id == 'gashapon_buttom') {
                vm.lottery()
            }
            if (e.target.parentElement.id == 'gift') {
                document.getElementById("gift").style.display = 'none';
            }
        },
        quota_image(count){
            if (count == 0) {
                document.getElementById('round_2').style.display = 'none';
                document.getElementById('round_1').style.display = 'none';
                document.getElementById('round_0').style.display = 'inline-block';
            }else if(count == 1){
                document.getElementById('round_2').style.display = 'none';
                document.getElementById('round_1').style.display = 'inline-block';
                document.getElementById('round_0').style.display = 'none';
            }else if(count == 2){
                document.getElementById('round_2').style.display = 'inline-block';
                document.getElementById('round_1').style.display = 'none';
                document.getElementById('round_0').style.display = 'none';
            }else if(count < 0){
                document.getElementById('round_2').style.display = 'none';
                document.getElementById('round_1').style.display = 'none';
                document.getElementById('round_0').style.display = 'inline-block';
            }else{
                document.getElementById('round_2').style.display = 'inline-block';
                document.getElementById('round_1').style.display = 'none';
                document.getElementById('round_0').style.display = 'none';
            }
        },
        share(){
            var vm = this;
            if(this.is_login == false){
                this.login_alert();
            }else{
                FB.ui({
                        method: 'share',
                        href: 'https://active.tripmatch.net/2017gashapon',
                        quote: '天天聖誕慶，連續五天登入會員扭蛋誕 ！多種好禮等著你，立刻註冊會員再享旅遊金100元，找房超Easy，天天超回饋 ！',
                        mobile_iframe: true
                    },function(response) {
                        if (response && response !== 'undefined' && !response.error_code) {
                            //分享成功處理
                            Vue.axios.post('/api/share', {
                                phone: vm.user.phone,
                            })
                            .then(response=>{
                                if(response.data.syscode == 200){
                                    vm.user.quota = response.data.data.quota;
                                    vm.quota_image(vm.user.quota);
                                    vm.alert('分享成功');
                                }else{
                                    vm.alert('分享紀錄發生錯誤，請稍後再次嘗試或連繫客服人員');
                                }
                            })
                            .catch(function (error) {
                                vm.alert('很抱歉，分享紀錄過程中發生錯誤，請稍後再次嘗試或連繫客服人員');
                            });
                        } else {
                            vm.alert('分享失敗');
                        }
                    }
                )
            }
        },
        lottery(){
            var vm = this;
            document.getElementById("gift").style.display = 'none';
            if(this.is_login == false){
                this.login_alert();
            }else{
                Vue.axios.post('/api/lottery', {
                    phone: vm.user.phone,
                })
                .then(response=>{
                    if(response.data.syscode == 200){
                        // 扭蛋機旋轉
                        document.getElementById("gashapon_buttom").style.transform = "rotate(360deg)";
                        document.getElementById("gashapon_buttom").style.transition  = "all 1s";

                        vm.user.quota = response.data.data.quota;
                        vm.quota_image(vm.user.quota);
                        var audio = document.getElementById("lotteryAudio");
                        audio.currentTime = 0;
                        audio.play();
                        setTimeout(function(){
                            audio.pause();
                            var personal_prize_image = document.getElementById("personal_prize_image");
                            personal_prize_image.src = response.data.data.prize_image;
                            document.getElementById("gift").style.display = 'inline-block';
                            document.getElementById("gashapon_buttom").style.transform = "rotate(0deg)";
                        }, 700);
                    }else if(response.data.syscode == 401){
                        vm.alert('今日已無抽獎次數 = )');
                        vm.quota = response.data.data.quota;
                    }else if(response.data.syscode == 4030){
                        vm.alert('現在不是抽獎時間，詳情請查閱扭蛋規則。');
                    }else{
                        vm.alert('發生錯誤，請稍後再次嘗試或連繫客服人員');
                    }
                })
                .catch(function (error) {
                    vm.alert('很抱歉，抽獎過程中發生錯誤，請稍後再次嘗試或連繫客服人員');
                });
            }
        },
        personal_infor(){
            var vm = this;
            Vue.axios.post('/api/get_personal', {
                phone: vm.user.phone,
            })
            .then(response=>{
                if(response.data.syscode == 200){
                    vm.personalInforData = response.data.data;
                    vm.personalInforVisible = true;
                }else{
                    vm.alert('發生錯誤，請稍後再次嘗試或連繫客服人員');
                }
            })
            .catch(function (error) {
                vm.alert('很抱歉，抽獎過程中發生錯誤，請稍後再次嘗試或連繫客服人員');
            });
        },
        loginbtn(){
            this.loginFormVisible = true
        },
        normallogin(){
            var vm = this;
            vm.loginFormVisible = false;
            Vue.axios.post('/api/login_normal', {
                phone: this.loginForm.phone,
                passwd: this.loginForm.passwd,
                port: 'Normal'
            })
            .then(response=>{
                if(response.data.syscode == 200){
                    vm.is_login = true;
                    vm.user.phone = response.data.data.phone;
                    vm.user.name = response.data.data.name;
                    vm.user.birth = response.data.data.birthday;
                    vm.user.email = response.data.data.email;
                    vm.user.quota = response.data.data.quota;
                    vm.quota_image(vm.user.quota);
                }else if(response.data.syscode == 432){
                    vm.alert('帳號尚未通過驗證，無法進行抽獎。');
                }else if(response.data.syscode == 405){
                    vm.alert('帳號密碼錯誤，請再次嘗試');
                }
                vm.loginForm.phone = '';
                vm.loginForm.passwd = '';
            })
            .catch(function (error) {
                vm.alert('很抱歉，登入時發生錯誤，請稍後再次嘗試或連繫客服人員');
            });
        },
        facebooklogin(){
            var vm = this;
            this.loginFormVisible = false;
            FB.login(function(response){
                FB.getLoginStatus(function(response) {
                    if (response.status === 'connected') {
                        Vue.axios.post('/api/login_normal', {
                            fbid: response.authResponse.userID,
                            port: 'FB'
                        })
                        .then(response=>{
                            if(response.data.syscode == 200){
                                vm.is_login = true;
                                vm.user.phone = response.data.data.phone;
                                vm.user.name = response.data.data.name;
                                vm.user.birth = response.data.data.birthday;
                                vm.user.email = response.data.data.email;
                                vm.user.quota = response.data.data.quota;
                                vm.quota_image(vm.user.quota);
                            }else if(response.data.syscode == 432){
                                vm.alert('帳號尚未通過驗證，無法進行抽獎。');
                            }else if(response.data.syscode == 405){
                                vm.alert('此FB尚未註冊過TripMatch會員');
                            }
                            vm.loginForm.phone = '';
                            vm.loginForm.passwd = '';
                        })
                        .catch(function (error) {
                            vm.alert('很抱歉，登入時發生錯誤，請稍後再次嘗試或連繫客服人員');
                        });
                    }
                });
            
            });
        },
        login_alert() {
            this.$alert('為保障您的抽獎權益，請先登入會員', '', {
                showConfirmButton: true,
                closeOnClickModal: true,
                closeOnPressEscape: true,
                confirmButtonText: '確定',
                center: true,
                callback: action => {
                    this.loginbtn();
                }
            });
        },
        alert(message){
            this.$alert(message, '', {
                showConfirmButton: true,
                closeOnClickModal: true,
                closeOnPressEscape: true,
                confirmButtonText: '確定',
                center: true,
            })
        },
        music(){
            var bgmusic = document.getElementById('bgmusic');
            if(this.bgMusicPlay == true){
                bgmusic.pause();
                this.bgMusicPlay = false;
            }else{
                bgmusic.play();
                this.bgMusicPlay = true;
            }
        }
    },
};
    

</script>

<style>
.el-message-box{
    background-image: url(/image/alert_bg.png);
    background-color: rgba(0,0,0,0);
    border: 0;
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    width: 35%;
    text-align: center;
    height: 265px;
}
.el-message-box__header{
    display: none;
}

.el-message-box__content{
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    height: 100%;
    font-size: 16px;
}

.el-message-box__btns{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, 95%);
}



.personal_infor .el-dialog__header{
    background-image: url("/image/personal_infor_header.png");
}

.el-table, .el-table__expanded-cell{
    background-color: rgba(0,0,0,0);
}

.el-table tr {
    background-color: rgba(0,0,0,0);
}

.el-table--enable-row-hover .el-table__body tr:hover>td {
    background-color: #f5f7fa59;
}

.el-dialog__body{
        padding: 8px 20px;
}

.el-dialog{
    background-image: url("/image/login_bg.png");
    border-radius: 10px;
    width: 44%;
}

.el-dialog__wrapper{
    position: absolute;
}

.el-dialog__header{
    background-image: url("/image/login_header.png");
    background-repeat: no-repeat;
    background-position: center center;

    background-size: cover;
    height: 93px;
}

.login_form .el-form-item {
    margin-bottom: 10px;
}

.el-dialog--center .el-dialog__body{
    padding: 4px 140px 30px;
}


.el-form-item__label{
    font-weight: 600;
    font-size: 20px;
}

.el-input input{
    border-radius: 0px;
    font-size: 16px;
}


@media screen and (max-width: 1400px) {
    .el-dialog{
        width: 55%;
    }

    .el-message-box{
        width: 52%;
    }
}


@media screen and (max-width: 992px) {
    .el-dialog--center .el-dialog__body{
        padding: 4px 20px 30px;
    }

    .el-message-box{
        width: 90%;
    }
}




@media screen and (max-width: 768px) {
    .el-dialog__header{
        background-size: 150%;
        height: 70px;
    }


    .personal_infor .el-dialog__header{
        height: 95px;
    }
}


@media screen and (max-width: 570px) {
    .el-dialog__header{
        background-size: 220%;
    }
    .el-dialog{
        width: 90%;
    }


    .el-message-box{
        width: 100%;
    }
}


</style>