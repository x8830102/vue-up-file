<template>
  <div class="container">
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
    <div class="modal" id="short">
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
          <div class="card-block p-5">
            <label for="exampleInputEmail1" class="text-dark">
              <b>
                <b>上傳作品</b>
              </b> (檔案大小不得超過 10 MB)</label>
            <input type="file" @change="getfile" class="form-control-file text-dark" id="short_myfile" required="required">
            <hr>
            <b>
              <label for="exampleInputEmail1" class="text-dark">
                <b>
                  <b>上傳著作權同意書</b>
                </b>
              </label>
              <input type="file" class="form-control-file text-dark" id="short_agreement" required="required">
              <div class="form-check mt-2 text-dark py-3">
                <input class="form-check-input" type="checkbox" id="exampleCheck1" value="on" required="required">
                <label class="form-check-label text-danger" for="exampleCheck1">我已閱讀並同意此
                  <a href="http://pansf.panmedia.asia/3" target="_blank">稿件注意事項</a>&nbsp;與同獎項不得重複投稿規則。</label>
              </div>
            </b>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary">確認上傳</button>
            <button type="button" class="btn btn-info" data-dismiss="modal">取消</button>
          </div>
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
          <form>
            <div class="card-block p-5">
              <label for="exampleInputEmail1" class="text-dark">
                <b>
                  <b>上傳作品</b>
                </b> (檔案大小不得超過 10 MB)
              </label>
              <form @submit.prevent="submit" name="novella_form" id="novella_form">
                <div>
                  <input type="file" @change="getfile($event.target.files,$event.target.id)" name="novella" class="text-dark col-lg-9" id="novella" required="required" accept=".docx">
                  <button type="submit" class="btn btn-secondary col-lg-2 upload_novella_btn">上傳</button>
                  <p class="uploading">上傳中，請稍後！</p>
                  <i class="fa fa-check fa-lg text-success"></i>
                </div>
              </form>
              <hr>
                <label for="exampleInputEmail1" class="text-dark">
                  <b>
                    <b>上傳著作權同意書</b>
                  </b>
                </label>
                <form @submit.prevent="submit" name="novella_agree_form" id="novella_agree_form">
                  <input type="file" class="text-dark col-lg-9" name="novella_agreement" id="novella_agreement" required="required" accept="image/*,.pdf">
                   <button type="submit"  class="btn btn-secondary col-lg-2">上傳</button>
                   <p class="uploading">檔案上傳中，請稍後！</p>
                  <i class="fa fa-check fa-lg text-success"></i>
                </form>
                <div class="form-check mt-2 text-dark py-3">
                  <input class="form-check-input" type="checkbox" id="exampleCheck1" value="on" required="required">
                  <label class="form-check-label text-danger" for="exampleCheck1">我已閱讀並同意此
                    <a href="http://pansf.panmedia.asia/3" target="_blank">稿件注意事項</a>&nbsp;與同獎項不得重複投稿規則。</label>
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
    <div class="modal" id="upload_alert">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title text-danger">
              <b>請注意</b>
            </h3>
            <button type="button" class="close" data-dismiss="modal">
              <span>×</span>
            </button>
          </div>
          <div class="modal-body">
            <p>請先完成個人資料填寫，方能上傳作品。</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary">前往填寫個人資料</button>
            <button type="button" class="btn btn-info" data-dismiss="modal">取消</button>
          </div>
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
              <p class="m-0 p-5">兩種獎項可同時參加，各以投稿一篇為限，同一篇稿件不得重複上傳，上傳作品檔案前，請謹慎確認。也請注意上傳的檔案格式：
                <br>1. 上傳作品 (上傳 docx 檔，檔案大小不得超過 10 MB)&nbsp;
                <br>2. 上傳已簽署之著作權同意書 (上傳 pdf 或 jpg,png,tif 等圖片檔，
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
                        <td class="text-center">{{up_novel_data.up_date}}</td>
                        <td class="text-info text-center">N/A</td>
                      </tr>
                      <tr>
                        <td class="bg-light text-center">投稿編號</td>
                        <td class="text-center">{{up_novel_data.novel_sn}}</td>
                        <td class="text-info text-center">N/A</td>
                      </tr>
                      <tr>
                        <td class="bg-light text-center">投稿作品</td>
                        <td class="text-center">
                          <i class="fa fa-check fa-lg text-primary"></i> {{up_novel_data.up_size}}</td>
                        <td class="text-info text-center">N/A</td>
                      </tr>
                      <tr>
                        <td class="bg-light text-center">著作版權同意書</td>
                        <td class="text-center">
                          <i class="fa fa-check fa-lg text-primary"></i>
                        </td>
                        <td class="text-info text-center">N/A</td>
                      </tr>
                      <tr></tr>
                      <tr></tr>
                      <tr></tr>
                      <tr>
                        <td></td>
                        <td class="">
                          <p>
                            <a href="#" class="btn btn-outline-info disabled">完成上傳</a>
                          </p>
                        </td>
                        <td>
                          <p>
                            <a class="btn navbar-btn ml-2 text-white btn-secondary" data-target="#novella_dialog" data-toggle="modal">前往上傳 </a>
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
        short_novel_total: '10',
        novella_total: '20',
        up_novel_data: {
          novel_sn: 'A001',
          up_date: '2018-05-16 20:15',
          up_size: '0.7MB',
          up_type: '1'
        }
      }
    },
    methods: {
      getfile(files,id) {
        this.file = files[0]
        if( this.file.size > 100000000  ) {
          alert('檔案超過 10MB，無法上傳。')
          $('#' + id).val('');
          this.file = ''
          return false
        }
        console.log(files);
      },
      submit: function(event) {
        const form_id = event.target.name
        $('#' + event.target.name + ' button').hide()
        $('#' + event.target.name + ' p').show()
        var formData = new FormData(event.target)
        this.$http.post('http://localhost/upload.php',formData,{
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        }).then(function (res) {
          $('#' + form_id + ' p').hide()
          $('#' + form_id + ' i').show()
          console.log(res)
        })
      }
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
</style>