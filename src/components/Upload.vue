<template>
  <div>
    <Header></Header>
    <Navbar></Navbar>
    <div class="modal" id="short_novel_dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title">
              <b>投稿獎項｜短篇小說</b>
            </h3>
            <button type="button" class="close" data-dismiss="modal">
              <span>×</span>
            </button>
          </div>
          <form  @submit.prevent="submit" name="short_novel_form" id="short_novel_form">
            <div class="card-block p-5">
              <label for="exampleInputEmail1" class="text-dark">
                <b>
                  <b>上傳作品</b>
                </b> (檔案大小不得超過 10 MB)
              </label>
                <div class="row">
                  <input type="file" @change="getfile($event.target.files,$event.target.id)" name="novel" class="text-dark col-9" id="short_novel" required="required" accept=".docx" multiple>
                  <div class="text-center col-3">
                    <div class="uploading loader"></div>
                    <i class="fa fa-check fa-lg text-success"></i>
                  </div>
                </div>
                  
                 <hr>
                <label for="exampleInputEmail1" class="text-dark">
                  <b>
                    <b>上傳同意書</b>
                  </b>
                </label>
                <div class="row">
                  <input type="file" class="text-dark col-9" name="agreement" id="short_novel_agreement" required="required" accept=".pdf,.jpg,.png,.tif" multiple>
                  <div class="text-center col-3">
                    <div class="uploading loader"></div>
                    <i class="fa fa-check fa-lg text-success"></i>
                  </div>
                </div>
                <div class="form-check mt-2 text-dark py-3">
                  <input class="form-check-input" type="checkbox" id="exampleCheck1" value="on" required="required">
                  <label class="form-check-label text-danger" for="exampleCheck1">我已閱讀並同意此
                    <a href="http://pansf.panmedia.asia/noties" target="_blank">投稿注意事項</a></label>
                    <input type="hidden" name="up_type" value="1">
                </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-secondary">完成上傳</button>
              <button type="button" class="btn btn-info" data-dismiss="modal">取消</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="modal" id="novella_dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title">
              <b>投稿獎項｜中短篇小說</b>
            </h3>
            <button type="button" class="close" data-dismiss="modal">
              <span>×</span>
            </button>
          </div>
          <form  @submit.prevent="submit" name="novella_form" id="novella_form">
            <div class="card-block p-5">
              <label for="exampleInputEmail1" class="text-dark">
                <b>
                  <b>上傳作品</b>
                </b> (檔案大小不得超過 10 MB)
              </label>
                <div class="row">
                  <input type="file" @change="getfile($event.target.files,$event.target.id)" name="novel" class="text-dark col-9" id="novella" required="required" accept=".docx" multiple>
                  <div class="col-3">
                    <div class="uploading loader"></div>
                    <i class="fa fa-check fa-lg text-success"></i>
                  </div>
                </div>
              <hr>
                <label for="exampleInputEmail1" class="text-dark">
                  <b>
                    <b>上傳同意書</b>
                  </b>
                </label>
                <div class="row">
                  <input type="file" class="text-dark col-9" name="agreement" id="novella_agreement" required="required" accept=".pdf,.jpg,.png,.tif" multiple>
                  <div class="col-3">
                    <div class="uploading loader"></div>
                    <i class="fa fa-check fa-lg text-success"></i>
                  </div>
                </div>
                <div class="form-check mt-2 text-dark py-3">
                  <input class="form-check-input" type="checkbox" id="exampleCheck1" value="on" required="required">
                  <label class="form-check-label text-danger" for="exampleCheck1">我已閱讀並同意此
                    <a href="http://pansf.panmedia.asia/noties" target="_blank">投稿注意事項</a></label>
                    <input type="hidden" name="up_type" value="2">
                </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-secondary">完成上傳</button>
              <button type="button" class="btn btn-info" data-dismiss="modal">取消</button>
            </div>
          </form>
        </div>
      </div>
    </div>
   
    <div class="p-0">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="p-0 m-5"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="p-0">
      <div class="container">
        <div class="row"> </div>
      </div>
    </div>
    <div class="w-100">
      <div class="container">
        <div class="row">
          <div class="col-md-8 offset-md-2">
            <img class="img-fluid d-block rounded-circle d-inline-flex m-0 p-0" src="dist/image/icon_1.png" width="45px" height="45px">
            <a class="btn btn-outline-secondary d-inline-flex" href="myfile">個人資料</a>
            <img class="img-fluid d-block rounded-circle d-inline-flex m-0 p-0" src="dist/image/icon_2_active.png" width="45px" height="45px">
            <a href="#" class="btn btn-outline-secondary d-inline-flex active">作品上傳 </a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8 offset-md-2">
            <hr> </div>
        </div>
      </div>
    </div>
    <div class="">
      <div class="container">
        <div class="row">
          <div class="col-md-8 offset-md-2">
            <ul class="list-group">
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
              <hr>
              <h4 class="text-secondary p-3">
                <b>
                  <strong>作品上傳</strong>
                </b>
                <br> </h4>
              <p class="m-0 p-5" style="text-align: left">兩種獎項可同時參加，各以投稿一篇為限，上傳作品檔案前，請謹慎確認。也請注意上傳的檔案格式：
                <br>1. 上傳作品 (上傳 docx 檔，檔案大小不得超過 10 MB)&nbsp;
                <br>2. 上傳已簽署之同意書 (上傳 pdf 或 jpg,png,tif 等圖片檔，
                <a href="#">同意書下載連結</a>)</p>
              <div class="row">
                <div class="col-md-12 text-center">
                  <table class="table text-center">
                    <thead class="text-center">
                      <tr class="text-center">
                        <th class="table-secondary text-center p-5">
                          <span style="font-weight: normal;">投稿獎項</span>
                        </th>
                        <th class="table-secondary text-center">短篇小說
                          <br>
                          <span style="font-weight: normal;">3,000 到 6,000 字</span>
                        </th>
                        <th class="text-center table-secondary">中短篇小說
                          <br>
                          <span style="font-weight: normal;">9,000 到 12,000 字</span>
                        </th>
                      </tr>
                      <tr class="text-center"></tr>
                      <tr class="text-center">
                        <td class="table-secondary text-center">目前投稿人數</td>
                        <td class="table-secondary text-center" contenteditable="true">{{short_novel_total}}</td>
                        <td class="table-secondary text-center">{{novella_total}}</td>
                      </tr>
                    </thead>
                    <tbody class="text-center">
                      <tr>
                        <td class="bg-light text-center">上傳時間</td>
                        <td class="text-center" :class="short_novel_data.up_date != 'N/A' ? '' : 'text-info'">{{short_novel_data.up_date}}</td>
                        <td class="text-center" :class="novella_data.up_date != 'N/A' ? '' : 'text-info'">{{novella_data.up_date}}</td>
                      </tr>
                      <tr>
                        <td class="bg-light text-center">投稿編號</td>
                        <td class="text-center" :class="short_novel_data.novel_no != 'N/A' ? '' : 'text-info'">{{short_novel_data.novel_no}}</td>
                        <td class="text-center" :class="novella_data.novel_no != 'N/A' ? '' : 'text-info'">{{novella_data.novel_no}}</td>
                      </tr>
                      <tr>
                        <td class="bg-light text-center">投稿作品</td>
                        <td class="text-center" :class="short_novel_data.up_size != 'N/A' ? '' : 'text-info'">
                          <i class="fa fa-check fa-lg text-primary" v-if="short_novel_data.up_size != 'N/A'"></i> {{short_novel_data.up_size}}</td>
                        <td class="text-center" :class="novella_data.up_size != 'N/A' ? '' : 'text-info'">
                          <i class="fa fa-check fa-lg text-primary" v-if="novella_data.up_size != 'N/A'"></i> {{novella_data.up_size}}
                        </td>
                      </tr>
                      <tr>
                        <td class="bg-light text-center">同意書</td>
                        <td class="text-center" :class="short_novel_data.agreement != 'N/A' ? '' : 'text-info'">
                          <i class="fa fa-check fa-lg text-primary" v-if="short_novel_data.agreement != 'N/A'">
                          </i>{{short_novel_data.agreement}}
                        </td>
                        <td class="text-center" :class="novella_data.agreement != 'N/A' ? '' : 'text-info'">

                          <i class="fa fa-check fa-lg text-primary" v-if="novella_data.agreement != 'N/A'">
                          </i>{{novella_data.agreement}}
                        </td>
                      </tr>
                      <tr></tr>
                      <tr></tr>
                      <tr></tr>
                      <tr>
                        <td></td>
                        <td class="">
                          <p>
                            <a class="btn navbar-btn ml-2 text-white btn-secondary" v-if="short_novel_data.novel_no == 'N/A'" data-target="#short_novel_dialog" data-toggle="modal">開始上傳 </a>
                            <a href="#" class="btn btn-outline-info disabled" v-else>完成上傳</a>
                          </p>
                        </td>
                        <td>
                          <p>
                            <a class="btn navbar-btn ml-2 text-white btn-secondary" v-if="novella_data.novel_no == 'N/A'" data-target="#novella_dialog" data-toggle="modal">開始上傳 </a>
                            <a href="#" class="btn btn-outline-info disabled" v-else>完成上傳</a>
                          </p>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <table class="table"></table>
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
    name: 'Upload',
    components: {
      Header,
      Navbar
    },
    data(){
      return {
        file : {},
        short_novel_total: '0',
        novella_total: '0',
        short_novel_data: {
          novel_no: 'N/A',
          up_date: 'N/A',
          up_size: 'N/A',
          agreement: 'N/A'
        },
        novella_data: {
          novel_no: 'N/A',
          up_date: 'N/A',
          up_size: 'N/A',
          agreement: 'N/A'
        }
      }
    },
    created() {
      this.$http.post('http://pansf-upload.panmedia.asia/console/novel/all',{novel_type: 1},{emulateJSON: true}).then(success => {
        this.short_novel_total = success.data.data.length
      },error => {
        console.log(error)
      })

      this.$http.post('http://pansf-upload.panmedia.asia/console/novel/all',{novel_type: 2},{emulateJSON: true}).then(success => {
        this.novella_total = success.data.data.length
      },error => {
        console.log(error)
      })

      this.$http.post('http://pansf-upload.panmedia.asia/console/novel/my',{email: this.getCookie('email'), novel_type: 1},{emulateJSON: true}).then(success => {
        if( success.data.success ) {
          this.short_novel_data.novel_no = success.data.data.novel_no
          this.short_novel_data.up_date = success.data.data.up_date.substr(0,16)
          this.short_novel_data.up_size = (success.data.data.novel_file_size / 1024 / 1024).toFixed(1) + "MB"

          if( success.body.data.agreement_file_name ) {
            this.short_novel_data.agreement = ''
          }
        }
      },error => {
        console.log(error)
      })

      this.$http.post('http://pansf-upload.panmedia.asia/console/novel/my',{email: this.getCookie('email'), novel_type: 2},{emulateJSON: true}).then(success => {
        if( success.data.success ) {
          this.novella_data.novel_no = success.data.data.novel_no
          this.novella_data.up_date = success.data.data.up_date.substr(0,16)
          this.novella_data.up_size = (success.data.data.novel_file_size / 1024 / 1024).toFixed(1) + "MB"

          if( success.body.data.agreement_file_name ) {
            this.novella_data.agreement = ''
          }
        }
      },error => {
        console.log(error)
      })
    },
    mounted() {
      if( this.getCookie('username') == null ) {
        window.location = '/?l=1';
      }
    },
    methods: {
      getfile(files,id) {
        this.file = files[0]
        const size = 1024 * 1024 *10;
        if( this.file.size > size  ) {
          alert('檔案超過 10MB，無法上傳。')
          $('#' + id).val('');
          this.file = ''
          return false
        }
      },
      submit: function(event) {
        const form_id = event.target.name
        $('#' + event.target.name + ' .loader').show()
        const formData = new FormData(event.target)
        formData.append('email',this.getCookie('email'));
        this.$http.post('http://pansf-upload.panmedia.asia/console/novel/upload',formData,{
          headers: {
            'Content-Type': 'multipart/form-data'
          },
          emulateJSON: true
        }).then(function (res) {
          $('#' + form_id + ' .loader').hide()
          $('#' + form_id + ' .text-success').show()
          setTimeout("location.reload()", '1000')
          
        })
      },

    }
  }
</script>
<style>
  @media (max-width: 768px){
    form 
      button{
        margin-top: 15px
      }
      p,i {
        text-align: center;
      }

  }
  form i.fa-check{
    display: none;
  }
  .uploading{
    display:none;
  }
.loader {
    border: 3px solid #f3f3f3; /* Light grey */
    border-top: 3px solid #3498db; /* Blue */
    border-radius: 50%;
    width: 30px;
    height: 30px;
    animation: spin 2s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>