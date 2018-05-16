<template>
  <div>
    <Header></Header>
    <Navbar></Navbar>
    <div class="p-0">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="p-0 m-5"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="w-100">
      <div class="container">
        <div class="row">
          <div class="col-md-8        offset-md-2">
            <img class="img-fluid d-block rounded-circle d-inline-flex m-0 p-0" src="dist/image/icon_1_active.png" width="45px" height="45px">
            <a href="#" class="btn btn-outline-secondary d-inline-flex active">個人資料</a>
            <img class="img-fluid d-block rounded-circle d-inline-flex m-0 p-0" src="dist/image/icon_2.png" width="45px" height="45px">
            <a href="upfile" class="btn btn-outline-secondary d-inline-flex">作品上傳 </a>
          </div>
        </div>
      </div>
    </div>
    <div class="p-0">
      <div class="container">
        <div class="row">
          <div class="col-md-7  offset-md-2">
            <hr> </div>
        </div>
      </div>
    </div>
    <div class="py-5">
      <div class="container">
        <div class="row">
          <div class="col-md-8 offset-md-2">
            <h4 class="p-3 text-secondary">
              <b>
                <strong>個人資料</strong>
              </b>
              <br> </h4>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8 offset-md-2">
            <p class="m-0 p-5">請先於「
              <a href="http://pansf.panmedia.asia/4" target="_blank">徵文與活動報名</a>」專區報名後，再於期限內（二○一八年六月一日至八月三十一日 中午12 :00（GMT+8）），於作品上傳區繳交作品。填寫資料請與報名資料相同，</p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8 offset-md-2 px-5">
            <ul class="list-group">
              <div class="card text-white bg-light p-0">
                <div class="card-body m-0">
                  <form action="https://formspree.io/YOUREMAILHERE">
                    <div class="form-group my-5">
                      <label class="text-dark" for="exampleInputEmail1">參賽者本名*</label>
                      <input type="text" class="form-control form-control-sm" placeholder="請輸入你的姓名 (選填)" id="InputName" required="required"> </div>
                    <div class="form-group my-5">
                      <label for="exampleInputEmail1" class="text-dark">筆名*</label>
                      <input type="text" class="form-control form-control-sm" id="InputNickName" placeholder="請輸入你想公開的筆名 (必填)" required="required"> </div>
                    <div class="form-group my-5">
                      <label class="text-dark">聯絡信箱 *</label>
                      <input type="email" class="form-control form-control-sm" placeholder="請輸入你的聯絡信箱 (必填)" id="InputEmail" required="required"> </div>
                    <div class="form-group my-5">
                      <label class="text-dark">聯絡電話 *</label>
                      <input type="tel" class="form-control form-control form-control-sm" id="InputTel" placeholder="請輸入你的聯絡電話 (必填)" required="required"> </div>
                      <button class="btn navbar-btn ml-2 text-white btn-secondary btn-lg">儲存 </button>
                  </form>
                  <div class="row">
                    <div class="col-md-12 text-md-left text-center align-self-center">
                      <p class="mx-5">
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <table class="table">
                <thead>
                  <tr></tr>
                </thead>
                <tbody>
                  <tr></tr>
                  <tr></tr>
                  <tr></tr>
                </tbody>
              </table>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  
import Header from './Header.vue'
import Navbar from './Navbar.vue'

  export default {
    name: 'mylife',
    components: {
      Header,
      Navbar
    },
    data() {
      return {

      }
    },
  }
</script>